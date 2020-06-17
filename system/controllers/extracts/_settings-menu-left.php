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
    $the_title = array(
        'title' => $this->lang('setting_menu_title'),
    );
	$D->setting_menu_title = $this->designer->createTitleMenuSetting($the_title);

    $the_menu = array(
    array('id_option' => 'opt_set_account', 'url' => 'settings/account', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-set-acount', 'icono' => 'ico-set-account.png', 'tag_title' =>  $this->lang('setting_menu_account'), 'text_option' =>  $this->lang('setting_menu_account'), 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_set_account') ? TRUE : FALSE ),
     );

    $D->setting_menu_left = $this->designer->createBlockMenuLeftSetting($the_menu, TRUE);

    $the_menu = array(
    array('id_option' => 'opt_set_profile', 'url' => 'settings/profile', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-set-profile', 'icono' => 'ico-set-profile.png', 'tag_title' =>  $this->lang('setting_menu_profile'), 'text_option' =>  $this->lang('setting_menu_profile'), 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_set_profile') ? TRUE : FALSE ),
     );

    $D->setting_menu_left .= $this->designer->createBlockMenuLeftSetting($the_menu, TRUE);

    $the_menu = array(
    array('id_option' => 'opt_set_privacy', 'url' => 'settings/privacy', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-set-privacy', 'icono' => 'ico-set-privacy.png', 'tag_title' =>  $this->lang('setting_menu_privacy'), 'text_option' =>  $this->lang('setting_menu_privacy'), 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_set_privacy') ? TRUE : FALSE ),
     );

    $D->setting_menu_left .= $this->designer->createBlockMenuLeftSetting($the_menu, TRUE);

    $the_menu = array(
    array('id_option' => 'opt_set_blocked', 'url' => 'settings/blocked', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-set-blocked', 'icono' => 'ico-set-blocking.png', 'tag_title' =>  $this->lang('setting_menu_blocked'), 'text_option' =>  $this->lang('setting_menu_blocked'), 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_set_blocked') ? TRUE : FALSE ),
     );

    $D->setting_menu_left .= $this->designer->createBlockMenuLeftSetting($the_menu, TRUE);

    $the_menu = array(
    array('id_option' => 'opt_set_delete', 'url' => 'settings/delete', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-set-delete', 'icono' => 'ico-set-delete.png', 'tag_title' =>  $this->lang('setting_menu_delete'), 'text_option' =>  $this->lang('setting_menu_delete'), 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_set_delete') ? TRUE : FALSE ),
     );

    $D->setting_menu_left .= $this->designer->createBlockMenuLeftSetting($the_menu, FALSE);



    /*************************************************************************/    
    /* Settings Menu Responsive*/


    $the_menu = array(
    array('id_option' => 'opt_set_account', 'url' => 'settings/account', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-set-acount', 'icono' => 'ico-set-account.png', 'tag_title' =>  $this->lang('setting_menu_account'), 'text_option' =>  $this->lang('setting_menu_account'), 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_set_account') ? TRUE : FALSE ),
     );

    $D->setting_menu_responsive = $this->designer->createBlockMenuLeftSetting($the_menu, TRUE);

    $the_menu = array(
    array('id_option' => 'opt_set_profile', 'url' => 'settings/profile', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-set-profile', 'icono' => 'ico-set-profile.png', 'tag_title' =>  $this->lang('setting_menu_profile'), 'text_option' =>  $this->lang('setting_menu_profile'), 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_set_profile') ? TRUE : FALSE ),
     );

    $D->setting_menu_responsive .= $this->designer->createBlockMenuLeftSetting($the_menu, TRUE);

    $the_menu = array(
    array('id_option' => 'opt_set_privacy', 'url' => 'settings/privacy', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-set-privacy', 'icono' => 'ico-set-privacy.png', 'tag_title' =>  $this->lang('setting_menu_privacy'), 'text_option' =>  $this->lang('setting_menu_privacy'), 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_set_privacy') ? TRUE : FALSE ),
     );

    $D->setting_menu_responsive .= $this->designer->createBlockMenuLeftSetting($the_menu, TRUE);

    $the_menu = array(
    array('id_option' => 'opt_set_blocked', 'url' => 'settings/blocked', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-set-blocked', 'icono' => 'ico-set-blocking.png', 'tag_title' =>  $this->lang('setting_menu_blocked'), 'text_option' =>  $this->lang('setting_menu_blocked'), 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_set_blocked') ? TRUE : FALSE ),
     );

    $D->setting_menu_responsive .= $this->designer->createBlockMenuLeftSetting($the_menu, TRUE);

    $the_menu = array(
    array('id_option' => 'opt_set_delete', 'url' => 'settings/delete', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-set-delete', 'icono' => 'ico-set-delete.png', 'tag_title' =>  $this->lang('setting_menu_delete'), 'text_option' =>  $this->lang('setting_menu_delete'), 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_set_delete') ? TRUE : FALSE ),
     );

    $D->setting_menu_responsive .= $this->designer->createBlockMenuLeftSetting($the_menu, FALSE);