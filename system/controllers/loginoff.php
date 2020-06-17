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
    if ($this->user->is_logged) { $this->redirect('admin/general'); }

    if (isset($_POST['login']) && $_POST['login'] == 'ok') {

        $the_sanitaze = new sanitize();

        $username = $the_sanitaze->str_nohtml($_POST['username']);

        $password = $the_sanitaze->str_nohtml($_POST['password']);

        if ($this->user->login($username, md5($password))) $this->redirect('admin/general');

    }



	$this->loadLanguage('off.php');

    

    $D->page_title = $K->SITE_TITLE;



	$this->load_template('loginoff.php');

?>