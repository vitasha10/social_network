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
	$D->idpage = '';
	if ($this->param('p')) $D->idpage = $this->param('p');
    $D->idpage = $the_sanitaze->int($D->idpage);
    if ($D->idpage <= 0) $this->globalRedirect($K->SITE_URL.'admin/pages');

    $info_page = $this->db2->fetch("SELECT idpage FROM pages WHERE idpage=".$D->idpage." LIMIT 1");

    if (!$info_page) $this->globalRedirect($K->SITE_URL.'admin/pages');

    $D->me = $this->user->info;

    $D->the_page = $this->db2->fetch("SELECT * FROM pages WHERE idpage=".$D->idpage." LIMIT 1");

    $D->idcat = $D->the_page->idcat;
    $D->idsubcat = $D->the_page->idsubcat;
    $D->verified = $D->the_page->verified;
    $D->username = stripslashes($D->the_page->puname);
    $D->title = stripslashes($D->the_page->title);
    $D->description = stripslashes($D->the_page->description);

    /****************************************************************/    
    /****************************************************************/

    $D->js_script_min = $this->designer->getStringJS('admin');

    $D->id_menu = 'opt_adm_pages';

	if ($D->isPhantom) {

        $html = '';

        $this->load_extract_controller('_admin-menu-left');

		if ($D->layout_size == 'min') {

            $for_load = 'min/admin-pages-edit.php';

		} else {

            $for_load = 'max/admin-pages-edit.php';

		}

        $D->titlePhantom = $this->lang('admin_pages_title_page').' | '.$D->title;

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_admin-menu-left');

		$D->page_title = $this->lang('admin_pages_title_page').' | '.$D->title;    	

        $D->file_in_template = 'max/admin-pages-edit.php';
        $this->load_template('dashboard-template.php');

	}

?>