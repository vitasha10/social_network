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
    
    $D->going = $this->db2->fetch_field('SELECT count(id) FROM events_actions WHERE idevent='.$D->idevent.' AND type_action=2');
    $D->interested = $this->db2->fetch_field('SELECT count(id) FROM events_actions WHERE idevent='.$D->idevent.' AND type_action=1');

    $D->posted_in_editor = 3;
    $D->code_wall_editor = $D->codeevent;
    $D->code_writer_editor = isset($user->info->code) ? $user->info->code : '';
    $D->type_writer_editor = 0;
    $D->for_who_editor = 0; // evalue change in future
    
    $D->placeholder_textarea_editor = $this->lang('dashboard_newactivity_ph_textarea_write_something');
    
    $D->editor_for = 3; //0: for User  1: for Page   2: for Group   3: for Event

    $D->view_editor = FALSE;
    
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
    
        $D->show_more = '';
        $D->the_list_activities = '';
    
        $res = $this->db2->query("SELECT * FROM posts WHERE typepost<>5 AND posted_in=3 AND id_wall=".$D->idevent." ORDER BY idpost DESC LIMIT 0, ".($K->ACTIVITIES_PER_PAGE + 1));
        $total_posts = $this->db2->num_rows();

        $D->the_place = 4; // profile in...  1: user  2: page  3:group   4:event
        $D->type_items = 1; // 1: timeline   2: videos   3: audios
        
        if ($total_posts>0) {
            $count_regs = 0;
            while ($obj = $this->db2->fetch_object($res)) {
    
                $the_post = (is_object($obj) && get_class($obj) == 'post') ? $obj : new post(FALSE, $obj);
                $D->the_list_activities .= $the_post->draw();
    
                $count_regs++;
                if ($count_regs >= $K->ACTIVITIES_PER_PAGE) break;
    
            }
            
            if ($total_posts > $K->ACTIVITIES_PER_PAGE) $D->show_more = $this->load_template('_showmore.php',FALSE);
    
        }
        
        if ($total_posts <= $K->ACTIVITIES_PER_PAGE) $D->the_list_activities .= $this->load_template('_activity-info-register.php',FALSE);

    }
    
    /******************************************************************/

    $D->view_editor = FALSE;
    
    if ($D->_IS_LOGGED) {
        
        $D->view_editor = TRUE;
        if ($D->privacy == 1) {
            if (!$D->is_my_event || !$D->iam_invited) $D->view_editor = FALSE;
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
            $for_load = 'min/event.php';
        } else {
            $for_load = 'max/event.php';
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
            $D->file_in_template = 'max/event.php';
            $this->load_template('dashboard-template.php');

        } else {
            
            if (!isset($D->string_js) || !is_array($D->string_js)) $D->string_js = array();
            array_push($D->string_js, 'moment.locale("'.$K->LANGUAGE.'");');
            
            $this->load_extract_controller('_bar-top');
            $this->load_extract_controller('_required-out');
            
            $D->file_in_template = 'max/event.php';
            $this->load_template('site-template.php');
            
        }
        
    }

?>