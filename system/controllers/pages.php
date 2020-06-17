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
    
    $res = $this->db2->query("SELECT * FROM pages WHERE idcreator=".$this->user->info->iduser." ORDER BY idpage DESC LIMIT 0, ".($K->ITEMS_PER_PAGE + 1));
    $total_items = $this->db2->num_rows();

    $count_regs = 0;
    while ($obj = $this->db2->fetch_object($res)) {
        
        $D->page = $obj;
        $D->page->title = stripslashes($D->page->title);
        $D->page->puname = stripslashes($D->page->puname);
        
        $D->page->avatar = empty($D->page->avatar) ? $K->DEFAULT_AVATAR_PAGE : $D->page->avatar;
        $D->page->avatar = $K->STORAGE_URL_AVATARS_PAGE.'min2/'.($D->page->avatar == $K->DEFAULT_AVATAR_PAGE ? '' : $D->page->code.'/') . $D->page->avatar;
        
		$D->nameCategory = stripslashes($this->network->getNameCatPage($D->page->idsubcat));
        
        $D->page_last = FALSE;
        if ($total_items < $count_regs + 2) $D->page_last = TRUE;
        
        $D->the_list_items .= $this->load_template('ones/one-page.php', FALSE);

        $count_regs++;
        if ($count_regs >= $K->ITEMS_PER_PAGE) break;

    }
    
    if ($total_items > $K->ITEMS_PER_PAGE) $D->show_more = TRUE;

    /****************************************************************************/

    $D->id_menu = 'opt_ml_yourpages';
    
    /****************************************************************************/
    
    $this->load_extract_controller('_pre-dashboard');

    /****************************************************************************/
    
	if ($D->isPhantom) {

        $html = '';
        $this->load_extract_controller('_dashboard-menu-left');
        
		if ($D->layout_size == 'min') {
            $for_load = 'min/pages.php';
		} else {
            $for_load = 'max/pages.php';
		}
        
        $D->titlePhantom = $this->lang('dashboard_pages_title_your');

        $html .= $this->load_template($for_load, FALSE);
        echo $html;
        
	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_dashboard-menu-left');
        
        $D->page_title = $this->lang('dashboard_pages_title_your');

        $D->file_in_template = 'max/pages.php';
        $this->load_template('dashboard-template.php');
        
    }
?>