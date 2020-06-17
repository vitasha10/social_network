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

if (!$K->LOGIN_WITH_TWITTER) {
	$this->redirect($K->SITE_URL);	
} else {	
	require_once("twitter/twitteroauth.php");

	$twitteroauth = new TwitterOAuth($K->TW_APPID, $K->TW_SECRET);

	$callBack = $K->SITE_URL.'oauthtwitterData';
	$request_token = $twitteroauth->getRequestToken($callBack);

	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

	if ($twitteroauth->http_code != 200) {
		die('You need to check the settings of your application on Twitter.');
	} else {
		$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
		header('Location: ' . $url);
	}
}
?>