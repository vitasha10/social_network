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
    $page = & $GLOBALS['page'];
    $user = & $GLOBALS['user'];

    $page->loadLanguage('global.php');
    $page->loadLanguage('dashboard.php');

    $the_sanitaze = new sanitize(); // init sanitaze

    $error = FALSE;
    $txt_error= '';

    if ($ajax_action == 'searchtop') {

        $query = isset($_POST['q']) ? (trim($_POST['q'])) : '';
        $query = $the_sanitaze->str_nohtml($query);

    	if (!$error && empty($query)) {
            $error = TRUE;
            $txt_error = 'Error.';
        }

    }

    if ($ajax_action == 'recentsearchtop') {
        
    }

    if ($error) {
        echo('ERROR:'.$txt_error);
		return;
    } else {

        if ($ajax_action == 'searchtop') {
            
            $sqlidblockeds = '0';
            if ($user->is_logged) {             
                $sqlidblockeds = 'SELECT iduserblocked FROM users_blocked WHERE iduser='.$user->id;
            }

            $html_result = '';
            $thusers = $page->db2->fetch_all("
            SELECT * FROM users 
            WHERE active=1 
            AND iduser NOT IN (".$sqlidblockeds.") 
            AND ((firstname LIKE '%".$query."%') OR (lastname LIKE '%".$query."%') OR (CONCAT(firstname,' ',lastname) LIKE '%".$query."%')) 
            ORDER BY num_friends DESC LIMIT ".$K->NUM_NOTIFICATIONS_TOP);

            if (count($thusers) > 0) {
                foreach ($thusers as $oneuser) {
                    if (empty($oneuser->avatar)) $oneuser->avatar = $K->DEFAULT_AVATAR_USER;
                    $base_url = $K->STORAGE_URL_AVATARS.'min2/';
                    $D->st_user_avatar = $base_url.$oneuser->avatar;
                    if ($oneuser->avatar != $K->DEFAULT_AVATAR_USER) $D->st_user_avatar = $base_url.$oneuser->code.'/'.$oneuser->avatar;

                    $D->st_user_name = stripslashes($oneuser->firstname).' '.stripslashes($oneuser->lastname);
                    $D->st_user_url = $K->SITE_URL.$oneuser->user_username.'/ref:search';
                    $D->st_user_numfriends = $oneuser->num_friends;
                    $html_result .= $page->load_template('ones/one-user-result-search.php', FALSE);
                }
            } else {
                $html_result .= $page->load_template('_empty-result-serch-top.php', FALSE);
            }

            $json_result = array('result_search'=>$html_result, 'the_query'=>$query);
            echo(json_encode($json_result));
            return;

        }

    }
?>