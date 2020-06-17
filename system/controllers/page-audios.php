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
    $D->_IN_PROFILE = TRUE;
    
    if ($D->_IS_LOGGED) {
        $D->_WITH_NOTIFIER = TRUE;
    }
    
	$D->isPhantom = FALSE;
	if ($this->param('phantom') && $this->param('phantom')=='yes') $D->isPhantom = TRUE;

	$D->layout_size = 'min';
	if ($this->param('lysize')) $D->layout_size = $this->param('lysize');

	$this->loadLanguage('global.php');
    if ($D->_IS_LOGGED) {
        $this->loadLanguage('dashboard.php');
        $this->loadLanguage('settings.php');
    }
	$this->loadLanguage('profile.php');
    $this->loadLanguage('activity.php');

    $thepage = $network->getPageById($this->params->page);
    $D->idpage = $thepage->idpage;
    $D->codepage = $D->codeprofile = $thepage->code;
    $D->idcreator = $thepage->idcreator;
    $D->username = $thepage->puname;
    $D->the_title = $thepage->title;
    $D->numlikes = $thepage->numlikes;
    $D->description = $thepage->description;
    $D->idcat = $thepage->idcat;
    $D->idsubcat = $thepage->idsubcat;
    $D->nameCategory = $network->getNameCategory($D->idsubcat);

    $D->with_avatar = FALSE;
    $url_base_avatar = $K->STORAGE_URL_AVATARS_PAGE.'min4/';
    $url_base_avatar_mini = $K->STORAGE_URL_AVATARS_PAGE.'min3/';
    $url_base_avatar_umini = $K->STORAGE_URL_AVATARS_PAGE.'min1/';
    $D->data_media_avatar_page = $K->STORAGE_URL_AVATARS_PAGE.'min4/'.$thepage->avatar;
    if ($thepage->avatar != $K->DEFAULT_AVATAR_PAGE) {
        $url_base_avatar .= $thepage->code.'/';
        $url_base_avatar_mini .= $thepage->code.'/';
        $url_base_avatar_umini .= $thepage->code.'/';
        $D->with_avatar = TRUE;
        $D->data_media_avatar_page = $K->STORAGE_URL_AVATARS_PAGE.'originals/'.$thepage->code.'/'.$thepage->avatar;
		
    }
    $D->the_avatar_page = $url_base_avatar.$thepage->avatar;
    $D->the_avatar_page_min = $url_base_avatar_mini.$thepage->avatar;
    $D->the_avatar_page_umin = $url_base_avatar_umini.$thepage->avatar;
    
    $D->with_cover = FALSE;
    $D->cover_page = '';
    if (!empty($thepage->cover)) {
        $D->cover_page = $K->STORAGE_URL_COVERS_PAGE.$thepage->code.'/'.$thepage->cover;
        $D->with_cover = TRUE;
		$D->cover_media = $thepage->cover_media;
    }

    $D->position_cover_page = $thepage->cover_position;
    $D->the_verified = $thepage->verified;
    $D->the_register_date = $thepage->created;

    $D->posted_in_editor = 1;
    $D->code_wall_editor = $D->codepage;
    $D->code_writer_editor = $D->codepage;
    $D->type_writer_editor = 1;
    $D->for_who_editor = 0;
    
    $D->placeholder_textarea_editor = $this->lang('dashboard_newactivity_ph_textarea_write_something');

    $D->is_my_page = FALSE;
    $D->like_me_page = FALSE;
    if ($D->_IS_LOGGED) {
		$D->me = $this->user->info;
		$D->is_my_page = ($D->idcreator == $D->me->iduser);
        $D->like_me_page = $this->user->likeMePage($D->idpage);
    }
    
    $D->editor_for = 1; //0: User  1: Page   2: Group
    $D->editor_text_posting_as = $this->lang('dashboard_newactivity_txt_posting_as').' '.$D->the_title;

    $D->view_editor = FALSE;
    
    $D->menu_footer = FALSE;

    $D->id_container = 'site';
    
    /******************************************************************/
    
    $D->show_more = '';
    $D->the_list_activities = '';

    $res = $this->db2->query("SELECT * FROM posts WHERE (typepost=3 AND idwriter=".$D->idpage." AND type_writer=1) OR (typepost=3 AND posted_in=1 AND id_wall=".$D->idpage.") ORDER BY idpost DESC LIMIT 0, ".($K->ACTIVITIES_PER_PAGE + 1));
    $total_posts = $this->db2->num_rows();

    $D->the_place = 2; // profile in...  1: user  2: page  3:group
    $D->type_items = 3; // 1: timeline   2: videos   3: audios
	
	$D->num_items_total = $total_posts;

    if ($total_posts>0) {
        $count_regs = 0;
        while ($obj = $this->db2->fetch_object($res)) {

            $the_post = (is_object($obj) && get_class($obj) == 'post') ? $obj : new post(FALSE, $obj);
            $D->the_list_activities .= $the_post->draw();

            $count_regs++;
            if ($count_regs >= $K->ACTIVITIES_PER_PAGE) break;

        }
        
        if ($total_posts > $K->ACTIVITIES_PER_PAGE) $D->show_more = $this->load_template('_showmore.php',FALSE);

    }        
    
    if ($total_posts <= $K->ACTIVITIES_PER_PAGE) $D->the_list_activities .= '<div style="margin-bottom:50px;"></div>';

    /******************************************************************/

    $D->title_section = $this->lang('profile_audios_title');

    /****************************************************************************/

    $this->load_extract_controller('_pre-profile');

    /****************************************************************************/

	if ($D->isPhantom) {
        
        $html = '';
        
        if ($D->_IS_LOGGED) {
            
            $D->id_container = 'dashboard';
            $this->load_extract_controller('_dashboard-menu-left');
            
            if ($D->is_my_page) $D->view_editor = TRUE;
            
        }

        if ($D->layout_size == 'min') {
            $for_load = 'min/page-audios.php';
        } else {
            $for_load = 'max/page-audios.php';
        }
        
        $D->titlePhantom = $D->the_title.' | '.$K->SITE_TITLE;

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {
        
        $D->page_title = $D->the_title.' | '.$K->SITE_TITLE;
        
        if ($D->_IS_LOGGED) {
            
            $this->load_extract_controller('_required-dashboard');
            $this->load_extract_controller('_dashboard-bar-top');
            
            if ($D->is_my_page) $D->view_editor = TRUE;
            $D->id_container = 'dashboard';
            $this->load_extract_controller('_dashboard-menu-left');
            $D->file_in_template = 'max/page-audios.php';            
            $this->load_template('dashboard-template.php');

        } else {
            
            if (!isset($D->string_js) || !is_array($D->string_js)) $D->string_js = array();
            array_push($D->string_js, 'moment.locale("'.$K->LANGUAGE.'");');
            
            $this->load_extract_controller('_bar-top');
            $this->load_extract_controller('_required-out');
            
            $D->file_in_template = 'max/page-audios.php';
            $this->load_template('site-template.php');
            
        }
        
    }

?>