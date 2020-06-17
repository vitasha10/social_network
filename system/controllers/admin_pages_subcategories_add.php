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

    $the_sanitaze = new sanitize(); // init sanitaze
	$D->idcat = '';
	if ($this->param('c')) $D->idcat = $this->param('c');
    $D->idcat = $the_sanitaze->int($D->idcat);
    if ($D->idcat <= 0) $this->globalRedirect($K->SITE_URL.'admin/pages/categories');

	$this->loadLanguage('global.php');
	$this->loadLanguage('dashboard.php');
	$this->loadLanguage('admin.php');

    $D->name_category = $this->db2->fetch_field("SELECT name FROM pages_cat WHERE idcategory=".$D->idcat." LIMIT 1");

    if (!$D->name_category) $this->globalRedirect($K->SITE_URL.'admin/pages/categories');

    $D->js_script_min = $this->designer->getStringJS('admin');

    $D->id_menu = 'opt_adm_pages_categories';

	if ($D->isPhantom) {

        $html = '';

        $this->load_extract_controller('_admin-menu-left');

		if ($D->layout_size == 'min') {

            $for_load = 'min/admin-pages-subcategories-add.php';

		} else {

            $for_load = 'max/admin-pages-subcategories-add.php';

		}

        $D->titlePhantom = $this->lang('admin_pages_subcategories_add_title_page');

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_admin-menu-left');

		$D->page_title = $this->lang('admin_pages_subcategories_add_title_page');    	

        $D->file_in_template = 'max/admin-pages-subcategories-add.php';
        $this->load_template('dashboard-template.php');

	}

?>