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

    if ($ajax_action == 'interested') {
    
        $code_event = isset($_POST['cevent']) ? (trim($_POST['cevent'])) : '';
        $code_event = $the_sanitaze->str_nohtml($code_event, 11);
            
    	if (!$error && empty($code_event)) { $error = TRUE; $txterror = 'Error. '; }

    }
    
    if ($ajax_action == 'going') {
    
        $code_event = isset($_POST['cevent']) ? (trim($_POST['cevent'])) : '';
        $code_event = $the_sanitaze->str_nohtml($code_event, 11);
            
    	if (!$error && empty($code_event)) { $error = TRUE; $txterror = 'Error. '; }

    }
    
    if ($ajax_action == 'quit') {
    
        $code_event = isset($_POST['cevent']) ? (trim($_POST['cevent'])) : '';
        $code_event = $the_sanitaze->str_nohtml($code_event, 11);
            
    	if (!$error && empty($code_event)) { $error = TRUE; $txterror = 'Error. '; }

    }


    if ($error) {
        echo('ERROR:'.$txterror);
		return;
    } else {
        
        if ($ajax_action == 'interested') {

            $result = $user->interestedInEvent($code_event);
            if (!$result) {
                echo('ERROR: Error');
                return;
            }
            
            $type_change = 0;
            switch ($result) {
                case 1:
                    echo('ERROR: Error');
                    return;
                    break;
                case 2:
                    $type_change = 0;
                    break;
                case 3:
                    $type_change = 1;
                    break;
                case 4:
                    $type_change = 2;
                    break;
            }

            $json_result = array('change'=>$type_change, 'txtbtn'=>$page->lang('global_event_txt_action_interested'));
            echo(json_encode($json_result));
            return; 
            
        }

        if ($ajax_action == 'going') {

            $result = $user->goingInEvent($code_event);
            if (!$result) {
                echo('ERROR: Error');
                return;
            }
            
            $type_change = 0;
            switch ($result) {
                case 1:
                    echo('ERROR: Error');
                    return;
                    break;
                case 2:
                    $type_change = 0;
                    break;
                case 3:
                    $type_change = 1;
                    break;
                case 4:
                    $type_change = 2;
                    break;
            }

            $json_result = array('change'=>$type_change, 'txtbtn'=>$page->lang('global_event_txt_action_going'));
            echo(json_encode($json_result));
            return; 
            
        }
  
        if ($ajax_action == 'quit') {

            $result = $user->quitInEvent($code_event);
            if (!$result) {
                echo('ERROR: Error');
                return;
            }
            
            $type_change = 0;
            switch ($result) {
                case 1:
                    echo('ERROR: Error');
                    return;
                    break;
                case 2:
                    echo('ERROR: Error');
                    return;
                    break;
                case 3:
                    break;
            }

            $json_result = array('OK'=>'Ok');
            echo(json_encode($json_result));
            return; 
            
        }
        
    }
?>