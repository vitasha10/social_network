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
    $network = & $GLOBALS['network'];
    
    $page->loadLanguage('global.php');
    $page->loadLanguage('dashboard.php');

    if (!$user->is_logged) { 
        echo('ERROR:'.$page->lang('global_txt_no_session'));
        return;
    }
    
    $the_sanitaze = new sanitize(); // init sanitaze
    
    $error = FALSE;

    if ($ajax_action == 'create') {
    
        $nameevent = isset($_POST['ena']) ? (trim($_POST['ena'])) : '';
        $nameevent = $the_sanitaze->str_nohtml($nameevent);
    
        $locationevent = isset($_POST['elo']) ? (trim($_POST['elo'])) : '';
        $locationevent = $the_sanitaze->str_nohtml($locationevent);
    
        $descriptionevent = isset($_POST['ede']) ? (trim($_POST['ede'])) : '';
        $descriptionevent = $the_sanitaze->str_nohtml($descriptionevent);

        $datestart = isset($_POST['dts']) ? (trim($_POST['dts'])) : '';
        $datestart = $the_sanitaze->str_nohtml($datestart);
        $timestart = isset($_POST['tms']) ? (trim($_POST['tms'])) : '';
        $timestart = $the_sanitaze->str_nohtml($timestart);
        $dateend = isset($_POST['dte']) ? (trim($_POST['dte'])) : '';
        $dateend = $the_sanitaze->str_nohtml($dateend);
        $timeend = isset($_POST['tme']) ? (trim($_POST['tme'])) : '';
        $timeend = $the_sanitaze->str_nohtml($timeend);
    
    	if (!$error && empty($nameevent)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($locationevent)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($datestart)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($timestart)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($dateend)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($timeend)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($descriptionevent)) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'update') {
        
        $codeevent = isset($_POST['code']) ? (trim($_POST['code'])) : '';
        $codeevent = $the_sanitaze->str_nohtml($codeevent, 11);

        $nameevent = isset($_POST['ena']) ? (trim($_POST['ena'])) : '';
        $nameevent = $the_sanitaze->str_nohtml($nameevent);
    
        $locationevent = isset($_POST['elo']) ? (trim($_POST['elo'])) : '';
        $locationevent = $the_sanitaze->str_nohtml($locationevent);
    
        $descriptionevent = isset($_POST['ede']) ? (trim($_POST['ede'])) : '';
        $descriptionevent = $the_sanitaze->str_nohtml($descriptionevent);
        
        $datestart = isset($_POST['dts']) ? (trim($_POST['dts'])) : '';
        $datestart = $the_sanitaze->str_nohtml($datestart);
        $timestart = isset($_POST['tms']) ? (trim($_POST['tms'])) : '';
        $timestart = $the_sanitaze->str_nohtml($timestart);
        $dateend = isset($_POST['dte']) ? (trim($_POST['dte'])) : '';
        $dateend = $the_sanitaze->str_nohtml($dateend);
        $timeend = isset($_POST['tme']) ? (trim($_POST['tme'])) : '';
        $timeend = $the_sanitaze->str_nohtml($timeend);
    
    	if (!$error && empty($codeevent)) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($nameevent)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($locationevent)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($datestart)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($timestart)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($dateend)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($timeend)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($descriptionevent)) { $error = TRUE; $txterror .= 'Error. '; }

    }
    
    if ($ajax_action == 'delete') {
        
        $codeevent = isset($_POST['code']) ? (trim($_POST['code'])) : '';
        $codeevent = $the_sanitaze->str_nohtml($codeevent, 11);
    
    	if (!$error && empty($codeevent)) { $error = TRUE; $txterror .= 'Error. '; }

    }

    
    if ($error) {
        echo('ERROR:'.$txterror);
		return;
    } else {
        
        if ($ajax_action == 'create') {
            
            $thedate_start = setFormatDateForDB($datestart, $page->lang('dashboard_myevents_create_format_date'));
            $thedate_start_db = date('Y-m-d', strtotime($thedate_start));
            $thetime_start_db = date('H:i:s', strtotime($timestart));
            $start_unix = strtotime($thedate_start.' '.$timestart);
            
            $thedate_end = setFormatDateForDB($dateend, $page->lang('dashboard_myevents_create_format_date'));
            $thedate_end_db = date('Y-m-d', strtotime($thedate_end));
            $thetime_end_db = date('H:i:s', strtotime($timeend));
            $end_unix = strtotime($thedate_end.' '.$timeend);            
            
            
            $code_event = codeUniqueInTable(11, 1, 'events', 'code');
            
            $page->db2->query("INSERT INTO events SET code='".$code_event."', idcreator=".$user->info->iduser.", privacy=0, title='".$nameevent."', address='".$locationevent."', description='".$descriptionevent."', date_start='".$thedate_start_db."', time_start='".$thetime_start_db."', start_unix='".$start_unix."', date_end='".$thedate_end_db."', time_end='".$thetime_end_db."', end_unix='".$end_unix."', created='".time()."'");
			
			$ideventnew = $page->db2->insert_id();
			
			$page->db2->query("INSERT INTO events_actions SET idevent=".$ideventnew.", iduser=".$user->info->iduser.", type_action=2");
			
			$page->db2->query("INSERT INTO relations SET leader=".$ideventnew.", follower=".$user->info->iduser.", type_leader=3, whendate='".time()."'");
			
			$page->db2->query("UPDATE users SET num_events=num_events+1 WHERE iduser=".$user->info->iduser." LIMIT 1");
            
            /******************/
            
            $np = new newpost();				

            $np->moreInfo($user->info->code, 0, 0, $user->info->code, 0, '', '', '');
            
            $np->setMessage($descriptionevent);
            $np->setTypePost(7);
            $idpost = $np->save();
            
            $page->db2->query("UPDATE events SET idpost=".$idpost." WHERE idevent=".$ideventnew." LIMIT 1");
                
            /****************/

            $json_result = array('codeevent'=>$code_event);
            echo(json_encode($json_result));
            return;  
            
        }


        if ($ajax_action == 'update') {

            $event = $page->db2->fetch("SELECT * FROM events WHERE code='".$codeevent."' AND idcreator=".$user->info->iduser);
            if (!$event) {
                echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
                return;
            }
            
            $idpost = $event->idpost;
            
            $thedate_start = setFormatDateForDB($datestart, $page->lang('dashboard_myevents_create_format_date'));
            $thedate_start_db = date('Y-m-d', strtotime($thedate_start));
            $thetime_start_db = date('H:i:s', strtotime($timestart));
            $start_unix = strtotime($thedate_start.' '.$timestart);
            
            $thedate_end = setFormatDateForDB($dateend, $page->lang('dashboard_myevents_create_format_date'));
            $thedate_end_db = date('Y-m-d', strtotime($thedate_end));
            $thetime_end_db = date('H:i:s', strtotime($timeend));
            $end_unix = strtotime($thedate_end.' '.$timeend); 

            $page->db2->query("UPDATE events SET title='".$nameevent."', address='".$locationevent."', description='".$descriptionevent."', date_start='".$thedate_start_db."', time_start='".$thetime_start_db."', start_unix='".$start_unix."', date_end='".$thedate_end_db."', time_end='".$thetime_end_db."', end_unix='".$end_unix."' WHERE code='".$codeevent."' LIMIT 1");
            
            $page->db2->query("UPDATE posts SET message='".$descriptionevent."' WHERE idpost=".$idpost." LIMIT 1");

            $json_result = array('codeevent'=>$codeevent);
            echo(json_encode($json_result));
            return;  
            
        }
        
        if ($ajax_action == 'delete') {

            $idevent = $page->db2->fetch_field("SELECT idevent FROM events WHERE code='".$codeevent."' AND idcreator=".$user->info->iduser." LIMIT 1");
            if (!$idevent) {
                echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
                return;
            }
            
            if (!$network->deleteEvent($idevent)) {
                echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
                return;
            } else {
                $json_result = array('codeevent'=>$codeevent);
                echo(json_encode($json_result));
                return; 
            }
  
        }

        
    }
?>