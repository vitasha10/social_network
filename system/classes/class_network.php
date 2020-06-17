<?php
class network
{
    public $info;
    public $is_private;
    public $is_public;

    public function __construct()
    {
        $this->K = new stdClass;
        $this->info = new stdClass;
        $this->db1  = & $GLOBALS['db1'];
        $this->db2  = & $GLOBALS['db2'];
    }

    public function load()
    {
        $this->load_network_settings();
        $this->is_private = FALSE;
        $this->is_public = TRUE;
    }

    public function load_network_settings()
    {
        $db = &$this->db1;
        $r = $db->query('SELECT * FROM settings', FALSE);
        while($obj = $db->fetch_object($r)) {
            $this->K->{$obj->word} = stripslashes($obj->value);
        }

        global $K;
        foreach($this->K as $k=>$v) {
            $K->$k = & $this->K->$k;
        }

        if( !isset($K->SITE_TITLE) || empty($K->SITE_TITLE) ) {
            $K->SITE_TITLE = 'ChatBlat';
        }
        $K->OUTSIDE_SITE_TITLE = $K->SITE_TITLE;
    }

    public function getUserByUsername($uname, $return_id = FALSE)
    {
        if (empty($uname)) return FALSE;

        $uid = FALSE;
        $r = $this->db2->query('SELECT iduser FROM users WHERE user_username="'.$this->db2->escape($uname).'" LIMIT 1', FALSE);
        if ($o = $this->db2->fetch_object($r)) {
            $uid = intval($o->iduser);
            return $return_id ? $uid : $this->getUserById($uid);
        }

        return FALSE;
    }    

    public function getUserByCode($ucode, $return_id = FALSE)
    {
        if (empty($ucode)) return FALSE;

        $uid = FALSE;
        $r = $this->db2->query("SELECT iduser FROM users WHERE code='".$this->db2->escape($ucode)."' LIMIT 1", FALSE);
        if ($o = $this->db2->fetch_object($r)) {
            $uid = intval($o->iduser);
            return $return_id ? $uid : $this->getUserById($uid);
        }

        return FALSE;
    }

    public function verifyStatic($url)
    {
        if (empty($url)) return FALSE;
        $idstatic = $this->db2->fetch_field("SELECT idstatic FROM statics WHERE url='".$url."' LIMIT 1");
        return $idstatic;
    }

    public function getUserById($uid)
    {
        global $K;

        $uid = intval($uid);
        if (0 == $uid) return FALSE;

        $r = $this->db2->query('SELECT * FROM users WHERE iduser="'.$uid.'" LIMIT 1', FALSE);

        if ($o = $this->db2->fetch_object($r)) {

            $o->firtsname = stripslashes($o->firstname);
            $o->lastname = stripslashes($o->lastname);
            $o->aboutme = stripslashes($o->aboutme);
            if (empty($o->avatar)) $o->avatar = $K->DEFAULT_AVATAR_USER;

            $o->age = '';
            $bd_day = intval( substr($o->birthday, 8, 2) );
            $bd_month = intval( substr($o->birthday, 5, 2) );
            $bd_year = intval( substr($o->birthday, 0, 4) );
            if ($bd_day>0 && $bd_month>0 && $bd_year>0) {
                if (date('Y') > $bd_year) {
                    $o->age = date('Y') - $bd_year;
                    if ($bd_month>date('m') || ($bd_month==date('m') && $bd_day>date('d'))) {
                        $o->age --;
                    }
                }
            }

            return $o;
        }

        return FALSE;

    }

    public function getGroupByName($guname, $return_id = FALSE)
    {
        if (empty($guname)) return FALSE;

        $gid = FALSE;
        $r = $this->db2->query('SELECT idgroup FROM groups WHERE guname="'.$this->db2->e($guname).'" LIMIT 1', FALSE);
        if ($o = $this->db2->fetch_object($r)) {
            $gid = intval($o->idgroup);
            return $return_id ? $gid : $this->getGroupById($gid);
        }

        return FALSE;

    }

