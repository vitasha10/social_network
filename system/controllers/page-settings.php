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
	if (!$D->_IS_LOGGED) $this->globalRedirect($K->SITE_URL.$this->params->username);

    $D->_IN_PROFILE = TRUE;
    $D->_WITH_NOTIFIER = TRUE;

	$D->isPhantom = FALSE;
	if ($this->param('phantom') && $this->param('phantom')=='yes') $D->isPhantom = TRUE;

	$D->layout_size = 'min';
	if ($this->param('lysize')) $D->layout_size = $this->param('lysize');

	$this->loadLanguage('global.php');
    $this->loadLanguage('dashboard.php');
    $this->loadLanguage('settings.php');

	$this->loadLanguage('profile.php');
    $this->loadLanguage('activity.php');

    $thepage = $network->getPageById($this->params->page);
    $D->idpage = $thepage->idpage;
    $D->codepage = $thepage->code;
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

    $D->me = $this->user->info;
    $D->is_my_page = ($D->idcreator == $D->me->iduser);

    if (!$D->is_my_page) $this->globalRedirect($K->SITE_URL.$this->params->username);

    $D->menu_footer = FALSE;

    $D->id_container = 'dashboard';
    $this->load_extract_controller('_dashboard-menu-left');
    
    /****************************************************************************/

    $this->load_extract_controller('_pre-profile');

    /****************************************************************************/

	if ($D->isPhantom) {

        $html = '';

        if ($D->layout_size == 'min') {

            $for_load = 'min/page-settings.php';

        } else {

            $for_load = 'max/page-settings.php';

        }

        $D->titlePhantom = $D->the_title.' | '.$K->SITE_TITLE;

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $D->page_title = $D->the_title.' | '.$K->SITE_TITLE;

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');

        $D->file_in_template = 'max/page-settings.php';            
        $this->load_template('dashboard-template.php');

    }
?>