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

$js_innologin = array('jquery.min', 'base', 'modernizr.min', 'jquery.slimscroll.min', 'jquery-ui.min', 'moment.min', 'livestamp.min', 'mediaelement/mediaelement-and-player.min', 'videojs/video.min', 'login', 'md5', 'profile', 'recoverypass', 'signup', 'zoomeer');

$js_inlogin = array();

$css_login = array('css', 'css-wide', 'css-tablet', 'css-mobile320', 'css-mobile480');
$css_nologin = array('css', 'css-wide', 'css-tablet', 'css-mobile320', 'css-mobile480');

$D->header_data = $this->designer->getMetaData();
$D->header_data .= $this->designer->getCSSData($css_nologin, $css_login);
$D->header_data .= $this->designer->loadFavicon();
$D->header_data .= $this->designer->getJSData($js_innologin, $js_inlogin);

if (isset($_COOKIE['lang-out'])) {
    $K->LANGUAGE = $_COOKIE['lang-out'];
}
