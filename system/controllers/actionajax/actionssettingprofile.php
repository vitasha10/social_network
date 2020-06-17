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

    $page->loadLanguage('global.php');
    $page->loadLanguage('settings.php');
    
    $designer = new designer();

    if (!$user->is_logged) { 
        echo('ERROR:'.$page->lang('global_txt_no_session'));
        return;
    }
  
    $the_sanitaze = new sanitize(); // init sanitaze
    
    $error = FALSE;
    
    $txterror = '';
    
    if ($ajax_action == 'positionbgcover') {

        $posibg = isset($_POST['posi']) ? (trim($_POST['posi'])) : 0;
        $posibg = $the_sanitaze->int($posibg);

        $codeprofile = isset($_POST['copr']) ? (trim($_POST['copr'])) : '';
        $codeprofile = $the_sanitaze->str_nohtml($codeprofile, 11);

        $type_profile = isset($_POST['typr']) ? (trim($_POST['typr'])) : 0;
        $type_profile = $the_sanitaze->int($type_profile);

        if (!$error && empty($codeprofile)) { $error = TRUE; $txterror .= 'Error. '; }
        if (!$error && $type_profile < 0) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'removecover') {

        $codeprofile = isset($_POST['copr']) ? (trim($_POST['copr'])) : '';
        $codeprofile = $the_sanitaze->str_nohtml($codeprofile, 11);

        $type_profile = isset($_POST['typr']) ? (trim($_POST['typr'])) : 0;
        $type_profile = $the_sanitaze->int($type_profile);
        
        if (!$error && empty($codeprofile)) { $error = TRUE; $txterror .= 'Error. '; }
        if (!$error && $type_profile < 0) { $error = TRUE; $txterror .= 'Error'; }
        
    }

    if ($ajax_action == 'uploadcover') {

        $codeprofile = isset($_POST['code_profile']) ? (trim($_POST['code_profile'])) : '';
        $codeprofile = $the_sanitaze->str_nohtml($codeprofile, 11);

        $type_profile = isset($_POST['type_profile']) ? (trim($_POST['type_profile'])) : 0;
        $type_profile = $the_sanitaze->int($type_profile);
        
        $the_cover = $_FILES['the_cover_new'];
        if (!is_uploaded_file($the_cover['tmp_name'])) { $error = TRUE; $txterror .= 'Error. '; }
        if (!$error && empty($codeprofile)) { $error = TRUE; $txterror .= 'Error. '; }
        if (!$error && $type_profile < 0) { $error = TRUE; $txterror .= 'Error'; }

    }

    if ($ajax_action == 'removeavatar') {
        
        $codeprofile = isset($_POST['copr']) ? (trim($_POST['copr'])) : '';
        $codeprofile = $the_sanitaze->str_nohtml($codeprofile, 11);

        $type_profile = isset($_POST['typr']) ? (trim($_POST['typr'])) : 0;
        $type_profile = $the_sanitaze->int($type_profile);
        
        if (!$error && empty($codeprofile)) { $error = TRUE; $txterror .= 'Error. '; }
        if (!$error && $type_profile < 0) { $error = TRUE; $txterror .= 'Error'; }
        
    }
    
    if ($ajax_action == 'uploadavatar') {
        
        $codeprofile = isset($_POST['code_profile']) ? (trim($_POST['code_profile'])) : '';
        $codeprofile = $the_sanitaze->str_nohtml($codeprofile, 11);

        $type_profile = isset($_POST['type_profile']) ? (trim($_POST['type_profile'])) : 0;
        $type_profile = $the_sanitaze->int($type_profile);
        
        $the_avatar = $_FILES['the_avatar_new'];
        if (!is_uploaded_file($the_avatar['tmp_name'])) { $error = TRUE; $txterror .= 'Error. '; }
        if (!$error && empty($codeprofile)) { $error = TRUE; $txterror .= 'Error. '; }
        if (!$error && $type_profile < 0) { $error = TRUE; $txterror .= 'Error'; }

    }
    
    if ($error) {
        echo('ERROR:'.$txterror);
		return;
    } else {
        
        if ($ajax_action == 'positionbgcover') {

            switch ($type_profile) {
                case 0:
                    $page->db2->query("UPDATE users SET cover_position='".trim($posibg)."px' WHERE code='".$codeprofile."' LIMIT 1");
                    break;
                case 1:
                    $page->db2->query("UPDATE pages SET cover_position='".trim($posibg)."px' WHERE code='".$codeprofile."' LIMIT 1");
                    break;
                case 2:
                    $page->db2->query("UPDATE groups SET cover_position='".trim($posibg)."px' WHERE code='".$codeprofile."' LIMIT 1");
                    break;
                case 3:
                    $page->db2->query("UPDATE events SET cover_position='".trim($posibg)."px' WHERE code='".$codeprofile."' LIMIT 1");
                    break;
            }

            echo('OK');
            return;

        }

        if ($ajax_action == 'removecover') {

            switch ($type_profile) {
                case 0:
                    $cover_previous = $page->db2->fetch_field("SELECT cover FROM users WHERE code='".$codeprofile."' LIMIT 1");

                    $page->db2->query("UPDATE users SET cover='', cover_media='', cover_position='0' WHERE code='".$codeprofile."' LIMIT 1");
                    
                    if (!empty($cover_previous)) {
                        $the_file = $K->STORAGE_DIR_COVERS.$codeprofile.'/'.$cover_previous;
                        if (file_exists($the_file)) @unlink($the_file);
                    }
                    
                    break;
                case 1:
                    $cover_previous = $page->db2->fetch_field("SELECT cover FROM pages WHERE code='".$codeprofile."' LIMIT 1");
                    
                    $page->db2->query("UPDATE pages SET cover='', cover_media='', cover_position='0' WHERE code='".$codeprofile."' LIMIT 1");

                    if (!empty($cover_previous)) {
                        $the_file = $K->STORAGE_DIR_COVERS_PAGE.$codeprofile.'/'.$cover_previous;
                        if (file_exists($the_file)) @unlink($the_file);
                    }

                    break;
                case 2:
                    $cover_previous = $page->db2->fetch_field("SELECT cover FROM groups WHERE code='".$codeprofile."' LIMIT 1");
                    
                    $page->db2->query("UPDATE groups SET cover='', cover_media='', cover_user='', cover_position='0' WHERE code='".$codeprofile."' LIMIT 1");

                    if (!empty($cover_previous)) {
                        $the_file = $K->STORAGE_DIR_COVERS_GROUP.$codeprofile.'/'.$cover_previous;
                        if (file_exists($the_file)) @unlink($the_file);
                    }                    
                    
                    break;
                case 3:
                    $cover_previous = $page->db2->fetch_field("SELECT cover FROM events WHERE code='".$codeprofile."' LIMIT 1");
                    
                    $page->db2->query("UPDATE events SET cover='', cover_media='', cover_user='', cover_position='0' WHERE code='".$codeprofile."' LIMIT 1");

                    if (!empty($cover_previous)) {
                        $the_file = $K->STORAGE_DIR_COVERS_EVENT.$codeprofile.'/'.$cover_previous;
                        if (file_exists($the_file)) @unlink($the_file);
                    }                    
                    
                    break;
            }

            $json_result = array('space_cover_header'=>'');                    
            echo(json_encode($json_result));
            return;

        }

        if ($ajax_action == 'uploadcover') {

            $cover_previous = '';
            switch ($type_profile) {
                case 0:
                    $cover_previous = $page->db2->fetch_field("SELECT cover FROM users WHERE code='".$codeprofile."' LIMIT 1");                
                    break;
                case 1:
                    $cover_previous = $page->db2->fetch_field("SELECT cover FROM pages WHERE code='".$codeprofile."' LIMIT 1");
                    break;

                case 2:
                    $cover_previous = $page->db2->fetch_field("SELECT cover FROM groups WHERE code='".$codeprofile."' LIMIT 1");
                    break;
                    
                case 3:
                    $cover_previous = $page->db2->fetch_field("SELECT cover FROM events WHERE code='".$codeprofile."' LIMIT 1");
                    break;
            }
            
            $error = FALSE;
            /*
            if ($the_cover['size'] > $K->SIZE_IMAGEN_COVER || $the_cover['size'] == 0){
                $error = TRUE;
                $msgerror = $designer->boxAlert($page->lang('setting_cover_alert_up_title'), $page->lang('setting_cover_alert_large_msg'), $page->lang('setting_txt_close'));
                break;
            }
            */
            
            if (!$error) {

                $file_extension = pathinfo($the_cover['name'], PATHINFO_EXTENSION);
                if (!isValidExtension($file_extension, 'png, jpg')) {
                    $error = TRUE;
                    $msgerror = $designer->boxAlert($page->lang('setting_cover_alert_up_title'), $page->lang('setting_cover_alert_format_msg'), $page->lang('setting_txt_close'));
                }                
                
            }
            
            if (!$error) {
                
                switch ($type_profile) {
                    case 0:
                        $the_pholder_cover = $K->STORAGE_DIR_COVERS.$codeprofile;
                        break;
                    case 1:
                        $the_pholder_cover = $K->STORAGE_DIR_COVERS_PAGE.$codeprofile;
                        break;
                    case 2:
                        $the_pholder_cover = $K->STORAGE_DIR_COVERS_GROUP.$codeprofile;
                        break;
                    case 3:
                        $the_pholder_cover = $K->STORAGE_DIR_COVERS_EVENT.$codeprofile;
                        break;
                }

                if (!file_exists($the_pholder_cover)) {
                    mkdir($the_pholder_cover, 0777, true);
                    $findex = fopen($the_pholder_cover.'/index.html', "a");
                }
                
                $code = getCode(5, 1);
                $code .= '-'.getCode(6, 1);
                $code .= '-'.getCode(7, 1);
                
                $name_file = $code.'.'.$file_extension;
                move_uploaded_file($the_cover['tmp_name'], $the_pholder_cover.'/'.$name_file);
                
                switch ($type_profile) {
                    case 0:
                        $page->db2->query("UPDATE users SET cover='".$name_file."', cover_position='0' WHERE code='".$codeprofile."' LIMIT 1");
                        break;
                    case 1:
                        $page->db2->query("UPDATE pages SET cover='".$name_file."', cover_position='0' WHERE code='".$codeprofile."' LIMIT 1");
                        break;
                    case 2:
                        $page->db2->query("UPDATE groups SET cover='".$name_file."', cover_position='0' WHERE code='".$codeprofile."' LIMIT 1");
                        break;
                    case 3:
                        $page->db2->query("UPDATE events SET cover='".$name_file."', cover_position='0' WHERE code='".$codeprofile."' LIMIT 1");
                        break;
                }
                
            }
            
            if ($error) {
                $msg_return = 'ERROR:'.$msgerror; 
            } else {

				$np = new newpost();				

				if ($type_profile == 0) $np->moreInfo($codeprofile, 0, 0, $codeprofile, 0, '', '', '');
                if ($type_profile == 1) $np->moreInfo($codeprofile, 1, 1, $codeprofile, 0, '', '', '');
                if ($type_profile == 2) $np->moreInfo($user->info->code, 0, 2, $codeprofile, 1, '', '', '');
                if ($type_profile == 3) $np->moreInfo($user->info->code, 0, 3, $codeprofile, 0, '', '', '');
                                     
				$code_media = $np->attachImagesFromServer($the_pholder_cover.'/'.$name_file, $file_extension);
                
				$np->setMessage('');
				$np->setTypePost(5);
				$np->save();
				
                if ($type_profile == 0) $page->db2->query("UPDATE users SET cover_media='".$code_media."' WHERE code='".$codeprofile."' LIMIT 1");
				
                if ($type_profile == 1) $page->db2->query("UPDATE pages SET cover_media='".$code_media."' WHERE code='".$codeprofile."' LIMIT 1");
				
                if ($type_profile == 2) $page->db2->query("UPDATE groups SET cover_media='".$code_media."', cover_user='".$user->info->user_username ."' WHERE code='".$codeprofile."' LIMIT 1");
				
                if ($type_profile == 3) $page->db2->query("UPDATE events SET cover_media='".$code_media."', cover_user='".$user->info->user_username ."' WHERE code='".$codeprofile."' LIMIT 1");

                switch ($type_profile) {
                    case 0:

                        $space_cover_header = '<a href="'.$K->SITE_URL.$user->info->user_username.'/photo/'.$code_media.'" class="zoomeer with_cover" data-id="'.$code_media.'" data-image="'.$K->STORAGE_URL_COVERS.$codeprofile.'/'.$name_file.'" data-place="cover-user" id="link-cover"><img id="cover-img" src="'.$K->STORAGE_URL_COVERS.$codeprofile.'/'.$name_file.'" style="top:0"><div id="shadow-header"></div></a>';
                    
                        $json_result = array('space_cover_header'=>$space_cover_header);
                        
                        if (!empty($cover_previous)) {
                            $the_file = $K->STORAGE_DIR_COVERS.$codeprofile.'/'.$cover_previous;
                            if (file_exists($the_file)) @unlink($the_file);
                        }
    
                        break;
                    case 1:

                        $puname = $page->db2->fetch_field("SELECT puname FROM pages WHERE code='".$codeprofile."' LIMIT 1");
                        $space_cover_header = '<a href="'.$K->SITE_URL.$puname.'/photo/'.$code_media.'" class="zoomeer with_cover" data-id="'.$code_media.'" data-image="'.$K->STORAGE_URL_COVERS_PAGE.$codeprofile.'/'.$name_file.'" data-place="cover-page" id="link-cover"><img id="cover-img" src="'.$K->STORAGE_URL_COVERS_PAGE.$codeprofile.'/'.$name_file.'" style="top:0"><div id="shadow-header"></div></a>';

                        $json_result = array('space_cover_header'=>$space_cover_header);
                        
                        if (!empty($cover_previous)) {
                            $the_file = $K->STORAGE_DIR_COVERS_PAGE.$codeprofile.'/'.$cover_previous;
                            if (file_exists($the_file)) @unlink($the_file);
                        }

                        break;
                    case 2:

                        $space_cover_header = '<a href="'.$K->SITE_URL.$user->info->user_username.'/photo/'.$code_media.'" class="zoomeer with_cover" data-id="'.$code_media.'" data-image="'.$K->STORAGE_URL_COVERS_GROUP.$codeprofile.'/'.$name_file.'" data-place="cover-group" id="link-cover"><img id="cover-img" src="'.$K->STORAGE_URL_COVERS_GROUP.$codeprofile.'/'.$name_file.'" style="top:0"><div id="shadow-header"></div></a>';

                        $json_result = array('space_cover_header'=>$space_cover_header);
                        
                        if (!empty($cover_previous)) {
                            $the_file = $K->STORAGE_DIR_COVERS_GROUP.$codeprofile.'/'.$cover_previous;
                            if (file_exists($the_file)) @unlink($the_file);
                        }

                        break;
                    case 3:

                        $space_cover_header = '<a href="'.$K->SITE_URL.$user->info->user_username.'/photo/'.$code_media.'" class="zoomeer with_cover" data-id="'.$code_media.'" data-image="'.$K->STORAGE_URL_COVERS_EVENT.$codeprofile.'/'.$name_file.'" data-place="cover-event" id="link-cover"><img id="cover-img" src="'.$K->STORAGE_URL_COVERS_EVENT.$codeprofile.'/'.$name_file.'" style="top:0"><div id="shadow-header"></div></a>';

                        $json_result = array('space_cover_header'=>$space_cover_header);
                        
                        if (!empty($cover_previous)) {
                            $the_file = $K->STORAGE_DIR_COVERS_EVENT.$codeprofile.'/'.$cover_previous;
                            if (file_exists($the_file)) @unlink($the_file);
                        }

                        break;
                }
                        
                $msg_return = json_encode($json_result);   
                
            }
            echo($msg_return);
            return;

        }      

        if ($ajax_action == 'removeavatar') {

            switch ($type_profile) {
                case 0:
                    $avatar_previous = $page->db2->fetch_field("SELECT avatar FROM users WHERE code='".$codeprofile."' LIMIT 1");
                    
                    $page->db2->query("UPDATE users SET avatar='', avatar_media='' WHERE code='".$codeprofile."' LIMIT 1");
                    $space_avatar = '<img src="'.$K->STORAGE_URL_AVATARS.'min4/'.$K->DEFAULT_AVATAR_USER.'" id="the-photo-avatar">';
                    $ico_avatar_top = $K->STORAGE_URL_AVATARS.'min1/'.$K->DEFAULT_AVATAR_USER;
                    $json_result = array('space_avatar'=>$space_avatar, 'icoavatartop'=>$ico_avatar_top);

                    if (!empty($avatar_previous)) {
                        $the_file = $K->STORAGE_DIR_AVATARS.'min1/'.$codeprofile.'/'.$avatar_previous;
                        if (file_exists($the_file)) @unlink($the_file);
        
                        $the_file = $K->STORAGE_DIR_AVATARS.'min2/'.$codeprofile.'/'.$avatar_previous;
                        if (file_exists($the_file)) @unlink($the_file);
        
                        $the_file = $K->STORAGE_DIR_AVATARS.'min3/'.$codeprofile.'/'.$avatar_previous;
                        if (file_exists($the_file)) @unlink($the_file);
        
                        $the_file = $K->STORAGE_DIR_AVATARS.'min4/'.$codeprofile.'/'.$avatar_previous;
                        if (file_exists($the_file)) @unlink($the_file);
        
                        $the_file = $K->STORAGE_DIR_AVATARS.'originals/'.$codeprofile.'/'.$avatar_previous;
                        if (file_exists($the_file)) @unlink($the_file);            
                    }

                    break;
                case 1:
                    $avatar_previous = $page->db2->fetch_field("SELECT avatar FROM pages WHERE code='".$codeprofile."' LIMIT 1");
                    
                    $page->db2->query("UPDATE pages SET avatar='', avatar_media='' WHERE code='".$codeprofile."' LIMIT 1");
                    $space_avatar = '<img src="'.$K->STORAGE_URL_AVATARS_PAGE.'min4/'.$K->DEFAULT_AVATAR_PAGE.'" id="the-photo-avatar">';
                    $json_result = array('space_avatar'=>$space_avatar);
                    
                    if (!empty($avatar_previous)) {
                        $the_file = $K->STORAGE_DIR_AVATARS_PAGE.'min1/'.$codeprofile.'/'.$avatar_previous;
                        if (file_exists($the_file)) @unlink($the_file);
        
                        $the_file = $K->STORAGE_DIR_AVATARS_PAGE.'min2/'.$codeprofile.'/'.$avatar_previous;
                        if (file_exists($the_file)) @unlink($the_file);
        
                        $the_file = $K->STORAGE_DIR_AVATARS_PAGE.'min3/'.$codeprofile.'/'.$avatar_previous;
                        if (file_exists($the_file)) @unlink($the_file);
        
                        $the_file = $K->STORAGE_DIR_AVATARS_PAGE.'min4/'.$codeprofile.'/'.$avatar_previous;
                        if (file_exists($the_file)) @unlink($the_file);
        
                        $the_file = $K->STORAGE_DIR_AVATARS_PAGE.'originals/'.$codeprofile.'/'.$avatar_previous;
                        if (file_exists($the_file)) @unlink($the_file);            
                    }

                    break;
            }

            echo(json_encode($json_result));
            return;            
            
        }
        
        if ($ajax_action == 'uploadavatar') {

            $avatar_previous = '';
            switch ($type_profile) {
                case 0:
                    $avatar_previous = $page->db2->fetch_field("SELECT avatar FROM users WHERE code='".$codeprofile."' LIMIT 1");                
                    break;
                case 1:
                    $avatar_previous = $page->db2->fetch_field("SELECT avatar FROM pages WHERE code='".$codeprofile."' LIMIT 1");
                    break;                
            }
            
            $error = FALSE;
            
            /*
            if ($the_avatar['size'] > $K->SIZE_IMAGEN_AVATAR || $the_avatar['size'] == 0){
                $error = TRUE;
                $msgerror = $designer->boxAlert($page->lang('setting_avatar_alert_up_title'), $page->lang('setting_avatar_alert_large_msg'), $page->lang('setting_txt_close'));
                break;
            }
            */
            
            if (!$error) {

                $file_extension = pathinfo($the_avatar['name'], PATHINFO_EXTENSION);
                if (!isValidExtension($file_extension, 'png, jpg')) {
                    $error = TRUE;
                    $msgerror = $designer->boxAlert($page->lang('setting_avatar_alert_up_title'), $page->lang('setting_avatar_alert_format_msg'), $page->lang('setting_txt_close'));
                }                
                
            }
            
            if (!$error) {

                switch ($type_profile) {
                    case 0:
                        $the_pholder_avatar_0 = $K->STORAGE_DIR_AVATARS.'originals/'.$codeprofile;
                        $the_pholder_avatar_1 = $K->STORAGE_DIR_AVATARS.'min1/'.$codeprofile;
                        $the_pholder_avatar_2 = $K->STORAGE_DIR_AVATARS.'min2/'.$codeprofile;
-                        $the_pholder_avatar_3 = $K->STORAGE_DIR_AVATARS.'min3/'.$codeprofile;
                        $the_pholder_avatar_4 = $K->STORAGE_DIR_AVATARS.'min4/'.$codeprofile;
                        break;
                    case 1:
                        $the_pholder_avatar_0 = $K->STORAGE_DIR_AVATARS_PAGE.'originals/'.$codeprofile;
                        $the_pholder_avatar_1 = $K->STORAGE_DIR_AVATARS_PAGE.'min1/'.$codeprofile;
                        $the_pholder_avatar_2 = $K->STORAGE_DIR_AVATARS_PAGE.'min2/'.$codeprofile;
                        $the_pholder_avatar_3 = $K->STORAGE_DIR_AVATARS_PAGE.'min3/'.$codeprofile;
                        $the_pholder_avatar_4 = $K->STORAGE_DIR_AVATARS_PAGE.'min4/'.$codeprofile;
                        break;
                }

                if (!file_exists($the_pholder_avatar_0)) {
                    mkdir($the_pholder_avatar_0, 0777, true);
                    $findex = fopen($the_pholder_avatar_0.'/index.html', "a");
                }

                if (!file_exists($the_pholder_avatar_1)) {
                    mkdir($the_pholder_avatar_1, 0777, true);
                    $findex = fopen($the_pholder_avatar_1.'/index.html', "a");
                }

                if (!file_exists($the_pholder_avatar_2)) {
                    mkdir($the_pholder_avatar_2, 0777, true);
                    $findex = fopen($the_pholder_avatar_2.'/index.html', "a");
                }

                if (!file_exists($the_pholder_avatar_3)) {
                    mkdir($the_pholder_avatar_3, 0777, true);
                    $findex = fopen($the_pholder_avatar_3.'/index.html', "a");
                }

                if (!file_exists($the_pholder_avatar_4)) {
                    mkdir($the_pholder_avatar_4, 0777, true);
                    $findex = fopen($the_pholder_avatar_4.'/index.html', "a");
                }
                
                $code = getCode(5, 1);
                $code .= '-'.getCode(6, 1);
                $code .= '-'.getCode(7, 1);
                
                $name_file = $code.'.'.$file_extension;
                move_uploaded_file($the_avatar['tmp_name'], $the_pholder_avatar_0.'/'.$name_file);
                
                $thumbnail = new imagen($the_pholder_avatar_0.'/'.$name_file);
                $thumbnail->resizeImage($K->widthAvatar1, $K->heightAvatar1, 'crop');
                $thumbnail->saveImage($the_pholder_avatar_1.'/'.$name_file);

                $thumbnail = new imagen($the_pholder_avatar_0.'/'.$name_file);
                $thumbnail->resizeImage($K->widthAvatar2, $K->heightAvatar2, 'crop');
                $thumbnail->saveImage($the_pholder_avatar_2.'/'.$name_file);

                $thumbnail = new imagen($the_pholder_avatar_0.'/'.$name_file);
                $thumbnail->resizeImage($K->widthAvatar3, $K->heightAvatar3, 'crop');
                $thumbnail->saveImage($the_pholder_avatar_3.'/'.$name_file);

                $thumbnail = new imagen($the_pholder_avatar_0.'/'.$name_file);
                $thumbnail->resizeImage($K->widthAvatar4, $K->heightAvatar4, 'crop');
                $thumbnail->saveImage($the_pholder_avatar_4.'/'.$name_file);
                
                switch ($type_profile) {
                    case 0:
                        $page->db2->query("UPDATE users SET avatar='".$name_file."' WHERE code='".$codeprofile."' LIMIT 1");
                        break;
                    case 1:
                        $page->db2->query("UPDATE pages SET avatar='".$name_file."' WHERE code='".$codeprofile."' LIMIT 1");
                        break;
                }
             
            }
            
            
            if ($error) {
                $msg_return = 'ERROR:'.$msgerror; 
            } else {
				
				$np = new newpost();				
                
				if ($type_profile == 0) $np->moreInfo($codeprofile, 0, 0, $codeprofile, 0, '', '', '');
                if ($type_profile == 1) $np->moreInfo($codeprofile, 1, 1, $codeprofile, 0, '', '', '');
				
				$code_media = $np->attachImagesFromServer($the_pholder_avatar_0.'/'.$name_file, $file_extension);
				$np->setMessage('');
				$np->setTypePost(6);
				$np->save();
				
                if ($type_profile == 0) $page->db2->query("UPDATE users SET avatar_media='".$code_media."' WHERE code='".$codeprofile."' LIMIT 1");				
                if ($type_profile == 1) $page->db2->query("UPDATE pages SET avatar_media='".$code_media."' WHERE code='".$codeprofile."' LIMIT 1");

             
                switch ($type_profile) {
                    case 0:
                        $space_avatar = '<a href="'.$K->SITE_URL.$user->info->user_username.'/photo/'.$code_media.'" class="zoomeer" data-id="'.$code_media.'" data-image="'.$K->STORAGE_URL_AVATARS.'originals/'.$codeprofile.'/'.$name_file.'" data-place="avatar-user"><img src="'.$K->STORAGE_URL_AVATARS.'min4/'.$codeprofile.'/'.$name_file.'" id="the-photo-avatar"></a>';
                        $ico_avatar_top = $K->STORAGE_URL_AVATARS.'min1/'.$codeprofile.'/'.$name_file;
                        $json_result = array('space_avatar'=>$space_avatar, 'icoavatartop'=>$ico_avatar_top);

                        if (!empty($avatar_previous)) {
                            $the_file = $K->STORAGE_DIR_AVATARS.'min1/'.$codeprofile.'/'.$avatar_previous;
                            if (file_exists($the_file)) @unlink($the_file);
            
                            $the_file = $K->STORAGE_DIR_AVATARS.'min2/'.$codeprofile.'/'.$avatar_previous;
                            if (file_exists($the_file)) @unlink($the_file);
            
                            $the_file = $K->STORAGE_DIR_AVATARS.'min3/'.$codeprofile.'/'.$avatar_previous;
                            if (file_exists($the_file)) @unlink($the_file);
            
                            $the_file = $K->STORAGE_DIR_AVATARS.'min4/'.$codeprofile.'/'.$avatar_previous;
                            if (file_exists($the_file)) @unlink($the_file);
            
                            $the_file = $K->STORAGE_DIR_AVATARS.'originals/'.$codeprofile.'/'.$avatar_previous;
                            if (file_exists($the_file)) @unlink($the_file);            
                        }

                        break;
                    case 1:
                        $puname = $page->db2->fetch_field("SELECT puname FROM pages WHERE code='".$codeprofile."' LIMIT 1");
                        $space_avatar = '<a href="'.$K->SITE_URL.$puname.'/photo/'.$code_media.'" class="zoomeer" data-id="'.$code_media.'" data-image="'.$K->STORAGE_URL_AVATARS_PAGE.'originals/'.$codeprofile.'/'.$name_file.'" data-place="avatar-user"><img src="'.$K->STORAGE_URL_AVATARS_PAGE.'min4/'.$codeprofile.'/'.$name_file.'" id="the-photo-avatar"></a>';
                        $json_result = array('space_avatar'=>$space_avatar);
                        
                        if (!empty($avatar_previous)) {
                            $the_file = $K->STORAGE_DIR_AVATARS_PAGE.'min1/'.$codeprofile.'/'.$avatar_previous;
                            if (file_exists($the_file)) @unlink($the_file);
            
                            $the_file = $K->STORAGE_DIR_AVATARS_PAGE.'min2/'.$codeprofile.'/'.$avatar_previous;
                            if (file_exists($the_file)) @unlink($the_file);
            
                            $the_file = $K->STORAGE_DIR_AVATARS_PAGE.'min3/'.$codeprofile.'/'.$avatar_previous;
                            if (file_exists($the_file)) @unlink($the_file);
            
                            $the_file = $K->STORAGE_DIR_AVATARS_PAGE.'min4/'.$codeprofile.'/'.$avatar_previous;
                            if (file_exists($the_file)) @unlink($the_file);
            
                            $the_file = $K->STORAGE_DIR_AVATARS_PAGE.'originals/'.$codeprofile.'/'.$avatar_previous;
                            if (file_exists($the_file)) @unlink($the_file);            
                        }

                        break;
                }

                $msg_return = json_encode($json_result);   
                
            }

            echo($msg_return);
            return;
        }
        
    }
?>