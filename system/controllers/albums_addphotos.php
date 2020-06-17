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
    
    /****************************************************************************/
    
    $the_sanitaze = new sanitize(); // init sanitaze
	$D->codealbum = '';
	if ($this->param('a')) $D->codealbum = $this->param('a');
    $D->codealbum = $the_sanitaze->str_nohtml($D->codealbum);
    if (empty($D->codealbum)) $this->globalRedirect($K->SITE_URL.'albums');

    $info_album = $this->db2->fetch("SELECT * FROM albums WHERE code='".$D->codealbum."' LIMIT 1");

    if (!$info_album) $this->globalRedirect($K->SITE_URL.'albums');

    $D->idalbum = $info_album->idalbum;
    $D->title = stripslashes($info_album->title);
    $D->description = stripslashes($info_album->description);
    $D->privacy = $info_album->privacy;
    
    /****************************************************************************/

    $D->id_menu = 'opt_ml_albums';

    /****************************************************************************/
    
    $this->load_extract_controller('_pre-dashboard');

    /****************************************************************************/

	if ($D->isPhantom) {

        $html = '';
        $this->load_extract_controller('_dashboard-menu-left');
		
        if ($D->layout_size == 'min') {
            $for_load = 'min/albums-addphotos.php';
		} else {
            $for_load = 'max/albums-addphotos.php';
		}

        $D->titlePhantom = $this->lang('dashboard_albums_addphotos_title_page');

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_dashboard-menu-left');

        $D->page_title = $this->lang('dashboard_albums_addphotos_title_page');

        $D->file_in_template = 'max/albums-addphotos.php';
        $this->load_template('dashboard-template.php');

    }

?>