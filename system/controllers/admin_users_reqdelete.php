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

    $D->me = $this->user->info;

    $D->qsql = '';
	$D->USER_PER_PAGE = $K->ITEMS_PER_PAGE;
	$D->pageCurrent = 1;
	if ($this->param('p')) $D->pageCurrent = $this->param('p');
	$D->totalitems = $this->db2->fetch_field('SELECT count(iduser) FROM users WHERE req_delete=1 '.$D->qsql);
	$D->start = ($D->pageCurrent-1) * $D->USER_PER_PAGE;

    /**** Pagination ****/

    $D->url_list = $K->SITE_URL.'admin/users/reqdelete/';

    $D->totalPag = ceil($D->totalitems/$D->USER_PER_PAGE);
    if ($D->totalPag == 0) $D->totalPag = 1;
    if ($D->totalPag < $D->pageCurrent) $this->globalRedirect($D->url_list);
    $D->pagVisibles = 2;

    if ($D->totalPag > (2 * $D->pagVisibles) + 1) {

        $D->firstPage = $D->pageCurrent - $D->pagVisibles;
        if ($D->firstPage < 1) $D->firstPage = 1;

        $D->lastPage = $D->firstPage + (2 * $D->pagVisibles);
        if ($D->lastPage > $D->totalPag) $D->lastPage = $D->totalPag;

        if ($D->lastPage - $D->firstPage < (2 * $D->pagVisibles) + 1) $D->firstPage = $D->lastPage - (2 * $D->pagVisibles);

    } else {

        $D->firstPage = 1;
        $D->lastPage = $D->totalPag;

    }

    /********************/

    $items = $this->db2->fetch_all("SELECT * FROM users WHERE req_delete=1 ".$D->qsql." ORDER BY user_username ASC LIMIT ".$D->start.",".$D->USER_PER_PAGE);
    $D->numusers = count($items);

    $D->html_items = '';

    foreach ($items as $oneitem) {
        $D->one = $oneitem;

        $D->one->avatar = empty($oneitem->avatar) ? $K->DEFAULT_AVATAR_USER : $oneitem->avatar;
        $D->one->avatar = $K->STORAGE_URL_AVATARS.'min2/'.($D->one->avatar == $K->DEFAULT_AVATAR_USER ? '' : $D->one->code.'/') . $D->one->avatar;

        $D->one->allname = stripslashes($oneitem->firstname).' '.stripslashes($oneitem->lastname);
        $D->one->username = stripslashes($oneitem->user_username);
        $D->isadministrador = $oneitem->is_admin;
        $D->leveladmin = $oneitem->leveladmin;

        $D->html_items .= $this->load_template('ones/one-user-list.php', FALSE);
    }

    /****************************************************************/    
    /****************************************************************/

    $D->js_script_min = $this->designer->getStringJS('admin');

    $D->id_menu = 'opt_adm_users_reqdelete';

	if ($D->isPhantom) {

        $html = '';

        $this->load_extract_controller('_admin-menu-left');

		if ($D->layout_size == 'min') {

            $for_load = 'min/admin-users-reqdelete.php';

		} else {

            $for_load = 'max/admin-users-reqdelete.php';

		}

        $D->titlePhantom = $this->lang('admin_users_reqdelete_title_page');

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_admin-menu-left');

		$D->page_title = $this->lang('admin_users_reqdelete_title_page');    	

        $D->file_in_template = 'max/admin-users-reqdelete.php';
        $this->load_template('dashboard-template.php');

	}

?>