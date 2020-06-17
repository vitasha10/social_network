<?php
class newpost
{
    private $network = FALSE;
    private $user = FALSE;
    private $page = FALSE;
    private $group = FALSE;
    private $db1;
    private $db2;
    public $idpost = FALSE;
    public $code = FALSE;
    public $message = '';
    public $mentioned = array();
    public $photos = array();
    public $name_video = '';
    public $name_audio = '';
    public $num_hashtags = 0;
    public $hashtags = array();
    public $typepost = 0;
    public $idwriter;
    public $type_writer;
    public $code_writer;

    public $id_wall;
    public $for_who;    
    public $posted_in;
    public $code_wall;
    
    public $input_withp;
    public $input_feeling;
    public $input_insitu;
    
    public $idmedia = 0;

    public $typeembed = 0;
    public $embed_url = '';
    public $embed_title = '';
    public $embed_text = '';
    public $embed_type = '';
    public $embed_host = '';
    public $embed_thumbnail = '';
    public $embed_html = '';
    public $embed_provider = '';

    public function __construct()
    {
        $this->db1 = & $GLOBALS['db1'];

        $user = & $GLOBALS['user'];
        $network = & $GLOBALS['network'];

        if ($user->is_logged) {
            $this->network = $network;
            $this->user = $user->info;
            $this->db2 = & $GLOBALS['db2'];
        } else return FALSE;

        $this->typepost = 0;
        $this->idpost = FALSE;
        $this->code = codeUniqueInTable(11, 1, 'posts', 'code');
        return TRUE;
    }
    
    public function setTypePost($typepost)
    {
        $this->typepost = $typepost;
        return TRUE;
    }
    
    public function moreInfo($code_writer, $type_writer, $posted_in, $code_wall, $for_who, $input_withp, $input_feeling, $input_insitu)
    {
        if (!$this->user) return FALSE;

        $this->posted_in = $posted_in;
        $this->code_wall = $code_wall;
        $this->for_who = $for_who;
        $this->id_wall = $this->network->getIdWall($code_wall, $posted_in);
        $this->code_writer = $code_writer;
        $this->type_writer = $type_writer;
        if ($this->type_writer == 0) {
            // this is a user
            $this->idwriter = $this->network->getUserByCode($this->code_writer, TRUE);

            if (!$this->idwriter || ($this->user->iduser != $this->idwriter)) return FALSE;

        } else {
            //this is a page
            $idownerpage = $this->network->userPageOwner($this->code_writer, TRUE);
            if ($this->user->iduser != $idownerpage) return FALSE;
            $this->idwriter = $this->network->getPageByCode($this->code_writer, TRUE);
        }

        $this->input_withp = $input_withp;
        $this->input_feeling = $input_feeling;
        $this->input_insitu = $input_insitu;

        return TRUE;
    }
    
    public function setEmbed($infoEmbed, $typeembed)
    {
        if (is_array($infoEmbed) && count($infoEmbed) > 0) {
            
            $this->embed_url = $infoEmbed['e_url'];
            $this->embed_title = $infoEmbed['e_title'];
            $this->embed_text = $infoEmbed['e_text'];
            $this->embed_type = $infoEmbed['e_type'];
            switch ($typeembed) {
                case 1:
                    $this->typeembed = 1;
                    $this->embed_host = $infoEmbed['e_host'];
                    $this->embed_thumbnail = $infoEmbed['e_thumbnail'];
                    $this->typepost = 9;
                    break;
                case 2:
                    $this->typeembed = 2;
                    $this->embed_html = $infoEmbed['e_html'];
                    $this->embed_provider = $infoEmbed['e_provider'];
                    $this->typepost = 10;
                    break;                
            }
        }
    }
    