    public function getGroupById($gid)
    {
        $gid = intval($gid);
        if ($gid == 0) return FALSE;

        $r = $this->db2->query('SELECT * FROM groups WHERE idgroup="'.$gid.'" LIMIT 1', FALSE);

        if ($o = $this->db2->fetch_object($r)) {
            $o->title = stripslashes($o->title);
            $o->about = stripslashes($o->about);            
            return $o;
        }
        return false;

    }

    public function getPageByName($puname, $return_id = FALSE)
    {
        if (empty($puname)) return FALSE;

        $pid = FALSE;
        $r = $this->db2->query('SELECT idpage FROM pages WHERE puname="'.$this->db2->e($puname).'" LIMIT 1', FALSE);
        if ($o = $this->db2->fetch_object($r)) {
            $pid = intval($o->idpage);
            return $return_id ? $pid : $this->getPageById($pid);
        }

        return FALSE;
    }

    public function getPageByCode($pcode, $return_id = FALSE)
    {
        if (empty($pcode)) return FALSE;

        $pid = FALSE;
        $r = $this->db2->query('SELECT idpage FROM pages WHERE code="'.$this->db2->e($pcode).'" LIMIT 1', FALSE);
        if ($o = $this->db2->fetch_object($r)) {
            $pid = intval($o->idpage);
            return $return_id ? $pid : $this->getPageById($pid);
        }

        return FALSE;
    }

    public function getPageById($pid)
    {
        global $K;
        $pid = intval($pid);
        if ($pid == 0) return FALSE;

        $r = $this->db2->query('SELECT * FROM pages WHERE idpage="'.$pid.'" LIMIT 1', FALSE);

        if ($o = $this->db2->fetch_object($r)) {
            if (empty($o->avatar)) $o->avatar = $K->DEFAULT_AVATAR_PAGE;
            $o->title = stripslashes($o->title);
            $o->description = stripslashes($o->description);            
            return $o;
        }
        return false;
    }

    public function canWrite($who_write_on_my_wall, $iduser1, $iduser2)
    {
        if ($iduser1 == $iduser2) return TRUE;

        if ($who_write_on_my_wall == 0) return TRUE;

        if ($who_write_on_my_wall == 1 && $this->areFriends($iduser1, $iduser2)) return TRUE;

        return FALSE;        
    }

    public function areFriends($iduser1, $iduser2)
    {
        return $this->db2->fetch_field('SELECT id FROM friends WHERE accepted_date<>0 AND (friend1='.$iduser1.' AND friend2='.$iduser2.') OR (friend1='.$iduser2.' AND friend2='.$iduser1.')');
    }

    public function getNameCatPage($idcat)
    {
        $idcat = intval($idcat);
        if ($idcat == 0) return FALSE;
        return $this->db2->fetch_field('SELECT name FROM pages_cat WHERE idcategory='.$idcat.' LIMIT 1');
    }

    public function itemLiketoUser($iduser, $typeuser, $iditem, $typeitem)
    {
        $r = $this->db2->fetch_field('SELECT idlike FROM likes WHERE iduser='.$iduser.' AND typeuser='.$typeuser.' AND iditem='.$iditem.' AND typeitem='.$typeitem.' LIMIT 1');
        return $r;
    }

    public function getNumNotificationsGlobals($idu)
    {
        $idu = intval($idu);
        if ($idu == 0) return FALSE;
        return $this->db2->fetch_field('SELECT num_notifications_global FROM users WHERE iduser='.$idu.' LIMIT 1');
    }

    public function getIdWall($code, $posted_in)
    {
        $code = $this->db2->e($code);
        if (strlen($code) != 11) return FALSE;
        switch ($posted_in) {
            case 0:
                return $this->db2->fetch_field('SELECT iduser FROM users WHERE code="'.$code.'" LIMIT 1');
                break;

            case 1:
                return $this->db2->fetch_field('SELECT idpage FROM pages WHERE code="'.$code.'" LIMIT 1');
                break;

            case 2:
                return $this->db2->fetch_field('SELECT idgroup FROM groups WHERE code="'.$code.'" LIMIT 1');
                break;
                
            case 3:
                return $this->db2->fetch_field('SELECT idevent FROM events WHERE code="'.$code.'" LIMIT 1');
                break;

        }
    }

