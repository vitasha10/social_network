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
if (isset($_GET['error'])) { $this->redirect($K->SITE_URL); }

$callback_URL = $K->SITE_URL.'callback-fb';
$FB_Permissions = array('email');

// Include the autoloader provided in the SDK
require_once 'helpers/facebook/autoload.php';

// Include required libraries
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

$fb = new Facebook(array(
	'app_id' => $K->FB_APPID,
	'app_secret' => $K->FB_SECRET,
	'default_graph_version' => 'v2.2',
));

$helper = $fb->getRedirectLoginHelper();

try {
	if(isset($_SESSION['facebook_access_token'])){
		$accessToken = $_SESSION['facebook_access_token'];
	}else{
  		$accessToken = $helper->getAccessToken();
	}
} catch(FacebookResponseException $e) {
 	echo 'Graph returned an error: ' . $e->getMessage();
  	exit;
} catch(FacebookSDKException $e) {
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
  	exit;
}
    
if(isset($accessToken)){
    
	if(isset($_SESSION['facebook_access_token'])){
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}else{
		
		$_SESSION['facebook_access_token'] = (string) $accessToken;
		
		$oAuth2Client = $fb->getOAuth2Client();
		
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;

		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}
    
	if(isset($_GET['code'])){
        $this->redirect($K->SITE_URL);
	}
    
	try {
		$profileRequest = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,locale,picture.width(500)');
		$fbUserProfile = $profileRequest->getGraphNode()->asArray();
	} catch(FacebookResponseException $e) {
		echo 'Graph returned an error: ' . $e->getMessage();
		session_destroy();
		$this->redirect('login');
		exit;
	} catch(FacebookSDKException $e) {
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}

	$fbUserData = array(
		'oauth_provider'=> 'facebook',
		'oauth_uid' => $fbUserProfile['id'],
		'first_name' => $fbUserProfile['first_name'],
		'last_name' => $fbUserProfile['last_name'],
        'displayname' => $fbUserProfile['name'],
		'email' => $fbUserProfile['email'],
		'gender' => $fbUserProfile['gender'],
		'locale' => $fbUserProfile['locale'],
		'picture' => $fbUserProfile['picture']['url'],
		'link' => $fbUserProfile['link'],
	);

    $fb_email = $this->db1->e($fbUserData['email']);

    $usersimple = $this->db1->fetch_field("SELECT iduser FROM users WHERE user_email='".$fbUserData['email']."' AND auth=''");
    if ($usersimple) {
        $D->msg_alert = 'The email that this facebook account is using is already registered';
        session_destroy();
    } else {
        $save_avatar = FALSE;
        $r = $this->db1->query("SELECT user_username FROM users WHERE user_email='".$fb_email."' AND auth='facebook'");
        if (!($obj = $db2->fetch_object($r))) {
            
            $ip	= $this->db1->escape( ip2long($_SERVER['REMOTE_ADDR']) );
            $code = codeUniqueInTable(11, 1, 'users', 'code');
            $soc_id = $fbUserData['oauth_uid'];
            $soc_pass = getCode(10,1);
            $soc_photourl = $fbUserData['picture'];
            $soc_first_name = $this->db1->e($fbUserData['first_name']);
            $soc_last_name = $this->db1->e($fbUserData['last_name']);
            $soc_email = $fb_email;
            $soc_gender = $fbUserData['gender'];
            $soc_username = $fbUserData['displayname'];
            $soc_username = str_replace(' ','',$soc_username);
            $soc_username = str_replace('.','',$soc_username);
            $soc_linksocial = $this->db1->e($fbUserData['link']);
    

            //if the username does not work, use your email
            if (!validateUsername($soc_username)) {
                $newUser = explode('@', $fb_email);
                $soc_username = str_replace('.','',$newUser[0]);
                $soc_username = str_replace('-','',$soc_username);
                $lenun = strlen($soc_username);
                if (strlen($soc_username)<6) $soc_username = $soc_username . getCode(6-$lenun,1);
            }
    
            $numu1 = $this->db1->fetch_field("SELECT count(iduser) FROM users WHERE user_username='".$soc_username."'");
            $numu2 = $this->db1->fetch_field("SELECT count(idgroup) FROM groups WHERE guname='".$soc_username."'");
            $numu3 = $this->db1->fetch_field("SELECT count(idpage) FROM pages WHERE puname='".$soc_username."'");
            $numu = $numu1 + $numu2 + $numu3;
            if ($numu != 0) $soc_username = $soc_username.''.($numu + 1);
            
            $soc_username = $this->db1->e($soc_username);

            $gender = 0;
            if ($soc_gender == 'male') $gender = 1;
            if ($soc_gender == 'female') $gender = 2;
            
            $finalphoto = '';
            $code_media = '';

            if (!empty($soc_photourl)) {
                $image_tmp = $soc_photourl;
                $pos = strpos($image_tmp, '?');
                if (FALSE !== $pos) $image_tmp = substr($image_tmp, 0, $pos);

                $ext = explode(".",$image_tmp);
                $ext = $ext[count($ext)-1];
                $codephoto = getCode(5, 1);
                $codephoto .= '-'.getCode(6, 1);
                $codephoto .= '-'.getCode(7, 1);
                $finalphoto = $codephoto.'.'.$ext;
                
                $the_pholder_avatar_0 = $K->STORAGE_DIR_AVATARS.'originals/'.$code;
                $the_pholder_avatar_1 = $K->STORAGE_DIR_AVATARS.'min1/'.$code;
                $the_pholder_avatar_2 = $K->STORAGE_DIR_AVATARS.'min2/'.$code;
                $the_pholder_avatar_3 = $K->STORAGE_DIR_AVATARS.'min3/'.$code;
                $the_pholder_avatar_4 = $K->STORAGE_DIR_AVATARS.'min4/'.$code;
                
                if (!file_exists($the_pholder_avatar_0)) {
                    mkdir($the_pholder_avatar_0, 0777, true);
                    $findex = fopen($the_pholder_avatar_0.'/index.html', "a");
                }

                if (!file_exists($the_pholder_avatar_1)) {
                    mkdir($the_pholder_avatar_1, 0777, true);
                    $findex = fopen($the_pholder_avatar_1.'/index.html', "a");
                }

                if (!file_exists($the_pholder_avatar_2)) {
                    mkdir($the_pholder_avatar_2, 0777, true);
                    $findex = fopen($the_pholder_avatar_2.'/index.html', "a");
                }

                if (!file_exists($the_pholder_avatar_3)) {
                    mkdir($the_pholder_avatar_3, 0777, true);
                    $findex = fopen($the_pholder_avatar_3.'/index.html', "a");
                }

                if (!file_exists($the_pholder_avatar_4)) {
                    mkdir($the_pholder_avatar_4, 0777, true);
                    $findex = fopen($the_pholder_avatar_4.'/index.html', "a");
                }
                
                
                
                $res_avatar = copyImageFromUrl($soc_photourl, $the_pholder_avatar_0.'/', $finalphoto);
                if (!$res_avatar) $finalphoto = '';
                else {

                    if (file_exists($the_pholder_avatar_0.'/'.$finalphoto)) {
                    
                        require_once('classes/class_imagen.php');
                        
                        $thumbnail = new imagen($the_pholder_avatar_0.'/'.$finalphoto);
                        $thumbnail->resizeImage($K->widthAvatar1, $K->heightAvatar1, 'crop');
                        $thumbnail->saveImage($the_pholder_avatar_1.'/'.$finalphoto);
        
                        $thumbnail = new imagen($the_pholder_avatar_0.'/'.$finalphoto);
                        $thumbnail->resizeImage($K->widthAvatar2, $K->heightAvatar2, 'crop');
                        $thumbnail->saveImage($the_pholder_avatar_2.'/'.$finalphoto);
        
                        $thumbnail = new imagen($the_pholder_avatar_0.'/'.$finalphoto);
                        $thumbnail->resizeImage($K->widthAvatar3, $K->heightAvatar3, 'crop');
                        $thumbnail->saveImage($the_pholder_avatar_3.'/'.$finalphoto);
        
                        $thumbnail = new imagen($the_pholder_avatar_0.'/'.$finalphoto);
                        $thumbnail->resizeImage($K->widthAvatar4, $K->heightAvatar4, 'crop');
                        $thumbnail->saveImage($the_pholder_avatar_4.'/'.$finalphoto);
                        
                        $save_avatar = TRUE;
                        
                    }

                }
            }

            
            $r = $this->db1->query("INSERT INTO users SET code='".$code."', user_password='" . md5($soc_pass) . "', auth='facebook', user_username='".$soc_username."', auth_id='".$soc_id."', firstname='".$soc_first_name."', lastname='".$soc_last_name."', user_email='".$soc_email."', avatar='".$finalphoto."', avatar_media='".$code_media."', registerdate='" . time() . "', ipregister='" . $ip . "', birthday='1973-11-16', verified=1, validated=1, datevalidated='" . time() . "', gender=".$gender.", facebook='".$soc_linksocial."'");
            
            $theusername = $soc_username;

        } else {
            $theusername = $obj->user_username;
        }
        $this->user->loginSocial($theusername, 'facebook');
        
        if ($save_avatar) {
            require_once('classes/class_newpost.php');
            $np = new newpost();				
            $np->moreInfo($code, 0, 0, $code, 0, '', '', '');
            $code_media = $np->attachImagesFromServer($the_pholder_avatar_0.'/'.$finalphoto, $ext);
            $np->setMessage('');
            $np->setTypePost(6);
            $np->save();
            $this->db1->query("UPDATE users SET avatar_media='".$code_media."' WHERE code='".$code."' LIMIT 1");
        }
        
        $this->redirect($K->SITE_URL);
    }

    
} else {
    
	$D->FB_loginURL = htmlspecialchars($helper->getLoginUrl($callback_URL, $FB_Permissions));

}