<?php
class post
{
    private $user;
    private $network;
    private $db1;
    private $db2;
    private $page;
	
	public $idactivity;
    
    public $post_idpost;
    public $post_code;
    public $post_writer;
    public $post_type_writer;
    public $post_user2;
    public $post_page;
    public $post_group;
    public $post_message;
    public $post_typepost;
    public $post_posted_in;
    public $post_id_wall;
    public $post_idembed;
    public $post_idmedia;
    public $post_for_who;
    public $post_numcomments;
    public $post_numlikes;
    public $post_numshares;
    public $post_with_users;
    public $post_feeling;
    public $post_location_in;
    public $post_date;
    public $post_moreinfo;
    
    public $in_where; // 0: User in your profile,  1: user in other user,   2: user in a page,   3: user in a group,   4: page in you page,   5: page in other page
    
    public $item2_code;
    public $item2_name;
    public $item2_uname;

    public $is_shared = FALSE;
    
    public $error = FALSE;

    public $tmp;
    
    public function __construct($load_id = FALSE, $load_obj = FALSE)
    {
        global $K;
        $this->tmp = new stdClass;
        $this->network = & $GLOBALS['network'];
        $this->user = & $GLOBALS['user'];
        $this->page = & $GLOBALS['page'];
        $this->db1 = & $GLOBALS['db1'];
        $this->db2 = & $GLOBALS['db2'];


        if ($load_id) {
            $idpost = intval($load_id);
            $r = $this->db2->query('SELECT * FROM posts WHERE idpost="'.$idpost.'" LIMIT 1', FALSE);
            if (!$obj = $this->db2->fetch_object($r)) {
                $this->error = TRUE;
                return;
            }
        } elseif ($load_obj) {
            $obj = $load_obj;
            $idpost = intval($obj->idpost);
            if (!$idpost) {
                $this->error = TRUE;
                return;
            }
        } else {
            $this->error = TRUE;
            return;
        }

        $this->post_idpost = intval($obj->idpost);
        $this->post_code = $obj->code;
        $this->post_posted_in = intval($obj->posted_in);
        $this->post_id_wall = intval($obj->id_wall);
        $this->post_idembed = intval($obj->idembed);
        $this->post_message = htmlspecialchars_decode(stripslashes($obj->message), ENT_QUOTES);
        $this->post_typepost = intval($obj->typepost);
        $this->post_idmedia = $obj->idmedia;
        $this->post_for_who = intval($obj->for_who);
        $this->post_numcomments = intval($obj->numcomments);
        $this->post_numlikes = intval($obj->numlikes);
        $this->post_numshares = intval($obj->numshares);
        $this->post_with_users = stripslashes($obj->with_users);
        $this->post_feeling = stripslashes($obj->feeling);
        $this->post_location_in = stripslashes($obj->location_in);
        $this->post_moreinfo = stripslashes($obj->moreinfo);
		
		$this->idactivity = intval($obj->idactivity);

        $this->post_date = intval($obj->post_date);

        $this->post_type_writer = $obj->type_writer;

        if ($obj->type_writer == 0) {

            $this->post_writer = $this->network->getUserById($obj->idwriter);

            switch ($obj->posted_in) {
                case 0:
                    // in a profile
                    if ($obj->idwriter == $obj->id_wall) {
                        $this->post_user2 = FALSE;
                        $this->in_where = 0;
                    } else {
                        $this->post_user2 = $this->network->getUserById($obj->id_wall);
                        $this->in_where = 1;
                        
                        $this->item2_code = $this->post_user2->code;
                        $this->item2_name = stripslashes($this->post_user2->firstname).' '.stripslashes($this->post_user2->lastname);
                        $this->item2_uname = stripslashes($this->post_user2->user_username);
                    }
                    break;
    
                case 1:
                    // in a page
                    $this->post_page = $this->network->getPageById($obj->id_wall);
                    $this->in_where = 2;    

                    $this->item2_code = $this->post_page->code;
                    $this->item2_name = stripslashes($this->post_page->title);
                    $this->item2_uname = stripslashes($this->post_page->puname);

                    break;
    
                case 2:
                    // in group
                    $this->post_group = $this->network->getGroupById($obj->id_wall);
                    $this->in_where = 3;
                    
                    $this->item2_code = $this->post_group->code;
                    $this->item2_name = stripslashes($this->post_group->title);
                    $this->item2_uname = stripslashes($this->post_group->guname);

                    break;
                    
                case 3:
                    // in event
                    $this->post_event = $this->network->getEventById($obj->id_wall);
                    $this->in_where = 6;
                    
                    $this->item2_code = $this->post_event->code;
                    $this->item2_name = stripslashes($this->post_event->title);
                    $this->item2_uname = 'event/'.$this->post_event->code;

                    break;
            }


        } else {

            $this->post_writer = $this->network->getPageById($obj->idwriter);
            
            if ($obj->posted_in == 1) {

                if ($obj->idwriter == $obj->id_wall) {
                    $this->post_page = FALSE;
                    $this->in_where = 4;
                } else {
                    $this->post_page = $this->network->getPageById($obj->id_wall);
                    $this->in_where = 5;
                    
                    $this->item2_code = $this->post_page->code;
                    $this->item2_name = stripslashes($this->post_page->title);
                    $this->item2_uname = stripslashes($this->post_page->puname);
                }
                
            }
            
        }

        if (!$this->post_writer) {
            $this->error =TRUE;
            return;
        }
    }
    
    public function getAvatarWriter()
    {
        global $K;
        $url_avatar = '';
        if ($this->post_type_writer == 0) {
            $base_url = $K->STORAGE_URL_AVATARS.'min2/';
            $url_avatar = $base_url.$this->post_writer->avatar;
            if ($this->post_writer->avatar != $K->DEFAULT_AVATAR_USER) $url_avatar = $base_url.$this->post_writer->code.'/'.$this->post_writer->avatar;
        } else {
            $base_url = $K->STORAGE_URL_AVATARS_PAGE.'min2/';
            $url_avatar = $base_url.$this->post_writer->avatar;
            if ($this->post_writer->avatar != $K->DEFAULT_AVATAR_PAGE) $url_avatar = $base_url.$this->post_writer->code.'/'.$this->post_writer->avatar;
        }
        return $url_avatar;
    }

    public function getNameWriter()
    {
        $name_writer = '';
        if ($this->post_type_writer == 0) {
            $name_writer = stripslashes($this->post_writer->firstname).' '.stripslashes($this->post_writer->lastname);
        } else {
            $name_writer = stripslashes($this->post_writer->title);
        }
        return $name_writer;
    }
    
    public function isEditable()
    {
        
        if ($this->post_typepost == 7) return FALSE;
        
        if ($this->post_type_writer == 0) {
            // the writer is an user
            if ($this->user->id == $this->post_writer->iduser) return TRUE;
        }

        if ($this->post_type_writer == 1) {
            // the writer is a page
            if ($this->user->id == $this->post_writer->idcreator) return TRUE;
        }

        return FALSE;
    }
    
