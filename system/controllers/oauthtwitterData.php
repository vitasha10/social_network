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
require("twitter/twitteroauth.php");

if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {

	$twitter = new TwitterOAuth($K->TW_APPID, $K->TW_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	$accessToken = $twitter->getAccessToken($_REQUEST['oauth_verifier']);
	
	if($twitter->http_code != 200) {
		session_destroy();
		die('You need to check the settings of your application on Twitter.');
	}
	
	unset($_SESSION['oauth_token']);
	unset($_SESSION['oauth_token_secret']);
	
	$connection = new TwitterOAuth($K->TW_APPID, $K->TW_SECRET, $accessToken['oauth_token'], $accessToken['oauth_token_secret']);
	$user_info = $connection->get('account/verify_credentials');
	
	if($connection->http_code != 200) {
		session_destroy();
		die('You need to check the settings of your application on Twitter.');
	}

    if (isset($user_info->error)) {
        header('Location: '.$K->SITE_URL.'oauthtwitter');
    } else {
		
		$r = $this->db1->query("SELECT user_username FROM users WHERE auth_id='".$user_info->id."' AND auth='twitter'");
		if (!($obj = $db2->fetch_object($r))) {
			$code = codeUniqueInTable(11, 1, 'users', 'code');
			$tw_pass = getCode(10,1);

			$ip	= $this->db1->escape( ip2long($_SERVER['REMOTE_ADDR']) );

			$tw_email = $code.'@'.$K->DOMAIN_EMAIL_TW;
			$tw_id = $user_info->id;
			$tw_Name = explode(' ', $user_info->name);

			$tw_first_name = $this->db1->e($tw_Name[0]);
			$tw_last_name = $this->db1->e($tw_Name[1]);
			$tw_twitter = $this->db1->e($user_info->url);
			$tw_username = $user_info->screen_name;
			
			$numu1 = $this->db1->fetch_field("SELECT count(iduser) FROM users WHERE user_username='".$tw_username."'");
			$numu2 = $this->db1->fetch_field("SELECT count(idgroup) FROM groups WHERE guname='".$tw_username."'");
			$numu3 = $this->db1->fetch_field("SELECT count(idpage) FROM pages WHERE puname='".$tw_username."'");
			$numu = $numu1 + $numu2 + $numu3;
			if ($numu != 0) $tw_username = $tw_username.''.($numu + 1);
			
			$tw_username = $this->db1->e($tw_username);	
			
			$r = $this->db1->query("INSERT INTO users SET code='".$code."', user_password='" . md5($tw_pass) . "', auth='twitter', user_username='".$tw_username."', auth_id='".$tw_id."', firstname='".$tw_first_name."', lastname='".$tw_last_name."', user_email='".$tw_email."', registerdate='" . time() . "', ipregister='" . $ip . "', birthday='1973-11-16', verified=1, validated=1, datevalidated='" . time() . "', gender=1");
			
		} else {
			$tw_username = $obj->user_username;
		}
		$this->user->loginSocial($tw_username,'twitter');
		$this->redirect($K->SITE_URL);		
	}

} else {
	$this->redirect($K->SITE_URL.'oauthtwitter');
}
?>