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

    global $K, $D;
    $user = & $GLOBALS['user'];
    $page = & $GLOBALS['page'];
    $network = & $GLOBALS['network'];
    
    $page->loadLanguage('global.php');
    $page->loadLanguage('dashboard.php');
    $page->loadLanguage('activity.php');
    
    $the_sanitaze = new sanitize(); // init sanitaze
    
    $error = FALSE;
    
    $theplace = isset($_POST['plc']) ? (trim($_POST['plc'])) : 0;
    $theplace = $the_sanitaze->int($theplace);

    $typeitems = isset($_POST['typ']) ? (trim($_POST['typ'])) : 0;
    $typeitems = $the_sanitaze->int($typeitems);

    $activity_page = isset($_POST['ap']) ? (trim($_POST['ap'])) : 0;
    $activity_page = $the_sanitaze->int($activity_page);
    
    $code_profile = isset($_POST['cp']) ? (trim($_POST['cp'])) : '';
    $code_profile = $the_sanitaze->str_nohtml($code_profile, 11);

    if (!is_numeric($theplace) || $theplace <= 0) { $error = TRUE; die(); }

    if (!is_numeric($activity_page) || $activity_page <= 0) { $error = TRUE; die(); }

    if (empty($code_profile)) { $error = TRUE; die(); }
    
    if ($error) {
        die();
    } else {
    
        $activities_per_page = $K->ACTIVITIES_PER_PAGE;
        
        $current_post = $activity_page * $activities_per_page;
    
        $the_list_activities = '';
        
        $INPROFILE = FALSE;
        $INDASHBOARD = FALSE;
        
        switch ($theplace) {
            
            case 1:
        
                $iduser = $page->db2->fetch_field("SELECT iduser FROM users WHERE code='".$code_profile."' LIMIT 1");
                
                $D->is_my_profile = 0;
                $D->friendship = 0;
                if ($user->is_logged) {
                    $D->is_my_profile	=  ($iduser == $user->id);
                    $D->friendship = $user->friendship($iduser);	
                }
                
                if ($D->friendship == 1 || $D->is_my_profile) $cadSee = ' (for_who=0 OR for_who=1) ';
                else $cadSee = ' for_who=0 ';
                
                if ($typeitems == 1) $cad_type = '';
                if ($typeitems == 2) $cad_type = ' typepost=2 AND ';
                if ($typeitems == 3) $cad_type = ' typepost=3 AND ';
                
                $res = $page->db2->query("
                SELECT * FROM posts 
                WHERE ".$cad_type." posted_in=0 
                AND id_wall=".$iduser." 
                AND ".$cadSee." 
                ORDER BY idpost DESC 
                LIMIT ".$current_post.", ".($activities_per_page + 1));
                
                $INPROFILE = TRUE;
                
                break;
                
            case 2:

                $idpage = $page->db2->fetch_field("SELECT idpage FROM pages WHERE code='".$code_profile."' LIMIT 1");
                
                if ($typeitems == 1) $cad_type = '';
                if ($typeitems == 2) $cad_type = ' typepost=2 AND ';
                if ($typeitems == 3) $cad_type = ' typepost=3 AND ';
                
                $res = $page->db2->query("
                SELECT * FROM posts 
                WHERE (".$cad_type." posted_in=1 
                AND id_wall=".$idpage.") 
                OR (".$cad_type." idwriter=".$idpage." 
                AND type_writer=1) 
                ORDER BY idpost DESC 
                LIMIT ".$current_post.", ".($activities_per_page + 1));

                $INPROFILE = TRUE;
                
                break;

            case 3:
            
                $idgroup = $page->db2->fetch_field("SELECT idgroup FROM groups WHERE code='".$code_profile."' LIMIT 1");
                
                if ($typeitems == 1) $cad_type = '';
                if ($typeitems == 2) $cad_type = ' typepost=2 AND ';
                if ($typeitems == 3) $cad_type = ' typepost=3 AND ';
                
                $res = $page->db2->query("
                SELECT * FROM posts 
                WHERE ".$cad_type." posted_in=2 
                AND id_wall=".$idgroup." 
                ORDER BY idpost DESC 
                LIMIT ".$current_post.", ".($activities_per_page + 1));

                $INPROFILE = TRUE;
                
                break;
                
            case 4:
                
                break;
                
            case 5:

                $numrelations = $page->db2->fetch_field('SELECT count(id) FROM relations WHERE blocked=0 AND follower='.$user->id);

                if ($numrelations > 0) {

                    $sqlPostsHiddens = 'SELECT idactivity FROM hiddens WHERE typeitem=0 AND iduser='.$user->id;

                    $idsPosts = $page->db2->fetch_all('
                    SELECT DISTINCT id_result as idpost, action, activities.id as idactivity  
                    FROM activities, relations 
                    WHERE 
                    activities.id NOT IN ('.$sqlPostsHiddens.') 
                    AND status=1 
                    AND follower='.$user->id.' 
                    AND who_view<>2 
                    AND leader = idwall
                    AND blocked = 0 
                    AND type_leader = type_wall 
                    AND action=1 
                    OR (status=1 AND type_wall=0 AND idwall='.$user->id.')
                    OR ((status=1 AND iduser='.$user->id.' AND type_user=0) OR (status=1 AND type_wall=0 AND idwall='.$user->id.')) 
                    ORDER BY activities.whendate DESC
                    LIMIT '.$current_post.','.($K->ACTIVITIES_PER_PAGE + 1)
                    );  

                } else {

                    $sqlPostsHiddens = 'SELECT idactivity FROM hiddens WHERE typeitem=0 AND iduser='.$user->id;

                    $idsPosts = $page->db2->fetch_all('
                    SELECT id_result as idpost, action, activities.id as idactivity 
                    FROM activities 
                    WHERE 
                    activities.id NOT IN ('.$sqlPostsHiddens.') 
                    AND status=1 
                    AND (type_wall=0 AND idwall='.$user->id.')
                    AND action=1 
                    ORDER BY whendate DESC
                    LIMIT '.$current_post.','.($K->ACTIVITIES_PER_PAGE + 1)
                    );

                }
                
                $INDASHBOARD = TRUE;

                break;

            case 6:

                $numrelations = $page->db2->fetch_field('SELECT count(id) FROM relations WHERE type_leader=1 AND follower='.$user->id);

                if ($numrelations > 0) {

                    $sqlPostsHiddens = 'SELECT iditem FROM hiddens WHERE typeitem=0 AND iduser='.$user->id;

                    $idsPosts = $page->db2->fetch_all('
                    SELECT DISTINCT idpost 
                    FROM posts, relations 
                    WHERE 
                    posts.idpost NOT IN ('.$sqlPostsHiddens.') 
                    AND follower='.$user->id.' 
                    AND for_who<>2 
                    AND leader = id_wall 
                    AND type_leader = posted_in 
                    AND type_leader = 1 
                    OR (posts.posted_in=1 AND id_wall='.$user->id.')

                    ORDER BY post_date DESC
                    LIMIT '.$current_post.','.($K->ACTIVITIES_PER_PAGE + 1)
                    );

                }
                
                $INDASHBOARD = TRUE;

                break;

            case 7:

                $numrelations = $page->db2->fetch_field('SELECT count(id) FROM relations WHERE type_leader=2 AND follower='.$user->id);

                if ($numrelations > 0) {

                    $sqlPostsHiddens = 'SELECT iditem FROM hiddens WHERE typeitem=0 AND iduser='.$user->id;

                    $idsPosts = $page->db2->fetch_all('
                    SELECT DISTINCT idpost 
                    FROM posts, relations 
                    WHERE 
                    posts.idpost NOT IN ('.$sqlPostsHiddens.') 
                    AND follower='.$user->id.' 
                    AND for_who<>2 
                    AND leader = id_wall 
                    AND type_leader = posted_in 
                    AND type_leader = 2 
                    OR (posts.posted_in=2)

                    ORDER BY post_date DESC
                    LIMIT '.$current_post.','.($K->ACTIVITIES_PER_PAGE + 1)
                    );

                }
                
                $INDASHBOARD = TRUE;

                break;
                
            case 8:
                
                $sqlPostsHiddens = 'SELECT iditem FROM hiddens WHERE typeitem=0 AND iduser='.$user->id;
                
                $idsPosts = $page->db2->fetch_all('
                SELECT idpost  
                FROM posts_saved 
                WHERE 
                idpost NOT IN ('.$sqlPostsHiddens.') 
                AND iduser='.$user->id.' AND type_save=1 
                ORDER BY whendate DESC
                LIMIT '.$current_post.','.($K->ACTIVITIES_PER_PAGE + 1)
                );
                
                $INDASHBOARD = TRUE;

                break;
                
            case 9:

                $INDASHBOARD = TRUE;

                break;

                
        }
        
        
        if ($INPROFILE) {
        
        
            $total_posts = $page->db2->num_rows();
        
            if ($total_posts > 0) {
                $count_regs = 0;
                while ($obj = $page->db2->fetch_object($res)) {
                    
                    $the_post = new post(FALSE, $obj);
                    $the_list_activities .= $the_post->draw();
        
                    $count_regs++;
                    if ($count_regs >= $activities_per_page) {
                        break;
                    }
                }
                
                $more = 0;
                
                if ($total_posts > $activities_per_page) {
                    
                    $more = 1;
                }
                
                if ($total_posts <= $activities_per_page) { 
                
                    switch ($theplace) {
                        
                        case 1:
                
                            $theuser = $network->getUserById($iduser);
                            $D->the_name_user = stripslashes($theuser->firstname).' '.stripslashes($theuser->lastname);
                            $D->the_avatar_real = $theuser->avatar;
                            $D->the_avatar_user_min = $K->STORAGE_URL_AVATARS.'min3/'.($theuser->avatar == $K->DEFAULT_AVATAR_USER ? '' : $theuser->code.'/') . $D->the_avatar_real;
                            $D->the_verified = $theuser->verified;
                            $D->the_register_date = $theuser->registerdate;
                            
                            break;
                            
                        case 2:
                        
                            $thepage = $network->getPageById($idpage);
                            $D->the_avatar_real = $thepage->avatar;
                            $D->the_avatar_page_min = $K->STORAGE_URL_AVATARS_PAGE.'min3/'.($thepage->avatar == $K->DEFAULT_AVATAR_PAGE ? '' : $thepage->code.'/') . $D->the_avatar_real;
                            $D->the_title = $thepage->title;
                            $D->the_register_date = $thepage->created;
                            break;
    
                        case 3:
                        
                            $thegroup = $network->getGroupById($idgroup);
                            $D->the_title = $thegroup->title;
                            $D->the_register_date = $thegroup->created;
                        
                            break;
                    }
                    
                    $D->the_place = $theplace;
                    
                    if ($typeitems != 2 && $typeitems != 3) {
                        $the_list_activities .= $page->load_template('_activity-info-register.php',FALSE);
                    } else {
                        $the_list_activities .= '<div style="margin-bottom:50px;"></div>';
                    }
    
                }
                
                $json_result = array('activities'=>$the_list_activities, 'more'=>$more);
                echo(json_encode($json_result));
                return;         
                
            }
            
        } // en $INPROFILE
        
        
        if ($INDASHBOARD) {
            
            $total_posts_global = count($idsPosts);
            
            $more = 0;
            if ($total_posts_global > $K->ACTIVITIES_PER_PAGE) {
                array_pop($idsPosts); // We eliminate the last element
                $more = 1;
            }

            $theposts = new stdClass;
            $arrIdsPosts = array();
            foreach($idsPosts as $oneidp) $arrIdsPosts[] = $oneidp->idpost;
    
            $total_posts = 0;
    
            if (count($arrIdsPosts) > 0) {
    
                $theposts = $page->db2->query('
                SELECT * 
                FROM posts 
                WHERE idpost in ('.implode($arrIdsPosts,',').') 
                ORDER BY post_date DESC');
    
                $total_posts = $page->db2->num_rows();
    
            }
    
            if ($total_posts > 0) {
                $count_regs = 0;
                while ($obj = $page->db2->fetch_object($theposts)) {
    
                    $the_post = new post(FALSE, $obj);
                    $the_list_activities .= $the_post->draw();
    
                    /*$count_regs++;
                    if ($count_regs >= $activities_per_page) {
                        break;
                    }*/
                }
    /*
                $more = 0;
    
                if ($total_posts_global > $activities_per_page) {
                    $more = 1;
                }
    */
                $json_result = array('activities'=>$the_list_activities, 'more'=>$more);
                echo(json_encode($json_result));
                return;         
    
            }

            
        } // en $INDASHBOARD
        
        
    }
?>