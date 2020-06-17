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

    global $D, $K;

    $user = & $GLOBALS['user'];
    $page = & $GLOBALS['page'];
    $network = & $GLOBALS['network'];
    
    $page->loadLanguage('global.php');
    $page->loadLanguage('dashboard.php');

    if (!$user->is_logged) {
        echo('ERROR:'.$page->lang('global_txt_no_session'));
        return;
    }

    $the_sanitaze = new sanitize(); // init sanitaze

    $error = FALSE;

    if ($ajax_action == 'searchfriendschat' || $ajax_action == 'searchfriendschat2') {
        $thequery = isset($_POST['qry']) ? (trim($_POST['qry'])) : '';

    	if (!$error && empty($thequery)) { $error = TRUE; $txterror .= 'Error. '; }
    }
    
    if ($error) {
        die();
    } else {

        if ($ajax_action == 'searchfriendschat') {
            
            $html_userchatonline = '';
            
            $sql_theblockeds = 'SELECT iduserblocked FROM users_blocked WHERE iduser='.$user->info->iduser;

            if ($K->SIDEBAR_USERS == 1) {
                $page->db2->query('SELECT code, avatar, user_username, lastname, firstname, lastclick FROM users, friends WHERE active=1 AND chat=1 AND accepted_date<>0 AND (firstname like "%'.$thequery.'%" OR lastname like "%'.$thequery.'%") AND ( (friend1=iduser AND friend2='.$user->info->iduser.') OR (friend2=iduser AND friend1='.$user->info->iduser.') ) AND ((friend1 NOT IN ('.$sql_theblockeds.')) AND (friend2 NOT IN ('.$sql_theblockeds.'))) ORDER BY lastclick DESC LIMIT 15');
            } else {
                $page->db2->query('SELECT code, avatar, user_username, lastname, firstname, lastclick FROM users WHERE iduser<>'.$user->info->iduser.' AND active=1 AND chat=1 AND (firstname like "%'.$thequery.'%" OR lastname like "%'.$thequery.'%") AND (iduser NOT IN ('.$sql_theblockeds.')) ORDER BY lastclick DESC LIMIT 15');
            }
            
            while($obj = $page->db2->fetch_object()) {
                
                $D->cht_color_status = '';
                
                $D->lck = $obj->lastclick;
                $D->ago_time_user = '';
                if ($D->lck < (time() - 1 * 60)) {
                    $seconds = time() - $D->lck;
                    $D->_minutes = floor($seconds/60);
                    $D->_hours = floor($seconds/(60*60));
                    $D->_days = floor(($seconds/(60*60*24)));
                    
                    if ($D->_minutes > 59) {
                        if ($D->_hours > 23) {
                            if ($D->_days > 28) {
                                $D->cht_color_status = '#CED0D3';
                            } else {
                                $D->ago_time_user = $D->_days.$page->lang('global_txt_char_day');
                            }
                        } else {
                            $D->ago_time_user = $D->_hours.$page->lang('global_txt_char_hour');
                        }
                    } else {
                        $D->ago_time_user = $D->_minutes.$page->lang('global_txt_char_minute');
                    }
                    $D->is_online = FALSE;
                } else {
                    $D->is_online = TRUE;
                    $D->cht_color_status = '#42B72A';
                }
                
                
                if (empty($obj->avatar)) $obj->avatar = $K->DEFAULT_AVATAR_USER;
                $base_url = $K->STORAGE_URL_AVATARS.'min2/';
                $D->cht_avatar = $base_url.$obj->avatar;
                if ($obj->avatar != $K->DEFAULT_AVATAR_USER) $D->cht_avatar = $base_url.$obj->code.'/'.$obj->avatar;

                $D->cht_code = $obj->code;
                $D->cht_username = $obj->user_username;
                $D->cht_nameUser = stripslashes($obj->firstname).' '.stripslashes($obj->lastname);
                $html_userchatonline .= $page->load_template('ones/one-user-chat-online.php',FALSE);
            }
            if (empty($html_userchatonline)) {
                $html_userchatonline = $page->load_template('_empty-chat-max.php',FALSE);
            }

            $json_result = array('html_user_chat'=>$html_userchatonline);
            echo(json_encode($json_result));
            return;         
            
        }

        if ($ajax_action == 'searchfriendschat2') {
            
            $html_userchatonline = '';

            $sql_theblockeds = 'SELECT iduserblocked FROM users_blocked WHERE iduser='.$user->info->iduser;

            if ($K->SIDEBAR_USERS == 1) {
                $page->db2->query('SELECT code, avatar, user_username, lastname, firstname, lastclick FROM users, friends WHERE active=1 AND chat=1 AND accepted_date<>0 AND (firstname like "%'.$thequery.'%" OR lastname like "%'.$thequery.'%") AND ( (friend1=iduser AND friend2='.$user->info->iduser.') OR (friend2=iduser AND friend1='.$user->info->iduser.') ) AND ((friend1 NOT IN ('.$sql_theblockeds.')) AND (friend2 NOT IN ('.$sql_theblockeds.'))) ORDER BY lastclick DESC LIMIT 15');
            } else {
                $page->db2->query('SELECT code, avatar, user_username, lastname, firstname, lastclick FROM users WHERE iduser<>'.$user->info->iduser.' AND active=1 AND chat=1 AND (firstname like "%'.$thequery.'%" OR lastname like "%'.$thequery.'%") AND (iduser NOT IN ('.$sql_theblockeds.')) ORDER BY lastclick DESC LIMIT 15');
            }
            
            while($obj = $page->db2->fetch_object()) {

                $D->cht_color_status = '';
                
                $D->lck = $obj->lastclick;
                $D->ago_time_user = '';
                if ($D->lck < (time() - 1 * 60)) {
                    $seconds = time() - $D->lck;
                    $D->_minutes = floor($seconds/60);
                    $D->_hours = floor($seconds/(60*60));
                    $D->_days = floor(($seconds/(60*60*24)));
                    
                    if ($D->_minutes > 59) {
                        if ($D->_hours > 23) {
                            if ($D->_days > 28) {
                                $D->cht_color_status = '#CED0D3';
                            } else {
                                $D->ago_time_user = $D->_days.$page->lang('global_txt_char_day');
                            }
                        } else {
                            $D->ago_time_user = $D->_hours.$page->lang('global_txt_char_hour');
                        }
                    } else {
                        $D->ago_time_user = $D->_minutes.$page->lang('global_txt_char_minute');
                    }
                    $D->is_online = FALSE;
                } else {
                    $D->is_online = TRUE;
                    $D->cht_color_status = '#42B72A';
                }
                
                if (empty($obj->avatar)) $obj->avatar = $K->DEFAULT_AVATAR_USER;
                $base_url = $K->STORAGE_URL_AVATARS.'min2/';
                $D->cht_avatar = $base_url.$obj->avatar;
                if ($obj->avatar != $K->DEFAULT_AVATAR_USER) $D->cht_avatar = $base_url.$obj->code.'/'.$obj->avatar;

                $D->cht_code = $obj->code;
                $D->cht_username = $obj->user_username;
                $D->cht_nameUser = stripslashes($obj->firstname).' '.stripslashes($obj->lastname);
                $html_userchatonline .= $page->load_template('ones/one-user-chat-bottom.php',FALSE);
            }
            if (empty($html_userchatonline)) {
                $html_userchatonline = $page->load_template('_empty-chat-max.php',FALSE);
            }

            $json_result = array('html_user_chat'=>$html_userchatonline);
            echo(json_encode($json_result));
            return;         
            
        }

    }
?>