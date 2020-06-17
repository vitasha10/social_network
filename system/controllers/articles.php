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

    $D->show_more = FALSE;
    $D->the_list_items = '';

    /****************************************************************************/

    $res = $this->db2->query("SELECT * FROM articles WHERE idwriter=".$this->user->info->iduser." ORDER BY idarticle DESC LIMIT 0, ".($K->ITEMS_PER_PAGE + 1));
    $total_items = $this->db2->num_rows();

    $count_regs = 0;
    while ($obj = $this->db2->fetch_object($res)) {

        $D->article = $obj;
        $D->article->title = stripslashes($D->article->title);
        $D->article->code = $D->article->code;
        $D->categories = $network->getCategoriesArticle(FALSE, $D->article->code);

        $D->article_last = FALSE;
        if ($total_items < $count_regs + 2) $D->article_last = TRUE;

        $D->the_list_items .= $this->load_template('ones/one-article.php', FALSE);

        $count_regs++;
        if ($count_regs >= $K->ITEMS_PER_PAGE) break;

    }

    if ($total_items > $K->ITEMS_PER_PAGE) $D->show_more = TRUE;

    $D->id_menu = 'opt_ml_myarticles';

    /****************************************************************************/
    
    $this->load_extract_controller('_pre-dashboard');

    /****************************************************************************/

	if ($D->isPhantom) {

        $html = '';
        $this->load_extract_controller('_dashboard-menu-left');

		if ($D->layout_size == 'min') {
            $for_load = 'min/articles.php';
		} else {
            $for_load = 'max/articles.php';
		}

        $D->titlePhantom = $this->lang('dashboard_articles_title_page');

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_dashboard-menu-left');

        $D->page_title = $this->lang('dashboard_articles_title_page');

        $D->file_in_template = 'max/articles.php';
        $this->load_template('dashboard-template.php');

    }

?>