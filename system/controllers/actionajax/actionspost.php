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
    $page->loadLanguage('activity.php');

    $designer = new designer();
    $msg_error_default = $designer->boxAlert($page->lang('global_txt_information'), $page->lang('global_txt_error_ocurred'), $page->lang('global_txt_ok'));

    if (!$user->is_logged) {
        echo('ERROR:'.$msg_error_default);
        return;
    }
    
    $the_sanitaze = new sanitize(); // init sanitaze
    
    $error = FALSE;
    
    if ($ajax_action == 'delete') {
        $code = isset($_POST['cod']) ? (trim($_POST['cod'])) : '';
        $code = $the_sanitaze->str_nohtml($code, 11);
        
    	if (!$error && empty($code)) { $error = TRUE; $txterror = $msg_error_default; }
    }

    if ($ajax_action == 'update') {
        $code = isset($_POST['cod']) ? (trim($_POST['cod'])) : '';
        $code = $the_sanitaze->str_nohtml($code, 11);

        $message = isset($_POST['msg']) ? (trim($_POST['msg'])) : '';
        $message = $the_sanitaze->str_nohtml($message);
        
    	if (!$error && empty($code)) { $error = TRUE; $txterror = $msg_error_default; }
    	if (!$error && empty($message)) { $error = TRUE; $txterror = $msg_error_default; }
    }

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

    if ($ajax_action == 'share') {
        $code = isset($_POST['cod']) ? (trim($_POST['cod'])) : '';
        $code = $the_sanitaze->str_nohtml($code, 11);

        $for_who= isset($_POST['shfw']) ? (trim($_POST['shfw'])) : '';
        $for_who = $the_sanitaze->int($for_who);        

        $code_writer = isset($_POST['shcwr']) ? (trim($_POST['shcwr'])) : '';
        $code_writer = $the_sanitaze->str_nohtml($code_writer, 11);

        $type_writer = isset($_POST['shtw']) ? (trim($_POST['shtw'])) : '';
        $type_writer = $the_sanitaze->int($type_writer);

        $posted_in = isset($_POST['shpi']) ? (trim($_POST['shpi'])) : '';
        $posted_in = $the_sanitaze->int($posted_in);

        $code_wall = isset($_POST['shcwl']) ? (trim($_POST['shcwl'])) : '';
        $code_wall = $the_sanitaze->str_nohtml($code_wall, 11);

        $msg_share = isset($_POST['shmsg']) ? (trim($_POST['shmsg'])) : '';
        $msg_share = $the_sanitaze->str_nohtml($msg_share);
        
    	if (!$error && empty($code)) { $error = TRUE; $txterror = $msg_error_default; }
    	if (!$error && empty($code_writer)) { $error = TRUE; $txterror = $msg_error_default; }
    	if (!$error && empty($code_wall)) { $error = TRUE; $txterror = $msg_error_default; }
    }

    if ($ajax_action == 'newcomment') {
        $code = isset($_POST['codepost']) ? (trim($_POST['codepost'])) : '';
        $code = $the_sanitaze->str_nohtml($code, 11);

        $code_writer = isset($_POST['code_writer']) ? (trim($_POST['code_writer'])) : '';
        $code_writer = $the_sanitaze->str_nohtml($code_writer, 11);

        $type_writer = isset($_POST['type_writer']) ? (trim($_POST['type_writer'])) : '';
        $type_writer = $the_sanitaze->int($type_writer);

        $comment = isset($_POST['msgcomment']) ? (trim($_POST['msgcomment'])) : '';
        $comment = $the_sanitaze->str_nohtml($comment);
        
        $the_photo = $_FILES['attach-comment-'.$code];
        
    	if (!$error && empty($code)) { $error = TRUE; $txterror = $msg_error_default; }
    	if (!$error && empty($code_writer)) { $error = TRUE; $txterror = $msg_error_default; }
    	if (!$error && empty($comment) && empty($the_photo['name'])) { $error = TRUE; $txterror = $msg_error_default; }        
    }

    if ($ajax_action == 'deletecomment') {
        $idcomment= isset($_POST['idc']) ? (trim($_POST['idc'])) : -1;
        $idcomment = $the_sanitaze->int($idcomment);        
        
    	if (!$error && $idcomment == -1) { $error = TRUE; $txterror = $msg_error_default; }        
    }

    if ($ajax_action == 'newstickercomment') {
        $code = isset($_POST['codepost']) ? (trim($_POST['codepost'])) : '';
        $code = $the_sanitaze->str_nohtml($code, 11);

        $code_writer = isset($_POST['code_writer']) ? (trim($_POST['code_writer'])) : '';
        $code_writer = $the_sanitaze->str_nohtml($code_writer, 11);

        $type_writer = isset($_POST['type_writer']) ? (trim($_POST['type_writer'])) : '';
        $type_writer = $the_sanitaze->int($type_writer);

        $comment = isset($_POST['msgcomment']) ? (trim($_POST['msgcomment'])) : '';
        $comment = $the_sanitaze->str_nohtml($comment);
        
    	if (!$error && empty($code)) { $error = TRUE; $txterror = $msg_error_default; }
    	if (!$error && empty($code_writer)) { $error = TRUE; $txterror = $msg_error_default; }
    }
    
    if ($ajax_action == 'changetype') {
        $code = isset($_POST['cod']) ? (trim($_POST['cod'])) : '';
        $code = $the_sanitaze->str_nohtml($code, 11);

        $typep = isset($_POST['typ']) ? (trim($_POST['typ'])) : '';
        $typep = $the_sanitaze->int($typep);
        
    	if (!$error && empty($code)) { $error = TRUE; $txterror = $msg_error_default; }
    	if (!$error && ($typep < 0)) { $error = TRUE; $txterror = $msg_error_default; }
    }

    if ($ajax_action == 'report') {
        $code = isset($_POST['cod']) ? (trim($_POST['cod'])) : '';
        $code = $the_sanitaze->str_nohtml($code, 11);
        $reason = isset($_POST['reason']) ? (trim($_POST['reason'])) : '';
        $reason = $the_sanitaze->str_nohtml($reason);
        
    	if (!$error && empty($code)) { $error = TRUE; $txterror = $msg_error_default; }
    	if (!$error && empty($reason)) { $error = TRUE; $txterror = $msg_default; }        
    }
    
    if ($ajax_action == 'unreport') {
        $code = isset($_POST['cod']) ? (trim($_POST['cod'])) : '';
        $code = $the_sanitaze->str_nohtml($code, 11);
        
    	if (!$error && empty($code)) { $error = TRUE; $txterror = $msg_error_default; }
    }

    if ($ajax_action == 'hide') {
        $code = isset($_POST['cod']) ? (trim($_POST['cod'])) : '';
        $code = $the_sanitaze->str_nohtml($code, 11);
		
    	if (!$error && empty($code)) { $error = TRUE; $txterror = $msg_error_default; }
    }
	
    if ($ajax_action == 'saved' || $ajax_action == 'unsaved') {
        $code = isset($_POST['cod']) ? (trim($_POST['cod'])) : '';
        $code = $the_sanitaze->str_nohtml($code, 11);
		
    	if (!$error && empty($code)) { $error = TRUE; $txterror = $msg_error_default; }
    }

    if ($error) {
        echo('ERROR:'.$txterror);
        return;        
    } else {
        
        if ($ajax_action == 'delete') {
            
            $thepost = $page->db2->fetch("SELECT * FROM posts WHERE code='".$code."' LIMIT 1");
            if (!$thepost) {
                echo('ERROR:'.$txterror);
                return;
            } else {
                $the_post = new post(FALSE, $thepost);
                if ($the_post->isRemovable()) $the_post->deletePost();
            }
            
            $json_result = array('codepost'=>$code);
            echo(json_encode($json_result));
            return;  
            
        }

        if ($ajax_action == 'update') {
            
            $thepost = $page->db2->fetch("SELECT * FROM posts WHERE code='".$code."' LIMIT 1");
            if (!$thepost) {
                echo('ERROR:'.$msg_error_default);
                return;
            } else {
                $the_post = new post(FALSE, $thepost);
                if ($the_post->isEditable()) $the_post->updateMessage($message);
            }
            
            $message = $page->db2->fetch_field("SELECT message FROM posts WHERE code='".$code."' LIMIT 1");
            
            $json_result = array('codepost'=>$code, 'newmsg'=>nl2br(analyzeMessage($message)), 'newmsg_raw'=>$message);
            echo(json_encode($json_result));
            return;  
            
        }

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
            
            $infopost = $page->db2->fetch("SELECT idpost, idwriter, type_writer FROM posts WHERE code='".$code."' LIMIT 1");
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
                
                    $page->db2->query("INSERT INTO likes SET iduser=".$idvisit.", typeuser=".$type_visit.", iditem=".$idpost.", typeitem=0, whendate='".time()."'");
                    $idlike = $page->db2->insert_id();
                    $page->db2->query("UPDATE posts SET numlikes=numlikes+1 WHERE idpost=".$idpost.' LIMIT 1');

                    if ($idowner != $iduser_action) {
                        $page->db2->query("INSERT INTO notifications SET type_notif=2, result=".$idlike.", to_user=".$idowner.", from_user=".$iduser_action.", from_user_type=".$type_visit.", typeitem_notif=1, iditem_notif=".$idpost.", whendate='".time()."'");
                        $page->db2->query("UPDATE users SET num_notifications_global=num_notifications_global+1 WHERE iduser=".$idowner.' LIMIT 1');
                    }
                
                }

                if ($status == 1) {
                    
       				$page->db2->query("DELETE FROM likes WHERE iditem=".$idpost." AND typeitem=0 AND iduser=".$user->info->iduser." AND typeuser=".$type_visit);
                    $page->db2->query("UPDATE posts SET numlikes=numlikes-1 WHERE idpost=".$idpost.' LIMIT 1');
                    
                    if ($idowner != $iduser_action) {
                        $page->db2->query("DELETE FROM notifications WHERE type_notif=2 AND to_user=".$idowner." AND from_user=".$iduser_action." AND from_user_type=".$type_visit." AND typeitem_notif=1 AND iditem_notif=".$idpost);
                        $nnotifications = $network->getNumNotificationsGlobals($idowner);
                        if ($nnotifications <= 0) $nnotifications = 0;
                        else $nnotifications = $nnotifications - 1;
                        $page->db2->query("UPDATE users SET num_notifications_global=".$nnotifications." WHERE iduser=".$idowner.' LIMIT 1');
                    }
                
                }

                $json_result = array('codepost'=>$code);

            }

            echo(json_encode($json_result));
            return;  
            
        }

        if ($ajax_action == 'share') {
            
            $post_share = $page->db2->fetch("SELECT idpost, idwriter, type_writer, for_who FROM posts WHERE code='".$code."' LIMIT 1");
            if (!$post_share) {
                echo('ERROR:'.$msg_error_default);
                return;
            }
            $post_idpost = $post_share->idpost;
            $post_idwriter = $post_idowner = $post_share->idwriter;
            $post_type_writer = $post_share->type_writer;
            $post_forwho = $post_share->for_who;
            if ($post_type_writer == 1) {
                $post_idowner = $page->db2->fetch_field("SELECT idcreator FROM pages WHERE idpage=".$post_idwriter." LIMIT 1");
            }
            $post_moreinfo = $code.':'.$post_idpost.':'.$post_idwriter.':'.$post_type_writer.':'.$post_forwho;
        
            $codepost = codeUniqueInTable(11, 1, 'posts', 'code');
            $id_wall = $network->getIdWall($code_wall, $posted_in);
   
            if ($type_writer == 0) {
                // this is a user
                $idwriter = $network->getUserByCode($code_writer, TRUE);
                if (!$idwriter && ($user->info->iduser != $idwriter)) {
                    echo('ERROR:'.$msg_error_default);
                    return;
                }
    
            } else {
                //this is a page
                $idownerpage = $network->userPageOwner($code_writer, TRUE);
                if ($user->info->iduser != $idownerpage) {
                    echo('ERROR:'.$msg_error_default);
                    return;
                }
                $idwriter = $network->getPageByCode($code_writer, TRUE);
            }

            $mentioned = array();
            $hashtags = array();
            $num_hashtags = 0;
            if (!empty($msg_share)) {
            
                $mentioned = array();
                if( preg_match_all('/\@([a-zA-Z0-9\-_]{3,30})/u', $msg_share, $matches, PREG_PATTERN_ORDER) ) {
                    foreach($matches[1] as $unm) {
                        if( $usr = $network->getUserByUsername($unm) ) {
                            $mentioned[] = $usr->info->iduser;
                        }
                    }
                }
                $mentioned = array_unique($mentioned);
                
                $thehashtags = array();
        
                if( preg_match_all('/\#([\pL0-9_]{1,50})/iu', $msg_share, $matches, PREG_PATTERN_ORDER) ) {
                    foreach($matches[1] as $tg) {
                        $thehashtags[] = mb_strtolower(trim($tg));
                    }
                }
                $hashtags = $thehashtags;
                $num_hashtags = count( array_unique($thehashtags) );
    
            }

            $page->db2->query("INSERT INTO posts SET code='".$codepost."', idwriter=".$idwriter.", message='".$msg_share."', typepost=8, posted_in=".$posted_in.", id_wall=".$id_wall.", for_who=".$for_who.", post_date='".time()."', moreinfo='".$post_moreinfo."'", FALSE);
            
            $idpost = $page->db2->insert_id();
            
            
        //////////////////////////////
        // register in activities
        
        $activ_who_view = $for_who;
        if ($posted_in == 2) {
            $privacy_group = $page->db2->fetch_field("SELECT privacy FROM groups WHERE idgroup=".$id_wall." LIMIT 1");
            $activ_who_view = 2;
            if ($privacy_group == 0) $activ_who_view = 0;
        }
        
        $page->db2->query("INSERT INTO activities SET iduser=".$idwriter.", type_user=0, idwall=".$id_wall.", type_wall=".$posted_in.", action=1, type_activity=8, moreinfo='".$post_moreinfo."', where_was_made=0, code_where='".$codepost."', id_where=".$idpost.", code_result='".$codepost."', id_result=".$idpost.", who_view=".$activ_who_view.", status=1, whendate='".time()."'");
		
		$idactivity = $page->db2->insert_id();
		$page->db2->query("UPDATE posts SET idactivity=".$idactivity." WHERE idpost=".$idpost." LIMIT 1", FALSE);

        //////////////////////////////
            
            
            
            foreach ($mentioned as $idu) {
                $page->db2->query("INSERT INTO mentions SET typecontainer=0, idcontainer=".$idpost.", idwriter=".$idwriter.", type_writer=".$type_writer.", iduser_mentioned=".intval($idu), FALSE);
            }
            
            if (count($hashtags) > 0) {
                $post_tags_in_brackets = array();
                $unique_posttags = array();
                $unique_posttags = array_unique($hashtags);
                
                foreach ($unique_posttags as $tag) {
                    $post_tags_in_brackets[] = "('".$tag."', ".$idwriter.", ".$type_writer.", ".$idpost.", '".time()."')";
                }		
                
                $this->db2->query('INSERT INTO hashtags (hashtag, idwriter, type_writer, idpost, thedate ) VALUES '.implode( ',', $post_tags_in_brackets ), FALSE);
                unset($post_tags_in_brackets, $unique_posttags);
            }
            
            $page->db2->query("UPDATE posts SET numshares=numshares+1 WHERE idpost=".$post_idpost." LIMIT 1");
            
            if ($idwriter != $post_idowner) {
                $page->db2->query("INSERT INTO notifications SET type_notif=7, result=".$idpost.", to_user=".$post_idowner.", from_user=".$idwriter.", from_user_type=".$type_writer.", typeitem_notif=1, iditem_notif=".$post_idpost.", whendate='".time()."'");
                $page->db2->query("UPDATE users SET num_notifications_global=num_notifications_global+1 WHERE iduser=".$post_idowner.' LIMIT 1');
            }

            $json_result = array('codepost'=>$code, 'msgok'=>$page->lang('activity_share_action_ok'));
            echo(json_encode($json_result));
            return;  
            
        }
  
        if ($ajax_action == 'newcomment') {

            $thepost = $page->db2->fetch("SELECT idpost, idwriter, type_writer, posted_in, id_wall FROM posts WHERE code='".$code."' LIMIT 1");
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
                if (!$idwriter && ($user->info->iduser != $idwriter)) {
                    echo('ERROR:'.$msg_error_default);
                    return;
                }
    
            } else {
                //this is a page
                $idownerpage = $network->userPageOwner($code_writer, TRUE);
                if ($user->info->iduser != $idownerpage) {
                    echo('ERROR:'.$msg_error_default);
                    return;
                }
                $idwriter = $network->getPageByCode($code_writer, TRUE);
            }

            $idmedia = 0;
            if ($the_photo['name']) { 
                if ($the_photo['size'] > $K->FILE_SIZE_PHOTO || $the_photo['size'] == 0) {
                    echo('ERROR:'.$msg_error_default);
                    return;
                }
                
                $file_type = $the_photo['type'];
                if ($file_type=="image/jpeg" || $file_type=="image/gif" || $file_type=="image/png") {
                    switch ($file_type) {
                        case "image/jpeg":
                            $file_extension = '.jpg';
                            break;
                        case "image/gif":
                            $file_extension = '.gif';		
                            break;
                        case "image/png":
                            $file_extension = '.png';
                            break;
                    }
                    
                } else {
                    echo('ERROR:'.$msg_error_default);
                    return;
                }
                
                $code_media = codeUniqueInTable(11, 1, 'medias', 'code');
                $fname = $code_media.$file_extension;

                $the_pholder_original = $K->STORAGE_DIR_PHOTOS.'original/'.$code_writer;
                if (!file_exists($the_pholder_original)) {
                    mkdir($the_pholder_original, 0777, true);
                    $findex = fopen($the_pholder_original.'/index.html', "a");
                }

                $the_pholder_thumb1 = $K->STORAGE_DIR_PHOTOS.'thumb1/'.$code_writer;
                if (!file_exists($the_pholder_thumb1)) {
                    mkdir($the_pholder_thumb1, 0777, true);
                    $findex = fopen($the_pholder_thumb1.'/index.html', "a");
                }

                $the_pholder_thumb2 = $K->STORAGE_DIR_PHOTOS.'thumb2/'.$code_writer;
                if (!file_exists($the_pholder_thumb2)) {
                    mkdir($the_pholder_thumb2, 0777, true);
                    $findex = fopen($the_pholder_thumb2.'/index.html', "a");
                }

                $the_pholder_thumb3 = $K->STORAGE_DIR_PHOTOS.'thumb3/'.$code_writer;
                if (!file_exists($the_pholder_thumb3)) {
                    mkdir($the_pholder_thumb3, 0777, true);
                    $findex = fopen($the_pholder_thumb3.'/index.html', "a");
                }

                $the_pholder_thumb4 = $K->STORAGE_DIR_PHOTOS.'thumb4/'.$code_writer;
                if (!file_exists($the_pholder_thumb4)) {
                    mkdir($the_pholder_thumb4, 0777, true);
                    $findex = fopen($the_pholder_thumb4.'/index.html', "a");
                }
                
                move_uploaded_file($the_photo['tmp_name'], $the_pholder_original.'/'.$fname);

                $thumbnail = new imagen($the_pholder_original.'/'.$fname);

                $the_width = $thumbnail->getWidth();
                $the_height = $thumbnail->getHeight();

                if ($the_width > $K->WIDTH_PHOTO_1 || $the_height > $K->WIDTH_PHOTO_1) {
                    $thumbnail->resizeImage($K->WIDTH_PHOTO_1, $K->WIDTH_PHOTO_1, 'landscape');
                    $thumbnail->saveImage($the_pholder_thumb1.'/'.$fname);
                } else {
                    copy($the_pholder_original.'/'.$fname, $the_pholder_thumb1.'/'.$fname);
                }

                if ($the_width > $K->WIDTH_PHOTO_2 || $the_height > $K->WIDTH_PHOTO_2) {
                    $thumbnail = new imagen($the_pholder_original.'/'.$fname);
                    $thumbnail->resizeImage($K->WIDTH_PHOTO_2, $K->WIDTH_PHOTO_2, 'landscape');
                    $thumbnail->saveImage($the_pholder_thumb2.'/'.$fname);
                } else {
                    copy($the_pholder_original.'/'.$fname, $the_pholder_thumb2.'/'.$fname);
                }

                if ($the_width > $K->WIDTH_PHOTO_3 || $the_height > $K->WIDTH_PHOTO_3) {
                    $thumbnail = new imagen($the_pholder_original.'/'.$fname);
                    $thumbnail->resizeImage($K->WIDTH_PHOTO_3, $K->WIDTH_PHOTO_3, 'landscape');
                    $thumbnail->saveImage($the_pholder_thumb3.'/'.$fname);
                } else {
                    copy($the_pholder_original.'/'.$fname, $the_pholder_thumb3.'/'.$fname);
                }

                if ($the_width > $K->WIDTH_PHOTO_4 || $the_height > $K->WIDTH_PHOTO_4) {
                    $thumbnail = new imagen($the_pholder_original.'/'.$fname);
                    $thumbnail->resizeImage($K->WIDTH_PHOTO_4, $K->WIDTH_PHOTO_4, 'landscape');
                    $thumbnail->saveImage($the_pholder_thumb4.'/'.$fname);
                } else {
                    copy($the_pholder_original.'/'.$fname, $the_pholder_thumb4.'/'.$fname);
                }

                $page->db2->query("INSERT INTO medias SET code='".$code_media."', idwriter=".$idwriter.", type_writer=".$type_writer.", posted_in=1, namefile='".$fname."', folder='".$code_writer."', typemedia=0, width=".$the_width.", height=".$the_height, FALSE);
                $idmedia = $page->db2->insert_id();
                
            }
            
            $cadtypecomment = '';
            if ($idmedia != 0) $cadtypecomment = ' typecomment=2,';
            
            $page->db2->query("INSERT INTO comments SET idwriter=".$idwriter.", type_writer =".$type_writer.", iditem=".$post_idpost.", typeitem=0,  comment='".$comment."',".$cadtypecomment." idattach=".$idmedia.", whendate='".time()."'", FALSE);
            
            $idcomment = $page->db2->insert_id();


            //////////////////////////////
            // register in activities
            
            if ($type_writer == 0) {
                
                $info_activity = '';//$this->code.'|'.$this->idpost.'|'.$this->typepost.'|'.$this->posted_in.'|'.$this->id_wall;
                $page->db2->query("INSERT INTO activities SET iduser=".$idwriter.", type_user=".$type_writer.", idwall=".$thepost->id_wall.", type_wall=".$thepost->posted_in.", action=2, type_activity=31, moreinfo='".$info_activity."', where_was_made=0, code_where='".$code."', id_where=".$post_idpost.", code_result='', id_result=".$idcomment.", who_view=1, whendate='".time()."'");
                
            }
    
            //////////////////////////////

            
            if ($idmedia != 0) $page->db2->query("UPDATE medias SET idcontainer=".$idcomment." WHERE idmedia=".$idmedia);
            
            $page->db2->query("UPDATE posts SET numcomments=numcomments+1 WHERE idpost=".$post_idpost." LIMIT 1");

            if ($idwriter != $post_idowner) {
                $page->db2->query("INSERT INTO notifications SET type_notif=3, result=".$idcomment.", to_user=".$post_idowner.", from_user=".$idwriter.", from_user_type=".$type_writer.", typeitem_notif=1, iditem_notif=".$post_idpost.", whendate='".time()."'");
                $page->db2->query("UPDATE users SET num_notifications_global=num_notifications_global+1 WHERE iduser=".$post_idowner.' LIMIT 1');
            }
            
            $comment_new = new comment($idcomment);

            $json_result = array('codepost'=>$code, 'newcomment'=>$comment_new->draw());
            echo(json_encode($json_result));
            return;  

        }

        if ($ajax_action == 'deletecomment') {
            $the_comment = new comment($idcomment);
            $the_comment->deleteComment();

            echo('OK');
            return;            
        }


        if ($ajax_action == 'newstickercomment') {

            $thepost = $page->db2->fetch("SELECT idpost, idwriter, type_writer FROM posts WHERE code='".$code."' LIMIT 1");
            if (!$thepost) {
                echo('ERROR:'.$msg_error_default);
                return;
            }
            $post_idpost = $post_idowner = $thepost->idpost;
            $post_idwriter = $post_idowner = $thepost->idwriter;
            $post_type_writer = $thepost->type_writer;
            if ($post_type_writer == 1) {
                $post_idowner = $page->db2->fetch_field("SELECT idcreator FROM pages WHERE idpage=".$post_idwriter." LIMIT 1");
            }
   
            if ($type_writer == 0) {
                // this is a user
                $idwriter = $network->getUserByCode($code_writer, TRUE);
                if (!$idwriter && ($user->info->iduser != $idwriter)) {
                    echo('ERROR:'.$msg_error_default);
                    return;
                }
    
            } else {
                //this is a page
                $idownerpage = $network->userPageOwner($code_writer, TRUE);
                if ($user->info->iduser != $idownerpage) {
                    echo('ERROR:'.$msg_error_default);
                    return;
                }
                $idwriter = $network->getPageByCode($code_writer, TRUE);
            }

            $page->db2->query("INSERT INTO comments SET idwriter=".$idwriter.", type_writer =".$type_writer.", iditem=".$post_idpost.", typeitem=0,  comment='".$comment."', typecomment=3, whendate='".time()."'", FALSE);
            
            $idcomment = $page->db2->insert_id();
            
            $page->db2->query("UPDATE posts SET numcomments=numcomments+1 WHERE idpost=".$post_idpost." LIMIT 1");

            if ($idwriter != $post_idowner) {
                $page->db2->query("INSERT INTO notifications SET type_notif=3, result=".$idcomment.", to_user=".$post_idowner.", from_user=".$idwriter.", from_user_type=".$type_writer.", typeitem_notif=1, iditem_notif=".$post_idpost.", whendate='".time()."'");
                $page->db2->query("UPDATE users SET num_notifications_global=num_notifications_global+1 WHERE iduser=".$post_idowner.' LIMIT 1');
            }
            
            $comment_new = new comment($idcomment);

            $json_result = array('codepost'=>$code, 'newcomment'=>$comment_new->draw());
            echo(json_encode($json_result));
            return;  

        }
        
        if ($ajax_action == 'changetype') {
            
            $thepost = $page->db2->fetch("SELECT * FROM posts WHERE code='".$code."' LIMIT 1");
            if (!$thepost) {
                echo('ERROR:'.$msg_error_default);
                return;
            } else {
                $the_post = new post(FALSE, $thepost);
                if ($the_post->isEditable()) $the_post->updateTypePost($typep);
            }

            switch($typep) {
                case 0:
                    $icono_typepost = getImageTheme('typepost-public.png');
                    break;
                case 1:
                    $icono_typepost = getImageTheme('typepost-friends.png');
                    break;
                case 2:
                    $icono_typepost = getImageTheme('typepost-onlyme.png');
                    break;
            }

            $json_result = array('codepost'=>$code, 'theicon'=>$icono_typepost);
            echo(json_encode($json_result));
            return;
            
        }

        if ($ajax_action == 'report') {
            
            $idpost = $page->db2->fetch_field("SELECT idpost FROM posts WHERE code='".$code."' LIMIT 1");
        
            if (!$idpost) return FALSE;

            $page->db2->query("INSERT INTO reports SET typeitem=0, iditem=".$idpost.", idinformer=".$user->info->iduser.", reasons='".$reason."', whendate='".time()."'");


            $json_result = array('codepost'=>$code, 'html'=>$designer->boxAlert($page->lang('global_txt_information'), $page->lang('activity_alert_report_post_ok'), $page->lang('global_txt_ok')));
            echo(json_encode($json_result));
            return;
        }
        
        if ($ajax_action == 'unreport') {
            
            $idpostreported = $page->db2->fetch_field("SELECT idpost FROM posts WHERE code='".$code."' LIMIT 1");
            
            if (!$idpostreported) {
                echo('ERROR:'.$msg_error_default);
                return;  
            } else {
                $response = $page->db2->fetch_field("SELECT count(idreport) FROM reports WHERE typeitem=0 AND iditem=".$idpostreported." AND idinformer=".$user->info->iduser);
                if ($response == 0) {
                    echo('ERROR:'.$msg_error_default);
                    return;
                } else {
                    $page->db2->fetch_field("DELETE FROM reports WHERE typeitem=0 AND iditem=".$idpostreported." AND idinformer=".$user->info->iduser);
                    $json_result = array('codepost'=>$code, 'html'=>$designer->boxAlert($page->lang('global_txt_information'), $page->lang('activity_alert_ureport_post_ok'), $page->lang('global_txt_ok')));
                    echo(json_encode($json_result));
                    return;  
                }
                
            }

        }

        if ($ajax_action == 'hide') {
            
            $the_post = $page->db2->fetch("SELECT idpost, idactivity FROM posts WHERE code='".$code."' LIMIT 1");
            
            if (!$the_post) {
                echo('ERROR:'.$msg_error_default);
                return;  
            } else {
				
				$idpost = $the_post->idpost;
				$idactivity = $the_post->idactivity;
				
                $response = $page->db2->fetch_field("SELECT count(idhidden) FROM hiddens WHERE typeitem=0 AND iditem=".$idpost." AND iduser=".$user->info->iduser);

                if ($response > 0) {
                    echo('ERROR:'.$msg_error_default);
                    return;
                } else {
                    $page->db2->fetch_field("INSERT INTO hiddens SET typeitem=0, iditem=".$idpost.", idactivity=".$idactivity.", iduser=".$user->info->iduser.", whendate='".time()."'");
                    $json_result = array('codepost'=>$code, 'idactivity'=>$idactivity);
                    echo(json_encode($json_result));
                    return;  
                }
                
            }

        }
		
        if ($ajax_action == 'saved') {
            
            $the_post = $page->db2->fetch("SELECT idpost, idactivity FROM posts WHERE code='".$code."' LIMIT 1");
            
            if (!$the_post) {
                echo('ERROR:'.$msg_error_default);
                return;  
            } else {
				
				$idpost = $the_post->idpost;
				$idactivity = $the_post->idactivity;
				
                $response = $page->db2->fetch_field("SELECT count(id) FROM posts_saved WHERE idpost=".$idpost." AND iduser=".$user->info->iduser);

                if ($response > 0) {
                    echo('ERROR:'.$msg_error_default);
                    return;
                } else {
                    $page->db2->fetch_field("INSERT INTO posts_saved SET type_save=1, idpost=".$idpost.", iduser=".$user->info->iduser.", whendate='".time()."'");
                    $json_result = array('codepost'=>$code, 'idactivity'=>$idactivity, 'html'=>$designer->boxAlert($page->lang('global_txt_information'), $page->lang('activity_alert_save_post_ok'), $page->lang('global_txt_ok')));
                    echo(json_encode($json_result));
                    return;  
                }
                
            }

        }
		
        if ($ajax_action == 'unsaved') {
            
            $the_post = $page->db2->fetch("SELECT idpost, idactivity FROM posts WHERE code='".$code."' LIMIT 1");
            
            if (!$the_post) {
                echo('ERROR:'.$msg_error_default);
                return;  
            } else {
				
				$idpost = $the_post->idpost;
				$idactivity = $the_post->idactivity;
				
                $response = $page->db2->fetch_field("SELECT count(id) FROM posts_saved WHERE idpost=".$idpost." AND iduser=".$user->info->iduser);

                if ($response == 0) {
                    echo('ERROR:'.$msg_error_default);
                    return;
                } else {
                    $page->db2->query("DELETE FROM posts_saved WHERE idpost=".$idpost." AND iduser=".$user->info->iduser." LIMIT 1");
                    $json_result = array('codepost'=>$code, 'idactivity'=>$idactivity, 'html'=>$designer->boxAlert($page->lang('global_txt_information'), $page->lang('activity_alert_unsave_post_ok'), $page->lang('global_txt_ok')));
                    echo(json_encode($json_result));
                    return;  
                }
                
            }

        }


    }
?>