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
        'title' => $this->lang('admin_menu_title'),
    );
	$D->admin_menu_title = $this->designer->createTitleMenuAdmin($the_title);

    $the_menu = array(
    array('id_option' => 'opt_adm_general', 'url' => 'admin/general', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-general', 'icono' => 'ico-admin-general.png', 'tag_title' =>  $this->lang('admin_menu_general'), 'text_option' =>  $this->lang('admin_menu_general'), 'id_notification' => '', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_general') ? TRUE : FALSE )
     );
    $D->admin_menu_left = $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);

    $the_menu = array(

    array('id_option' => 'opt_adm_users', 'url' => 'admin/users', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-users', 'icono' => 'ico-admin-users.png', 'tag_title' =>  $this->lang('admin_menu_user_list'), 'text_option' =>  $this->lang('admin_menu_user_list'), 'id_notification' => 'left-num-adm-users', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_users') ? TRUE : FALSE ),

    array('id_option' => 'opt_adm_users_inactives', 'url' => 'admin/users/inactive', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-users-inactive', 'icono' => 'ico-admin-user-inactive.png', 'tag_title' =>  $this->lang('admin_menu_users_inactive'), 'text_option' =>  $this->lang('admin_menu_users_inactive'), 'id_notification' => 'left-num-adm-users-inactive', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_users_inactives') ? TRUE : FALSE ),

    array('id_option' => 'opt_adm_users_reqdelete', 'url' => 'admin/users/reqdelete', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-users-reqdelete', 'icono' => 'ico-admin-user-req-del.png', 'tag_title' =>  $this->lang('admin_menu_request_delete'), 'text_option' =>  $this->lang('admin_menu_request_delete'), 'id_notification' => 'left-num-adm-users-reqdelete', 'num_notifications' =>  '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_users_reqdelete') ? TRUE : FALSE ),

    array('id_option' => 'opt_adm_users_admins', 'url' => 'admin/users/admins', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-users-admins', 'icono' => 'ico-admin-users-admin.png', 'tag_title' =>  $this->lang('admin_menu_users_admin'), 'text_option' =>  $this->lang('admin_menu_users_admin'), 'id_notification' => 'left-num-adm-users-admins', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_users_admins') ? TRUE : FALSE )

     );
    $D->admin_menu_left .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);

    $the_menu = array(

    array('id_option' => 'opt_adm_pages', 'url' => 'admin/pages', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-pages', 'icono' => 'ico-admin-pages.png', 'tag_title' =>  $this->lang('admin_menu_pages_created'), 'text_option' =>  $this->lang('admin_menu_pages_created'), 'id_notification' => 'left-num-adm-pages', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_pages') ? TRUE : FALSE ),

    array('id_option' => 'opt_adm_pages_categories', 'url' => 'admin/pages/categories', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-pages-categories', 'icono' => 'ico-admin-pages-categories.png', 'tag_title' =>  $this->lang('admin_menu_pages_categories'), 'text_option' =>  $this->lang('admin_menu_pages_categories'), 'id_notification' => 'left-num-adm-pages-categories', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_pages_categories') ? TRUE : FALSE ),

     );
    $D->admin_menu_left .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);

    $the_menu = array(

    array('id_option' => 'opt_adm_groups', 'url' => 'admin/groups', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-groups', 'icono' => 'ico-admin-groups.png', 'tag_title' =>  $this->lang('admin_menu_groups_created'), 'text_option' =>  $this->lang('admin_menu_groups_created'), 'id_notification' => 'left-num-adm-groups', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_groups') ? TRUE : FALSE ),

     );
    $D->admin_menu_left .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);
    
    $the_menu = array(

    array('id_option' => 'opt_adm_products', 'url' => 'admin/products', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-products', 'icono' => 'ico-admin-products.png', 'tag_title' =>  $this->lang('admin_menu_products_created'), 'text_option' =>  $this->lang('admin_menu_products_created'), 'id_notification' => 'left-num-adm-products', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_products') ? TRUE : FALSE ),

    array('id_option' => 'opt_adm_products_categories', 'url' => 'admin/products/categories', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-products-categories', 'icono' => 'ico-admin-cat-products.png', 'tag_title' =>  $this->lang('admin_menu_products_categories'), 'text_option' =>  $this->lang('admin_menu_products_categories'), 'id_notification' => 'left-num-adm-products-categories', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_products_categories') ? TRUE : FALSE ),

     );
    $D->admin_menu_left .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);
    
    $the_menu = array(

    array('id_option' => 'opt_adm_articles', 'url' => 'admin/articles', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-articles', 'icono' => 'ico-admin-articles.png', 'tag_title' =>  $this->lang('admin_menu_articles_created'), 'text_option' =>  $this->lang('admin_menu_articles_created'), 'id_notification' => 'left-num-adm-articles', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_articles') ? TRUE : FALSE ),

    array('id_option' => 'opt_adm_articles_categories', 'url' => 'admin/articles/categories', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-articles-categories', 'icono' => 'ico-admin-cat-articles.png', 'tag_title' =>  $this->lang('admin_menu_articles_categories'), 'text_option' =>  $this->lang('admin_menu_articles_categories'), 'id_notification' => 'left-num-adm-articles-categories', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_articles_categories') ? TRUE : FALSE ),

     );
    $D->admin_menu_left .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);
    
    $the_menu = array(

    array('id_option' => 'opt_adm_games', 'url' => 'admin/games', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-games', 'icono' => 'ico-admin-games.png', 'tag_title' =>  $this->lang('admin_menu_games'), 'text_option' =>  $this->lang('admin_menu_games'), 'id_notification' => 'left-num-adm-games', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_games') ? TRUE : FALSE ),

     );
    $D->admin_menu_left .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);
    
    $the_menu = array(

    array('id_option' => 'opt_adm_currencies', 'url' => 'admin/currencies', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-currencies', 'icono' => 'ico-admin-currencies.png', 'tag_title' =>  $this->lang('admin_menu_currencies'), 'text_option' =>  $this->lang('admin_menu_currencies'), 'id_notification' => 'left-num-adm-currencies', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_currencies') ? TRUE : FALSE ),

     );
    $D->admin_menu_left .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);
    
    
    $the_menu = array(

    array('id_option' => 'opt_adm_adsdash', 'url' => 'admin/ads/dashboard', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-pages', 'icono' => 'ico-admin-ads-basic-d.png', 'tag_title' =>  $this->lang('admin_menu_ads_dashboard'), 'text_option' =>  $this->lang('admin_menu_ads_dashboard'), 'id_notification' => 'left-num-adm-adsdash', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_adsdash') ? TRUE : FALSE ),
    
    array('id_option' => 'opt_adm_adsprof', 'url' => 'admin/ads/profile', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-pages', 'icono' => 'ico-admin-ads-basic-p.png', 'tag_title' =>  $this->lang('admin_menu_ads_profile'), 'text_option' =>  $this->lang('admin_menu_ads_profile'), 'id_notification' => 'left-num-adm-adsprof', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_adsprof') ? TRUE : FALSE ),

     );
    $D->admin_menu_left .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);    
    
    $the_menu = array(

    array('id_option' => 'opt_adm_app_android', 'url' => 'admin/app-android', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-app_android', 'icono' => 'ico-admin-app-android.png', 'tag_title' =>  $this->lang('admin_menu_app_android'), 'text_option' =>  $this->lang('admin_menu_app_android'), 'id_notification' => 'left-num-adm-app_android', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_app_android') ? TRUE : FALSE ),

     );
    $D->admin_menu_left .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);
    

    $the_menu = array(

    array('id_option' => 'opt_adm_themes', 'url' => 'admin/themes', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-plugins', 'icono' => 'ico-admin-themes.png', 'tag_title' =>  $this->lang('admin_menu_themes'), 'text_option' =>  $this->lang('admin_menu_themes'), 'id_notification' => 'left-num-adm-themes', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_themes') ? TRUE : FALSE ),

     );
    $D->admin_menu_left .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);

    $the_menu = array(

    array('id_option' => 'opt_adm_lang', 'url' => 'admin/languages', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-lang', 'icono' => 'ico-admin-languages.png', 'tag_title' =>  $this->lang('admin_menu_languages'), 'text_option' =>  $this->lang('admin_menu_languages'), 'id_notification' => 'left-num-adm-lang', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_lang') ? TRUE : FALSE ),

     );
    $D->admin_menu_left .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);
    
    $the_menu = array(

    array('id_option' => 'opt_adm_timez', 'url' => 'admin/timezone', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-timez', 'icono' => 'ico-admin-timezone.png', 'tag_title' =>  $this->lang('admin_menu_timezone'), 'text_option' =>  $this->lang('admin_menu_timezone'), 'id_notification' => 'left-num-adm-timez', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_timez') ? TRUE : FALSE ),

     );
    $D->admin_menu_left .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);

    $the_menu = array(

    array('id_option' => 'opt_adm_staticpages', 'url' => 'admin/static-pages', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-staticpages', 'icono' => 'ico-admin-static-pages.png', 'tag_title' =>  $this->lang('admin_menu_static_pages'), 'text_option' =>  $this->lang('admin_menu_static_pages'), 'id_notification' => 'left-num-adm-staticpages', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_staticpages') ? TRUE : FALSE ),

     );
    $D->admin_menu_left .= $this->designer->createBlockMenuLeftAdmin($the_menu, FALSE);


    /*************************************************************************/    
    /* Admin Menu Responsive*/

    $the_menu = array(
    array('id_option' => 'opt_adm_general', 'url' => 'admin/general', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-general', 'icono' => 'ico-admin-general.png', 'tag_title' =>  $this->lang('admin_menu_general'), 'text_option' =>  $this->lang('admin_menu_general'), 'id_notification' => '', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_general') ? TRUE : FALSE )
     );
    $D->admin_menu_responsive = $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);

    $the_menu = array(

    array('id_option' => 'opt_adm_users', 'url' => 'admin/users', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-users', 'icono' => 'ico-admin-users.png', 'tag_title' =>  $this->lang('admin_menu_user_list'), 'text_option' =>  $this->lang('admin_menu_user_list'), 'id_notification' => 'left-num-adm-users', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_users') ? TRUE : FALSE ),

    array('id_option' => 'opt_adm_users_inactives', 'url' => 'admin/users/inactive', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-users-inactive', 'icono' => 'ico-admin-user-inactive.png', 'tag_title' =>  $this->lang('admin_menu_users_inactive'), 'text_option' =>  $this->lang('admin_menu_users_inactive'), 'id_notification' => 'left-num-adm-users-inactive', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_users_inactives') ? TRUE : FALSE ),

    array('id_option' => 'opt_adm_users_reqdelete', 'url' => 'admin/users/reqdelete', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-users-reqdelete', 'icono' => 'ico-admin-user-req-del.png', 'tag_title' =>  $this->lang('admin_menu_request_delete'), 'text_option' =>  $this->lang('admin_menu_request_delete'), 'id_notification' => 'left-num-adm-users-reqdelete', 'num_notifications' =>  '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_users_reqdelete') ? TRUE : FALSE ),

    array('id_option' => 'opt_adm_users_admins', 'url' => 'admin/users/admins', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-users-admins', 'icono' => 'ico-admin-users-admin.png', 'tag_title' =>  $this->lang('admin_menu_users_admin'), 'text_option' =>  $this->lang('admin_menu_users_admin'), 'id_notification' => 'left-num-adm-users-admins', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_users_admins') ? TRUE : FALSE )

     );
    $D->admin_menu_responsive .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);

    $the_menu = array(

    array('id_option' => 'opt_adm_pages', 'url' => 'admin/pages', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-pages', 'icono' => 'ico-admin-pages.png', 'tag_title' =>  $this->lang('admin_menu_pages_created'), 'text_option' =>  $this->lang('admin_menu_pages_created'), 'id_notification' => 'left-num-adm-pages', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_pages') ? TRUE : FALSE ),

    array('id_option' => 'opt_adm_pages_categories', 'url' => 'admin/pages/categories', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-pages-categories', 'icono' => 'ico-admin-pages-categories.png', 'tag_title' =>  $this->lang('admin_menu_pages_categories'), 'text_option' =>  $this->lang('admin_menu_pages_categories'), 'id_notification' => 'left-num-adm-pages-categories', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_pages_categories') ? TRUE : FALSE ),

     );
    $D->admin_menu_responsive .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);

    $the_menu = array(

    array('id_option' => 'opt_adm_groups', 'url' => 'admin/groups', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-groups', 'icono' => 'ico-admin-groups.png', 'tag_title' =>  $this->lang('admin_menu_groups_created'), 'text_option' =>  $this->lang('admin_menu_groups_created'), 'id_notification' => 'left-num-adm-groups', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_groups') ? TRUE : FALSE ),

     );
    $D->admin_menu_responsive .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);
    
    $the_menu = array(

    array('id_option' => 'opt_adm_products', 'url' => 'admin/products', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-products', 'icono' => 'ico-admin-products.png', 'tag_title' =>  $this->lang('admin_menu_products_created'), 'text_option' =>  $this->lang('admin_menu_products_created'), 'id_notification' => 'left-num-adm-products', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_products') ? TRUE : FALSE ),

    array('id_option' => 'opt_adm_products_categories', 'url' => 'admin/products/categories', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-products-categories', 'icono' => 'ico-admin-cat-products.png', 'tag_title' =>  $this->lang('admin_menu_products_categories'), 'text_option' =>  $this->lang('admin_menu_products_categories'), 'id_notification' => 'left-num-adm-products-categories', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_products_categories') ? TRUE : FALSE ),

     );
    $D->admin_menu_responsive .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);
    
    $the_menu = array(

    array('id_option' => 'opt_adm_articles', 'url' => 'admin/articles', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-articles', 'icono' => 'ico-admin-articles.png', 'tag_title' =>  $this->lang('admin_menu_articles_created'), 'text_option' =>  $this->lang('admin_menu_articles_created'), 'id_notification' => 'left-num-adm-articles', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_articles') ? TRUE : FALSE ),

    array('id_option' => 'opt_adm_articles_categories', 'url' => 'admin/articles/categories', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-articles-categories', 'icono' => 'ico-admin-cat-articles.png', 'tag_title' =>  $this->lang('admin_menu_articles_categories'), 'text_option' =>  $this->lang('admin_menu_articles_categories'), 'id_notification' => 'left-num-adm-articles-categories', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_articles_categories') ? TRUE : FALSE ),

     );
    $D->admin_menu_responsive .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);
    
    $the_menu = array(

    array('id_option' => 'opt_adm_games', 'url' => 'admin/games', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-games', 'icono' => 'ico-admin-games.png', 'tag_title' =>  $this->lang('admin_menu_games'), 'text_option' =>  $this->lang('admin_menu_games'), 'id_notification' => 'left-num-adm-games', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_games') ? TRUE : FALSE ),

     );
    $D->admin_menu_responsive .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);
    
    $the_menu = array(

    array('id_option' => 'opt_adm_currencies', 'url' => 'admin/currencies', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-currencies', 'icono' => 'ico-admin-currencies.png', 'tag_title' =>  $this->lang('admin_menu_currencies'), 'text_option' =>  $this->lang('admin_menu_currencies'), 'id_notification' => 'left-num-adm-currencies', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_currencies') ? TRUE : FALSE ),

     );
    $D->admin_menu_responsive .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);
    
    $the_menu = array(

    array('id_option' => 'opt_adm_adsdash', 'url' => 'admin/ads/dashboard', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-pages', 'icono' => 'ico-admin-ads-basic-d.png', 'tag_title' =>  $this->lang('admin_menu_ads_dashboard'), 'text_option' =>  $this->lang('admin_menu_ads_dashboard'), 'id_notification' => 'left-num-adm-adsdash', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_adsdash') ? TRUE : FALSE ),

    array('id_option' => 'opt_adm_adsprof', 'url' => 'admin/ads/dashboard', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-pages', 'icono' => 'ico-admin-ads-basic-p.png', 'tag_title' =>  $this->lang('admin_menu_ads_profile'), 'text_option' =>  $this->lang('admin_menu_ads_profile'), 'id_notification' => 'left-num-adm-adsprof', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_adsprof') ? TRUE : FALSE ),

     );
    $D->admin_menu_responsive .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);
    
    $the_menu = array(

    array('id_option' => 'opt_adm_app_android', 'url' => 'admin/app-android', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-app_android', 'icono' => 'ico-admin-app-android.png', 'tag_title' =>  $this->lang('admin_menu_app_android'), 'text_option' =>  $this->lang('admin_menu_app_android'), 'id_notification' => 'left-num-adm-app_android', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_app-android') ? TRUE : FALSE ),

     );
    $D->admin_menu_responsive .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);

    $the_menu = array(

    array('id_option' => 'opt_adm_themes', 'url' => 'admin/themes', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-plugins', 'icono' => 'ico-admin-themes.png', 'tag_title' =>  $this->lang('admin_menu_themes'), 'text_option' =>  $this->lang('admin_menu_themes'), 'id_notification' => 'left-num-adm-themes', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_themes') ? TRUE : FALSE ),

     );
    $D->admin_menu_responsive .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);
    
    $the_menu = array(

    array('id_option' => 'opt_adm_lang', 'url' => 'admin/languages', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-lang', 'icono' => 'ico-admin-languages.png', 'tag_title' =>  $this->lang('admin_menu_languages'), 'text_option' =>  $this->lang('admin_menu_languages'), 'id_notification' => 'left-num-adm-lang', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_lang') ? TRUE : FALSE ),

     );
    $D->admin_menu_responsive .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);
    
    $the_menu = array(

    array('id_option' => 'opt_adm_timez', 'url' => 'admin/timezone', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-timez', 'icono' => 'ico-admin-languages.png', 'tag_title' =>  $this->lang('admin_menu_timezone'), 'text_option' =>  $this->lang('admin_menu_timezone'), 'id_notification' => 'left-num-adm-timez', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_lang') ? TRUE : FALSE ),

     );
    $D->admin_menu_responsive .= $this->designer->createBlockMenuLeftAdmin($the_menu, TRUE);
    

    $the_menu = array(

    array('id_option' => 'opt_adm_staticpages', 'url' => 'admin/static-pages', 'rel' => 'phantom', 'target' => 'dashboard-main-area-right', 'id_icono' => 'icom-adm-staticpages', 'icono' => 'ico-admin-static-pages.png', 'tag_title' =>  $this->lang('admin_menu_static_pages'), 'text_option' =>  $this->lang('admin_menu_static_pages'), 'id_notification' => 'left-num-adm-staticpages', 'num_notifications' => '', 'active' => (isset($D->id_menu) && $D->id_menu == 'opt_adm_staticpages') ? TRUE : FALSE ),

     );
    $D->admin_menu_responsive .= $this->designer->createBlockMenuLeftAdmin($the_menu, FALSE);


?>