    public function setMessage($message)
    {
        if (empty($message)) return FALSE;
        
        $this->message = $message;
        
        $this->mentioned = array();
        if( preg_match_all('/\@([a-zA-Z0-9\-_]{3,30})/u', $message, $matches, PREG_PATTERN_ORDER) ) {
            foreach($matches[1] as $unm) {
                if( $usr = $this->network->getUserByUsername($unm) ) {
                    $this->mentioned[] = $usr->iduser;
                }
            }
        }
        $this->mentioned = array_unique($this->mentioned);
        
        $thehashtags = array();

        if( preg_match_all('/\#([\pL0-9_]{1,50})/iu', $this->message, $matches, PREG_PATTERN_ORDER) ) {
            foreach($matches[1] as $tg) {
                if (!is_numeric($tg)) $thehashtags[] = mb_strtolower(trim($tg));
            }
        }
        $this->hashtags = $thehashtags;
        $this->num_hashtags = count( array_unique($thehashtags) );
    }
    
    public function attachVideo($the_video)
    {
        global $K, $page;
        $res = array();
        $res[0] = FALSE;
        $res[1] = '';
        $designer = new designer();
        
        $error = FALSE;
        
        if (!is_uploaded_file($the_video['tmp_name'])) {
            
                $error = TRUE;
                $res[0] = TRUE;
                $res[1] = $designer->boxAlert($page->lang('dashboard_newactivity_error_video_title'), $page->lang('dashboard_newactivity_error_video_failed'), $page->lang('dashboard_newactivity_error_bclose'));
            
        } else {
            
            if ($the_video['size'] > $K->FILE_SIZE_VIDEO || $the_video['size'] == 0){
                $error = TRUE;
                $res[0] = TRUE;
                $res[1] = $designer->boxAlert($page->lang('dashboard_newactivity_error_video_title'), $page->lang('dashboard_newactivity_error_video_large'), $page->lang('dashboard_newactivity_error_bclose'));
            }

            if (!$error) {

                $file_extension = pathinfo($the_video['name'], PATHINFO_EXTENSION);
                if (!isValidExtension($file_extension, $K->EXTENSIONS_VIDEOS)) {
                    $error = TRUE;
                    $res[0] = TRUE;
                    $res[1] = $designer->boxAlert($page->lang('dashboard_newactivity_error_video_title'), $page->lang('dashboard_newactivity_error_video_wrong'), $page->lang('dashboard_newactivity_error_bclose'));
                }                
                
            }

            if (!$error) {

                $the_pholder_video = $K->STORAGE_DIR_VIDEOS.$this->code_writer;
                if (!file_exists($the_pholder_video)) {
                    mkdir($the_pholder_video, 0777, true);
                    $findex = fopen($the_pholder_video.'/index.html', "a");
                }
                
                $name_file = $this->code.'.'.$file_extension;
                move_uploaded_file($the_video['tmp_name'], $the_pholder_video.'/'.$name_file);
                
                $code_media = codeUniqueInTable(11, 1, 'medias', 'code');
                $this->db2->query("INSERT INTO medias SET code='".$code_media."', idwriter=".$this->idwriter.", type_writer=".$this->type_writer.", posted_in=0, codecontainer='".$this->code."', namefile='".$name_file."', folder='".$this->code_writer."', typemedia=1", FALSE);
                
                $this->idmedia = $this->db2->insert_id();

                $this->name_video = $name_file;                
                $this->typepost = 2;
                
            }
            
        }
        
        return $res;

    }
    
