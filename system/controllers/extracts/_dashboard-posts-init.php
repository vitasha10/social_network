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

    $D->show_more = '';
    $D->the_list_activities = '';

    $numrelations = $this->db2->fetch_field('SELECT count(id) FROM relations WHERE blocked=0 AND follower='.$this->user->id);

    if ($numrelations > 0) {

        $sqlPostsHiddens = 'SELECT idactivity FROM hiddens WHERE typeitem=0 AND iduser='.$this->user->id;
        
        $idsPosts = $this->db2->fetch_all('
        SELECT DISTINCT id_result as idpost, action, activities.id as idactivity  
        FROM activities, relations 
        WHERE 
		activities.id NOT IN ('.$sqlPostsHiddens.') 
        AND status=1 
        AND follower='.$this->user->id.' 
        AND who_view<>2 
        AND leader = idwall
        AND blocked = 0 
        AND type_leader = type_wall 
        AND action=1 
        OR (status=1 AND type_wall=0 AND idwall='.$this->user->id.')
        OR ((status=1 AND iduser='.$this->user->id.' AND type_user=0) OR (status=1 AND type_wall=0 AND idwall='.$this->user->id.')) 
        ORDER BY activities.whendate DESC
        LIMIT 0,'.($K->ACTIVITIES_PER_PAGE + 1)
        );

    } else {

        $sqlPostsHiddens = 'SELECT idactivity FROM hiddens WHERE typeitem=0 AND iduser='.$this->user->id;
        
        $idsPosts = $this->db2->fetch_all('
        SELECT id_result as idpost, action, activities.id as idactivity 
        FROM activities 
        WHERE 
		activities.id NOT IN ('.$sqlPostsHiddens.') 
        AND status=1 
        AND (type_wall=0 AND idwall='.$this->user->id.')
        AND action=1 
        ORDER BY whendate DESC
        LIMIT 0,'.($K->ACTIVITIES_PER_PAGE + 1)
        );

    }
	
    $D->the_place = 5; // 5:dashboard  6:pages feed  7:groups feed  8:saved  9: hashtag
    $D->type_items = 1; // 1: timeline   2: videos   3: audios
    $D->codeprofile = $this->user->info->code;

	$total_posts_global = count($idsPosts);

    $more = FALSE;
    if ($total_posts_global > $K->ACTIVITIES_PER_PAGE) {
        array_pop($idsPosts); // We eliminate the last element
        $more = TRUE;
    }

	
	if ($total_posts_global > 0) {

        /****/
        $ids_posts = array();
        foreach ($idsPosts as $oneidp) {
            //if ($oneidp->action == 1) {
                $ids_posts[] = $oneidp->idpost;
            //}
        }
        
        if (count($ids_posts) > 0) {
        
            $strings_ids_posts = implode(',', $ids_posts);
            
            $res = $this->db2->query("SELECT * FROM posts WHERE idpost IN (".$strings_ids_posts.") ORDER BY post_date DESC");
            
            $total_posts = $this->db2->num_rows();
            
            if ($total_posts>0) {

                //$count_regs = 0;
                while ($obj = $this->db2->fetch_object($res)) {
        
                    $the_post = (is_object($obj) && get_class($obj) == 'post') ? $obj : new post(FALSE, $obj);
                    $D->the_list_activities .= $the_post->draw();
        
                    //$count_regs++;
                    //if ($count_regs >= $K->ACTIVITIES_PER_PAGE) break;
        
                }
            }
        
        }
        
        /****/
		
        //if ($total_posts_global > $K->ACTIVITIES_PER_PAGE) {
        if ($more) {

            $D->show_more = $this->load_template('_showmore.php',FALSE);

        }
		
	} else {

        $D->the_list_activities .= $this->load_template('_activity-welcome.php',FALSE);

    }

    $D->the_list_activities = '<div id="list-activities">'. $D->the_list_activities . '</div>';