    public function isRemovable()
    {
        
        if ($this->post_typepost == 11) return FALSE;
        if ($this->post_typepost == 12) return FALSE;
        
        if ($this->isEditable()) return TRUE;
        
        switch ($this->in_where) {
            case 0:
                if ($this->user->id == $this->post_id_wall && $this->user->id == $this->post_writer->iduser) return TRUE;
                break;

            case 1:
                if ($this->user->id == $this->post_user2->iduser) return TRUE;
                break;

            case 2:
                if ($this->user->id == $this->post_page->idcreator) return TRUE;
                break;

            case 3:
                if ($this->user->id == $this->post_group->idcreator) return TRUE;                
                break;

            case 4:
                if ($this->user->id == $this->post_writer->idcreator) return TRUE;
                break;
                
            case 5:
                if ($this->user->id == $this->post_page->idcreator) return TRUE;
                break;
                
            case 6:
                if ($this->user->id == $this->post_event->idcreator) return TRUE;
                break;

        }

        return FALSE;        
    }

    public function isReportable()
    {
        if (!$this->isEditable() && !$this->isRemovable()) return TRUE;

        return FALSE;        
    }

    public function isHideable()
    {
        if (!$this->isEditable() && !$this->isRemovable()) return TRUE;

        return FALSE;        
    }
    
    public function isShareable()
    {
        $shareable = TRUE;
        
        if ($this->post_for_who > 0) $shareable = FALSE;
        if ($this->post_posted_in == 2) $shareable = FALSE;
        
        if ($this->post_type_writer == 0) {
            // the writer is an user, and owner
            if ($this->user->id == $this->post_writer->iduser) $shareable = TRUE;
        }
        
        return $shareable;        
    }
	
    public function isSaveable()
    {
        return TRUE;
    }
    
