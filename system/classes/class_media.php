<?php
class media
{
    private $user;
    private $network;
    private $db1;
    private $db2;
    private $page;
    
    public $idmedia;
    public $code;
    public $idwriter;
    public $type_writer;
    public $posted_in;
    public $codecontainer;
    public $idcontainer;
    public $namefile;
    public $folder;
    public $numcomments;
    public $numlikes;
    public $typemedia;
    public $width;
    public $height;
    
    public $error = FALSE;
    
    public function __construct($idmedia)
    {
        global $K;
        $this->network = & $GLOBALS['network'];
        $this->user = & $GLOBALS['user'];
        $this->page = & $GLOBALS['page'];
        $this->db1 = & $GLOBALS['db1'];
        $this->db2 = & $GLOBALS['db2'];

        $idmedia = intval($idmedia);
        $r = $this->db2->query('SELECT * FROM medias WHERE idmedia="'.$idmedia.'" LIMIT 1', FALSE);
        if (!$obj = $this->db2->fetch_object($r)) {
            $this->error = TRUE;
            return;
        }

        $this->idmedia = intval($obj->idmedia);
        $this->code = stripslashes($obj->code);
        $this->idwriter = intval($obj->idwriter);
        $this->type_writer = intval($obj->type_writer);
        $this->posted_in = intval($obj->posted_in);
        $this->codecontainer = stripslashes($obj->codecontainer);
        $this->idcontainer = intval($obj->idcontainer);
        $this->namefile = stripslashes($obj->namefile);
        $this->folder = stripslashes($obj->folder);
        $this->numcomments = intval($obj->numcomments);
        $this->numlikes = intval($obj->numlikes);
        $this->typemedia = intval($obj->typemedia);
        $this->width = intval($obj->width);
        $this->height = intval($obj->height);

        if ($this->type_writer == 0) {
            // this is a user
            $writer = $this->network->getUserById($obj->idwriter);
            $this->writer_id = $writer->iduser;
            $this->writer_code = $writer->code;
            $this->writer_name = stripslashes($writer->firstname).' '.stripslashes($writer->lastname);
            $this->writer_username = stripslashes($writer->user_username);
            $this->writer_avatar = stripslashes($writer->avatar);

        } else {
            //this is a page
            $writer = $this->network->getPageById($obj->idwriter);
            $this->writer_id = $writer->idpage;
            $this->writer_idcreator = $writer->idcreator;
            $this->writer_code = $writer->code;
            $this->writer_name = stripslashes($writer->title);
            $this->writer_username = stripslashes($writer->puname);
            $this->writer_avatar = stripslashes($writer->avatar);
        }

    }
    
    public function getAvatarWriter()
    {
        global $K;
        $url_avatar = '';
        if ($this->type_writer == 0) {
            $base_url = $K->STORAGE_URL_AVATARS.'min2/';
            $url_avatar = $base_url.$this->writer_avatar;
            if ($this->writer_avatar != $K->DEFAULT_AVATAR_USER) $url_avatar = $base_url.$this->writer_code.'/'.$this->writer_avatar;
        } else {
            $base_url = $K->STORAGE_URL_AVATARS_PAGE.'min2/';
            $url_avatar = $base_url.$this->writer_avatar;
            if ($this->writer_avatar != $K->DEFAULT_AVATAR_PAGE) $url_avatar = $base_url.$this->writer_code.'/'.$this->writer_avatar;
        }
        return $url_avatar;
    }

    public function getNameWriter()
    {
        return $this->writer_name;
    }
    
