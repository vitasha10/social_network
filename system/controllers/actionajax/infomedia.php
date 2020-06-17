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
    $network = & $GLOBALS['network'];
    $user = & $GLOBALS['user'];

    $page->loadLanguage('global.php');
    $page->loadLanguage('dashboard.php');
    $page->loadLanguage('activity.php');

    $the_sanitaze = new sanitize(); // init sanitaze

    $error = FALSE;

    $code_media = isset($_POST['cm']) ? (trim($_POST['cm'])) : '';
    $code_media = $the_sanitaze->str_nohtml($code_media, 11);

    $place = isset($_POST['ipl']) ? (trim($_POST['ipl'])) : '';
    $place = $the_sanitaze->str_nohtml($place);

    if (empty($code_media)) { $error = TRUE; $txterror = 'Error. '; }

    if ($error) {

        echo('ERROR:'.$txterror);
		return;

    } else {

        $res = $page->db2->fetch("SELECT * FROM medias WHERE code='".$code_media."' LIMIT 1");

        if ($res) {
            $idcontainer = $res->idcontainer;
            $idmedia = $res->idmedia;
            $numcomments = $res->numcomments;
            $numlikes = $res->numlikes;

            $medias = $page->db2->fetch_all("SELECT * FROM medias WHERE idcontainer=".$idcontainer." ORDER BY idmedia DESC");

            $prev = FALSE;
            $next = FALSE;
            $codeprev = '';
            $codenext = '';            
            $imageprev = '';
            $imagenext = '';

            foreach ($medias as $onemedia) {
                $ids_medias[] = $onemedia->idmedia;
                $photos[] = $onemedia;
            }
            $posi = array_search($idmedia, $ids_medias);

            $num_medias = count($medias);
            if ($num_medias > 1) {

                $posi_prev = $posi - 1;
                if ($posi_prev != -1) {
                    $prev = TRUE;
                    $codeprev = $photos[$posi_prev]->code;
                    $imageprev = $K->STORAGE_URL_PHOTOS.'thumb1/'.$photos[$posi_prev]->folder.'/'.$photos[$posi_prev]->namefile;
                    if ($place == 'album') $imageprev = $K->STORAGE_URL_ALBUMS_USERS.'thumb1/'.$photos[$posi_prev]->folder.'/'.$photos[$posi_prev]->namefile;
                }

                $posi_next = $posi + 1;
                if ($posi_next != $num_medias) {
                    $next = TRUE;
                    $codenext= $photos[$posi_next]->code;
                    $imagenext = $K->STORAGE_URL_PHOTOS.'thumb1/'.$photos[$posi_next]->folder.'/'.$photos[$posi_next]->namefile;
                    if ($place == 'album') $imagenext = $K->STORAGE_URL_ALBUMS_USERS.'thumb1/'.$photos[$posi_next]->folder.'/'.$photos[$posi_next]->namefile;
                }

            }

            /******************************************************/

            $D->codemedia = $code_media;
            $D->idmedia = $idmedia;
            $D->numcomments = $res->numcomments;
            $D->numlikes = $res->numlikes;

            $thepost = $page->db2->fetch("SELECT * FROM posts WHERE idpost=".$idcontainer." LIMIT 1");
            $D->postcode = $thepost->code;
            $D->type_writer = $thepost->type_writer;
            $D->idwriter = $thepost->idwriter;
            $D->posted_in = $thepost->posted_in;
            $D->post_date = '<span class="thelivestamp" data-locale="'.$K->LANGUAGE.'" data-livestamp="'.$thepost->post_date.'"></span>';
            $D->for_who = $thepost->for_who;

            $D->liketoUser = FALSE;

            if ($D->_IS_LOGGED) {
                if ($network->itemLiketoUser($user->id, 0, $D->idmedia, 2)) $D->liketoUser = TRUE;
                $D->avatar_user = $user->getAvatar(1);
                $D->code_visitor = $user->info->code;
                $D->type_visitor = 0;
            }

            switch($D->for_who) {
                case 0:
                    $D->icono_typepost = getImageTheme('typepost-public.png');
                    break;
                case 1:
                    $D->icono_typepost = getImageTheme('typepost-friends.png');
                    break;
                case 2:
                    $D->icono_typepost = getImageTheme('typepost-onlyme.png');
                    break;            
            }

            $D->url_avatar = '';
            if ($D->type_writer == 0) {
                $theuser = $page->db2->fetch("SELECT * FROM users WHERE iduser=".$D->idwriter." LIMIT 1");

                if (empty($theuser->avatar)) $theuser->avatar = $K->DEFAULT_AVATAR_USER;
                $base_url = $K->STORAGE_URL_AVATARS.'min2/';
                $D->url_avatar = $base_url.$theuser->avatar;
                if ($theuser->avatar != $K->DEFAULT_AVATAR_USER) $D->url_avatar = $base_url.$theuser->code.'/'.$theuser->avatar;

                $D->code = $theuser->code;
                $D->name = stripslashes($theuser->firstname).' '.stripslashes($theuser->lastname);
                $D->username = $theuser->user_username;

            } else {

                $thepage = $page->db2->fetch("SELECT * FROM pages WHERE idpage=".$D->idwriter." LIMIT 1");

                if (empty($thepage->avatar)) $thepage->avatar = $K->DEFAULT_AVATAR_PAGE;
                $base_url = $K->STORAGE_URL_AVATARS_PAGE.'min2/';
                $D->url_avatar = $base_url.$thepage->avatar;
                if ($thepage->avatar != $K->DEFAULT_AVATAR_PAGE) $D->url_avatar = $base_url.$thepage->code.'/'.$thepage->avatar;

                $D->code = $thepage->code;
                $D->name = stripslashes($thepage->title);
                $D->username = $thepage->puname;

            }

            $D->show_bottom = FALSE;

            $D->comments_html = '';

            // the comments
            $D->comments_html = '';
            $the_comments = $page->db2->fetch_all("SELECT idcomment FROM comments WHERE iditem=".$D->idmedia." AND typeitem=1 ORDER BY whendate ASC");
            if (count($the_comments) > 0) {
                foreach ($the_comments as $one_comment) {
                    $D->comment = new comment($one_comment->idcomment);
                    $D->comments_html .= $D->comment->draw();
                    unset($D->comment);
                }
            }

            if (!empty($D->comments_html)) $D->show_bottom = TRUE;

            if ($D->_IS_LOGGED) $D->show_bottom = TRUE;

            $infomedia = $page->load_template('ones/one-info-a-zoomeer.php', FALSE);

            /******************************************************/

            $json_result = array('html'=>$idcontainer, 'prev'=>(!$prev ? FALSE : TRUE), 'idprev'=>$codeprev,'imgprev'=>$imageprev, 'next'=>(!$next ? FALSE : TRUE), 'idnext'=>$codenext,'imgnext'=>$imagenext,'place'=>$place,'infomedia'=>$infomedia);
            echo(json_encode($json_result));
            return;         

        } else {
            echo('ERROR:Error');
            return;
        }

    }
?>