    public function attachAudio($the_audio)
    {
        global $K, $page;
        $res = array();
        $res[0] = FALSE;
        $res[1] = '';
        $designer = new designer();
        
        $error = FALSE;
        
        if (!is_uploaded_file($the_audio['tmp_name'])) {
            
            $error = TRUE;
            $res[0] = TRUE;
            $res[1] = $designer->boxAlert($page->lang('dashboard_newactivity_error_audio_title'), $page->lang('dashboard_newactivity_error_audio_failed'), $page->lang('dashboard_newactivity_error_bclose'));
            
        } else {
            
            if ($the_audio['size'] > $K->FILE_SIZE_AUDIO || $the_audio['size'] == 0){
                $error = TRUE;
                $res[0] = TRUE;
                $res[1] = $designer->boxAlert($page->lang('dashboard_newactivity_error_audio_title'), $page->lang('dashboard_newactivity_error_audio_large'), $page->lang('dashboard_newactivity_error_bclose'));
            }

            if (!$error) {

                $file_extension = pathinfo($the_audio['name'], PATHINFO_EXTENSION);
                if (!isValidExtension($file_extension, $K->EXTENSIONS_AUDIOS)) {
                    $error = TRUE;
                    $res[0] = TRUE;
                    $res[1] = $designer->boxAlert($page->lang('dashboard_newactivity_error_audio_title'), $page->lang('dashboard_newactivity_error_audio_wrong'), $page->lang('dashboard_newactivity_error_bclose'));
                }                
                
            }

            if (!$error) {

                $the_pholder_audio = $K->STORAGE_DIR_AUDIOS.$this->code_writer;
                if (!file_exists($the_pholder_audio)) {
                    mkdir($the_pholder_audio, 0777, true);
                    $findex = fopen($the_pholder_audio.'/index.html', "a");
                }
                
                $name_file = $this->code.'.'.$file_extension;
                move_uploaded_file($the_audio['tmp_name'], $the_pholder_audio.'/'.$name_file);
                
                $code_media = codeUniqueInTable(11, 1, 'medias', 'code');
                $this->db2->query("INSERT INTO medias SET code='".$code_media."', idwriter=".$this->idwriter.", type_writer=".$this->type_writer.", posted_in=0, codecontainer='".$this->code."', namefile='".$name_file."', folder='".$this->code_writer."', typemedia=2", FALSE);

                $this->idmedia = $this->db2->insert_id();

                $this->name_audio = $name_file;                
                $this->typepost = 3;
                
            }
            
        }
        
        return $res;
    }
    
