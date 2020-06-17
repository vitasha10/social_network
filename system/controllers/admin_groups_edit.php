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
	$D->idgroup = '';
	if ($this->param('g')) $D->idgroup = $this->param('g');
    $D->idgroup = $the_sanitaze->int($D->idgroup);
    if ($D->idgroup <= 0) $this->globalRedirect($K->SITE_URL.'admin/groups');

    $info_group = $this->db2->fetch("SELECT idgroup FROM groups WHERE idgroup=".$D->idgroup." LIMIT 1");

    if (!$info_group) $this->globalRedirect($K->SITE_URL.'admin/groups');

    $D->me = $this->user->info;

    $D->the_group = $this->db2->fetch("SELECT * FROM groups WHERE idgroup=".$D->idgroup." LIMIT 1");

    $D->idgroup = $D->the_group->idgroup;
    $D->privacy = $D->the_group->privacy;
    $D->username = stripslashes($D->the_group->guname);
    $D->title = stripslashes($D->the_group->title);
    $D->about = stripslashes($D->the_group->about);

    /****************************************************************/    
    /****************************************************************/

    $D->js_script_min = $this->designer->getStringJS('admin');

    $D->id_menu = 'opt_adm_groups';

	if ($D->isPhantom) {

        $html = '';

        $this->load_extract_controller('_admin-menu-left');

		if ($D->layout_size == 'min') {

            $for_load = 'min/admin-groups-edit.php';

		} else {

            $for_load = 'max/admin-groups-edit.php';

		}

        $D->titlePhantom = $this->lang('admin_groups_title_page').' | '.$D->title;

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_admin-menu-left');

		$D->page_title = $this->lang('admin_groups_title_page').' | '.$D->title;    	

        $D->file_in_template = 'max/admin-groups-edit.php';
        $this->load_template('dashboard-template.php');

	}

?>