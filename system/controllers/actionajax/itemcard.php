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

    $page->loadLanguage('global.php');
    $page->loadLanguage('dashboard.php');

    $the_sanitaze = new sanitize(); // init sanitaze

    $error = FALSE;
    $txt_error = '';

    if ($ajax_action == 'load') {

        $codeitem = isset($_POST['cod']) ? (trim($_POST['cod'])) : '';
        $codeitem = $the_sanitaze->str_nohtml($codeitem);

        $typeitem = isset($_POST['typ']) ? (trim($_POST['typ'])) : '';
        $typeitem = $the_sanitaze->int($typeitem);

        $topnew = isset($_POST['unt']) ? (trim($_POST['unt'])) : '';
        $topnew = $the_sanitaze->int($topnew);

        $topnewnocover = isset($_POST['untnc']) ? (trim($_POST['untnc'])) : '';
        $topnewnocover = $the_sanitaze->int($topnewnocover);

        $widthareawork = isset($_POST['waw']) ? (trim($_POST['waw'])) : '';
        $widthareawork = $the_sanitaze->int($widthareawork);

    	if (!$error && empty($codeitem)) { $error = TRUE; $txt_error = 'Error.'; }
		if (!$error && !is_numeric($typeitem)) { $error = TRUE; $txt_error = 'Error.'; }
		if (!$error && !is_numeric($topnew)) { $error = TRUE; $txt_error = 'Error.'; }
		if (!$error && !is_numeric($topnewnocover)) { $error = TRUE; $txt_error = 'Error.'; }

    }

    if ($error) {
        echo('ERROR:'.$txt_error);
		return;
    } else {

        if ($ajax_action == 'load') {

            switch ($typeitem) {
                case 0:
                    $obj = $page->db2->fetch("SELECT * FROM users WHERE code='".$codeitem."' LIMIT 1");
                    $D->code = $obj->code;
                    $D->cover = $obj->cover;
                    $D->cover_position = $obj->cover_position;
                    $D->avatar = $K->STORAGE_URL_AVATARS.'min3/'.$K->DEFAULT_AVATAR_USER;
                    if (!empty($obj->avatar)) $D->avatar = $K->STORAGE_URL_AVATARS.'min3/'.$D->code.'/'.$obj->avatar;
                    $D->isVerified = $obj->verified;
                    $D->username = $obj->user_username;
                    $D->num_friends = $obj->num_friends;
                    $D->nameUser = (empty($obj->firstname) || empty($obj->lastname)) ? $obj->user_username : (stripslashes($obj->firstname).' '.stripslashes($obj->lastname));

                    $the_position_cover = trim(str_replace('px', '', $D->cover_position));
                    if ($widthareawork <= 300) {
                        $D->cover_position = (250 * $the_position_cover) / 800;
                        $D->cover_position = $D->cover_position.'px';
                    }

                    if ($widthareawork > 300 && $widthareawork <= 480) {
                        $D->cover_position = (300 * $the_position_cover) / 800;
                        $D->cover_position = $D->cover_position.'px';
                    }

                    if ($widthareawork > 480) {
                        $D->cover_position = (350 * $the_position_cover) / 800;
                        $D->cover_position = $D->cover_position.'px';
                    }

                    $txtreturn = $page->load_template('_itemcard.php', FALSE);	

                    $json_result = array('html'=>$txtreturn, 'withcover'=>(empty($obj->cover) ? FALSE : TRUE), 'utopCard' => $topnew, 'utopCardnoCover' => $topnewnocover);
                    echo(json_encode($json_result));
                    return;  

                    break;

                case 1:
                    $obj = $page->db2->fetch("SELECT pages.*, pages_cat.name as namecategory FROM pages, pages_cat WHERE pages.idsubcat=pages_cat.idcategory AND code='".$codeitem."' LIMIT 1");
                    $D->code = $obj->code;
                    $D->cover = $obj->cover;
                    $D->cover_position = $obj->cover_position;
                    $D->avatar = $K->STORAGE_URL_AVATARS_PAGE.'min3/'.$K->DEFAULT_AVATAR_PAGE;
                    if (!empty($obj->avatar)) $D->avatar = $K->STORAGE_URL_AVATARS_PAGE.'min3/'.$D->code.'/'.$obj->avatar;
                    $D->isVerified = $obj->verified;
                    $D->username = $obj->puname;
                    $D->numlikes = $obj->numlikes;
                    $D->titlePage = stripslashes($obj->title);
                    $D->namecategory = stripslashes($obj->namecategory);

                    $the_position_cover = trim(str_replace('px', '', $D->cover_position));
                    if ($widthareawork <= 300) {
                        $D->cover_position = (250 * $the_position_cover) / 800;
                        $D->cover_position = $D->cover_position.'px';
                    }

                    if ($widthareawork > 300 && $widthareawork <= 480) {
                        $D->cover_position = (300 * $the_position_cover) / 800;
                        $D->cover_position = $D->cover_position.'px';
                    }

                    if ($widthareawork > 480) {
                        $D->cover_position = (350 * $the_position_cover) / 800;
                        $D->cover_position = $D->cover_position.'px';
                    }

                    $txtreturn = $page->load_template('_itemcardpage.php', FALSE);	

                    $json_result = array('html'=>$txtreturn, 'withcover'=>(empty($obj->cover) ? FALSE : TRUE), 'utopCard' => $topnew, 'utopCardnoCover' => $topnewnocover);
                    echo(json_encode($json_result));
                    return;  

                    break;

                case 2:
                    $obj = $page->db2->fetch("SELECT * FROM groups WHERE code='".$codeitem."' LIMIT 1");
                    $D->code = $obj->code;
                    $D->cover = $obj->cover;
                    $D->cover_position = $obj->cover_position;
                    $D->username = $obj->guname;
                    $D->nummembers = $obj->nummembers;
                    $D->titleGroup = stripslashes($obj->title);

                    $the_position_cover = trim(str_replace('px', '', $D->cover_position));
                    if ($widthareawork <= 300) {
                        $D->cover_position = (250 * $the_position_cover) / 800;
                        $D->cover_position = $D->cover_position.'px';
                    }

                    if ($widthareawork > 300 && $widthareawork <= 480) {
                        $D->cover_position = (300 * $the_position_cover) / 800;
                        $D->cover_position = $D->cover_position.'px';
                    }

                    if ($widthareawork > 480) {
                        $D->cover_position = (350 * $the_position_cover) / 800;
                        $D->cover_position = $D->cover_position.'px';
                    }

                    $txtreturn = $page->load_template('_itemcardgroup.php', FALSE);	

                    $json_result = array('html'=>$txtreturn, 'withcover'=>(empty($obj->cover) ? FALSE : TRUE), 'utopCard' => $topnew, 'utopCardnoCover' => $topnewnocover);
                    echo(json_encode($json_result));
                    return;  

                    break;

            }

        }

    }
?>