    public function draw()
    {
        global $K, $D;
        
        $D->code_activity = $this->post_code;
		
		$D->idactivity = $this->idactivity;
        
        $D->code_for_share = $D->code_activity;
        
        $D->post_is_editable = FALSE;
        $D->post_is_removable = FALSE;
        $D->post_is_reportable = FALSE;
        $D->post_is_hideable = FALSE;
        
        if ($D->_IS_LOGGED) {
            
            $D->avatar_user = $this->user->getAvatar(1);
        
            $the_menu_activity = array();
			
            $D->post_is_saveable = $this->isSaveable();
            if ($D->post_is_saveable) {
				
				$numsaved = $this->db2->fetch_field("SELECT count(id) FROM posts_saved WHERE idpost=".$this->post_idpost." AND iduser=".$this->user->id, FALSE);
				
				if ($numsaved > 0) {
					$status_save = 'hide';
					$status_unsave = 'visible';
				} else {
					$status_save = 'visible';
					$status_unsave = 'hide';
				}				
				
				$the_menu_activity[] = array('id_option' => 'optma_save_'.$this->post_code, 'url' => '', 'rel' => '', 'target' => '', 'text_option' =>  $this->page->lang('activity_txt_save'), 'status' => $status_save);
				$the_menu_activity[] = array('id_option' => 'optma_unsave_'.$this->post_code, 'url' => '', 'rel' => '', 'target' => '', 'text_option' =>  $this->page->lang('activity_txt_unsave'), 'status' => $status_unsave);	
            
            }
            
            $D->post_is_editable = $this->isEditable();
            if ($D->post_is_editable && ($this->post_typepost != 4)) {
                $the_menu_activity[] = array('id_option' => 'optma_edit_'.$this->post_code, 'url' => '', 'rel' => '', 'target' => '', 'text_option' =>  $this->page->lang('activity_txt_edit'), 'status' => 'visible');
            
            }
            
            $D->post_is_removable = $this->isRemovable();
            if ($D->post_is_removable && ($this->post_typepost != 4 && $this->post_typepost != 5 && $this->post_typepost != 6)) {
                $the_menu_activity[] = array('id_option' => 'optma_delete_'.$this->post_code, 'url' => '', 'rel' => '', 'target' => '', 'text_option' =>  $this->page->lang('activity_txt_delete'), 'status' => 'visible');
            }
    
            $D->post_is_reportable = $this->isReportable();
            if ($D->post_is_reportable) {
                if ($this->user->isPostReported($this->post_idpost)) {
                    $the_menu_activity[] = array('id_option' => 'optma_ureport_'.$this->post_code, 'url' => '', 'rel' => '', 'target' => '', 'text_option' =>  $this->page->lang('activity_txt_ureport'), 'status' => 'visible');
                } else {
                    $the_menu_activity[] = array('id_option' => 'optma_report_'.$this->post_code, 'url' => '', 'rel' => '', 'target' => '', 'text_option' =>  $this->page->lang('activity_txt_reportable'), 'status' => 'visible');
                }
            }
    
            $D->post_is_hideable = $this->isHideable();
            if ($D->post_is_hideable) {
                $the_menu_activity[] = array('id_option' => 'optma_hide_'.$this->post_code, 'url' => '', 'rel' => '', 'target' => '', 'text_option' =>  $this->page->lang('activity_txt_hideable'), 'status' => 'visible');
            }
            
            $designer = new designer();
        
            $D->block_menu_activity = $designer->createMenuActivity($the_menu_activity);
            
            $D->code_visitor = $this->user->info->code;
            $D->type_visitor = 0;

            $D->liketoUser = FALSE;
            if ($this->network->itemLiketoUser($this->user->id, $this->post_type_writer, $this->post_idpost, 0)) $D->liketoUser = TRUE;
    
        }
        
        $D->activity_avatar = $this->getAvatarWriter();
        $D->activity_who_does_it = $this->getNameWriter();
        $D->activity_who_does_it_code = $this->post_writer->code;
        $D->activity_who_does_it_username = ($this->post_type_writer == 0 ? $this->post_writer->user_username : $this->post_writer->puname); 
        $D->activity_post_posted_in = $this->post_posted_in;
        $D->post_is_shareable = $this->isShareable();
        
        $D->show_bottom = FALSE;
        
        $D->activity_numlikes = $this->post_numlikes;
        if ($D->activity_numlikes > 0) $D->show_bottom = true;
        $D->activity_numshares = $this->post_numshares;
        if ($D->activity_numlikes > 0) $D->show_bottom = true;
        
        $D->activity_for_who = $this->post_for_who;

        
        $D->activity_whendate = '<span class="thelivestamp"  title="'.date('F j, Y, g:i a', $this->post_date).'" data-locale="'.$K->LANGUAGE.'" data-livestamp="'.$this->post_date.'"></span>';
        
        switch($this->post_for_who) {
            case 0:
                $D->icono_typepost = getImageTheme('typepost-public.png');
                break;
            case 1:
                $D->icono_typepost = getImageTheme('typepost-friends.png');
                break;
            case 2:
                $D->icono_typepost = getImageTheme('typepost-onlyme.png');
                break;
        }
        
        $D->activity_message_original = $this->post_message;
        
        $D->activity_message_cut = '';
        
        if (strlen($this->post_message) > $K->CHARS_VIEW_IN_POST) $D->activity_message_cut = analyzeMessage(str_cut($this->post_message, $K->CHARS_VIEW_IN_POST));
        
        $D->activity_message = analyzeMessage($this->post_message);
        
        $D->text_actions = '';
        $D->html_shared = '';
        $D->html_attach = '';
        $D->post_typepost = $this->post_typepost;
        switch ($this->post_typepost) {
            case 1:
			case 5:
			case 6:
                $allphotos = $this->db2->fetch_all('SELECT * FROM medias WHERE posted_in=0 AND idcontainer='.$this->post_idpost.' ORDER BY idmedia DESC');
                $D->num_photos = count($allphotos);
                if ($D->num_photos > 0) {
                    
                    $D->more_photos = FALSE;
                    if ($D->num_photos > 4) {
                        $D->more_photos = TRUE;
                        $D->how_many = $D->num_photos - 3;
                    }
                    
                    $width = $allphotos[0]->width;
                    $height = $allphotos[0]->height;

                    if ($width >= $height) $layout = 'landscape';
                    if ($width < $height) $layout = 'vertical';
                    
                    switch ($D->num_photos) {
                        case 1:
                            $template = 'one-'.$layout;
                            break;
                        case 2:
                            $template = 'two-'.$layout;
                            break;
                        case 3:
                            $template = 'three-'.$layout;
                            break;
                        default:
                            $template = 'four-'.$layout;
                            break;
                    }
                    
                    $D->code_writer = $this->post_writer->code;
                    
                    $D->photo = array();
                    foreach ($allphotos as $onephoto) {
                        $D->photo[] = $onephoto;
                    }
                    $D->is_shared = FALSE;
                    $D->html_attach = $this->page->load_template('attach/'.$template.'.php', FALSE);    
                }
				
				if ($this->post_typepost == 5) {
					if ($this->in_where != 3) $D->text_actions = $this->page->lang('activity_txt_update_cover');
				}
				if ($this->post_typepost == 6) $D->text_actions = $this->page->lang('activity_txt_update_phprofile');
                
                break;
            case 2:
                $r = $this->db2->query('SELECT * FROM medias WHERE idmedia='.$this->post_idmedia.' LIMIT 1', FALSE);
                if ($obj = $this->db2->fetch_object($r)) {
                    $D->file_src = $K->STORAGE_URL_VIDEOS.$this->post_writer->code.'/'.$obj->namefile;
                    $D->html_attach = $this->page->load_template('attach/attach-video.php', FALSE);    
                }
                break;
            case 3:
                $r = $this->db2->query('SELECT * FROM medias WHERE idmedia='.$this->post_idmedia.' LIMIT 1', FALSE);
                if ($obj = $this->db2->fetch_object($r)) {
                    $D->file_src = $K->STORAGE_URL_AUDIOS.$this->post_writer->code.'/'.$obj->namefile;
                    $D->html_attach = $this->page->load_template('attach/attach-audio.php', FALSE);
                }
                break;
            case 4:
                $the_text_action = $this->page->lang('activity_txt_created_an_album');
                $D->the_name_of_album = '';
                $the_album = $this->db2->fetch("SELECT code, title, created, modified FROM albums WHERE idpost=".$this->post_idpost." LIMIT 1");
                if ($the_album) {
                    
                    $D->the_name_of_album = stripslashes($the_album->title);
            
                    $allphotos = $this->db2->fetch_all("SELECT * FROM medias WHERE posted_in=2 AND codecontainer='".$the_album->code."' ORDER BY idmedia DESC");
                    $D->num_photos = count($allphotos);
                    if ($D->num_photos > 0) {
                        
                        $D->more_photos = FALSE;
                        if ($D->num_photos > 4) {
                            $D->more_photos = TRUE;
                            $D->how_many = $D->num_photos - 3;
                        }
                        
                        $width = $allphotos[0]->width;
                        $height = $allphotos[0]->height;
    
                        if ($width >= $height) $layout = 'landscape';
                        if ($width < $height) $layout = 'vertical';
                        
                        switch ($D->num_photos) {
                            case 1:
                                $template = 'album-one-'.$layout;
                                break;
                            case 2:
                                $template = 'album-two-'.$layout;
                                break;
                            case 3:
                                $template = 'album-three-'.$layout;
                                break;
                            default:
                                $template = 'album-four-'.$layout;
                                break;
                        }
                        
                        $D->code_writer = $this->post_writer->code;
                        
                        $D->photo = array();
                        foreach ($allphotos as $onephoto) {
                            $D->photo[] = $onephoto;
                        }
                        $D->is_shared = FALSE;
                        $D->code_post_album = $D->code_activity;
                        $D->html_attach = $this->page->load_template('attach/'.$template.'.php', FALSE);    
                    }
                    if ($the_album->created != $the_album->modified) $the_text_action = $this->page->lang('activity_txt_updated_an_album');
                }
                $D->text_actions = $the_text_action .': <span style="font-weight:bold;">'. $D->the_name_of_album . '</span>';
                break;
            case 5:
                $D->text_actions = $this->page->lang('activity_txt_update_cover');
                break;
            case 6:
                $D->text_actions = $this->page->lang('activity_txt_update_phprofile');
                break;
            case 7:
                $D->text_actions = $this->page->lang('activity_txt_created_a_event');
                
                $r = $this->db2->query('SELECT * FROM events WHERE idpost='.$this->post_idpost.' LIMIT 1', FALSE);
                if ($obj = $this->db2->fetch_object($r)) {
                    $D->idevent = $obj->idevent;
                    $D->codee_event = $obj->code;
                    $D->title_event = stripslashes($obj->title);
                    $D->cover_event = $obj->cover;
                    $D->cover_position_event = $obj->cover_position;
                    if (!empty($D->cover_event)) {
                        $D->cover_event = $K->STORAGE_URL_COVERS_EVENT.$D->codee_event.'/'.$D->cover_event;
                    }

                    $D->themonth_s = date("n", strtotime($obj->date_start));
                    $D->themonth_s = ucfirst(strtolower($this->page->lang('global_month_'.$D->themonth_s)));
                    $D->theday_s = date("j", strtotime($obj->date_start));
                    $D->date_start = $this->page->lang('global_format_date_event', array('#MONTH#' => $D->themonth_s, '#DAY#' => $D->theday_s));
                    
                    $themonth_e = date("n", strtotime($obj->date_end));
                    $themonth_e = ucfirst(strtolower($this->page->lang('global_month_'.$themonth_e)));
                    $theday_e = date("j", strtotime($obj->date_end));
                    $D->date_end = $this->page->lang('global_format_date_event', array('#MONTH#' => $themonth_e, '#DAY#' => $theday_e));
                    
                    $D->date_of_event = '';
                    if ($D->date_end == $D->date_start) $D->date_of_event = $D->date_start;
                    else $D->date_of_event = $D->date_start.' - '.$D->date_end;
                    
                    
                    $n = $this->db1->fetch_field('SELECT count(id) FROM events_actions WHERE idevent='.$D->idevent.' AND type_action=2');
                    $D->going = $n;
                    $D->interested = $this->db2->fetch_field('SELECT count(id) FROM events_actions WHERE idevent='.$D->idevent.' AND type_action=1');
                    
                    $D->url_event = $K->SITE_URL.'event/'.$D->codee_event;
                    $D->html_attach = $this->page->load_template('attach/an-event.php', FALSE);
                }
                break;
            case 8:
                $more_info = explode(':', $this->post_moreinfo);
                $post_shared = new post($more_info[1]);
                $post_shared->is_shared = TRUE;
                $D->text_actions = $this->page->lang('activity_txt_shared_post');
                $D->code_for_share = $more_info[0];
                if ($post_shared->error) {
                    $D->html_shared = $this->page->load_template('ones/one-activity-shared-nofound.php', FALSE);
                } else {
                    $D->html_shared = $post_shared->drawShared();
                }
                break;
            case 9:
                break;
            case 10:
                break;
            case 11:
                $D->text_actions = $this->page->lang('activity_txt_created_a_article');
                
                $article = $this->db2->fetch("SELECT * FROM articles WHERE idpost=".$this->post_idpost." LIMIT 1");
                
                if ($article) {

                    $D->article = $article;
                    $D->article->title = stripslashes($D->article->title);
                    $D->article->photo = $K->STORAGE_URL_ARTICLES.'min1/'.$D->article->photo;
                    
                    $thecategories = $this->network->getCategoriesArticle($D->article->idarticle, FALSE);
                    $D->subcategory_article = stripslashes($thecategories->subcategory);
        
                    $D->the_writer_a = $this->db2->fetch("SELECT code, user_username, firstname, lastname FROM users WHERE iduser=".$D->article->idwriter." LIMIT 1");    
                    $D->html_attach = $this->page->load_template('attach/an-article-post.php', FALSE);
                    
                }
                
                
                break;
            case 12:
                $D->text_actions = $this->page->lang('activity_txt_created_a_product');
                
                $product = $this->db2->fetch("SELECT products.*, users.code as ucode, user_username, firstname, lastname  FROM products, users WHERE idsell=iduser AND idpost=".$this->post_idpost." LIMIT 1");

                $D->product_code = $product->code;
                
                $D->product->name = stripslashes($product->name);

                $idcurrency = $product->currency;                
                $D->currency = $this->network->getCurrencySymbol($idcurrency);

                $D->product->description = stripslashes($product->description);
                
                $D->product->type = $product->type_product;
        
                $D->product->price = number_format($product->price, 2);
    
                $D->photo_produc = array();
                $photos_prod = $this->db2->fetch_all("SELECT * FROM products_images WHERE idproduct=".$product->idproduct);
                if ($photos_prod) {
                    foreach ($photos_prod as $onephoto) {
                        $D->photo_produc[] = $onephoto->photo;
                    }
                }
                $D->url_photo_product = $K->STORAGE_URL_PRODUCTS . 'min2/' . $D->photo_produc[0];
                $D->url_photo_max_product = $K->STORAGE_URL_PRODUCTS . $D->photo_produc[0];
                
                $D->product->location = stripslashes($product->location);
                
                $D->owner_prod = TRUE;
                if ($this->user->id != $product->idsell) {
                    //$D->theuser_prod = $this->db2->fetch("SELECT code, user_username, firstname, lastname FROM users WHERE iduser=".$product->idsell." LIMIT 1");
                    $D->theuser_prod->code = $product->ucode;
                    $D->theuser_prod->user_username = $product->user_username;
                    $D->theuser_prod->firstname = $product->firstname;
                    $D->theuser_prod->lastname = $product->lastname;
                    $D->owner_prod = FALSE;
                }
                
                $D->html_attach = $this->page->load_template('attach/an-product-post.php', FALSE);
                
                break;

        }
        
        $D->html_embed = '';
        if ($this->post_idembed != 0) {
            $r = $this->db2->query('SELECT * FROM posts_embed WHERE idembed="'.$this->post_idembed.'" LIMIT 1', FALSE);
            if ($obj = $this->db2->fetch_object($r)) {
                $infoEmbed = array();
                $infoEmbed['e_url'] = trim($obj->e_url);
                $infoEmbed['e_title'] = trim($obj->e_title);
                $infoEmbed['e_text'] = trim($obj->e_text);
                $infoEmbed['e_type'] = $obj->e_type;

                if ($obj->type_embed == 1) {
                    $infoEmbed['e_host'] = trim($obj->e_host);
                    $infoEmbed['e_thumbnail'] = trim($obj->e_thumbnail);
                    $thetype = 1;
                    $template_embed = 'attach/embed-link.php';
                } else {
                    $infoEmbed['e_html'] = trim($obj->e_html);
                    
                    // "Restore" the iframe, script tag
                    $infoEmbed['e_html'] = str_replace('ifr+ame', 'iframe', $infoEmbed['e_html']);
                    $infoEmbed['e_html'] = str_replace('scr+ipt', 'script', $infoEmbed['e_html']);
                    
                    $infoEmbed['e_provider'] = trim($obj->e_provider);
                    $thetype = 2;
                    if ($infoEmbed['e_type'] == "photo") $template_embed = 'attach/embed-photo.php';                    
                    else {
                        $template_embed = 'attach/embed-media.php';
                        $D->withoutBorder = TRUE;
                    }
                }
                $D->infoEmbed = $infoEmbed;
                $D->html_embed = $this->page->load_template($template_embed, FALSE);
            }
        }

        $D->in_where = $this->in_where;
        
        $D->item1_type = $this->post_type_writer;

        /***********************************/
        $more_text_in_post = '';
        if (!empty($this->post_feeling)) $more_text_in_post = $this->page->lang('activity_txt_feeling').' <span class="bold">'.$this->post_feeling.'</span>';
        if (!empty($this->post_with_users)) $more_text_in_post .= (!empty($more_text_in_post) ? ' ' : '').$this->page->lang('activity_txt_with').' <span class="bold">'.$this->post_with_users.'</span>';
        if (!empty($this->post_location_in)) $more_text_in_post .= (!empty($more_text_in_post) ? ' ' : '').$this->page->lang('activity_txt_in').' <span class="bold">'.$this->post_location_in.'</span>';
        
        if (!empty($more_text_in_post)) $more_text_in_post = $more_text_in_post;
        
        $D->more_text_in_post_top = '';
        $D->more_text_in_post_bottom = '';
        if ($this->in_where == 0 || $this->in_where == 4) {
            if (!empty($more_text_in_post)) $D->more_text_in_post_top = ' — '.$more_text_in_post;
        } else {
            if (!empty($more_text_in_post)) $D->more_text_in_post_bottom = $more_text_in_post;
            $D->item2_code = $this->item2_code;
            $D->item2_name = $this->item2_name;
            $D->item2_uname = $this->item2_uname;
            $D->item2_type = $this->post_posted_in;
        }
        
        /***********************************/
        
        
        // the comments
        $D->comments_html = '';
        $the_comments = $this->db2->fetch_all("SELECT idcomment FROM comments WHERE iditem=".$this->post_idpost." AND typeitem=0 ORDER BY whendate ASC");
        if (count($the_comments) > 0) {
            foreach ($the_comments as $one_comment) {
                $D->comment = new comment($one_comment->idcomment);
                $D->comments_html .= $D->comment->draw();
                unset($D->comment);
            }
        }
        if (!empty($D->comments_html)) $D->show_bottom = TRUE;

        if ($D->_IS_LOGGED) $D->show_bottom = TRUE;
        
        return $this->page->load_template('ones/one-activity.php',FALSE);
        
    }

