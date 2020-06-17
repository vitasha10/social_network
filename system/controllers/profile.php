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

    $theuser = $network->getUserById($this->params->user);
    $D->iduser = $theuser->iduser;

    $D->is_reported = FALSE;
    if ($D->_IS_LOGGED) {
        if ($this->user->isBlocked($D->iduser)) $this->globalRedirect('dashboard');
        if ($this->user->isBlockedMe($D->iduser)) $this->globalRedirect('dashboard');

        if ($this->user->isReported($D->iduser)) {
            $D->is_reported = TRUE;
        }
    }
    
    $D->codeprofile = $theuser->code;
    $D->username = $theuser->user_username;
    $D->the_name_user = stripslashes($theuser->firstname).' '.stripslashes($theuser->lastname);
    $D->aboutme = stripslashes($theuser->aboutme);
    $D->currentcity = stripslashes($theuser->currentcity);
    $D->hometown = stripslashes($theuser->hometown);
    $D->text_gender = $this->lang('profile_txt_male');
    if ($theuser->gender==1) $D->text_gender = $this->lang('profile_txt_male');
    if ($theuser->gender==2) $D->text_gender = $this->lang('profile_txt_female');

    $thebirthday = explode('-', $theuser->birthday);
    $D->text_birthday = $thebirthday[1].'/'.$thebirthday[2].'/'.$thebirthday[0];

    $D->with_avatar = FALSE;
    $url_base_avatar = $K->STORAGE_URL_AVATARS.'min4/';
    $url_base_avatar_mini = $K->STORAGE_URL_AVATARS.'min3/';
    $D->data_media_avatar_user = $K->STORAGE_URL_AVATARS.'min1/'.$theuser->avatar;
    if ($theuser->avatar != $K->DEFAULT_AVATAR_USER) {
        $url_base_avatar .= $theuser->code.'/';
        $url_base_avatar_mini .= $theuser->code.'/';
        $D->with_avatar = TRUE;
        $D->data_media_avatar_user = $K->STORAGE_URL_AVATARS.'originals/'.$theuser->code.'/'.$theuser->avatar;
		$D->avatar_media = $theuser->avatar_media;
    }
    $D->the_avatar_user = $url_base_avatar.$theuser->avatar;
    $D->the_avatar_user_min = $url_base_avatar_mini.$theuser->avatar;
    
    $D->with_cover = FALSE;
    $D->cover_user = '';
    if (!empty($theuser->cover)) {
        $D->cover_user = $K->STORAGE_URL_COVERS.$theuser->code.'/'.$theuser->cover;
        $D->with_cover = TRUE;
		$D->cover_media = $theuser->cover_media;
    }

    $D->position_cover_user = $theuser->cover_position;
    $D->who_write_on_my_wall = $theuser->who_write_on_my_wall;
    $D->the_verified = $theuser->verified;
    $D->the_register_date = $theuser->registerdate;

    $D->posted_in_editor = 0;
    $D->code_wall_editor = isset($D->codeprofile) ? $D->codeprofile : '';
    $D->code_writer_editor = isset($user->info->code) ? $user->info->code : '';
    $D->type_writer_editor = 0;
    $D->for_who_editor = 1;
    
    $D->placeholder_textarea_editor = $this->lang('dashboard_newactivity_ph_textarea');

    $D->editor_for = 0; //0: User  1: Page   2: Group
    
    $D->is_my_profile = FALSE;
    $D->friendship = 0;
    if ($D->_IS_LOGGED) {
		$D->me = $this->user->info;
		$D->is_my_profile = ($D->iduser == $D->me->iduser);
        $D->friendship = $user->friendship($D->iduser);
    }

    $D->view_selector_who = TRUE;
    if (!$D->is_my_profile) {
        $D->for_who = 0;
        $D->view_selector_who = FALSE;
    }

    $D->view_editor = FALSE;
    
    $D->menu_footer = FALSE;

    $D->id_container = 'site';

    /******************************************************************/
	
    if ($D->_IS_LOGGED) {
        if ($this->param('ref') && $this->param('ref')=='search') {
            $network->saveRecentSearch($D->me->iduser, $D->iduser, 1);
        }
    }
    
    /******************************************************************/
    
	$D->privacy = $theuser->privacy;
	$D->show_profile = FALSE;
	switch ($D->privacy) {
		case 0:
			$D->show_profile = TRUE;
			break;
		case 1:
			if ($D->friendship == 1 || $D->is_my_profile) {
				$D->show_profile = TRUE;
			}
			break;
		case 2:
			if ($D->is_my_profile) {
				$D->show_profile = TRUE;
			}
			break;
	}
	
    
    /******************************************************************/

    if ($D->show_profile) {

        if ($D->friendship == 1 || $D->is_my_profile) $cadSee = ' (for_who=0 OR for_who=1) ';
        else $cadSee = ' for_who=0 ';
    
        $D->show_more = '';
        $D->the_list_activities = '';
        
        $sqlPostsHiddens = '';
        if ($D->_IS_LOGGED) {
            $sqlPostsHiddens = 'idpost NOT IN (SELECT iditem FROM hiddens WHERE typeitem=0 AND iduser='.$D->me->iduser.') AND ';
        }
    
        $res = $this->db2->query("
        SELECT * FROM posts 
        WHERE ".$sqlPostsHiddens."
        posted_in=0
        AND id_wall=".$D->iduser."
        AND ".$cadSee." 
        ORDER BY idpost DESC 
        LIMIT 0, ".($K->ACTIVITIES_PER_PAGE + 1));
        
        $total_posts = $this->db2->num_rows();
    
        $D->the_place = 1; // profile in...  1: user  2: page  3:group
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
    
    /****************************************************************************/

    $this->load_extract_controller('_pre-profile');

    /****************************************************************************/

    
	if ($D->isPhantom) {
        
        $html = '';
        
        if ($D->_IS_LOGGED) {
            
            $D->id_container = 'dashboard';
            $this->load_extract_controller('_dashboard-menu-left');
                        
            if ($network->canWrite($D->who_write_on_my_wall, $D->iduser, $user->info->iduser)) $D->view_editor = TRUE;
            
        }

        if ($D->layout_size == 'min') {
            $for_load = 'min/profile.php';
        } else {
            $for_load = 'max/profile.php';
        }
        
        $D->titlePhantom = $D->the_name_user.' | '.$K->SITE_TITLE;

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {
        
        $D->page_title = $D->the_name_user.' | '.$K->SITE_TITLE;
        
        if ($D->_IS_LOGGED) {
            
            $this->load_extract_controller('_required-dashboard');
            $this->load_extract_controller('_dashboard-bar-top');

            $this->load_extract_controller('_dashboard-menu-left');
            
            if ($network->canWrite($D->who_write_on_my_wall, $D->iduser, $user->info->iduser)) $D->view_editor = TRUE;
            $D->id_container = 'dashboard';
            $D->file_in_template = 'max/profile.php';            
            $this->load_template('dashboard-template.php');

        } else {
            
            if (!isset($D->string_js) || !is_array($D->string_js)) $D->string_js = array();
            array_push($D->string_js, 'moment.locale("'.$K->LANGUAGE.'");');
            
            $this->load_extract_controller('_bar-top');
            $this->load_extract_controller('_required-out');
            
            $D->file_in_template = 'max/profile.php';
            $this->load_template('site-template.php');
            
        }
        
    }

?>