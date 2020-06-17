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
        
        $nameproduct = isset($_POST['namp']) ? (trim($_POST['namp'])) : '';
        $nameproduct = $the_sanitaze->str_nohtml($nameproduct);

        $descriptionproduct = isset($_POST['desp']) ? (trim($_POST['desp'])) : '';
        $descriptionproduct = $the_sanitaze->str_nohtml($descriptionproduct);
        
        $idcategory = isset($_POST['idcp']) ? (trim($_POST['idcp'])) : '';
        $idcategory = $the_sanitaze->int($idcategory);

        $idsubcategory = isset($_POST['idsp']) ? (trim($_POST['idsp'])) : '';
        $idsubcategory = $the_sanitaze->int($idsubcategory);

        $typeproduct = isset($_POST['typp']) ? (trim($_POST['typp'])) : '';
        $typeproduct = $the_sanitaze->int($typeproduct);

        $currencyproduct = isset($_POST['curp']) ? (trim($_POST['curp'])) : '';
        $currencyproduct = $the_sanitaze->int($currencyproduct);

        $priceproduct = isset($_POST['prip']) ? (trim($_POST['prip'])) : '';
        $priceproduct = $the_sanitaze->float($priceproduct);
    
        $locationproduct = isset($_POST['locp']) ? (trim($_POST['locp'])) : '';
        $locationproduct = $the_sanitaze->str_nohtml($locationproduct);
        
        $the_photo = $_FILES['imagenfile'];
    
    	if (!$error && empty($nameproduct)) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($descriptionproduct)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $idcategory < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $idsubcategory < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $typeproduct < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $currencyproduct < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $priceproduct < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($locationproduct)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($the_photo)) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'update') {
        
        $codeproduct = isset($_POST['codep']) ? (trim($_POST['codep'])) : '';
        $codeproduct = $the_sanitaze->str_nohtml($codeproduct, 11);        
        
        $nameproduct = isset($_POST['namp']) ? (trim($_POST['namp'])) : '';
        $nameproduct = $the_sanitaze->str_nohtml($nameproduct);

        $descriptionproduct = isset($_POST['desp']) ? (trim($_POST['desp'])) : '';
        $descriptionproduct = $the_sanitaze->str_nohtml($descriptionproduct);
        
        $idcategory = isset($_POST['idcp']) ? (trim($_POST['idcp'])) : '';
        $idcategory = $the_sanitaze->int($idcategory);

        $idsubcategory = isset($_POST['idsp']) ? (trim($_POST['idsp'])) : '';
        $idsubcategory = $the_sanitaze->int($idsubcategory);

        $typeproduct = isset($_POST['typp']) ? (trim($_POST['typp'])) : '';
        $typeproduct = $the_sanitaze->int($typeproduct);

        $currencyproduct = isset($_POST['curp']) ? (trim($_POST['curp'])) : '';
        $currencyproduct = $the_sanitaze->int($currencyproduct);

        $priceproduct = isset($_POST['prip']) ? (trim($_POST['prip'])) : '';
        $priceproduct = $the_sanitaze->float($priceproduct);
    
        $locationproduct = isset($_POST['locp']) ? (trim($_POST['locp'])) : '';
        $locationproduct = $the_sanitaze->str_nohtml($locationproduct);
        
        $dochange = isset($_POST['chgi']) ? (trim($_POST['chgi'])) : '';
        $dochange = $the_sanitaze->str_nohtml($dochange);
        
        if ($dochange == '1') {
            $the_photo = $_FILES['imagenfile'];
        }

    	if (!$error && empty($codeproduct)) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($nameproduct)) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($descriptionproduct)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $idcategory < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $idsubcategory < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $typeproduct < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $currencyproduct < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $priceproduct < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($locationproduct)) { $error = TRUE; $txterror .= 'Error. '; }
        if ($dochange == '1') {
		    if (!$error && empty($the_photo)) { $error = TRUE; $txterror .= 'Error. '; }
        }

    }
    
    if ($ajax_action == 'delete') {
        $codeproduct = isset($_POST['code']) ? (trim($_POST['code'])) : '';
        $codeproduct = $the_sanitaze->str_nohtml($codeproduct, 11);
    
    	if (!$error && empty($codeproduct)) { $error = TRUE; $txterror .= 'Error. '; }
    }

    
    if ($error) {
        echo('ERROR:'.$txterror);
		return;
    } else {
        
        if ($ajax_action == 'create') {

            $code_product = codeUniqueInTable(11, 1, 'products', 'code');
            
            $fname = '';
            if ($the_photo['name']) { 
                if ($the_photo['size'] > $K->FILE_SIZE_PHOTO_PRODUCTS || $the_photo['size'] == 0) {
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

                $fname = $code_product.$file_extension;
                move_uploaded_file($the_photo['tmp_name'], $K->STORAGE_DIR_PRODUCTS.$fname);
                
                $the_pholder_1 = $K->STORAGE_DIR_PRODUCTS.'min1/';
                $the_pholder_2 = $K->STORAGE_DIR_PRODUCTS.'min2/';
                
                $thumbnail = new imagen($K->STORAGE_DIR_PRODUCTS.$fname);
                $thumbnail->resizeImage($K->WIDTH_PHOTO_PRODUCT_1, $K->WIDTH_PHOTO_PRODUCT_1, 'crop');
                $thumbnail->saveImage($the_pholder_1.'/'.$fname);

                $thumbnail = new imagen($K->STORAGE_DIR_PRODUCTS.$fname);
                $thumbnail->resizeImage($K->WIDTH_PHOTO_PRODUCT_2, $K->WIDTH_PHOTO_PRODUCT_2, 'crop');
                $thumbnail->saveImage($the_pholder_2.'/'.$fname);
                
            }
            

		    if (!$error && empty($the_photo)) { $error = TRUE; $txterror .= 'Error. '; }

            
            $page->db2->query("INSERT INTO products SET code='".$code_product."', idsell=".$user->info->iduser.", name='".$nameproduct."', idcategory=".$idcategory.", idsubcategory=".$idsubcategory.", description='".$descriptionproduct."', location='".$locationproduct."', currency=".$currencyproduct.", price=".$priceproduct.", type_product=".$typeproduct.", whendate='".time()."'");
			
			$idproduct = $page->db2->insert_id();
			
			$page->db2->query("UPDATE users SET num_products=num_products+1 WHERE iduser=".$user->info->iduser." LIMIT 1");
            
            $page->db2->query("INSERT INTO products_images SET idproduct=".$idproduct.", photo='".$fname."'", FALSE);
            
            /******************/
            
            $np = new newpost();				
            $np->moreInfo($user->info->code, 0, 0, $user->info->code, 0, '', '', '');
            $np->setMessage('');
            $np->setTypePost(12);
            $idpost = $np->save();
            
            $page->db2->query("UPDATE products SET idpost=".$idpost." WHERE idproduct=".$idproduct." LIMIT 1");
                
            /****************/
            
            
            $json_result = array('codeproduct'=>$code_product);
            echo(json_encode($json_result));
            return;  
            
        }


        if ($ajax_action == 'update') {

            $product = $page->db2->fetch("SELECT * FROM products WHERE code='".$codeproduct."' AND idsell=".$user->info->iduser);
            if (!$product) {
                echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
                return;
            }
            
            if ($dochange == '1') {
                
                $fname = '';
                if ($the_photo['name']) { 
                    if ($the_photo['size'] > $K->FILE_SIZE_PHOTO_PRODUCTS || $the_photo['size'] == 0) {
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
                    
                    $the_pholder_1 = $K->STORAGE_DIR_PRODUCTS.'min1/';
                    $the_pholder_2 = $K->STORAGE_DIR_PRODUCTS.'min2/';

                    $photos_prod = $page->db2->fetch_all("SELECT * FROM products_images WHERE idproduct=".$product->idproduct);
                    if ($photos_prod) {
                        foreach ($photos_prod as $onephoto) {
                            
                            if (!empty($onephoto->photo)) {
                                $the_file = $K->STORAGE_DIR_PRODUCTS.$onephoto->photo;
                                if (file_exists($the_file)) @unlink($the_file);
                                
                                $the_file = $the_pholder_1.$onephoto->photo;
                                if (file_exists($the_file)) @unlink($the_file);
                                
                                $the_file = $the_pholder_2.$onephoto->photo;
                                if (file_exists($the_file)) @unlink($the_file);
                                
                            }
                            
                        }
                    }
                    
                    $fname = $codeproduct.$file_extension;
                    
                    $page->db2->query("UPDATE products_images SET photo='".$fname."' WHERE idproduct=".$product->idproduct, FALSE);

                    move_uploaded_file($the_photo['tmp_name'], $K->STORAGE_DIR_PRODUCTS.$fname);
                    
                    $thumbnail = new imagen($K->STORAGE_DIR_PRODUCTS.$fname);
                    $thumbnail->resizeImage($K->WIDTH_PHOTO_PRODUCT_1, $K->WIDTH_PHOTO_PRODUCT_1, 'crop');
                    $thumbnail->saveImage($the_pholder_1.'/'.$fname);
    
                    $thumbnail = new imagen($K->STORAGE_DIR_PRODUCTS.$fname);
                    $thumbnail->resizeImage($K->WIDTH_PHOTO_PRODUCT_2, $K->WIDTH_PHOTO_PRODUCT_2, 'crop');
                    $thumbnail->saveImage($the_pholder_2.'/'.$fname);
                    
                }
                
            }
            
            $page->db2->query("UPDATE products SET name='".$nameproduct."', idcategory=".$idcategory.", idsubcategory=".$idsubcategory.", description='".$descriptionproduct."', location='".$locationproduct."', currency=".$currencyproduct.", price=".$priceproduct.", type_product=".$typeproduct." WHERE code='".$codeproduct."' AND idsell=".$user->info->iduser." LIMIT 1");
            
            $json_result = array('codeproduct'=>$codeproduct);
            echo(json_encode($json_result));
            return;
            
        }
        
        if ($ajax_action == 'delete') {
            

            $idproduct = $page->db2->fetch_field("SELECT idproduct FROM products WHERE code='".$codeproduct."' AND idsell=".$user->info->iduser." LIMIT 1");
            if (!$idproduct) echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
         
            if (!$network->deleteProduct($idproduct)) echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
            else {
                $json_result = array('codeproduct'=>$codeproduct);
                echo(json_encode($json_result));
            }
            
            return;
            
        }

        
    }
?>