    public function drawShared()
    {
        global $K, $D;
        
        $D->is_shared = FALSE;
        if ($this->is_shared) $D->is_shared = TRUE;
        
        $D->shared = new stdClass;
        
        $D->shared->code_activity = $this->post_code;
        
        $D->shared->activity_avatar = $this->getAvatarWriter();
        $D->shared->activity_who_does_it = $this->getNameWriter();
        $D->shared->activity_who_does_it_code = $this->post_writer->code;
        $D->shared->activity_who_does_it_username = ($this->post_type_writer == 0 ? $this->post_writer->user_username : $this->post_writer->puname); 
        $D->shared->activity_post_posted_in = $this->post_posted_in;
        $D->shared->post_is_shareable = $this->isShareable();
        
        $D->shared->show_bottom = FALSE;
        
        $D->shared->activity_numlikes = $this->post_numlikes;
        if ($D->shared->activity_numlikes > 0) $D->shared->show_bottom = true;
        $D->shared->activity_numshares = $this->post_numshares;
        if ($D->shared->activity_numlikes > 0) $D->shared->show_bottom = true;
        
        $D->shared->activity_for_who = $this->post_for_who;

        
        $D->shared->activity_whendate = '<span class="thelivestamp" data-locale="'.$K->LANGUAGE.'" data-livestamp="'.$this->post_date.'"></span>';
        
        switch($this->post_for_who) {
            case 0:
                $D->shared->icono_typepost = getImageTheme('typepost-public.png');
                break;
            case 1:
                $D->shared->icono_typepost = getImageTheme('typepost-friends.png');
                break;
            case 2:
                $D->shared->icono_typepost = getImageTheme('typepost-onlyme.png');
                break;            
        }
        
        $D->shared->activity_message_original = $this->post_message;
        
        if (strlen($this->post_message) > $K->CHARS_VIEW_IN_POST) $D->shared->activity_message_cut = analyzeMessage(str_cut($this->post_message, $K->CHARS_VIEW_IN_POST));
        
        $D->shared->activity_message = analyzeMessage($this->post_message);
        
        $D->shared->text_actions = '';
        $D->shared->html_attach = '';
        switch ($this->post_typepost) {
			case 5:
			case 6:
            case 1:
                $allphotos = $this->db2->fetch_all('SELECT * FROM medias WHERE posted_in=0 AND idcontainer='.$this->post_idpost.' ORDER BY idmedia DESC');
                $D->shared->num_photos = count($allphotos);
                if ($D->shared->num_photos > 0) {
                    
                    $D->shared->more_photos = FALSE;
                    if ($D->shared->num_photos > 4) {
                        $D->shared->more_photos = TRUE;
                        $D->shared->how_many = $D->shared->num_photos - 3;
                    }
                    
                    $width = $allphotos[0]->width;
                    $height = $allphotos[0]->height;

                    if ($width >= $height) $layout = 'landscape';
                    if ($width < $height) $layout = 'vertical';
                    
                    switch ($D->shared->num_photos) {
                        case 1:
                            $template = 'one-'.$layout;
                            break;
                        case 2:
                            $template = 'two-'.$layout;
                            break;
                        case 3:
                            $template = 'three-'.$layout;
                            break;
                        default:
                            $template = 'four-'.$layout;
                            break;
                    }
                    
                    $D->shared->code_writer = $this->post_writer->code;
                    
                    // especial case in attach
                    $D->photo = array();
                    foreach ($allphotos as $onephoto) {
                        $D->photo[] = $onephoto;
                    }
                    
                    
                    if ($this->post_typepost == 5) {
                        if ($this->in_where != 3) $D->shared->text_actions = $this->page->lang('activity_txt_update_cover');
                    }
                    if ($this->post_typepost == 6) $D->shared->text_actions = $this->page->lang('activity_txt_update_phprofile');
                    
                    
                    $D->shared->html_attach = $this->page->load_template('attach/'.$template.'.php', FALSE);    
                }
                
                break;
            case 2:
                $r = $this->db2->query('SELECT * FROM medias WHERE idmedia='.$this->post_idmedia.' LIMIT 1', FALSE);
                if ($obj = $this->db2->fetch_object($r)) {
                    $D->shared->file_src = $K->STORAGE_URL_VIDEOS.$this->post_writer->code.'/'.$obj->namefile;
                    $D->shared->html_attach = $this->page->load_template('attach/attach-video.php', FALSE);    
                }
                break;
            case 3:
                $r = $this->db2->query('SELECT * FROM medias WHERE idmedia='.$this->post_idmedia.' LIMIT 1', FALSE);
                if ($obj = $this->db2->fetch_object($r)) {
                    $D->shared->file_src = $K->STORAGE_URL_AUDIOS.$this->post_writer->code.'/'.$obj->namefile;
                    $D->shared->html_attach = $this->page->load_template('attach/attach-audio.php', FALSE);    
                }
                break;
            case 4:
                $the_text_action = $this->page->lang('activity_txt_created_an_album');
                $D->the_name_of_album = '';
                $the_album = $this->db2->fetch("SELECT code, title, created, modified FROM albums WHERE idpost=".$this->post_idpost." LIMIT 1");
                if ($the_album) {
                    
                    $D->the_name_of_album = stripslashes($the_album->title);
            
                    $allphotos = $this->db2->fetch_all("SELECT * FROM medias WHERE posted_in=2 AND codecontainer='".$the_album->code."' ORDER BY idmedia DESC");
                    $D->num_photos = count($allphotos);
                    if ($D->num_photos > 0) {
                        
                        $D->more_photos = FALSE;
                        if ($D->num_photos > 4) {
                            $D->more_photos = TRUE;
                            $D->how_many = $D->num_photos - 3;
                        }
                        
                        $width = $allphotos[0]->width;
                        $height = $allphotos[0]->height;
    
                        if ($width >= $height) $layout = 'landscape';
                        if ($width < $height) $layout = 'vertical';
                        
                        switch ($D->num_photos) {
                            case 1:
                                $template = 'album-one-'.$layout;
                                break;
                            case 2:
                                $template = 'album-two-'.$layout;
                                break;
                            case 3:
                                $template = 'album-three-'.$layout;
                                break;
                            default:
                                $template = 'album-four-'.$layout;
                                break;
                        }
                        
                        $D->code_writer = $this->post_writer->code;
                        
                        $D->photo = array();
                        foreach ($allphotos as $onephoto) {
                            $D->photo[] = $onephoto;
                        }
                        $D->code_post_album = $D->shared->code_activity;
                        $D->shared->html_attach = $this->page->load_template('attach/'.$template.'.php', FALSE);    
                    }
                    
                    if ($the_album->created != $the_album->modified) $the_text_action = $this->page->lang('activity_txt_updated_an_album');
                    
                }
                $D->shared->text_actions = $the_text_action .': <span style="font-weight:bold;">'. $D->the_name_of_album . '</span>';
                break;
            case 5:
                break;
            case 6:
                break;
            case 7:
                $D->shared->text_actions = $this->page->lang('activity_txt_created_a_event');
                
                $r = $this->db2->query('SELECT * FROM events WHERE idpost='.$this->post_idpost.' LIMIT 1', FALSE);
                if ($obj = $this->db2->fetch_object($r)) {
                    $D->idevent = $obj->idevent;
                    $D->codee_event = $obj->code;
                    $D->title_event = stripslashes($obj->title);
                    $D->cover_event = $obj->cover;
                    $D->cover_position_event = $obj->cover_position;
                    if (!empty($D->cover_event)) {
                        $D->cover_event = $K->STORAGE_URL_COVERS_EVENT.$D->codee_event.'/'.$D->cover_event;
                    }

                    $D->themonth_s = date("n", strtotime($obj->date_start));
                    $D->themonth_s = ucfirst(strtolower($this->page->lang('global_month_'.$D->themonth_s)));
                    $D->theday_s = date("j", strtotime($obj->date_start));
                    $D->date_start = $this->page->lang('global_format_date_event', array('#MONTH#' => $D->themonth_s, '#DAY#' => $D->theday_s));
                    
                    $themonth_e = date("n", strtotime($obj->date_end));
                    $themonth_e = ucfirst(strtolower($this->page->lang('global_month_'.$themonth_e)));
                    $theday_e = date("j", strtotime($obj->date_end));
                    $D->date_end = $this->page->lang('global_format_date_event', array('#MONTH#' => $themonth_e, '#DAY#' => $theday_e));
                    
                    $D->date_of_event = '';
                    if ($D->date_end == $D->date_start) $D->date_of_event = $D->date_start;
                    else $D->date_of_event = $D->date_start.' - '.$D->date_end;
                    
                    
                    $n = $this->db1->fetch_field('SELECT count(id) FROM events_actions WHERE idevent='.$D->idevent.' AND type_action=2');
                    $D->going = $n;
                    $D->interested = $this->db2->fetch_field('SELECT count(id) FROM events_actions WHERE idevent='.$D->idevent.' AND type_action=1');
                    
                    $D->url_event = $K->SITE_URL.'event/'.$D->codee_event;
                    $D->shared->html_attach = $this->page->load_template('attach/an-event.php', FALSE);
                }
                break;
            case 8:
                $D->shared->text_actions = $this->page->lang('activity_txt_shared_post');
                break;
            case 9:
                break;
            case 10:
                break;
            case 11:
            
                $D->shared->text_actions = $this->page->lang('activity_txt_created_a_article');
                
                $article = $this->db2->fetch("SELECT * FROM articles WHERE idpost=".$this->post_idpost." LIMIT 1");
                
                if ($article) {

                    $D->article = $article;
                    $D->article->title = stripslashes($D->article->title);
                    $D->article->photo = $K->STORAGE_URL_ARTICLES.'min1/'.$D->article->photo;
                    
                    $thecategories = $this->network->getCategoriesArticle($D->article->idarticle, FALSE);
                    $D->subcategory_article = stripslashes($thecategories->subcategory);
        
                    $D->the_writer_a = $this->db2->fetch("SELECT code, user_username, firstname, lastname FROM users WHERE iduser=".$D->article->idwriter." LIMIT 1");    
                    $D->shared->html_attach = $this->page->load_template('attach/an-article-post.php', FALSE);
                    
                }
                
                break;
                
            case 12:
                $D->shared->text_actions = $this->page->lang('activity_txt_created_a_product');
                
                $product = $this->db2->fetch("SELECT * FROM products WHERE idpost=".$this->post_idpost." LIMIT 1");

                $D->product_code = $product->code;
                
                $D->product->name = stripslashes($product->name);

                $idcurrency = $product->currency;                
                $D->currency = $this->network->getCurrencySymbol($idcurrency);

                $D->product->description = stripslashes($product->description);
                
                $D->product->type = $product->type;
        
                $D->product->price = number_format($product->price, 2);
    
                $D->photo_produc = array();
                $photos_prod = $this->db2->fetch_all("SELECT * FROM products_images WHERE idproduct=".$product->idproduct);
                if ($photos_prod) {
                    foreach ($photos_prod as $onephoto) {
                        $D->photo_produc[] = $onephoto->photo;
                    }
                }
                $D->url_photo_product = $K->STORAGE_URL_PRODUCTS . 'min2/' . $D->photo_produc[0];
                $D->url_photo_max_product = $K->STORAGE_URL_PRODUCTS . $D->photo_produc[0];
                
                $D->product->location = stripslashes($product->location);
                
                $D->owner_prod = TRUE;
                if ($this->user->id != $product->idsell) {
                    $D->theuser_prod = $this->db2->fetch("SELECT code, user_username, firstname, lastname FROM users WHERE iduser=".$product->idsell." LIMIT 1");
                    $D->owner_prod = FALSE;
                }
                
                $D->shared->html_attach = $this->page->load_template('attach/an-product-post.php', FALSE);
                
                break;
                
                
        }
        
        $D->shared->html_embed = '';
        if ($this->post_idembed != 0) {
            $r = $this->db2->query('SELECT * FROM posts_embed WHERE idembed="'.$this->post_idembed.'" LIMIT 1', FALSE);
            if ($obj = $this->db2->fetch_object($r)) {
                $infoEmbed = array();
                $infoEmbed['e_url'] = trim($obj->e_url);
                $infoEmbed['e_title'] = trim($obj->e_title);
                $infoEmbed['e_text'] = trim($obj->e_text);
                $infoEmbed['e_type'] = $obj->e_type;

                if ($obj->type_embed == 1) {
                    $infoEmbed['e_host'] = trim($obj->e_host);
                    $infoEmbed['e_thumbnail'] = trim($obj->e_thumbnail);
                    $thetype = 1;
                    $template_embed = 'attach/embed-link-shared.php';
                } else {
                    $infoEmbed['e_html'] = trim($obj->e_html);
                    
                    // "Restore" the iframe, script tag
                    $infoEmbed['e_html'] = str_replace('ifr+ame', 'iframe', $infoEmbed['e_html']);
                    $infoEmbed['e_html'] = str_replace('scr+ipt', 'script', $infoEmbed['e_html']);
                    
                    $infoEmbed['e_provider'] = trim($obj->e_provider);
                    $thetype = 2;
                    if ($infoEmbed['e_type'] == "photo") $template_embed = 'attach/embed-photo-shared.php';                    
                    else {
                        $template_embed = 'attach/embed-media-shared.php';
                        $D->shared->withoutBorder = TRUE;
                    }
                }
                $D->shared->infoEmbed = $infoEmbed;
                $D->shared->html_embed = $this->page->load_template($template_embed, FALSE);
            }
        }

        $D->shared->in_where = $this->in_where;
        
        $D->shared->item1_type = $this->post_type_writer;

        /***********************************/
        $more_text_in_post = '';
        if (!empty($this->post_feeling)) $more_text_in_post = $this->page->lang('activity_txt_feeling').' <span class="bold">'.$this->post_feeling.'</span>';
        if (!empty($this->post_with_users)) $more_text_in_post .= (!empty($more_text_in_post) ? ' ' : '').$this->page->lang('activity_txt_with').' <span class="bold">'.$this->post_with_users.'</span>';
        if (!empty($this->post_location_in)) $more_text_in_post .= (!empty($more_text_in_post) ? ' ' : '').$this->page->lang('activity_txt_in').' <span class="bold">'.$this->post_location_in.'</span>';
        
        if (!empty($more_text_in_post)) $more_text_in_post = $more_text_in_post;
        
        $D->shared->more_text_in_post_top = '';
        $D->shared->more_text_in_post_bottom = '';
        if ($this->in_where == 0 || $this->in_where == 4) {
            if (!empty($more_text_in_post)) $D->shared->more_text_in_post_top = ' — '.$more_text_in_post;
        } else {
            if (!empty($more_text_in_post)) $D->shared->more_text_in_post_bottom = $more_text_in_post;
            $D->shared->item2_code = $this->item2_code;
            $D->shared->item2_name = $this->item2_name;
            $D->shared->item2_uname = $this->item2_uname;
            $D->shared->item2_type = $this->post_posted_in;
        }
        
        /***********************************/
        
        return $this->page->load_template('ones/one-activity-shared.php',FALSE);
        
    }
    
