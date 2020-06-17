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

    $D->items_statics = '';

    $statics = $this->db2->fetch_all('SELECT * FROM statics ORDER BY idstatic DESC');
    $D->numstatics = count($statics);
    foreach($statics as $onestatic) {
        $D->onestatic = $onestatic;
        $D->onestatic->title = stripslashes($onestatic->title);
        $D->items_statics .= $this->load_template('ones/one-static-page.php', FALSE);
    }

    /************************************************/

    $D->js_script_min = $this->designer->getStringJS('admin');

    $D->id_menu = 'opt_adm_staticpages';

	if ($D->isPhantom) {

        $html = '';

        $this->load_extract_controller('_admin-menu-left');

		if ($D->layout_size == 'min') {

            $for_load = 'min/admin-static-pages.php';

		} else {

            $for_load = 'max/admin-static-pages.php';

		}

        $D->titlePhantom = $this->lang('admin_static_pages_title_page');

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_admin-menu-left');

		$D->page_title = $this->lang('admin_static_pages_title_page');    	

        $D->file_in_template = 'max/admin-static-pages.php';
        $this->load_template('dashboard-template.php');

	}

?>