    public function userPageOwner($pcode, $return_id = FALSE)
    {
        if (empty($pcode)) return FALSE;

        $uid = FALSE;
        $r = $this->db2->query("SELECT idcreator FROM pages WHERE code='".$this->db2->escape($pcode)."' LIMIT 1", FALSE);
        if ($o = $this->db2->fetch_object($r)) {
            $uid = intval($o->idcreator);
            return $return_id ? $uid : $this->getUserById($uid);
        }

        return FALSE;

    }

    public function getNameCategory($idcategory)
    {
        return $this->db2->fetch_field("SELECT name FROM pages_cat WHERE idcategory=".$idcategory." LIMIT 1");
    }

    public function getTypeGroup($idgroup)
    {
        return $this->db2->fetch_field('SELECT privacy FROM groups WHERE idgroup='.$idgroup.' LIMIT 1');
    }
    
    public function saveRecentSearch($iduser, $iditem, $typeitem)
    {
        $result = $this->db2->fetch_field('SELECT id FROM recent_searches WHERE iduser='.$iduser.' AND iditem='.$iditem.' AND typeitem='.$typeitem.' LIMIT 1');
        if ($result) $this->db2->query('DELETE FROM recent_searches WHERE iduser='.$iduser.' AND iditem='.$iditem.' AND typeitem='.$typeitem.' LIMIT 1', FALSE);
        
        $this->db2->query("INSERT INTO recent_searches SET iduser=".$iduser.", iditem=".$iditem.", typeitem=".$typeitem.", whendate='".time()."'", FALSE);
        
        return TRUE;
    }
    
    public function getEventByCode($ecode, $return_id = FALSE)
    {
        if (empty($ecode)) return FALSE;

        $eid = FALSE;
        $r = $this->db2->query('SELECT idevent FROM events WHERE code="'.$this->db2->e($ecode).'" LIMIT 1', FALSE);
        if ($o = $this->db2->fetch_object($r)) {
            $eid = intval($o->idevent);
            return $return_id ? $eid : $this->getEventById($eid);
        }

        return FALSE;
    }
    
    public function getEventById($eid)
    {
        global $K;
        $eid = intval($eid);
        if ($eid == 0) return FALSE;

        $r = $this->db2->query('SELECT * FROM events WHERE idevent="'.$eid.'" LIMIT 1', FALSE);

        if ($o = $this->db2->fetch_object($r)) {
            $o->title = stripslashes($o->title);
            $o->address = stripslashes($o->address);
            $o->description = stripslashes($o->description);
            return $o;
        }
        return false;
    }

    public function getCategoriesArticle($idarticle, $codearticle = FALSE)
    {
        if ($idarticle) {
            $idarticle = intval($idarticle);
            if ($idarticle == 0) return FALSE;
            
            $r = $this->db2->fetch('SELECT idcategory, idsubcategory FROM articles WHERE idarticle="'.$idarticle.'" LIMIT 1');
            if (!$r) return FALSE;
            
            $idcategory = $r->idcategory;
            $idsubcategory = $r->idsubcategory;
            
            $o = new stdClass;
            $o->category = $this->db2->fetch_field('SELECT name FROM articles_cat WHERE idfather=0 AND idcategory='.$idcategory.' LIMIT 1');
            $o->subcategory = $this->db2->fetch_field('SELECT name FROM articles_cat WHERE idfather='.$idcategory.' AND idcategory='.$idsubcategory.' LIMIT 1');
            return $o;

        } else if ($codearticle) {

            if (strlen($codearticle) != 11) return FALSE;
            
            $r = $this->db2->fetch('SELECT idcategory, idsubcategory FROM articles WHERE code="'.$codearticle.'" LIMIT 1');
            if (!$r) return FALSE;
            
            $idcategory = $r->idcategory;
            $idsubcategory = $r->idsubcategory;
            
            $o = new stdClass;
            $o->category = $this->db2->fetch_field('SELECT name FROM articles_cat WHERE idfather=0 AND idcategory='.$idcategory.' LIMIT 1');
            $o->subcategory = $this->db2->fetch_field('SELECT name FROM articles_cat WHERE idfather='.$idcategory.' AND idcategory='.$idsubcategory.' LIMIT 1');
            return $o;
            
        }

        return false;
    }
    