    public function attachImages($the_files)
    {
        global $K, $page;
        $res = array();
        $res[0] = FALSE;
        $res[1] = '';
        $designer = new designer();
        
        $error = FALSE;
        
        $imgs_news = $the_files;

        if ($imgs_news['name'][0]) {
            
            $numphotos = count($imgs_news['name']);

            if ($numphotos > $K->QUANTITY_PHOTOS_POST) {
                $error = TRUE;
                $res[0] = TRUE;
                $res[1] = $designer->boxAlert($page->lang('dashboard_newactivity_error_format_image_title'), $page->lang('dashboard_newactivity_error_too_many_msg'), $page->lang('dashboard_newactivity_error_bclose'));
            } else {
                
                $photos = array();
                $tmp_photos = array();
                
                for ($i = 0; $i < $numphotos; $i++) {

                    if ($imgs_news['size'][$i] > $K->FILE_SIZE_PHOTO || $imgs_news['size'][$i]==0){
                        $error = TRUE;
                        $res[0] = TRUE;
                        $res[1] = $designer->boxAlert($page->lang('dashboard_newactivity_error_format_image_title'), $page->lang('dashboard_newactivity_error_very_large_msg').': '.$imgs_news['name'][$i], $page->lang('dashboard_newactivity_error_bclose'));
                        break;
                    }

                    $file_type = $imgs_news['type'][$i];
                    if ($file_type=="image/jpeg" || $file_type=="image/gif" || $file_type=="image/png") {
                        switch ($file_type) {
                            case "image/jpeg":
                                $file_extension = '.jpg';
                                break;
                            case "image/gif":
                                $file_extension = '.gif';		
                                break;
                            case "image/png":
                                $file_extension = '.png';
                                break;
                        }
                        
                    } else {
                        $error = TRUE;
                        $res[0] = TRUE;
                        $res[1] = $designer->boxAlert($page->lang('dashboard_newactivity_error_format_image_title'), $page->lang('dashboard_newactivity_error_format_image_msg').': '.$imgs_news['name'][$i], $page->lang('dashboard_newactivity_error_bclose'));

                        break;
                    }
                    
                    $tmp_photos[] = $imgs_news['tmp_name'][$i];
                    $photos[] = $this->code.'-'.$i.$file_extension;

                }
                $this->photos = $photos;

                if (!$error) {

                    $the_pholder_original = $K->STORAGE_DIR_PHOTOS.'original/'.$this->code_writer;
                    if (!file_exists($the_pholder_original)) {
                        mkdir($the_pholder_original, 0777, true);
                        $findex = fopen($the_pholder_original.'/index.html', "a");
                    }

                    $the_pholder_thumb1 = $K->STORAGE_DIR_PHOTOS.'thumb1/'.$this->code_writer;
                    if (!file_exists($the_pholder_thumb1)) {
                        mkdir($the_pholder_thumb1, 0777, true);
                        $findex = fopen($the_pholder_thumb1.'/index.html', "a");
                    }

                    $the_pholder_thumb2 = $K->STORAGE_DIR_PHOTOS.'thumb2/'.$this->code_writer;
                    if (!file_exists($the_pholder_thumb2)) {
                        mkdir($the_pholder_thumb2, 0777, true);
                        $findex = fopen($the_pholder_thumb2.'/index.html', "a");
                    }

                    $the_pholder_thumb3 = $K->STORAGE_DIR_PHOTOS.'thumb3/'.$this->code_writer;
                    if (!file_exists($the_pholder_thumb3)) {
                        mkdir($the_pholder_thumb3, 0777, true);
                        $findex = fopen($the_pholder_thumb3.'/index.html', "a");
                    }

                    $the_pholder_thumb4 = $K->STORAGE_DIR_PHOTOS.'thumb4/'.$this->code_writer;
                    if (!file_exists($the_pholder_thumb4)) {
                        mkdir($the_pholder_thumb4, 0777, true);
                        $findex = fopen($the_pholder_thumb4.'/index.html', "a");
                    }

                    foreach($photos as $key => $fname) {
                        
                        move_uploaded_file($tmp_photos[$key], $the_pholder_original.'/'.$fname);

                        $thumbnail = new imagen($the_pholder_original.'/'.$fname);

                        $the_width = $thumbnail->getWidth();
                        $the_height = $thumbnail->getHeight();

                        if ($the_width > $K->WIDTH_PHOTO_1 || $the_height > $K->WIDTH_PHOTO_1) {
                            $thumbnail->resizeImage($K->WIDTH_PHOTO_1, $K->WIDTH_PHOTO_1, 'landscape');
                            $thumbnail->saveImage($the_pholder_thumb1.'/'.$fname);
                        } else {
                            copy($the_pholder_original.'/'.$fname, $the_pholder_thumb1.'/'.$fname);
                        }

                        if ($the_width > $K->WIDTH_PHOTO_2 || $the_height > $K->WIDTH_PHOTO_2) {
                            $thumbnail = new imagen($the_pholder_original.'/'.$fname);
                            $thumbnail->resizeImage($K->WIDTH_PHOTO_2, $K->WIDTH_PHOTO_2, 'landscape');
                            $thumbnail->saveImage($the_pholder_thumb2.'/'.$fname);
                        } else {
                            copy($the_pholder_original.'/'.$fname, $the_pholder_thumb2.'/'.$fname);
                        }

                        if ($the_width > $K->WIDTH_PHOTO_3 || $the_height > $K->WIDTH_PHOTO_3) {
                            $thumbnail = new imagen($the_pholder_original.'/'.$fname);
                            $thumbnail->resizeImage($K->WIDTH_PHOTO_3, $K->WIDTH_PHOTO_3, 'landscape');
                            $thumbnail->saveImage($the_pholder_thumb3.'/'.$fname);
                        } else {
                            copy($the_pholder_original.'/'.$fname, $the_pholder_thumb3.'/'.$fname);
                        }

                        if ($the_width > $K->WIDTH_PHOTO_4 || $the_height > $K->WIDTH_PHOTO_4) {
                            $thumbnail = new imagen($the_pholder_original.'/'.$fname);
                            $thumbnail->resizeImage($K->WIDTH_PHOTO_4, $K->WIDTH_PHOTO_4, 'landscape');
                            $thumbnail->saveImage($the_pholder_thumb4.'/'.$fname);
                        } else {
                            copy($the_pholder_original.'/'.$fname, $the_pholder_thumb4.'/'.$fname);
                        }

                        $code_media = codeUniqueInTable(11, 1, 'medias', 'code');
                        $this->db2->query("INSERT INTO medias SET code='".$code_media."', idwriter=".$this->idwriter.", type_writer=".$this->type_writer.", posted_in=0, codecontainer='".$this->code."', namefile='".$fname."', folder='".$this->code_writer."', typemedia=0, width=".$the_width.", height=".$the_height, FALSE);

                    }

                    $this->typepost = 1;

                }
            }
        } 

        return $res;
    }

