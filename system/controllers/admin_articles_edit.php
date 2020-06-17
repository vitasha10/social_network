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
	if (!$D->_IS_LOGGED) $this->globalRedirect('login');
	if (!$D->_IS_ADMIN_USER) $this->globalRedirect('login');

    $D->_IN_ADMIN_PANEL = TRUE;
    $D->_WITH_NOTIFIER = TRUE;

	$D->isPhantom = FALSE;
	if ($this->param('phantom') && $this->param('phantom')=='yes') $D->isPhantom = TRUE;

	$D->layout_size = 'min';
	if ($this->param('lysize')) $D->layout_size = $this->param('lysize');

	$this->loadLanguage('global.php');
	$this->loadLanguage('dashboard.php');
	$this->loadLanguage('admin.php');

    /****************************************************************/    
    /****************************************************************/

    $the_sanitaze = new sanitize(); // init sanitaze
	$D->idarticle = '';
	if ($this->param('a')) $D->idarticle = $this->param('a');
    $D->idarticle = $the_sanitaze->int($D->idarticle);
    if ($D->idarticle <= 0) $this->globalRedirect($K->SITE_URL.'admin/articles');

    $info_article = $this->db2->fetch("SELECT idarticle FROM articles WHERE idarticle=".$D->idarticle." LIMIT 1");

    if (!$info_article) $this->globalRedirect($K->SITE_URL.'admin/articles');

    $D->me = $this->user->info;

    $info_article = $this->db2->fetch("SELECT * FROM articles WHERE idarticle=".$D->idarticle." LIMIT 1");
    
    $D->idarticle = $info_article->idarticle;
    $D->idcategory = $info_article->idcategory;
    $D->idsubcategory = $info_article->idsubcategory;
    $D->title = stripslashes($info_article->title);
    $D->summary = stripslashes($info_article->summary);
    $D->content = stripslashes($info_article->text_article);

    /****************************************************************/    
    /****************************************************************/

    $D->js_script_min = $this->designer->getStringJS('admin');

    $D->id_menu = 'opt_adm_articles';

	if ($D->isPhantom) {

        $html = '';

        $this->load_extract_controller('_admin-menu-left');

		if ($D->layout_size == 'min') {

            $for_load = 'min/admin-articles-edit.php';

		} else {

            $for_load = 'max/admin-articles-edit.php';

		}

        $D->titlePhantom = $this->lang('admin_articles_title_page').' | '.$D->title;

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_admin-menu-left');

		$D->page_title = $this->lang('admin_articles_title_page').' | '.$D->title;    	

        $D->file_in_template = 'max/admin-articles-edit.php';
        $this->load_template('dashboard-template.php');

	}

?>