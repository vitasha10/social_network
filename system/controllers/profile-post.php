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

    /******************************************************************/

    $the_sanitaze = new sanitize(); // init sanitaze

	$D->thepost_code = '';
	if (isset($this->params->codpost) && !empty($this->params->codpost)) $D->thepost_code = $this->params->codpost;
    $D->thepost_code = $the_sanitaze->str_nohtml($D->thepost_code, 11);
    if (empty($D->thepost_code) || strlen($D->thepost_code) < 11) $this->globalRedirect($K->SITE_URL.$this->params->username);

    $D->thepost_username = $the_sanitaze->str_nohtml($this->params->username);

    /******************************************************************/

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
    $D->codeprofile = $theuser->code;
    $D->username = $theuser->user_username;
    $D->the_name_user = stripslashes($theuser->firstname).' '.stripslashes($theuser->lastname);

    $D->the_avatar_real = $theuser->avatar;
    $D->the_avatar_user = $K->STORAGE_URL_AVATARS.'min4/'.($theuser->avatar == $K->DEFAULT_AVATAR_USER ? '' : $theuser->code.'/') . $D->the_avatar_real;

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

    $D->post_is_showeable = TRUE;

    $obj_post = $this->db2->fetch("SELECT * FROM posts WHERE code='".$D->thepost_code."'");

    if (!$obj_post) $this->globalRedirect($K->SITE_URL.$this->params->username);

    if ($obj_post->for_who == 1) {
        if ($D->friendship != 1 && !$D->is_my_profile) $D->post_is_showeable = FALSE;
    }

    if ($obj_post->for_who == 2) {
        if (!$D->is_my_profile) $D->post_is_showeable = FALSE;

        if ($obj_post->posted_in == 2) {

            if ($this->network->getTypeGroup($obj_post->id_wall) == 0) $D->post_is_showeable = TRUE; 
            else {            
                if ($D->_IS_LOGGED) {
                    $D->membership = $this->user->membership($obj_post->id_wall);
                    if ($D->membership == 1) $D->post_is_showeable = TRUE;
                }
            }

        }
    }

    $D->html_post = '';
    if ($D->post_is_showeable) {
        $the_post = new post(FALSE, $obj_post);
        $D->html_post = $the_post->draw();
    }

    /****************************************************************************/

    $this->load_extract_controller('_pre-dashboard-alone');

    /****************************************************************************/

	if ($D->isPhantom) {

        $html = '';

        if ($D->_IS_LOGGED) {

            $D->id_container = 'dashboard';
			$this->load_extract_controller('_dashboard-menu-left');

        }

        if ($D->layout_size == 'min') {
            $for_load = 'min/profile-post.php';
        } else {
            $for_load = 'max/profile-post.php';
        }

        if ($D->post_is_showeable) {
            $D->titlePhantom = $D->the_name_user.' | '.$K->SITE_TITLE;
        } else {
            $D->titlePhantom = $this->lang('activity_txt_no_available').' | '.$K->SITE_TITLE;
        }

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        if ($D->post_is_showeable) {
            $D->page_title = $D->the_name_user.' | '.$K->SITE_TITLE;
        } else {
            $D->page_title = $this->lang('activity_txt_no_available').' | '.$K->SITE_TITLE;
        }

        if ($D->_IS_LOGGED) {

            $this->load_extract_controller('_required-dashboard');
            $this->load_extract_controller('_dashboard-bar-top');

            $D->id_container = 'dashboard';
			$this->load_extract_controller('_dashboard-menu-left');
            $D->file_in_template = 'max/profile-post.php';

            $this->load_template('dashboard-template.php');

        } else {

            if (!isset($D->string_js) || !is_array($D->string_js)) $D->string_js = array();
            array_push($D->string_js, 'moment.locale("'.$K->LANGUAGE.'");');

            $this->load_extract_controller('_bar-top');
            $this->load_extract_controller('_required-out');

            $D->file_in_template = 'max/profile-post.php';
            $this->load_template('site-template.php');

        }

    }

?>