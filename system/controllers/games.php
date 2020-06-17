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
    
    /************************************************/

    $D->show_more = FALSE;
    $D->the_list_items = '';
    
    $K->ITEMS_PER_PAGE = $K->ITEMS_PER_PAGE_MARKETPLACE;
    
    $total_items = 0;
    
    $games = $this->db2->fetch_all("SELECT * FROM games WHERE status=1 ORDER BY idgame DESC LIMIT 0, ".($K->ITEMS_PER_PAGE + 1));
    if ($games) {
        $total_items = count($games);
        $count_regs = 0;
        foreach($games as $onegame) {
            
            $D->game = $onegame;
            $D->game->name = stripslashes($D->game->name);
            $D->game->code = stripslashes($D->game->code);
            $D->game->url_game = stripslashes($D->game->url_game);
            $D->game->url_owner = stripslashes($D->game->url_owner);
            $D->game->thumbnail = stripslashes($D->game->thumbnail);
            $D->game->url = $K->SITE_URL.'games/'.$D->game->code;

            $D->the_list_items .= $this->load_template('ones/one-game-dash.php', FALSE);

            $count_regs++;
            if ($count_regs >= $K->ITEMS_PER_PAGE) break;
        
        }

        if ($total_items > $K->ITEMS_PER_PAGE) $D->show_more = TRUE;
        
    }
    
    /************************************************/

    $D->id_menu = 'opt_ml_games';

	if ($D->isPhantom) {

        $html = '';
        $this->load_extract_controller('_dashboard-menu-left');

		if ($D->layout_size == 'min') {
            $for_load = 'min/games.php';
		} else {
            $for_load = 'max/games.php';
		}

        $D->titlePhantom = $this->lang('dashboard_games_title_page');

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_dashboard-menu-left');

        $D->page_title = $this->lang('dashboard_games_title_page');

        $D->file_in_template = 'max/games.php';
        $this->load_template('dashboard-template.php');

    }

?>