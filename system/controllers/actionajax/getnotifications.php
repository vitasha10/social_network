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

    global $K, $D;

    $user = & $GLOBALS['user'];
    $page = & $GLOBALS['page'];
    
    $page->loadLanguage('dashboard.php');

    if (!$user->is_logged) { 
        echo('ERROR:'.$page->lang('global_txt_no_session'));
        return;
    }
    
    $the_sanitaze = new sanitize(); // init sanitaze

    $error = FALSE;

    if ($ajax_action == 1) { }
    if ($ajax_action == 2) { }
    if ($ajax_action == 3) { }
    
    if (!$error) {

        if ($ajax_action == 'people') {
            $page->db2->query("UPDATE users SET num_notifications_people=0 WHERE iduser=".$user->info->iduser." LIMIT 1");

            $all_notif = $page->db2->fetch_all('SELECT notifications.id as idnotification, type_notif, iditem_notif, users.code as codeuser, user_username, firstname, lastname, avatar, whendate, result FROM notifications, users WHERE type_notif in (1,5,6) AND users.iduser=from_user AND to_user='.$user->info->iduser.' ORDER BY notifications.id DESC LIMIT '.$K->NUM_NOTIFICATIONS_TOP);

            $html_notifications = '';
            
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
                            $D->cadaction = $page->lang('dashboard_notif_txt_is_following');
                            break;
                        case 5:
                            
                            break;
                        case 6:
                            $D->cadaction = $page->lang('dashboard_notif_txt_friend_request_accepted');
                            break;
                    }
                    
                    
                    $html_notifications .= $page->load_template('ones/one-notifications-people.php', FALSE);
                }
                
            } else {
                $html_notifications = $page->load_template('_empty-notifications.php', FALSE);
            }

            $json_result = array('html_notifications'=>$html_notifications, 'num_notifications'=>$num_notifications);            
            echo(json_encode($json_result));
            return;

        }

        if ($ajax_action == 'messages') {
            $page->db2->query("UPDATE users SET num_notifications_messages=0 WHERE iduser=".$user->info->iduser." LIMIT 1");
            
            $all_notif = $page->db2->fetch_all("SELECT talks.idtalk FROM talks INNER JOIN talks_messages ON talks.idlastmessage = talks_messages.idmessage INNER JOIN talks_users ON talks.idtalk = talks_users.idtalk WHERE talks_users.deleted = '0' AND talks_users.iduser = ".$user->id." ORDER BY talks_messages.whendate DESC LIMIT 0, ".$K->NUM_NOTIFICATIONS_TOP);

            $html_notifications = '';
            
            $num_notifications = count($all_notif);
            if ($num_notifications > 0) {
                
                foreach($all_notif as $onenotif) {
                    
                    $oneconversation = $page->db2->fetch("SELECT talks.idtalk, talks.idlastmessage, talks_messages.message, talks_messages.iduser, talks_messages.typemessage, talks_messages.whendate, talks_users.viewed FROM talks INNER JOIN talks_messages ON talks.idlastmessage = talks_messages.idmessage INNER JOIN talks_users ON talks.idtalk = talks_users.idtalk WHERE talks_users.deleted=0 AND talks_users.iduser=".$user->id." AND talks.idtalk=".$onenotif->idtalk);
                    
                    $theuser = $page->db2->fetch("SELECT users.code, users.iduser, users.firstname, users.lastname, users.user_username, users.avatar FROM talks_users INNER JOIN users ON talks_users.iduser=users.iduser WHERE talks_users.idtalk=".$oneconversation->idtalk." AND talks_users.iduser<>".$user->id);

                    $D->mess_user_code = $theuser->code;
                    $D->mess_user_username = $theuser->user_username;

                    if (empty($theuser->avatar)) $theuser->avatar = $K->DEFAULT_AVATAR_USER;
                    $base_url = $K->STORAGE_URL_AVATARS.'min2/';
                    $D->avatar = $base_url.$theuser->avatar;
                    $D->name = stripslashes($theuser->firstname).' '.stripslashes($theuser->lastname);
                    if ($theuser->avatar != $K->DEFAULT_AVATAR_USER) $D->avatar = $base_url.$D->mess_user_code.'/'.$theuser->avatar;

                    $D->idnotification = $oneconversation->idtalk;
                    
                    if ($oneconversation->typemessage == 1) $D->the_message = analyzeMessageChat(str_cut($oneconversation->message,40));
                    if ($oneconversation->typemessage == 2) {
                        if ($oneconversation->iduser == $user->info->iduser) $D->the_message = $page->lang('dashboard_messages_txt_you_send_photo');
                        else $D->the_message = $page->lang('dashboard_messages_txt_send_you_photo');
                        
                        $D->the_message = '<span style="font-style:italic;">'.$D->the_message.'</span>';
                    }
                    if ($oneconversation->typemessage == 3) {
                        if ($oneconversation->iduser == $user->info->iduser) $D->the_message = $page->lang('dashboard_messages_txt_you_send_file');
                        else $D->the_message = $page->lang('dashboard_messages_txt_send_you_file');
                        
                        $D->the_message = '<span style="font-style:italic;">'.$D->the_message.'</span>';
                    }
                    if ($oneconversation->typemessage == 4) {
                        if ($oneconversation->iduser == $user->info->iduser) $D->the_message = $page->lang('dashboard_messages_txt_you_send_sticker');
                        else $D->the_message = $page->lang('dashboard_messages_txt_send_you_sticker');
                        
                        $D->the_message = '<span style="font-style:italic;">'.$D->the_message.'</span>';
                    }
                    
                    $D->thedate = '<span class="thelivestamp" data-locale="'.$K->LANGUAGE.'" data-livestamp="'.$oneconversation->whendate.'"></span>';

                    $html_notifications .= $page->load_template('ones/one-notifications-message.php', FALSE);

                }

            } else {
                $html_notifications = $page->load_template('_empty-notifications.php', FALSE);
            }

            $json_result = array('htmlmessages'=>$html_notifications);            
            echo(json_encode($json_result));
            return;         

        }

        if ($ajax_action == 'global') {
            $page->db2->query("UPDATE users SET num_notifications_global=0 WHERE iduser=".$user->info->iduser." LIMIT 1");

            $all_notif = $page->db2->fetch_all('SELECT type_notif, iditem_notif, users.code as codeuser, user_username, firstname, lastname, avatar, whendate, result FROM notifications, users WHERE type_notif not in (1,4,5,6) AND users.iduser=from_user AND to_user='.$user->info->iduser.' ORDER BY whendate DESC LIMIT '.$K->NUM_NOTIFICATIONS_TOP);
            
            $html_notifications = '';
            
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
                    $D->me_username = $user->info->user_username;
                    switch ($D->type_notif) {
                        case 2:
                            $D->codepost = $page->db2->fetch_field('SELECT code FROM posts WHERE idpost='.$onenotif->iditem_notif.' LIMIT 1');
                            $D->url_notif = $K->SITE_URL.$D->me_username.'/post/'.$D->codepost;
                            $D->cadaction = $page->lang('dashboard_notif_txt_like_post');
                            break;
                        case 3:
                            $D->codepost = $page->db2->fetch_field('SELECT code FROM posts WHERE idpost='.$onenotif->iditem_notif.' LIMIT 1');
                            $D->url_notif = $K->SITE_URL.$D->me_username.'/post/'.$D->codepost;
                            $D->cadaction = $page->lang('dashboard_notif_txt_comment_post');
                            break;
                        case 7:
                            $D->codepost = $page->db2->fetch_field('SELECT code FROM posts WHERE idpost='.$onenotif->iditem_notif.' LIMIT 1');
                            $D->url_notif = $K->SITE_URL.$D->me_username.'/post/'.$D->codepost;
                            $D->cadaction = $page->lang('dashboard_notif_txt_share_post');
                            break;
                        case 8:
                            $D->codepost = $page->db2->fetch_field('SELECT code FROM posts WHERE idpost='.$onenotif->iditem_notif.' LIMIT 1');
                            $D->url_notif = $K->SITE_URL.$D->me_username.'/post/'.$D->codepost;
                            $D->cadaction = $page->lang('dashboard_notif_txt_write_wall');
                            break;
                        case 9:
                            $thepage = $page->db2->fetch('SELECT puname, title FROM pages WHERE idpage='.$onenotif->iditem_notif.' LIMIT 1');
                            $D->urlpage = $thepage->puname;
                            $D->name2 = stripslashes($thepage->title);
                            $D->url_notif = $K->SITE_URL.$D->urlpage;
                            $D->cadaction = $page->lang('dashboard_notif_txt_like_page');
                            break;
                        case 10:
                            $thegroup = $page->db2->fetch('SELECT guname, title FROM groups WHERE idgroup='.$onenotif->iditem_notif.' LIMIT 1');
                            $D->urlgroup = $thegroup->guname;
                            $D->name2 = stripslashes($thegroup->title);
                            $D->url_notif = $K->SITE_URL.$D->urlgroup.'/requests';
                            $D->cadaction = $page->lang('dashboard_notif_txt_join_group');
                            break;
                        case 11:
                            $thegroup = $page->db2->fetch('SELECT guname, title FROM groups WHERE idgroup='.$onenotif->iditem_notif.' LIMIT 1');
                            $D->urlgroup = $thegroup->guname;
                            $D->name2 = stripslashes($thegroup->title);
                            $D->url_notif = $K->SITE_URL.$D->urlgroup;
                            $D->cadaction = $page->lang('dashboard_notif_txt_accepted_request');
                            break;
                        case 12:
                            $thegroup = $page->db2->fetch('SELECT guname, title FROM groups WHERE idgroup='.$onenotif->iditem_notif.' LIMIT 1');
                            $D->urlgroup = $thegroup->guname;
                            $D->name2 = stripslashes($thegroup->title);
                            $D->url_notif = $K->SITE_URL.$D->urlgroup;
                            $D->cadaction = $page->lang('dashboard_notif_txt_add_group');
                            break;
                        case 13:
                            $D->cadaction = $page->lang('dashboard_notif_txt_like_comment');
                            break;
                        case 14:
                            $themedia = $page->db2->fetch('SELECT * FROM medias WHERE idmedia='.$onenotif->iditem_notif.' LIMIT 1');
                            if ($themedia->type_writer == 0) {
                                $D->username_writer = $page->db2->fetch_field('SELECT user_username FROM users WHERE iduser='.$themedia->idwriter.' LIMIT 1');
                            } else {
                                $D->username_writer = $page->db2->fetch_field('SELECT puname FROM pages WHERE idpage='.$themedia->idwriter.' LIMIT 1');
                            }
                            $D->url_notif = $K->SITE_URL.$D->username_writer.'/photo/'.$themedia->code;
                            
                            if ($themedia->posted_in == 2) {
                                $the_codepost = $page->db2->fetch_field("SELECT code FROM posts WHERE idpost=".$themedia->idcontainer." LIMIT 1");
                                $D->url_notif = $K->SITE_URL.$D->username_writer.'/post/'.$the_codepost;
                            }
                            
                            $D->cadaction = $page->lang('dashboard_notif_txt_like_photo');
                            break;
                        case 15:
                            $themedia = $page->db2->fetch('SELECT * FROM medias WHERE idmedia='.$onenotif->iditem_notif.' LIMIT 1');
                            if ($themedia->type_writer == 0) {
                                $D->username_writer = $page->db2->fetch_field('SELECT user_username FROM users WHERE iduser='.$themedia->idwriter.' LIMIT 1');
                            } else {
                                $D->username_writer = $page->db2->fetch_field('SELECT puname FROM pages WHERE idpage='.$themedia->idwriter.' LIMIT 1');
                            }
                            
                            $D->url_notif = $K->SITE_URL.$D->username_writer.'/photo/'.$themedia->code;
                            
                            if ($themedia->posted_in == 2) {
                                $the_codepost = $page->db2->fetch_field("SELECT code FROM posts WHERE idpost=".$themedia->idcontainer." LIMIT 1");
                                $D->url_notif = $K->SITE_URL.$D->username_writer.'/post/'.$the_codepost;
                            }
                            
                            $D->cadaction = $page->lang('dashboard_notif_txt_comment_photo');
                            break;
                    }                    
                    
                    $html_notifications .= $page->load_template('ones/one-notifications-global.php', FALSE);
                }
                
            } else {
                $html_notifications = $page->load_template('_empty-notifications.php', FALSE);
            }

            $json_result = array('html_notifications'=>$html_notifications, 'num_notifications'=>$num_notifications);
            echo(json_encode($json_result));
            return;         

        }
    }
?>