<?php
class user
{
    public $id;
    public $network;
    public $is_logged;
    public $is_admin;
    public $info;
    public $sess;
    
    public function __construct()
    {
        $this->id = FALSE;
        $this->network = &$GLOBALS['network'];
        $this->db1 = &$GLOBALS['db1'];
        $this->db2 = &$GLOBALS['db2'];
        $this->info = new stdClass;
        $this->is_logged = FALSE;
        $this->is_admin = FALSE;
        $this->sess = array();
    }
    
    public function load()
    {
        global $K;
        $this->_session_start();
        if( isset($this->sess['IS_LOGGED'], $this->sess['LOGGED_USER']) && $this->sess['IS_LOGGED'] && $this->sess['LOGGED_USER'] ) { 
            $u = & $this->sess['LOGGED_USER'];
            $u = $this->network->getUserById($u->iduser);
            if( ! $u ) {
                return FALSE;
            }
            $this->is_logged = TRUE;
            $this->is_admin = $u->is_admin ? TRUE : FALSE;
            $this->info = & $u;
            $this->id = $this->info->iduser;
            $this->db2->query('UPDATE users SET lastclick="'.time().'" WHERE iduser='.$this->id.' LIMIT 1');
            
            if (!empty($this->info->language)) $K->LANGUAGE = $this->info->language;
            if (!empty($this->info->timezone)) date_default_timezone_set($this->info->timezone);

            if( $this->info->active == 0 ) {
                $this->logout();
                return FALSE;
            }
            return $this->id;
        }
        
        if ($this->autologin()) $this->load();
        
        return FALSE;
    }
    
    private function _session_start()
    {
        if (!isset($_SESSION['USER_DATA'])) $_SESSION['USER_DATA'] = array();
        $this->sess = & $_SESSION['USER_DATA'];
    }
    
    public function login($login, $pass, $keepmelog = 0)
    {
        global $K;

        if( $this->is_logged ) return FALSE;

        if( empty($login) ) return FALSE;

        $login = $this->db2->escape($login);
        $pass = $this->db2->escape($pass);

        $r = $this->db2->query("SELECT iduser, user_password, is_admin FROM users WHERE (user_email='".$login."' OR user_username='".$login."') AND active=1 LIMIT 1");

        if( ! $obj = $this->db2->fetch_object() ) return FALSE;
        
        if (!$K->SITE_LIVE && !$obj->is_admin) return FALSE;

        $password = $obj->user_password;

        if ($password != $pass) return FALSE;
        
        $this->info = $this->network->getUserById($obj->iduser);
        if( ! $this->info ) return FALSE;

        $this->is_logged = TRUE;
        $this->sess['IS_LOGGED'] = TRUE;
        $this->sess['LOGGED_USER'] = & $this->info;
        $this->id = $this->info->iduser;
        
        $ip = $this->db2->escape( ip2long($_SERVER['REMOTE_ADDR']) );
        $this->db2->query('UPDATE users SET previousaccess=lastaccess, ippreviousaccess=iplastaccess, lastaccess="'.time().'", iplastaccess="'.$ip.'", lastclick="'.time().'" WHERE iduser='.$this->id.' LIMIT 1');

        $this->sess['total_pageviews'] = 0;
        
        if( $keepmelog == 1 ) {
            $tmp = $this->id.'_'.$pass.'_'.md5($this->info->user_username.'~~'.$password.'~~'.$_SERVER['HTTP_USER_AGENT']);
            setcookie('keepmelog', $tmp, time()+60*24*60*60, '/');
        }
        
        return TRUE;
    }
    
    public function loginSocial($login, $oauth)
    {
        global $K;

        if( $this->is_logged ) return FALSE;

        if( empty($login) ) return FALSE;

        $login = $this->db2->escape($login);
        
        // First check if there is a user with email or username
        $r = $this->db2->query("SELECT iduser FROM users WHERE (user_email='".$login."' OR user_username='".$login."') AND auth='".$oauth."' AND active=1 LIMIT 1");

        if( ! $obj = $this->db2->fetch_object() ) return FALSE;
        
        $this->info = $this->network->getUserById($obj->iduser);
        if( ! $this->info ) return FALSE;

        $this->is_logged = TRUE;
        $this->sess['IS_LOGGED'] = TRUE;
        $this->sess['LOGGED_USER'] = & $this->info;
        $this->id = $this->info->iduser;
        
        $ip = $this->db2->escape( ip2long($_SERVER['REMOTE_ADDR']) );
        $this->db2->query('UPDATE users SET previousaccess=lastaccess, ippreviousaccess=iplastaccess, lastaccess="'.time().'", iplastaccess="'.$ip.'", lastclick="'.time().'" WHERE iduser='.$this->id.' LIMIT 1');

        $this->sess['total_pageviews'] = 0;
        return TRUE;
    }
    
