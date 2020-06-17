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
    $D->data_media_avatar_user = $K->STORAGE_URL_AVATARS.'min4/'.$theuser->avatar;
    if ($theuser->avatar != $K->DEFAULT_AVATAR_USER) {
        $url_base_avatar .= $theuser->code.'/';
        $D->with_avatar = TRUE;
        $D->data_media_avatar_user = $K->STORAGE_URL_AVATARS.'originals/'.$theuser->code.'/'.$theuser->avatar;
    }
    $D->the_avatar_user = $url_base_avatar.$theuser->avatar;

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

    if ($D->show_profile) {
        
        $cad_condition = ' AND (posts.for_who=0) ';
        if ($D->is_my_profile) $cad_condition = '';
        else {
            if ($D->friendship == 1) $cad_condition = ' AND (posts.for_who=0 || posts.for_who=1) ';
        }
        
        $D->html_photos = '';
        
        $all_post_photos = $this->db2->fetch_all("SELECT medias.* FROM posts, medias WHERE (typepost=1 AND posts.posted_in=0 AND id_wall=".$D->iduser.") AND (medias.posted_in=0 AND idcontainer=idpost) ".$cad_condition." ORDER BY post_date DESC");
        
        foreach ($all_post_photos as $onephoto) {
            
            $D->gph_code = $onephoto->code;
            $D->gph_namefile = $onephoto->namefile;
            $D->gph_folder = $onephoto->folder;
            $D->gph_media = $K->STORAGE_URL_PHOTOS.'thumb1/'.$D->gph_folder.'/'.$D->gph_namefile;
            $D->gph_urlphoto = $K->SITE_URL.$D->username.'/photo/'.$onephoto->code;
            $D->html_photos .= $this->load_template('ones/one-photo-profile.php', FALSE);
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
            $for_load = 'min/profile-photos.php';
        } else {
            $for_load = 'max/profile-photos.php';
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
            $D->file_in_template = 'max/profile-photos.php';            
            $this->load_template('dashboard-template.php');

        } else {
            
            if (!isset($D->string_js) || !is_array($D->string_js)) $D->string_js = array();
            array_push($D->string_js, 'moment.locale("'.$K->LANGUAGE.'");');
            
            $this->load_extract_controller('_bar-top');
            $this->load_extract_controller('_required-out');
            
            $D->file_in_template = 'max/profile-photos.php';
            $this->load_template('site-template.php');
            
        }
        
    }

?>