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

    global $K;

    $user = & $GLOBALS['user'];
    $page = & $GLOBALS['page'];
    $network = & $GLOBALS['network'];

    $page->loadLanguage('global.php');
    $page->loadLanguage('admin.php');

    if (!$user->is_logged && !$user->is_admin) { echo('ERROR:'.$page->lang('global_txt_no_admin')); return; }

    $the_sanitaze = new sanitize(); // init sanitaze

    $error = FALSE;
    $txterror = '';
    
    if ($ajax_action == 'system') {

        $webstatus = isset($_POST['sst']) ? (trim($_POST['sst'])) : -1;
        $webstatus = $the_sanitaze->int($webstatus);

        $webprivacy = isset($_POST['spr']) ? (trim($_POST['spr'])) : -1;
        $webprivacy = $the_sanitaze->int($webprivacy);

        $company = isset($_POST['scny']) ? (trim($_POST['scny'])) : '';
        $company = $the_sanitaze->str_nohtml($company);

    	if (!$error && $webstatus == -1) { $error = TRUE; $txterror .= $page->lang('admin_txt_must_choose_option'); }
    	if (!$error && $webprivacy == -1) { $error = TRUE; $txterror .= $page->lang('admin_txt_must_choose_option'); }
    	if (!$error && empty($company)) { $error = TRUE; $txterror .= $page->lang('admin_general_block_system_error_company'); }

    }

    if ($ajax_action == 'seo') {

        $stitle = isset($_POST['stt']) ? (trim($_POST['stt'])) : '';
        $stitle = $the_sanitaze->str_nohtml($stitle);

        $skeyword = isset($_POST['sky']) ? (trim($_POST['sky'])) : '';
        $skeyword = $the_sanitaze->str_nohtml($skeyword);

        $sdescription = isset($_POST['sdsc']) ? (trim($_POST['sdsc'])) : '';
        $sdescription = $the_sanitaze->str_nohtml($sdescription);
        
        if (!$error && empty($stitle)) { $error = TRUE; $txterror .= $page->lang('admin_general_block_seo_error_title'); }
        if (!$error && empty($skeyword)) { $error = TRUE; $txterror .= $page->lang('admin_general_block_seo_error_keywords'); }
        if (!$error && empty($sdescription)) { $error = TRUE; $txterror .= $page->lang('admin_general_block_seo_error_description'); }

    }
    
    if ($ajax_action == 'register') {

        $rvalidation = isset($_POST['rval']) ? (trim($_POST['rval'])) : -1;
        $rvalidation = $the_sanitaze->int($rvalidation);

        $rminage = isset($_POST['rmina']) ? (trim($_POST['rmina'])) : -1;
        $rminage = $the_sanitaze->int($rminage);

        $rmaxage = isset($_POST['rmaxa']) ? (trim($_POST['rmaxa'])) : -1;
        $rmaxage = $the_sanitaze->int($rmaxage);

        $lremember = isset($_POST['rrem']) ? (trim($_POST['rrem'])) : -1;
        $lremember = $the_sanitaze->int($lremember);
        
        if (!$error && $rvalidation < 0) { $error = TRUE; $txterror .= $page->lang('admin_txt_must_choose_option'); }
        if (!$error && $rminage  < 0) { $error = TRUE; $txterror .= $page->lang('admin_general_block_register_error_min_age'); }
        if (!$error && $rmaxage  < 0) { $error = TRUE; $txterror .= $page->lang('admin_general_block_register_error_max_age'); }
        if (!$error && $lremember  < 0) { $error = TRUE; $txterror .= $page->lang('admin_txt_must_choose_option'); }

    }
    
    if ($ajax_action == 'email') {

        $fromname = isset($_POST['frn']) ? (trim($_POST['frn'])) : '';
        $fromname = $the_sanitaze->str_nohtml($fromname);

        $fromemail = isset($_POST['fre']) ? (trim($_POST['fre'])) : '';
        $fromemail = $the_sanitaze->email($fromemail);

        if (!$error && empty($fromname)) { $error = TRUE; $txterror .= $page->lang('admin_general_block_foremail_error_fromname'); }
        if (!$error && empty($fromemail)) { $error = TRUE; $txterror .= $page->lang('admin_general_block_foremail_error_fromemail'); }

    }
    
    if ($ajax_action == 'phpmailer') {

        $wphpmailer = isset($_POST['wphpm']) ? (trim($_POST['wphpm'])) : -1;
        $wphpmailer = $the_sanitaze->int($wphpmailer);

        $mailhost = isset($_POST['mhost']) ? (trim($_POST['mhost'])) : '';
        $mailhost = $the_sanitaze->str_nohtml($mailhost);

        $mailport = isset($_POST['mport']) ? (trim($_POST['mport'])) : '';
        $mailport = $the_sanitaze->str_nohtml($mailport);

        $musername = isset($_POST['muser']) ? (trim($_POST['muser'])) : '';
        $musername = $the_sanitaze->email($musername);

        $mpassword = isset($_POST['mpass']) ? (trim($_POST['mpass'])) : '';
        $mpassword = $the_sanitaze->str_nohtml($mpassword);

        if (!$error && $wphpmailer < 0) { $error = TRUE; $txterror .= $page->lang('admin_txt_must_choose_option'); }
        if (!$error && empty($mailhost)) { $error = TRUE; $txterror .= $page->lang('admin_general_block_withphpmailer_error_mailhost'); }
        if (!$error && empty($mailport)) { $error = TRUE; $txterror .= $page->lang('admin_general_block_withphpmailer_error_mailport'); }
        if (!$error && empty($musername)) { $error = TRUE; $txterror .= $page->lang('admin_general_block_withphpmailer_error_username'); }
        if (!$error && empty($mpassword)) { $error = TRUE; $txterror .= $page->lang('admin_general_block_withphpmailer_error_password'); }

    } 
    
    if ($ajax_action == 'fblogin') {

        $wfblogin = isset($_POST['wfbl']) ? (trim($_POST['wfbl'])) : -1;
        $wfblogin = $the_sanitaze->int($wfblogin);
        
        if ($wfblogin == 1) {

            $fbappid = isset($_POST['fbapi']) ? (trim($_POST['fbapi'])) : '';
            $fbappid = $the_sanitaze->str_nohtml($fbappid);
    
            $appsecret = isset($_POST['fbsec']) ? (trim($_POST['fbsec'])) : '';
            $appsecret = $the_sanitaze->str_nohtml($appsecret);
            
        } else {
            $fbappid = '';
            $appsecret = '';
        }

        if (!$error && $wfblogin < 0) { $error = TRUE; $txterror .= $page->lang('admin_txt_must_choose_option'); }
        if ($wfblogin == 1) {
            if (!$error && empty($fbappid)) { $error = TRUE; $txterror .= $page->lang('admin_general_block_fblogin_error_appid'); }
            if (!$error && empty($appsecret)) { $error = TRUE; $txterror .= $page->lang('admin_general_block_fblogin_error_appsecret'); }
        }
    }
    
    if ($ajax_action == 'twlogin') {

        $withtwlogin = isset($_POST['wtwl']) ? (trim($_POST['wtwl'])) : -1;
        $withtwlogin = $the_sanitaze->int($withtwlogin);
        
        if ($withtwlogin == 1) {

            $twappid = isset($_POST['twapi']) ? (trim($_POST['twapi'])) : '';
            $twappid = $the_sanitaze->str_nohtml($twappid);
    
            $twappsecret = isset($_POST['twsec']) ? (trim($_POST['twsec'])) : '';
            $twappsecret = $the_sanitaze->str_nohtml($twappsecret);

            $twdomain = isset($_POST['twdom']) ? (trim($_POST['twdom'])) : '';
            $twdomain = $the_sanitaze->str_nohtml($twdomain);
            
        } else {
            $twappid = '';
            $twappsecret = '';
            $twdomain = '';
        }

        if (!$error && $withtwlogin < 0) { $error = TRUE; $txterror .= $page->lang('admin_txt_must_choose_option'); }
        if ($withtwlogin == 1) {
            if (!$error && empty($twappid)) { $error = TRUE; $txterror .= $page->lang('admin_general_block_twlogin_error_appid'); }
            if (!$error && empty($twappsecret)) { $error = TRUE; $txterror .= $page->lang('admin_general_block_twlogin_error_appsecret'); }
            if (!$error && empty($twdomain)) { $error = TRUE; $txterror .= $page->lang('admin_general_block_twlogin_error_domain'); }
        }
    } 

    if ($ajax_action == 'theme') {

        $thetheme = isset($_POST['them']) ? (trim($_POST['them'])) : '';
        $thetheme = $the_sanitaze->str_nohtml($thetheme);

    	if (!$error && empty($thetheme)) { $error = TRUE; $txterror .= $page->lang('admin_txt_must_choose_option'); }

    }

    if ($ajax_action == 'language') {

        $thelang = isset($_POST['lang']) ? (trim($_POST['lang'])) : '';
        $thelang = $the_sanitaze->str_nohtml($thelang);

    	if (!$error && empty($thelang)) { $error = TRUE; $txterror .= $page->lang('admin_txt_must_choose_option'); }

    }
    
    if ($ajax_action == 'timezone') {

        $timez = isset($_POST['timez']) ? (trim($_POST['timez'])) : '';
        $timez = $the_sanitaze->str_nohtml($timez);

    	if (!$error && empty($timez)) { $error = TRUE; $txterror .= $page->lang('admin_txt_must_choose_option'); }

    }

    if ($ajax_action == 'addcatpage') {

        $namecat = isset($_POST['ncat']) ? (trim($_POST['ncat'])) : '';
        $namecat = $the_sanitaze->str_nohtml($namecat);

    	if (!$error && empty($namecat)) { $error = TRUE; $txterror .= $page->lang('admin_pages_categories_add_error_name'); }

    }

    if ($ajax_action == 'deletecatpage') {

        $idcat = isset($_POST['idcat']) ? (trim($_POST['idcat'])) : -1;
        $idcat = $the_sanitaze->int($idcat);

    	if (!$error && $idcat == -1) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'updatecatpage') {

        $idcat = isset($_POST['icat']) ? (trim($_POST['icat'])) : -1;
        $idcat = $the_sanitaze->int($idcat);
        $namecat = isset($_POST['ncat']) ? (trim($_POST['ncat'])) : '';
        $namecat = $the_sanitaze->str_nohtml($namecat);

    	if (!$error && $idcat == -1) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($namecat)) { $error = TRUE; $txterror .= $page->lang('admin_pages_categories_edit_error_name'); }
        
    }

    if ($ajax_action == 'addsubcatpage') {

        $namecat = isset($_POST['ncat']) ? (trim($_POST['ncat'])) : '';
        $namecat = $the_sanitaze->str_nohtml($namecat);

        $idcat = isset($_POST['idc']) ? (trim($_POST['idc'])) : 0;
        $idcat = $the_sanitaze->int($idcat);

    	if (!$error && empty($namecat)) { $error = TRUE; $txterror .= $page->lang('admin_pages_categories_add_error_name'); }
    	if (!$error && $idcat == 0) { $error = TRUE; $txterror .= 'Error'; }

    }

    if ($ajax_action == 'deletesubcatpage') {

        $idscat = isset($_POST['idscat']) ? (trim($_POST['idscat'])) : -1;
        $idscat = $the_sanitaze->int($idscat);

    	if (!$error && $idscat == -1) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'updatesubcatpage') {

        $idscat = isset($_POST['iscat']) ? (trim($_POST['iscat'])) : -1;
        $idscat = $the_sanitaze->int($idscat);
        $namescat = isset($_POST['nscat']) ? (trim($_POST['nscat'])) : '';
        $namescat = $the_sanitaze->str_nohtml($namescat);

    	if (!$error && $idscat == -1) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($namescat)) { $error = TRUE; $txterror .= $page->lang('admin_pages_subcategories_add_error_name'); }
        
    }


    
    if ($ajax_action == 'addcatproduct') {

        $namecat = isset($_POST['ncat']) ? (trim($_POST['ncat'])) : '';
        $namecat = $the_sanitaze->str_nohtml($namecat);

    	if (!$error && empty($namecat)) { $error = TRUE; $txterror .= $page->lang('admin_products_categories_add_error_name'); }

    }

    if ($ajax_action == 'deletecatproduct') {

        $idcat = isset($_POST['idcat']) ? (trim($_POST['idcat'])) : -1;
        $idcat = $the_sanitaze->int($idcat);

    	if (!$error && $idcat == -1) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'updatecatproduct') {

        $idcat = isset($_POST['icat']) ? (trim($_POST['icat'])) : -1;
        $idcat = $the_sanitaze->int($idcat);
        $namecat = isset($_POST['ncat']) ? (trim($_POST['ncat'])) : '';
        $namecat = $the_sanitaze->str_nohtml($namecat);

    	if (!$error && $idcat == -1) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($namecat)) { $error = TRUE; $txterror .= $page->lang('admin_products_categories_edit_error_name'); }
        
    }

    if ($ajax_action == 'addsubcatproduct') {

        $namecat = isset($_POST['ncat']) ? (trim($_POST['ncat'])) : '';
        $namecat = $the_sanitaze->str_nohtml($namecat);

        $idcat = isset($_POST['idc']) ? (trim($_POST['idc'])) : 0;
        $idcat = $the_sanitaze->int($idcat);

    	if (!$error && empty($namecat)) { $error = TRUE; $txterror .= $page->lang('admin_products_categories_add_error_name'); }
    	if (!$error && $idcat == 0) { $error = TRUE; $txterror .= 'Error'; }

    }

    if ($ajax_action == 'deletesubcatproduct') {

        $idscat = isset($_POST['idscat']) ? (trim($_POST['idscat'])) : -1;
        $idscat = $the_sanitaze->int($idscat);

    	if (!$error && $idscat == -1) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'updatesubcatproduct') {

        $idscat = isset($_POST['iscat']) ? (trim($_POST['iscat'])) : -1;
        $idscat = $the_sanitaze->int($idscat);
        $namescat = isset($_POST['nscat']) ? (trim($_POST['nscat'])) : '';
        $namescat = $the_sanitaze->str_nohtml($namescat);

    	if (!$error && $idscat == -1) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($namescat)) { $error = TRUE; $txterror .= $page->lang('admin_products_subcategories_add_error_name'); }
        
    }


    if ($ajax_action == 'addcatarticle') {

        $namecat = isset($_POST['ncat']) ? (trim($_POST['ncat'])) : '';
        $namecat = $the_sanitaze->str_nohtml($namecat);

    	if (!$error && empty($namecat)) { $error = TRUE; $txterror .= $page->lang('admin_articles_categories_add_error_name'); }

    }

    if ($ajax_action == 'deletecatarticle') {

        $idcat = isset($_POST['idcat']) ? (trim($_POST['idcat'])) : -1;
        $idcat = $the_sanitaze->int($idcat);

    	if (!$error && $idcat == -1) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'updatecatarticle') {

        $idcat = isset($_POST['icat']) ? (trim($_POST['icat'])) : -1;
        $idcat = $the_sanitaze->int($idcat);
        $namecat = isset($_POST['ncat']) ? (trim($_POST['ncat'])) : '';
        $namecat = $the_sanitaze->str_nohtml($namecat);

    	if (!$error && $idcat == -1) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($namecat)) { $error = TRUE; $txterror .= $page->lang('admin_articles_categories_edit_error_name'); }
        
    }

    if ($ajax_action == 'addsubcatarticle') {

        $namecat = isset($_POST['ncat']) ? (trim($_POST['ncat'])) : '';
        $namecat = $the_sanitaze->str_nohtml($namecat);

        $idcat = isset($_POST['idc']) ? (trim($_POST['idc'])) : 0;
        $idcat = $the_sanitaze->int($idcat);

    	if (!$error && empty($namecat)) { $error = TRUE; $txterror .= $page->lang('admin_articles_categories_add_error_name'); }
    	if (!$error && $idcat == 0) { $error = TRUE; $txterror .= 'Error'; }

    }

    if ($ajax_action == 'deletesubcatarticle') {

        $idscat = isset($_POST['idscat']) ? (trim($_POST['idscat'])) : -1;
        $idscat = $the_sanitaze->int($idscat);

    	if (!$error && $idscat == -1) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'updatesubcatarticle') {

        $idscat = isset($_POST['iscat']) ? (trim($_POST['iscat'])) : -1;
        $idscat = $the_sanitaze->int($idscat);
        $namescat = isset($_POST['nscat']) ? (trim($_POST['nscat'])) : '';
        $namescat = $the_sanitaze->str_nohtml($namescat);

    	if (!$error && $idscat == -1) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($namescat)) { $error = TRUE; $txterror .= $page->lang('admin_articles_subcategories_add_error_name'); }
        
    }

    if ($ajax_action == 'usergeneral') {
        
        $verify = isset($_POST['ver']) ? (trim($_POST['ver'])) : -1;
        $verify = $the_sanitaze->int($verify);

        $status = isset($_POST['sta']) ? (trim($_POST['sta'])) : -1;
        $status = $the_sanitaze->int($status);

        $level = isset($_POST['lev']) ? (trim($_POST['lev'])) : -1;
        $level = $the_sanitaze->int($level);

        $iduser = isset($_POST['idu']) ? (trim($_POST['idu'])) : -1;
        $iduser = $the_sanitaze->int($iduser);

    	if (!$error && $verify == -1) { $error = TRUE; $txterror .= $page->lang('admin_txt_must_choose_option'); }
    	if (!$error && $status == -1) { $error = TRUE; $txterror .= $page->lang('admin_txt_must_choose_option'); }
    	if (!$error && $level == -1) { $error = TRUE; $txterror .= $page->lang('admin_txt_must_choose_option'); }
    	if (!$error && $iduser == -1) { $error = TRUE; $txterror .= 'Error. '; }
        
    }

    if ($ajax_action == 'userprofile') {
        
        $firstname = isset($_POST['fn']) ? (trim($_POST['fn'])) : '';
        $firstname = $the_sanitaze->str_nohtml($firstname);

        $lastname = isset($_POST['ln']) ? (trim($_POST['ln'])) : '';
        $lastname = $the_sanitaze->str_nohtml($lastname);

        $gender = isset($_POST['ge']) ? (trim($_POST['ge'])) : 0;
        $gender = $the_sanitaze->int($gender);

        $birthday = isset($_POST['bi']) ? (trim($_POST['bi'])) : '';
        $birthday = $the_sanitaze->str_nohtml($birthday);
        
        $currentcity = isset($_POST['cc']) ? (trim($_POST['cc'])) : '';
        $currentcity = $the_sanitaze->str_nohtml($currentcity);

        $hometown = isset($_POST['ht']) ? (trim($_POST['ht'])) : '';
        $hometown = $the_sanitaze->str_nohtml($hometown);

        $iduser = isset($_POST['idu']) ? (trim($_POST['idu'])) : -1;
        $iduser = $the_sanitaze->int($iduser);
        
        if (!$error && empty($firstname)) { $error = TRUE; $txterror .= $page->lang('admin_users_edit_block_profile_error_firstname'); }
        if (!$error && empty($lastname)) { $error = TRUE; $txterror .= $page->lang('admin_users_edit_block_profile_error_lastname'); }
        if (!$error && $gender <= 0) { $error = TRUE; $txterror .= $page->lang('admin_users_edit_block_profile_error_sex'); }
        if (!$error && empty($birthday)) { $error = TRUE; $txterror .= $page->lang('admin_users_edit_block_profile_error_birthday2'); }
        if (!$error && empty($currentcity)) { $error = TRUE; $txterror .= $page->lang('admin_users_edit_block_profile_error_currentcity'); }
        if (!$error && empty($hometown)) { $error = TRUE; $txterror .= $page->lang('admin_users_edit_block_profile_error_hometown'); }
    	if (!$error && $iduser == -1) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'useremail') {

        $email = isset($_POST['em']) ? (trim($_POST['em'])) : '';
        $email = $the_sanitaze->email($email);

        $iduser = isset($_POST['idu']) ? (trim($_POST['idu'])) : -1;
        $iduser = $the_sanitaze->int($iduser);

    	if (!$error && empty($email)) { $error = TRUE; $txterror .= $page->lang('admin_users_edit_block_email_error_email'); }
    	if (!$error && $iduser == -1) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'userusername') {

        $username = isset($_POST['un']) ? (trim($_POST['un'])) : '';
        $username = $the_sanitaze->str_nohtml($username);

        $iduser = isset($_POST['idu']) ? (trim($_POST['idu'])) : -1;
        $iduser = $the_sanitaze->int($iduser);
        
        if (!$error && empty($username)) { $error = TRUE; $txterror .= $page->lang('admin_users_edit_block_username_error_username'); }
        
        if (!$error && !validateUsername($username)) { $error = TRUE; $txterror .= $page->lang('admin_users_edit_block_username_error_notvalid'); }

    	if (!$error && $iduser == -1) { $error = TRUE; $txterror .= 'Error. '; }
        
    }

    if ($ajax_action == 'userpassword') {

        $pnew = isset($_POST['pn']) ? (trim($_POST['pn'])) : '';
        $pnew = $the_sanitaze->str_nohtml($pnew);

        $iduser = isset($_POST['idu']) ? (trim($_POST['idu'])) : -1;
        $iduser = $the_sanitaze->int($iduser);
        
        if (!$error && empty($pnew)) { $error = TRUE; $txterror .= $page->lang('setting_account_block_password_error_new'); }
    	if (!$error && $iduser == -1) { $error = TRUE; $txterror .= 'Error. '; }
        
    }
    
    if ($ajax_action == 'userprivacy') {

        $ppro = isset($_POST['ppro']) ? (trim($_POST['ppro'])) : 0;
        $ppro = $the_sanitaze->int($ppro);

        $pwri = isset($_POST['pwri']) ? (trim($_POST['pwri'])) : 0;
        $pwri = $the_sanitaze->int($pwri);

        $psfr = isset($_POST['ppro']) ? (trim($_POST['psfr'])) : 0;
        $psfr = $the_sanitaze->int($psfr);

        $pspa = isset($_POST['pspa']) ? (trim($_POST['pspa'])) : 0;
        $pspa = $the_sanitaze->int($pspa);

        $psgr = isset($_POST['psgr']) ? (trim($_POST['psgr'])) : 0;
        $psgr = $the_sanitaze->int($psgr);

        $pmes = isset($_POST['pmes']) ? (trim($_POST['pmes'])) : 0;
        $pmes = $the_sanitaze->int($pmes);
        
        $pbir = isset($_POST['pbir']) ? (trim($_POST['pbir'])) : 0;
        $pbir = $the_sanitaze->int($pbir);

        $ploc = isset($_POST['ploc']) ? (trim($_POST['ploc'])) : 0;
        $ploc = $the_sanitaze->int($ploc);

        $pabo = isset($_POST['pabo']) ? (trim($_POST['pabo'])) : 0;
        $pabo = $the_sanitaze->int($pabo);
        
        $pcha = isset($_POST['pcha']) ? (trim($_POST['pcha'])) : 0;
        $pcha = $the_sanitaze->int($pcha);

        $iduser = isset($_POST['idu']) ? (trim($_POST['idu'])) : -1;
        $iduser = $the_sanitaze->int($iduser);

        if (!$error && $ppro < 0) { $error = TRUE; $txterror .= $page->lang('setting_privacy_error_msg'); }
        if (!$error && $pwri < 0) { $error = TRUE; $txterror .= $page->lang('setting_privacy_error_msg'); }
        if (!$error && $psfr < 0) { $error = TRUE; $txterror .= $page->lang('setting_privacy_error_msg'); }
        if (!$error && $pspa < 0) { $error = TRUE; $txterror .= $page->lang('setting_privacy_error_msg'); }
        if (!$error && $psgr < 0) { $error = TRUE; $txterror .= $page->lang('setting_privacy_error_msg'); }
        if (!$error && $pmes < 0) { $error = TRUE; $txterror .= $page->lang('setting_privacy_error_msg'); }
        if (!$error && $pbir < 0) { $error = TRUE; $txterror .= $page->lang('setting_privacy_error_msg'); }
        if (!$error && $ploc < 0) { $error = TRUE; $txterror .= $page->lang('setting_privacy_error_msg'); }
        if (!$error && $pabo < 0) { $error = TRUE; $txterror .= $page->lang('setting_privacy_error_msg'); }
        if (!$error && $pcha < 0) { $error = TRUE; $txterror .= $page->lang('setting_privacy_error_msg'); }
    	if (!$error && $iduser == -1) { $error = TRUE; $txterror .= 'Error. '; }
                
    }

    if ($ajax_action == 'deleteuser') {

        $iduser = isset($_POST['iduser']) ? (trim($_POST['iduser'])) : -1;
        $iduser = $the_sanitaze->int($iduser);

    	if (!$error && $iduser == -1) { $error = TRUE; $txterror .= 'Error. '; }

    }


    if ($ajax_action == 'updatepagesgeneral') {

        $verify = isset($_POST['ver']) ? (trim($_POST['ver'])) : -1;
        $verify = $the_sanitaze->int($verify);

        $idcategory = isset($_POST['pic']) ? (trim($_POST['pic'])) : '';
        $idcategory = $the_sanitaze->int($idcategory);

        $idsubcategory = isset($_POST['pisc']) ? (trim($_POST['pisc'])) : '';
        $idsubcategory = $the_sanitaze->int($idsubcategory);

        $titlepage = isset($_POST['pti']) ? (trim($_POST['pti'])) : '';
        $titlepage = $the_sanitaze->str_nohtml($titlepage);
    
        $urlpage = isset($_POST['pur']) ? (trim($_POST['pur'])) : '';
        $urlpage = $the_sanitaze->str_nohtml($urlpage);
    
        $descriptionpage = isset($_POST['pds']) ? (trim($_POST['pds'])) : '';
        $descriptionpage = $the_sanitaze->str_nohtml($descriptionpage);

        $idpage = isset($_POST['idp']) ? (trim($_POST['idp'])) : -1;
        $idpage = $the_sanitaze->int($idpage);

    	if (!$error && $verify == -1) { $error = TRUE; $txterror .= $page->lang('admin_txt_must_choose_option'); }        
		if (!$error && !is_numeric($idcategory)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && !is_numeric($idsubcategory)) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($titlepage)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && (empty($urlpage) || !validateUsernamePageOrGroup($urlpage))) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && nameInConflict($urlpage)) { $error = TRUE; $txterror .= $page->lang('admin_pages_edit_block_general_error_username_not_available'); }
		if (!$error && empty($descriptionpage)) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && $idpage == -1) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'deletepage') {

        $idpage = isset($_POST['idpage']) ? (trim($_POST['idpage'])) : -1;
        $idpage = $the_sanitaze->int($idpage);

    	if (!$error && $idpage == -1) { $error = TRUE; $txterror .= 'Error. '; }

    }


    if ($ajax_action == 'updategroupsgeneral') {

        $titlegroup = isset($_POST['gti']) ? (trim($_POST['gti'])) : '';
        $titlegroup = $the_sanitaze->str_nohtml($titlegroup);
    
        $urlgroup = isset($_POST['gur']) ? (trim($_POST['gur'])) : '';
        $urlgroup = $the_sanitaze->str_nohtml($urlgroup);
    
        $descriptiongroup = isset($_POST['gds']) ? (trim($_POST['gds'])) : '';
        $descriptiongroup = $the_sanitaze->str_nohtml($descriptiongroup);
    
        $privacygroup = isset($_POST['gpr']) ? (trim($_POST['gpr'])) : '';
        $privacygroup = $the_sanitaze->int($privacygroup);

        $idgroup = isset($_POST['idg']) ? (trim($_POST['idg'])) : -1;
        $idgroup = $the_sanitaze->int($idgroup);
        
    	if (!$error && empty($titlegroup)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && (empty($urlgroup) || !validateUsernamePageOrGroup($urlgroup))) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && nameInConflict($urlgroup)) { $error = TRUE; $txterror .= $page->lang('admin_groups_edit_block_error_username_not_available'); }
		if (!$error && empty($descriptiongroup)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && !is_numeric($privacygroup)) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && $idgroup == -1) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'deletegroup') {

        $idgroup = isset($_POST['idgroup']) ? (trim($_POST['idgroup'])) : -1;
        $idgroup = $the_sanitaze->int($idgroup);

    	if (!$error && $idgroup == -1) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'addstaticpage') {

        $urlstatic = isset($_POST['us']) ? (trim($_POST['us'])) : '';
        $urlstatic = $the_sanitaze->str_nohtml($urlstatic);

        $titlestatic = isset($_POST['ts']) ? (trim($_POST['ts'])) : '';
        $titlestatic = $the_sanitaze->str_nohtml($titlestatic);

        $htmlstatic = isset($_POST['hs']) ? (trim($_POST['hs'])) : '';

        $infootstatic = isset($_POST['ifs']) ? (trim($_POST['ifs'])) : -1;
        $infootstatic = $the_sanitaze->int($infootstatic);

        if (!$error && empty($urlstatic)) { $error = TRUE; $txterror .= $page->lang('admin_static_pages_add_error_url'); }
        if (!$error && empty($titlestatic)) { $error = TRUE; $txterror .= $page->lang('admin_static_pages_add_error_thetitle'); }
        if (!$error && empty($htmlstatic)) { $error = TRUE; $txterror .= $page->lang('admin_static_pages_add_error_html'); }
        if (!$error && $infootstatic  < 0) { $error = TRUE; $txterror .= $page->lang('admin_txt_must_choose_option'); }

    }

    if ($ajax_action == 'updatestaticpage') {

        $urlstatic = isset($_POST['us']) ? (trim($_POST['us'])) : '';
        $urlstatic = $the_sanitaze->str_nohtml($urlstatic);

        $titlestatic = isset($_POST['ts']) ? (trim($_POST['ts'])) : '';
        $titlestatic = $the_sanitaze->str_nohtml($titlestatic);

        $htmlstatic = isset($_POST['hs']) ? (trim($_POST['hs'])) : '';

        $infootstatic = isset($_POST['ifs']) ? (trim($_POST['ifs'])) : -1;
        $infootstatic = $the_sanitaze->int($infootstatic);

        $idstatic = isset($_POST['ids']) ? (trim($_POST['ids'])) : -1;
        $idstatic = $the_sanitaze->int($idstatic);

        if (!$error && empty($urlstatic)) { $error = TRUE; $txterror .= $page->lang('admin_static_pages_add_error_url'); }
        if (!$error && empty($titlestatic)) { $error = TRUE; $txterror .= $page->lang('admin_static_pages_add_error_thetitle'); }
        if (!$error && empty($htmlstatic)) { $error = TRUE; $txterror .= $page->lang('admin_static_pages_add_error_html'); }
        if (!$error && $infootstatic < 0) { $error = TRUE; $txterror .= $page->lang('admin_txt_must_choose_option'); }
        if (!$error && $idstatic < 0) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'deletestaticpage') {

        $idsp = isset($_POST['idsp']) ? (trim($_POST['idsp'])) : -1;
        $idsp = $the_sanitaze->int($idsp);

    	if (!$error && $idsp == -1) { $error = TRUE; $txterror .= 'Error. '; }

    }
    
    if ($ajax_action == 'addcurrency') {

        $namecurrency = isset($_POST['namec']) ? (trim($_POST['namec'])) : '';
        $namecurrency = $the_sanitaze->str_nohtml($namecurrency);

        $codecurrency = isset($_POST['codec']) ? (trim($_POST['codec'])) : '';
        $codecurrency = $the_sanitaze->str_nohtml($codecurrency);

        $symbolcurrency = isset($_POST['symbc']) ? (trim($_POST['symbc'])) : '';
        $symbolcurrency = $the_sanitaze->str_nohtml($symbolcurrency);

    	if (!$error && empty($namecurrency)) { $error = TRUE; $txterror .= $page->lang('admin_currencies_add_error_name'); }
    	if (!$error && empty($codecurrency)) { $error = TRUE; $txterror .= $page->lang('admin_currencies_add_error_code'); }
    	if (!$error && empty($symbolcurrency)) { $error = TRUE; $txterror .= $page->lang('admin_currencies_add_error_symbol'); }

    }
    
    if ($ajax_action == 'deletecurrency') {

        $idc = isset($_POST['idc']) ? (trim($_POST['idc'])) : -1;
        $idc = $the_sanitaze->int($idc);

    	if (!$error && $idc == -1) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'updatecurrency') {

        $idc = isset($_POST['idc']) ? (trim($_POST['idc'])) : -1;
        $idc = $the_sanitaze->int($idc);

        $namecurrency = isset($_POST['namec']) ? (trim($_POST['namec'])) : '';
        $namecurrency = $the_sanitaze->str_nohtml($namecurrency);

        $codecurrency = isset($_POST['codec']) ? (trim($_POST['codec'])) : '';
        $codecurrency = $the_sanitaze->str_nohtml($codecurrency);

        $symbolcurrency = isset($_POST['symbc']) ? (trim($_POST['symbc'])) : '';
        $symbolcurrency = $the_sanitaze->str_nohtml($symbolcurrency);

    	if (!$error && empty($namecurrency)) { $error = TRUE; $txterror .= $page->lang('admin_currencies_add_error_name'); }
    	if (!$error && empty($codecurrency)) { $error = TRUE; $txterror .= $page->lang('admin_currencies_add_error_code'); }
    	if (!$error && empty($symbolcurrency)) { $error = TRUE; $txterror .= $page->lang('admin_currencies_add_error_symbol'); }
    	if (!$error && $idc == -1) { $error = TRUE; $txterror .= 'Error. '; }
        
    }
    
    if ($ajax_action == 'createads') {
        
        $slot = isset($_POST['slot']) ? (trim($_POST['slot'])) : '';
        $slot = $the_sanitaze->int($slot);
        
        $nameads = isset($_POST['namea']) ? (trim($_POST['namea'])) : '';
        $nameads = $the_sanitaze->str_nohtml($nameads);
        
        $target = isset($_POST['tara']) ? (trim($_POST['tara'])) : '';
        $target = $the_sanitaze->int($target);
    
        $urlads = isset($_POST['urla']) ? (trim($_POST['urla'])) : '';
        $urlads = $the_sanitaze->str_nohtml($urlads);
    
        $the_photo = $_FILES['imagenfile'];
    
		if (!$error && $slot <= 0) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($nameads)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $target < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($urlads)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($the_photo)) { $error = TRUE; $txterror .= 'Error. '; }

    }
    
    if ($ajax_action == 'deleteads') {

        $idbasic = isset($_POST['idbasic']) ? (trim($_POST['idbasic'])) : -1;
        $idbasic = $the_sanitaze->int($idbasic);

    	if (!$error && $idbasic == -1) { $error = TRUE; $txterror .= 'Error. '; }
        
    }
    
    if ($ajax_action == 'updateads') {

        $idads = isset($_POST['idads']) ? (trim($_POST['idads'])) : -1;
        $idads = $the_sanitaze->int($idads);
        
        $slot = isset($_POST['slot']) ? (trim($_POST['slot'])) : '';
        $slot = $the_sanitaze->int($slot);
        
        $nameads = isset($_POST['namea']) ? (trim($_POST['namea'])) : '';
        $nameads = $the_sanitaze->str_nohtml($nameads);
        
        $target = isset($_POST['tara']) ? (trim($_POST['tara'])) : '';
        $target = $the_sanitaze->int($target);

        $status = isset($_POST['status']) ? (trim($_POST['status'])) : '';
        $status = $the_sanitaze->int($status);
    
        $urlads = isset($_POST['urla']) ? (trim($_POST['urla'])) : '';
        $urlads = $the_sanitaze->str_nohtml($urlads);
        
        $dochange = isset($_POST['chgi']) ? (trim($_POST['chgi'])) : '';
        $dochange = $the_sanitaze->str_nohtml($dochange);

        if ($dochange == '1') {    
            $the_photo = $_FILES['imagenfile'];
        }
    
		if (!$error && $idads <= 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $slot <= 0) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($nameads)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $target < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $status < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($urlads)) { $error = TRUE; $txterror .= 'Error. '; }
        if ($dochange == '1') {
		    if (!$error && empty($the_photo)) { $error = TRUE; $txterror .= 'Error. '; }
        }

    }
    
    if ($ajax_action == 'creategame') {
        
        $namegame = isset($_POST['nameg']) ? (trim($_POST['nameg'])) : '';
        $namegame = $the_sanitaze->str_nohtml($namegame);
    
        $urlgame = isset($_POST['urlgm']) ? (trim($_POST['urlgm'])) : '';
        $urlgame = $the_sanitaze->str_nohtml($urlgame);
        
        $urlowner = isset($_POST['urlow']) ? (trim($_POST['urlow'])) : '';
        $urlowner = $the_sanitaze->str_nohtml($urlowner);
    
        $the_photo = $_FILES['imagenfile'];

    	if (!$error && empty($namegame)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($urlgame)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($urlowner)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($the_photo)) { $error = TRUE; $txterror .= 'Error. '; }

    }
    
    if ($ajax_action == 'deletegame') {

        $idgame = isset($_POST['idg']) ? (trim($_POST['idg'])) : -1;
        $idgame = $the_sanitaze->int($idgame);

    	if (!$error && $idgame == -1) { $error = TRUE; $txterror .= 'Error. '; }
        
    }
    
    if ($ajax_action == 'updategame') {

        $idgame = isset($_POST['idgam']) ? (trim($_POST['idgam'])) : -1;
        $idgame = $the_sanitaze->int($idgame);
        
        $namegame = isset($_POST['nameg']) ? (trim($_POST['nameg'])) : '';
        $namegame = $the_sanitaze->str_nohtml($namegame);
    
        $urlgame = isset($_POST['urlgm']) ? (trim($_POST['urlgm'])) : '';
        $urlgame = $the_sanitaze->str_nohtml($urlgame);
        
        $urlowner = isset($_POST['urlow']) ? (trim($_POST['urlow'])) : '';
        $urlowner = $the_sanitaze->str_nohtml($urlowner);

        $status = isset($_POST['status']) ? (trim($_POST['status'])) : '';
        $status = $the_sanitaze->int($status);
    
        $dochange = isset($_POST['chgi']) ? (trim($_POST['chgi'])) : '';
        $dochange = $the_sanitaze->str_nohtml($dochange);

        if ($dochange == '1') {    
            $the_photo = $_FILES['imagenfile'];
        }
    
		if (!$error && $idgame <= 0) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($namegame)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($urlgame)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($urlowner)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $status < 0) { $error = TRUE; $txterror .= 'Error. '; }
        if ($dochange == '1') {
		    if (!$error && empty($the_photo)) { $error = TRUE; $txterror .= 'Error. '; }
        }

    }
    
    if ($ajax_action == 'updateproduct') {

        $idproduct = isset($_POST['idpr']) ? (trim($_POST['idpr'])) : '';
        $idproduct = $the_sanitaze->int($idproduct);      
        
        $nameproduct = isset($_POST['namp']) ? (trim($_POST['namp'])) : '';
        $nameproduct = $the_sanitaze->str_nohtml($nameproduct);

        $descriptionproduct = isset($_POST['desp']) ? (trim($_POST['desp'])) : '';
        $descriptionproduct = $the_sanitaze->str_nohtml($descriptionproduct);
        
        $idcategory = isset($_POST['idcp']) ? (trim($_POST['idcp'])) : '';
        $idcategory = $the_sanitaze->int($idcategory);

        $idsubcategory = isset($_POST['idsp']) ? (trim($_POST['idsp'])) : '';
        $idsubcategory = $the_sanitaze->int($idsubcategory);

        $typeproduct = isset($_POST['typp']) ? (trim($_POST['typp'])) : '';
        $typeproduct = $the_sanitaze->int($typeproduct);

        $currencyproduct = isset($_POST['curp']) ? (trim($_POST['curp'])) : '';
        $currencyproduct = $the_sanitaze->int($currencyproduct);

        $priceproduct = isset($_POST['prip']) ? (trim($_POST['prip'])) : '';
        $priceproduct = $the_sanitaze->float($priceproduct);
    
        $locationproduct = isset($_POST['locp']) ? (trim($_POST['locp'])) : '';
        $locationproduct = $the_sanitaze->str_nohtml($locationproduct);

		if (!$error && $idproduct < 0) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($nameproduct)) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($descriptionproduct)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $idcategory < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $idsubcategory < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $typeproduct < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $currencyproduct < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $priceproduct < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($locationproduct)) { $error = TRUE; $txterror .= 'Error. '; }

    }
    
    if ($ajax_action == 'deleteproduct') {

        $idproduct = isset($_POST['idp']) ? (trim($_POST['idp'])) : -1;
        $idproduct = $the_sanitaze->int($idproduct);

    	if (!$error && $idproduct == -1) { $error = TRUE; $txterror .= 'Error. '; }

    }
    
    if ($ajax_action == 'updatearticle') {

        $idarticle = isset($_POST['idea']) ? (trim($_POST['idea'])) : '';
        $idarticle = $the_sanitaze->int($idarticle);      
        
        $titlearticle = isset($_POST['tta']) ? (trim($_POST['tta'])) : '';
        $titlearticle = $the_sanitaze->str_nohtml($titlearticle);
        
        $idcategory = isset($_POST['idca']) ? (trim($_POST['idca'])) : '';
        $idcategory = $the_sanitaze->int($idcategory);

        $idsubcategory = isset($_POST['idsca']) ? (trim($_POST['idsca'])) : '';
        $idsubcategory = $the_sanitaze->int($idsubcategory);
    
        $summaryarticle = isset($_POST['smrya']) ? (trim($_POST['smrya'])) : '';
        $summaryarticle = $the_sanitaze->str_nohtml($summaryarticle);

		if (!$error && $idarticle < 0) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($titlearticle)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $idcategory < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $idsubcategory < 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($summaryarticle)) { $error = TRUE; $txterror .= 'Error. '; }

    }
    
    if ($ajax_action == 'deletearticle') {

        $idarticle = isset($_POST['ida']) ? (trim($_POST['ida'])) : -1;
        $idarticle = $the_sanitaze->int($idarticle);

    	if (!$error && $idarticle == -1) { $error = TRUE; $txterror .= 'Error. '; }

    }
    
    if ($ajax_action == 'createadshtml') {
        
        $slot = isset($_POST['slot']) ? (trim($_POST['slot'])) : '';
        $slot = $the_sanitaze->int($slot);
        
        $nameads = isset($_POST['namea']) ? (trim($_POST['namea'])) : '';
        $nameads = $the_sanitaze->str_nohtml($nameads);
        
        $codehtml = isset($_POST['chtml']) ? (trim($_POST['chtml'])) : '';
        $codehtml = $the_sanitaze->str_nohtml($codehtml);
    
		if (!$error && $slot <= 0) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($nameads)) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($codehtml)) { $error = TRUE; $txterror .= 'Error. '; }

    }

    if ($ajax_action == 'updateadshtml') {

        $idads = isset($_POST['idads']) ? (trim($_POST['idads'])) : -1;
        $idads = $the_sanitaze->int($idads);
        
        $slot = isset($_POST['slot']) ? (trim($_POST['slot'])) : '';
        $slot = $the_sanitaze->int($slot);
        
        $nameads = isset($_POST['namea']) ? (trim($_POST['namea'])) : '';
        $nameads = $the_sanitaze->str_nohtml($nameads);
        
        $codehtml = isset($_POST['chtml']) ? (trim($_POST['chtml'])) : '';
        $codehtml = $the_sanitaze->str_nohtml($codehtml);
        
        $status = isset($_POST['status']) ? (trim($_POST['status'])) : '';
        $status = $the_sanitaze->int($status);

		if (!$error && $idads <= 0) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $slot <= 0) { $error = TRUE; $txterror .= 'Error. '; }
    	if (!$error && empty($nameads)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && empty($codehtml)) { $error = TRUE; $txterror .= 'Error. '; }
		if (!$error && $status < 0) { $error = TRUE; $txterror .= 'Error. '; }

    }
    
    if ($ajax_action == 'sidebarusers') {

        $sidebarusers = isset($_POST['sbus']) ? (trim($_POST['sbus'])) : 0;
        $sidebarusers = $the_sanitaze->int($sidebarusers);

        if (!$error && $sidebarusers <= 0) { $error = TRUE; $txterror .= $page->lang('admin_txt_must_choose_option'); }

    }

    if ($ajax_action == 'updateappandroid') {
        
        $show_app = isset($_POST['show_app']) ? (trim($_POST['show_app'])) : -1;
        $show_app = $the_sanitaze->int($show_app);

        if ($show_app == '1') {    
            $the_file_apk = $_FILES['filesapks'];
        }
    
		if (!$error && $show_app < 0) { $error = TRUE; $txterror .= 'Error. '; }

        if ($show_app == '1') {
		    if (!$error && empty($the_file_apk)) { $error = TRUE; $txterror .= 'Error. '; }
        }
        
    }
    
    if ($ajax_action == 'apigoogle') {

        $apig = isset($_POST['apig']) ? (trim($_POST['apig'])) : '';
        $apig = $the_sanitaze->str_nohtml($apig);

        if (!$error && empty($apig)) { $error = TRUE; $txterror .= 'Error. '; }

    }
    
    if ($error) {
        echo('ERROR:'.$txterror);
		return;
    } else {
        
        if ($ajax_action == 'system') {
            
            $page->db2->query("UPDATE settings SET value='".$webstatus."' WHERE word='SITE_LIVE' LIMIT 1");
            $page->db2->query("UPDATE settings SET value='".$webprivacy."' WHERE word='SITE_PRIVACY' LIMIT 1");
            $page->db2->query("UPDATE settings SET value='".$company."' WHERE word='COMPANY' LIMIT 1");
            
            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        }

        if ($ajax_action == 'seo') {
            
            $page->db2->query("UPDATE settings SET value='".$stitle."' WHERE word='SITE_TITLE' LIMIT 1");
            $page->db2->query("UPDATE settings SET value='".$skeyword."' WHERE word='SEO_KEYWORDS' LIMIT 1");
            $page->db2->query("UPDATE settings SET value='".$sdescription."' WHERE word='SEO_DESCRIPTION' LIMIT 1");
            
            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        }
        
        if ($ajax_action == 'register') {
            
            $page->db2->query("UPDATE settings SET value='".$rvalidation."' WHERE word='SIGNUP_WITH_VALIDATION' LIMIT 1");
            $page->db2->query("UPDATE settings SET value='".$rminage."' WHERE word='SIGNUP_MIN_AGE' LIMIT 1");
            $page->db2->query("UPDATE settings SET value='".$rmaxage."' WHERE word='SIGNUP_MAX_AGE' LIMIT 1");
            $page->db2->query("UPDATE settings SET value='".$lremember."' WHERE word='LOGIN_WITH_REMEMBER' LIMIT 1");
            
            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        }
        
        if ($ajax_action == 'email') {
            
            $page->db2->query("UPDATE settings SET value='".$fromname."' WHERE word='MAIL_FROMNAME' LIMIT 1");
            $page->db2->query("UPDATE settings SET value='".$fromemail."' WHERE word='MAIL_FROM' LIMIT 1");
            
            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        }

        if ($ajax_action == 'phpmailer') {
            
            $page->db2->query("UPDATE settings SET value='".$wphpmailer."' WHERE word='MAIL_WITH_PHPMAILER' LIMIT 1");
            $page->db2->query("UPDATE settings SET value='".$mailhost."' WHERE word='MAIL_HOST' LIMIT 1");
            $page->db2->query("UPDATE settings SET value='".$mailport."' WHERE word='MAIL_PORT' LIMIT 1");
            $page->db2->query("UPDATE settings SET value='".$musername."' WHERE word='MAIL_USERNAME' LIMIT 1");
            $page->db2->query("UPDATE settings SET value='".$mpassword."' WHERE word='MAIL_PASSWORD' LIMIT 1");

            
            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        } 


        if ($ajax_action == 'fblogin') {
            
            $page->db2->query("UPDATE settings SET value='".$wfblogin."' WHERE word='LOGIN_WITH_FACEBOOK' LIMIT 1");
            $page->db2->query("UPDATE settings SET value='".$fbappid."' WHERE word='FB_APPID' LIMIT 1");
            $page->db2->query("UPDATE settings SET value='".$appsecret."' WHERE word='FB_SECRET' LIMIT 1");

            
            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        }
        
        if ($ajax_action == 'twlogin') {
            
            $page->db2->query("UPDATE settings SET value='".$withtwlogin."' WHERE word='LOGIN_WITH_TWITTER' LIMIT 1");
            $page->db2->query("UPDATE settings SET value='".$twappid."' WHERE word='TW_APPID' LIMIT 1");
            $page->db2->query("UPDATE settings SET value='".$twappsecret."' WHERE word='TW_SECRET' LIMIT 1");
            $page->db2->query("UPDATE settings SET value='".$twdomain."' WHERE word='DOMAIN_EMAIL_TW' LIMIT 1");
            
            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        }


        if ($ajax_action == 'theme') {
            
            $page->db2->query("UPDATE settings SET value='".$thetheme."' WHERE word='THEME' LIMIT 1");
            
            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        }

        if ($ajax_action == 'language') {
            
            $page->db2->query("UPDATE settings SET value='".$thelang."' WHERE word='LANGUAGE' LIMIT 1");
            
            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        }
        
        if ($ajax_action == 'timezone') {
            
            $page->db2->query("UPDATE settings SET value='".$timez."' WHERE word='TIMEZONE' LIMIT 1");
            
            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        }

        if ($ajax_action == 'addcatpage') {
            
            $page->db2->query("INSERT INTO pages_cat SET name='".$namecat."'");

            echo('OK');
            return;

        }

        if ($ajax_action == 'deletecatpage') {
            
            $num_children = $page->db2->fetch_field("SELECT num_children FROM pages_cat WHERE idcategory=".$idcat." LIMIT 1");
            if ($num_children != 0) {
                echo('ERROR:'.$page->lang('admin_pages_categories_error_delete'));
            } else {
                $page->db2->query("DELETE FROM pages_cat WHERE idcategory=".$idcat);
                echo('OK');
            }
            
            return;            

        }

        if ($ajax_action == 'updatecatpage') {
            
            $page->db2->query("UPDATE pages_cat SET name='".$namecat."' WHERE idcategory=".$idcat);
            
            echo('OK');
            return;

        }

        if ($ajax_action == 'addsubcatpage') {
            
            $page->db2->query("INSERT INTO pages_cat SET idfather=".$idcat.", name='".$namecat."'");
            $page->db2->query("UPDATE pages_cat SET num_children=num_children+1 WHERE idcategory=".$idcat);

            echo('OK');
            return;

        }

        if ($ajax_action == 'deletesubcatpage') {
            
            $num_pages = $page->db2->fetch_field("SELECT count(idpage) FROM pages WHERE idsubcat=".$idscat." LIMIT 1");
            if ($num_pages != 0) {
                echo('ERROR:'.$page->lang('admin_pages_subcategories_error_delete'));
            } else {
                $idfather = $page->db2->fetch_field("SELECT idfather FROM pages_cat WHERE idcategory=".$idscat." LIMIT 1");
                $page->db2->query("DELETE FROM pages_cat WHERE idcategory=".$idscat);
                $page->db2->query("UPDATE pages_cat SET num_children=num_children-1 WHERE idcategory=".$idfather);
                echo('OK');
            }

            return;

        }

        if ($ajax_action == 'updatesubcatpage') {
            
            $page->db2->query("UPDATE pages_cat SET name='".$namescat."' WHERE idcategory=".$idscat);
            
            echo('OK');
            return;
        }

/*****/

        if ($ajax_action == 'addcatproduct') {
            
            $page->db2->query("INSERT INTO products_cat SET name='".$namecat."'");

            echo('OK');
            return;

        }

        if ($ajax_action == 'deletecatproduct') {
            
            $num_children = $page->db2->fetch_field("SELECT num_children FROM products_cat WHERE idcategory=".$idcat." LIMIT 1");
            if ($num_children != 0) {
                echo('ERROR:'.$page->lang('admin_products_categories_error_delete'));
            } else {
                $page->db2->query("DELETE FROM products_cat WHERE idcategory=".$idcat);
                echo('OK');
            }
            
            return;            

        }

        if ($ajax_action == 'updatecatproduct') {
            
            $page->db2->query("UPDATE products_cat SET name='".$namecat."' WHERE idcategory=".$idcat);
            
            echo('OK');
            return;

        }

        if ($ajax_action == 'addsubcatproduct') {
            
            $page->db2->query("INSERT INTO products_cat SET idfather=".$idcat.", name='".$namecat."'");
            $page->db2->query("UPDATE products_cat SET num_children=num_children+1 WHERE idcategory=".$idcat);

            echo('OK');
            return;

        }

        if ($ajax_action == 'deletesubcatproduct') {
            
            $num_products = $page->db2->fetch_field("SELECT count(idproduct) FROM products WHERE idsubcategory=".$idscat." LIMIT 1");
            if ($num_products != 0) {
                echo('ERROR:'.$page->lang('admin_products_subcategories_error_delete'));
            } else {
                $idfather = $page->db2->fetch_field("SELECT idfather FROM products_cat WHERE idcategory=".$idscat." LIMIT 1");
                $page->db2->query("DELETE FROM products_cat WHERE idcategory=".$idscat);
                $page->db2->query("UPDATE products_cat SET num_children=num_children-1 WHERE idcategory=".$idfather);
                echo('OK');
            }

            return;

        }

        if ($ajax_action == 'updatesubcatproduct') {
            
            $page->db2->query("UPDATE products_cat SET name='".$namescat."' WHERE idcategory=".$idscat);
            
            echo('OK');
            return;
        }


/*****/

        if ($ajax_action == 'addcatarticle') {
            
            $page->db2->query("INSERT INTO articles_cat SET name='".$namecat."'");

            echo('OK');
            return;

        }

        if ($ajax_action == 'deletecatarticle') {
            
            $num_children = $page->db2->fetch_field("SELECT num_children FROM articles_cat WHERE idcategory=".$idcat." LIMIT 1");
            if ($num_children != 0) {
                echo('ERROR:'.$page->lang('admin_articles_categories_error_delete'));
            } else {
                $page->db2->query("DELETE FROM articles_cat WHERE idcategory=".$idcat);
                echo('OK');
            }
            
            return;            

        }

        if ($ajax_action == 'updatecatarticle') {
            
            $page->db2->query("UPDATE articles_cat SET name='".$namecat."' WHERE idcategory=".$idcat);
            
            echo('OK');
            return;

        }

        if ($ajax_action == 'addsubcatarticle') {
            
            $page->db2->query("INSERT INTO articles_cat SET idfather=".$idcat.", name='".$namecat."'");
            $page->db2->query("UPDATE articles_cat SET num_children=num_children+1 WHERE idcategory=".$idcat);

            echo('OK');
            return;

        }

        if ($ajax_action == 'deletesubcatarticle') {
            
            $num_products = $page->db2->fetch_field("SELECT count(idarticle) FROM articles WHERE idsubcategory=".$idscat." LIMIT 1");
            if ($num_products != 0) {
                echo('ERROR:'.$page->lang('admin_articles_subcategories_error_delete'));
            } else {
                $idfather = $page->db2->fetch_field("SELECT idfather FROM articles_cat WHERE idcategory=".$idscat." LIMIT 1");
                $page->db2->query("DELETE FROM articles_cat WHERE idcategory=".$idscat);
                $page->db2->query("UPDATE articles_cat SET num_children=num_children-1 WHERE idcategory=".$idfather);
                echo('OK');
            }

            return;

        }

        if ($ajax_action == 'updatesubcatarticle') {
            
            $page->db2->query("UPDATE articles_cat SET name='".$namescat."' WHERE idcategory=".$idscat);
            
            echo('OK');
            return;
        }


/******/


        if ($ajax_action == 'usergeneral') {

            if ($level == 1) $leveladmin = 1;
            else $leveladmin = 0;

            $page->db2->query("UPDATE users SET leveladmin=".$leveladmin.", is_admin=".$level.", active=".$status.", verified=".$verify." WHERE iduser=".$iduser." LIMIT 1");

            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        }

        if ($ajax_action == 'userprofile') {
            
            $page->db2->query("UPDATE users SET firstname='".$firstname."', lastname='".$lastname."', gender='".$gender."', birthday='".$birthday."', currentcity='".$currentcity."', hometown='".$hometown."' WHERE iduser=".$iduser." LIMIT 1");   

            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;
            
        }

        if ($ajax_action == 'useremail') {

            $the_email = $page->db2->fetch_field("SELECT user_email FROM users WHERE iduser=".$iduser." LIMIT 1");            
            if (!$the_email || $the_email == $email) {
                echo('ERROR:'.$page->lang('admin_users_edit_block_email_error_younow'));
                return;
            }
            
            $response = $page->db2->fetch_field("SELECT count(iduser) FROM users WHERE user_email='".$email."' AND iduser<>".$iduser);
            if ($response > 0) {
                echo('ERROR:'.$page->lang('admin_users_edit_block_email_error_other'));
                return;
            }
            
            $page->db2->query("UPDATE users SET user_email='".$email."' WHERE iduser=".$iduser." LIMIT 1");

            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;
            
        }

        if ($ajax_action == 'userusername') {

            $the_username = $page->db2->fetch_field("SELECT user_username FROM users WHERE iduser=".$iduser." LIMIT 1");            
            if (!$the_username || $the_username == $username) {
                echo('ERROR:'.$page->lang('admin_users_edit_block_username_error_younow'));
                return;
            }
            
            $response = $page->db2->fetch_field("SELECT count(iduser) FROM users WHERE user_username='".$username."' AND iduser<>".$iduser);
            if ($response > 0) {
                echo('ERROR:'.$page->lang('admin_users_edit_block_username_error_notavailable'));
                return;
            }

            
            $page->db2->query("UPDATE users SET user_username='".$username."' WHERE iduser=".$iduser." LIMIT 1");

            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;
        
        }

        if ($ajax_action == 'userpassword') {
        
            $page->db2->query("UPDATE users SET user_password='".$pnew."' WHERE iduser=".$iduser." LIMIT 1");
            
            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;
            
        }

        if ($ajax_action == 'userprivacy') {
        
            $page->db2->query("UPDATE users SET privacy=".$ppro.", who_write_on_my_wall=".$pwri.", who_can_sendme_messages=".$pmes.", who_can_see_friends=".$psfr.", who_can_see_liked_pages=".$pspa.", who_can_see_joined_groups=".$psgr.", who_can_see_birthdate=".$pbir.", who_can_see_location=".$ploc.", who_can_see_about_me=".$pabo.", chat=".$pcha." WHERE iduser=".$iduser." LIMIT 1");
            
            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;
            
        }

        if ($ajax_action == 'deleteuser') {
            
            if (!$network->deleteuser($iduser)) {
                echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
                return;
            } else {
                echo('OK');
                return;
            }

        }


        if ($ajax_action == 'updatepagesgeneral') {

            $response = $page->db2->fetch_field("SELECT count(iduser) FROM users WHERE user_username='".$urlpage."'");
            if ($response > 0) {

                echo('ERROR:'.$page->lang('admin_pages_edit_block_general_error_username_not_available'));
                return;

            }
    
            $response = $page->db2->fetch_field("SELECT count(idpage) FROM pages WHERE idpage<>".$idpage." AND puname='".$urlpage."'");
            if ($response > 0) {

                echo('ERROR:'.$page->lang('admin_pages_edit_block_general_error_username_not_available'));
                return;

            }
    
            $response = $page->db2->fetch_field("SELECT count(idgroup) FROM groups WHERE guname='".$urlpage."'");
            if ($response > 0) {

                echo('ERROR:'.$page->lang('admin_pages_edit_block_general_error_username_not_available'));
                return;

            }
            
            $page->db2->query("UPDATE pages SET idcat=".$idcategory.", idsubcat=".$idsubcategory.", title='".$titlepage."', puname='".$urlpage."', description='".$descriptionpage."', verified=".$verify." WHERE idpage=".$idpage);   

            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        }

        if ($ajax_action == 'deletepage') {

            if (!$network->deletePage($idpage)) {
                echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
                return;
            } else {
                echo('OK');
                return;
            }
            
        }
  
        if ($ajax_action == 'updategroupsgeneral') {
          
            $response = $page->db2->fetch_field("SELECT count(iduser) FROM users WHERE user_username='".$urlgroup."'");
            if ($response > 0) {

                echo('ERROR:'.$page->lang('admin_groups_edit_block_error_username_not_available'));
                return;

            }
        
            $response = $page->db2->fetch_field("SELECT count(idpage) FROM pages WHERE puname='".$urlgroup."'");
            if ($response > 0) {

                echo('ERROR:'.$page->lang('admin_groups_edit_block_error_username_not_available'));
                return;

            }
        
            $response = $page->db2->fetch_field("SELECT count(idgroup) FROM groups WHERE idgroup<>".$idgroup." AND guname='".$urlgroup."'");
            if ($response > 0) {

                echo('ERROR:'.$page->lang('admin_groups_edit_block_error_username_not_available'));
                return;

            }
            
            $page->db2->query("UPDATE groups SET privacy=".$privacygroup.", title='".$titlegroup."', guname='".$urlgroup."', about='".$descriptiongroup."' WHERE idgroup=".$idgroup);
          
            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;
        
        }


        if ($ajax_action == 'deletegroup') {
            
            if (!$network->deleteGroup($idgroup)) {
                echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
                return;
            } else {
                echo('OK');
                return;
            }
            
        }
  
        if ($ajax_action == 'addstaticpage') {
    
            $numstatics = $page->db2->fetch_field("SELECT count(idstatic) FROM statics WHERE url='".$urlstatic."' LIMIT 1");
            
            if ($numstatics > 0) {

                echo('ERROR:'.$page->lang('admin_static_pages_add_error_url_noavailable'));
                return;

            } else {

                $page->db2->query("INSERT INTO statics SET url='".$urlstatic."', title='".$titlestatic."', texthtml='".$htmlstatic."', show_in_foot=".$infootstatic);
                echo('OK');
                return;
              
            }
    
        }

        if ($ajax_action == 'updatestaticpage') {
            
            $numstatics = $page->db2->fetch_field("SELECT count(idstatic) FROM statics WHERE idstatic<>".$idstatic." AND url='".$urlstatic."' LIMIT 1");

            if ($numstatics > 0) {

                echo('ERROR:'.$page->lang('admin_static_pages_add_error_url_noavailable'));
                return;

            } else {

                $page->db2->query("UPDATE statics SET url='".$urlstatic."', title='".$titlestatic."', texthtml='".$htmlstatic."', show_in_foot=".$infootstatic." WHERE idstatic=".$idstatic);

                $json_result = array('html' => $page->lang('admin_txt_has_updated'));
                echo(json_encode($json_result));
                return;

            }
    
        }

        if ($ajax_action == 'deletestaticpage') {
            
            $page->db2->query("DELETE FROM statics WHERE idstatic=".$idsp);
            echo('OK');
            return;

        }
        
        if ($ajax_action == 'addcurrency') {

            $page->db2->query("INSERT INTO currencies SET name='".$namecurrency."', code_iso='".$codecurrency."', symbol='".$symbolcurrency."'");

            echo('OK');
            return;

        }
        
        if ($ajax_action == 'deletecurrency') {
            
            $page->db2->query("DELETE FROM currencies WHERE idcurrency=".$idc);
            echo('OK');
            return;

        }
        
        if ($ajax_action == 'updatecurrency') {

            $page->db2->query("UPDATE currencies SET name='".$namecurrency."', code_iso='".$codecurrency."', symbol='".$symbolcurrency."' WHERE idcurrency=".$idc);

            echo('OK');
            return;

        }


        if ($ajax_action == 'createads') {

            $code_ads = codeUniqueInTable(11, 1, 'advertising_basic', 'code');
            
            $fname = '';
            if ($the_photo['name']) { 
                if ($the_photo['size'] > $K->FILE_SIZE_PHOTO_ADS_BASIC || $the_photo['size'] == 0) {
                    echo('ERROR: Error.');
                    return;
                }
                
                $file_type = $the_photo['type'];
                if ($file_type=="image/jpeg" || $file_type=="image/gif" || $file_type=="image/png") {
                    switch ($file_type) {
                        case "image/jpeg":
                            $file_extension = '.jpg';
                            break;
                        case "image/gif":
                            $file_extension = '.gif';		
                            break;
                        case "image/png":
                            $file_extension = '.png';
                            break;
                    }
                    
                } else {
                    echo('ERROR: Error.');
                    return;
                }

                $fname = $code_ads.$file_extension;
                move_uploaded_file($the_photo['tmp_name'], $K->STORAGE_DIR_ADS_BASIC.$fname);
                
            }
            
            $page->db2->query("INSERT INTO advertising_basic SET code='".$code_ads."', idslot=".$slot.", name='".$nameads."', target=".$target.", thefile ='".$fname."', theurl ='".$urlads."', type_ads=1, whendate='".time()."'");
			
            $json_result = array('OK'=>'Ok');
            echo(json_encode($json_result));
            return;  
            
        }
        
        if ($ajax_action == 'deleteads') {
            
            $ads = $page->db2->fetch("SELECT * FROM advertising_basic WHERE idbasic=".$idbasic);
            
            if ($ads) {
                $thephoto = $ads->thefile;
                if (!empty($thephoto)) {
                    $the_file = $K->STORAGE_DIR_ADS_BASIC.$thephoto;
                    if (file_exists($the_file)) @unlink($the_file);
                }
            }
            
            $page->db2->query("DELETE FROM advertising_basic WHERE idbasic=".$idbasic." LIMIT 1");
            echo('OK');
            return;            

        }
        
        if ($ajax_action == 'updateads') {
            
            $theads = $page->db2->fetch("SELECT * FROM advertising_basic WHERE idbasic=".$idads);
            if (!$theads) {
                echo('ERROR: Error');
                return;
            }
            
            $sql_photo = '';
            
            if ($dochange == '1') {
            
                if ($the_photo['name']) { 
                    if ($the_photo['size'] > $K->FILE_SIZE_PHOTO_ADS_BASIC || $the_photo['size'] == 0) {
                        echo('ERROR: Error.');
                        return;
                    }
                    
                    $file_type = $the_photo['type'];
                    if ($file_type=="image/jpeg" || $file_type=="image/gif" || $file_type=="image/png") {
                        switch ($file_type) {
                            case "image/jpeg":
                                $file_extension = '.jpg';
                                break;
                            case "image/gif":
                                $file_extension = '.gif';		
                                break;
                            case "image/png":
                                $file_extension = '.png';
                                break;
                        }
                        
                    } else {
                        echo('ERROR: Error.');
                        return;
                    }

                    if (!empty($theads->thefile)) {
                        $the_file = $K->STORAGE_DIR_ADS_BASIC.$theads->thefile;
                        if (file_exists($the_file)) @unlink($the_file);
                    }
    
                    $fname = $theads->code.$file_extension;
                    move_uploaded_file($the_photo['tmp_name'], $K->STORAGE_DIR_ADS_BASIC.$fname);
                    
                    $sql_photo = ", thefile='".$fname."'";
                    
                }
                
            }

            $page->db2->query("UPDATE advertising_basic SET name='".$nameads."', target=".$target.$sql_photo.", theurl ='".$urlads."', status=".$status." WHERE idbasic=".$idads." LIMIT 1");
            
            $json_result = array('themessage' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;
            
        }
        
        if ($ajax_action == 'creategame') {

            $code_game = codeUniqueInTable(11, 1, 'games', 'code');
            
            $fname = '';
            if ($the_photo['name']) { 
                if ($the_photo['size'] > $K->FILE_SIZE_THUMBNAIL_GAMES || $the_photo['size'] == 0) {
                    echo('ERROR: Error.');
                    return;
                }
                
                $file_type = $the_photo['type'];
                if ($file_type=="image/jpeg" || $file_type=="image/gif" || $file_type=="image/png") {
                    switch ($file_type) {
                        case "image/jpeg":
                            $file_extension = '.jpg';
                            break;
                        case "image/gif":
                            $file_extension = '.gif';		
                            break;
                        case "image/png":
                            $file_extension = '.png';
                            break;
                    }
                    
                } else {
                    echo('ERROR: Error.');
                    return;
                }

                $fname = $code_game.$file_extension;
                move_uploaded_file($the_photo['tmp_name'], $K->STORAGE_DIR_GAMES.$fname);
                
            }

            
            $page->db2->query("INSERT INTO games SET code='".$code_game."', name='".$namegame."', url_game='".$urlgame."', thumbnail='".$fname."', url_owner ='".$urlowner."', whendate='".time()."'");
			
            $json_result = array('OK'=>'Ok');
            echo(json_encode($json_result));
            return;  
            
        }
        
        if ($ajax_action == 'deletegame') {
            
            $game = $page->db2->fetch("SELECT * FROM games WHERE idgame=".$idgame);
            
            if ($game) {
                $thephoto = $game->thumbnail;
                if (!empty($thephoto)) {
                    $the_file = $K->STORAGE_DIR_GAMES.$thephoto;
                    if (file_exists($the_file)) @unlink($the_file);
                }
            }
            
            $page->db2->query("DELETE FROM games WHERE idgame=".$idgame." LIMIT 1");
            echo('OK');
            return;            

        }
        
        if ($ajax_action == 'updategame') {

            $thegame = $page->db2->fetch("SELECT * FROM games WHERE idgame=".$idgame);
            if (!$thegame) {
                echo('ERROR: Error');
                return;
            }
            
            $sql_photo = '';
            
            if ($dochange == '1') {
            
                if ($the_photo['name']) { 
                    if ($the_photo['size'] > $K->FILE_SIZE_THUMBNAIL_GAMES || $the_photo['size'] == 0) {
                        echo('ERROR: Error.');
                        return;
                    }
                    
                    $file_type = $the_photo['type'];
                    if ($file_type=="image/jpeg" || $file_type=="image/gif" || $file_type=="image/png") {
                        switch ($file_type) {
                            case "image/jpeg":
                                $file_extension = '.jpg';
                                break;
                            case "image/gif":
                                $file_extension = '.gif';		
                                break;
                            case "image/png":
                                $file_extension = '.png';
                                break;
                        }
                        
                    } else {
                        echo('ERROR: Error.');
                        return;
                    }

                    if (!empty($thegame->thumbnail)) {
                        $the_file = $K->STORAGE_DIR_GAMES.$thegame->thumbnail;
                        if (file_exists($the_file)) @unlink($the_file);

                    }
    
                    $fname = $thegame->code.$file_extension;
                    move_uploaded_file($the_photo['tmp_name'], $K->STORAGE_DIR_GAMES.$fname);
                    
                    $sql_photo = ", thumbnail='".$fname."'";
                    
                }
                
            }

            $page->db2->query("UPDATE games SET name='".$namegame."', url_game='".$urlgame."'".$sql_photo.", url_owner ='".$urlowner."', status=".$status." WHERE idgame=".$idgame." LIMIT 1");
            
            $json_result = array('themessage' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;
            
            
        }
        

        if ($ajax_action == 'updateproduct') {
       
            $product = $page->db2->fetch("SELECT * FROM products WHERE idproduct=".$idproduct." LIMIT 1");
            if (!$product) {
                echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
                return;
            }

            $page->db2->query("UPDATE products SET name='".$nameproduct."', idcategory=".$idcategory.", idsubcategory=".$idsubcategory.", description='".$descriptionproduct."', location='".$locationproduct."', currency=".$currencyproduct.", price=".$priceproduct.", type_product=".$typeproduct." WHERE idproduct=".$idproduct." LIMIT 1");

            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        }
        
        if ($ajax_action == 'deleteproduct') {

            if (!$network->deleteProduct($idproduct)) {
                echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
                return;
            } else {
                echo('OK');
                return;
            }

        }
        
        if ($ajax_action == 'updatearticle') {

            $article = $page->db2->fetch("SELECT * FROM articles WHERE idarticle=".$idarticle." LIMIT 1");
            if (!$article) {
                echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
                return;
            }
            
            $page->db2->query("UPDATE articles SET title='".$titlearticle."', idcategory=".$idcategory.", idsubcategory=".$idsubcategory.", summary='".$summaryarticle."' WHERE idarticle=".$idarticle." LIMIT 1");

            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;

        }
        
        if ($ajax_action == 'deletearticle') {
            
            if (!$network->deleteArticle($idarticle)) {
                echo('ERROR:'.$page->lang('global_txt_error_ocurred'));
                return;
            } else {
                echo('OK');
                return;
            }

        }

        if ($ajax_action == 'createadshtml') {

            $code_ads = codeUniqueInTable(11, 1, 'advertising_basic', 'code');
            
            $page->db2->query("INSERT INTO advertising_basic SET code='".$code_ads."', idslot=".$slot.", name='".$nameads."', type_ads=2, the_html='".$codehtml."', whendate='".time()."'");
			
            $json_result = array('OK'=>'Ok');
            echo(json_encode($json_result));
            return;  
            
        }
        
        if ($ajax_action == 'updateadshtml') {
            
            $theads = $page->db2->fetch("SELECT * FROM advertising_basic WHERE idbasic=".$idads);
            if (!$theads) {
                echo('ERROR: Error');
                return;
            }

            $page->db2->query("UPDATE advertising_basic SET name='".$nameads."', the_html ='".$codehtml."', status=".$status." WHERE idbasic=".$idads." LIMIT 1");
            
            $json_result = array('themessage' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;
            
        }
        
        if ($ajax_action == 'sidebarusers') {
        
            $page->db2->query("UPDATE settings SET value='".$sidebarusers."' WHERE word='SIDEBAR_USERS' LIMIT 1");
            
            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;
    
        }
        
        if ($ajax_action == 'updateappandroid') {
            
            $file_app_apk = $K->FILE_APP_ANDROID;
            if (!empty($file_app_apk)) {
                $the_file = $K->STORAGE_DIR_APPS.$file_app_apk;
                if (file_exists($the_file)) @unlink($the_file);
            }
            
            if ($show_app == '1') {
                
                move_uploaded_file($the_file_apk['tmp_name'], $K->STORAGE_DIR_APPS.$K->NAME_FILE_APK);
                
                $page->db2->query("UPDATE settings SET value='1' WHERE word='SHOW_APP_ANDROID' LIMIT 1");
                $page->db2->query("UPDATE settings SET value='".$K->NAME_FILE_APK."' WHERE word='FILE_APP_ANDROID' LIMIT 1");

            } else {
                
                $page->db2->query("UPDATE settings SET value='0' WHERE word='SHOW_APP_ANDROID' LIMIT 1");
                $page->db2->query("UPDATE settings SET value='' WHERE word='FILE_APP_ANDROID' LIMIT 1");                
            
            }
            
            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;
            
        }
        
        if ($ajax_action == 'apigoogle') {
    
            $page->db2->query("UPDATE settings SET value='".$apig."' WHERE word='KEY_API_GOOGLE' LIMIT 1");
            
            $json_result = array('html' => $page->lang('admin_txt_has_updated'));
            echo(json_encode($json_result));
            return;
    
        }

        
    }
?>