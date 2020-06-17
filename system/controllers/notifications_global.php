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

    $all_notif = $this->db2->fetch_all('SELECT type_notif, iditem_notif, users.code as codeuser, user_username, firstname, lastname, avatar, whendate, result FROM notifications, users WHERE type_notif not in (1,4,5,6) AND users.iduser=from_user AND to_user='.$this->user->id.' ORDER BY whendate DESC');

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

            $D->thedate = '<span class="thelivestamp" data-locale="'.$K->LANGUAGE.'" data-livestamp="'.$onenotif->whendate.'"></span>';

            $D->url_notif = '';
            $D->cadaction = '';
            $D->type_notif = $onenotif->type_notif;
            $D->me_username = $this->user->info->user_username;
            switch ($D->type_notif) {
                case 2:
                    $D->codepost = $this->db2->fetch_field('SELECT code FROM posts WHERE idpost='.$onenotif->iditem_notif.' LIMIT 1');
                    $D->url_notif = $K->SITE_URL.$D->me_username.'/post/'.$D->codepost;
                    $D->cadaction = $this->lang('dashboard_notif_txt_like_post');
                    break;
                case 3:
                    $D->codepost = $this->db2->fetch_field('SELECT code FROM posts WHERE idpost='.$onenotif->iditem_notif.' LIMIT 1');
                    $D->url_notif = $K->SITE_URL.$D->me_username.'/post/'.$D->codepost;
                    $D->cadaction = $this->lang('dashboard_notif_txt_comment_post');
                    break;
                case 7:
                    $D->codepost = $this->db2->fetch_field('SELECT code FROM posts WHERE idpost='.$onenotif->iditem_notif.' LIMIT 1');
                    $D->url_notif = $K->SITE_URL.$D->me_username.'/post/'.$D->codepost;
                    $D->cadaction = $this->lang('dashboard_notif_txt_share_post');
                    break;
                case 8:
                    $D->codepost = $this->db2->fetch_field('SELECT code FROM posts WHERE idpost='.$onenotif->iditem_notif.' LIMIT 1');
                    $D->url_notif = $K->SITE_URL.$D->me_username.'/post/'.$D->codepost;
                    $D->cadaction = $this->lang('dashboard_notif_txt_write_wall');
                    break;
                case 9:
                    $thepage = $this->db2->fetch('SELECT puname, title FROM pages WHERE idpage='.$onenotif->iditem_notif.' LIMIT 1');
                    $D->urlpage = $thepage->puname;
                    $D->name2 = stripslashes($thepage->title);
                    $D->url_notif = $K->SITE_URL.$D->urlpage;
                    $D->cadaction = $this->lang('dashboard_notif_txt_like_page');
                    break;
                case 10:
                    $thegroup = $this->db2->fetch('SELECT guname, title FROM groups WHERE idgroup='.$onenotif->iditem_notif.' LIMIT 1');
                    $D->urlgroup = $thegroup->guname;
                    $D->name2 = stripslashes($thegroup->title);
                    $D->url_notif = $K->SITE_URL.$D->urlgroup.'/requests';
                    $D->cadaction = $this->lang('dashboard_notif_txt_join_group');
                    break;
                case 11:
                    $thegroup = $this->db2->fetch('SELECT guname, title FROM groups WHERE idgroup='.$onenotif->iditem_notif.' LIMIT 1');
                    $D->urlgroup = $thegroup->guname;
                    $D->name2 = stripslashes($thegroup->title);
                    $D->url_notif = $K->SITE_URL.$D->urlgroup;
                    $D->cadaction = $this->lang('dashboard_notif_txt_accepted_request');
                    break;
                case 12:
                    $D->urlgroup = $thegroup->guname;
                    $D->name2 = stripslashes($thegroup->title);
                    $D->url_notif = $K->SITE_URL.$D->urlgroup;
                    $D->cadaction = $this->lang('dashboard_notif_txt_add_group');
                    break;
                case 13:
                    $D->cadaction = $this->lang('dashboard_notif_txt_like_comment');
                    break;
                case 14:
                    $themedia = $this->db2->fetch('SELECT * FROM medias WHERE idmedia='.$onenotif->iditem_notif.' LIMIT 1');
                    if ($themedia->type_writer == 0) {
                        $D->username_writer = $this->db2->fetch_field('SELECT user_username FROM users WHERE iduser='.$themedia->idwriter.' LIMIT 1');
                    } else {
                        $D->username_writer = $this->db2->fetch_field('SELECT puname FROM pages WHERE idpage='.$themedia->idwriter.' LIMIT 1');
                    }

                    $D->url_notif = $K->SITE_URL.$D->username_writer.'/photo/'.$themedia->code;
                    
                    if ($themedia->posted_in == 2) {
                        $the_codepost = $this->db2->fetch_field("SELECT code FROM posts WHERE idpost=".$themedia->idcontainer." LIMIT 1");
                        $D->url_notif = $K->SITE_URL.$D->username_writer.'/post/'.$the_codepost;
                    }
                    
                    $D->cadaction = $this->lang('dashboard_notif_txt_like_photo');
                    break;
                case 15:
                    $themedia = $this->db2->fetch('SELECT * FROM medias WHERE idmedia='.$onenotif->iditem_notif.' LIMIT 1');
                    if ($themedia->type_writer == 0) {
                        $D->username_writer = $this->db2->fetch_field('SELECT user_username FROM users WHERE iduser='.$themedia->idwriter.' LIMIT 1');
                    } else {
                        $D->username_writer = $this->db2->fetch_field('SELECT puname FROM pages WHERE idpage='.$themedia->idwriter.' LIMIT 1');
                    }
                    $D->url_notif = $K->SITE_URL.$D->username_writer.'/photo/'.$themedia->code;
                    
                    if ($themedia->posted_in == 2) {
                        $the_codepost = $this->db2->fetch_field("SELECT code FROM posts WHERE idpost=".$themedia->idcontainer." LIMIT 1");
                        $D->url_notif = $K->SITE_URL.$D->username_writer.'/post/'.$the_codepost;
                    }
                    
                    $D->cadaction = $this->lang('dashboard_notif_txt_comment_photo');
                    break;
            }

            $D->html_notifications .= $this->load_template('ones/one-notifications-global.php', FALSE);

        }

    } else {
        $D->html_notifications = $this->load_template('_empty-notifications.php', FALSE);
    }

    /****************************************************************************/

	if ($D->isPhantom) {

        $html = '';

        $this->load_extract_controller('_dashboard-menu-left');

		if ($D->layout_size == 'min') {

            $for_load = 'min/notifications-global.php';

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

        $D->file_in_template = 'max/notifications-global.php';
        $this->load_template('dashboard-template.php');

    }

?>