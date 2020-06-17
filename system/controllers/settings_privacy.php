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

    $D->_IN_SETTING_PANEL = TRUE;
    $D->_WITH_NOTIFIER = TRUE;

	$D->isPhantom = FALSE;
	if ($this->param('phantom') && $this->param('phantom')=='yes') $D->isPhantom = TRUE;

	$D->layout_size = 'min';
	if ($this->param('lysize')) $D->layout_size = $this->param('lysize');

	$this->loadLanguage('global.php');
	$this->loadLanguage('dashboard.php');
	$this->loadLanguage('settings.php');

    /****************************************************************/    
    /****************************************************************/

    $D->privacy = $this->user->info->privacy;
    $D->who_write_on_my_wall = $this->user->info->who_write_on_my_wall;
    $D->who_can_see_friends = $this->user->info->who_can_see_friends;
    $D->who_can_see_liked_pages = $this->user->info->who_can_see_liked_pages;
    $D->who_can_see_joined_groups = $this->user->info->who_can_see_joined_groups;
    $D->who_can_sendme_messages = $this->user->info->who_can_sendme_messages;

    $D->who_can_see_birthdate = $this->user->info->who_can_see_birthdate;
    $D->who_can_see_location = $this->user->info->who_can_see_location;
    $D->who_can_see_about_me = $this->user->info->who_can_see_about_me;

    $D->chat = $this->user->info->chat;
    $D->chat_mute = $this->user->info->chat_mute;

    /****************************************************************/    
    /****************************************************************/

    $D->id_menu = 'opt_set_privacy';

	if ($D->isPhantom) {

        $html = '';

        $this->load_extract_controller('_settings-menu-left');

		if ($D->layout_size == 'min') {

            $for_load = 'min/settings-privacy.php';

		} else {

            $for_load = 'max/settings-privacy.php';

		}

        $D->titlePhantom = $this->lang('setting_privacy_title_page');

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_settings-menu-left');

		$D->page_title = $this->lang('setting_privacy_title_page');

        $D->file_in_template = 'max/settings-privacy.php';
        $this->load_template('dashboard-template.php');

	}

?>