    public function attachImagesFromServer($the_file, $the_extension)
    {
        global $K, $page;

		$the_pholder_original = $K->STORAGE_DIR_PHOTOS.'original/'.$this->code_writer;
		if (!file_exists($the_pholder_original)) {
			mkdir($the_pholder_original, 0777, true);
			$findex = fopen($the_pholder_original.'/index.html', "a");
		}

		$the_pholder_thumb1 = $K->STORAGE_DIR_PHOTOS.'thumb1/'.$this->code_writer;
		if (!file_exists($the_pholder_thumb1)) {
			mkdir($the_pholder_thumb1, 0777, true);
			$findex = fopen($the_pholder_thumb1.'/index.html', "a");
		}

		$the_pholder_thumb2 = $K->STORAGE_DIR_PHOTOS.'thumb2/'.$this->code_writer;
		if (!file_exists($the_pholder_thumb2)) {
			mkdir($the_pholder_thumb2, 0777, true);
			$findex = fopen($the_pholder_thumb2.'/index.html', "a");
		}

		$the_pholder_thumb3 = $K->STORAGE_DIR_PHOTOS.'thumb3/'.$this->code_writer;
		if (!file_exists($the_pholder_thumb3)) {
			mkdir($the_pholder_thumb3, 0777, true);
			$findex = fopen($the_pholder_thumb3.'/index.html', "a");
		}

		$the_pholder_thumb4 = $K->STORAGE_DIR_PHOTOS.'thumb4/'.$this->code_writer;
		if (!file_exists($the_pholder_thumb4)) {
			mkdir($the_pholder_thumb4, 0777, true);
			$findex = fopen($the_pholder_thumb4.'/index.html', "a");
		}


		$thename_file = $this->code.'.'.$the_extension;
		copy($the_file, $the_pholder_original.'/'.$thename_file);

		$thumbnail = new imagen($the_pholder_original.'/'.$thename_file);

		$the_width = $thumbnail->getWidth();
		$the_height = $thumbnail->getHeight();

		if ($the_width > $K->WIDTH_PHOTO_1 || $the_height > $K->WIDTH_PHOTO_1) {
			$thumbnail->resizeImage($K->WIDTH_PHOTO_1, $K->WIDTH_PHOTO_1, 'landscape');
			$thumbnail->saveImage($the_pholder_thumb1.'/'.$thename_file);
		} else {
			copy($the_file, $the_pholder_thumb1.'/'.$thename_file);
		}

		if ($the_width > $K->WIDTH_PHOTO_2 || $the_height > $K->WIDTH_PHOTO_2) {
			$thumbnail = new imagen($the_pholder_original.'/'.$thename_file);
			$thumbnail->resizeImage($K->WIDTH_PHOTO_2, $K->WIDTH_PHOTO_2, 'landscape');
			$thumbnail->saveImage($the_pholder_thumb2.'/'.$thename_file);
		} else {
			copy($the_file, $the_pholder_thumb2.'/'.$thename_file);
		}

		if ($the_width > $K->WIDTH_PHOTO_3 || $the_height > $K->WIDTH_PHOTO_3) {
			$thumbnail = new imagen($the_pholder_original.'/'.$thename_file);
			$thumbnail->resizeImage($K->WIDTH_PHOTO_3, $K->WIDTH_PHOTO_3, 'landscape');
			$thumbnail->saveImage($the_pholder_thumb3.'/'.$thename_file);
		} else {
			copy($the_file, $the_pholder_thumb3.'/'.$thename_file);
		}

		if ($the_width > $K->WIDTH_PHOTO_4 || $the_height > $K->WIDTH_PHOTO_4) {
			$thumbnail = new imagen($the_pholder_original.'/'.$thename_file);
			$thumbnail->resizeImage($K->WIDTH_PHOTO_4, $K->WIDTH_PHOTO_4, 'landscape');
			$thumbnail->saveImage($the_pholder_thumb4.'/'.$thename_file);
		} else {
			copy($the_file, $the_pholder_thumb4.'/'.$thename_file);
		}

		$code_media = codeUniqueInTable(11, 1, 'medias', 'code');
		$this->db2->query("INSERT INTO medias SET code='".$code_media."', idwriter=".$this->idwriter.", type_writer=".$this->type_writer.", posted_in=0, codecontainer='".$this->code."', namefile='".$thename_file."', folder='".$this->code_writer."', typemedia=0, width=".$the_width.", height=".$the_height, FALSE);

        return $code_media;
    }

