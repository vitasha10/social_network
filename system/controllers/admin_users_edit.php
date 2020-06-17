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
	$D->iduser = '';
	if ($this->param('u')) $D->iduser = $this->param('u');
    $D->iduser = $the_sanitaze->int($D->iduser);
    if ($D->iduser <= 0) $this->globalRedirect($K->SITE_URL.'admin/users');

    $info_user = $this->db2->fetch("SELECT iduser FROM users WHERE iduser=".$D->iduser." LIMIT 1");
    if (!$info_user) $this->globalRedirect($K->SITE_URL.'admin/users');

    $D->me = $this->user->info;

    $D->the_user = $this->db2->fetch("SELECT * FROM users WHERE iduser=".$D->iduser." LIMIT 1");

    $D->verified = $D->the_user->verified;
    $D->active = $D->the_user->active;
    $D->isadministrador = $D->the_user->is_admin;
    $D->leveladmin = $D->the_user->leveladmin;

    $D->firstname = stripslashes($D->the_user->firstname);
    $D->lastname = stripslashes($D->the_user->lastname);
    $D->the_name_user = stripslashes($D->the_user->firstname).' '.stripslashes($D->the_user->lastname);
    $D->gender = $D->the_user->gender;
    $D->born = explode('-', $D->the_user->birthday);

    $D->currentcity = stripslashes($D->the_user->currentcity);
    $D->hometown = stripslashes($D->the_user->hometown);

    $D->email = stripslashes($D->the_user->user_email);

    $D->username = stripslashes($D->the_user->user_username);

    $D->privacy = $D->the_user->privacy;
    $D->who_write_on_my_wall = $D->the_user->who_write_on_my_wall;
    $D->who_can_see_friends = $D->the_user->who_can_see_friends;
    $D->who_can_see_liked_pages = $D->the_user->who_can_see_liked_pages;
    $D->who_can_see_joined_groups = $D->the_user->who_can_see_joined_groups;
    $D->who_can_sendme_messages = $D->the_user->who_can_sendme_messages;

    $D->who_can_see_birthdate = $D->the_user->who_can_see_birthdate;
    $D->who_can_see_location = $D->the_user->who_can_see_location;
    $D->who_can_see_about_me = $D->the_user->who_can_see_about_me;

    $D->chat = $D->the_user->chat;

    /****************************************************************/    
    /****************************************************************/

    $D->js_script_min = $this->designer->getStringJS('admin');
    $D->js_script_min .= $this->designer->getStringJS('md5');

    $D->id_menu = 'opt_adm_users';

	if ($D->isPhantom) {

        $html = '';

        $this->load_extract_controller('_admin-menu-left');

		if ($D->layout_size == 'min') {

            $for_load = 'min/admin-users-edit.php';

		} else {

            $for_load = 'max/admin-users-edit.php';

		}

        $D->titlePhantom = $this->lang('admin_users_title_page').' | '.$D->the_name_user;

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_admin-menu-left');

		$D->page_title = $this->lang('admin_users_title_page').' | '.$D->the_name_user;    	

        $D->file_in_template = 'max/admin-users-edit.php';
        $this->load_template('dashboard-template.php');

	}

?>