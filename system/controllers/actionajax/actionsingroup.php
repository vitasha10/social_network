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

    if ($ajax_action == 'join') {
    
        $codegroup = isset($_POST['cgroup']) ? (trim($_POST['cgroup'])) : '';
        $codegroup = $the_sanitaze->str_nohtml($codegroup, 11);
            
    	if (!$error && empty($codegroup)) { $error = TRUE; $txterror = 'Error. '; }

    }

    if ($ajax_action == 'cancelrequest') {
    
        $codegroup = isset($_POST['cgroup']) ? (trim($_POST['cgroup'])) : '';
        $codegroup = $the_sanitaze->str_nohtml($codegroup, 11);
            
    	if (!$error && empty($codegroup)) { $error = TRUE; $txterror = 'Error. '; }

    }

    if ($ajax_action == 'leavegroup') {
    
        $codegroup = isset($_POST['cgroup']) ? (trim($_POST['cgroup'])) : '';
        $codegroup = $the_sanitaze->str_nohtml($codegroup, 11);
            
    	if (!$error && empty($codegroup)) { $error = TRUE; $txterror = 'Error. '; }

    }

    if ($ajax_action == 'declinerequest') {
    
        $codegroup = isset($_POST['cgroup']) ? (trim($_POST['cgroup'])) : '';
        $codegroup = $the_sanitaze->str_nohtml($codegroup, 11);
        $codeuser = isset($_POST['cuser']) ? (trim($_POST['cuser'])) : '';
        $codeuser = $the_sanitaze->str_nohtml($codeuser, 11);
            
    	if (!$error && empty($codegroup)) { $error = TRUE; $txterror = 'Error. '; }
    	if (!$error && empty($codeuser)) { $error = TRUE; $txterror = 'Error. '; }
    }

    if ($ajax_action == 'approverequest') {
    
        $codegroup = isset($_POST['cgroup']) ? (trim($_POST['cgroup'])) : '';
        $codegroup = $the_sanitaze->str_nohtml($codegroup, 11);
        $codeuser = isset($_POST['cuser']) ? (trim($_POST['cuser'])) : '';
        $codeuser = $the_sanitaze->str_nohtml($codeuser, 11);
            
    	if (!$error && empty($codegroup)) { $error = TRUE; $txterror = 'Error. '; }
    	if (!$error && empty($codeuser)) { $error = TRUE; $txterror = 'Error. '; }
    }

    if ($error) {
        echo('ERROR:'.$txterror);
		return;
    } else {
        
        if ($ajax_action == 'join') {

            if (!$user->sendRequestToGroup($codegroup)) {
                echo('ERROR:Error');
                return;
            }

            echo('OK');
            return;  
            
        }

        if ($ajax_action == 'cancelrequest') {

            if (!$user->cancelRequestToGroup($codegroup)) {
                echo('ERROR:Error');
                return;
            }

            echo('OK');
            return;  
            
        }

        if ($ajax_action == 'leavegroup') {

            if (!$user->leaveToGroup($codegroup)) {
                echo('ERROR:Error');
                return;
            }

            echo('OK');
            return;  
            
        }

        if ($ajax_action == 'declinerequest') {
            
            $idgroup = $page->db2->fetch_field("SELECT idgroup FROM groups WHERE code='".$codegroup."' LIMIT 1");
            if (!$idgroup) {
                echo('ERROR:Error');
                return;
            }

            $iduser = $page->db2->fetch_field("SELECT iduser FROM users WHERE code='".$codeuser."' LIMIT 1");
            if (!$iduser) {
                echo('ERROR:Error');
                return;
            }
    
            $numsrecords = $page->db2->fetch_field('SELECT count(id) FROM groups_members WHERE status=0 AND iduser='.$iduser.' AND idgroup='.$idgroup);
            if ($numsrecords == 0) {
                echo('ERROR:Error');
                return;
            } else {
                $idcreator = $page->db2->fetch_field("SELECT idcreator FROM groups WHERE idgroup=".$idgroup." LIMIT 1");
                $page->db2->query('DELETE FROM groups_members WHERE iduser='.$iduser.' AND idgroup='.$idgroup);
    
                $notifications_in_user = $page->db2->fetch_field('SELECT num_notifications_global FROM users WHERE iduser='.$idcreator.' LIMIT 1');
                
                $page->db2->query("DELETE FROM notifications WHERE type_notif=10 AND typeitem_notif=4 AND iditem_notif=".$idgroup." AND to_user=".$idcreator." AND from_user=".$iduser." AND from_user_type=0");
                $affected_rows = $page->db2->affected_rows();
                if ($affected_rows > $notifications_in_user) $affected_rows = $notifications_in_user;
                $page->db2->query('UPDATE users SET num_notifications_global=num_notifications_global-'.$affected_rows.' WHERE iduser='.$idcreator.' LIMIT 1');

                echo('OK');
                return;  

            }

        }
  
        if ($ajax_action == 'approverequest') {

            $idgroup = $page->db2->fetch_field("SELECT idgroup FROM groups WHERE code='".$codegroup."' LIMIT 1");
            if (!$idgroup) {
                echo('ERROR:Error');
                return;
            }

            $iduser = $page->db2->fetch_field("SELECT iduser FROM users WHERE code='".$codeuser."' LIMIT 1");
            if (!$iduser) {
                echo('ERROR:Error');
                return;
            }
            
			$numsrecords = $page->db2->fetch_field('SELECT count(id) FROM groups_members WHERE iduser='.$iduser.' AND idgroup='.$idgroup.' AND status=0');
            if ($numsrecords <= 0) {
                echo('ERROR:Error');
                return;
            } else {

				$page->db2->query('UPDATE groups_members SET accepted_by='.$user->id.', when_accepted="'.time().'", status=1 WHERE iduser='.$iduser.' AND idgroup='.$idgroup);
	
				$page->db2->query("DELETE FROM notifications WHERE type_notif=10 AND typeitem_notif=4 AND to_user=".$user->id." AND from_user=".$iduser." AND iditem_notif=".$idgroup);
                
				$affected_rows = $page->db2->affected_rows();
				if ($affected_rows > $user->info->num_notifications_global) $affected_rows = $user->info->num_notifications_global;
				$page->db2->query('UPDATE users SET num_notifications_global=num_notifications_global-'.$affected_rows.' WHERE iduser="'.$user->id.'" LIMIT 1');
				
				$page->db2->query('UPDATE groups SET nummembers=nummembers+1, numfollowers=numfollowers+1 WHERE idgroup='.$idgroup.' LIMIT 1');
	
				$page->db2->query("INSERT INTO notifications SET type_notif=11, typeitem_notif=4, to_user=".$iduser.", iditem_notif=".$idgroup.", from_user=".$user->id.", from_user_type=0, whendate='".time()."'");				
	
				$page->db2->query('UPDATE users SET num_notifications_global=num_notifications_global+1 WHERE iduser="'.$iduser.'" LIMIT 1');
	
				//add in relations
				$page->db2->query('INSERT INTO relations SET type_leader=2, follower='.$iduser.', leader='.$idgroup.', whendate="'.time().'"');
				
                echo('OK');
                return;

			}
            
        }
        
    }
?>