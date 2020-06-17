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

    if ($ajax_action == 'publish') {
        
        $titlearticle = isset($_POST['tta']) ? (trim($_POST['tta'])) : '';
        $titlearticle = $the_sanitaze->str_nohtml($titlearticle);
        
        $idcategory = isset($_POST['idca']) ? (trim($_POST['idca'])) : '';
        $idcategory = $the_sanitaze->int($idcategory);

        $idsubcategory = isset($_POST['idsca']) ? (trim($_POST['idsca'])) : '';
        $idsubcategory = $the_sanitaze->int($idsubcategory);
    
        $summaryarticle = isset($_POST['smrya']) ? (trim($_POST['smrya'])) : '';
        $summaryarticle = $the_sanitaze->str_nohtml($summaryarticle);
    
        $thecontent = isset($_POST['conta']) ? (trim($_POST['conta'])) : '';
        $thecontent = $the_sanitaze->str_nohtml($thecontent);
        
        $the_photo = $_FILES['imagenfile'];
    
    	if (!$error && empty($titlearticle)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $idcategory < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $idsubcategory < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($summaryarticle)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($thecontent)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($the_photo)) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'update') {
        
        $codearticle = isset($_POST['codea']) ? (trim($_POST['codea'])) : '';
        $codearticle = $the_sanitaze->str_nohtml($codearticle, 11);
        
        $titlearticle = isset($_POST['tta']) ? (trim($_POST['tta'])) : '';
        $titlearticle = $the_sanitaze->str_nohtml($titlearticle);
        
        $idcategory = isset($_POST['idca']) ? (trim($_POST['idca'])) : '';
        $idcategory = $the_sanitaze->int($idcategory);

        $idsubcategory = isset($_POST['idsca']) ? (trim($_POST['idsca'])) : '';
        $idsubcategory = $the_sanitaze->int($idsubcategory);
    
        $summaryarticle = isset($_POST['smrya']) ? (trim($_POST['smrya'])) : '';
        $summaryarticle = $the_sanitaze->str_nohtml($summaryarticle);
    
        $thecontent = isset($_POST['conta']) ? (trim($_POST['conta'])) : '';
        $thecontent = $the_sanitaze->str_nohtml($thecontent);

        $dochange = isset($_POST['chgi']) ? (trim($_POST['chgi'])) : '';
        $dochange = $the_sanitaze->str_nohtml($dochange);
        
        if ($dochange == '1') {
            $the_photo = $_FILES['imagenfile'];
        }
    
    	if (!$error && empty($codearticle)) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($titlearticle)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $idcategory < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $idsubcategory < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($summaryarticle)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($thecontent)) { $error = TRUE; $txterror .= 'Error. '; }
        if ($dochange == '1') {
		    if (!$error && empty($the_photo)) { $error = TRUE; $txterror .= 'Error. '; }
        }

    }
    
    if ($ajax_action == 'delete') {
        $codearticle = isset($_POST['code']) ? (trim($_POST['code'])) : '';
        $codearticle = $the_sanitaze->str_nohtml($codearticle, 11);
    
    	if (!$error && empty($codearticle)) { $error = TRUE; $txterror .= 'Error. '; }
    }

    
    if ($error) {
        echo('ERROR:'.$txterror);
		return;
    } else {
        
        if ($ajax_action == 'publish') {

            $code_article = codeUniqueInTable(11, 1, 'articles', 'code');
            
            $fname = '';
            if ($the_photo['name']) { 
                if ($the_photo['size'] > $K->FILE_SIZE_PHOTO_ARTICLES || $the_photo['size'] == 0) {
                    echo('ERROR: Error.');
                    return;
                }
                
                $file_type = $the_photo['type'];
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
                    echo('ERROR: Error.');
                    return;
                }

                $fname = $code_article.$file_extension;
                move_uploaded_file($the_photo['tmp_name'], $K->STORAGE_DIR_ARTICLES.$fname);
                
                $the_pholder_1 = $K->STORAGE_DIR_ARTICLES.'min1/';
                $the_pholder_2 = $K->STORAGE_DIR_ARTICLES.'min2/';
                
                $thumbnail = new imagen($K->STORAGE_DIR_ARTICLES.$fname);
                $thumbnail->resizeImage($K->WIDTH_PHOTO_ARTICLE_1, $K->WIDTH_PHOTO_ARTICLE_1, 'landscape');
                $thumbnail->saveImage($the_pholder_1.'/'.$fname);

                $thumbnail = new imagen($K->STORAGE_DIR_ARTICLES.$fname);
                $thumbnail->resizeImage($K->WIDTH_PHOTO_ARTICLE_2, $K->WIDTH_PHOTO_ARTICLE_2, 'landscape');
                $thumbnail->saveImage($the_pholder_2.'/'.$fname);
                
            }
            
            $page->db2->query("INSERT INTO articles SET code='".$code_article."', idwriter=".$user->info->iduser.", title='".$titlearticle."', idcategory=".$idcategory.", idsubcategory=".$idsubcategory.", summary='".$summaryarticle."', text_article='".$thecontent."', photo='".$fname."', tags='', whendate='".time()."'");
			
			$idarticle = $page->db2->insert_id();
			
			$page->db2->query("UPDATE users SET num_articles=num_articles+1 WHERE iduser=".$user->info->iduser." LIMIT 1");
            
            /******************/
            
            $np = new newpost();				
            $np->moreInfo($user->info->code, 0, 0, $user->info->code, 0, '', '', '');
            $np->setMessage('');
            $np->setTypePost(11);
            $idpost = $np->save();
            
            $page->db2->query("UPDATE articles SET idpost=".$idpost." WHERE idarticle=".$idarticle." LIMIT 1");
                
            /****************/
            
            
            $json_result = array('codearticle'=>$code_article);
            echo(json_encode($json_result));
            return;  
            
        }


        if ($ajax_action == 'update') {
            
            $article = $page->db2->fetch("SELECT * FROM articles WHERE code='".$codearticle."' AND idwriter=".$user->info->iduser);
            if (!$article) {
                echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
                return;
            }
            
            $sql_photo = '';
            
            if ($dochange == '1') {
            
                if ($the_photo['name']) { 
                    if ($the_photo['size'] > $K->FILE_SIZE_PHOTO_ARTICLES || $the_photo['size'] == 0) {
                        echo('ERROR: Error.');
                        return;
                    }
                    
                    $file_type = $the_photo['type'];
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
                        echo('ERROR: Error.');
                        return;
                    }

                    $the_pholder_1 = $K->STORAGE_DIR_ARTICLES.'min1/';
                    $the_pholder_2 = $K->STORAGE_DIR_ARTICLES.'min2/';
                    
                    if (!empty($article->photo)) {
                        $the_file = $K->STORAGE_DIR_ARTICLES.$article->photo;
                        if (file_exists($the_file)) @unlink($the_file);
                        
                        $the_file = $the_pholder_1.$article->photo;
                        if (file_exists($the_file)) @unlink($the_file);
                        
                        $the_file = $the_pholder_2.$article->photo;
                        if (file_exists($the_file)) @unlink($the_file);
                    }
    
                    $fname = $article->code.$file_extension;
                    move_uploaded_file($the_photo['tmp_name'], $K->STORAGE_DIR_ARTICLES.$fname);
                    
                    $thumbnail = new imagen($K->STORAGE_DIR_ARTICLES.$fname);
                    $thumbnail->resizeImage($K->WIDTH_PHOTO_ARTICLE_1, $K->WIDTH_PHOTO_ARTICLE_1, 'landscape');
                    $thumbnail->saveImage($the_pholder_1.'/'.$fname);
    
                    $thumbnail = new imagen($K->STORAGE_DIR_ARTICLES.$fname);
                    $thumbnail->resizeImage($K->WIDTH_PHOTO_ARTICLE_2, $K->WIDTH_PHOTO_ARTICLE_2, 'landscape');
                    $thumbnail->saveImage($the_pholder_2.'/'.$fname);
                    
                    $sql_photo = ", photo='".$fname."'";
                    
                }
                
            }

            $page->db2->query("UPDATE articles SET title='".$titlearticle."', idcategory=".$idcategory.", idsubcategory=".$idsubcategory.", summary='".$summaryarticle."', text_article='".$thecontent."'".$sql_photo." WHERE code='".$codearticle."' AND idwriter=".$user->info->iduser." LIMIT 1");
            
            $json_result = array('codearticle'=>$codearticle);
            echo(json_encode($json_result));
            return;
            
        }
        
        if ($ajax_action == 'delete') {

            $idarticle = $page->db2->fetch_field("SELECT idarticle FROM articles WHERE code='".$codearticle."' AND idwriter=".$user->info->iduser." LIMIT 1");
            if (!$idarticle) {
                echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
                return;
            }

            if (!$network->deleteArticle($idarticle)) {
                echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
            } else {
                $json_result = array('codearticle'=>$codearticle);
                echo(json_encode($json_result));
            }

            return; 
            
        }

        
    }
?>