    public function autologin() {
        if( $this->is_logged ) return FALSE;

        if( ! isset($_COOKIE['keepmelog']) ) return FALSE;
        
        $tmp = explode('_', $_COOKIE['keepmelog']);

        $this->db2->query('SELECT user_username, user_password FROM users WHERE iduser='.intval($tmp[0]).' LIMIT 1');

        if( ! $obj = $this->db2->fetch_object() ) return FALSE;

        $the_username = stripslashes($obj->user_username);
        $the_password = stripslashes($obj->user_password);
        if( $tmp[2] == md5($the_username.'~~'.$the_password.'~~'.$_SERVER['HTTP_USER_AGENT']) ) {
            return $this->login($the_username, $tmp[1], TRUE);
        }
        setcookie('keepmelog', NULL, time()+30*24*60*60, '/');
        $_COOKIE['keepmelog'] = NULL;
        return FALSE;
    }
            
    public function logout()
    {
        if( ! $this->is_logged ) return FALSE;
        setcookie('keepmelog', NULL, time()+60*24*60*60, '/');
        $_COOKIE['keepmelog'] = NULL;
        $this->sess['IS_LOGGED'] = FALSE;
        $this->sess['LOGGED_USER'] = NULL;
        unset($this->sess['IS_LOGGED']);
        unset($this->sess['LOGGED_USER']);
        $this->id = FALSE;
        $this->info = new stdClass;
        $this->is_logged = FALSE;
    }
    
    public function getAvatar($size)
    {
        global $K;
        $url_avatar = $K->STORAGE_URL_AVATARS.'min'.$size.'/'.$this->info->avatar;
        if ($this->info->avatar != $K->DEFAULT_AVATAR_USER) $url_avatar = $K->STORAGE_URL_AVATARS.'min'.$size.'/'.$this->info->code.'/'.$this->info->avatar;
        return $url_avatar;
    }
    
    
    public function likeMePage($idpage)
    {
        if (!$this->is_logged) return FALSE;
        $res = $this->db2->fetch_field('SELECT idlike FROM likes WHERE iditem='.$idpage.' AND typeitem=3 AND iduser='.$this->id.' LIMIT 1');
        return $res ? TRUE : FALSE;
    }


    
    public function friendship($iduser)
    {
        if (!$this->is_logged) return FALSE;

        $res = $this->db2->fetch('SELECT * FROM friends WHERE (friend1='.$iduser.' AND friend2='.$this->id.') OR (friend2='.$iduser.' AND friend1='.$this->id.') LIMIT 1');
        
        $friendship = 0; // They are not friends.
        if ($res) {
            if ($res->accepted_date != 0) $friendship = 1; // They are friends.
            else {
                if ($res->friend1 == $this->id) $friendship = 2; // You've sent a friend request.
                else if ($res->friend1 == $iduser) $friendship = 3; // He has sent you a friend request.
            }
        }
        
        return $friendship;
    }
    
    
    public function sendFriendRequest($codeuser)
    {
        if (!$this->is_logged) return FALSE;
        
        $iduser = $this->db2->fetch_field("SELECT iduser FROM users WHERE code='".$codeuser."' LIMIT 1");
        
        if (!$iduser) return FALSE;
        
        $idfriend = $this->db2->fetch_field('SELECT id FROM friends WHERE (friend1='.$iduser.' AND friend2='.$this->id.') OR (friend1='.$this->id.' AND friend2='.$iduser.')');

        if ($idfriend) return FALSE;

        $this->db2->query('INSERT INTO friends SET friend1='.$this->id.', friend2='.$iduser.', send_date="'.time().'"');

        $this->db2->query('UPDATE users SET num_notifications_people=num_notifications_people+1 WHERE iduser='.$iduser.' LIMIT 1');

        $this->db2->query("INSERT INTO notifications SET type_notif=5, typeitem_notif=0, to_user=".$iduser.", from_user=".$this->id.", from_user_type=0, whendate='".time()."'");

        return TRUE;
    }
    
