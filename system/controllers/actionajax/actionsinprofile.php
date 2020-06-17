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

    global $K, $D;

    $user = & $GLOBALS['user'];
    $page = & $GLOBALS['page'];

    $page->loadLanguage('global.php');
    $page->loadLanguage('dashboard.php');
    $page->loadLanguage('profile.php');

    if (!$user->is_logged) { 
        echo('ERROR:'.$page->lang('global_txt_no_session'));
        return;
    }
    
    $designer = new designer();
    $msg_default = $designer->boxAlert($page->lang('global_txt_information'), $page->lang('global_txt_error_ocurred'), $page->lang('global_txt_ok'));
    

    $the_sanitaze = new sanitize(); // init sanitaze

    $error = FALSE;

    if ($ajax_action == 'addfriend') {

        $codeuser = isset($_POST['cuser']) ? (trim($_POST['cuser'])) : '';
        $codeuser = $the_sanitaze->str_nohtml($codeuser, 11);

    	if (!$error && empty($codeuser)) { $error = TRUE; $txterror = 'Error. '; }

    }

    if ($ajax_action == 'cancelfriendrequest') {

        $codeuser = isset($_POST['cuser']) ? (trim($_POST['cuser'])) : '';
        $codeuser = $the_sanitaze->str_nohtml($codeuser, 11);

    	if (!$error && empty($codeuser)) { $error = TRUE; $txterror = 'Error. '; }

    }

    if ($ajax_action == 'deletefriendrequest') {

        $codeuser = isset($_POST['cuser']) ? (trim($_POST['cuser'])) : '';
        $codeuser = $the_sanitaze->str_nohtml($codeuser, 11);

    	if (!$error && empty($codeuser)) { $error = TRUE; $txterror = 'Error. '; }

    }

    if ($ajax_action == 'confirmfriendrequest') {

        $codeuser = isset($_POST['cuser']) ? (trim($_POST['cuser'])) : '';
        $codeuser = $the_sanitaze->str_nohtml($codeuser, 11);

    	if (!$error && empty($codeuser)) { $error = TRUE; $txterror = 'Error. '; }

    }

    if ($ajax_action == 'unfriend') {

        $codeuser = isset($_POST['cuser']) ? (trim($_POST['cuser'])) : '';
        $codeuser = $the_sanitaze->str_nohtml($codeuser, 11);

    	if (!$error && empty($codeuser)) { $error = TRUE; $txterror = 'Error. '; }

    }
    
    if ($ajax_action == 'blockuser') {

        $codeuser = isset($_POST['cod']) ? (trim($_POST['cod'])) : '';
        $codeuser = $the_sanitaze->str_nohtml($codeuser, 11);

    	if (!$error && empty($codeuser)) {
            $error = TRUE;
            $txterror = $msg_default;
        }
    }
    
    if ($ajax_action == 'reportuser') {

        $codeuser = isset($_POST['cod']) ? (trim($_POST['cod'])) : '';
        $codeuser = $the_sanitaze->str_nohtml($codeuser, 11);
        $reason = isset($_POST['reason']) ? (trim($_POST['reason'])) : '';
        $reason = $the_sanitaze->str_nohtml($reason);

    	if (!$error && empty($codeuser)) {
            $error = TRUE;
            $txterror = $msg_default;
        }
        
    	if (!$error && empty($reason)) {
            $error = TRUE;
            $txterror = $msg_default;
        }
    }

    if ($ajax_action == 'unreportuser') {

        $codeuser = isset($_POST['cod']) ? (trim($_POST['cod'])) : '';
        $codeuser = $the_sanitaze->str_nohtml($codeuser, 11);

    	if (!$error && empty($codeuser)) {
            $error = TRUE;
            $txterror = $msg_default;
        }
    }    
    

    if ($error) {
        echo('ERROR:'.$txterror);
		return;
    } else {

        if ($ajax_action == 'addfriend') {

            if (!$user->sendFriendRequest($codeuser)) {
                echo('ERROR:Error.');
                return;
            }

            echo('OK');
            return;  

        }

        if ($ajax_action == 'cancelfriendrequest') {

            if (!$user->cancelRequestFriend($codeuser)) {
                echo('ERROR:Error.');
                return;
            }

            echo('OK');
            return;  

        }

        if ($ajax_action == 'deletefriendrequest') {

            if (!$user->deleteRequestFriend($codeuser)) {
                echo('ERROR:Error.');
                return;
            }

            echo('OK');
            return;  

        }

        if ($ajax_action == 'confirmfriendrequest') {

            if (!$user->confirmRequestFriend($codeuser)) {
                echo('ERROR:Error.');
                return;
            }

            echo('OK');
            return;  

        }

        if ($ajax_action == 'unfriend') {

            if (!$user->unFriend($codeuser)) {
                echo('ERROR:Error.');
                return;
            }

            echo('OK');
            return;  

        }
        
        if ($ajax_action == 'blockuser') {

            if (!$user->blockUser($codeuser)) {
                echo('ERROR:'.$msg_default);
                return;
            }

            echo('OK');
            return;  

        }
        
        if ($ajax_action == 'reportuser') {

            if (!$user->reportUser($codeuser, $reason)) {
                echo('ERROR:'.$msg_default);
                return;
            }

            $json_result = array('html'=>$designer->boxAlert($page->lang('global_txt_information'), $page->lang('profile_txt_ureport_confirm_sent'), $page->lang('global_txt_ok')));
            echo(json_encode($json_result));
            return;  

        }
        
        if ($ajax_action == 'unreportuser') {

            $error = FALSE;
            $iduserreported = $page->db2->fetch_field("SELECT iduser FROM users WHERE active=1 AND code='".$codeuser."' AND iduser<>".$user->info->iduser." LIMIT 1");
            if (!$iduserreported) {
                echo('ERROR:'.$msg_default);
                return;  
            } else {
                $response = $page->db2->fetch_field("SELECT count(idreport) FROM reports WHERE typeitem=2 AND iditem=".$iduserreported." AND idinformer=".$user->info->iduser);
                if ($response == 0) {
                    echo('ERROR:'.$msg_default);
                    return;
                } else {
                    $page->db2->fetch_field("DELETE FROM reports WHERE typeitem=2 AND iditem=".$iduserreported." AND idinformer=".$user->info->iduser);
                    $json_result = array('html'=>$designer->boxAlert($page->lang('global_txt_information'), $page->lang('profile_txt_ureport_cancel_ok'), $page->lang('global_txt_ok')));
                    echo(json_encode($json_result));
                    return;  
                }
                
            }

        }

    }

?>