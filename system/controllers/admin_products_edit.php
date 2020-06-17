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
	if (!$D->_IS_ADMIN_USER) $this->globalRedirect('login');

    $D->_IN_ADMIN_PANEL = TRUE;
    $D->_WITH_NOTIFIER = TRUE;

	$D->isPhantom = FALSE;
	if ($this->param('phantom') && $this->param('phantom')=='yes') $D->isPhantom = TRUE;

	$D->layout_size = 'min';
	if ($this->param('lysize')) $D->layout_size = $this->param('lysize');

	$this->loadLanguage('global.php');
	$this->loadLanguage('dashboard.php');
	$this->loadLanguage('admin.php');

    /****************************************************************/    
    /****************************************************************/

    $the_sanitaze = new sanitize(); // init sanitaze
	$D->idproduct = '';
	if ($this->param('p')) $D->idproduct = $this->param('p');
    $D->idproduct = $the_sanitaze->int($D->idproduct);
    if ($D->idproduct <= 0) $this->globalRedirect($K->SITE_URL.'admin/products');

    $info_product = $this->db2->fetch("SELECT idproduct FROM products WHERE idproduct=".$D->idproduct." LIMIT 1");

    if (!$info_product) $this->globalRedirect($K->SITE_URL.'admin/products');

    $D->me = $this->user->info;

    $info_product = $this->db2->fetch("SELECT * FROM products WHERE idproduct=".$D->idproduct." LIMIT 1");
    
    $D->idproduct = $info_product->idproduct;
    $D->name = stripslashes($info_product->name);
    $D->description = stripslashes($info_product->description);
    $D->idcategory = $info_product->idcategory;
    $D->idsubcategory = $info_product->idsubcategory;
    $D->location = stripslashes($info_product->location);
    $D->currency = $info_product->currency;
    $D->price = $info_product->price;
    $D->type_product = $info_product->type_product;
    $D->status = $info_product->status;
    
    $D->currencies = '';
    $currencies = $this->db2->fetch_all("SELECT * FROM currencies ORDER BY code_iso ASC");
    if ($currencies) {
        foreach ($currencies as $onecurrency) {
            $D->currencies .= '<option value="'.$onecurrency->idcurrency.'"'.($D->currency == $onecurrency->idcurrency ? 'selected' : '').'>'.$onecurrency->code_iso.' ('.$onecurrency->symbol.')</option>';
        }
    }

    /****************************************************************/    
    /****************************************************************/

    $D->js_script_min = $this->designer->getStringJS('admin');

    $D->id_menu = 'opt_adm_products';

	if ($D->isPhantom) {

        $html = '';

        $this->load_extract_controller('_admin-menu-left');

		if ($D->layout_size == 'min') {

            $for_load = 'min/admin-products-edit.php';

		} else {

            $for_load = 'max/admin-products-edit.php';

		}

        $D->titlePhantom = $this->lang('admin_products_title_page').' | '.$D->title;

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_admin-menu-left');

		$D->page_title = $this->lang('admin_products_title_page').' | '.$D->title;    	

        $D->file_in_template = 'max/admin-products-edit.php';
        $this->load_template('dashboard-template.php');

	}

?>