    public function updateTypePost($newtype)
    {
        if ($newtype < 0) return FALSE;
        $this->db2->query("UPDATE posts SET for_who=".$newtype." WHERE idpost=".$this->post_idpost);
    }
    
    public function updateMessage($newmessage)
    {
        if (empty($newmessage)) return FALSE;
        
        $this->db2->query("UPDATE posts SET message='".$newmessage."' WHERE idpost=".$this->post_idpost);
        
        $message = $newmessage;
        
        $mentioned = array();
        if( preg_match_all('/\@([a-zA-Z0-9\-_]{3,30})/u', $newmessage, $matches, PREG_PATTERN_ORDER) ) {
            foreach($matches[1] as $unm) {
                if( $usr = $this->network->getUserByUsername($unm) ) {
                    $mentioned[] = $usr->iduser;
                }
            }
        }
        $mentioned = array_unique($mentioned);
        
        $thehashtags = array();

        if( preg_match_all('/\#([\pL0-9_]{1,50})/iu', $message, $matches, PREG_PATTERN_ORDER) ) {
            foreach($matches[1] as $tg) {
                $thehashtags[] = mb_strtolower(trim($tg));
            }
        }
        
        foreach ($mentioned as $idu) {
            $this->db2->query("INSERT INTO mentions SET typecontainer=0, idcontainer=".$this->post_idpost.", idwriter=".$this->post_writer->iduser.", type_writer=".$this->post_type_writer.", iduser_mentioned=".intval($idu), FALSE);
        }
        
        if (count($thehashtags) > 0) {
            $post_tags_in_brackets = array();
            $unique_posttags = array();
            $unique_posttags = array_unique($thehashtags);
            
            foreach ($unique_posttags as $tag) {
                $post_tags_in_brackets[] = "('".$tag."', ".$this->post_writer->iduser.", ".$this->post_type_writer.", ".$this->post_idpost.", '".time()."')";
            }		
            
            $this->db2->query('INSERT INTO hashtags (hashtag, idwriter, type_writer, idpost, thedate ) VALUES '.implode( ',', $post_tags_in_brackets ), FALSE);
            unset($post_tags_in_brackets, $unique_posttags);
        }      
        
    }
        
