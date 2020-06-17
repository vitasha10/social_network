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
	$D->codegame = '';
	if ($this->param('codegame')) $D->codegame = $this->param('codegame');
    $D->codegame = $the_sanitaze->str_nohtml($D->codegame, 11);
    
    if (strlen($D->codegame) != 11) $this->globalRedirect($K->SITE_URL.'games');

    $the_game = $this->db2->fetch("SELECT * FROM games WHERE status=1 AND code='".$D->codegame."' LIMIT 1");  
    
    if (!$the_game) $this->globalRedirect($K->SITE_URL.'games');
    /************************************************/

    $D->game->name = stripslashes($the_game->name);
    $D->game->urlgame = stripslashes($the_game->url_game);
    $D->game->urlowner = stripslashes($the_game->url_owner);
    $D->game->thumbnail = stripslashes($the_game->thumbnail);
    
    /************************************************/

    $D->id_menu = 'opt_ml_games';

	if ($D->isPhantom) {

        $html = '';
        $this->load_extract_controller('_dashboard-menu-left');

		if ($D->layout_size == 'min') {
            $for_load = 'min/games-view.php';
		} else {
            $for_load = 'max/games-view.php';
		}

        $D->titlePhantom = $D->game->name . ' | '. $this->lang('dashboard_games_title_page');

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_dashboard-menu-left');

        $D->page_title = $D->game->name . ' | '. $this->lang('dashboard_games_title_page');

        $D->file_in_template = 'max/games-view.php';
        $this->load_template('dashboard-template.php');

    }

?>