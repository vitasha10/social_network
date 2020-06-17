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
	$D->codeevent = '';
	if ($this->param('e')) $D->codeevent = $this->param('e');
    $D->codeevent = $the_sanitaze->str_nohtml($D->codeevent);
    if (empty($D->codeevent)) $this->globalRedirect($K->SITE_URL.'myevents');

    $info_event = $this->db2->fetch("SELECT * FROM events WHERE code='".$D->codeevent."' LIMIT 1");

    if (!$info_event) $this->globalRedirect($K->SITE_URL.'myevents');

    $D->idev = $info_event->idevent;
    $D->title = stripslashes($info_event->title);
    $D->address = stripslashes($info_event->address);
    $D->description = stripslashes($info_event->description);
    
    $theformat_new = setFormatTheDate($this->lang('dashboard_myevents_create_format_date'));
    $D->date_start = date($theformat_new, $info_event->start_unix);
    $D->time_start = date('g:ia', $info_event->start_unix);
    $D->date_end = date($theformat_new, $info_event->end_unix);
    $D->time_end = date('g:ia', $info_event->end_unix);

    $D->id_menu = 'opt_ml_myevents';
    
    /****************************************************************************/
    
    $this->load_extract_controller('_pre-dashboard');

    /****************************************************************************/

	if ($D->isPhantom) {

        $html = '';
        $this->load_extract_controller('_dashboard-menu-left');

		if ($D->layout_size == 'min') {
            $for_load = 'min/myevents-edit.php';
		} else {
            $for_load = 'max/myevents-edit.php';
		}

        $D->titlePhantom = $this->lang('dashboard_myevents_edit_title_page');

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_dashboard-menu-left');

        $D->page_title = $this->lang('dashboard_myevents_edit_title_page');

        $D->file_in_template = 'max/myevents-edit.php';
        $this->load_template('dashboard-template.php');

    }

?>