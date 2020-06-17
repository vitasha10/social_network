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
    
        $idcategory = isset($_POST['pic']) ? (trim($_POST['pic'])) : '';
        $idcategory = $the_sanitaze->int($idcategory);

        $idsubcategory = isset($_POST['pisc']) ? (trim($_POST['pisc'])) : '';
        $idsubcategory = $the_sanitaze->int($idsubcategory);

        $titlepage = isset($_POST['pti']) ? (trim($_POST['pti'])) : '';
        $titlepage = $the_sanitaze->str_nohtml($titlepage);
    
        $urlpage = isset($_POST['pur']) ? (trim($_POST['pur'])) : '';
        $urlpage = $the_sanitaze->str_nohtml($urlpage);
    
        $descriptionpage = isset($_POST['pds']) ? (trim($_POST['pds'])) : '';
        $descriptionpage = $the_sanitaze->str_nohtml($descriptionpage);
        
		if (!$error && !is_numeric($idcategory)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && !is_numeric($idsubcategory)) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($titlepage)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && (empty($urlpage) || !validateUsernamePageOrGroup($urlpage))) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && nameInConflict($urlpage)) { $error = TRUE; $txterror .= $page->lang('dashboard_pages_create_error_username_not_available'); }
		if (!$error && empty($descriptionpage)) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'update') {
    
        $idcategory = isset($_POST['pic']) ? (trim($_POST['pic'])) : '';
        $idcategory = $the_sanitaze->int($idcategory);

        $idsubcategory = isset($_POST['pisc']) ? (trim($_POST['pisc'])) : '';
        $idsubcategory = $the_sanitaze->int($idsubcategory);

        $titlepage = isset($_POST['pti']) ? (trim($_POST['pti'])) : '';
        $titlepage = $the_sanitaze->str_nohtml($titlepage);
    
        $urlpage = isset($_POST['pur']) ? (trim($_POST['pur'])) : '';
        $urlpage = $the_sanitaze->str_nohtml($urlpage);
    
        $descriptionpage = isset($_POST['pds']) ? (trim($_POST['pds'])) : '';
        $descriptionpage = $the_sanitaze->str_nohtml($descriptionpage);
        
        $codepage = isset($_POST['cpg']) ? (trim($_POST['cpg'])) : '';
        $codepage = $the_sanitaze->str_nohtml($codepage, 11);
        
		if (!$error && !is_numeric($idcategory)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && !is_numeric($idsubcategory)) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($titlepage)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && (empty($urlpage) || !validateUsernamePageOrGroup($urlpage))) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && nameInConflict($urlpage)) { $error = TRUE; $txterror .= $page->lang('dashboard_pages_create_error_username_not_available'); }
		if (!$error && empty($descriptionpage)) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($codepage)) { $error = TRUE; $txterror .= 'Error. '; }
        
    }

    if ($ajax_action == 'search') {
    
        $termsearch = isset($_POST['tse']) ? (trim($_POST['tse'])) : '';
        $termsearch = $the_sanitaze->str_nohtml($termsearch);

    	if (!$error && empty($termsearch)) { $error = TRUE; $txterror .= $page->lang('dashboard_pages_search_error_empty_term'); }
    	if (!$error && strlen($termsearch) <= 3) { $error = TRUE; $txterror .= $page->lang('dashboard_pages_search_error_short_term'); }

    }
    
    if ($ajax_action == 'delete') {
            
        $codepage = isset($_POST['code']) ? (trim($_POST['code'])) : '';
        $codepage = $the_sanitaze->str_nohtml($codepage, 11);
        
    	if (!$error && empty($codepage)) { $error = TRUE; $txterror .= 'Error. '; }
        
    }
    
    if ($error) {
        echo('ERROR:'.$txterror);
		return;
    } else {
        
        if ($ajax_action == 'create') {
            
            $response = $page->db2->fetch_field("SELECT count(iduser) FROM users WHERE user_username='".$urlpage."'");
            if ($response > 0) {
                echo('ERROR:'.$page->lang('dashboard_pages_create_error_username_not_available'));
                return;
            }
    
            $response = $page->db2->fetch_field("SELECT count(idpage) FROM pages WHERE puname='".$urlpage."'");
            if ($response > 0) {
                echo('ERROR:'.$page->lang('dashboard_pages_create_error_username_not_available'));
                return;
            }
    
            $response = $page->db2->fetch_field("SELECT count(idgroup) FROM groups WHERE guname='".$urlpage."'");
            if ($response > 0) {
                echo('ERROR:'.$page->lang('dashboard_pages_create_error_username_not_available'));
                return;
            }
            
            $code_page = codeUniqueInTable(11, 1, 'pages', 'code');
            
            $page->db2->query("INSERT INTO pages SET code='".$code_page."', idcreator=".$user->info->iduser.", idcat=".$idcategory.", idsubcat=".$idsubcategory.", title='".$titlepage."', puname='".$urlpage."', description='".$descriptionpage."', created='".time()."', numlikes=1, numfollowers=1");
			
			$idpagen = $page->db2->insert_id();
			
			$page->db2->query("INSERT INTO likes SET iditem=".$idpagen.", typeitem=3, iduser=".$user->info->iduser.", typeuser=0, whendate='".time()."'");
			
			$page->db2->query("INSERT INTO relations SET leader=".$idpagen.", follower=".$user->info->iduser.", type_leader=1, whendate='".time()."'");
			
			$page->db2->query("UPDATE users SET num_pages=num_pages+1 WHERE iduser=".$user->info->iduser." LIMIT 1");

            $json_result = array('urlpage'=>$urlpage);
            echo(json_encode($json_result));
            return;  
            
        }

        if ($ajax_action == 'update') {

            $response = $page->db2->fetch_field("SELECT count(idpage) FROM pages WHERE code='".$codepage."' AND idcreator=".$user->info->iduser);
            if ($response == 0) {
                echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
                return;
            }
            
            $response = $page->db2->fetch_field("SELECT count(iduser) FROM users WHERE user_username='".$urlpage."'");
            if ($response > 0) {
                echo('ERROR:'.$page->lang('dashboard_pages_create_error_username_not_available'));
                return;
            }
    
            $response = $page->db2->fetch_field("SELECT count(idpage) FROM pages WHERE code<>'".$codepage."' AND puname='".$urlpage."'");
            if ($response > 0) {
                echo('ERROR:'.$page->lang('dashboard_pages_create_error_username_not_available'));
                return;
            }

            $response = $page->db2->fetch_field("SELECT count(idgroup) FROM groups WHERE guname='".$urlpage."'");
            if ($response > 0) {
                echo('ERROR:'.$page->lang('dashboard_pages_create_error_username_not_available'));
                return;
            }

            $page->db2->query("UPDATE pages SET idcat=".$idcategory.", idsubcat=".$idsubcategory.", title='".$titlepage."', puname='".$urlpage."', description='".$descriptionpage."' WHERE code='".$codepage."'");   

            $json_result = array('urlpage'=>$urlpage);                    
            echo(json_encode($json_result));
            return;   
            
        }
 
        if ($ajax_action == 'search') {
            
            $all_pages = $page->db2->fetch_all("SELECT * FROM pages WHERE title LIKE '%".$termsearch."%'");
            
            $result_search = '';
            if (count($all_pages) > 0) {
                foreach($all_pages as $onepage) {
                    $D->page_avatar = $K->STORAGE_URL_AVATARS_PAGE.'min3/';
                    if (empty($onepage->avatar)) {
                        $D->page_avatar = $D->page_avatar.$K->DEFAULT_AVATAR_PAGE;
                    } else {
                        $D->page_avatar = $D->page_avatar.$onepage->code.'/'.$onepage->avatar;
                    }
                    $D->the_username_page = stripslashes($onepage->puname);
                    $D->the_title_page = stripslashes($onepage->title);
                    $D->the_category_page = $page->db2->fetch_field("SELECT name FROM pages_cat WHERE idfather=".$onepage->idcat." AND idcategory=".$onepage->idsubcat." LIMIT 1");
                    $D->the_category_page = stripslashes($D->the_category_page);
                    $D->numlikes_page = $onepage->numlikes;
                    if ($D->numlikes_page == 1) $D->txt_like = $page->lang('dashboard_pages_search_txt_like');
                    else $D->txt_like = $page->lang('dashboard_pages_search_txt_likes');
                    $result_search .= $page->load_template('ones/one-page-search.php', FALSE);
                }
            }
            
            if (empty($result_search)) $result_search = $page->lang('dashboard_pages_search_no_found');

            $json_result = array('theresult'=>$result_search);                    
            echo(json_encode($json_result));
            return;  

        }
        
        if ($ajax_action == 'delete') {

            $idpage = $page->db2->fetch_field("SELECT idpage FROM pages WHERE code='".$codepage."' AND idcreator=".$user->info->iduser." LIMIT 1");
            if (!$idpage) echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
         
            if (!$network->deletePage($idpage)) echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
            else echo('OK');
            
            return;

        }
       
    }
?>