    public function getCurrencySymbol($idcurrency)
    {
        global $K;
        $idcurrency = intval($idcurrency);
        if ($idcurrency == 0) return FALSE;

        $currency = $this->db2->fetch('SELECT * FROM currencies WHERE idcurrency='.$idcurrency.' LIMIT 1', FALSE);
        
        if (!$currency) return false;

        $o = new stdClass;
        $o->name = stripslashes($currency->name);
        $o->code_iso = stripslashes($currency->code_iso);
        $o->symbol = stripslashes($currency->symbol);
        return $o;

    }

    public function getArticlesAleat($total, $exclude=0)
    {
        $articles = $this->db2->fetch_all('SELECT * FROM articles WHERE idarticle<>'.$exclude.' ORDER BY RAND() LIMIT '.$total);
        return $articles;
    }
    
    public function getUserAleat($total, $exclude=0, $privacy=-1)
    {
        global $user;
        $condition = '';
        if ($user->is_logged) {
            $friends = $this->db2->fetch_all('SELECT iduser FROM friends, users WHERE accepted_date<>0 AND ((friend1=iduser AND friend2='.$user->id.') OR (friend1='.$user->id.' AND friend2=iduser))');
            
            if (count($friends)>0) {
                $arrayFriends = array();
                foreach($friends as $onefriend) {
                    $arrayFriends[] = $onefriend->iduser;
                }
                $condition = ' iduser NOT IN ('.implode(',',$arrayFriends).') AND ';
            }
        }
        if ($privacy==-1) $r = $this->db2->fetch_all('SELECT * FROM users WHERE '.$condition.' active=1 AND iduser<>'.$exclude.' ORDER BY RAND() LIMIT '.$total);
        else $r = $this->db2->fetch_all('SELECT * FROM users WHERE '.$condition.' active=1 AND privacy='.$privacy.' AND iduser<>'.$exclude.' ORDER BY RAND() LIMIT '.$total);
        return $r;
    }

    public function friendAllowChat($ucode)
    {
        global $user;
        if (empty($ucode)) return FALSE;
        $r = $this->db2->fetch_field("SELECT iduser FROM users WHERE code='".$this->db2->escape($ucode)."' AND chat_mute=0 LIMIT 1", FALSE);
        if ($r) {
            $thereblock = $this->db2->fetch_field("SELECT id FROM users_blocked WHERE (iduser=".$user->id." AND iduserblocked=".$r.") OR (iduser=".$r." AND iduserblocked=".$user->id.")", FALSE);
            if ($thereblock) $r = FALSE;
        }
        return $r;
    }
    
    public function getAdsAleat($slot)
    {
        $ads = $this->db2->fetch('SELECT * FROM advertising_basic WHERE idslot='.$slot.' AND status=1 ORDER BY RAND() LIMIT 1');
        return $ads;
    }
    
    public function deleteGroup($idgroup)
    {
        global $K;
        $group = $this->db2->fetch("SELECT * FROM groups WHERE idgroup=".$idgroup." LIMIT 1");
        if (!$group) return FALSE;
        
        // delete posts in group
        $posts_in_group = $this->db2->query("SELECT * FROM posts WHERE posted_in=2 AND id_wall=".$idgroup);
        while ($onepost = $this->db2->fetch_object($posts_in_group)) {
            $the_post = new post(FALSE, $onepost);
            $the_post->deletePost();
        }
        
        $idcreator = $group->idcreator;
        
        $this->db2->query("UPDATE users SET num_groups=num_groups-1 WHERE iduser=".$idcreator." LIMIT 1");
        $this->db2->query("DELETE FROM groups_members WHERE idgroup=".$idgroup);
        $this->db2->query("DELETE FROM relations WHERE type_leader=2 AND leader=".$idgroup);

        $this->db2->query("DELETE FROM groups WHERE idgroup=".$idgroup." LIMIT 1");
        $this->db2->query("DELETE FROM reports WHERE typeitem=4 AND iditem=".$idgroup);

        deleteFolder($K->STORAGE_DIR_COVERS_GROUP.$group->code);
        
        return TRUE;
        
    }
    
