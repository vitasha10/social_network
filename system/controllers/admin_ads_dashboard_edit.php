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
	$D->codeads = '';
	if ($this->param('a')) $D->codeads = $this->param('a');
    $D->codeads = $the_sanitaze->str_nohtml($D->codeads);
    if (strlen($D->codeads) != 11) $this->globalRedirect($K->SITE_URL.'admin/ads/dashboard');

    $theads = $this->db2->fetch("SELECT * FROM advertising_basic WHERE idslot=1 AND code='".$D->codeads."' LIMIT 1");

    if (!$theads) $this->globalRedirect($K->SITE_URL.'admin/ads/dashboard');

    $D->idbasic = $theads->idbasic;
    $D->name = stripslashes($theads->name);
    $D->theurl = stripslashes($theads->theurl);
    $D->target = $theads->target;
    $D->thefile = $theads->thefile;
    $D->status = $theads->status;
    
    $D->type_ads = $theads->type_ads;
    $D->the_html  = stripslashes($theads->the_html);
    
    $D->text_type = $this->lang('admin_ads_dashboard_edit_type_ads_image');
    if ($D->type_ads == 2) $D->text_type = $this->lang('admin_ads_dashboard_edit_type_ads_html');
    

    /************************************************/


    $D->js_script_min = $this->designer->getStringJS('admin');

    $D->id_menu = 'opt_adm_adsdash';

	if ($D->isPhantom) {

        $html = '';

        $this->load_extract_controller('_admin-menu-left');

		if ($D->layout_size == 'min') {

            $for_load = 'min/admin-ads-dashboard-edit.php';

		} else {

            $for_load = 'max/admin-ads-dashboard-edit.php';

		}

        $D->titlePhantom = $this->lang('admin_ads_dashboard_edit_title_page');

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_admin-menu-left');

		$D->page_title = $this->lang('admin_ads_dashboard_edit_title_page');    	

        $D->file_in_template = 'max/admin-ads-dashboard-edit.php';
        $this->load_template('dashboard-template.php');

	}

?>