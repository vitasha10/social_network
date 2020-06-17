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

    if (!$user->is_logged) {
        echo('ERROR:'.$page->lang('global_txt_no_session'));
        return;
    }
    
    $the_sanitaze = new sanitize(); // init sanitaze
    
    $error = FALSE;
    
    if ($ajax_action == 'addfriend') {}

    if ($ajax_action == 'cancelfriendrequest') {}

    if ($ajax_action == 'deletefriendrequest') {
    
        $codeuser = isset($_POST['cdu']) ? (trim($_POST['cdu'])) : '';
        $codeuser = $the_sanitaze->str_nohtml($codeuser, 11);
            
        $idnotif = isset($_POST['idn']) ? (trim($_POST['idn'])) : 0;
        $idnotif = $the_sanitaze->int($idnotif);

    	if (!$error && empty($codeuser)) { $error = TRUE; $txterror = 'Error. '; }
    	if (!$error && $idnotif == 0) { $error = TRUE; $txterror = 'Error. '; }
        
    }

    if ($ajax_action == 'confirmfriendrequest') {
    
        $codeuser = isset($_POST['cdu']) ? (trim($_POST['cdu'])) : '';
        $codeuser = $the_sanitaze->str_nohtml($codeuser, 11);

        $idnotif = isset($_POST['idn']) ? (trim($_POST['idn'])) : 0;
        $idnotif = $the_sanitaze->int($idnotif);
            
    	if (!$error && empty($codeuser)) { $error = TRUE; $txterror = 'Error. '; }
    	if (!$error && $idnotif == 0) { $error = TRUE; $txterror = 'Error. '; }

    }

    if ($ajax_action == 'unfriend') {}

    if ($error) {
        echo('ERROR:'.$txterror);
		return;
    } else {
        
        if ($ajax_action == 'addfriend') {}

        if ($ajax_action == 'cancelfriendrequest') {}

        if ($ajax_action == 'deletefriendrequest') {

            if (!$user->deleteRequestFriend($codeuser)) {
                echo('ERROR:Error');
                return;
            }

            echo('OK');
            return;  
            
        }

        if ($ajax_action == 'confirmfriendrequest') {

            if (!$user->confirmRequestFriend($codeuser)) {
                echo('ERROR:Error');
                return;
            }

            echo('OK');
            return;  
            
        }

        if ($ajax_action == 'unfriend') {}

        
    }
?>