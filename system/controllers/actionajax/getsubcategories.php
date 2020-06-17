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

    if (!$user->is_logged) { echo('ERROR:'.$page->lang('global_txt_no_session')); return; }

    $the_sanitaze = new sanitize(); // init sanitaze

    $error = FALSE;

    $idcategory = isset($_POST['idc']) ? (trim($_POST['idc'])) : 0;
    $idcategory = $the_sanitaze->int($idcategory);

    $idsubcategory = isset($_POST['idsc']) ? (trim($_POST['idsc'])) : 0;
    $idsubcategory = $the_sanitaze->int($idsubcategory);

    if ($error) {
        die();
    } else {
        
        if ($ajax_action == 'getsubcatpages') {

            $r = $page->db2->query("SELECT idcategory, name FROM pages_cat WHERE idfather=".$idcategory." ORDER BY name ASC");
            $txtsubcategories = '<option value="-1" select>'.$page->lang('dashboard_pages_create_txt_choosesubcategory').'</option>';
            while ($row = $page->db2->fetch_object($r)) {
                if ($row->idcategory == $idsubcategory) $txtsubcategories .= '<option value="'.$row->idcategory.'" selected="selected">'.stripslashes($row->name).'</option>';
                else $txtsubcategories.='<option value="'.$row->idcategory.'">'.stripslashes($row->name).'</option>';
            }
    
            $json_result = array('subcategories'=>$txtsubcategories);
            echo(json_encode($json_result));
            return;
            
        }

        if ($ajax_action == 'getsubcatarticles') {

            $r = $page->db2->query("SELECT idcategory, name FROM articles_cat WHERE idfather=".$idcategory." ORDER BY name ASC");
            $txtsubcategories = '<option value="-1" select>'.$page->lang('dashboard_articles_publish_txt_choosesubcategory').'</option>';
            while ($row = $page->db2->fetch_object($r)) {
                if ($row->idcategory == $idsubcategory) $txtsubcategories .= '<option value="'.$row->idcategory.'" selected="selected">'.stripslashes($row->name).'</option>';
                else $txtsubcategories.='<option value="'.$row->idcategory.'">'.stripslashes($row->name).'</option>';
            }
    
            $json_result = array('subcategories'=>$txtsubcategories);
            echo(json_encode($json_result));
            return;
            
        }
        
        if ($ajax_action == 'getsubcatproducts') {

            $r = $page->db2->query("SELECT idcategory, name FROM products_cat WHERE idfather=".$idcategory." ORDER BY name ASC");
            $txtsubcategories = '<option value="-1" select>'.$page->lang('dashboard_products_create_txt_choosesubcategory').'</option>';
            while ($row = $page->db2->fetch_object($r)) {
                if ($row->idcategory == $idsubcategory) $txtsubcategories .= '<option value="'.$row->idcategory.'" selected="selected">'.stripslashes($row->name).'</option>';
                else $txtsubcategories.='<option value="'.$row->idcategory.'">'.stripslashes($row->name).'</option>';
            }
    
            $json_result = array('subcategories'=>$txtsubcategories);
            echo(json_encode($json_result));
            return;
            
        }
        
    /**************************************/
    /* START version 1.0.1 */
        
        if ($ajax_action == 'market') {

            $r = $page->db2->query("SELECT idcategory, name FROM products_cat WHERE idfather=".$idcategory." ORDER BY name ASC");
            $txtsubcategories = '<option value="-1" select>'.$page->lang('dashboard_marketplace_txt_all').'</option>';
            while ($row = $page->db2->fetch_object($r)) {
                if ($row->idcategory == $idsubcategory) $txtsubcategories .= '<option value="'.$row->idcategory.'" selected="selected">'.stripslashes($row->name).'</option>';
                else $txtsubcategories.='<option value="'.$row->idcategory.'">'.stripslashes($row->name).'</option>';
            }
    
            $json_result = array('subcategories'=>$txtsubcategories);
            echo(json_encode($json_result));
            return;
            
        }
        
        if ($ajax_action == 'library') {

            $r = $page->db2->query("SELECT idcategory, name FROM articles_cat WHERE idfather=".$idcategory." ORDER BY name ASC");
            $txtsubcategories = '<option value="-1" select>'.$page->lang('dashboard_library_txt_all').'</option>';
            while ($row = $page->db2->fetch_object($r)) {
                if ($row->idcategory == $idsubcategory) $txtsubcategories .= '<option value="'.$row->idcategory.'" selected="selected">'.stripslashes($row->name).'</option>';
                else $txtsubcategories.='<option value="'.$row->idcategory.'">'.stripslashes($row->name).'</option>';
            }
    
            $json_result = array('subcategories'=>$txtsubcategories);
            echo(json_encode($json_result));
            return;
            
        }
        
        
    /* END version 1.0.1 */
    /**************************************/


    }
?>