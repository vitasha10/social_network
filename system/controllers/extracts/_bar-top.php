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

$D->menu_top_out = array(
array('id_option' => 'opc_signup_top', 'url' => 'signup', 'rel' => '', 'target' => '', 'text_option' =>  $this->lang('global_txt_signup')),
array('id_option' => 'opc_login_top', 'url' => 'login', 'rel' => '', 'target' => '', 'text_option' =>  $this->lang('global_txt_login')),
);

$D->html_logo = $this->designer->loadLogo();

$D->html_menu_top = $this->designer->createMenuTopBasic($D->menu_top_out);