    public function deleteRequestFriend($codeuser)
    {
        if (!$this->is_logged) return FALSE;
        
        $iduser = $this->db2->fetch_field("SELECT iduser FROM users WHERE code='".$codeuser."' LIMIT 1");
        
        if (!$iduser) return FALSE;
        
        $idfriend = $this->db2->fetch_field('SELECT id FROM friends WHERE accepted_date=0 AND ((friend1='.$iduser.' AND friend2='.$this->id.') OR (friend1='.$this->id.' AND friend2='.$iduser.'))');

        if (!$idfriend) return FALSE;
                    
        $this->db2->query('DELETE FROM friends WHERE friend2='.$this->id.' AND friend1='.$iduser);
        
        $this->db2->query("DELETE FROM notifications WHERE type_notif=5 AND typeitem_notif=0 AND to_user=".$this->id." AND from_user=".$iduser." AND from_user_type=0");
        $affected_rows = $this->db2->affected_rows();
        if ($affected_rows > $this->info->num_notifications_people) $affected_rows = $this->info->num_notifications_people;
        $this->db2->query('UPDATE users SET num_notifications_people=num_notifications_people-'.$affected_rows.' WHERE iduser="'.$this->id.'" LIMIT 1');

        return TRUE;
    }

    public function cancelRequestFriend($codeuser)
    {
        if (!$this->is_logged) return FALSE;
        
        $iduser = $this->db2->fetch_field("SELECT iduser FROM users WHERE code='".$codeuser."' LIMIT 1");
        
        if (!$iduser) return FALSE;
        
        $idfriend = $this->db2->fetch_field('SELECT id FROM friends WHERE accepted_date=0 AND ((friend1='.$iduser.' AND friend2='.$this->id.') OR (friend1='.$this->id.' AND friend2='.$iduser.'))');

        if (!$idfriend) return FALSE;
        
        $num_notif_user = $this->db2->fetch_field('SELECT num_notifications_people FROM users WHERE iduser='.$iduser.' LIMIT 1');
                    
        $this->db2->query('DELETE FROM friends WHERE friend1='.$this->id.' AND friend2='.$iduser);
        
        $this->db2->query("DELETE FROM notifications WHERE type_notif=5 AND typeitem_notif=0 AND to_user=".$iduser." AND from_user=".$this->id." AND from_user_type=0");
        $affected_rows = $this->db2->affected_rows();
        if ($affected_rows > $num_notif_user) $affected_rows = $num_notif_user;
        $this->db2->query('UPDATE users SET num_notifications_people=num_notifications_people-'.$affected_rows.' WHERE iduser='.$iduser.' LIMIT 1');

        return TRUE;
    }

    public function confirmRequestFriend($codeuser)
    {
        if (!$this->is_logged) return FALSE;
        
        $iduser = $this->db2->fetch_field("SELECT iduser FROM users WHERE code='".$codeuser."' LIMIT 1");
        
        if (!$iduser) return FALSE;
        
        $idfriend = $this->db2->fetch_field('SELECT id FROM friends WHERE accepted_date=0 AND ((friend1='.$iduser.' AND friend2='.$this->id.') OR (friend1='.$this->id.' AND friend2='.$iduser.'))');

        if (!$idfriend) return FALSE;

        //actions info for friending
        $this->db2->query('UPDATE friends SET accepted_date="'.time().'" WHERE friend2='.$this->id.' AND friend1='.$iduser);

        $this->db2->query("DELETE FROM notifications WHERE type_notif=5 AND typeitem_notif=0 AND to_user=".$this->id." AND from_user=".$iduser." AND from_user_type=0");
        $affected_rows = $this->db2->affected_rows();
        if ($affected_rows > $this->info->num_notifications_people) $affected_rows = $this->info->num_notifications_people;
        $this->db2->query('UPDATE users SET num_notifications_people=num_notifications_people-'.$affected_rows.' WHERE iduser="'.$this->id.'" LIMIT 1');

        $this->db2->query('UPDATE users SET num_friends=num_friends+1, num_notifications_people=num_notifications_people+1 WHERE iduser="'.$iduser.'" LIMIT 1');
        $this->db2->query('UPDATE users SET num_friends=num_friends+1 WHERE iduser="'.$this->id.'" LIMIT 1');
        
        $this->db2->query("INSERT INTO notifications SET type_notif=6, typeitem_notif=0, to_user=".$iduser.", from_user=".$this->id.", from_user_type=0, whendate='".time()."'");

        //actions for Following
        $this->db2->query('INSERT INTO relations SET follower='.$this->id.', leader='.$iduser.', type_leader=0, whendate="'.time().'"');
        $this->db2->query('INSERT INTO relations SET follower='.$iduser.', leader='.$this->id.', type_leader=0, whendate="'.time().'"');
        
        $this->db2->query('UPDATE users SET num_followers=num_followers+1, num_following=num_following+1, num_notifications_people=num_notifications_people+1 WHERE iduser="'.$iduser.'" LIMIT 1');
        
        $this->db2->query('UPDATE users SET num_followers=num_followers+1, num_following=num_following+1, num_notifications_people=num_notifications_people+1 WHERE iduser="'.$this->id.'" LIMIT 1');
        
        $this->db2->query("INSERT INTO notifications SET type_notif=1, typeitem_notif=0, to_user=".$iduser.", from_user=".$this->id.", from_user_type=0, whendate='".time()."'");
        $this->db2->query("INSERT INTO notifications SET type_notif=1, typeitem_notif=0, to_user=".$this->id.", from_user=".$iduser.", from_user_type=0, whendate='".time()."'");

        return TRUE;
    }


