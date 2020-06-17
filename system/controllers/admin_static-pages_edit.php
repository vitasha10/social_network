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

    /************************************************/

    $the_sanitaze = new sanitize(); // init sanitaze
	$D->idstatic = '';
	if ($this->param('s')) $D->idstatic = $this->param('s');
    $D->idstatic = $the_sanitaze->int($D->idstatic);
    if ($D->idstatic <= 0) $this->globalRedirect($K->SITE_URL.'admin/static-pages');

    $info_static = $this->db2->fetch("SELECT * FROM statics WHERE idstatic=".$D->idstatic." LIMIT 1");

    if (!$info_static) $this->globalRedirect($K->SITE_URL.'admin/static-pages');

    $D->title = stripslashes($info_static->title);
    $D->html = stripslashes($info_static->texthtml);
    $D->url = stripslashes($info_static->url);
    $D->infoot = $info_static->show_in_foot;

    /************************************************/

    $D->js_script_min = $this->designer->getStringJS('admin');

    $D->id_menu = 'opt_adm_staticpages';

	if ($D->isPhantom) {

        $html = '';

        $this->load_extract_controller('_admin-menu-left');

		if ($D->layout_size == 'min') {

            $for_load = 'min/admin-static-pages-edit.php';

		} else {

            $for_load = 'max/admin-static-pages-edit.php';

		}

        $D->titlePhantom = $this->lang('admin_static_pages_edit_title_page');

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_admin-menu-left');

		$D->page_title = $this->lang('admin_static_pages_edit_title_page');    	

        $D->file_in_template = 'max/admin-static-pages-edit.php';
        $this->load_template('dashboard-template.php');

	}

?>