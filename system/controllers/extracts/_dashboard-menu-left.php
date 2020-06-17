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

    /*************************************************************************/

    $the_username = $this->user->info->user_username;
    
    $the_allname_user = (empty($this->user->info->firstname) ? $the_username : stripslashes($this->user->info->firstname).' '.stripslashes($this->user->info->lastname));
    $the_firstname_user = (empty($this->user->info->firstname) ? $the_username : stripslashes($this->user->info->firstname));
    
    $the_avatar = empty($this->user->info->avatar) ? $K->DEFAULT_AVATAR_USER : $this->user->info->avatar;
    $the_avatar = $K->STORAGE_URL_AVATARS.'min2/'.($the_avatar == $K->DEFAULT_AVATAR_USER ? '' : $this->user->info->code.'/') . $the_avatar;
    
    $D->card_user = array(
        'username' => $the_username, 'rel' => 'phantom-all', 'target' => 'dashboard-main-area', 'tag_title' => $the_allname_user, 'avatar' => $the_avatar, 'firstname' => $the_firstname_user
    );
    
    $D->mini_card_user = $this->designer->createCardUserMenuLeft($D->card_user);

    /*************************************************************************/    
    /* Dashboard Menu Left*/

    $D->the_menu = array(
        array('id_option' => 'opt_ml_newsfeed', 'url' => 'dashboard', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-news', 'icono' => 'i-m-news.png', 'tag_title' =>  $this->lang('dashboard_mleft_news_feed'), 'text_option' =>  $this->lang('dashboard_mleft_news_feed'), 'id_notification' => 'left-num-newsfeed', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_newsfeed') ? TRUE : FALSE),
        array('id_option' => 'opt_ml_messages', 'url' => 'messages', 'rel' => 'phantom-all', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-messages', 'icono' => 'i-m-messages.png', 'tag_title' =>  $this->lang('dashboard_mleft_messages'), 'text_option' =>  $this->lang('dashboard_mleft_messages'), 'id_notification' => 'left-num-messages', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_messages') ? TRUE : FALSE),
        array('id_option' => 'opt_ml_albums', 'url' => 'albums', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-albums', 'icono' => 'i-m-albums.png', 'tag_title' =>  $this->lang('dashboard_mleft_albums'), 'text_option' =>  $this->lang('dashboard_mleft_albums'), 'id_notification' => 'left-num-albums', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_albums') ? TRUE : FALSE),
        //array('id_option' => 'opt_ml_myproducts', 'url' => 'products', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-myproducts', 'icono' => 'i-m-myproducts.png', 'tag_title' =>  $this->lang('dashboard_mleft_myproducts'), 'text_option' =>  $this->lang('dashboard_mleft_myproducts'), 'id_notification' => 'left-num-myproducts', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_myproducts') ? TRUE : FALSE),
        array('id_option' => 'opt_ml_myevents', 'url' => 'myevents', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-myevents', 'icono' => 'i-m-myevents.png', 'tag_title' =>  $this->lang('dashboard_mleft_myevents'), 'text_option' =>  $this->lang('dashboard_mleft_myevents'), 'id_notification' => 'left-num-myevents', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_myevents') ? TRUE : FALSE),
        array('id_option' => 'opt_ml_myarticles', 'url' => 'articles', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-myarticles', 'icono' => 'i-m-myarticles.png', 'tag_title' =>  $this->lang('dashboard_mleft_myarticles'), 'text_option' =>  $this->lang('dashboard_mleft_myarticles'), 'id_notification' => 'left-num-myarticles', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_myarticles') ? TRUE : FALSE),
        array('id_option' => 'opt_ml_savedp', 'url' => 'saved', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-savedp', 'icono' => 'i-m-saved.png', 'tag_title' =>  $this->lang('dashboard_mleft_saved_post'), 'text_option' =>  $this->lang('dashboard_mleft_saved_post'), 'id_notification' => 'left-num-savedp', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_savedp') ? TRUE : FALSE),
        array('id_option' => 'opt_ml_directory', 'url' => 'directory', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-opt_ml_directory', 'icono' => 'i-m-directory.png', 'tag_title' =>  $this->lang('dashboard_mleft_directory'), 'text_option' =>  $this->lang('dashboard_mleft_directory'), 'id_notification' => 'left-num-directory', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_directory') ? TRUE : FALSE),
        array('id_option' => 'opt_ml_friendsl', 'url' => $this->user->info->user_username.'/friends', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-friendsl', 'icono' => 'i-m-friends.png', 'tag_title' =>  $this->lang('dashboard_mleft_friends'), 'text_option' =>  $this->lang('dashboard_mleft_friends'), 'id_notification' => 'left-num-friendsl', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_friendsl') ? TRUE : FALSE),
        array('id_option' => 'opt_ml_groupsfeed', 'url' => 'groups/feed', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-groupsfeed', 'icono' => 'i-m-newsgroups.png', 'tag_title' =>  $this->lang('dashboard_mleft_groups_feed'), 'text_option' =>  $this->lang('dashboard_mleft_groups_feed'), 'id_notification' => 'left-num-groupsfeed', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_groupsfeed') ? TRUE : FALSE),
        array('id_option' => 'opt_ml_yourgroups', 'url' => 'groups', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-yourgroups', 'icono' => 'i-m-yourgroups.png', 'tag_title' =>  $this->lang('dashboard_mleft_your_groups'), 'text_option' =>  $this->lang('dashboard_mleft_your_groups'), 'id_notification' => '', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_yourgroups') ? TRUE : FALSE),
        array('id_option' => 'opt_ml_addgroup', 'url' => 'groups/create', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-addgroup', 'icono' => 'i-m-addgroup.png', 'tag_title' =>  $this->lang('dashboard_mleft_create_group'), 'text_option' =>  $this->lang('dashboard_mleft_create_group'), 'id_notification' => '', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_addgroup') ? TRUE : FALSE),
        array('id_option' => 'opt_ml_searchgroups', 'url' => 'groups/search', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-searchgroups', 'icono' => 'i-m-searchgroups.png', 'tag_title' =>  $this->lang('dashboard_mleft_search_groups'), 'text_option' =>  $this->lang('dashboard_mleft_search_groups'), 'id_notification' => '', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_searchgroups') ? TRUE : FALSE),
    
     );

    $D->dashboard_menu_left = $this->designer->createBlockMenuLeft('', $D->the_menu, FALSE);
    /*
    $D->the_menu = array(
    array('id_option' => 'opt_ml_pagesfeed', 'url' => 'pages/feed', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-pages', 'icono' => 'i-m-pages.png', 'tag_title' =>  $this->lang('dashboard_mleft_pages_feed'), 'text_option' =>  $this->lang('dashboard_mleft_pages_feed'), 'id_notification' => 'left-num-pagesfeed', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_pagesfeed') ? TRUE : FALSE),
    array('id_option' => 'opt_ml_yourpages', 'url' => 'pages', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-yourpages', 'icono' => 'i-m-yourpages.png', 'tag_title' =>  $this->lang('dashboard_mleft_your_pages'), 'text_option' =>  $this->lang('dashboard_mleft_your_pages'), 'id_notification' => '', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_yourpages') ? TRUE : FALSE),
    array('id_option' => 'opt_ml_addpage', 'url' => 'pages/create', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-addpage', 'icono' => 'i-m-addpage.png', 'tag_title' =>  $this->lang('dashboard_mleft_create_page'), 'text_option' =>  $this->lang('dashboard_mleft_create_page'), 'id_notification' => '', 'num_notifications' =>  '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_addpage') ? TRUE : FALSE),
    array('id_option' => 'opt_ml_searchpages', 'url' => 'pages/search', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-searchpages', 'icono' => 'i-m-searchpages.png', 'tag_title' =>  $this->lang('dashboard_mleft_search_pages'), 'text_option' =>  $this->lang('dashboard_mleft_search_pages'), 'id_notification' => '', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_searchpages') ? TRUE : FALSE),
     );

    $D->dashboard_menu_left .= $this->designer->createBlockMenuLeft($this->lang('dashboard_mleft_pages_title'), $D->the_menu, FALSE);
    *//*
    $D->the_menu = array(
    array('id_option' => 'opt_ml_groupsfeed', 'url' => 'groups/feed', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-groupsfeed', 'icono' => 'i-m-newsgroups.png', 'tag_title' =>  $this->lang('dashboard_mleft_groups_feed'), 'text_option' =>  $this->lang('dashboard_mleft_groups_feed'), 'id_notification' => 'left-num-groupsfeed', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_groupsfeed') ? TRUE : FALSE),
    array('id_option' => 'opt_ml_yourgroups', 'url' => 'groups', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-yourgroups', 'icono' => 'i-m-yourgroups.png', 'tag_title' =>  $this->lang('dashboard_mleft_your_groups'), 'text_option' =>  $this->lang('dashboard_mleft_your_groups'), 'id_notification' => '', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_yourgroups') ? TRUE : FALSE),
    array('id_option' => 'opt_ml_addgroup', 'url' => 'groups/create', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-addgroup', 'icono' => 'i-m-addgroup.png', 'tag_title' =>  $this->lang('dashboard_mleft_create_group'), 'text_option' =>  $this->lang('dashboard_mleft_create_group'), 'id_notification' => '', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_addgroup') ? TRUE : FALSE),
    array('id_option' => 'opt_ml_searchgroups', 'url' => 'groups/search', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-searchgroups', 'icono' => 'i-m-searchgroups.png', 'tag_title' =>  $this->lang('dashboard_mleft_search_groups'), 'text_option' =>  $this->lang('dashboard_mleft_search_groups'), 'id_notification' => '', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_searchgroups') ? TRUE : FALSE),
     );

    $D->dashboard_menu_left .= $this->designer->createBlockMenuLeft($this->lang('dashboard_mleft_groups_title'), $D->the_menu, FALSE);
	*/
	/*
    $D->the_menu = array(
    array('id_option' => 'opt_ml_games', 'url' => 'games', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-games', 'icono' => 'i-m-games.png', 'tag_title' =>  $this->lang('dashboard_mleft_games'), 'text_option' =>  $this->lang('dashboard_mleft_games'), 'id_notification' => 'left-num-games', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_games') ? TRUE : FALSE),
    array('id_option' => 'opt_ml_marketplace', 'url' => 'marketplace', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-marketplace', 'icono' => 'i-m-marketplace.png', 'tag_title' =>  $this->lang('dashboard_mleft_marketplace'), 'text_option' =>  $this->lang('dashboard_mleft_marketplace'), 'id_notification' => 'left-num-marketplace', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_marketplace') ? TRUE : FALSE),
    array('id_option' => 'opt_ml_events', 'url' => 'events', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-events', 'icono' => 'i-m-events.png', 'tag_title' =>  $this->lang('dashboard_mleft_events'), 'text_option' =>  $this->lang('dashboard_mleft_events'), 'id_notification' => 'left-num-events', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_events') ? TRUE : FALSE),
    array('id_option' => 'opt_ml_library', 'url' => 'library', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-library', 'icono' => 'i-m-library.png', 'tag_title' =>  $this->lang('dashboard_mleft_library'), 'text_option' =>  $this->lang('dashboard_mleft_library'), 'id_notification' => 'left-num-library', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_library') ? TRUE : FALSE),
    array('id_option' => 'opt_ml_directory', 'url' => 'directory', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-opt_ml_directory', 'icono' => 'i-m-directory.png', 'tag_title' =>  $this->lang('dashboard_mleft_directory'), 'text_option' =>  $this->lang('dashboard_mleft_directory'), 'id_notification' => 'left-num-directory', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_directory') ? TRUE : FALSE),
    array('id_option' => 'opt_ml_friendsl', 'url' => $this->user->info->user_username.'/friends', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-friendsl', 'icono' => 'i-m-friends.png', 'tag_title' =>  $this->lang('dashboard_mleft_friends'), 'text_option' =>  $this->lang('dashboard_mleft_friends'), 'id_notification' => 'left-num-friendsl', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_friendsl') ? TRUE : FALSE),

     );
    
    $D->dashboard_menu_left .= $this->designer->createBlockMenuLeft($this->lang('dashboard_mleft_explore_title'), $D->the_menu, FALSE);
    */
    
    /*************************************************************************/
    /*************************************************************************/    
    /* Dashboard Menu Responsive*/

    $the_menu_resp = array(
        array('id_option' => 'opt_ml_newsfeed', 'url' => 'dashboard', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-news', 'icono' => 'i-m-news.png', 'tag_title' =>  $this->lang('dashboard_mleft_news_feed'), 'text_option' =>  $this->lang('dashboard_mleft_news_feed'), 'id_notification' => 'left-num-newsfeed', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_newsfeed') ? TRUE : FALSE),
        array('id_option' => 'opt_ml_messages', 'url' => 'messages', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-messages', 'icono' => 'i-m-messages.png', 'tag_title' =>  $this->lang('dashboard_mleft_messages'), 'text_option' =>  $this->lang('dashboard_mleft_messages'), 'id_notification' => 'left-num-messages', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_messages') ? TRUE : FALSE),
        array('id_option' => 'opt_ml_albums', 'url' => 'albums', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-albums', 'icono' => 'i-m-albums.png', 'tag_title' =>  $this->lang('dashboard_mleft_albums'), 'text_option' =>  $this->lang('dashboard_mleft_albums'), 'id_notification' => 'left-num-albums', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_albums') ? TRUE : FALSE),
        array('id_option' => 'opt_ml_myproducts', 'url' => 'products', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-myproducts', 'icono' => 'i-m-myproducts.png', 'tag_title' =>  $this->lang('dashboard_mleft_myproducts'), 'text_option' =>  $this->lang('dashboard_mleft_myproducts'), 'id_notification' => 'left-num-myproducts', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_myproducts') ? TRUE : FALSE),
        array('id_option' => 'opt_ml_myevents', 'url' => 'myevents', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-myevents', 'icono' => 'i-m-myevents.png', 'tag_title' =>  $this->lang('dashboard_mleft_myevents'), 'text_option' =>  $this->lang('dashboard_mleft_myevents'), 'id_notification' => 'left-num-myevents', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_myevents') ? TRUE : FALSE),
        array('id_option' => 'opt_ml_myarticles', 'url' => 'products', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-myarticles', 'icono' => 'i-m-myarticles.png', 'tag_title' =>  $this->lang('dashboard_mleft_myarticles'), 'text_option' =>  $this->lang('dashboard_mleft_myarticles'), 'id_notification' => 'left-num-myarticles', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_myarticles') ? TRUE : FALSE),
        array('id_option' => 'opt_ml_savedp', 'url' => 'saved', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-savedp', 'icono' => 'i-m-saved.png', 'tag_title' =>  $this->lang('dashboard_mleft_saved_post'), 'text_option' =>  $this->lang('dashboard_mleft_saved_post'), 'id_notification' => 'left-num-savedp', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_savedp') ? TRUE : FALSE),
     );

    $D->dashboard_menu_responsive = $this->designer->createBlockMenuLeft('', $the_menu_resp, FALSE);
    
    $the_menu_resp = array(
    array('id_option' => 'opt_ml_pagesfeed', 'url' => 'pages/feed', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-pages', 'icono' => 'i-m-pages.png', 'tag_title' =>  $this->lang('dashboard_mleft_pages_feed'), 'text_option' =>  $this->lang('dashboard_mleft_pages_feed'), 'id_notification' => 'left-num-pagesfeed', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_pagesfeed') ? TRUE : FALSE),
    array('id_option' => 'opt_ml_yourpages', 'url' => 'pages', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-yourpages', 'icono' => 'i-m-yourpages.png', 'tag_title' =>  $this->lang('dashboard_mleft_your_pages'), 'text_option' =>  $this->lang('dashboard_mleft_your_pages'), 'id_notification' => '', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_yourpages') ? TRUE : FALSE),
    /*array('id_option' => 'opt_ml_addpage', 'url' => 'pages/create', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-addpage', 'icono' => 'i-m-addpage.png', 'tag_title' =>  $this->lang('dashboard_mleft_create_page'), 'text_option' =>  $this->lang('dashboard_mleft_create_page'), 'id_notification' => '', 'num_notifications' =>  '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_addpage') ? TRUE : FALSE),*/
    array('id_option' => 'opt_ml_searchpages', 'url' => 'pages/search', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-searchpages', 'icono' => 'i-m-searchpages.png', 'tag_title' =>  $this->lang('dashboard_mleft_search_pages'), 'text_option' =>  $this->lang('dashboard_mleft_search_pages'), 'id_notification' => '', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_searchpages') ? TRUE : FALSE),
     );

    $D->dashboard_menu_responsive .= $this->designer->createBlockMenuLeft($this->lang('dashboard_mleft_pages_title'), $the_menu_resp, FALSE);
    
    $the_menu_resp = array(
    array('id_option' => 'opt_ml_groupsfeed', 'url' => 'groups/feed', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-groupsfeed', 'icono' => 'i-m-newsgroups.png', 'tag_title' =>  $this->lang('dashboard_mleft_groups_feed'), 'text_option' =>  $this->lang('dashboard_mleft_groups_feed'), 'id_notification' => 'left-num-groupsfeed', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_groupsfeed') ? TRUE : FALSE),
    array('id_option' => 'opt_ml_yourgroups', 'url' => 'groups', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-yourgroups', 'icono' => 'i-m-yourgroups.png', 'tag_title' =>  $this->lang('dashboard_mleft_your_groups'), 'text_option' =>  $this->lang('dashboard_mleft_your_groups'), 'id_notification' => '', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_yourgroups') ? TRUE : FALSE),
    /*array('id_option' => 'opt_ml_addgroup', 'url' => 'groups/create', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-addgroup', 'icono' => 'i-m-addgroup.png', 'tag_title' =>  $this->lang('dashboard_mleft_create_group'), 'text_option' =>  $this->lang('dashboard_mleft_create_group'), 'id_notification' => '', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_addgroup') ? TRUE : FALSE),*/
    array('id_option' => 'opt_ml_searchgroups', 'url' => 'groups/search', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-searchgroups', 'icono' => 'i-m-searchgroups.png', 'tag_title' =>  $this->lang('dashboard_mleft_search_groups'), 'text_option' =>  $this->lang('dashboard_mleft_search_groups'), 'id_notification' => '', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_searchgroups') ? TRUE : FALSE),
     );

    $D->dashboard_menu_responsive .= $this->designer->createBlockMenuLeft($this->lang('dashboard_mleft_groups_title'), $the_menu_resp, FALSE);
	
    $the_menu_resp = array(
    array('id_option' => 'opt_ml_games', 'url' => 'games', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-games', 'icono' => 'i-m-games.png', 'tag_title' =>  $this->lang('dashboard_mleft_games'), 'text_option' =>  $this->lang('dashboard_mleft_games'), 'id_notification' => 'left-num-games', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_games') ? TRUE : FALSE),
    array('id_option' => 'opt_ml_marketplace', 'url' => 'marketplace', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-marketplace', 'icono' => 'i-m-marketplace.png', 'tag_title' =>  $this->lang('dashboard_mleft_marketplace'), 'text_option' =>  $this->lang('dashboard_mleft_marketplace'), 'id_notification' => 'left-num-marketplace', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_marketplace') ? TRUE : FALSE),
    array('id_option' => 'opt_ml_events', 'url' => 'events', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-events', 'icono' => 'i-m-events.png', 'tag_title' =>  $this->lang('dashboard_mleft_events'), 'text_option' =>  $this->lang('dashboard_mleft_events'), 'id_notification' => 'left-num-events', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_events') ? TRUE : FALSE),
    array('id_option' => 'opt_ml_library', 'url' => 'library', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-library', 'icono' => 'i-m-library.png', 'tag_title' =>  $this->lang('dashboard_mleft_library'), 'text_option' =>  $this->lang('dashboard_mleft_library'), 'id_notification' => 'left-num-library', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_library') ? TRUE : FALSE),
    array('id_option' => 'opt_ml_directory', 'url' => 'directory', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-directory', 'icono' => 'i-m-directory.png', 'tag_title' =>  $this->lang('dashboard_mleft_directory'), 'text_option' =>  $this->lang('dashboard_mleft_directory'), 'id_notification' => 'left-num-directory', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_directory') ? TRUE : FALSE),
    array('id_option' => 'opt_ml_friendsl', 'url' => $this->user->info->user_username.'/friends', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'id_icono' => 'icom-friendsl', 'icono' => 'i-m-friends.png', 'tag_title' =>  $this->lang('dashboard_mleft_friends'), 'text_option' =>  $this->lang('dashboard_mleft_friends'), 'id_notification' => 'left-num-friendsl', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_ml_friendsl') ? TRUE : FALSE),
    
     );
    

    $D->dashboard_menu_responsive .= $this->designer->createBlockMenuLeft($this->lang('dashboard_mleft_explore_title'), $the_menu_resp, FALSE);
    
    
    /*************************************************************************/   
    