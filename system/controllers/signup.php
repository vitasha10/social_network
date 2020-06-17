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
    if ($D->_IS_LOGGED) $this->globalRedirect('dashboard'); 

	$this->loadLanguage('global.php');
	$this->loadLanguage('signup.php');

    $this->load_extract_controller('_bar-top');
    $this->load_extract_controller('_required-signup');

    $D->page_title = $this->lang('signup_title_page', array('#SITE_TITLE#'=>$K->SITE_TITLE));

	$this->load_template('signup.php');

?>