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

    $D->me = $this->user->info;

	$this->loadLanguage('global.php');
	$this->loadLanguage('dashboard.php');
    $this->loadLanguage('activity.php');

    $D->_IN_DASHBOARD = TRUE;
    $D->_WITH_NOTIFIER = TRUE;

	$D->isPhantom = FALSE;
	if ($this->param('phantom') && $this->param('phantom')=='yes') $D->isPhantom = TRUE;

	$D->layout_size = 'min';
	if ($this->param('lysize')) $D->layout_size = $this->param('lysize');

    /***********************************************/

    $D->show_more = '';
    $D->the_list_items = '';
    
    $D->the_place = 5; // 1:dashboard  2:pages feed  3:groups feed  4:saved

    $events = $this->db2->fetch_all('SELECT * FROM events ORDER BY start_unix DESC LIMIT 0, '.($K->ITEMS_PER_PAGE + 1));

    if ($events) {
        
        $count_regs = 0;
        
        $total_items = count($events);
        
        foreach ($events as $oneevent) {
            
            $D->idevent = $oneevent->idevent;
            $D->codee_event = $oneevent->code;
            $D->title_event = stripslashes($oneevent->title);
            $D->cover_event = $oneevent->cover;
            $D->cover_position_event = $oneevent->cover_position;
            if (!empty($D->cover_event)) {
                $D->cover_event = $K->STORAGE_URL_COVERS_EVENT.$D->codee_event.'/'.$D->cover_event;
            }

            $D->themonth_s = date("n", strtotime($oneevent->date_start));
            $D->themonth_s = ucfirst(strtolower($this->lang('global_month_'.$D->themonth_s)));
            $D->theday_s = date("j", strtotime($oneevent->date_start));
            $D->date_start = $this->lang('global_format_date_event', array('#MONTH#' => $D->themonth_s, '#DAY#' => $D->theday_s));
            
            $themonth_e = date("n", strtotime($oneevent->date_end));
            $themonth_e = ucfirst(strtolower($this->lang('global_month_'.$themonth_e)));
            $theday_e = date("j", strtotime($oneevent->date_end));
            $D->date_end = $this->lang('global_format_date_event', array('#MONTH#' => $themonth_e, '#DAY#' => $theday_e));
            
            $D->date_of_event = '';
            if ($D->date_end == $D->date_start) $D->date_of_event = $D->date_start;
            else $D->date_of_event = $D->date_start.' - '.$D->date_end;
            
            $D->going = $this->db2->fetch_field('SELECT count(id) FROM events_actions WHERE idevent='.$D->idevent.' AND type_action=2');
            $D->interested = $this->db2->fetch_field('SELECT count(id) FROM events_actions WHERE idevent='.$D->idevent.' AND type_action=1');
            
            $D->url_event = $K->SITE_URL.'event/'.$D->codee_event;
            
            $D->the_list_items .= $this->load_template('ones/one-event-max.php', FALSE);
            

            $count_regs++;
            if ($count_regs >= $K->ITEMS_PER_PAGE) break;
            
        }
        
        if ($total_items > $K->ITEMS_PER_PAGE) $D->show_more = TRUE;


    }

    /***********************************************/

    $D->id_menu = 'opt_ml_events';
    
    /****************************************************************************/
    
    $this->load_extract_controller('_pre-dashboard');

    /****************************************************************************/

	if ($D->isPhantom) {

        $html = '';
        $this->load_extract_controller('_dashboard-menu-left');

		if ($D->layout_size == 'min') {

            $for_load = 'min/events.php';

		} else {

            $for_load = 'max/events.php';

		}

        $D->titlePhantom = $this->lang('dashboard_events_title_page');

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_dashboard-menu-left');

        $D->page_title = $this->lang('dashboard_events_title_page');

        $D->file_in_template = 'max/events.php';
        $this->load_template('dashboard-template.php');

    }

?>