    public function deletePage($idpage)
    {
        global $K;
        $thepage = $this->db2->fetch("SELECT * FROM pages WHERE idpage=".$idpage." LIMIT 1");
        if (!$thepage) return FALSE;
        
        // delete posts in page
        $posts_in_page = $this->db2->query("SELECT * FROM posts WHERE posted_in=1 AND id_wall=".$idpage);
        while ($onepost = $this->db2->fetch_object($posts_in_page)) {
            $the_post = new post(FALSE, $onepost);
            $the_post->deletePost();
        }
        
        $idcreator = $thepage->idcreator;
        
        $this->db2->query("UPDATE users SET num_pages=num_pages-1 WHERE iduser=".$idcreator." LIMIT 1");
        $this->db2->query("DELETE FROM likes WHERE iditem=".$idpage." AND typeitem=3");
        $this->db2->query("DELETE FROM relations WHERE type_leader=1 AND leader=".$idpage);
        $this->db2->query("DELETE FROM pages_admin WHERE idpage=".$idpage);
        
        $this->db2->query("DELETE FROM pages WHERE idpage=".$idpage." LIMIT 1");
        $this->db2->query("DELETE FROM reports WHERE typeitem=3 AND iditem=".$idpage);

        deleteFolder($K->STORAGE_DIR_AVATARS_PAGE.'min1/'.$thepage->code);
        deleteFolder($K->STORAGE_DIR_AVATARS_PAGE.'min2/'.$thepage->code);
        deleteFolder($K->STORAGE_DIR_AVATARS_PAGE.'min3/'.$thepage->code);
        deleteFolder($K->STORAGE_DIR_AVATARS_PAGE.'min4/'.$thepage->code);
        deleteFolder($K->STORAGE_DIR_AVATARS_PAGE.'originals/'.$thepage->code);
        
        deleteFolder($K->STORAGE_DIR_COVERS_PAGE.$thepage->code);
        
        return TRUE;
        
    }
    
    public function deleteEvent($idevent)
    {
        global $K;

        $event = $this->db2->fetch("SELECT * FROM events WHERE idevent=".$idevent." LIMIT 1");
        if (!$event) return FALSE;
        
        // delete posts in event
        $posts_in_event = $this->db2->query("SELECT * FROM posts WHERE posted_in=3 AND id_wall=".$idevent);
        while ($onepost = $this->db2->fetch_object($posts_in_event)) {
            $the_post = new post(FALSE, $onepost);
            $the_post->deletePost();
        }

        // delete post of event
        $idpost = $event->idpost;
        $thepost = $this->db2->fetch("SELECT * FROM posts WHERE idpost=".$idpost." LIMIT 1");
        if ($thepost) {
            $the_post = new post(FALSE, $thepost);
            $the_post->deletePost();
        }
        $idcreator = $event->idcreator;
        $this->db2->query("UPDATE users SET num_events=num_events-1 WHERE iduser=".$idcreator." LIMIT 1");
        $this->db2->query("DELETE FROM events WHERE idevent=".$idevent." LIMIT 1");
        $this->db2->query("DELETE FROM events_actions WHERE idevent=".$idevent);
        $this->db2->query("DELETE FROM events_users WHERE idevent=".$idevent);
        $this->db2->query("DELETE FROM relations WHERE type_leader=3 AND leader=".$idevent);
        $this->db2->query("DELETE FROM reports WHERE typeitem=7 AND iditem=".$idevent);
        
        deleteFolder($K->STORAGE_DIR_COVERS_EVENT.$event->code);
        
        return TRUE;
        
    }
    
