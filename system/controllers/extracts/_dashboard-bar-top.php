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

    $D->html_logo = $this->designer->loadLogo();

    $the_username = $this->user->info->user_username;
    
    $D->the_menu_top = array(
        array('id_option' => 'ico-dashboard', 'url' => 'dashboard', 'rel' => 'phantom-max', 'target' => 'dashboard-main-area', 'icono' => 'top-dashboard.png', 'tag_title' =>  ''),
        array('id_option' => 'ico-not-people', 'url' => '', 'rel' => '', 'target' => '', 'icono' => 'top-notifications-people.png', 'tag_title' =>  '', 'id_notification' => 'num_notif_people',  'value_notification' => ''),
        array('id_option' => 'ico-not-message', 'url' => '', 'rel' => '', 'target' => '', 'icono' => 'top-notifications-message.png', 'tag_title' => '', 'id_notification' => 'num_notif_message',  'value_notification' => ''),
        array('id_option' => 'ico-not-global', 'url' => '', 'rel' => '', 'target' => '', 'icono' => 'top-notifications.png', 'tag_title' =>  '', 'id_notification' => 'num_notif_global',  'value_notification' => ''),
        array('id_option' => 'ico-search-top', 'url' => 'search', 'rel' => 'phantom-all', 'target' => 'dashboard-main-area', 'icono' => 'top-ico-search.png', 'tag_title' =>  ''),
        array('id_option' => 'ico-more', 'url' => '', 'rel' => '', 'target' => '', 'icono' => 'top-more-options.png', 'tag_title' =>  ''),
     );
    
    $D->html_menu_top = $this->designer->createBlockMenuTop($D->the_menu_top, TRUE);
    
    $D->the_menu_more = array(
        array('id_option' => 'more_configuration', 'url' => $the_username, 'rel' => 'phantom-all', 'target' => 'dashboard-main-area', 'text_option' =>  $this->lang('dashboard_menu_more_profile')),
        
        array('id_option' => 'more_configuration', 'url' => 'settings/account', 'rel' => 'phantom-all', 'target' => 'dashboard-main-area', 'text_option' =>  $this->lang('dashboard_menu_more_configuration')),
    );
    
    if ($K->SHOW_APP_ANDROID) {
        if (!empty($K->FILE_APP_ANDROID) ) {
            $the_file = $K->STORAGE_DIR_APPS.$K->FILE_APP_ANDROID;
            if (file_exists($the_file)) {
                $D->the_menu_more[] = array('id_option' => 'more_download_apk', 'url' => $K->STORAGE_FOLDER_APPS.$K->FILE_APP_ANDROID, 'rel' => '', 'target' => '_blank', 'text_option' =>  $this->lang('dashboard_menu_more_download_apk'));
            }            
        }
    }
    
    if ($D->_IS_ADMIN_USER) {
        $D->the_menu_more[] = array('id_option' => 'more_admin', 'url' => 'admin/general', 'rel' => 'phantom-all', 'target' => 'dashboard-main-area', 'text_option' =>  $this->lang('dashboard_menu_more_admin'));
    }
    
    $D->html_menu_more = $this->designer->createMenuMore($D->the_menu_more);
    $D->html_menu_more .= '<a href="'.$K->SITE_URL.'logout"><div class="optionsMenu">'.$this->lang('dashboard_menu_more_logout').'</div></a>';
