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

	$this->loadLanguage('global.php');
	$this->loadLanguage('dashboard.php');


    $D->_IN_DASHBOARD = TRUE;
    $D->_WITH_NOTIFIER = TRUE;

	$D->isPhantom = FALSE;
	if ($this->param('phantom') && $this->param('phantom')=='yes') $D->isPhantom = TRUE;

	$D->layout_size = 'min';
	if ($this->param('lysize')) $D->layout_size = $this->param('lysize');
    
    
    $the_sanitaze = new sanitize(); // init sanitaze
	$D->codearticle = '';
	if ($this->param('a')) $D->codearticle = $this->param('a');
    $D->codearticle = $the_sanitaze->str_nohtml($D->codearticle);
    if (empty($D->codearticle)) $this->globalRedirect($K->SITE_URL.'articles');

    $info_article = $this->db2->fetch("SELECT * FROM articles WHERE code='".$D->codearticle."' LIMIT 1");

    if (!$info_article) $this->globalRedirect($K->SITE_URL.'articles');

    $D->idarticle = $info_article->idarticle;
    $D->idcategory = $info_article->idcategory;
    $D->idsubcategory = $info_article->idsubcategory;
    $D->title = stripslashes($info_article->title);
    $D->summary = stripslashes($info_article->summary);
    $D->content = stripslashes($info_article->text_article);
    $D->photo = $info_article->photo;

    $D->id_menu = 'opt_ml_myarticles';

    /****************************************************************************/
    
    $this->load_extract_controller('_pre-dashboard');

    /****************************************************************************/

	if ($D->isPhantom) {

        $html = '';
        $this->load_extract_controller('_dashboard-menu-left');
		
        if ($D->layout_size == 'min') {
            $for_load = 'min/articles-edit.php';
		} else {
            $for_load = 'max/articles-edit.php';
		}

        $D->titlePhantom = $this->lang('dashboard_articles_edit_title_page');

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_dashboard-menu-left');

        $D->page_title = $this->lang('dashboard_articles_edit_title_page');

        $D->file_in_template = 'max/articles-edit.php';
        $this->load_template('dashboard-template.php');

    }

?>