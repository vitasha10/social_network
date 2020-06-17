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

    $thepage = $network->getPageById($this->params->page);
    $D->idpage = $thepage->idpage;
    $D->codepage = $D->codeprofile = $thepage->code;
    $D->idcreator = $thepage->idcreator;
    $D->username = $thepage->puname;
    $D->the_title = $thepage->title;
    $D->description = $thepage->description;
    $D->idcat = $thepage->idcat;
    $D->idsubcat = $thepage->idsubcat;
    $D->nameCategory = $network->getNameCategory($D->idsubcat);

    $D->with_avatar = FALSE;
    $url_base_avatar = $K->STORAGE_URL_AVATARS_PAGE.'min4/';
    $D->data_media_avatar_page = $K->STORAGE_URL_AVATARS_PAGE.'min4/'.$thepage->avatar;
    if ($thepage->avatar != $K->DEFAULT_AVATAR_PAGE) {
        $url_base_avatar .= $thepage->code.'/';
        $D->with_avatar = TRUE;
        $D->data_media_avatar_page = $K->STORAGE_URL_AVATARS_PAGE.'originals/'.$thepage->code.'/'.$thepage->avatar;
    }
    $D->the_avatar_page = $url_base_avatar.$thepage->avatar;
    
    $D->with_cover = FALSE;
    $D->cover_page = '';
    if (!empty($thepage->cover)) {
        $D->cover_page = $K->STORAGE_URL_COVERS_PAGE.$thepage->code.'/'.$thepage->cover;
        $D->with_cover = TRUE;
    }

    $D->position_cover_page = $thepage->cover_position;
    $D->the_verified = $thepage->verified;
    $D->the_register_date = $thepage->created;


    $D->is_my_page = FALSE;
    $D->like_me_page = FALSE;
    if ($D->_IS_LOGGED) {
		$D->me = $this->user->info;
		$D->is_my_page = ($D->idcreator == $D->me->iduser);
        $D->like_me_page = $this->user->likeMePage($D->idpage);
    }

    $D->view_editor = FALSE;
    
    $D->menu_footer = FALSE;

    $D->id_container = 'site';
    
    /******************************************************************/
    
    $D->html_photos = '';
    
    $all_post_photos = $this->db2->fetch_all("SELECT medias.* FROM posts, medias WHERE (typepost=1 AND posts.posted_in=1 AND id_wall=".$D->idpage.") AND (medias.posted_in=0 AND idcontainer=idpost) ORDER BY post_date DESC");
    
    foreach ($all_post_photos as $onephoto) {
        
        $D->gph_code = $onephoto->code;
        $D->gph_namefile = $onephoto->namefile;
        $D->gph_folder = $onephoto->folder;
        $D->gph_media = $K->STORAGE_URL_PHOTOS.'thumb1/'.$D->gph_folder.'/'.$D->gph_namefile;
        $D->gph_urlphoto = $K->SITE_URL.$D->username.'/photo/'.$onephoto->code;
        $D->html_photos .= $this->load_template('ones/one-photo-profile.php', FALSE);
    }

    /****************************************************************************/

    $this->load_extract_controller('_pre-profile');

    /****************************************************************************/

	if ($D->isPhantom) {
        
        $html = '';
        
        if ($D->_IS_LOGGED) {
            
            $D->id_container = 'dashboard';
            $this->load_extract_controller('_dashboard-menu-left');
            
            if ($D->is_my_page) $D->view_editor = TRUE;
            
        }

        if ($D->layout_size == 'min') {
            $for_load = 'min/page-photos.php';
        } else {
            $for_load = 'max/page-photos.php';
        }
        
        $D->titlePhantom = $D->the_title.' | '.$K->SITE_TITLE;

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {
        
        $D->page_title = $D->the_title.' | '.$K->SITE_TITLE;
        
        if ($D->_IS_LOGGED) {
            
            $this->load_extract_controller('_required-dashboard');
            $this->load_extract_controller('_dashboard-bar-top');
            
            if ($D->is_my_page) $D->view_editor = TRUE;
            $D->id_container = 'dashboard';
            $this->load_extract_controller('_dashboard-menu-left');
            $D->file_in_template = 'max/page-photos.php';            
            $this->load_template('dashboard-template.php');

        } else {
            
            if (!isset($D->string_js) || !is_array($D->string_js)) $D->string_js = array();
            array_push($D->string_js, 'moment.locale("'.$K->LANGUAGE.'");');
            
            $this->load_extract_controller('_bar-top');
            $this->load_extract_controller('_required-out');
            
            $D->file_in_template = 'max/page-photos.php';
            $this->load_template('site-template.php');
            
        }
        
    }

?>