    public function draw()
    {
        global $K, $D;
        $D->codemedia = $this->code;
        $D->media_avatar = $this->getAvatarWriter();
        $D->name_writer = $this->getNameWriter();
        $D->code_writer = $this->writer_code;
        $D->writer_username = $this->writer_username;
        $D->item1_type = $this->type_writer;
        $D->code_activity = $this->codecontainer;

        $thepost = $this->db2->fetch('SELECT post_date, posted_in, for_who FROM posts WHERE idpost='.$this->idcontainer);
        $D->activity_whendate = '<span class="thelivestamp" data-locale="'.$K->LANGUAGE.'" data-livestamp="'.$thepost->post_date.'"></span>';
        $D->post_posted_in = $thepost->posted_in;
        switch($thepost->for_who) {
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

        $D->the_photo = $K->STORAGE_URL_PHOTOS.'thumb2/'.$this->folder.'/'.$this->namefile;
        $D->data_media = $K->STORAGE_URL_PHOTOS.'thumb1/'.$this->folder.'/'.$this->namefile;
        
        $D->show_bottom = FALSE;
        
        $D->media_numlikes = $this->numlikes;
        if ($D->media_numlikes > 0) $D->show_bottom = true;
        
        $D->liketoUser = FALSE;
        if ($D->_IS_LOGGED) {
            if ($this->network->itemLiketoUser($this->user->id, 0, $this->idmedia, 2)) $D->liketoUser = TRUE;
            $D->avatar_user = $this->user->getAvatar(1);
            $D->code_visitor = $this->user->info->code;
            $D->type_visitor = 0;
        }

        $D->comments_html = '';
        $the_comments = $this->db2->fetch_all("SELECT idcomment FROM comments WHERE iditem=".$this->idmedia." AND typeitem=1 ORDER BY whendate ASC");
        if (count($the_comments) > 0) {
            foreach ($the_comments as $one_comment) {
                $D->comment = new comment($one_comment->idcomment);
                $D->comments_html .= $D->comment->draw();
                unset($D->comment);
            }
        }

        if (!empty($D->comments_html)) $D->show_bottom = TRUE;

        if ($D->_IS_LOGGED) $D->show_bottom = TRUE;

        return $this->page->load_template('ones/one-media.php',FALSE);
    }
    
    private function _deleteNotifications()
    {
        $this->db2->query('DELETE FROM notifications WHERE iditem_notif='.$this->idmedia.' AND typeitem_notif=6');
    }
        
    private function _deleteReports()
    {

    }

    private function _deleteHiddens()
    {

    }

    private function _deleteLikes()
    {
        $this->db2->query('DELETE FROM likes WHERE typeitem=2 AND iditem='.$this->idmedia);
    }

    private function _deleteMedia()
    {
        global $K;
        $the_file = $K->STORAGE_DIR_PHOTOS.'original/'.$this->folder.'/'.$this->namefile;
        if (file_exists($the_file)) unlink($the_file);

        $the_file = $K->STORAGE_DIR_PHOTOS.'thumb1/'.$this->folder.'/'.$this->namefile;
        if (file_exists($the_file)) unlink($the_file);

        $the_file = $K->STORAGE_DIR_PHOTOS.'thumb2/'.$this->folder.'/'.$this->namefile;
        if (file_exists($the_file)) unlink($the_file);

        $the_file = $K->STORAGE_DIR_PHOTOS.'thumb3/'.$this->folder.'/'.$this->namefile;
        if (file_exists($the_file)) unlink($the_file);

        $the_file = $K->STORAGE_DIR_PHOTOS.'thumb4/'.$this->folder.'/'.$this->namefile;
        if (file_exists($the_file)) unlink($the_file);
    }
    
    private function _deleteComments()
    {
        $allcomments = $this->db2->fetch_all('SELECT idcomment FROM comments WHERE typeitem=1 AND iditem='.$this->idmedia);
        $numcomments = count($allcomments);
        if ($numcomments > 0) {
            foreach ($allcomments as $onecomments) {
                $the_comment = new comment($onecomments->idcomment);
                $the_comment->deleteComment();
                unset($the_comment);
            }
        }
    }
    
    public function deleteMedia()
    {
        $this->db2->query('DELETE FROM medias WHERE idmedia='.$this->idmedia.' LIMIT 1');
        $this->_deleteNotifications();
        $this->_deleteLikes();
        $this->_deleteReports();
        $this->_deleteHiddens();
        $this->_deleteComments();
        $this->_deleteMedia();
    }
    
}
?>