    public function save()
    {
        global $K;
        $valueattach = '';

        $idembed = 0;
        if ($this->typeembed != 0) {

            $this->db2->query("INSERT INTO posts_embed SET type_embed=".$this->typeembed.", e_url='".$this->embed_url."', e_host='".$this->embed_host."', e_provider='".$this->embed_provider."', e_type='".$this->embed_type."', e_title='".$this->db2->e($this->embed_title)."', e_text='".$this->db2->e($this->embed_text)."', e_thumbnail='".$this->embed_thumbnail."', e_html='".$this->db2->e($this->embed_html)."'", FALSE);

            $idembed = $this->db2->insert_id();
        }

        $this->db2->query("INSERT INTO posts SET code='".$this->code."', idwriter=".$this->idwriter.", type_writer=".$this->type_writer.", message='".$this->message."', typepost='".$this->typepost."', posted_in=".$this->posted_in.", id_wall=".$this->id_wall.", for_who=".$this->for_who.", idmedia=".$this->idmedia.", with_users='".$this->input_withp."', feeling='".$this->input_feeling."', location_in='".$this->input_insitu."', post_date='".time()."', idembed=".($idembed != 0 ? $idembed : 0), FALSE);

        $this->idpost = $this->db2->insert_id();
        
        //////////////////////////////
        // register in activities
        
        $activ_who_view = $this->for_who;
        if ($this->posted_in == 2) {
            $privacy_group = $this->db2->fetch_field("SELECT privacy FROM groups WHERE idgroup=".$this->id_wall." LIMIT 1");
            $activ_who_view = 2;
            if ($privacy_group == 0) $activ_who_view = 0;
        }
        
        $thestatus_actv = 1;
        if ($this->posted_in == 3 && $this->typepost == 5) $thestatus_actv = 0;
        
        $info_activity = ''; //$this->code.'|'.$this->idpost.'|'.$this->typepost.'|'.$this->posted_in.'|'.$this->id_wall;
        $this->db2->query("INSERT INTO activities SET iduser=".$this->idwriter.", type_user=".$this->type_writer.", idwall=".$this->id_wall.", type_wall=".$this->posted_in.", action=1, type_activity=".$this->typepost.", moreinfo='".$info_activity."', where_was_made=0, code_where='".$this->code."', id_where=".$this->idpost.", code_result='".$this->code."', id_result=".$this->idpost.", who_view=".$activ_who_view.", status=".$thestatus_actv.", whendate='".time()."'");
		
		$idactivity = $this->db2->insert_id();
		$this->db2->query("UPDATE posts SET idactivity=".$idactivity." WHERE idpost=".$this->idpost." LIMIT 1", FALSE);

        //////////////////////////////

        if ($this->posted_in == 0 && $this->id_wall != $this->user->iduser) {
            $this->db2->query("INSERT INTO notifications SET type_notif=8, result=".$this->idpost.", to_user=".$this->id_wall.", from_user=".$this->user->iduser.", from_user_type=0, typeitem_notif=1, iditem_notif=".$this->idpost.", whendate='".time()."'");
            $this->db2->query("UPDATE users SET num_notifications_global=num_notifications_global+1 WHERE iduser=".$this->id_wall.' LIMIT 1');
        }

        if ($this->typepost != 0) {
            $this->db2->query("UPDATE medias SET idcontainer=".$this->idpost." WHERE codecontainer='".$this->code."'", FALSE);
        }

        foreach ($this->mentioned as $idu) {
            $this->db2->query("INSERT INTO mentions SET typecontainer=0, idcontainer=".$this->idpost.", idwriter=".$this->idwriter.", type_writer=".$this->type_writer.", iduser_mentioned=".intval($idu), FALSE);
        }
        
        if (count($this->hashtags) > 0) {
            $post_tags_in_brackets = array();
            $unique_posttags = array();
            $unique_posttags = array_unique($this->hashtags);
            
            foreach ($unique_posttags as $tag) {
                $post_tags_in_brackets[] = "('".$tag."', ".$this->idwriter.", ".$this->type_writer.", ".$this->idpost.", '".time()."')";
            }		
            
            $this->db2->query('INSERT INTO hashtags (hashtag, idwriter, type_writer, idpost, thedate ) VALUES '.implode( ',', $post_tags_in_brackets ), FALSE);
            unset($post_tags_in_brackets, $unique_posttags);
        }

        return $this->idpost;
        
    }
    
