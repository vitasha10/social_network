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
    if ($D->_IS_LOGGED) {
        $D->_WITH_NOTIFIER = TRUE;
    }

	$D->isPhantom = FALSE;
	if ($this->param('phantom') && $this->param('phantom')=='yes') $D->isPhantom = TRUE;

	$D->layout_size = 'min';
	if ($this->param('lysize')) $D->layout_size = $this->param('lysize');

	$this->loadLanguage('global.php');

    if ($D->_IS_LOGGED) {
        $this->loadLanguage('dashboard.php');
    	$D->me = $this->user->info;
    }

    $D->id_container = 'site';

    $D->msg01 = $this->lang('global_txt_404_sorry');
    $D->msg02 = $this->lang('global_txt_404_broken');

	if ($D->isPhantom) {

        $html = '';

        if ($D->_IS_LOGGED) {

            $D->id_container = 'dashboard';
            $this->load_extract_controller('_dashboard-menu-left');

        }

        if ($D->layout_size == 'min') {
            $for_load = 'min/error404.php';
        } else {
            $for_load = 'max/error404.php';
        }

        $D->titlePhantom = $this->lang('global_txt_404_title_page').' | '.$K->SITE_TITLE;

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $D->page_title = $this->lang('global_txt_404_title_page').' | '.$K->SITE_TITLE;

        if ($D->_IS_LOGGED) {

            $this->load_extract_controller('_required-dashboard');
            $this->load_extract_controller('_dashboard-bar-top');

            $D->id_container = 'dashboard';
            $this->load_extract_controller('_dashboard-menu-left');
            $D->file_in_template = 'max/error404.php';
            $this->load_template('dashboard-template.php');

        } else {

            if (!isset($D->string_js) || !is_array($D->string_js)) $D->string_js = array();
            array_push($D->string_js, 'moment.locale("'.$K->LANGUAGE.'");');

            $this->load_extract_controller('_bar-top');
            $this->load_extract_controller('_required-out');

            $D->file_in_template = 'max/error404.php';
            $this->load_template('site-template.php');

        }

    }

?>