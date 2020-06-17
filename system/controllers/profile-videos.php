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

    $D->with_avatar = FALSE;
    $url_base_avatar = $K->STORAGE_URL_AVATARS.'min4/';
    $url_base_avatar_mini = $K->STORAGE_URL_AVATARS.'min3/';
    $D->data_media_avatar_user = $K->STORAGE_URL_AVATARS.'min1/'.$theuser->avatar;
    if ($theuser->avatar != $K->DEFAULT_AVATAR_USER) {
        $url_base_avatar .= $theuser->code.'/';
        $url_base_avatar_mini .= $theuser->code.'/';
        $D->with_avatar = TRUE;
        $D->data_media_avatar_user = $K->STORAGE_URL_AVATARS.'originals/'.$theuser->code.'/'.$theuser->avatar;
    }
    $D->the_avatar_user = $url_base_avatar.$theuser->avatar;
    $D->the_avatar_user_min = $url_base_avatar_mini.$theuser->avatar;
    
    $D->with_cover = FALSE;
    $D->cover_user = '';
    if (!empty($theuser->cover)) {
        $D->cover_user = $K->STORAGE_URL_COVERS.$theuser->code.'/'.$theuser->cover;
        $D->with_cover = TRUE;
    }

    $D->position_cover_user = $theuser->cover_position;
    $D->the_verified = $theuser->verified;

    $D->is_my_profile = FALSE;
    $D->friendship = 0;
    if ($D->_IS_LOGGED) {
		$D->me = $this->user->info;
		$D->is_my_profile = ($D->iduser == $D->me->iduser);
        $D->friendship = $user->friendship($D->iduser);
    }

    $D->menu_footer = FALSE;

    $D->id_container = 'site';

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

    $D->title_section = $this->lang('profile_videos_title');

    /******************************************************************/

    if ($D->show_profile) {

        if ($D->friendship == 1 || $D->is_my_profile) $cadSee = ' (for_who=0 OR for_who=1) ';
        else $cadSee = ' for_who=0 ';
    
        $D->show_more = '';
        $D->the_list_activities = '';

        $D->num_items_total = $this->db2->fetch_field("
        SELECT count(idpost) FROM posts 
        WHERE typepost=2 AND posted_in=0
        AND id_wall=".$D->iduser."
        AND ".$cadSee);
    
        $res = $this->db2->query("
        SELECT * FROM posts 
        WHERE typepost=2 AND posted_in=0
        AND id_wall=".$D->iduser."
        AND ".$cadSee." 
        ORDER BY idpost DESC 
        LIMIT 0, ".($K->ACTIVITIES_PER_PAGE + 1));
        
        $total_posts = $this->db2->num_rows();
    
        $D->the_place = 1; // profile in...  1: user  2: page  3:group
        $D->type_items = 2; // 1: timeline   2: videos   3: audios
        
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
        
        if ($total_posts <= $K->ACTIVITIES_PER_PAGE) $D->the_list_activities .= '<div style="margin-bottom:50px;"></div>';
    
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
            $for_load = 'min/profile-videos.php';
        } else {
            $for_load = 'max/profile-videos.php';
        }
        
        $D->titlePhantom = $D->the_name_user.' | '.$K->SITE_TITLE;

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {
        
        $D->page_title = $D->the_name_user.' | '.$K->SITE_TITLE;
        
        if ($D->_IS_LOGGED) {
            
            $this->load_extract_controller('_required-dashboard');
            $this->load_extract_controller('_dashboard-bar-top');

            $D->id_container = 'dashboard';
            $this->load_extract_controller('_dashboard-menu-left');
            $D->file_in_template = 'max/profile-videos.php';            
            $this->load_template('dashboard-template.php');

        } else {
            
            if (!isset($D->string_js) || !is_array($D->string_js)) $D->string_js = array();
            array_push($D->string_js, 'moment.locale("'.$K->LANGUAGE.'");');
            
            $this->load_extract_controller('_bar-top');
            $this->load_extract_controller('_required-out');
            
            $D->file_in_template = 'max/profile-videos.php';
            $this->load_template('site-template.php');
            
        }
        
    }

?>