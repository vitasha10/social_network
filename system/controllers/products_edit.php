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
	if (!$D->_IS_LOGGED) $this->globalRedirect('login');

	$this->loadLanguage('global.php');
	$this->loadLanguage('dashboard.php');


    $D->_IN_DASHBOARD = TRUE;
    $D->_WITH_NOTIFIER = TRUE;

	$D->isPhantom = FALSE;
	if ($this->param('phantom') && $this->param('phantom')=='yes') $D->isPhantom = TRUE;

	$D->layout_size = 'min';
	if ($this->param('lysize')) $D->layout_size = $this->param('lysize');


    $the_sanitaze = new sanitize(); // init sanitaze
	$D->codeproduct = '';
	if ($this->param('p')) $D->codeproduct = $this->param('p');
    $D->codeproduct = $the_sanitaze->str_nohtml($D->codeproduct);
    if (empty($D->codeproduct)) $this->globalRedirect($K->SITE_URL.'products');

    $info_product = $this->db2->fetch("SELECT * FROM products WHERE code='".$D->codeproduct."' LIMIT 1");

    if (!$info_product) $this->globalRedirect($K->SITE_URL.'products');

    $D->idproduct = $info_product->idproduct;
    $D->name = stripslashes($info_product->name);
    $D->description = stripslashes($info_product->description);
    $D->idcategory = $info_product->idcategory;
    $D->idsubcategory = $info_product->idsubcategory;
    $D->location = stripslashes($info_product->location);
    $D->currency = $info_product->currency;
    $D->price = $info_product->price;
    $D->type_product = $info_product->type_product;
    
    $D->photo = array();
    $photos_prod = $this->db2->fetch_all("SELECT * FROM products_images WHERE idproduct=".$D->idproduct);
    if ($photos_prod) {
        foreach ($photos_prod as $onephoto) {
            $D->photo[] = $onephoto->photo;
        }
    }
    
    
    $D->currencies = '';
    $currencies = $this->db2->fetch_all("SELECT * FROM currencies ORDER BY code_iso ASC");
    if ($currencies) {
        foreach ($currencies as $onecurrency) {
            $D->currencies .= '<option value="'.$onecurrency->idcurrency.'"'.($D->currency == $onecurrency->idcurrency ? 'selected' : '').'>'.$onecurrency->code_iso.' ('.$onecurrency->symbol.')</option>';
        }
    }

    $D->id_menu = 'opt_ml_products';
    
    /****************************************************************************/
    
    $this->load_extract_controller('_pre-dashboard');

    /****************************************************************************/

	if ($D->isPhantom) {

        $html = '';
        $this->load_extract_controller('_dashboard-menu-left');
		
        if ($D->layout_size == 'min') {
            $for_load = 'min/products-edit.php';
		} else {
            $for_load = 'max/products-edit.php';
		}

        $D->titlePhantom = $this->lang('dashboard_products_edit_title_page');

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_dashboard-menu-left');

        $D->page_title = $this->lang('dashboard_products_edit_title_page');

        $D->file_in_template = 'max/products-edit.php';
        $this->load_template('dashboard-template.php');

    }

?>