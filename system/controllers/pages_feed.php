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
    $this->loadLanguage('activity.php');

    $D->_IN_DASHBOARD = TRUE;
    $D->_WITH_NOTIFIER = TRUE;

	$D->isPhantom = FALSE;
	if ($this->param('phantom') && $this->param('phantom')=='yes') $D->isPhantom = TRUE;

	$D->layout_size = 'min';
	if ($this->param('lysize')) $D->layout_size = $this->param('lysize');

    /***********************************************/

    $D->show_more = '';
    $D->the_list_activities = '';

    $numrelations = $this->db2->fetch_field('SELECT count(id) FROM relations WHERE type_leader=1 AND follower='.$this->user->id);

    if ($numrelations > 0) {

        $sqlPostsHiddens = 'SELECT iditem FROM hiddens WHERE typeitem=0 AND iduser='.$this->user->id;

        $idsPosts = $this->db2->fetch_all('
        SELECT DISTINCT idpost 
        FROM posts, relations 
        WHERE 
        posts.idpost NOT IN ('.$sqlPostsHiddens.') 
        AND follower='.$this->user->id.' 
        AND for_who<>2 
        AND leader = id_wall 
        AND type_leader = posted_in 
        AND type_leader = 1 
        OR (posts.posted_in=1 AND id_wall='.$this->user->id.')

        ORDER BY post_date DESC
        LIMIT 0,'.($K->ACTIVITIES_PER_PAGE + 1)
        );

        $theposts = new stdClass;
        $arrIdsPosts = array();
        foreach($idsPosts as $oneidp) $arrIdsPosts[] = $oneidp->idpost;

        $total_posts = 0;

        if (count($arrIdsPosts) > 0) {
            $theposts = $this->db2->query('
            SELECT * 
            FROM posts 
            WHERE idpost in ('.implode($arrIdsPosts,',').') 
            ORDER BY post_date DESC');

            $total_posts = $this->db2->num_rows();
        }

        $D->the_place = 6; // 5:dashboard  6:pages feed  7:groups feed  8:saved  9: hashtag
        $D->type_items = 1; // 1: timeline   2: videos   3: audios
        $D->codeprofile = $user->info->code;

        if ($total_posts>0) {
            $count_regs = 0;
            while ($obj = $this->db2->fetch_object($theposts)) {

                $the_post = new post(FALSE, $obj);
                $D->the_list_activities .= $the_post->draw();

                $count_regs++;
                if ($count_regs >= $K->ACTIVITIES_PER_PAGE) break;

            }

            if ($total_posts > $K->ACTIVITIES_PER_PAGE) {

                $D->show_more = $this->load_template('_showmore.php',FALSE);

            }

        }    

    }

    /***********************************************/    

    $D->id_menu = 'opt_ml_pagesfeed';
    
    /****************************************************************************/
    
    $this->load_extract_controller('_pre-dashboard');

    /****************************************************************************/

	if ($D->isPhantom) {

        $html = '';
        $this->load_extract_controller('_dashboard-menu-left');

		if ($D->layout_size == 'min') {
            $for_load = 'min/pages-feed.php';
		} else {
            $for_load = 'max/pages-feed.php';
		}

        $D->titlePhantom = $this->lang('dashboard_pages_feed_title');

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_dashboard-menu-left');

        $D->page_title = $this->lang('dashboard_pages_feed_title');

        $D->file_in_template = 'max/pages-feed.php';
        $this->load_template('dashboard-template.php');

    }

?>