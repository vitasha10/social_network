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
    $D->_IN_PROFILE = FALSE;

    if ($D->_IS_LOGGED) $D->_WITH_NOTIFIER = TRUE;

	$D->isPhantom = FALSE;
	if ($this->param('phantom') && $this->param('phantom')=='yes') $D->isPhantom = TRUE;

	$D->layout_size = 'min';
	if ($this->param('lysize')) $D->layout_size = $this->param('lysize');

	$this->loadLanguage('global.php');
    if ($D->_IS_LOGGED) {
        $this->loadLanguage('dashboard.php');
        $this->loadLanguage('settings.php');
    }

    if ($D->_IS_LOGGED) {
		$D->me = $this->user->info;
    }

    $D->menu_footer = FALSE;

    $D->id_container = 'site';

    /******************************************************************/

    $the_sanitaze = new sanitize(); // init sanitaze

	$D->the_query = '';
	if (isset($this->params->q) && !empty($this->params->q)) $D->the_query = urldecode($this->params->q);

    $D->the_query = $the_sanitaze->str_nohtml($D->the_query);


    $D->html_results = '';
    if (!empty($D->the_query)) {
        
        $sqlidblockeds = '0';
        if ($D->_IS_LOGGED) {
            $sqlidblockeds = 'SELECT iduserblocked FROM users_blocked WHERE iduser='.$D->me->iduser;
        }
        
        $thusers = $this->db2->fetch_all("
        SELECT * FROM users
        WHERE active=1 
        AND iduser NOT IN (".$sqlidblockeds.") 
        AND ((firstname LIKE '%".$D->the_query."%') 
        OR (lastname LIKE '%".$D->the_query."%')
        OR (CONCAT(firstname,' ',lastname) LIKE '%".$D->the_query."%')) 
        ORDER BY num_friends DESC");
        
        $D->numresults = count($thusers);
        if ($D->numresults > 0) {
            foreach ($thusers as $oneuser) {
                if (empty($oneuser->avatar)) $oneuser->avatar = $K->DEFAULT_AVATAR_USER;
                $base_url = $K->STORAGE_URL_AVATARS.'min2/';
                $D->st_user_avatar = $base_url.$oneuser->avatar;
                if ($oneuser->avatar != $K->DEFAULT_AVATAR_USER) $D->st_user_avatar = $base_url.$oneuser->code.'/'.$oneuser->avatar;

                $D->st_user_name = stripslashes($oneuser->firstname).' '.stripslashes($oneuser->lastname);
                $D->st_user_url = $K->SITE_URL.$oneuser->user_username.'/ref:search';
                $D->st_user_numfriends = $oneuser->num_friends;
                $D->html_results .= $this->load_template('ones/one-user-result-search.php', FALSE);
            }

        } else {
            $D->html_results .= $this->load_template('_empty-result-serch-top.php', FALSE);
        }
    }

    /****************************************************************************/
    
    $this->load_extract_controller('_pre-dashboard-alone');

    /****************************************************************************/

	if ($D->isPhantom) {

        $html = '';
        $this->load_extract_controller('_dashboard-menu-left');

        if ($D->_IS_LOGGED) {
            $D->id_container = 'dashboard';
        }

        if ($D->layout_size == 'min') {
            $for_load = 'min/search.php';
        } else {
            $for_load = 'max/search.php';
        }

        $D->titlePhantom = $this->lang('global_search_title_page').' | '.$K->SITE_TITLE;

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $D->page_title = $this->lang('global_search_title_page').' | '.$K->SITE_TITLE;
        
        $this->load_extract_controller('_dashboard-menu-left');

        if ($D->_IS_LOGGED) {

            $this->load_extract_controller('_required-dashboard');
            $this->load_extract_controller('_dashboard-bar-top');

            $D->id_container = 'dashboard';
            $D->file_in_template = 'max/search.php';
            $this->load_template('dashboard-template.php');

        } else {

            if (!isset($D->string_js) || !is_array($D->string_js)) $D->string_js = array();
            array_push($D->string_js, 'moment.locale("'.$K->LANGUAGE.'");');

            $this->load_extract_controller('_bar-top');
            $this->load_extract_controller('_required-out');

            $D->file_in_template = 'max/search.php';
            $this->load_template('site-template.php');

        }

    }

?>