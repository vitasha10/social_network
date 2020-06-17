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
    $D->_IN_PROFILE = TRUE;
    
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
        $this->loadLanguage('settings.php');
    }
	$this->loadLanguage('profile.php');
    $this->loadLanguage('activity.php');

    $theevent = $network->getEventByCode($this->params->codeevent);
    $D->idevent = $theevent->idevent;
    $D->codeevent = $D->codeprofile = $theevent->code;
    $D->idcreator = $theevent->idcreator;
    $D->the_title = $theevent->title;
    $D->description = $theevent->description;
    $D->address = $theevent->address;
    $D->start_unix = $theevent->start_unix;
    $D->end_unix = $theevent->end_unix;

    $D->is_my_event = FALSE;
    $D->im_member = FALSE;
    $D->assistance = FALSE;
    $D->iam_invited = FALSE;

    if ($D->_IS_LOGGED) {
		$D->me = $this->user->info;
		$D->is_my_event = ($D->idcreator == $D->me->iduser);
        $D->assistance = $this->user->assistance($D->idevent);
    }

    $D->privacy = $theevent->privacy;
    
    if ($D->privacy == 1) {
        if (!$D->_IS_LOGGED) $this->globalRedirect('login');
        $D->iam_invited = $this->user->invitedToEvent($D->idevent);
        if (!$D->is_my_event || !$D->iam_invited) $this->globalRedirect($K->SITE_URL);
    }
    
    $D->text_type_event = '';
    switch($D->privacy) {
        case 0:
            $D->text_type_event = $this->lang('global_type_event_public');
            break;
        case 1:
            $D->text_type_event = $this->lang('global_type_event_private');
            break;
    }
    
    $D->with_cover = FALSE;
    $D->cover_event = '';
    if (!empty($theevent->cover)) {
        $D->cover_event = $K->STORAGE_URL_COVERS_EVENT.$theevent->code.'/'.$theevent->cover;
        $D->with_cover = TRUE;
		$D->cover_media = $theevent->cover_media;
		$D->cover_user = $theevent->cover_user;
    }
    
    $D->position_cover_event = $theevent->cover_position;
    $D->the_register_date = $theevent->created;
    
    
    $D->menu_footer = FALSE;

    $D->id_container = 'site';
    
    /******************************************************************/

    $D->show_activity = FALSE;
    switch($D->privacy) {
        case 0:
            $D->show_activity = TRUE;
            break;
        case 1:
            if ($D->is_my_event || $D->iam_invited) {
                $D->show_activity = TRUE;
            }
            break;
    }

    /******************************************************************/
    
    if ($D->show_activity) {
    
        $D->html_items = '';

        $all_items = $this->db2->fetch_all("SELECT users.* FROM users, events_actions WHERE users.iduser=events_actions.iduser AND idevent=".$D->idevent." AND type_action=2 AND active=1 ORDER BY users.firstname ASC");

        if (count($all_items) > 0) {

            $D->count_f = 0;
            foreach ($all_items as $oneitem) {

                $D->code_friend = $oneitem->code;
                $D->name_friend = stripslashes($oneitem->firstname).' '.stripslashes($oneitem->lastname);
                $D->username_friend = $oneitem->user_username;

                $base_url = $K->STORAGE_URL_AVATARS.'min2/';
                $D->avatar_friend = $oneitem->avatar;
                if (empty($D->avatar_friend)) $D->avatar_friend = $base_url.$K->DEFAULT_AVATAR_USER;
                else $D->avatar_friend = $base_url.$D->code_friend.'/'.$oneitem->avatar;

                $D->count_f ++;
                $D->html_items .= $this->load_template('ones/one-user-event.php', FALSE);

            }

        }

    }

    
    /****************************************************************************/

    $this->load_extract_controller('_pre-profile');

    /****************************************************************************/

	if ($D->isPhantom) {
        
        $html = '';
        
        if ($D->_IS_LOGGED) {
            
            $D->id_container = 'dashboard';
            $this->load_extract_controller('_dashboard-menu-left');
            
        }

        if ($D->layout_size == 'min') {
            $for_load = 'min/event-going.php';
        } else {
            $for_load = 'max/event-going.php';
        }
        
        $D->titlePhantom = $D->the_title.' | '.$K->SITE_TITLE;

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {
        
        $D->page_title = $D->the_title.' | '.$K->SITE_TITLE;
        
        if ($D->_IS_LOGGED) {
            
            $this->load_extract_controller('_required-dashboard');
            $this->load_extract_controller('_dashboard-bar-top');
            
            $D->id_container = 'dashboard';
            $this->load_extract_controller('_dashboard-menu-left');
            $D->file_in_template = 'max/event-going.php';
            $this->load_template('dashboard-template.php');

        } else {
            
            if (!isset($D->string_js) || !is_array($D->string_js)) $D->string_js = array();
            array_push($D->string_js, 'moment.locale("'.$K->LANGUAGE.'");');
            
            $this->load_extract_controller('_bar-top');
            $this->load_extract_controller('_required-out');
            
            $D->file_in_template = 'max/event-going.php';
            $this->load_template('site-template.php');
            
        }
        
    }

?>