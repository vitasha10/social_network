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
    
    if (!$user->is_logged) {
        echo('ERROR:'.$page->lang('global_txt_no_session'));
        return;
    }

    $the_sanitaze = new sanitize(); // init sanitaze
    
    $error = FALSE;
    
    $activity_page = isset($_POST['ap']) ? (trim($_POST['ap'])) : 0;
    $activity_page = $the_sanitaze->int($activity_page);
    
    $from = isset($_POST['from']) ? (trim($_POST['from'])) : '';
    $from = $the_sanitaze->str_nohtml($from);
    
    if (!is_numeric($activity_page) || $activity_page <= 0) {
        $error = TRUE;
        die();
    }

    if (empty($from)) {
        $error = TRUE;
        die();
    }
    
    if ($error) {
        die();
    } else {
        
        switch ($from) {
            case 'groups':
                
                $current_post = $activity_page * $K->ITEMS_PER_PAGE;
            
                $list_items = '';
                
                $res = $page->db2->query("SELECT * FROM groups WHERE idcreator=".$user->info->iduser." ORDER BY idgroup DESC LIMIT ".$current_post.", ".($K->ITEMS_PER_PAGE + 1));
                $total_items = $page->db2->num_rows();

                $count_regs = 0;
                while ($obj = $page->db2->fetch_object($res)) {
                    
                    $D->group = $obj;
                    $D->group->title = stripslashes($D->group->title);
                    $D->group->guname = stripslashes($D->group->guname);
                    
                    $D->group_last = FALSE;
                    if ($total_items < $count_regs + 2) $D->group_last = TRUE;
                    
                    $list_items .= $page->load_template('ones/one-group.php', FALSE);
        
                    $count_regs++;
                    if ($count_regs >= $K->ITEMS_PER_PAGE) {
                        break;
                    }
                }
                
                $more = 0;
                
                if ($total_items > $K->ITEMS_PER_PAGE) $more = 1;
                
                $json_result = array('items'=>$list_items, 'more'=>$more);
                echo(json_encode($json_result));
                return;

                break;

            case 'pages':

                $current_post = $activity_page * $K->ITEMS_PER_PAGE;
            
                $list_items = '';
                
                $res = $page->db2->query("SELECT * FROM pages WHERE idcreator=".$user->info->iduser." ORDER BY idpage DESC LIMIT ".$current_post.", ".($K->ITEMS_PER_PAGE + 1));
                $total_items = $page->db2->num_rows();

                $count_regs = 0;
                while ($obj = $page->db2->fetch_object($res)) {
                    
                    $D->page = $obj;
                    $D->page->title = stripslashes($D->page->title);
                    $D->page->puname = stripslashes($D->page->puname);                    
                    $D->page->avatar = empty($D->page->avatar) ? $K->DEFAULT_AVATAR_PAGE : $D->page->avatar;
                    $D->page->avatar = $K->STORAGE_URL_AVATARS_PAGE.'min2/'.($D->page->avatar == $K->DEFAULT_AVATAR_PAGE ? '' : $D->page->code.'/') . $D->page->avatar;
                    $D->nameCategory = stripslashes($network->getNameCatPage($D->page->idsubcat));
                    
                    $D->page_last = FALSE;
                    if ($total_items < $count_regs + 2) $D->page_last = TRUE;
                    
                    $list_items .= $page->load_template('ones/one-page.php', FALSE);
        
                    $count_regs++;
                    if ($count_regs >= $K->ITEMS_PER_PAGE) {
                        break;
                    }
                }
                
                $more = 0;
                
                if ($total_items > $K->ITEMS_PER_PAGE) $more = 1;
                
                $json_result = array('items'=>$list_items, 'more'=>$more);
                echo(json_encode($json_result));
                return;

                break;

            case 'photos':
                
                $current_post = $activity_page * $K->ITEMS_PER_PAGE;
            
                $list_items = '';
                
                $res = $page->db2->query("SELECT * FROM albums WHERE idcreator=".$user->info->iduser." ORDER BY idalbum DESC LIMIT ".$current_post.", ".($K->ITEMS_PER_PAGE + 1));
                $total_items = $page->db2->num_rows();

                $count_regs = 0;
                while ($obj = $page->db2->fetch_object($res)) {
                    
                    $D->album = $obj;
                    $D->album->title = stripslashes($D->album->title);
                    $D->album->code = stripslashes($D->album->code);
                    
                    $D->album_last = FALSE;
                    if ($total_items < $count_regs + 2) $D->album_last = TRUE;
                    
                    $list_items .= $page->load_template('ones/one-album.php', FALSE);
        
                    $count_regs++;
                    if ($count_regs >= $K->ITEMS_PER_PAGE) {
                        break;
                    }
                }
                
                $more = 0;
                
                if ($total_items > $K->ITEMS_PER_PAGE) $more = 1;
                
                $json_result = array('items'=>$list_items, 'more'=>$more);
                echo(json_encode($json_result));
                return;

                break;
 
             case 'ublocked':
            	$page->loadLanguage('settings.php');
                
                $current_post = $activity_page * $K->ITEMS_PER_PAGE;
            
                $list_items = '';
                
                $res = $page->db2->query("SELECT users.* FROM users, users_blocked WHERE users_blocked.iduserblocked=users.iduser AND users_blocked.iduser=".$user->info->iduser." ORDER BY id DESC LIMIT ".$current_post.", ".($K->ITEMS_PER_PAGE + 1));
                $total_items = $page->db2->num_rows();

                $count_regs = 0;
                while ($obj = $page->db2->fetch_object($res)) {

                    $D->user_blocked = $obj;
                    $D->user_blocked->user_code = stripslashes($D->user_blocked->code);
                    $D->user_blocked->user_username = stripslashes($D->user_blocked->user_username);
                    $D->user_blocked->firstname = stripslashes($D->user_blocked->firstname);
                    $D->user_blocked->lastname = stripslashes($D->user_blocked->lastname);
                    $D->user_blocked->num_friends = $D->user_blocked->num_friends;
                    $D->user_blocked->avatar =  empty($D->user_blocked->avatar) ? $K->DEFAULT_AVATAR_USER : stripslashes($D->user_blocked->avatar);
                    $D->user_blocked->avatar = $K->STORAGE_URL_AVATARS.'min2/'.($D->user_blocked->avatar == $K->DEFAULT_AVATAR_PAGE ? '' : $D->user_blocked->user_code.'/') . $D->user_blocked->avatar;
            
                    $D->user_blocked_last = FALSE;
                    if ($total_items < $count_regs + 2) $D->user_blocked_last = TRUE;
            
                    $list_items .= $page->load_template('ones/one-user-blocked.php', FALSE);
            
                    $count_regs++;
                    if ($count_regs >= $K->ITEMS_PER_PAGE) break;
                    
                }
                
                $more = 0;
                
                if ($total_items > $K->ITEMS_PER_PAGE) $more = 1;

                $json_result = array('items'=>$list_items, 'more'=>$more);
                echo(json_encode($json_result));
                return;
            
                break;

                
            case 'directory':

                $K->ITEMS_PER_PAGE = $K->ITEMS_PER_PAGE_DIRECTORY;
            
                $current_post = $activity_page * $K->ITEMS_PER_PAGE;
            
                $list_items = '';
                
                $res = $page->db2->query("SELECT * FROM users WHERE active=1 ORDER BY iduser DESC LIMIT ".$current_post.", ".($K->ITEMS_PER_PAGE + 1));
                $total_items = $page->db2->num_rows();

                $count_regs = 0;
                while ($obj = $page->db2->fetch_object($res)) {
                    
                    $D->one_item_directory = $obj;
                    $D->one_item_directory->firstname = stripslashes($D->one_item_directory->firstname);
                    $D->one_item_directory->lastname = stripslashes($D->one_item_directory->lastname);
                    
                    $D->one_item_directory->username = $D->one_item_directory->user_username;
                    
                    if (empty($obj->avatar)) $D->one_item_directory->avatar = $K->DEFAULT_AVATAR_USER;
                    $base_url = $K->STORAGE_URL_AVATARS.'min4/';
                    $D->the_avatar_item = $base_url.$D->one_item_directory->avatar;
                    if ($D->one_item_directory->avatar != $K->DEFAULT_AVATAR_USER) $D->the_avatar_item = $base_url.$D->one_item_directory->code.'/'.$D->one_item_directory->avatar;
            
                    $list_items .= $page->load_template('ones/one-item-directory.php', FALSE);
            
                    $count_regs++;
                    if ($count_regs >= $K->ITEMS_PER_PAGE) break;
                    
                }
                
                $more = 0;
                
                if ($total_items > $K->ITEMS_PER_PAGE) $more = 1;

                $json_result = array('items'=>$list_items, 'more'=>$more);
                echo(json_encode($json_result));
                return;
            
                break;
                
            case 'myevents':
            
                $current_post = $activity_page * $K->ITEMS_PER_PAGE;
            
                $list_items = '';
                
                $res = $page->db2->query("SELECT * FROM events WHERE idcreator=".$user->info->iduser." ORDER BY idevent DESC LIMIT ".$current_post.", ".($K->ITEMS_PER_PAGE + 1));
                $total_items = $page->db2->num_rows();

                $count_regs = 0;
                while ($obj = $page->db2->fetch_object($res)) {
                    
                    $D->event = $obj;
                    $D->event->title = stripslashes($D->event->title);
                    $D->event->code = stripslashes($D->event->code);                    

                    $D->event_last = FALSE;
                    if ($total_items < $count_regs + 2) $D->event_last = TRUE;
                    
                    $list_items .= $page->load_template('ones/one-event.php', FALSE);
        
                    $count_regs++;
                    if ($count_regs >= $K->ITEMS_PER_PAGE) {
                        break;
                    }
                }
                
                $more = 0;
                
                if ($total_items > $K->ITEMS_PER_PAGE) $more = 1;
                
                $json_result = array('items'=>$list_items, 'more'=>$more);
                echo(json_encode($json_result));
                return;

            
                break;

            case 'events':
            
                $current_post = $activity_page * $K->ITEMS_PER_PAGE;
            
                $list_items = '';

                          
                
                $events = $page->db2->fetch_all('SELECT * FROM events ORDER BY start_unix DESC LIMIT '.$current_post.', '.($K->ITEMS_PER_PAGE + 1));
            
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
                        $D->themonth_s = ucfirst(strtolower($page->lang('global_month_'.$D->themonth_s)));
                        $D->theday_s = date("j", strtotime($oneevent->date_start));
                        $D->date_start = $page->lang('global_format_date_event', array('#MONTH#' => $D->themonth_s, '#DAY#' => $D->theday_s));
                        
                        $themonth_e = date("n", strtotime($oneevent->date_end));
                        $themonth_e = ucfirst(strtolower($page->lang('global_month_'.$themonth_e)));
                        $theday_e = date("j", strtotime($oneevent->date_end));
                        $D->date_end = $page->lang('global_format_date_event', array('#MONTH#' => $themonth_e, '#DAY#' => $theday_e));
                        
                        $D->date_of_event = '';
                        if ($D->date_end == $D->date_start) $D->date_of_event = $D->date_start;
                        else $D->date_of_event = $D->date_start.' - '.$D->date_end;
                        
                        $D->going = $page->db2->fetch_field('SELECT count(id) FROM events_actions WHERE idevent='.$D->idevent.' AND type_action=2');
                        $D->interested = $page->db2->fetch_field('SELECT count(id) FROM events_actions WHERE idevent='.$D->idevent.' AND type_action=1');
                        
                        $D->url_event = $K->SITE_URL.'event/'.$D->codee_event;
                        
                        $list_items .= $page->load_template('ones/one-event-max.php', FALSE);
                        
            
                        $count_regs++;
                        if ($count_regs >= $K->ITEMS_PER_PAGE) break;
                        
                    }
                    
                    if ($total_items > $K->ITEMS_PER_PAGE) $more = 1;
            
            
                }
                
                $json_result = array('items'=>$list_items, 'more'=>$more);
                echo(json_encode($json_result));
                return;
            
                break;


            case 'myproducts':
                            
                $current_post = $activity_page * $K->ITEMS_PER_PAGE;
            
                $list_items = '';
                
                $res = $page->db2->query("SELECT * FROM products WHERE idsell=".$user->info->iduser."  ORDER BY idproduct DESC LIMIT ".$current_post.", ".($K->ITEMS_PER_PAGE + 1));
                $total_items = $page->db2->num_rows();

                $count_regs = 0;
                while ($obj = $page->db2->fetch_object($res)) {
                    
                    $D->product = $obj;
                    $D->product->name = stripslashes($D->product->name);
                    $idcurrency = $D->product->currency;
                    
                    $D->currency = $network->getCurrencySymbol($idcurrency);
            
                    $D->product->price = number_format($D->product->price, 2);
            
                    $D->product_last = FALSE;
                    if ($total_items < $count_regs + 2) $D->product_last = TRUE;
            
                    $list_items .= $page->load_template('ones/one-product.php', FALSE);
            
                    $count_regs++;
                    if ($count_regs >= $K->ITEMS_PER_PAGE) break;

                }

                $more = 0;
                
                if ($total_items > $K->ITEMS_PER_PAGE) $more = 1;
                
                $json_result = array('items'=>$list_items, 'more'=>$more);
                echo(json_encode($json_result));
                return;
            
                break;

            case 'marketplace':
            
                $K->ITEMS_PER_PAGE = $K->ITEMS_PER_PAGE_MARKETPLACE;
                            
                $current_post = $activity_page * $K->ITEMS_PER_PAGE;
            
                $list_items = '';
                
                $res = $page->db2->query("SELECT * FROM products ORDER BY idproduct DESC LIMIT ".$current_post.", ".($K->ITEMS_PER_PAGE + 1));
                $total_items = $page->db2->num_rows();

                $count_regs = 0;
                while ($obj = $page->db2->fetch_object($res)) {
                    
                    $D->product = $obj;
                    $D->product->name = stripslashes($D->product->name);
                    $idcurrency = $D->product->currency;
                    
                    $D->currency = $network->getCurrencySymbol($idcurrency);
            
                    $D->product->price = number_format($D->product->price, 2);
                    
                    $D->photo = array();
                    $photos_prod = $page->db2->fetch_all("SELECT * FROM products_images WHERE idproduct=".$D->product->idproduct);
                    if ($photos_prod) {
                        foreach ($photos_prod as $onephoto) {
                            $D->photo[] = $onephoto->photo;
                        }
                    }
                    $D->photo_product = $K->STORAGE_URL_PRODUCTS . $D->photo[0];
                    
                    $D->product->location = stripslashes($D->product->location);
                    
                    $theusername_of_sell = $page->db2->fetch_field("SELECT user_username FROM users WHERE iduser=".$D->product->idsell." LIMIT 1");
                    $code_post_prod = $page->db2->fetch_field("SELECT code FROM posts WHERE idpost=".$D->product->idpost." LIMIT 1");
                    
                    $D->product->url = $K->SITE_URL.$theusername_of_sell.'/post/'.$code_post_prod;
            

                    $list_items .= $page->load_template('ones/one-product-market.php', FALSE);
            
                    $count_regs++;
                    if ($count_regs >= $K->ITEMS_PER_PAGE) break;

                }

                $more = 0;
                
                if ($total_items > $K->ITEMS_PER_PAGE) $more = 1;
                
                $json_result = array('items'=>$list_items, 'more'=>$more);
                echo(json_encode($json_result));
                return;
            
                break;
                
            case 'library':
            
                $K->ITEMS_PER_PAGE = $K->ITEMS_PER_PAGE_LIBRARY;
                            
                $current_post = $activity_page * $K->ITEMS_PER_PAGE;
            
                $list_items = '';
                
                $res = $page->db2->query("SELECT * FROM articles ORDER BY idarticle DESC LIMIT ".$current_post.", ".($K->ITEMS_PER_PAGE + 1));
                $total_items = $page->db2->num_rows();

                $count_regs = 0;
                while ($obj = $page->db2->fetch_object($res)) {
                    
                    $D->article = $obj;
                    $D->article->title = stripslashes($D->article->title);
                    $D->article->photo = $K->STORAGE_URL_ARTICLES.$D->article->photo;
                    
                    $thecategories = $network->getCategoriesArticle($D->article->idarticle, FALSE);
                    $D->subcategory_article = stripslashes($thecategories->subcategory);

                    $D->the_writer_a = $page->db2->fetch("SELECT code, user_username, firstname, lastname FROM users WHERE iduser=".$D->article->idwriter." LIMIT 1");

                    $list_items .= $page->load_template('ones/one-article-library.php', FALSE);
            

                    $count_regs++;
                    if ($count_regs >= $K->ITEMS_PER_PAGE) break;

                }

                $more = 0;
                
                if ($total_items > $K->ITEMS_PER_PAGE) $more = 1;
                
                $json_result = array('items'=>$list_items, 'more'=>$more);
                echo(json_encode($json_result));
                return;
            
                break;
                
            case 'myarticles':
            
                $current_post = $activity_page * $K->ITEMS_PER_PAGE;
            
                $list_items = '';
                
                $res = $page->db2->query("SELECT * FROM articles WHERE idwriter=".$user->info->iduser." ORDER BY idarticle DESC LIMIT ".$current_post.", ".($K->ITEMS_PER_PAGE + 1));
                $total_items = $page->db2->num_rows();

                $count_regs = 0;
                while ($obj = $page->db2->fetch_object($res)) {
                    
                    $D->article = $obj;
                    $D->article->title = stripslashes($D->article->title);
                    $D->article->code = $D->article->code;
                    $D->categories = $network->getCategoriesArticle(FALSE, $D->article->code);               

                    $D->article_last = FALSE;
                    if ($total_items < $count_regs + 2) $D->article_last = TRUE;
                    
                    $list_items .= $page->load_template('ones/one-article.php', FALSE);
        
                    $count_regs++;
                    if ($count_regs >= $K->ITEMS_PER_PAGE) {
                        break;
                    }
                }
                
                $more = 0;
                
                if ($total_items > $K->ITEMS_PER_PAGE) $more = 1;
                
                $json_result = array('items'=>$list_items, 'more'=>$more);
                echo(json_encode($json_result));
                return;

            
                break;
            
        }
        
        
        
    }
?>