    public function unFriend($codeuser)
    {
        if (!$this->is_logged) return FALSE;
        
        $iduser = $this->db2->fetch_field("SELECT iduser FROM users WHERE code='".$codeuser."' LIMIT 1");
        
        if (!$iduser) return FALSE;
        
        $idfriend = $this->db2->fetch_field('SELECT id FROM friends WHERE accepted_date<>0 AND ((friend1='.$iduser.' AND friend2='.$this->id.') OR (friend1='.$this->id.' AND friend2='.$iduser.'))');

        if (!$idfriend) return FALSE;

        $friendship = $this->db2->fetch_field('SELECT id FROM friends WHERE friend2='.$this->id.' AND friend1='.$iduser.' LIMIT 1');
        if ($friendship) {

            $num_notif_user = $this->db2->fetch_field('SELECT num_notifications_people FROM users WHERE iduser='.$iduser.' LIMIT 1');
            
            $this->db2->query('DELETE FROM friends WHERE friend2='.$this->id.' AND friend1='.$iduser.' LIMIT 1');

            $this->db2->query("DELETE FROM notifications WHERE type_notif=6 AND typeitem_notif=0 AND to_user=".$iduser." AND from_user=".$this->id." AND from_user_type=0");
            
            $affected_rows = $this->db2->affected_rows();
            if ($affected_rows > $num_notif_user) $affected_rows = $num_notif_user;
            $this->db2->query('UPDATE users SET num_notifications_people=num_notifications_people-'.$affected_rows.' WHERE iduser='.$iduser.' LIMIT 1');

            $this->db2->query('UPDATE users SET num_friends=num_friends-1 WHERE iduser='.$iduser.' LIMIT 1');
            $this->db2->query('UPDATE users SET num_friends=num_friends-1 WHERE iduser='.$this->id.' LIMIT 1');
            
        }

        $friendship = $this->db2->fetch_field('SELECT id FROM friends WHERE friend2='.$iduser.' AND friend1='.$this->id.' LIMIT 1');
        if ($friendship) {

            $this->db2->query('DELETE FROM friends WHERE friend2='.$iduser.' AND friend1='.$this->id.' LIMIT 1');
        
            $this->db2->query("DELETE FROM notifications WHERE type_notif=6 AND typeitem_notif=0 AND to_user=".$this->id." AND from_user=".$iduser." AND from_user_type=0");
            $affected_rows = $this->db2->affected_rows();
            if ($affected_rows > $this->info->num_notifications_people) $affected_rows = $this->info->num_notifications_people;
            $this->db2->query('UPDATE users SET num_notifications_people=num_notifications_people-'.$affected_rows.' WHERE iduser='.$this->id.' LIMIT 1');

            $this->db2->query('UPDATE users SET num_friends=num_friends-1 WHERE iduser='.$this->id.' LIMIT 1');
            $this->db2->query('UPDATE users SET num_friends=num_friends-1 WHERE iduser='.$iduser.' LIMIT 1');
            
        }

        // delete info following
        $followship = $this->db2->fetch_field('SELECT id FROM relations WHERE follower='.$this->id.' AND type_leader=0 AND leader='.$iduser.' LIMIT 1');
        if ($followship) {

            $this->db2->query('DELETE FROM relations WHERE follower='.$this->id.' AND type_leader=0 AND leader='.$iduser);
            
            $this->db2->query('UPDATE users SET num_followers=num_followers-1  WHERE iduser="'.$iduser.'" LIMIT 1');
            $this->db2->query('UPDATE users SET num_following=num_following-1 WHERE iduser="'.$this->id.'" LIMIT 1');

            $num_notif_user = $this->db2->fetch_field('SELECT num_notifications_people FROM users WHERE iduser='.$iduser.' LIMIT 1');

            $this->db2->query("DELETE FROM notifications WHERE type_notif=1 AND typeitem_notif=0 AND to_user=".$iduser." AND from_user=".$this->id." AND from_user_type=0");
            $affected_rows = $this->db2->affected_rows();
            if ($affected_rows > $num_notif_user) $affected_rows = $num_notif_user;
            $this->db2->query('UPDATE users SET num_notifications_people=num_notifications_people-'.$affected_rows.' WHERE iduser="'.$iduser.'" LIMIT 1');

        }
        
        $followship = $this->db2->fetch_field('SELECT id FROM relations WHERE follower='.$iduser.' AND type_leader=0 AND leader='.$this->id.' LIMIT 1');
        if ($followship) {

            $this->db2->query('DELETE FROM relations WHERE follower='.$iduser.' AND type_leader=0 AND leader='.$this->id);

            $this->db2->query('UPDATE users SET num_followers=num_followers-1 WHERE iduser="'.$this->id.'" LIMIT 1');
            $this->db2->query('UPDATE users SET num_following=num_following-1 WHERE iduser="'.$iduser.'" LIMIT 1');

            $this->db2->query("DELETE FROM notifications WHERE type_notif=1 AND typeitem_notif=0 AND to_user=".$this->id." AND from_user=".$iduser." AND from_user_type=0");
            $affected_rows = $this->db2->affected_rows();
            if ($affected_rows > $this->info->num_notifications_people) $affected_rows = $this->info->num_notifications_people;
            $this->db2->query('UPDATE users SET num_notifications_people=num_notifications_people-'.$affected_rows.' WHERE iduser='.$this->id.' LIMIT 1');
            
        }

        return TRUE;
    }
    
    
    public function membership($idgroup)
    {
        if (!$this->is_logged) return FALSE;

        $num_request = $this->db2->fetch_field("SELECT count(id) FROM groups_members WHERE idgroup=".$idgroup." AND iduser=".$this->id);
        if ($num_request == 0) return 2;
        else {
            $result = $this->db2->fetch_field("SELECT status FROM groups_members WHERE idgroup=".$idgroup." AND iduser=".$this->id." LIMIT 1");
            return $result;
        }
    }

