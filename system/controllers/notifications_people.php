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
	if (!$D->_IS_LOGGED) $this->globalRedirect('login');

    $D->me = $this->user->info;

	$this->loadLanguage('global.php');
	$this->loadLanguage('dashboard.php');
    $this->loadLanguage('activity.php');

    $D->_IN_DASHBOARD = FALSE;
    $D->_WITH_NOTIFIER = TRUE;

	$D->isPhantom = FALSE;
	if ($this->param('phantom') && $this->param('phantom')=='yes') $D->isPhantom = TRUE;

	$D->layout_size = 'min';
	if ($this->param('lysize')) $D->layout_size = $this->param('lysize');

    $D->id_menu = 'opt_ml_newsfeed';

    /****************************************************************************/
    
    $this->load_extract_controller('_pre-dashboard');

    /****************************************************************************/

    $this->db2->query("UPDATE users SET num_notifications_global=0 WHERE iduser=".$this->user->id." LIMIT 1");

    $all_notif = $this->db2->fetch_all('SELECT notifications.id as idnotification, type_notif, iditem_notif, users.code as codeuser, user_username, firstname, lastname, avatar, whendate, result FROM notifications, users WHERE type_notif in (1,5,6) AND users.iduser=from_user AND to_user='.$this->user->id.' ORDER BY notifications.id DESC');

    $D->html_notifications = '';

    $num_notifications = count($all_notif);
    if ($num_notifications > 0) {

        foreach($all_notif as $onenotif) {

            if (empty($onenotif->avatar)) $onenotif->avatar = $K->DEFAULT_AVATAR_USER;
            $base_url = $K->STORAGE_URL_AVATARS.'min2/';
            $D->avatar = $base_url.$onenotif->avatar;
            $D->name = stripslashes($onenotif->firstname).' '.stripslashes($onenotif->lastname);
            $D->name2 = ''; 
            if ($onenotif->avatar != $K->DEFAULT_AVATAR_USER) $D->avatar = $base_url.$onenotif->codeuser.'/'.$onenotif->avatar;

            $D->idnotification = $onenotif->idnotification;
            $D->notif_codeuser = $onenotif->codeuser;
            $D->url_notif = '';
            $D->cadaction = '';
            $D->type_notif = $onenotif->type_notif;
            $D->me_username = $user->info->user_username;
            $D->url_people = $K->SITE_URL.$onenotif->user_username;
            switch ($D->type_notif) {
                case 1:
                    $D->cadaction = $this->lang('dashboard_notif_txt_is_following');
                    break;
                case 5:

                    break;
                case 6:
                    $D->cadaction = $this->lang('dashboard_notif_txt_friend_request_accepted');
                    break;
            }

            $D->html_notifications .= $this->load_template('ones/one-notifications-people.php', FALSE);

        }

    } else {

        $D->html_notifications = $this->load_template('_empty-notifications.php', FALSE);

    }

    /****************************************************************************/

	if ($D->isPhantom) {

        $html = '';

        $this->load_extract_controller('_dashboard-menu-left');
            
		if ($D->layout_size == 'min') {

            $for_load = 'min/notifications-people.php';

		} else {

            $for_load = 'max/notifications-global.php';

		}

        $D->titlePhantom = $this->lang('dashboard_title', array('#SITE_TITLE#'=>$K->SITE_TITLE));

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_dashboard-menu-left');

        $D->page_title = $this->lang('dashboard_title', array('#SITE_TITLE#'=>$K->SITE_TITLE));

        $D->file_in_template = 'max/notifications-people.php';
        $this->load_template('dashboard-template.php');

    }

?>