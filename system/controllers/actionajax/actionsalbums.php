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
        
        $titlealbum = isset($_POST['titlealbum']) ? (trim($_POST['titlealbum'])) : '';
        $titlealbum = $the_sanitaze->str_nohtml($titlealbum);

        $descriptionalbum = isset($_POST['descriptionalbum']) ? (trim($_POST['descriptionalbum'])) : '';
        $descriptionalbum = $the_sanitaze->str_nohtml($descriptionalbum);
        
        $privacyalbum = isset($_POST['privacyalbum']) ? (trim($_POST['privacyalbum'])) : '';
        $privacyalbum = $the_sanitaze->int($privacyalbum);

        $numphotos = isset($_POST['numphotos']) ? (trim($_POST['numphotos'])) : 0;
        $numphotos = $the_sanitaze->int($numphotos);

        $filesphotos = $_FILES['filesphotos'];
    
    	if (!$error && empty($titlealbum)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $privacyalbum < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $numphotos < 0) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'update') {

        $codealbum = isset($_POST['cda']) ? (trim($_POST['cda'])) : '';
        $codealbum = $the_sanitaze->str_nohtml($codealbum, 11);
        
        $titlealbum = isset($_POST['tta']) ? (trim($_POST['tta'])) : '';
        $titlealbum = $the_sanitaze->str_nohtml($titlealbum);

        $descriptionalbum = isset($_POST['dca']) ? (trim($_POST['dca'])) : '';
        $descriptionalbum = $the_sanitaze->str_nohtml($descriptionalbum);
        
        $privacyalbum = isset($_POST['pva']) ? (trim($_POST['pva'])) : '';
        $privacyalbum = $the_sanitaze->int($privacyalbum);

        if (!$error && empty($codealbum)) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($titlealbum)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $privacyalbum < 0) { $error = TRUE; $txterror .= 'Error. '; }

    }
    
    if ($ajax_action == 'delete') {
        $codealbum = isset($_POST['code']) ? (trim($_POST['code'])) : '';
        $codealbum = $the_sanitaze->str_nohtml($codealbum, 11);
    
    	if (!$error && empty($codealbum)) { $error = TRUE; $txterror .= 'Error. '; }
    }
    
    if ($ajax_action == 'addphotos') {
        $codealbum = isset($_POST['coda']) ? (trim($_POST['coda'])) : '';
        $codealbum = $the_sanitaze->str_nohtml($codealbum, 11);
        
        $numphotos = isset($_POST['numphotos']) ? (trim($_POST['numphotos'])) : 0;
        $numphotos = $the_sanitaze->int($numphotos);

        $filesphotos = $_FILES['filesphotos'];
    
    	if (!$error && empty($codealbum)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $numphotos < 0) { $error = TRUE; $txterror .= 'Error. '; }
    }
    
    if ($ajax_action == 'deletephoto') {
        $codealbum = isset($_POST['codea']) ? (trim($_POST['codea'])) : '';
        $codealbum = $the_sanitaze->str_nohtml($codealbum, 11);

        $codephoto = isset($_POST['codep']) ? (trim($_POST['codep'])) : '';
        $codephoto = $the_sanitaze->str_nohtml($codephoto, 11);
    
    	if (!$error && empty($codealbum)) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($codephoto)) { $error = TRUE; $txterror .= 'Error. '; }
    }

    
    if ($error) {
        echo('ERROR:'.$txterror);
		return;
    } else {
        
        if ($ajax_action == 'create') {

            $code_album = codeUniqueInTable(11, 1, 'albums', 'code');
            
            $numphotos = 0;
            
            if ($filesphotos['name'][0]) {
                
                $numphotos = count($filesphotos['name']);
                
                $photos = array();
                $tmp_photos = array();
                
                for ($i = 0; $i < $numphotos; $i++) {

                    if ($filesphotos['size'][$i] > $K->FILE_SIZE_PHOTO || $filesphotos['size'][$i]==0){
                        $error = TRUE;
                        $res = $page->lang('dashboard_albums_create_error_filebig');
                        break;
                    }

                    $file_type = $filesphotos['type'][$i];
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
                        $error = TRUE;
                        $res = $page->lang('dashboard_albums_create_error_formatimage');
                        break;
                    }
                    
                    $tmp_photos[] = $filesphotos['tmp_name'][$i];
                    $photos[] = $code_album.'-'.$i.$file_extension;

                }
                
            } else $res = $page->lang('dashboard_albums_create_error_photo');
            
            if ($error) {
                echo('ERROR:'.$res);
                return;
            }
            
            
            if (!$error) {
                
                $page->db2->query("INSERT INTO albums SET code='".$code_album."', idcreator=".$user->info->iduser.", title='".$titlealbum."', privacy=".$privacyalbum.", description='".$descriptionalbum."', numphotos=".$numphotos.", created='".time()."', modified='".time()."'");
                
                $idalbum = $page->db2->insert_id();

                $the_pholder_original = $K->STORAGE_DIR_ALBUMS_USERS.'original/'.$user->info->code;
                if (!file_exists($the_pholder_original)) {
                    mkdir($the_pholder_original, 0777, true);
                    $findex = fopen($the_pholder_original.'/index.html', "a");
                }

                $the_pholder_thumb1 = $K->STORAGE_DIR_ALBUMS_USERS.'thumb1/'.$user->info->code;
                if (!file_exists($the_pholder_thumb1)) {
                    mkdir($the_pholder_thumb1, 0777, true);
                    $findex = fopen($the_pholder_thumb1.'/index.html', "a");
                }

                $the_pholder_thumb2 = $K->STORAGE_DIR_ALBUMS_USERS.'thumb2/'.$user->info->code;
                if (!file_exists($the_pholder_thumb2)) {
                    mkdir($the_pholder_thumb2, 0777, true);
                    $findex = fopen($the_pholder_thumb2.'/index.html', "a");
                }

                $the_pholder_thumb3 = $K->STORAGE_DIR_ALBUMS_USERS.'thumb3/'.$user->info->code;
                if (!file_exists($the_pholder_thumb3)) {
                    mkdir($the_pholder_thumb3, 0777, true);
                    $findex = fopen($the_pholder_thumb3.'/index.html', "a");
                }

                $the_pholder_thumb4 = $K->STORAGE_DIR_ALBUMS_USERS.'thumb4/'.$user->info->code;
                if (!file_exists($the_pholder_thumb4)) {
                    mkdir($the_pholder_thumb4, 0777, true);
                    $findex = fopen($the_pholder_thumb4.'/index.html', "a");
                }

                foreach($photos as $key => $fname) {
                    
                    move_uploaded_file($tmp_photos[$key], $the_pholder_original.'/'.$fname);

                    $thumbnail = new imagen($the_pholder_original.'/'.$fname);

                    $the_width = $thumbnail->getWidth();
                    $the_height = $thumbnail->getHeight();

                    if ($the_width > $K->WIDTH_PHOTO_1 || $the_height > $K->WIDTH_PHOTO_1) {
                        $thumbnail->resizeImage($K->WIDTH_PHOTO_1, $K->WIDTH_PHOTO_1, 'landscape');
                        $thumbnail->saveImage($the_pholder_thumb1.'/'.$fname);
                    } else {
                        copy($the_pholder_original.'/'.$fname, $the_pholder_thumb1.'/'.$fname);
                    }

                    if ($the_width > $K->WIDTH_PHOTO_2 || $the_height > $K->WIDTH_PHOTO_2) {
                        $thumbnail = new imagen($the_pholder_original.'/'.$fname);
                        $thumbnail->resizeImage($K->WIDTH_PHOTO_2, $K->WIDTH_PHOTO_2, 'landscape');
                        $thumbnail->saveImage($the_pholder_thumb2.'/'.$fname);
                    } else {
                        copy($the_pholder_original.'/'.$fname, $the_pholder_thumb2.'/'.$fname);
                    }

                    if ($the_width > $K->WIDTH_PHOTO_3 || $the_height > $K->WIDTH_PHOTO_3) {
                        $thumbnail = new imagen($the_pholder_original.'/'.$fname);
                        $thumbnail->resizeImage($K->WIDTH_PHOTO_3, $K->WIDTH_PHOTO_3, 'landscape');
                        $thumbnail->saveImage($the_pholder_thumb3.'/'.$fname);
                    } else {
                        copy($the_pholder_original.'/'.$fname, $the_pholder_thumb3.'/'.$fname);
                    }

                    if ($the_width > $K->WIDTH_PHOTO_4 || $the_height > $K->WIDTH_PHOTO_4) {
                        $thumbnail = new imagen($the_pholder_original.'/'.$fname);
                        $thumbnail->resizeImage($K->WIDTH_PHOTO_4, $K->WIDTH_PHOTO_4, 'landscape');
                        $thumbnail->saveImage($the_pholder_thumb4.'/'.$fname);
                    } else {
                        copy($the_pholder_original.'/'.$fname, $the_pholder_thumb4.'/'.$fname);
                    }

                    $code_media = codeUniqueInTable(11, 1, 'medias', 'code');
                    $page->db2->query("INSERT INTO medias SET code='".$code_media."', idwriter=".$user->info->iduser.", type_writer=0, posted_in=2, codecontainer='".$code_album."', namefile='".$fname."', folder='".$user->info->code."', typemedia=0, width=".$the_width.", height=".$the_height, FALSE);
                    $idmedia = $page->db2->insert_id();
                    
                    $code_item_album = codeUniqueInTable(11, 1, 'albums_items', 'code');
                    $page->db2->query("INSERT INTO albums_items SET code='".$code_item_album."', idalbum=".$idalbum.", iduser=".$user->info->iduser.", idmedia=".$idmedia.", description='', whendate='".time()."'", FALSE);

                }
                
                $page->db2->query("UPDATE users SET num_albums=num_albums+1 WHERE iduser=".$user->info->iduser." LIMIT 1");
                
                /******************/

                $np = new newpost();				
                $np->moreInfo($user->info->code, 0, 0, $user->info->code, $privacyalbum, '', '', '');
                $np->setMessage($descriptionalbum);
                $np->setTypePost(4);
                $idpost = $np->save();
                
                $page->db2->query("UPDATE albums SET idpost=".$idpost." WHERE idalbum=".$idalbum." LIMIT 1");
                $page->db2->query("UPDATE medias SET idcontainer=".$idpost." WHERE codecontainer='".$code_album."'");
                    
                /****************/
                
                
                $json_result = array('codealbum'=>$code_album);
                echo(json_encode($json_result));
                
            } else echo('ERROR: Error.');

            return;  
            
        }


        if ($ajax_action == 'update') {

            $album = $page->db2->fetch("SELECT * FROM albums WHERE code='".$codealbum."' AND idcreator=".$user->info->iduser." LIMIT 1");
            if (!$album) {
                echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
                return;
            }
            
            $page->db2->query("UPDATE albums SET title='".$titlealbum."', privacy=".$privacyalbum.", description='".$descriptionalbum."', modified='".time()."' WHERE code='".$codealbum."' AND idcreator=".$user->info->iduser." LIMIT 1");
            
            $idpost = $album->idpost;
            $idactivity = $page->db2->fetch_field("SELECT idactivity FROM posts WHERE idpost=".$idpost." LIMIT 1");
            
            $page->db2->query("UPDATE posts SET message='".$descriptionalbum."', for_who=".$privacyalbum." WHERE idpost=".$idpost." LIMIT 1");
            
            if ($idactivity) $page->db2->query("UPDATE activities SET who_view=".$privacyalbum." WHERE id=".$idactivity." LIMIT 1");
            
            $json_result = array('codealbum'=>$codealbum);
            echo(json_encode($json_result));
            return;
            
        }
        
        if ($ajax_action == 'delete') {

            $thealbum = $page->db2->fetch("SELECT * FROM albums WHERE code='".$codealbum."' AND idcreator=".$user->info->iduser." LIMIT 1");
            if ($thealbum) {

                $network->deleteAlbum($thealbum->idalbum);

                $json_result = array('codealbum'=>$codealbum);
                echo(json_encode($json_result));
                
            } else echo('ERROR: Error');
            return;
            
        }
        
        
        if ($ajax_action == 'addphotos') {
            
            $code_album = $codealbum;
            $thealbum = $page->db2->fetch("SELECT * FROM albums WHERE code='".$code_album."' AND idcreator=".$user->info->iduser." LIMIT 1");

            if ($thealbum) {
                
                $numphotos = 0;
                
                if ($filesphotos['name'][0]) {
                    
                    $numphotos = count($filesphotos['name']);
                    
                    $photos = array();
                    $tmp_photos = array();
                    
                    $numstart = $thealbum->numphotos;
                    
                    for ($i = 0; $i < $numphotos; $i++) {
    
                        if ($filesphotos['size'][$i] > $K->FILE_SIZE_PHOTO || $filesphotos['size'][$i]==0){
                            $error = TRUE;
                            $res = $page->lang('dashboard_albums_create_error_filebig');
                            break;
                        }
    
                        $file_type = $filesphotos['type'][$i];
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
                            $error = TRUE;
                            $res = $page->lang('dashboard_albums_create_error_formatimage');
                            break;
                        }
                        
                        $tmp_photos[] = $filesphotos['tmp_name'][$i];
                        $photos[] = $code_album.'-'.($i+$numstart).$file_extension;
    
                    }
                    
                } else $res = $page->lang('dashboard_albums_create_error_photo');
                
                if ($error) {
                    echo('ERROR:'.$res);
                    return;
                }
                
                
                if (!$error) {
                        
                    $the_pholder_original = $K->STORAGE_DIR_ALBUMS_USERS.'original/'.$user->info->code;
                    if (!file_exists($the_pholder_original)) {
                        mkdir($the_pholder_original, 0777, true);
                        $findex = fopen($the_pholder_original.'/index.html', "a");
                    }
    
                    $the_pholder_thumb1 = $K->STORAGE_DIR_ALBUMS_USERS.'thumb1/'.$user->info->code;
                    if (!file_exists($the_pholder_thumb1)) {
                        mkdir($the_pholder_thumb1, 0777, true);
                        $findex = fopen($the_pholder_thumb1.'/index.html', "a");
                    }
    
                    $the_pholder_thumb2 = $K->STORAGE_DIR_ALBUMS_USERS.'thumb2/'.$user->info->code;
                    if (!file_exists($the_pholder_thumb2)) {
                        mkdir($the_pholder_thumb2, 0777, true);
                        $findex = fopen($the_pholder_thumb2.'/index.html', "a");
                    }
    
                    $the_pholder_thumb3 = $K->STORAGE_DIR_ALBUMS_USERS.'thumb3/'.$user->info->code;
                    if (!file_exists($the_pholder_thumb3)) {
                        mkdir($the_pholder_thumb3, 0777, true);
                        $findex = fopen($the_pholder_thumb3.'/index.html', "a");
                    }
    
                    $the_pholder_thumb4 = $K->STORAGE_DIR_ALBUMS_USERS.'thumb4/'.$user->info->code;
                    if (!file_exists($the_pholder_thumb4)) {
                        mkdir($the_pholder_thumb4, 0777, true);
                        $findex = fopen($the_pholder_thumb4.'/index.html', "a");
                    }
                    
                    foreach($photos as $key => $fname) {
                        
                        move_uploaded_file($tmp_photos[$key], $the_pholder_original.'/'.$fname);
    
                        $thumbnail = new imagen($the_pholder_original.'/'.$fname);
    
                        $the_width = $thumbnail->getWidth();
                        $the_height = $thumbnail->getHeight();
    
                        if ($the_width > $K->WIDTH_PHOTO_1 || $the_height > $K->WIDTH_PHOTO_1) {
                            $thumbnail->resizeImage($K->WIDTH_PHOTO_1, $K->WIDTH_PHOTO_1, 'landscape');
                            $thumbnail->saveImage($the_pholder_thumb1.'/'.$fname);
                        } else {
                            copy($the_pholder_original.'/'.$fname, $the_pholder_thumb1.'/'.$fname);
                        }
    
                        if ($the_width > $K->WIDTH_PHOTO_2 || $the_height > $K->WIDTH_PHOTO_2) {
                            $thumbnail = new imagen($the_pholder_original.'/'.$fname);
                            $thumbnail->resizeImage($K->WIDTH_PHOTO_2, $K->WIDTH_PHOTO_2, 'landscape');
                            $thumbnail->saveImage($the_pholder_thumb2.'/'.$fname);
                        } else {
                            copy($the_pholder_original.'/'.$fname, $the_pholder_thumb2.'/'.$fname);
                        }
    
                        if ($the_width > $K->WIDTH_PHOTO_3 || $the_height > $K->WIDTH_PHOTO_3) {
                            $thumbnail = new imagen($the_pholder_original.'/'.$fname);
                            $thumbnail->resizeImage($K->WIDTH_PHOTO_3, $K->WIDTH_PHOTO_3, 'landscape');
                            $thumbnail->saveImage($the_pholder_thumb3.'/'.$fname);
                        } else {
                            copy($the_pholder_original.'/'.$fname, $the_pholder_thumb3.'/'.$fname);
                        }
    
                        if ($the_width > $K->WIDTH_PHOTO_4 || $the_height > $K->WIDTH_PHOTO_4) {
                            $thumbnail = new imagen($the_pholder_original.'/'.$fname);
                            $thumbnail->resizeImage($K->WIDTH_PHOTO_4, $K->WIDTH_PHOTO_4, 'landscape');
                            $thumbnail->saveImage($the_pholder_thumb4.'/'.$fname);
                        } else {
                            copy($the_pholder_original.'/'.$fname, $the_pholder_thumb4.'/'.$fname);
                        }
    
                        $code_media = codeUniqueInTable(11, 1, 'medias', 'code');
                        $page->db2->query("INSERT INTO medias SET code='".$code_media."', idwriter=".$user->info->iduser.", type_writer=0, posted_in=2, codecontainer='".$code_album."', idcontainer=".$thealbum->idpost.", namefile='".$fname."', folder='".$user->info->code."', typemedia=0, width=".$the_width.", height=".$the_height, FALSE);
                        $idmedia = $page->db2->insert_id();
                        
                        $code_item_album = codeUniqueInTable(11, 1, 'albums_items', 'code');
                        $page->db2->query("INSERT INTO albums_items SET code='".$code_item_album."', idalbum=".$thealbum->idalbum.", iduser=".$user->info->iduser.", idmedia=".$idmedia.", description='', whendate='".time()."'", FALSE);
    
                    }
                    

                    $page->db2->query("UPDATE albums SET numphotos=numphotos+".$numphotos.", modified='".time()."' WHERE code='".$code_album."' AND idcreator=".$user->info->iduser." LIMIT 1");
                    
                    $idactivity = $page->db2->fetch_field("SELECT idactivity FROM posts WHERE idpost=".$thealbum->idpost." LIMIT 1");
                    
                    $page->db2->query("UPDATE activities SET whendate='".time()."' WHERE id=".$idactivity." LIMIT 1");

                    $page->db2->query("UPDATE posts SET post_date='".time()."' WHERE idpost=".$thealbum->idpost." LIMIT 1");
                    
                    $json_result = array('codealbum'=>$code_album);
                    echo(json_encode($json_result));
                    
                } else echo('ERROR: Error.');
                
            } else echo('ERROR: Error.');

            return;  
            
        }
        
        
        if ($ajax_action == 'deletephoto') {

            $thealbum = $page->db2->fetch("SELECT * FROM albums WHERE code='".$codealbum."' AND idcreator=".$user->info->iduser." LIMIT 1");
            if ($thealbum) {
                $numphotos_album = $thealbum->numphotos;
                $themedia = $page->db2->fetch("SELECT * FROM medias WHERE code='".$codephoto."' AND codecontainer='".$codealbum."' LIMIT 1");
                if ($themedia) {
                    
                    if ($numphotos_album > 1) {

                        $network->deletePhotoAlbum($themedia->idmedia, $thealbum->idalbum);

                        $json_result = array('codealbum'=>$codealbum, 'codephoto'=>$codephoto, 'total'=>0);
                        echo(json_encode($json_result));
                    
                    } else {
                        
                        $network->deleteAlbum($thealbum->idalbum);
                        
                        $json_result = array('codealbum'=>$codealbum, 'codephoto'=>$codephoto, 'total'=>1);
                        echo(json_encode($json_result));
                        
                    }

                } else echo('ERROR: Error.');

            } else echo('ERROR: Error.');

            return;
            
        }

        
    }
?>