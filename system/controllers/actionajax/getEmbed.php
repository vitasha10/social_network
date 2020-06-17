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

    if (!$user->is_logged) {
        echo('ERROR:'.$page->lang('global_txt_no_session'));
        return;
    }

    $the_sanitaze = new sanitize(); // init sanitaze

    $error = FALSE;

    $url = isset($_POST['url']) ? (trim($_POST['url'])) : '';
    $url = $the_sanitaze->url($url);

    if ($error) {
        die();
    } else {

        $parse_url = parse_url($url);
        require('helpers/Embed/src/autoloader.php');

        $config = ['image' => ['class' => 'Embed\\ImageInfo\\Custom']];

        $the_embed = Embed\Embed::create($url, $config);

        $thetype = 0;
        if ($the_embed) {
            $infoEmbed = array();
            $infoEmbed['e_url'] = $url;
            $infoEmbed['e_title'] = $the_embed->title;
            $infoEmbed['e_text'] = $the_embed->description;
            $infoEmbed['e_type'] = $the_embed->type;
            if($infoEmbed['e_type'] == "link") {
                $infoEmbed['e_host'] = $parse_url['host'];
                $infoEmbed['e_thumbnail'] = $the_embed->image;
                $thetype = 1;
                $template_embed = 'attach/embed-link.php';
            } else {
                $infoEmbed['e_html'] = $the_embed->code;
                $infoEmbed['e_provider'] = $the_embed->providerName;
                $thetype = 2;
                if ($infoEmbed['e_type'] == "photo") $template_embed = 'attach/embed-photo.php';                    
                else $template_embed = 'attach/embed-media.php';
            }

            $D->withDelete = TRUE;
            $D->infoEmbed = $infoEmbed;
            $html_embed = $page->load_template($template_embed, FALSE);
            
            // "Transform" the iframe, script tag
            $infoEmbed['e_html'] = str_replace('iframe', 'ifr+ame', $infoEmbed['e_html']);
            $infoEmbed['e_html'] = str_replace('script', 'scr+ipt', $infoEmbed['e_html']);
            
            $json_result = array('html'=>$html_embed, 'infoembed'=>$infoEmbed, 'embedtype'=>$thetype);

            echo(json_encode($json_result));
            return;            

        } else {
            $json_result = array('status'=>'ERROR');
            echo('ERROR');
            return;
        }
    
    }
?>