    public function sendRequestToGroup($codegroup)
    { 
        if (!$this->is_logged) return FALSE;

        $idgroup = $this->db2->fetch_field("SELECT idgroup FROM groups WHERE code='".$codegroup."' LIMIT 1");
        if (!$idgroup) return FALSE;        

        $numsrecords = $this->db2->fetch_field("SELECT count(id) FROM groups_members WHERE iduser=".$this->id." AND idgroup=".$idgroup);
        if ($numsrecords != 0) return FALSE;
        else {
            $idcreator = $this->db2->fetch_field("SELECT idcreator FROM groups WHERE idgroup=".$idgroup." LIMIT 1");

            $this->db2->query("INSERT INTO groups_members SET iduser=".$this->id.", idgroup=".$idgroup.", when_request='".time()."'");

            $this->db2->query('UPDATE users SET num_notifications_global=num_notifications_global+1 WHERE iduser='.$idcreator.' LIMIT 1');

            $this->db2->query("INSERT INTO notifications SET type_notif=10, typeitem_notif=4, iditem_notif=".$idgroup.", to_user=".$idcreator.", from_user=".$this->id.", from_user_type=0, whendate='".time()."'");

            return TRUE;
        }
    }
    
    public function cancelRequestToGroup($codegroup)
    {
        if (!$this->is_logged) return FALSE;

        $idgroup = $this->db2->fetch_field("SELECT idgroup FROM groups WHERE code='".$codegroup."' LIMIT 1");
        if (!$idgroup) return FALSE;

        $numsrecords = $this->db2->fetch_field('SELECT count(id) FROM groups_members WHERE status=0 AND iduser='.$this->id.' AND idgroup='.$idgroup);
        if ($numsrecords == 0) return FALSE;
        else {
            $idcreator = $this->db2->fetch_field("SELECT idcreator FROM groups WHERE idgroup=".$idgroup." LIMIT 1");
            $this->db2->query('DELETE FROM groups_members WHERE iduser='.$this->id.' AND idgroup='.$idgroup);

            $notifications_in_user = $this->db2->fetch_field('SELECT num_notifications_global FROM users WHERE iduser='.$idcreator.' LIMIT 1');
            
            $this->db2->query("DELETE FROM notifications WHERE type_notif=10 AND typeitem_notif=4 AND iditem_notif=".$idgroup." AND to_user=".$idcreator." AND from_user=".$this->id." AND from_user_type=0");
            $affected_rows = $this->db2->affected_rows();
            if ($affected_rows > $notifications_in_user) $affected_rows = $notifications_in_user;
            $this->db2->query('UPDATE users SET num_notifications_global=num_notifications_global-'.$affected_rows.' WHERE iduser='.$idcreator.' LIMIT 1');

            return TRUE;
        }
    }
    
    
    public function leaveToGroup($codegroup)
    {
        if (!$this->is_logged) return FALSE;

        $idgroup = $this->db2->fetch_field("SELECT idgroup FROM groups WHERE code='".$codegroup."' LIMIT 1");
        if (!$idgroup) return FALSE;
        
        $numsrecords = $this->db2->fetch_field('SELECT count(id) FROM groups_members WHERE status=1 AND iduser='.$this->id.' AND idgroup='.$idgroup);
        if ($numsrecords == 0) return FALSE;
        else {
            $this->db2->query('DELETE FROM groups_members WHERE status=1 AND iduser='.$this->id.' AND idgroup='.$idgroup.' LIMIT 1');
            
            $with_notification = $this->db2->fetch_field('SELECT count(id) FROM notifications WHERE type_notif=12 AND typeitem_notif=4 AND iditem_notif='.$idgroup.' AND to_user='.$this->id);
            
            if ($with_notification > 0) {
                $this->db2->query("DELETE FROM notifications WHERE type_notif=12 AND typeitem_notif=4 AND to_user=".$this->id.' AND iditem_notif='.$idgroup);
                $affected_rows = $this->db2->affected_rows();
                
                if ($affected_rows > $this->info->num_notifications_global) $affected_rows = $this->info->num_notifications_global;
                $this->db2->query('UPDATE users SET num_notifications_global=num_notifications_global-'.$affected_rows.' WHERE iduser="'.$this->id.'" LIMIT 1');
                
            } else {

                $this->db2->query("DELETE FROM notifications WHERE type_notif=11 AND typeitem_notif=4 AND to_user=".$this->id." AND from_user=".$idgroup);
                $affected_rows = $this->db2->affected_rows();
                if ($affected_rows > $this->info->num_notifications_global) $affected_rows = $this->info->num_notifications_global;
                $this->db2->query('UPDATE users SET num_notifications_global=num_notifications_global-'.$affected_rows.' WHERE iduser="'.$this->id.'" LIMIT 1');
            
            }

            $this->db2->query('UPDATE groups SET nummembers=nummembers-1 WHERE idgroup='.$idgroup.' LIMIT 1');
            
            $this->db2->query('DELETE FROM relations WHERE follower='.$this->id.' AND type_leader=2 AND leader='.$idgroup);
            if ($this->db2->affected_rows()>0) $this->db2->query('UPDATE groups SET numfollowers=numfollowers-1 WHERE idgroup='.$idgroup.' LIMIT 1');
                        
            return TRUE;
        }
    }

