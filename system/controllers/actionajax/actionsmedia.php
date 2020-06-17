<?php 
/*
********************************************************
* @author Santos Montano B. (Lito Santos M.)
* @author_url 1: http://www.kanorika.com
* @author_url 2: http://codecanyon.net/user/kanorika
* @author_email: info@kanorika.com   
********************************************************
* iSocial - Social Networking Platform
* Copyright (c) 2018 iSocial. All rights reserved.
********************************************************
*/

    global $K;
    $user = & $GLOBALS['user'];
    $page = & $GLOBALS['page'];
    $network = & $GLOBALS['network'];
    
    $page->loadLanguage('global.php');
    $page->loadLanguage('dashboard.php');

    $designer = new designer();
    $msg_error_default = $designer->boxAlert($page->lang('global_txt_information'), $page->lang('global_txt_error_ocurred'), $page->lang('global_txt_ok'));

    if (!$user->is_logged) { 
        echo('ERROR:'.$msg_error_default);
        return;
    }
    
    $the_sanitaze = new sanitize(); // init sanitaze
    
    $error = FALSE;
    
    if ($ajax_action == 'like') {
        $code = isset($_POST['cod']) ? (trim($_POST['cod'])) : '';
        $code = $the_sanitaze->str_nohtml($code, 11);

        $status= isset($_POST['sts']) ? (trim($_POST['sts'])) : '';
        $status = $the_sanitaze->int($status);        

        $code_visit = isset($_POST['cvis']) ? (trim($_POST['cvis'])) : '';
        $code_visit = $the_sanitaze->str_nohtml($code_visit, 11);

        $type_visit = isset($_POST['tvis']) ? (trim($_POST['tvis'])) : '';
        $type_visit = $the_sanitaze->int($type_visit);
        
    	if (!$error && empty($code)) { $error = TRUE; $txterror = $msg_error_default; }
    	if (!$error && empty($code_visit)) { $error = TRUE; $txterror = $msg_error_default; }
    }

    if ($ajax_action == 'newcomment') {
        $code = isset($_POST['cod']) ? (trim($_POST['cod'])) : '';
        $code = $the_sanitaze->str_nohtml($code, 11);

        $code_writer = isset($_POST['cwr']) ? (trim($_POST['cwr'])) : '';
        $code_writer = $the_sanitaze->str_nohtml($code_writer, 11);

        $type_writer = isset($_POST['twr']) ? (trim($_POST['twr'])) : '';
        $type_writer = $the_sanitaze->int($type_writer);

        $comment = isset($_POST['msg']) ? (trim($_POST['msg'])) : '';
        $comment = $the_sanitaze->str_nohtml($comment);
        
    	if (!$error && empty($code)) { $error = TRUE; $txterror = $msg_error_default; }
    	if (!$error && empty($code_writer)) { $error = TRUE; $txterror = $msg_error_default; }
    	if (!$error && empty($comment)) { $error = TRUE; $txterror = $msg_error_default; }        
    }
    
    if ($ajax_action == 'newstickercommentmedia') {
        $code = isset($_POST['cod']) ? (trim($_POST['cod'])) : '';
        $code = $the_sanitaze->str_nohtml($code, 11);

        $code_writer = isset($_POST['cwr']) ? (trim($_POST['cwr'])) : '';
        $code_writer = $the_sanitaze->str_nohtml($code_writer, 11);

        $type_writer = isset($_POST['twr']) ? (trim($_POST['twr'])) : '';
        $type_writer = $the_sanitaze->int($type_writer);

        $comment = isset($_POST['msg']) ? (trim($_POST['msg'])) : '';
        $comment = $the_sanitaze->str_nohtml($comment);
        
    	if (!$error && empty($code)) { $error = TRUE; $txterror = $msg_error_default; }
    	if (!$error && empty($code_writer)) { $error = TRUE; $txterror = $msg_error_default; }
    	if (!$error && empty($comment)) { $error = TRUE; $txterror = $msg_error_default; }        
    }



    if ($error) {
        echo('ERROR:'.$txterror);
		return;
    } else {
        
        if ($ajax_action == 'like') {
            
            if ($type_visit == 0) {
                // is an user
                $idvisit = $page->db2->fetch_field("SELECT iduser FROM users WHERE code='".$code_visit."' LIMIT 1");
                if ($user->info->iduser != $idvisit) {
                    echo('ERROR:'.$msg_error_default);
                    return;
                }
                $iduser_action = $idvisit;
            }

            if ($type_visit == 1) {
                // is a page
                $thevisit = $page->db2->fetch("SELECT idpage, idcreator FROM pages WHERE code='".$code_visit."' LIMIT 1");
                $idvisit = $thevisit->idpage;
                $idcreator = $thevisit->idcreator;
                if ($user->info->iduser != $idcreator) {
                    echo('ERROR:'.$msg_error_default);
                    return;
                }
                $iduser_action = $idcreator;
            }

            $themedia = $page->db2->fetch("SELECT * FROM medias WHERE code='".$code."' LIMIT 1");
            if (!$themedia) {
                echo('ERROR:'.$msg_error_default);
                return;
            }
            $media_id = $themedia->idmedia;
            
            $codecontainer = $themedia->codecontainer;
            if ($themedia->posted_in == 2) {
                $codecontainer = $page->db2->fetch_field("SELECT code FROM posts WHERE idpost=".$themedia->idcontainer." LIMIT 1");
            }
            
            $infopost = $page->db2->fetch("SELECT idpost, idwriter, type_writer FROM posts WHERE code='".$codecontainer."' LIMIT 1");
            if (!$infopost) {
                echo('ERROR:'.$msg_error_default);
                return;
            } else {

                $idpost = $infopost->idpost;
                $idowner = $infopost->idwriter;
                if ($infopost->type_writer == 1) {
                    $idowner = $page->db2->fetch_field("SELECT idcreator FROM pages WHERE idpage=".$infopost->idwriter." LIMIT 1");
                }

                if ($status == 0) {
                
                    $page->db2->query("INSERT INTO likes SET iduser=".$idvisit.", typeuser=".$type_visit.", iditem=".$media_id.", typeitem=2, whendate='".time()."'");
                    $idlike = $page->db2->insert_id();
                    $page->db2->query("UPDATE medias SET numlikes=numlikes+1 WHERE idmedia=".$media_id.' LIMIT 1');

                    if ($idowner != $iduser_action) {
                        $page->db2->query("INSERT INTO notifications SET type_notif=14, result=".$idlike.", to_user=".$idowner.", from_user=".$iduser_action.", from_user_type=".$type_visit.", typeitem_notif=6, iditem_notif=".$media_id.", whendate='".time()."'");
                        $page->db2->query("UPDATE users SET num_notifications_global=num_notifications_global+1 WHERE iduser=".$idowner.' LIMIT 1');
                    }
                
                }

                if ($status == 1) {
                    
       				$page->db2->query("DELETE FROM likes WHERE iditem=".$media_id." AND typeitem=2 AND iduser=".$user->info->iduser." AND typeuser=".$type_visit);
                    $page->db2->query("UPDATE medias SET numlikes=numlikes-1 WHERE idmedia=".$media_id.' LIMIT 1');
                    
                    if ($idowner != $iduser_action) {
                        $page->db2->query("DELETE FROM notifications WHERE type_notif=6 AND to_user=".$idowner." AND from_user=".$iduser_action." AND from_user_type=".$type_visit." AND typeitem_notif=6 AND iditem_notif=".$media_id);
                        $nnotifications = $network->getNumNotificationsGlobals($idowner);
                        if ($nnotifications <= 0) $nnotifications = 0;
                        else $nnotifications = $nnotifications - 1;
                        $page->db2->query("UPDATE users SET num_notifications_global=".$nnotifications." WHERE iduser=".$idowner.' LIMIT 1');
                    }
                
                }

                $json_result = array('codemedia'=>$code);

            }

            echo(json_encode($json_result));
            return;  
            
        }

        if ($ajax_action == 'newcomment') {

            $themedia = $page->db2->fetch("SELECT * FROM medias WHERE code='".$code."' LIMIT 1");
            if (!$themedia) {
                echo('ERROR:'.$msg_error_default);
                return;
            }
            $media_id = $themedia->idmedia;
            
            $codecontainer = $themedia->codecontainer;
            if ($themedia->posted_in == 2) {
                $codecontainer = $page->db2->fetch_field("SELECT code FROM posts WHERE idpost=".$themedia->idcontainer." LIMIT 1");
            }

            $thepost = $page->db2->fetch("SELECT idpost, idwriter, type_writer FROM posts WHERE code='".$codecontainer."' LIMIT 1");
            if (!$thepost) {
                echo('ERROR:'.$msg_error_default);
                return;
            }

            $post_idpost = $thepost->idpost;
            $post_idwriter = $post_idowner = $thepost->idwriter;
            $post_type_writer = $thepost->type_writer;
            if ($post_type_writer == 1) {
                $post_idowner = $page->db2->fetch_field("SELECT idcreator FROM pages WHERE idpage=".$post_idwriter." LIMIT 1");
            }
   
            if ($type_writer == 0) {
                // this is a user
                $idwriter = $network->getUserByCode($code_writer, TRUE);
                if (!$idwriter && ($user->iduser != $idwriter)) {
                    echo('ERROR:'.$msg_error_default);
                    return;
                }
    
            } else {
                //this is a page
                $idownerpage = $network->userPageOwner($code_writer, TRUE);
                if ($user->iduser != $idownerpage) {
                    echo('ERROR:'.$msg_error_default);
                    return;
                }
                $idwriter = $network->getPageByCode($code_writer, TRUE);
            }

            $idmedia = 0;
            
            $page->db2->query("INSERT INTO comments SET idwriter=".$idwriter.", type_writer =".$type_writer.", iditem=".$media_id.", typeitem=1,  comment='".$comment."', typecomment=1, idattach=".$idmedia.", whendate='".time()."'", FALSE);
            
            $idcomment = $page->db2->insert_id();
            
            $page->db2->query("UPDATE medias SET numcomments=numcomments+1 WHERE idmedia=".$media_id." LIMIT 1");

            if ($idwriter != $post_idowner) {
                $page->db2->query("INSERT INTO notifications SET type_notif=15, result=".$idcomment.", to_user=".$post_idowner.", from_user=".$idwriter.", from_user_type=".$type_writer.", typeitem_notif=6, iditem_notif=".$media_id.", whendate='".time()."'");
                $page->db2->query("UPDATE users SET num_notifications_global=num_notifications_global+1 WHERE iduser=".$post_idowner.' LIMIT 1');
            }
            
            $comment_new = new comment($idcomment);

            $json_result = array('codepost'=>$code, 'newcomment'=>$comment_new->draw());
            echo(json_encode($json_result));
            return;  

        }
        
        
        if ($ajax_action == 'newstickercommentmedia') {

            $themedia = $page->db2->fetch("SELECT * FROM medias WHERE code='".$code."' LIMIT 1");
            if (!$themedia) {
                echo('ERROR:'.$msg_error_default);
                return;
            }
            $media_id = $themedia->idmedia;
            
            $codecontainer = $themedia->codecontainer;
            if ($themedia->posted_in == 2) {
                $codecontainer = $page->db2->fetch_field("SELECT code FROM posts WHERE idpost=".$themedia->idcontainer." LIMIT 1");
            }

            $thepost = $page->db2->fetch("SELECT idpost, idwriter, type_writer FROM posts WHERE code='".$codecontainer."' LIMIT 1");
            if (!$thepost) {
                echo('ERROR:'.$msg_error_default);
                return;
            }

            $post_idpost = $thepost->idpost;
            $post_idwriter = $post_idowner = $thepost->idwriter;
            $post_type_writer = $thepost->type_writer;
            if ($post_type_writer == 1) {
                $post_idowner = $page->db2->fetch_field("SELECT idcreator FROM pages WHERE idpage=".$post_idwriter." LIMIT 1");
            }
   
            if ($type_writer == 0) {
                // this is a user
                $idwriter = $network->getUserByCode($code_writer, TRUE);
                if (!$idwriter && ($user->iduser != $idwriter)) {
                    echo('ERROR:'.$msg_error_default);
                    return;
                }
    
            } else {
                //this is a page
                $idownerpage = $network->userPageOwner($code_writer, TRUE);
                if ($user->iduser != $idownerpage) {
                    echo('ERROR:'.$msg_error_default);
                    return;
                }
                $idwriter = $network->getPageByCode($code_writer, TRUE);
            }

            $page->db2->query("INSERT INTO comments SET idwriter=".$idwriter.", type_writer =".$type_writer.", iditem=".$media_id.", typeitem=1,  comment='".$comment."', typecomment=3, whendate='".time()."'", FALSE);
            
            $idcomment = $page->db2->insert_id();
            
            $page->db2->query("UPDATE medias SET numcomments=numcomments+1 WHERE idmedia=".$media_id." LIMIT 1");

            if ($idwriter != $post_idowner) {
                $page->db2->query("INSERT INTO notifications SET type_notif=15, result=".$idcomment.", to_user=".$post_idowner.", from_user=".$idwriter.", from_user_type=".$type_writer.", typeitem_notif=6, iditem_notif=".$media_id.", whendate='".time()."'");
                $page->db2->query("UPDATE users SET num_notifications_global=num_notifications_global+1 WHERE iduser=".$post_idowner.' LIMIT 1');
            }
            
            $comment_new = new comment($idcomment);

            $json_result = array('codepost'=>$code, 'newcomment'=>$comment_new->draw());
            echo(json_encode($json_result));
            return;  

        }

    }
?>