    private function _deleteNotifications()
    {
        $this->db2->query('DELETE FROM notifications WHERE iditem_notif='.$this->post_idpost.' AND typeitem_notif=1');
        if ($this->post_typepost == 8) $this->db2->query('DELETE FROM notifications WHERE result='.$this->post_idpost.' AND typeitem_notif=1');
    }
    
    private function _deleteHashtags()
    {
        $this->db2->query('DELETE FROM hashtags WHERE idpost='.$this->post_idpost);
    }
    
    private function _deleteMentions()
    {
        $this->db2->query('DELETE FROM mentions WHERE typecontainer=0 AND idcontainer='.$this->post_idpost);
    }
    
    private function _deleteReports($typeItem, $iditem)
    {
        $this->db2->query('DELETE FROM reports WHERE typeitem='.$typeItem.' AND iditem='.$iditem);
    }

    private function _deleteLikes($typeItem, $iditem)
    {
        $this->db2->query('DELETE FROM likes WHERE typeitem='.$typeItem.' AND iditem='.$iditem);
    }

    private function _deleteHiddens($typeItem, $iditem)
    {
        $this->db2->query('DELETE FROM hiddens WHERE typeitem='.$typeItem.' AND iditem='.$iditem);
    }
	
    private function _deleteSaveds($iditem)
    {
		$this->db2->query("DELETE FROM posts_saved WHERE idpost=".$iditem." AND type_save=1");
    }