    public function likePage($codepage)
    { 
        if (!$this->is_logged) return FALSE;

        $idpage = $this->db2->fetch_field("SELECT idpage FROM pages WHERE code='".$codepage."' LIMIT 1");
        if (!$idpage) return FALSE;        

        $numsrecords = $this->db2->fetch_field("SELECT count(idlike) FROM likes WHERE iduser=".$this->id." AND typeuser=0 AND iditem=".$idpage." AND typeitem=3");
        if ($numsrecords != 0) return FALSE;
        else {
            $idcreator = $this->db2->fetch_field("SELECT idcreator FROM pages WHERE idpage=".$idpage." LIMIT 1");

            $this->db2->query("INSERT INTO relations SET leader=".$idpage.", type_leader=1, follower=".$this->id.", whendate='".time()."'");
            $this->db2->query("INSERT INTO likes SET iditem=".$idpage.", typeitem=3, iduser=".$this->id.", typeuser=0, whendate='".time()."'");
            $idlike = $this->db2->insert_id();
            $this->db2->query("UPDATE pages SET numlikes=numlikes+1, numfollowers=numfollowers+1 WHERE idpage=".$idpage.' LIMIT 1');

            if ($this->id != $idcreator) {
                $this->db2->query("INSERT INTO notifications SET type_notif=9, result=".$idlike.", to_user=".$idcreator.", from_user=".$this->id.", from_user_type=0, typeitem_notif=3, iditem_notif=".$idpage.", whendate='".time()."'");
                $this->db2->query("UPDATE users SET num_notifications_global=num_notifications_global+1 WHERE iduser=".$idcreator.' LIMIT 1');
            }

            return TRUE;
        }
        
    }


