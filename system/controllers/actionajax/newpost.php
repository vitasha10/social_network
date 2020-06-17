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

    global $db2, $K;

    $page = & $GLOBALS['page'];
    $user = & $GLOBALS['user'];
    $network = & $GLOBALS['network'];

	$page->loadLanguage('global.php');
	$page->loadLanguage('dashboard.php');
	$page->loadLanguage('activity.php');

    $designer = new designer();

    if (!$user->is_logged) {
        $msgerror = $designer->boxAlert($page->lang('dashboard_newactivity_error_no_save_title'), $page->lang('global_txt_no_session'), $page->lang('dashboard_newactivity_error_bclose'));
        echo('ERROR:'.$msgerror);
        return;
    }

    $the_sanitaze = new sanitize(); // init sanitaze
    
    $error = FALSE;
    
    $msgerror = '';
    
    $posted_in = isset($_POST['posted_in']) ? (trim($_POST['posted_in'])) : 0;
    $posted_in = $the_sanitaze->int($posted_in);

    $code_wall = isset($_POST['code_wall']) ? (trim($_POST['code_wall'])) : '';
    $code_wall = $the_sanitaze->str_nohtml($code_wall);

    $for_who = isset($_POST['for_who']) ? (trim($_POST['for_who'])) : 0;
    $for_who = $the_sanitaze->int($for_who);
    
    $typeattach = isset($_POST['typeattach']) ? (trim($_POST['typeattach'])) : '';
    $typeattach = $the_sanitaze->str_nohtml($typeattach);
    
    $newmessage = isset($_POST['text-new-activity']) ? (trim($_POST['text-new-activity'])) : '';
    $newmessage = $the_sanitaze->str_nohtml($newmessage);

    $code_writer = isset($_POST['code_writer']) ? (trim($_POST['code_writer'])) : '';
    $code_writer = $the_sanitaze->str_nohtml($code_writer);

    $type_writer = isset($_POST['type_writer']) ? (trim($_POST['type_writer'])) : 0;
    $type_writer = $the_sanitaze->int($type_writer);
    
    $embed = jsonDecode((isset($_POST['infoembed']) ? ($_POST['infoembed']) : ''), true);

    $typeembed = isset($_POST['typeembed']) ? (trim($_POST['typeembed'])) : 0;
    $typeembed = $the_sanitaze->int($typeembed);

    $input_withp = isset($_POST['input_withp']) ? (trim($_POST['input_withp'])) : '';
    $input_withp = $the_sanitaze->str_nohtml($input_withp, 50);

    $input_feeling = isset($_POST['input_feeling']) ? (trim($_POST['input_feeling'])) : '';
    $input_feeling = $the_sanitaze->str_nohtml($input_feeling, 25);

    $input_insitu = isset($_POST['input_insitu']) ? (trim($_POST['input_insitu'])) : '';
    $input_insitu = $the_sanitaze->str_nohtml($input_insitu, 50);

    $np = new newpost();
    
    if (!$np) {
        $error = TRUE;
        $msgerror = $designer->boxAlert($page->lang('dashboard_newactivity_error_no_save_title'), $page->lang('dashboard_newactivity_error_no_save_msg'), $page->lang('dashboard_newactivity_error_bclose'));
    }
    $idwriter = $network->getUserByCode($code_writer, TRUE);

    if (!$error) {
        if (!$np->moreInfo($code_writer, $type_writer, $posted_in, $code_wall, $for_who, $input_withp, $input_feeling, $input_insitu)) {
            $error = TRUE;
            $msgerror = $designer->boxAlert($page->lang('dashboard_newactivity_error_no_save_title'), $page->lang('dashboard_newactivity_error_no_save_msg'), $page->lang('dashboard_newactivity_error_bclose'));
        }
    }

    if (!$error) {
        $res = array();
        switch ($typeattach) {
            case 'photos':
                $res = $np->attachImages($_FILES['photos_activity_new']);
                $error = $res[0];
                $msgerror = $res[1];
                break;   
                
            case 'video':
                $res = $np->attachVideo($_FILES['video_activity_new']);
                $error = $res[0];
                $msgerror = $res[1];
                break;   
            case 'audio':
                $res = $np->attachAudio($_FILES['audio_activity_new']);
                $error = $res[0];
                $msgerror = $res[1];
                break;   
        }
    }

    if ($error) {
        
        echo('ERROR:'.$msgerror);
        return;

    } else {

        $np->setMessage($newmessage);

        if (is_array($embed) && count($embed)>0) {
            switch($typeembed) {
                case 1:
                    $np->setEmbed($embed, 1);
                    break;
                case 2:
                    $np->setEmbed($embed, 2);
                    break;                
            }
        }

        $res = $np->save();
        if (!$res) {
            
            $np->deleteMedia();

            $msgerror = $designer->boxAlert($page->lang('dashboard_newactivity_error_no_save_title'), $page->lang('dashboard_newactivity_error_no_save_msg'), $page->lang('dashboard_newactivity_error_bclose'));

            echo('ERROR:'.$msgerror);
            return;
            
        } else {

            $o = $db2->query( 'SELECT * FROM posts WHERE idpost="'. $res .'" LIMIT 1' );
            $obj = $db2->fetch_object($o);
            
            $the_post = (is_object($obj) && get_class($obj) == 'post') ? $obj : new post(FALSE, $obj);
            
            $json_result = array('html'=>$the_post->draw(), 'id_new_post'=>$res);
            echo(json_encode($json_result));
            return;
            
        }
    }

?>