    private function _deleteMedia()
    {
        global $K;
        if ($this->post_typepost == 2) {
            $r = $this->db2->query('SELECT idmedia, namefile FROM medias WHERE typemedia=1 AND posted_in=0 AND idmedia='.$this->post_idmedia.' LIMIT 1');
            if ($obj = $this->db2->fetch_object($r)) {
                $this->_deleteComments(1, $obj->idmedia);
                $this->_deleteLikes(2, $obj->idmedia);

                $the_file = $K->STORAGE_DIR_VIDEOS.$this->post_writer->code.'/'.$obj->namefile;
                if (file_exists($the_file)) unlink($the_file);

            }
            $this->db2->query('DELETE FROM medias WHERE typemedia=1 AND posted_in=0 AND idmedia='.$this->post_idmedia.' LIMIT 1');
        }

        if ($this->post_typepost == 3) {
            $r = $this->db2->query('SELECT idmedia, namefile FROM medias WHERE typemedia=2 AND posted_in=0 AND idmedia='.$this->post_idmedia.' LIMIT 1');
            if ($obj = $this->db2->fetch_object($r)) {
                $this->_deleteComments(1, $obj->idmedia);
                $this->_deleteLikes(2, $obj->idmedia);

                $the_file = $K->STORAGE_DIR_AUDIOS.$this->post_writer->code.'/'.$obj->namefile;
                if (file_exists($the_file)) unlink($the_file);

            }
            $this->db2->query('DELETE FROM medias WHERE typemedia=2 AND posted_in=0 AND idmedia='.$this->post_idmedia.' LIMIT 1');            
        }
        
        if ($this->post_typepost == 4) {
            
            $allphotos = $this->db2->fetch_all('SELECT idmedia, namefile FROM medias WHERE typemedia=0 AND posted_in=2 AND idcontainer='.$this->post_idpost);
            if ($allphotos) {
                foreach ($allphotos as $onephoto) {
                    $this->_deleteComments(1, $onephoto->idmedia);
                    $this->_deleteLikes(2, $onephoto->idmedia);
                    $this->_deleteOnePhotoAlbum($onephoto->namefile);
                    
                    $this->db2->query('DELETE FROM notifications WHERE iditem_notif='.$onephoto->idmedia.' AND typeitem_notif=6');
                }
                $this->db2->query('DELETE FROM medias WHERE typemedia=0 AND posted_in=2 AND idcontainer='.$this->post_idpost);
            }
                        
        }
        
    }
    
