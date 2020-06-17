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
    
        $titlegroup = isset($_POST['gti']) ? (trim($_POST['gti'])) : '';
        $titlegroup = $the_sanitaze->str_nohtml($titlegroup);
    
        $urlgroup = isset($_POST['gur']) ? (trim($_POST['gur'])) : '';
        $urlgroup = $the_sanitaze->str_nohtml($urlgroup);
    
        $descriptiongroup = isset($_POST['gds']) ? (trim($_POST['gds'])) : '';
        $descriptiongroup = $the_sanitaze->str_nohtml($descriptiongroup);
    
        $privacygroup = isset($_POST['gpr']) ? (trim($_POST['gpr'])) : '';
        $privacygroup = $the_sanitaze->int($privacygroup);
        
    	if (!$error && empty($titlegroup)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && (empty($urlgroup) || !validateUsernamePageOrGroup($urlgroup))) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && nameInConflict($urlgroup)) { $error = TRUE; $txterror .= $page->lang('dashboard_groups_create_error_username_not_available'); }
		if (!$error && empty($descriptiongroup)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && !is_numeric($privacygroup)) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'update') {
    
        $titlegroup = isset($_POST['gti']) ? (trim($_POST['gti'])) : '';
        $titlegroup = $the_sanitaze->str_nohtml($titlegroup);
    
        $urlgroup = isset($_POST['gur']) ? (trim($_POST['gur'])) : '';
        $urlgroup = $the_sanitaze->str_nohtml($urlgroup);
    
        $descriptiongroup = isset($_POST['gds']) ? (trim($_POST['gds'])) : '';
        $descriptiongroup = $the_sanitaze->str_nohtml($descriptiongroup);
    
        $privacygroup = isset($_POST['gpr']) ? (trim($_POST['gpr'])) : '';
        $privacygroup = $the_sanitaze->int($privacygroup);
        
        $codegroup = isset($_POST['cgr']) ? (trim($_POST['cgr'])) : '';
        $codegroup = $the_sanitaze->str_nohtml($codegroup, 11);
        
    	if (!$error && empty($titlegroup)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && (empty($urlgroup) || !validateUsernamePageOrGroup($urlgroup))) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && nameInConflict($urlgroup)) { $error = TRUE; $txterror .= $page->lang('dashboard_groups_create_error_username_not_available'); }
		if (!$error && empty($descriptiongroup)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && !is_numeric($privacygroup)) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($codegroup)) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'search') {
    
        $termsearch = isset($_POST['tse']) ? (trim($_POST['tse'])) : '';
        $termsearch = $the_sanitaze->str_nohtml($termsearch);

    	if (!$error && empty($termsearch)) { $error = TRUE; $txterror .= $page->lang('dashboard_groups_search_error_empty_term'); }
    	if (!$error && strlen($termsearch) <= 3) { $error = TRUE; $txterror .= $page->lang('dashboard_groups_search_error_short_term'); }

    }
    
    if ($ajax_action == 'delete') {
    
        $codegroup = isset($_POST['code']) ? (trim($_POST['code'])) : '';
        $codegroup = $the_sanitaze->str_nohtml($codegroup, 11);

    	if (!$error && empty($codegroup)) { $error = TRUE; $txterror .= 'Error. '; }

    }
    
    if ($error) {
        echo('ERROR:'.$txterror);
		return;
    } else {
        
        if ($ajax_action == 'create') {
            
            $response = $page->db2->fetch_field("SELECT count(iduser) FROM users WHERE user_username='".$urlgroup."'");
            if ($response > 0) {
                echo('ERROR:'.$page->lang('dashboard_groups_create_error_username_not_available'));
                return;
            }
    
            $response = $page->db2->fetch_field("SELECT count(idpage) FROM pages WHERE puname='".$urlgroup."'");
            if ($response > 0) {
                echo('ERROR:'.$page->lang('dashboard_groups_create_error_username_not_available'));
                return;
            }
    
            $response = $page->db2->fetch_field("SELECT count(idgroup) FROM groups WHERE guname='".$urlgroup."'");
            if ($response > 0) {
                echo('ERROR:'.$page->lang('dashboard_groups_create_error_username_not_available'));
                return;
            }
            
            $code_group = codeUniqueInTable(11, 1, 'groups', 'code');
            
            $page->db2->query("INSERT INTO groups SET code='".$code_group."', idcreator=".$user->info->iduser.", privacy=".$privacygroup.", title='".$titlegroup."', guname='".$urlgroup."', about='".$descriptiongroup."', created='".time()."', nummembers=1, numfollowers=1");
			
			$idgroupn = $page->db2->insert_id();
			
			$page->db2->query("INSERT INTO groups_members SET idgroup=".$idgroupn.", iduser=".$user->info->iduser.", when_request='".time()."', when_accepted='".time()."', added_by=".$user->info->iduser.", accepted_by=".$user->info->iduser.", status=1, is_admin=1");
			
			$page->db2->query("INSERT INTO relations SET leader=".$idgroupn.", follower=".$user->info->iduser.", type_leader=2, whendate='".time()."'");
			
			$page->db2->query("UPDATE users SET num_groups=num_groups+1 WHERE iduser=".$user->info->iduser." LIMIT 1");

            $json_result = array('urlgroup'=>$urlgroup);
            echo(json_encode($json_result));
            return;  
            
        }


        if ($ajax_action == 'update') {

            $response = $page->db2->fetch_field("SELECT count(idgroup) FROM groups WHERE code='".$codegroup."' AND idcreator=".$user->info->iduser);
            if ($response == 0) {
                echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
                return;
            }
            
            $response = $page->db2->fetch_field("SELECT count(iduser) FROM users WHERE user_username='".$urlgroup."'");
            if ($response > 0) {
                echo('ERROR:'.$page->lang('dashboard_groups_create_error_username_not_available'));
                return;
            }
    
            $response = $page->db2->fetch_field("SELECT count(idpage) FROM pages WHERE puname='".$urlgroup."'");
            if ($response > 0) {
                echo('ERROR:'.$page->lang('dashboard_groups_create_error_username_not_available'));
                return;
            }
    
            $response = $page->db2->fetch_field("SELECT count(idgroup) FROM groups WHERE code<>'".$codegroup."' AND guname='".$urlgroup."'");
            if ($response > 0) {
                echo('ERROR:'.$page->lang('dashboard_groups_create_error_username_not_available'));
                return;
            }

            $page->db2->query("UPDATE groups SET privacy=".$privacygroup.", title='".$titlegroup."', guname='".$urlgroup."', about='".$descriptiongroup."' WHERE code='".$codegroup."'");

            $json_result = array('urlgroup'=>$urlgroup);
            echo(json_encode($json_result));
            return;  
            
        }

        if ($ajax_action == 'search') {
            
            $all_groups = $page->db2->fetch_all("SELECT * FROM groups WHERE title LIKE '%".$termsearch."%' AND privacy<>2");
            
            $result_search = '';
            if (count($all_groups) > 0) {
                foreach($all_groups as $onegroup) {
                    $D->group_avatar = $K->STORAGE_URL_COVERS_GROUP;
                    $D->with_cover = FALSE;
                    if (!empty($onegroup->cover)) {
                        $D->with_cover = TRUE;
                        $D->group_avatar = $D->group_avatar.$onegroup->code.'/'.$onegroup->cover;
                    }
                    
                    $D->the_username_group = stripslashes($onegroup->guname);
                    $D->the_title_group = stripslashes($onegroup->title);
                    $D->nummembers_group = $onegroup->nummembers;
                    if ($D->nummembers_group == 1) $D->txt_members = $page->lang('dashboard_groups_search_txt_member');
                    else $D->txt_members = $page->lang('dashboard_groups_search_txt_members');
                    $result_search .= $page->load_template('ones/one-group-search.php', FALSE);
                }
            }
            
            if (empty($result_search)) $result_search = $page->lang('dashboard_pages_search_no_found');

            $json_result = array('theresult'=>$result_search);
            echo(json_encode($json_result));
            return;

        }
        
        if ($ajax_action == 'delete') {
            
            $idgroup = $page->db2->fetch_field("SELECT idgroup FROM groups WHERE code='".$codegroup."' AND idcreator=".$user->info->iduser);
            if (!$idgroup) {
                echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
                return;
            }

            if (!$network->deleteGroup($idgroup)) {
                echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
                return;
            } else {
                echo('OK');
                return;
            }
            
        }

        
    }
?>