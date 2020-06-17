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

    global $D, $K;

    $user = & $GLOBALS['user'];
    $page = & $GLOBALS['page'];
    $network = & $GLOBALS['network'];
    
    $page->loadLanguage('dashboard.php');
    $page->loadLanguage('global.php');

    if (!$user->is_logged) {
        echo('ERROR:'.$page->lang('global_txt_no_session'));
        return;
    }

    $the_sanitaze = new sanitize(); // init sanitaze

    $error = FALSE;
    $txterror = '';

    if ($ajax_action == 'friendschatonline') { }
    
    if ($ajax_action == 'sendmessage') {
        $codeuser = isset($_POST['cdus']) ? (trim($_POST['cdus'])) : '';
        $codeuser = $the_sanitaze->str_nohtml($codeuser, 11);

        $message = isset($_POST['msg']) ? (trim($_POST['msg'])) : '';
        $message = $the_sanitaze->str_nohtml($message);

    	if (!$error && empty($codeuser)) { $error = TRUE; $txterror .= 'Error. '; }
       	if (!$error && empty($message)) { $error = TRUE; $txterror .= 'Error. '; }
    }
    
    if ($ajax_action == 'insertphotoinchat') {
        $codeuser = isset($_POST['cdus']) ? (trim($_POST['cdus'])) : '';
        $codeuser = $the_sanitaze->str_nohtml($codeuser, 11);

    	if (!$error && empty($codeuser)) { $error = TRUE; $txterror .= 'Error. '; }
    }
    
    if ($ajax_action == 'insertfileinchat') {
        $codeuser = isset($_POST['cdus']) ? (trim($_POST['cdus'])) : '';
        $codeuser = $the_sanitaze->str_nohtml($codeuser, 11);

    	if (!$error && empty($codeuser)) { $error = TRUE; $txterror .= 'Error. '; }
    }
    
    if ($ajax_action == 'sendsticker') {
        $codeuser = isset($_POST['cdus']) ? (trim($_POST['cdus'])) : '';
        $codeuser = $the_sanitaze->str_nohtml($codeuser, 11);

        $sticker = isset($_POST['stk']) ? (trim($_POST['stk'])) : '';
        $sticker = $the_sanitaze->str_nohtml($sticker);

    	if (!$error && empty($codeuser)) { $error = TRUE; $txterror .= 'Error. '; }
       	if (!$error && empty($sticker)) { $error = TRUE; $txterror .= 'Error. '; }        
    }

    if ($ajax_action == 'getmessagechat') {
        $codeuser = isset($_POST['cdus']) ? (trim($_POST['cdus'])) : '';
        $codeuser = $the_sanitaze->str_nohtml($codeuser, 11);

    	if (!$error && empty($codeuser)) { $error = TRUE; $txterror .= 'Error. '; }
    }
    
    if ($ajax_action == 'pulsechat') {
        $codeschat = isset($_POST['lbox']) ? (trim($_POST['lbox'])) : '';
        $codeschat = $the_sanitaze->str_nohtml($codeschat);

        if (empty($codeschat)) {
            $json_result = array('status'=>'OK', 'activities_chat'=>'', 'num_activities'=>0);
            echo(json_encode($json_result));
            return;         
        }
        
    }

    if ($ajax_action == 'chatalone') {
        $code = isset($_POST['code']) ? (trim($_POST['code'])) : '';
        $code = $the_sanitaze->str_nohtml($code);

        if (empty($code)) {
            $json_result = array('html_chat'=>'', 'num_activities'=>0);
            echo(json_encode($json_result));
            return;
        }
        
    }
    
    if ($error) {
        die();
    } else {
        if ($ajax_action == 'friendschatonline') {
            
            $html_userchatonline = '';
            $html_userchatbottom = '';
            
            $sql_theblockeds = 'SELECT iduserblocked FROM users_blocked WHERE iduser='.$user->info->iduser;

            if ($K->SIDEBAR_USERS == 1) {

                $page->db2->query('SELECT code, avatar, user_username, lastname, firstname, lastclick FROM users, friends WHERE active=1 AND chat=1 AND accepted_date<>0 AND ( (friend1=iduser AND friend2='.$user->info->iduser.') OR (friend2=iduser AND friend1='.$user->info->iduser.') ) AND ((friend1 NOT IN ('.$sql_theblockeds.')) AND (friend2 NOT IN ('.$sql_theblockeds.'))) ORDER BY lastclick DESC LIMIT 15');
            
            } else {
                
                $page->db2->query('SELECT code, avatar, user_username, lastname, firstname, lastclick FROM users WHERE iduser<>'.$user->info->iduser.' AND active=1 AND chat=1 AND iduser NOT IN ('.$sql_theblockeds.') ORDER BY lastclick DESC LIMIT 15');
                
            }

            
            while($obj = $page->db2->fetch_object()) {

                $D->cht_color_status = '';
                
                $D->lck = $obj->lastclick;
                $D->ago_time_user = '';
                if ($D->lck < (time() - 1 * 60)) {
                    $seconds = time() - $D->lck;
                    $D->_minutes = floor($seconds/60);
                    $D->_hours = floor($seconds/(60*60));
                    $D->_days = floor(($seconds/(60*60*24)));
                    
                    if ($D->_minutes > 59) {
                        if ($D->_hours > 23) {
                            if ($D->_days > 28) {
                                $D->cht_color_status = '#CED0D3';
                            } else {
                                $D->ago_time_user = $D->_days.$page->lang('global_txt_char_day');
                            }
                        } else {
                            $D->ago_time_user = $D->_hours.$page->lang('global_txt_char_hour');
                        }
                    } else {
                        $D->ago_time_user = $D->_minutes.$page->lang('global_txt_char_minute');
                    }
                    $D->is_online = FALSE;
                } else {
                    $D->is_online = TRUE;
                    $D->cht_color_status = '#42B72A';
                }
                
                if (empty($obj->avatar)) $obj->avatar = $K->DEFAULT_AVATAR_USER;
                $base_url = $K->STORAGE_URL_AVATARS.'min2/';
                $D->cht_avatar = $base_url.$obj->avatar;
                if ($obj->avatar != $K->DEFAULT_AVATAR_USER) $D->cht_avatar = $base_url.$obj->code.'/'.$obj->avatar;

                $D->cht_code = $obj->code;
                $D->cht_username = $obj->user_username;
                $D->cht_nameUser = stripslashes($obj->firstname).' '.stripslashes($obj->lastname);
                
                $html_userchatonline .= $page->load_template('ones/one-user-chat-online.php',FALSE);
                $html_userchatbottom .= $page->load_template('ones/one-user-chat-bottom.php',FALSE);
            }
            if (empty($html_userchatonline)) {
                $html_userchatonline = $page->load_template('_empty-chat-max.php',FALSE);
            }

            $json_result = array('html_user_chat'=>$html_userchatonline, 'html_user_chat_bottom'=>$html_userchatbottom);
            
            echo(json_encode($json_result));
            return;         

        }

        if ($ajax_action == 'sendmessage') {

            $idfriend = $network->friendAllowChat($codeuser);
            
            if (!$idfriend) {
                $json_result = array('code'=>$codeuser, 'newmessagechat'=>$page->lang('global_chat_msg_chat_mute'));
                echo(json_encode($json_result));
                return;  
            }
            
            $the_talk = $page->db2->fetch('SELECT idtalk FROM talks_users WHERE iduser IN ('.$user->id.','.$idfriend.') GROUP BY idtalk HAVING COUNT(idtalk) = 2');
            
            $numtalks = count($the_talk);
            
            if ($numtalks == 0) {
                $page->db2->query("INSERT INTO talks SET idlastmessage=0, idcreator=".$user->id.", date_creation='".time()."'");
                $idtalk = $page->db2->insert_id();
                $page->db2->query("INSERT INTO talks_users SET idtalk=".$idtalk.", iduser=".$user->id.", viewed=1");
                $page->db2->query("INSERT INTO talks_users SET idtalk=".$idtalk.", iduser=".$idfriend);
            } else {
                $idtalk = $the_talk->idtalk;
                $page->db2->query("UPDATE talks_users SET viewed=1, deleted=0 WHERE idtalk=".$idtalk." AND iduser=".$user->id);
                $page->db2->query("UPDATE talks_users SET viewed=0 WHERE idtalk=".$idtalk." AND iduser=".$idfriend);
            }

            $page->db2->query("INSERT INTO talks_messages SET idtalk=".$idtalk.", iduser=".$user->id.", message='".$message."', whendate='".time()."'");
            $idmessage = $page->db2->insert_id();
            
            $page->db2->query("UPDATE talks SET idlastmessage=".$idmessage." WHERE idtalk=".$idtalk);
            $page->db2->query("UPDATE talks_users SET last_message_view=".$idmessage." WHERE idtalk=".$idtalk." AND iduser=".$user->id);
            
            $page->db2->query("UPDATE users SET num_notifications_messages=num_notifications_messages+1 WHERE iduser=".$idfriend);
            
            
            $D->chat_msgchatnew_me = analyzeMessageChat($message);
            
            $D->chat_txt_whendate = '<span class="thelivestamp" data-locale="'.$K->LANGUAGE.'" data-livestamp="'.time().'"></span>';
            
            $D->who_write_in_chat = 1;
            $D->type_message_in_chat = 1;
            
            $msgchat = $page->load_template('ones/one-msgchat.php',FALSE);

            $json_result = array('code'=>$codeuser, 'newmessagechat'=>$msgchat);
            
            echo(json_encode($json_result));
            return;         
            
        }

        if ($ajax_action == 'insertphotoinchat') {
            
            $idfriend = $network->friendAllowChat($codeuser);
            if (!$idfriend) {
                $json_result = array('code'=>$codeuser, 'newmessagechat'=>$page->lang('global_chat_msg_chat_mute'));
                echo(json_encode($json_result));
                return;  
            }
            
            if (!is_uploaded_file($_FILES['photo_chat']['tmp_name'])) {
                $designer = new designer();
                $msgerror = $designer->boxAlert($page->lang('global_chat_error_photo_title'), $page->lang('global_chat_error_photo_failed'), $page->lang('global_txt_ok'));
                echo('ERROR:'.$msgerror);
                return;
            }
            
            if ($_FILES['photo_chat']['size'] == 0) {
                $designer = new designer();
                $msgerror = $designer->boxAlert($page->lang('global_chat_error_photo_title'), $page->lang('global_chat_error_photo_failed'), $page->lang('global_txt_ok'));
                echo('ERROR:'.$msgerror);
                return;
            }
            
            if ($_FILES['photo_chat']['size'] > $K->FILE_SIZE_PHOTO_MESSAGES){
                $designer = new designer();
                $msgerror = $designer->boxAlert($page->lang('global_chat_error_photo_title'), $page->lang('global_chat_error_photo_large'), $page->lang('global_txt_ok'));
                echo('ERROR:'.$msgerror);
                return;
            }

            $file_type = $_FILES['photo_chat']['type'];
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
                $designer = new designer();
                $msgerror = $designer->boxAlert($page->lang('global_chat_error_photo_title'), $page->lang('global_chat_error_photo_wrong'), $page->lang('global_txt_ok'));
                echo('ERROR:'.$msgerror);
                return;
            }

            
            $the_talk = $page->db2->fetch('SELECT idtalk FROM talks_users WHERE iduser IN ('.$user->id.','.$idfriend.') GROUP BY idtalk HAVING COUNT(idtalk) = 2');
            
            $numtalks = count($the_talk);
            
            if ($numtalks == 0) {
                $page->db2->query("INSERT INTO talks SET idlastmessage=0, idcreator=".$user->id.", date_creation='".time()."'");
                $idtalk = $page->db2->insert_id();
                $page->db2->query("INSERT INTO talks_users SET idtalk=".$idtalk.", iduser=".$user->id.", viewed=1");
                $page->db2->query("INSERT INTO talks_users SET idtalk=".$idtalk.", iduser=".$idfriend);
            } else {
                $idtalk = $the_talk->idtalk;
                $page->db2->query("UPDATE talks_users SET viewed=1, deleted=0 WHERE idtalk=".$idtalk." AND iduser=".$user->id);
                $page->db2->query("UPDATE talks_users SET viewed=0 WHERE idtalk=".$idtalk." AND iduser=".$idfriend);
            }
            
            $nameattach = codeUniqueInTable(22, 1, 'talks_messages', 'nameattach').$file_extension;

            $page->db2->query("INSERT INTO talks_messages SET idtalk=".$idtalk.", iduser=".$user->id.", message='Photo', typemessage=2, nameattach='".$nameattach."', whendate='".time()."'");
            $idmessage = $page->db2->insert_id();
            
            $page->db2->query("UPDATE talks SET idlastmessage=".$idmessage." WHERE idtalk=".$idtalk);
            $page->db2->query("UPDATE talks_users SET last_message_view=".$idmessage." WHERE idtalk=".$idtalk." AND iduser=".$user->id);
            
            $page->db2->query("UPDATE users SET num_notifications_messages=num_notifications_messages+1 WHERE iduser=".$idfriend);
            
            
            $the_pholder_photos_msg = $K->STORAGE_DIR_PHOTOS_MESSAGES;
            move_uploaded_file($_FILES['photo_chat']['tmp_name'], $the_pholder_photos_msg.$nameattach);
            
            $thumbnail = new imagen($the_pholder_photos_msg.$nameattach);
            $thumbnail->resizeImage(175, 175, 'crop');
            $thumbnail->saveImage($the_pholder_photos_msg.'min/'.$nameattach);

            $D->chat_msgchatnew_me = $K->STORAGE_URL_PHOTOS_MESSAGES.'min/'.$nameattach;
            $D->chat_photo_max = $K->STORAGE_URL_PHOTOS_MESSAGES.$nameattach;
            
            $D->chat_txt_whendate = '<span class="thelivestamp" data-locale="'.$K->LANGUAGE.'" data-livestamp="'.time().'"></span>';
            
            $D->who_write_in_chat = 1;
            $D->type_message_in_chat = 2;
            
            $msgchat = $page->load_template('ones/one-msgchat.php',FALSE);

            $json_result = array('code'=>$codeuser, 'newmessagechat'=>$msgchat);
            
            echo(json_encode($json_result));
            return;         
            
        }
        
        if ($ajax_action == 'insertfileinchat') {
            
            $idfriend = $network->friendAllowChat($codeuser);
            if (!$idfriend) {
                $json_result = array('code'=>$codeuser, 'newmessagechat'=>$page->lang('global_chat_msg_chat_mute'));
                echo(json_encode($json_result));
                return;  
            }
            
            if (!is_uploaded_file($_FILES['attach_chat']['tmp_name'])) {
                $designer = new designer();
                $msgerror = $designer->boxAlert($page->lang('global_chat_error_file_title'), $page->lang('global_chat_error_file_failed'), $page->lang('global_txt_ok'));
                echo('ERROR:'.$msgerror);
                return;
            }
            
            if ($_FILES['attach_chat']['size'] == 0) {
                $designer = new designer();
                $msgerror = $designer->boxAlert($page->lang('global_chat_error_file_title'), $page->lang('global_chat_error_file_failed'), $page->lang('global_txt_ok'));
                echo('ERROR:'.$msgerror);
                return;
            }
            
            if ($_FILES['attach_chat']['size'] > $K->FILE_SIZE_ATTACH_MESSAGES){
                $designer = new designer();
                $msgerror = $designer->boxAlert($page->lang('global_chat_error_file_title'), $page->lang('global_chat_error_file_large'), $page->lang('global_txt_ok'));
                echo('ERROR:'.$msgerror);
                return;
            }
            
            $namefile = $_FILES['attach_chat']['name'];
            $trozos = explode(".", $namefile);
            $extens = end($trozos);
            
            $badext = explode(',', $K->BAD_EXT_FILES);
            if (in_array($extens, $badext)) {
                $designer = new designer();
                $msgerror = $designer->boxAlert($page->lang('global_chat_error_file_title'), $page->lang('global_chat_error_file_wrong'), $page->lang('global_txt_ok'));
                echo('ERROR:'.$msgerror);
                return;
            }
            
            
            $the_talk = $page->db2->fetch('SELECT idtalk FROM talks_users WHERE iduser IN ('.$user->id.','.$idfriend.') GROUP BY idtalk HAVING COUNT(idtalk) = 2');
            
            $numtalks = count($the_talk);
            
            if ($numtalks == 0) {
                $page->db2->query("INSERT INTO talks SET idlastmessage=0, idcreator=".$user->id.", date_creation='".time()."'");
                $idtalk = $page->db2->insert_id();
                $page->db2->query("INSERT INTO talks_users SET idtalk=".$idtalk.", iduser=".$user->id.", viewed=1");
                $page->db2->query("INSERT INTO talks_users SET idtalk=".$idtalk.", iduser=".$idfriend);
            } else {
                $idtalk = $the_talk->idtalk;
                $page->db2->query("UPDATE talks_users SET viewed=1, deleted=0 WHERE idtalk=".$idtalk." AND iduser=".$user->id);
                $page->db2->query("UPDATE talks_users SET viewed=0 WHERE idtalk=".$idtalk." AND iduser=".$idfriend);
            }
            
            $nameattach = codeUniqueInTable(25, 1, 'talks_messages', 'nameattach');//.'.'.$extens;

            $page->db2->query("INSERT INTO talks_messages SET idtalk=".$idtalk.", iduser=".$user->id.", message='".$namefile."', typemessage=3, nameattach='".$nameattach."', whendate='".time()."'");
            $idmessage = $page->db2->insert_id();
            
            $page->db2->query("UPDATE talks SET idlastmessage=".$idmessage." WHERE idtalk=".$idtalk);
            $page->db2->query("UPDATE talks_users SET last_message_view=".$idmessage." WHERE idtalk=".$idtalk." AND iduser=".$user->id);
            $page->db2->query("UPDATE users SET num_notifications_messages=num_notifications_messages+1 WHERE iduser=".$idfriend);
            
            $the_pholder_files_msg = $K->STORAGE_DIR_ATTACH_MESSAGES;
            move_uploaded_file($_FILES['attach_chat']['tmp_name'], $the_pholder_files_msg.$nameattach);
            
            //$D->chat_msgchatnew_me = cutStringCenter($namefile, $K->NUM_CHARS_NAME_FILE);
            

                                $D->chat_msgchatnew_me = cutStringCenter($namefile, $K->NUM_CHARS_NAME_FILE);
                                $thenamefile = sanitizeNameFile($namefile);


            $D->chat_file_url_dwl = $K->SITE_URL.'dwf/f:'.$nameattach.'/o:'.$thenamefile;
            
            $D->chat_txt_whendate = '<span class="thelivestamp" data-locale="'.$K->LANGUAGE.'" data-livestamp="'.time().'"></span>';
            
            $D->who_write_in_chat = 1;
            $D->type_message_in_chat = 3;
            
            $msgchat = $page->load_template('ones/one-msgchat.php',FALSE);

            $json_result = array('code'=>$codeuser, 'newmessagechat'=>$msgchat);
            
            echo(json_encode($json_result));
            return;         
            
        }

        if ($ajax_action == 'sendsticker') {
            
            $idfriend = $network->friendAllowChat($codeuser);
            if (!$idfriend) {
                $json_result = array('code'=>$codeuser, 'newmessagechat'=>$page->lang('global_chat_msg_chat_mute'));
                echo(json_encode($json_result));
                return;  
            }
            
            $the_talk = $page->db2->fetch('SELECT idtalk FROM talks_users WHERE iduser IN ('.$user->id.','.$idfriend.') GROUP BY idtalk HAVING COUNT(idtalk) = 2');
            
            $numtalks = count($the_talk);
            
            if ($numtalks == 0) {
                $page->db2->query("INSERT INTO talks SET idlastmessage=0, idcreator=".$user->id.", date_creation='".time()."'");
                $idtalk = $page->db2->insert_id();
                $page->db2->query("INSERT INTO talks_users SET idtalk=".$idtalk.", iduser=".$user->id.", viewed=1");
                $page->db2->query("INSERT INTO talks_users SET idtalk=".$idtalk.", iduser=".$idfriend);
            } else {
                $idtalk = $the_talk->idtalk;
                $page->db2->query("UPDATE talks_users SET viewed=1, deleted=0 WHERE idtalk=".$idtalk." AND iduser=".$user->id);
                $page->db2->query("UPDATE talks_users SET viewed=0 WHERE idtalk=".$idtalk." AND iduser=".$idfriend);
            }

            $page->db2->query("INSERT INTO talks_messages SET idtalk=".$idtalk.", iduser=".$user->id.", message='".$sticker."', typemessage=4, whendate='".time()."'");
            $idmessage = $page->db2->insert_id();
            
            $page->db2->query("UPDATE talks SET idlastmessage=".$idmessage." WHERE idtalk=".$idtalk);
            $page->db2->query("UPDATE talks_users SET last_message_view=".$idmessage." WHERE idtalk=".$idtalk." AND iduser=".$user->id);
            
            $page->db2->query("UPDATE users SET num_notifications_messages=num_notifications_messages+1 WHERE iduser=".$idfriend);
            
            $D->the_sticker = $sticker;
            
            $D->chat_txt_whendate = '<span class="thelivestamp" data-locale="'.$K->LANGUAGE.'" data-livestamp="'.time().'"></span>';
            
            $D->who_write_in_chat = 1;
            $D->type_message_in_chat = 4;
            
            $msgchat = $page->load_template('ones/one-msgchat.php',FALSE);

            $json_result = array('code'=>$codeuser, 'newmessagechat'=>$msgchat);
            
            echo(json_encode($json_result));
            return;         
            
        }

        if ($ajax_action == 'getmessagechat') {
            
            $idfriend = $network->getUserByCode($codeuser, TRUE);
            
            $the_talk = $page->db2->fetch('SELECT idtalk FROM talks_users WHERE iduser IN ('.$user->id.','.$idfriend.') GROUP BY idtalk HAVING COUNT(idtalk) = 2');
            
            $numtalks = count($the_talk);
            
            $html_messages_in_chat = '';
            
            if ($numtalks > 0) {
            
                $idtalk = $the_talk->idtalk;
                
                $last_message_talk = $page->db2->fetch_field('SELECT idlastmessage FROM talks WHERE idtalk='.$idtalk.' LIMIT 1');
                
                $the_messages = $page->db2->fetch_all("SELECT * FROM ( SELECT talks_messages.idmessage, talks_messages.message, talks_messages.typemessage, talks_messages.nameattach, talks_messages.whendate, users.iduser, users.firstname, users.lastname, users.user_username FROM talks_messages INNER JOIN users ON talks_messages.iduser = users.iduser WHERE talks_messages.idtalk = ".$idtalk." ORDER BY talks_messages.idmessage DESC LIMIT 0,10 ) messages ORDER BY messages.idmessage ASC");
                
                if (count($the_messages) > 0) {
                    
                    $id_last_message_view = $page->db2->fetch_field('SELECT last_message_view FROM talks_users WHERE iduser='.$user->id.' AND idtalk='.$idtalk.' LIMIT 1');
                    
                    $num_messages_unread = 0;
                    
                    foreach ($the_messages as $onemessage) {

                        $D->chat_txt_whendate = '<span class="thelivestamp" data-locale="'.$K->LANGUAGE.'" data-livestamp="'.$onemessage->whendate.'"></span>';
                        
                        if ($onemessage->iduser == $user->id) $D->who_write_in_chat = 1; //me
                        else {
                            $D->who_write_in_chat = 2; //friend
                            if ($onemessage->idmessage > $id_last_message_view) $num_messages_unread++;
                            $D->chat_user_name = stripslashes($onemessage->firstname).' '.stripslashes($onemessage->lastname);
                            $D->chat_user_username = $onemessage->user_username;
                        }
                        
                        $D->type_message_in_chat = $onemessage->typemessage;
                        
                        switch ($D->type_message_in_chat) {
                            case 1:
                                $D->chat_msgchatnew_me = analyzeMessageChat($onemessage->message);
                                break;
                            case 2:
                                $D->chat_msgchatnew_me = $K->STORAGE_URL_PHOTOS_MESSAGES.'min/'.$onemessage->nameattach;
                                $D->chat_photo_max = $K->STORAGE_URL_PHOTOS_MESSAGES.$onemessage->nameattach;
                                break;
                            case 3:
                                $newnamefile = stripslashes($onemessage->message);
                                $D->chat_msgchatnew_me = cutStringCenter($newnamefile, $K->NUM_CHARS_NAME_FILE);
                                $thenamefile = sanitizeNameFile($newnamefile);
                                $D->chat_file_url_dwl = $K->SITE_URL.'dwf/f:'.$onemessage->nameattach.'/o:'.$thenamefile;
                                break;
                            case 4:
                                $D->the_sticker = $onemessage->message;
                                break;                            
                        }

                        $html_messages_in_chat .= $page->load_template('ones/one-msgchat.php',FALSE);
                    }

                    if ($num_messages_unread > $user->info->num_notifications_messages) $num_messages_unread = $user->info->num_notifications_messages;
                    $page->db2->query('UPDATE users SET num_notifications_messages=num_notifications_messages-'.$num_messages_unread.' WHERE iduser='.$user->id.' LIMIT 1');   

                }
                
                $page->db2->query('UPDATE talks_users SET viewed=1, last_message_view='.$last_message_talk.' WHERE iduser='.$user->id.' AND idtalk='.$idtalk);

            }

            $json_result = array('code'=>$codeuser, 'themessageschat'=>$html_messages_in_chat);
            
            echo(json_encode($json_result));
            return;         
                        
        }

        if ($ajax_action == 'pulsechat') {
            $array_return = array();
            $codeschat = '|' . $codeschat . '|';
            $boxes = explode('||', $codeschat);
            $boxes = array_filter($boxes, "strlen");
            $num_activities = 0;
            

            foreach ($boxes as $onebox) {
                
                $idfriend = $network->getUserByCode($onebox, TRUE);
                $the_talk = $page->db2->fetch('SELECT idtalk FROM talks_users WHERE iduser IN ('.$user->id.','.$idfriend.') GROUP BY idtalk HAVING COUNT(idtalk) = 2');

                if (count($the_talk) > 0) {
                    $msg_return = '';
                
                    $lastmessage_talk = $page->db2->fetch_field('SELECT idlastmessage FROM talks WHERE idtalk='.$the_talk->idtalk.' LIMIT 1');
                    
                    $lastmessageview_me = $page->db2->fetch_field("SELECT last_message_view FROM talks_users WHERE idtalk=".$the_talk->idtalk." AND iduser=".$user->id." LIMIT 1");
                    
                    $page->db2->query("UPDATE talks_users SET viewed=1, last_message_view=".$lastmessage_talk." WHERE idtalk=".$the_talk->idtalk." AND iduser=".$user->id);

                    $the_friend = $page->db2->fetch("SELECT firstname, lastname, user_username FROM users WHERE iduser=".$idfriend);                    
                    
                    $the_messages = $page->db2->fetch_all("SELECT * FROM ( SELECT talks_messages.idmessage, talks_messages.message, talks_messages.typemessage, talks_messages.nameattach, talks_messages.whendate, users.iduser, users.firstname, users.lastname, users.user_username FROM talks_messages INNER JOIN users ON talks_messages.iduser = users.iduser WHERE talks_messages.idtalk = ".$the_talk->idtalk." AND talks_messages.idmessage>".$lastmessageview_me." ORDER BY talks_messages.idmessage DESC) messages ORDER BY messages.idmessage ASC");

                    foreach ($the_messages as $onemessage) {
                        
                        $D->chat_txt_whendate = '<span class="thelivestamp" data-locale="'.$K->LANGUAGE.'" data-livestamp="'.$onemessage->whendate.'"></span>';
                        $D->chat_user_name = stripslashes($the_friend->firstname).' '.stripslashes($the_friend->lastname);
                        $D->chat_user_username = $the_friend->user_username;
                        
                        $D->who_write_in_chat = 2; //friend
                         
                        $D->type_message_in_chat = $onemessage->typemessage;
                        
                        switch ($D->type_message_in_chat) {
                            case 1:
                                $D->chat_msgchatnew_me = analyzeMessageChat($onemessage->message);
                                break;
                            case 2:
                                $D->chat_msgchatnew_me = $K->STORAGE_URL_PHOTOS_MESSAGES.'min/'.$onemessage->nameattach;
                                $D->chat_photo_max = $K->STORAGE_URL_PHOTOS_MESSAGES.$onemessage->nameattach;
                                break;
                            case 3:
                                $newnamefile = stripslashes($onemessage->message);
                                $D->chat_msgchatnew_me = cutStringCenter($newnamefile, $K->NUM_CHARS_NAME_FILE);
                                $thenamefile = sanitizeNameFile($newnamefile);
                                $D->chat_file_url_dwl = $K->SITE_URL.'dwf/f:'.$onemessage->nameattach.'/o:'.$thenamefile;
                                break;
                            case 4:
                                $D->the_sticker = $onemessage->message;
                                break;                            
                        }

                        $msg_return .= $page->load_template('ones/one-msgchat.php',FALSE);
                        
                        $num_activities ++;

                    }

                    $array_return[$num_activities]['code'] = $onebox;
                    $array_return[$num_activities]['html'] = $msg_return;
                    
                }
                
            }

            $json_result = array('activities_chat'=>json_encode($array_return), 'num_activities'=>$num_activities+1);
            
            echo(json_encode($json_result));
            return;
            
        }


        if ($ajax_action == 'chatalone') {
            $array_return = array();
            $codeuser = $code;
            $num_activities = 0;
            
            $idfriend = $network->getUserByCode($codeuser, TRUE);
            $the_talk = $page->db2->fetch('SELECT idtalk FROM talks_users WHERE iduser IN ('.$user->id.','.$idfriend.') GROUP BY idtalk HAVING COUNT(idtalk) = 2');

            $msg_return = '';

            if (count($the_talk) > 0) {
            
                $lastmessage_talk = $page->db2->fetch_field('SELECT idlastmessage FROM talks WHERE idtalk='.$the_talk->idtalk.' LIMIT 1');
                
                $lastmessageview_me = $page->db2->fetch_field("SELECT last_message_view FROM talks_users WHERE idtalk=".$the_talk->idtalk." AND iduser=".$user->id." LIMIT 1");
                
                $page->db2->query("UPDATE talks_users SET viewed=1, last_message_view=".$lastmessage_talk." WHERE idtalk=".$the_talk->idtalk." AND iduser=".$user->id);

                $the_friend = $page->db2->fetch("SELECT firstname, lastname, user_username FROM users WHERE iduser=".$idfriend);                    
                
                $the_messages = $page->db2->fetch_all("SELECT * FROM ( SELECT talks_messages.idmessage, talks_messages.message, talks_messages.typemessage, talks_messages.nameattach, talks_messages.whendate, users.iduser, users.firstname, users.lastname, users.user_username FROM talks_messages INNER JOIN users ON talks_messages.iduser = users.iduser WHERE talks_messages.idtalk = ".$the_talk->idtalk." AND talks_messages.idmessage>".$lastmessageview_me." ORDER BY talks_messages.idmessage DESC) messages ORDER BY messages.idmessage ASC");

                foreach ($the_messages as $onemessage) {

                        $D->chat_txt_whendate = '<span class="thelivestamp" data-locale="'.$K->LANGUAGE.'" data-livestamp="'.$onemessage->whendate.'"></span>';
                        $D->chat_user_name = stripslashes($the_friend->firstname).' '.stripslashes($the_friend->lastname);
                        $D->chat_user_username = $the_friend->user_username;
                        
                        $D->who_write_in_chat = 2; //friend
                         
                        $D->type_message_in_chat = $onemessage->typemessage;
                        
                        switch ($D->type_message_in_chat) {
                            case 1:
                                $D->chat_msgchatnew_me = analyzeMessageChat($onemessage->message);
                                break;
                            case 2:
                                $D->chat_msgchatnew_me = $K->STORAGE_URL_PHOTOS_MESSAGES.'min/'.$onemessage->nameattach;
                                $D->chat_photo_max = $K->STORAGE_URL_PHOTOS_MESSAGES.$onemessage->nameattach;
                                break;
                            case 3:
                                $newnamefile = stripslashes($onemessage->message);
                                $D->chat_msgchatnew_me = cutStringCenter($newnamefile, $K->NUM_CHARS_NAME_FILE);
                                $thenamefile = sanitizeNameFile($newnamefile);
                                $D->chat_file_url_dwl = $K->SITE_URL.'dwf/f:'.$onemessage->nameattach.'/o:'.$thenamefile;
                                break;
                            case 4:
                                $D->the_sticker = $onemessage->message;
                                break;                            
                        }

                        $msg_return .= $page->load_template('ones/one-msgchat.php',FALSE);
                        
                        $num_activities ++;

                }
                
            }

            $json_result = array('html_chat'=>$msg_return, 'num_activities'=>$num_activities);
            
            echo(json_encode($json_result));
            return;
            
        }


    }
?>