    public function unlikePage($codepage)
    { 
        if (!$this->is_logged) return FALSE;

        $idpage = $this->db2->fetch_field("SELECT idpage FROM pages WHERE code='".$codepage."' LIMIT 1");
        if (!$idpage) return FALSE;        

        $numsrecords = $this->db2->fetch_field("SELECT count(idlike) FROM likes WHERE iduser=".$this->id." AND typeuser=0 AND iditem=".$idpage." AND typeitem=3");
        if ($numsrecords == 0) return FALSE;
        else {
            $idcreator = $this->db2->fetch_field("SELECT idcreator FROM pages WHERE idpage=".$idpage." LIMIT 1");

			$this->db2->query("DELETE FROM likes WHERE iditem=".$idpage." AND typeitem=3 AND iduser=".$this->id." AND typeuser=0 LIMIT 1");
			$this->db2->query("DELETE FROM relations WHERE leader=".$idpage." AND type_leader=1 AND follower=".$this->id." LIMIT 1");
			if ($this->db2->affected_rows() > 0) $this->db2->query("UPDATE pages SET numlikes=numlikes-1, numfollowers=numfollowers-1 WHERE idpage=".$idpage.' LIMIT 1');
			else $this->db2->query("UPDATE pages SET numlikes=numlikes-1 WHERE idpage=".$idpage.' LIMIT 1');

			if ($this->id != $idcreator) {
				$this->db2->query("DELETE FROM notifications WHERE type_notif=9 AND to_user=".$idcreator." AND from_user=".$this->id." AND from_user_type=0 AND typeitem_notif=3 AND iditem_notif=".$idpage);
                
				$num_notifications_creator = $this->network->getNumNotificationsGlobals($idcreator);
                
				if ($num_notifications_creator <= 0) $num_notifications_creator = 0;
				else $num_notifications_creator = $num_notifications_creator - 1;
				$this->db1->query("UPDATE users SET num_notifications_global=".$num_notifications_creator." WHERE iduser=".$idcreator.' LIMIT 1');
			}

            return TRUE;
        }
        
    }
    
    public function blockUser($codeuser)
    {
        if (!$this->is_logged) return FALSE;
        
        $iduser = $this->db2->fetch_field("SELECT iduser FROM users WHERE code='".$codeuser."' LIMIT 1");
        
        if (!$iduser) return FALSE;
        
        $isfriends = $this->friendship($iduser);
        if ($isfriends == 1) {
            $this->db2->query('UPDATE relations SET blocked=1 WHERE follower='.$iduser.' AND type_leader=0 AND leader='.$this->id.' LIMIT 1');
            $this->db2->query('UPDATE relations SET blocked=1 WHERE follower='.$this->id.' AND type_leader=0 AND leader='.$iduser.' LIMIT 1');
        }
        
        $this->db2->query("INSERT INTO users_blocked SET iduser=".$this->id.", iduserblocked=".$iduser.", type_blocked=1, whendate='".time()."'");

        return TRUE;
    }

    public function isBlocked($iduser)
    {
        if ($this->is_logged) {
            $response = $this->db2->fetch_field("SELECT count(id) FROM users_blocked WHERE iduser=".$this->id." AND type_blocked=1 AND iduserblocked=".$iduser." LIMIT 1");
            if ($response) return TRUE;
        }
        return FALSE;
    }
    
    public function isBlockedMe($iduser)
    {
        if ($this->is_logged) {
            $response = $this->db2->fetch_field("SELECT count(id) FROM users_blocked WHERE iduserblocked=".$this->id." AND type_blocked=1 AND iduser=".$iduser." LIMIT 1");
            if ($response) return TRUE;
        }
        return FALSE;
    }
    
    public function reportUser($codeuser, $reasons)
    {
        if (!$this->is_logged) return FALSE;
        
        $iduser = $this->db2->fetch_field("SELECT iduser FROM users WHERE code='".$codeuser."' LIMIT 1");
        
        if (!$iduser) return FALSE;
        
        $this->db2->query("INSERT INTO reports SET typeitem=2, iditem=".$iduser.", idinformer=".$this->id.", reasons='".$reasons."', whendate='".time()."'");

        return TRUE;
    }
    
    public function isReported($iduser)
    {
        if ($this->is_logged) {
            $response = $this->db2->fetch_field("SELECT count(idreport) FROM reports WHERE typeitem=2 AND idinformer=".$this->id." AND iditem=".$iduser." LIMIT 1");
            if ($response) return TRUE;
        }
        return FALSE;
    }

