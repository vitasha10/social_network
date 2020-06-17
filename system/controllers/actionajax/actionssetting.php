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
    $msg_default = $designer->boxAlert($page->lang('global_txt_information'), $page->lang('global_txt_error_ocurred'), $page->lang('global_txt_ok'));

    if (!$user->is_logged) { 
        echo('ERROR:'.$page->lang('global_txt_no_session'));
        return;
    }
    
    $the_sanitaze = new sanitize(); // init sanitaze
    
    $error = FALSE;
    
    $txterror = '';
    
    if ($ajax_action == 'email') {
        $email = isset($_POST['em']) ? (trim($_POST['em'])) : '';
        $email = $the_sanitaze->email($email);

    	if (!$error && empty($email)) { $error = TRUE; $txterror .= $page->lang('setting_account_block_email_error_email'); }

    }

    if ($ajax_action == 'username') {

        $username = isset($_POST['un']) ? (trim($_POST['un'])) : '';
        $username = $the_sanitaze->str_nohtml($username);
        
        if (!$error && empty($username)) { $error = TRUE; $txterror .= $page->lang('setting_account_block_username_error_username'); }
        
        if (!$error && !validateUsername($username)) { $error = TRUE; $txterror .= $page->lang('setting_account_block_username_error_notvalid'); }

    }

    if ($ajax_action == 'password') {

        $pcurrent = isset($_POST['pc']) ? (trim($_POST['pc'])) : '';
        $pcurrent = $the_sanitaze->str_nohtml($pcurrent);
        
        $pnew = isset($_POST['pn']) ? (trim($_POST['pn'])) : '';
        $pnew = $the_sanitaze->str_nohtml($pnew);
        
        if (!$error && empty($pcurrent)) { $error = TRUE; $txterror .= $page->lang('setting_account_block_password_error_current'); }
        if (!$error && empty($pnew)) { $error = TRUE; $txterror .= $page->lang('setting_account_block_password_error_new'); }

    }

    if ($ajax_action == 'personal') {

        $firstname = isset($_POST['fn']) ? (trim($_POST['fn'])) : '';
        $firstname = $the_sanitaze->str_nohtml($firstname);

        $lastname = isset($_POST['ln']) ? (trim($_POST['ln'])) : '';
        $lastname = $the_sanitaze->str_nohtml($lastname);

        $gender = isset($_POST['ge']) ? (trim($_POST['ge'])) : 0;
        $gender = $the_sanitaze->int($gender);

        $birthday = isset($_POST['bi']) ? (trim($_POST['bi'])) : '';
        $birthday = $the_sanitaze->str_nohtml($birthday);
        
        
        if (!$error && empty($firstname)) { $error = TRUE; $txterror .= $page->lang('setting_profile_block_personal_error_firstname'); }
        if (!$error && empty($lastname)) { $error = TRUE; $txterror .= $page->lang('setting_profile_block_personal_error_lastname');}
        if (!$error && $gender <= 0) { $error = TRUE; $txterror .= $page->lang('setting_profile_block_personal_error_sex'); }
        if (!$error && empty($birthday)) { $error = TRUE; $txterror .= $page->lang('setting_profile_block_personal_error_birthday2'); }

    }

    if ($ajax_action == 'location') {

        $currentcity = isset($_POST['cc']) ? (trim($_POST['cc'])) : '';
        $currentcity = $the_sanitaze->str_nohtml($currentcity);

        $hometown = isset($_POST['ho']) ? (trim($_POST['ho'])) : '';
        $hometown = $the_sanitaze->str_nohtml($hometown);

        if (!$error && empty($currentcity)) { $error = TRUE; $txterror .= $page->lang('setting_profile_block_location_error_currentcity'); }
        if (!$error && empty($hometown)) { $error = TRUE; $txterror .= $page->lang('setting_profile_block_location_error_hometown'); }

    }

    if ($ajax_action == 'aboutme') {

        $aboutme = isset($_POST['abme']) ? (trim($_POST['abme'])) : '';
        $aboutme = $the_sanitaze->str_nohtml($aboutme);

        if (!$error && empty($aboutme)) { $error = TRUE; $txterror .= $page->lang('setting_profile_block_aboutme_error_aboutme'); }

    }

    if ($ajax_action == 'privacyprofile') {

        $ppro = isset($_POST['ppro']) ? (trim($_POST['ppro'])) : 0;
        $ppro = $the_sanitaze->int($ppro);

        $pwri = isset($_POST['pwri']) ? (trim($_POST['pwri'])) : 0;
        $pwri = $the_sanitaze->int($pwri);

        $psfr = isset($_POST['ppro']) ? (trim($_POST['psfr'])) : 0;
        $psfr = $the_sanitaze->int($psfr);

        $pspa = isset($_POST['pspa']) ? (trim($_POST['pspa'])) : 0;
        $pspa = $the_sanitaze->int($pspa);

        $psgr = isset($_POST['psgr']) ? (trim($_POST['psgr'])) : 0;
        $psgr = $the_sanitaze->int($psgr);

        $pmes = isset($_POST['pmes']) ? (trim($_POST['pmes'])) : 0;
        $pmes = $the_sanitaze->int($pmes);

        if (!$error && $ppro < 0) { $error = TRUE; $txterror .= $page->lang('setting_privacy_error_msg'); }
        if (!$error && $pwri < 0) { $error = TRUE; $txterror .= $page->lang('setting_privacy_error_msg'); }
        if (!$error && $psfr < 0) { $error = TRUE; $txterror .= $page->lang('setting_privacy_error_msg'); }
        if (!$error && $pspa < 0) { $error = TRUE; $txterror .= $page->lang('setting_privacy_error_msg'); }
        if (!$error && $psgr < 0) { $error = TRUE; $txterror .= $page->lang('setting_privacy_error_msg'); }
        if (!$error && $pmes < 0) { $error = TRUE; $txterror .= $page->lang('setting_privacy_error_msg'); }
        
    }

    if ($ajax_action == 'privacyinfo') {

        $pbir = isset($_POST['pbir']) ? (trim($_POST['pbir'])) : 0;
        $pbir = $the_sanitaze->int($pbir);

        $ploc = isset($_POST['ploc']) ? (trim($_POST['ploc'])) : 0;
        $ploc = $the_sanitaze->int($ploc);

        $pabo = isset($_POST['pabo']) ? (trim($_POST['pabo'])) : 0;
        $pabo = $the_sanitaze->int($pabo);

        if (!$error && $pbir < 0) { $error = TRUE; $txterror .= $page->lang('setting_privacy_error_msg'); }
        if (!$error && $ploc < 0) { $error = TRUE; $txterror .= $page->lang('setting_privacy_error_msg'); }
        if (!$error && $pabo < 0) { $error = TRUE; $txterror .= $page->lang('setting_privacy_error_msg'); }

    }

    if ($ajax_action == 'privacychat') {

        $pcha = isset($_POST['pcha']) ? (trim($_POST['pcha'])) : 0;
        $pcha = $the_sanitaze->int($pcha);

        $pchamu = isset($_POST['pchamu']) ? (trim($_POST['pchamu'])) : 0;
        $pchamu = $the_sanitaze->int($pchamu);

        if (!$error && $pcha < 0) { $error = TRUE; $txterror .= $page->lang('setting_privacy_error_msg'); }
        if (!$error && $pchamu < 0) { $error = TRUE; $txterror .= $page->lang('setting_privacy_error_msg'); }

    }

    if ($ajax_action == 'delete') {
    }
    
    if ($ajax_action == 'unblockuser') {
        $codeuser = isset($_POST['cod']) ? (trim($_POST['cod'])) : '';
        $codeuser = $the_sanitaze->str_nohtml($codeuser, 11);

    	if (!$error && empty($codeuser)) {
            $error = TRUE;
            $json_result = array('status' => 'ERROR', 'message' => $msg_default);
        }
        
    }
    
    if ($ajax_action == 'timelang') {

        $tztime = isset($_POST['tztime']) ? (trim($_POST['tztime'])) : '';
        $tztime = $the_sanitaze->str_nohtml($tztime);

        $tzlang = isset($_POST['tztime']) ? (trim($_POST['tzlang'])) : '';
        $tzlang = $the_sanitaze->str_nohtml($tzlang);

        if (!$error && empty($tztime)) { $error = TRUE; $txterror .= $page->lang('setting_account_block_langtimezone_error_msg'); }
        if (!$error && empty($tzlang)) { $error = TRUE; $txterror .= $page->lang('setting_account_block_langtimezone_error_msg'); }

    }
    
    if ($error) {
        echo('ERROR:'.$txterror);
		return;
    } else {
        
        if ($ajax_action == 'email') {

            if ($user->info->user_email == $email) {
                echo('ERROR:'.$page->lang('setting_account_block_email_error_younow'));
                return;
            }
            
            $response = $page->db2->fetch_field("SELECT count(iduser) FROM users WHERE user_email='".$email."' AND iduser<>".$user->info->iduser);
            if ($response > 0) {
                echo('ERROR:'.$page->lang('setting_account_block_email_error_other'));
                return;
            }
            
            $page->db2->query("UPDATE users SET user_email='".$email."' WHERE iduser=".$user->info->iduser." LIMIT 1");
            
            $json_result = array('html' => $page->lang('setting_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        }

        if ($ajax_action == 'username') {

            if ($user->info->user_username == $username) {
                echo('ERROR:'.$page->lang('setting_account_block_username_error_younow'));
                return;
            }

            $response = $page->db2->fetch_field("SELECT count(idgroup) FROM groups WHERE guname='".$username."'");
            if ($response > 0) {
                echo('ERROR:'.$page->lang('setting_account_block_username_error_notavailable'));
                return;
            }
    
            $response = $page->db2->fetch_field("SELECT count(idpage) FROM pages WHERE puname='".$username."'");
            if ($response > 0) {
                echo('ERROR:'.$page->lang('setting_account_block_username_error_notavailable'));
                return;
            }
            
            $response = $page->db2->fetch_field("SELECT count(iduser) FROM users WHERE user_username='".$username."' AND iduser<>".$user->info->iduser);
            if ($response > 0) {
                echo('ERROR:'.$page->lang('setting_account_block_username_error_notavailable'));
                return;
            }
            
            $page->db2->query("UPDATE users SET user_username='".$username."' WHERE iduser=".$user->info->iduser." LIMIT 1");
            
            $json_result = array('html' => $page->lang('setting_txt_has_updated'));
            $msg_return = json_encode($json_result);
            echo($msg_return);
            return;

        }

        if ($ajax_action == 'password') {

            if ($user->info->user_password != $pcurrent) {
                echo('ERROR:'.$page->lang('setting_account_block_password_error_incorrect'));
                return;
            }
            
            $page->db2->query("UPDATE users SET user_password='".$pnew."' WHERE iduser=".$user->info->iduser." LIMIT 1");
            
            $json_result = array('html' => $page->lang('setting_txt_has_updated'));
            $msg_return = json_encode($json_result);
            echo($msg_return);
            return;

        }

        if ($ajax_action == 'personal') {

            $page->db2->query("UPDATE users SET firstname='".$firstname."', lastname='".$lastname."', gender='".$gender."', birthday='".$birthday."' WHERE iduser=".$user->info->iduser." LIMIT 1");
            
            $json_result = array('html' => $page->lang('setting_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        }

        if ($ajax_action == 'location') {

            $page->db2->query("UPDATE users SET currentcity='".$currentcity."', hometown='".$hometown."' WHERE iduser=".$user->info->iduser." LIMIT 1");
            
            $json_result = array('html' => $page->lang('setting_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        }

        if ($ajax_action == 'aboutme') {

            $page->db2->query("UPDATE users SET aboutme='".$aboutme."' WHERE iduser=".$user->info->iduser." LIMIT 1");
            
            $json_result = array('html' => $page->lang('setting_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        }
        
        if ($ajax_action == 'privacyprofile') {

            $page->db2->query("UPDATE users SET privacy=".$ppro.", who_write_on_my_wall=".$pwri.", who_can_sendme_messages=".$pmes.", who_can_see_friends=".$psfr.", who_can_see_liked_pages=".$pspa.", who_can_see_joined_groups=".$psgr." WHERE iduser=".$user->info->iduser." LIMIT 1");
            
            $json_result = array('html' => $page->lang('setting_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        }
        
        if ($ajax_action == 'privacyinfo') {

            $page->db2->query("UPDATE users SET who_can_see_birthdate=".$pbir.", who_can_see_location=".$ploc.", who_can_see_about_me=".$pabo." WHERE iduser=".$user->info->iduser." LIMIT 1");
            
            $json_result = array('html' => $page->lang('setting_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        }

        if ($ajax_action == 'privacychat') {

            $page->db2->query("UPDATE users SET chat=".$pcha.", chat_mute=".$pchamu." WHERE iduser=".$user->info->iduser." LIMIT 1");
            
            $json_result = array('html' => $page->lang('setting_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        }

        if ($ajax_action == 'delete') {
            
            if ($user->info->is_admin) {
                echo('ERROR:'.$page->lang('setting_delete_error_nodelete'));
                return;
            }

            $page->db2->query("UPDATE users SET active=0, req_delete=1 WHERE iduser=".$user->info->iduser." LIMIT 1");

            echo('OK');
            return;

        }
        
        
        if ($ajax_action == 'unblockuser') {
            
            $error = FALSE;
            $iduserblocked = $page->db2->fetch_field("SELECT iduser FROM users WHERE active=1 AND code='".$codeuser."' AND iduser<>".$user->info->iduser." LIMIT 1");
            if (!$iduserblocked) $error = TRUE;
            else {
                $response = $page->db2->fetch_field("SELECT count(id) FROM users_blocked WHERE iduserblocked='".$iduserblocked."' AND iduser=".$user->info->iduser);
                if ($response == 0) $error = TRUE;
                else {
                    $page->db2->query('UPDATE relations SET blocked=0 WHERE follower='.$iduserblocked.' AND type_leader=0 AND leader='.$user->info->iduser.' LIMIT 1');
                    $page->db2->query('UPDATE relations SET blocked=0 WHERE follower='.$user->info->iduser.' AND type_leader=0 AND leader='.$iduserblocked.' LIMIT 1');
                    $page->db2->query("DELETE FROM users_blocked WHERE iduser=".$user->info->iduser." AND iduserblocked=".$iduserblocked." LIMIT 1");
                }
            }

            if ($error) $json_result = array('status' => 'ERROR', 'message' => $msg_default);
            else $json_result = array('status' => 'OK');

            echo(json_encode($json_result));
            return;
        }
        
        if ($ajax_action == 'timelang') {

            $page->db2->query("UPDATE users SET timezone='".$tztime."', language='".$tzlang."' WHERE iduser=".$user->info->iduser." LIMIT 1");
            
            $json_result = array('html' => $page->lang('setting_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        }
        

    }
?>