    function deleteProduct($idproduct)
    {
        global $K;
        
        $product = $this->db2->fetch("SELECT * FROM products WHERE idproduct=".$idproduct." LIMIT 1");
        if (!$product) return FALSE;

        // delete post of product
        $idpost = $product->idpost;
        $thepost = $this->db2->fetch("SELECT * FROM posts WHERE idpost=".$idpost." LIMIT 1");
        if ($thepost) {
            $the_post = new post(FALSE, $thepost);
            $the_post->deletePost();
        }

        $idsell = $product->idsell;
        
        $this->db2->query("UPDATE users SET num_products=num_products-1 WHERE iduser=".$idsell." LIMIT 1");
        $this->db2->query("DELETE FROM products WHERE idproduct=".$idproduct." LIMIT 1");
        
        $imagesprod = $this->db2->fetch_all("SELECT * FROM products_images WHERE idproduct=".$idproduct);
        if ($imagesprod) {

            $the_pholder_1 = $K->STORAGE_DIR_PRODUCTS.'min1/';
            $the_pholder_2 = $K->STORAGE_DIR_PRODUCTS.'min2/';
            
            foreach($imagesprod as $oneprod) {
                $thephoto = $oneprod->photo;
                if (!empty($thephoto)) {
                    $the_file = $K->STORAGE_DIR_PRODUCTS.$thephoto;
                    if (file_exists($the_file)) @unlink($the_file);
                    
                    $the_file = $the_pholder_1.$thephoto;
                    if (file_exists($the_file)) @unlink($the_file);
                    
                    $the_file = $the_pholder_2.$thephoto;
                    if (file_exists($the_file)) @unlink($the_file);
                    
                }
            }
        }
        
        $this->db2->query("DELETE FROM products_images WHERE idproduct=".$idproduct);
        $this->db2->query("DELETE FROM reports WHERE typeitem=6 AND iditem=".$idproduct);
        
        return TRUE;
        
    }
    
    function deleteArticle($idarticle)
    {
        global $K;
        
        $article = $this->db2->fetch("SELECT * FROM articles WHERE idarticle=".$idarticle." LIMIT 1");
        if (!$article) return FALSE;

        // delete post of article
        $idpost = $article->idpost;
        $thepost = $this->db2->fetch("SELECT * FROM posts WHERE idpost=".$idpost." LIMIT 1");
        if ($thepost) {
            $the_post = new post(FALSE, $thepost);
            $the_post->deletePost();
        }
        
        $iduser = $article->idwriter;
        
        $this->db2->query("UPDATE users SET num_articles=num_articles-1 WHERE iduser=".$iduser." LIMIT 1");
        $this->db2->query("DELETE FROM articles WHERE idarticle=".$idarticle." LIMIT 1");
        $this->db2->query("DELETE FROM reports WHERE typeitem=5 AND iditem=".$idarticle);

        $the_pholder_1 = $K->STORAGE_DIR_ARTICLES.'min1/';
        $the_pholder_2 = $K->STORAGE_DIR_ARTICLES.'min2/';
                
        $thephoto = $article->photo;
        if (!empty($thephoto)) {
            $the_file = $K->STORAGE_DIR_ARTICLES.$thephoto;
            if (file_exists($the_file)) @unlink($the_file);
            
            $the_file = $the_pholder_1.$thephoto;
            if (file_exists($the_file)) @unlink($the_file);
            
            $the_file = $the_pholder_2.$thephoto;
            if (file_exists($the_file)) @unlink($the_file);
        }
        
        return TRUE;
        
    }
    
    function deleteAlbum($idalbum)
    {
        global $K;
        
        $album = $this->db2->fetch("SELECT * FROM albums WHERE idalbum=".$idalbum." LIMIT 1");
        if (!$album) return FALSE;

        // delete post of album
        $idpost = $album->idpost;
        $thepost = $this->db2->fetch("SELECT * FROM posts WHERE idpost=".$idpost." LIMIT 1");
        if ($thepost) {
            $the_post = new post(FALSE, $thepost);
            $the_post->deletePost();
        }
        
        $iduser = $album->idcreator;
        
        $this->db2->query("UPDATE users SET num_albums=num_albums-1 WHERE iduser=".$iduser." LIMIT 1");
        $this->db2->query("DELETE FROM albums_items WHERE idalbum=".$idalbum);
        $this->db2->query("DELETE FROM albums WHERE idalbum=".$idalbum." LIMIT 1");
        
        return TRUE;
        
    }
    