    public function isPostReported($idpost)
    {
        if ($this->is_logged) {
            $response = $this->db2->fetch_field("SELECT count(idreport) FROM reports WHERE typeitem=0 AND idinformer=".$this->id." AND iditem=".$idpost." LIMIT 1");
            if ($response) return TRUE;
        }
        return FALSE;
    }
    
    public function assistance($idevent)
    {
        if (!$this->is_logged) return FALSE;

        $num_actions = $this->db2->fetch_field("SELECT count(id) FROM events_actions WHERE idevent=".$idevent." AND iduser=".$this->id);
        if ($num_actions == 0) return false;
        else {
            $result = $this->db2->fetch_field("SELECT type_action FROM events_actions WHERE idevent=".$idevent." AND iduser=".$this->id." LIMIT 1");
            return $result;
        }
    }
    
    public function invitedToEvent($idevent)
    {
        if (!$this->is_logged) return FALSE;

        $num_users = $this->db2->fetch_field("SELECT count(id) FROM events_users WHERE idevent=".$idevent." AND iduser=".$this->id);
        if ($num_users == 0) return false;
        return TRUE;
    }
    
    public function interestedInEvent($codeevent)
    { 
        if (!$this->is_logged) return FALSE;

        $idevent = $this->db2->fetch_field("SELECT idevent FROM events WHERE code='".$codeevent."' LIMIT 1");
        if (!$idevent) return 1;
        
        $numsrecords = $this->db2->fetch_field("SELECT count(id) FROM events_actions WHERE iduser=".$this->id." AND idevent=".$idevent);
        
        if ($numsrecords > 0) {
            $type_action = $this->db2->fetch_field("SELECT type_action FROM events_actions WHERE iduser=".$this->id." AND idevent=".$idevent." LIMIT 1");
            switch ($type_action) {
                case 1:
                    return 2;
                    break;
                case 2:
                    $this->db2->query("UPDATE events_actions SET type_action=1 WHERE iduser=".$this->id." AND idevent=".$idevent." LIMIT 1");
                    return 3;
                    break;                
            }
            
        } else {
            $this->db2->query("INSERT INTO events_actions set iduser=".$this->id.", idevent=".$idevent.', type_action=1');
            $this->db2->query("INSERT INTO relations SET leader=".$idevent.", follower=".$this->id.", type_leader=3, whendate='".time()."'");
            return 4;
        }
        
    }


    public function goingInEvent($codeevent)
    { 
        if (!$this->is_logged) return FALSE;

        $idevent = $this->db2->fetch_field("SELECT idevent FROM events WHERE code='".$codeevent."' LIMIT 1");
        if (!$idevent) return 1;
        
        $numsrecords = $this->db2->fetch_field("SELECT count(id) FROM events_actions WHERE iduser=".$this->id." AND idevent=".$idevent);
        
        if ($numsrecords > 0) {
            $type_action = $this->db2->fetch_field("SELECT type_action FROM events_actions WHERE iduser=".$this->id." AND idevent=".$idevent." LIMIT 1");
            switch ($type_action) {
                case 1:
                    $this->db2->query("UPDATE events_actions SET type_action=2 WHERE iduser=".$this->id." AND idevent=".$idevent." LIMIT 1");
                    return 3;
                    break;
                case 2:
                    return 2;
                    break;                
            }
            
        } else {
            $this->db2->query("INSERT INTO events_actions set iduser=".$this->id.", idevent=".$idevent.', type_action=2');
            $this->db2->query("INSERT INTO relations SET leader=".$idevent.", follower=".$this->id.", type_leader=3, whendate='".time()."'");
            return 4;
        }
        
    }

    public function quitInEvent($codeevent)
    { 
        if (!$this->is_logged) return FALSE;

        $idevent = $this->db2->fetch_field("SELECT idevent FROM events WHERE code='".$codeevent."' LIMIT 1");
        if (!$idevent) return 1;
        
        $numsrecords = $this->db2->fetch_field("SELECT count(id) FROM events_actions WHERE iduser=".$this->id." AND idevent=".$idevent);
        
        if ($numsrecords > 0) {
            
            $this->db2->query("DELETE FROM events_actions WHERE iduser=".$this->id." AND idevent=".$idevent);
            $this->db2->query("DELETE FROM relations WHERE leader=".$idevent." AND follower=".$this->id." AND type_leader=3 LIMIT 1");
            return 3;
            
        } else {
            return 2;
        }
        
    }
    
}
?>