    public function deleteMedia()
    {
        if ($this->typepost == 1) {
            global $K;
            foreach($this->photos as $key => $fname) {
                if (file_exists($K->STORAGE_DIR_PHOTOS.'original/'.$this->code_writer.'/'.$fname)) unlink($K->STORAGE_DIR_PHOTOS.'original/'.$this->code_writer.'/'.$fname);
                if (file_exists($K->STORAGE_DIR_PHOTOS.'thumb1/'.$this->code_writer.'/'.$fname)) unlink($K->STORAGE_DIR_PHOTOS.'thumb1/'.$this->code_writer.'/'.$fname);
                if (file_exists($K->STORAGE_DIR_PHOTOS.'thumb2/'.$this->code_writer.'/'.$fname)) unlink($K->STORAGE_DIR_PHOTOS.'thumb2/'.$this->code_writer.'/'.$fname);
                if (file_exists($K->STORAGE_DIR_PHOTOS.'thumb3/'.$this->code_writer.'/'.$fname)) unlink($K->STORAGE_DIR_PHOTOS.'thumb3/'.$this->code_writer.'/'.$fname);
                if (file_exists($K->STORAGE_DIR_PHOTOS.'thumb4/'.$this->code_writer.'/'.$fname)) unlink($K->STORAGE_DIR_PHOTOS.'thumb4/'.$this->code_writer.'/'.$fname);
            }
            $this->db2->query("DELETE FROM medias WHERE typemedia=0 AND codecontainer='".$this->code."'", FALSE);
        }

        if ($this->typepost == 2) {
            if (file_exists($K->STORAGE_DIR_VIDEOS.$this->code_writer.'/'.$this->name_video)) unlink($K->STORAGE_DIR_VIDEOS.$this->code_writer.'/'.$this->name_video);
            $this->db2->query("DELETE FROM medias WHERE typemedia=1 AND codecontainer='".$this->code."' LIMIT 1", FALSE);
        }

        if ($this->typepost == 3) {
            if (file_exists($K->STORAGE_DIR_AUDIOS.$this->code_writer.'/'.$this->name_audio)) unlink($K->STORAGE_DIR_VIDEOS.$this->code_writer.'/'.$this->name_audio);
            $this->db2->query("DELETE FROM medias WHERE typemedia=2 AND codecontainer='".$this->code."' LIMIT 1", FALSE);
        }

    }
 

}

?>