    function deletePhotoAlbum($idphoto, $idalbum)
    {
        global $K;
        
        $themedia = $this->db2->fetch("SELECT * FROM medias WHERE idmedia=".$idphoto." LIMIT 1");
        if (!$themedia) return FALSE;

        /************************/
        $the_file = $K->STORAGE_DIR_ALBUMS_USERS.'original/'.$themedia->folder.'/'.$themedia->namefile;
        if (file_exists($the_file)) @unlink($the_file);

        $the_file = $K->STORAGE_DIR_ALBUMS_USERS.'thumb1/'.$themedia->folder.'/'.$themedia->namefile;
        if (file_exists($the_file)) @unlink($the_file);

        $the_file = $K->STORAGE_DIR_ALBUMS_USERS.'thumb2/'.$themedia->folder.'/'.$themedia->namefile;
        if (file_exists($the_file)) @unlink($the_file);

        $the_file = $K->STORAGE_DIR_ALBUMS_USERS.'thumb3/'.$themedia->folder.'/'.$themedia->namefile;
        if (file_exists($the_file)) @unlink($the_file);

        $the_file = $K->STORAGE_DIR_ALBUMS_USERS.'thumb4/'.$themedia->folder.'/'.$themedia->namefile;
        if (file_exists($the_file)) @unlink($the_file);
        /************************/
        
        $allcomments = $this->db2->fetch_all('SELECT idcomment FROM comments WHERE typeitem=1 AND iditem='.$idphoto);
		foreach ($allcomments as $onecomments) {
            $this->db2->query('DELETE FROM reports WHERE typeitem=1 AND iditem='.$onecomments->idcomment);
            $this->db2->query('DELETE FROM hiddens WHERE typeitem=1 AND iditem='.$onecomments->idcomment);
            $this->db2->query('DELETE FROM likes WHERE typeitem=1 AND iditem='.$onecomments->idcomment);
        }
        
        $this->db2->query('DELETE FROM notifications WHERE iditem_notif='.$idphoto.' AND typeitem_notif=6');
        
        $this->db2->query('DELETE FROM comments WHERE typeitem=1 AND iditem='.$idphoto);
        $this->db2->query('DELETE FROM likes WHERE typeitem=2 AND iditem='.$idphoto);
        
        /************************/
        
        $this->db2->query("DELETE FROM albums_items WHERE idmedia=".$themedia->idmedia." LIMIT 1");
        $this->db2->query("DELETE FROM medias WHERE idmedia=".$themedia->idmedia." LIMIT 1");
        $this->db2->query("UPDATE albums SET numphotos=numphotos-1 WHERE idalbum=".$idalbum." LIMIT 1");
        
        return TRUE;
        
    }
    
