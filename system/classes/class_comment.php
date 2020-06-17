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

class comment
{
    private $user;
    private $network;
    private $db1;
    private $db2;
    private $page;
    
    public $idcomment;
    public $type_writer;
    public $iditem;
    public $typeitem;
    public $comment;
    public $typecomment;
    public $idattach;
    public $whendate;
    
    public $error = FALSE;
    
    public function __construct($idcomment)
    {
        global $K;
        $this->network = & $GLOBALS['network'];
        $this->user = & $GLOBALS['user'];
        $this->page = & $GLOBALS['page'];
        $this->db1 = & $GLOBALS['db1'];
        $this->db2 = & $GLOBALS['db2'];

        $idcomment = intval($idcomment);
        $r = $this->db2->query('SELECT * FROM comments WHERE idcomment="'.$idcomment.'" LIMIT 1', FALSE);
        if (!$obj = $this->db2->fetch_object($r)) {
            $this->error = TRUE;
            return;
        }

        $this->idcomment = intval($obj->idcomment);
        $this->type_writer = intval($obj->type_writer);
        $this->iditem = intval($obj->iditem);
        $this->typeitem = intval($obj->typeitem);
        $this->comment = stripslashes($obj->comment);
        $this->typecomment = intval($obj->typecomment);
        $this->idattach = intval($obj->idattach);
        $this->whendate = $obj->whendate;

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
            $base_url = $K->STORAGE_URL_AVATARS.'min1/';
            $url_avatar = $base_url.$this->writer_avatar;
            if ($this->writer_avatar != $K->DEFAULT_AVATAR_USER) $url_avatar = $base_url.$this->writer_code.'/'.$this->writer_avatar;
        } else {
            $base_url = $K->STORAGE_URL_AVATARS_PAGE.'min1/';
            $url_avatar = $base_url.$this->writer_avatar;
            if ($this->writer_avatar != $K->DEFAULT_AVATAR_PAGE) $url_avatar = $base_url.$this->writer_code.'/'.$this->writer_avatar;
        }
        return $url_avatar;
    }

    public function getNameWriter()
    {
        return $this->writer_name;
    }

    public function getAttach()
    {
        if ($this->idattach != 0) {
            $o = $this->db2->fetch('SELECT * FROM medias WHERE idmedia='.$this->idattach.' AND posted_in=1 AND idcontainer='.$this->idcomment.' LIMIT 1');
            return $o;
        }
        return FALSE;
    }
    
    public function isEditable()
    {
        if ($this->type_writer == 0) {
            if ($this->user->id == $this->writer_id) return TRUE;
        }

        if ($this->type_writer == 1) {
            if ($this->user->id == $this->writer_idcreator) return TRUE;
        }

        return FALSE;
    }
    
    public function isRemovable()
    {
        if ($this->isEditable()) return TRUE;
        
        if ($this->typeitem == 0) {
            $the_owner = $this->db2->fetch('SELECT idwriter, type_writer FROM posts WHERE idpost='.$this->iditem.' LIMIT 1');
            
            if ($the_owner->type_writer == 0) {
                if ($this->user->id == $the_owner->idwriter) return TRUE;
            }
    
            if ($the_owner->type_writer == 1) {
                $idcreator = $this->db2->fetch_field('SELECT idcreator FROM pages WHERE idpage='.$the_owner->idwriter.' LIMIT 1');
                if ($this->user->id == $idcreator) return TRUE;
            }
            
        } else {
            
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
    
    public function draw()
    {
        global $K, $D;        
        
        $D->cl_comm_idcomment = $this->idcomment;
        $D->cl_comm_avatar = $this->getAvatarWriter();
        $D->cl_comm_writer_name = $this->getNameWriter();
        
        $D->cl_comm_typeitem = $this->typeitem;
        
        $D->cl_comm_comment_cut = '';

        if (strlen($this->comment) > $K->CHARS_VIEW_IN_COMMENT) $D->cl_comm_comment_cut = analyzeMessage(str_cut($this->comment, $K->CHARS_VIEW_IN_COMMENT));

        $D->cl_comm_comment = analyzeMessage($this->comment);
        
        $D->cl_comm_whendate = '<span class="thelivestamp" data-locale="'.$K->LANGUAGE.'" data-livestamp="'.$this->whendate.'"></span>';
        $D->cl_comm_writer_username = $this->writer_username;
        $D->cl_comm_writer_code = $this->writer_code;
        $D->cl_comm_writer_type = $this->type_writer;
        
        $D->cl_comm_attach_html = '';
        $D->cl_comm_attach_max = '';
        if ($the_attach = $this->getAttach()) {
            $D->cl_comm_attach_html = $K->STORAGE_URL_PHOTOS.'thumb4/'.$the_attach->folder.'/'.$the_attach->namefile;
            $D->cl_comm_attach_max = $K->STORAGE_URL_PHOTOS.'thumb1/'.$the_attach->folder.'/'.$the_attach->namefile;
        }
        
        $D->cl_comm_is_removable = FALSE;
        if ($D->_IS_LOGGED) $D->cl_comm_is_removable =  $this->isRemovable();

        $D->cl_comm_type_comment = $this->typecomment;
        
        return $this->page->load_template('ones/one-comment.php',FALSE);
        
    }
    
    public function updateComment($newmessage)
    {

        
    }
    
    private function _deleteNotifications()
    {
        // comment
        if ($this->typeitem == 0) {
            $this->db2->query("DELETE FROM notifications WHERE type_notif=3 AND result=".$this->idcomment." AND from_user=".$this->writer_id." AND from_user_type=".$this->type_writer);
        } else {
            $this->db2->query("DELETE FROM notifications WHERE type_notif=15 AND result=".$this->idcomment." AND from_user=".$this->writer_id." AND from_user_type=".$this->type_writer);
        }
        
        // likes
        $this->db2->query('DELETE FROM notifications WHERE type_notif=12 AND iditem_notif='.$this->idcomment.' AND typeitem_notif=5');
        
    }
    
    private function _deleteReports()
    {

    }

    private function _deleteLikes()
    {
        $this->db2->query('DELETE FROM likes WHERE typeitem=1 AND iditem='.$this->idcomment);
    }

    private function _deleteHiddens()
    {

    }

    private function _deleteMedia()
    {
        if ($this->idattach != 0) {
            $the_media = new media($this->idattach);            
            $the_media->deleteMedia();
        }
    }
	
    private function _deleteActivity($where, $action, $id_where)
    {
        $this->db2->query('DELETE FROM activities WHERE where_was_made='.$where.' AND action='.$action.' AND id_where='.$id_where);
    }
    
    public function deleteComment()
    {
        $this->db2->query('DELETE FROM comments WHERE idcomment='.$this->idcomment.' LIMIT 1');

        if ($this->typeitem == 0) {
            $this->db2->query('UPDATE posts SET numcomments=numcomments-1 WHERE idpost='.$this->iditem.' LIMIT 1');
        } else {
            $this->db2->query('UPDATE medias SET numcomments=numcomments-1 WHERE idmedia='.$this->iditem.' LIMIT 1');
        }
        
		$this->_deleteActivity(0, 2, $this->iditem);
        $this->_deleteNotifications();
        $this->_deleteLikes();
        $this->_deleteReports();
        $this->_deleteHiddens();
        $this->_deleteMedia();
    }
    
}
?>