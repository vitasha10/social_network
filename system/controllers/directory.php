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
    
    $D->show_more = FALSE;
    $D->the_list_items = '';

    /****************************************************************************/

    $K->ITEMS_PER_PAGE = $K->ITEMS_PER_PAGE_DIRECTORY;
    $res = $this->db2->query("SELECT * FROM users WHERE active=1 ORDER BY iduser DESC LIMIT 0, ".($K->ITEMS_PER_PAGE + 1));
    $total_items = $this->db2->num_rows();

    $count_regs = 0;
    while ($obj = $this->db2->fetch_object($res)) {

        $D->one_item_directory = $obj;
        $D->one_item_directory->firstname = stripslashes($D->one_item_directory->firstname);
        $D->one_item_directory->lastname = stripslashes($D->one_item_directory->lastname);
        
        $D->one_item_directory->username = $D->one_item_directory->user_username;
        
        if (empty($obj->avatar)) $D->one_item_directory->avatar = $K->DEFAULT_AVATAR_USER;
        $base_url = $K->STORAGE_URL_AVATARS.'min4/';
        $D->the_avatar_item = $base_url.$D->one_item_directory->avatar;
        if ($D->one_item_directory->avatar != $K->DEFAULT_AVATAR_USER) $D->the_avatar_item = $base_url.$D->one_item_directory->code.'/'.$D->one_item_directory->avatar;

        $D->the_list_items .= $this->load_template('ones/one-item-directory.php', FALSE);

        $count_regs++;
        if ($count_regs >= $K->ITEMS_PER_PAGE) break;

    }

    if ($total_items > $K->ITEMS_PER_PAGE) $D->show_more = TRUE;

    /****************************************************************************/

    $D->id_menu = 'opt_ml_directory';
    
    /****************************************************************************/
    
    
    $this->load_extract_controller('_pre-dashboard');
    
    $D->SHOW_SUGGESTIONS_PEOPLE = FALSE;

    /****************************************************************************/


	if ($D->isPhantom) {

        $html = '';
        $this->load_extract_controller('_dashboard-menu-left');

		if ($D->layout_size == 'min') {
            $for_load = 'min/directory.php';
		} else {
            $for_load = 'max/directory.php';
		}

        $D->titlePhantom = $this->lang('dashboard_directory_title_page');

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_dashboard-menu-left');

        $D->page_title = $this->lang('dashboard_directory_title_page');

        $D->file_in_template = 'max/directory.php';
        $this->load_template('dashboard-template.php');

    }

?>