    function deleteUser($iduser)
    {
        global $K;
        global $user;
        $theuser = $this->db2->fetch("SELECT * FROM users WHERE iduser=".$iduser." LIMIT 1");
        if (!$theuser) return FALSE;

        //delete pages
        $thepages = $this->db2->fetch_all("SELECT idpage FROM pages WHERE idcreator=".$iduser);
        if ($thepages) {
            foreach ($thepages as $onepage) {
                $this->deletePage($onepage->idpage);
            }
        }
        
        //delete groups
        $thegroups = $this->db2->fetch_all("SELECT idgroup FROM groups WHERE idcreator=".$iduser);
        if ($thegroups) {
            foreach ($thegroups as $onegroup) {
                $this->deleteGroup($onegroup->idgroup);
            }
        }
        
        //delete events
        $theevents = $this->db2->fetch_all("SELECT idevent FROM events WHERE typecreator=0 AND idcreator=".$iduser);
        if ($theevents) {
            foreach ($theevents as $oneevent) {
                $this->deleteEvent($oneevent->idevent);
            }
        }
        
        //delete articles
        $thearticles = $this->db2->fetch_all("SELECT idarticle FROM articles WHERE idwriter=".$iduser);
        if ($thearticles) {
            foreach ($thearticles as $onearticle) {
                $this->deleteArticle($onearticle->idarticle);
            }
        }
        
        //delete products
        $theproducts = $this->db2->fetch_all("SELECT idproduct FROM products WHERE idsell=".$iduser);
        if ($theproducts) {
            foreach ($theproducts as $oneproduct) {
                $this->deleteProduct($oneproduct->idproduct);
            }
        }
        
        
        
        // delete reports
        $this->db2->query("DELETE FROM reports WHERE typeitem=2 AND iditem=".$iduser);
        $this->db2->query("DELETE FROM reports WHERE idinformer=".$iduser);
        
        // delete blockeds
        $this->db2->query("DELETE FROM users_blocked WHERE iduserblocked=".$iduser." OR iduser=".$iduser);

        // delete recent search
        $this->db2->query("DELETE FROM recent_searches WHERE iduser=".$iduser);

        // delete mentions
        $this->db2->query("DELETE FROM mentions WHERE iduser_mentioned=".$iduser);

        // delete notifications
        $this->db2->query("DELETE FROM notifications WHERE to_user=".$iduser);
        $this->db2->query("DELETE FROM notifications WHERE from_user_type=0 AND from_user=".$iduser);

        // delete hiddens
        $this->db2->query("DELETE FROM hiddens WHERE iduser=".$iduser);

        // delete hashtags
        $this->db2->query("DELETE FROM hashtags WHERE type_writer=0 AND idwriter=".$iduser);
        
        // delete messages
        $all_talks = $this->db2->fetch_all("SELECT talks.idtalk FROM talks INNER JOIN talks_messages ON talks.idlastmessage = talks_messages.idmessage INNER JOIN talks_users ON talks.idtalk = talks_users.idtalk WHERE talks_users.deleted = '0' AND talks_users.iduser = ".$iduser);
        if ($all_talks) {
            foreach($all_talks as $onetalk) {
                $this->db2->query("DELETE FROM talks_users WHERE idtalk=".$onetalk->idtalk);
                $this->db2->query("DELETE FROM talks_messages WHERE idtalk=".$onetalk->idtalk);
                $this->db2->query("DELETE FROM talks WHERE idtalk=".$onetalk->idtalk);
            }
        }
        
        // delete saveds
        $this->db2->query("DELETE FROM posts_saved WHERE iduser=".$iduser);
        
        // delete likes
        $this->db2->query("DELETE FROM likes WHERE typeuser=0 AND iduser=".$iduser);
        
        // delete comments
        $thecomments = $this->db2->fetch("SELECT idcomment FROM comments WHERE type_writer=0 AND idwriter=".$iduser);
        if ($thecomments) {
            foreach($thecomments as $onecomment) {
                $the_comment = new comment($onecomment->idcomment);
                $the_comment->deleteComments();
            }
        }
        
        // delete activities
        $this->db2->query("DELETE FROM activities WHERE type_user=0 AND iduser=".$iduser);
        
        // delete request friends // cancel request
        $therequests = $this->db2->fetch("SELECT code FROM friends, users WHERE friend2=iduser AND accepted_date=0 AND friend1=".$iduser);
        if ($therequests) {
            foreach($therequests as $onerequest) {
                $user->cancelRequestFriend($onerequest->code);
            }
        }
        
        // delete request friends // delete request
        $therequests = $this->db2->fetch("SELECT code FROM friends, users WHERE friend1=iduser AND accepted_date=0 AND friend2=".$iduser);
        if ($therequests) {
            foreach($therequests as $onerequest) {
                $user->deleteRequestFriend($onerequest->code);
            }
        }
        
        // delete friendship
        $thefriendship = $this->db2->fetch("SELECT code FROM friends, users WHERE (accepted_date<>0 AND friend1=iduser AND friend2=".$iduser.") OR (accepted_date<>0 AND friend2=iduser AND friend1=".$iduser.")");
        if ($thefriendship) {
            foreach($thefriendship as $onefriend) {
                $user->unFriend($onefriend->code);
            }
        }
        
        
        // delete user
        $this->db2->query("DELETE FROM users WHERE iduser=".$iduser." LIMIT 1");
        
        return true;
        
    }



}
?>