    private function _deleteOnePhotoAlbum($filephoto)
    {
        global $K;
        $the_file = $K->STORAGE_DIR_ALBUMS_USERS.'original/'.$this->post_writer->code.'/'.$filephoto;
        if (file_exists($the_file)) unlink($the_file);

        $the_file = $K->STORAGE_DIR_ALBUMS_USERS.'thumb1/'.$this->post_writer->code.'/'.$filephoto;
        if (file_exists($the_file)) unlink($the_file);

        $the_file = $K->STORAGE_DIR_ALBUMS_USERS.'thumb2/'.$this->post_writer->code.'/'.$filephoto;
        if (file_exists($the_file)) unlink($the_file);

        $the_file = $K->STORAGE_DIR_ALBUMS_USERS.'thumb3/'.$this->post_writer->code.'/'.$filephoto;
        if (file_exists($the_file)) unlink($the_file);

        $the_file = $K->STORAGE_DIR_ALBUMS_USERS.'thumb4/'.$this->post_writer->code.'/'.$filephoto;
        if (file_exists($the_file)) unlink($the_file);
    }

    private function _deleteOnePhoto($filephoto)
    {
        global $K;
        $the_file = $K->STORAGE_DIR_PHOTOS.'original/'.$this->post_writer->code.'/'.$filephoto;
        if (file_exists($the_file)) unlink($the_file);

        $the_file = $K->STORAGE_DIR_PHOTOS.'thumb1/'.$this->post_writer->code.'/'.$filephoto;
        if (file_exists($the_file)) unlink($the_file);

        $the_file = $K->STORAGE_DIR_PHOTOS.'thumb2/'.$this->post_writer->code.'/'.$filephoto;
        if (file_exists($the_file)) unlink($the_file);

        $the_file = $K->STORAGE_DIR_PHOTOS.'thumb3/'.$this->post_writer->code.'/'.$filephoto;
        if (file_exists($the_file)) unlink($the_file);

        $the_file = $K->STORAGE_DIR_PHOTOS.'thumb4/'.$this->post_writer->code.'/'.$filephoto;
        if (file_exists($the_file)) unlink($the_file);
    }
    
    private function _deletePhotos($posted_in, $idcontainer)
    {
        $allphotos = $this->db2->fetch_all('SELECT idmedia, namefile FROM medias WHERE typemedia=0 AND posted_in='.$posted_in.' AND idcontainer='.$idcontainer);
        foreach ($allphotos as $onephoto) {
            $this->_deleteComments(1, $onephoto->idmedia);
            $this->_deleteLikes(2, $onephoto->idmedia);
            $this->_deleteOnePhoto($onephoto->namefile);
        }
        $this->db2->query('DELETE FROM medias WHERE typemedia=0 AND posted_in='.$posted_in.' AND idcontainer='.$idcontainer);
    }
    
    private function _deleteComments($typeItem, $iditem)
    {
        $this->_deleteActivity(0, 2, $this->post_idpost);
        $allcomments = $this->db2->fetch_all('SELECT idcomment FROM comments WHERE typeitem='.$typeItem.' AND iditem='.$iditem);
		foreach ($allcomments as $onecomments) {
			$this->_deleteReports(1, $onecomments->idcomment);
		    $this->_deleteHiddens(1, $onecomments->idcomment);
            $this->_deleteLikes(1, $onecomments->idcomment);
        }
        $this->db2->query('DELETE FROM comments WHERE typeitem='.$typeItem.' AND iditem='.$iditem);
    }
    
    private function _deleteEmbed()
    {
        if ($this->post_idembed != 0) $this->db2->query('DELETE FROM posts_embed WHERE idembed='.$this->post_idembed.' LIMIT 1');
    }
    
    private function _deleteActivity($where, $action, $id_where)
    {
        $this->db2->query('DELETE FROM activities WHERE where_was_made='.$where.' AND action='.$action.' AND id_where='.$id_where);
    }
    
    public function deletePost()
    {
        $this->db2->query('DELETE FROM posts WHERE idpost='.$this->post_idpost.' LIMIT 1');
        
        if ($this->post_typepost == 8) {
            $more_info = explode(':', $this->post_moreinfo);
            $this->db2->query("UPDATE posts SET numshares=numshares-1 WHERE idpost=".$more_info[1]." LIMIT 1");
        }
        
        $this->_deleteActivity(0, 1, $this->post_idpost);
        $this->_deleteEmbed();
        $this->_deleteComments(0, $this->post_idpost);
        $this->_deleteLikes(0,  $this->post_idpost);
        $this->_deleteNotifications();
        $this->_deleteHashtags();
        $this->_deleteMentions();
        $this->_deletePhotos(0, $this->post_idpost);
        $this->_deleteReports(0, $this->post_idpost);
        $this->_deleteHiddens(0, $this->post_idpost);
        $this->_deleteMedia();
		$this->_deleteSaveds($this->post_idpost);
    }
    
}
?>