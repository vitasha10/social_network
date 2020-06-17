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

    $D->show_more = FALSE;
    $D->the_list_items = '';

    $res = $this->db2->query("SELECT users.* FROM users, users_blocked WHERE users_blocked.iduserblocked=users.iduser AND users_blocked.iduser=".$this->user->id." ORDER BY id DESC LIMIT 0, ".($K->ITEMS_PER_PAGE + 1));

    $total_items = $this->db2->num_rows();

    $count_regs = 0;

    while ($obj = $this->db2->fetch_object($res)) {

        $D->user_blocked = $obj;
        $D->user_blocked->user_code = stripslashes($D->user_blocked->code);
        $D->user_blocked->user_username = stripslashes($D->user_blocked->user_username);
        $D->user_blocked->firstname = stripslashes($D->user_blocked->firstname);
        $D->user_blocked->lastname = stripslashes($D->user_blocked->lastname);
        $D->user_blocked->num_friends = $D->user_blocked->num_friends;
        $D->user_blocked->avatar =  empty($D->user_blocked->avatar) ? $K->DEFAULT_AVATAR_USER : stripslashes($D->user_blocked->avatar);
        $D->user_blocked->avatar = $K->STORAGE_URL_AVATARS.'min2/'.($D->user_blocked->avatar == $K->DEFAULT_AVATAR_PAGE ? '' : $D->user_blocked->user_code.'/') . $D->user_blocked->avatar;

        $D->user_blocked_last = FALSE;
        if ($total_items < $count_regs + 2) $D->user_blocked_last = TRUE;

        $D->the_list_items .= $this->load_template('ones/one-user-blocked.php', FALSE);

        $count_regs++;
        if ($count_regs >= $K->ITEMS_PER_PAGE) break;

    }

    if ($total_items > $K->ITEMS_PER_PAGE) $D->show_more = TRUE;

    /****************************************************************/    
    /****************************************************************/

    $D->id_menu = 'opt_set_blocked';

	if ($D->isPhantom) {

        $html = '';

        $this->load_extract_controller('_settings-menu-left');

		if ($D->layout_size == 'min') {

            $for_load = 'min/settings-blocked.php';

		} else {

            $for_load = 'max/settings-blocked.php';

		}

        $D->titlePhantom = $this->lang('setting_blocked_title_page');

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_settings-menu-left');

		$D->page_title = $this->lang('setting_blocked_title_page');

        $D->file_in_template = 'max/settings-blocked.php';
        $this->load_template('dashboard-template.php');

	}

?>