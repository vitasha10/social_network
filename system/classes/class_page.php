<?php
class page
{
    public $designer;
    
    public function __construct()
    {
        $this->network = & $GLOBALS['network'];
        $this->user = & $GLOBALS['user'];
        $this->db1 = & $GLOBALS['db1'];
        $this->db2 = & $GLOBALS['db2'];
        $this->request = array();
        $this->params = new stdClass;
        $this->params->user = FALSE;
        $this->params->group = FALSE;
        $this->title = NULL;
        $this->html  = NULL;
        $this->controllers = $GLOBALS['K']->INCPATH.'controllers/';
        $this->lang_data  = array();
        $this->tpl_name   = 'default';
    }
    
    public function load()
    {
        $this->_parse_input();
        $this->_set_template();
        $this->_send_headers();
        $this->_load_controller();
    }
    
    private function _parse_input()
    {
        global $K;
        $this->params->user = FALSE;
        $this->params->group = FALSE;
        $request = $_SERVER['REQUEST_URI'];
        $pos  = strpos($request, '?');
        if( FALSE !== $pos ) {
            $request = substr($request, 0, $pos);
        }
        if( FALSE !== strpos($request, '//') ) {
            $request = preg_replace('/\/+/iu', '/', $request);
        }
        $tmp = str_replace(array('http://','https://'), '', $K->SITE_URL);
        if( FALSE !== strpos($tmp, '//') ) {
            $tmp = preg_replace('/\/+/iu', '/', $tmp);
        }
        $tmp = substr($tmp, strpos($tmp, '/'));
        if( substr($request,0,strlen($tmp)) == $tmp ) {
            $request = substr($request, strlen($tmp));
        }
        
        $request = trim($request, '/');
        if( empty($request) ) {
            $this->request[] = 'home';
            return;
        }
        $request = explode('/', $request);
        foreach($request as $i=>$one) {
            if( FALSE!==strpos($one,':') && preg_match('/^([a-z0-9\-_]+)\:(.*)$/iu',$one,$m) ) {
                $this->params->{$m[1]} = $m[2];
                unset($request[$i]);
                continue;
            }
            if( ! preg_match('/^([a-z0-9\-\._]+)$/iu', $one) ) {
                unset($request[$i]);
                continue;
            }
        }
        $request = array_values($request);
        if( 0 == count($request) ) {
            $this->request[] = 'home';
            return;
        }

        // Process sitemap
        if (preg_match('/^sitemap(?P<sitemap>[^\.]*)\.xml$/i', $request[0], $matches)) {
            $this->params->insitemap = $matches['sitemap'];
            $this->request[] = 'sitemap';
            return;
        }

        $first = $request[0];
        if ( file_exists($this->controllers.$first.'.php') ) {

            if ($first == 'info') {
                $numblocks = count($request);
                $this->params->info = 'about';
                if ($numblocks > 1) {
                    $this->params->info = strtolower($request[1]);
                }
                $idstatic = $this->network->verifyStatic($this->params->info);
                
                if (!$idstatic) $this->request[] = 'error404';
                else $this->request[] = $first;

            } elseif ($first == 'hashtag') {
                $numblocks = count($request);
                if ($numblocks > 1) {
                    $this->params->hashtag = strtolower($request[1]);
                }
                $this->request[] = $first;

            } elseif ($first == 'event') {
                $numblocks = count($request);
                if ($numblocks > 1) {
                    
                    $myparam = strtolower($request[1]);
                    if ($myparam == 'interested' || $myparam == 'going') {

                        if ($numblocks > 2) {
                            $this->params->codeevent = $request[2];
                            $theevent = $this->network->getEventByCode($this->params->codeevent);
                            if (!$theevent) $this->request[] = 'error404';
                            else {
                                $this->request[] = $first.'-'.$myparam;
                            }
                        } else {
                            $this->request[] = 'error404';
                        }
                        
                    } else {
                        
                        $this->params->codeevent = $request[1];
                        $theevent = $this->network->getEventByCode($this->params->codeevent);
                        
                        if (!$theevent) $this->request[] = 'error404';
                        else $this->request[] = $first;
                        
                    }
                    
                } else {
                    $this->request[] = 'error404';
                }

            } elseif ($first == 'article') {
                $numblocks = count($request);
                if ($numblocks > 1) {
                    $this->params->codearticle = $request[1];
                }
                $this->request[] = $first;

            } elseif ($first == 'games') {
                $numblocks = count($request);
                $first = 'games';
                if ($numblocks > 1) {
                    $this->params->codegame = $request[1];
                    $first = 'games-view';
                }
                $this->request[] = $first;

            } elseif ($first == 'messages') { 

                $numblocks = count($request);
                if ($numblocks > 1) {
                    if ($iduserchat = $this->network->getUserByUsername($request[1], TRUE)) {
                        $this->params->userchat = $request[1];
                        $this->params->iduserchat = $iduserchat;
                    }
                }
                $this->request[] = $first;
            
            } else {
                $this->request[] = $first;
            }
            
        } elseif ( $u = $this->network->getUserByUsername($first, TRUE) ) {
            
            if ($K->SITE_PRIVACY == 1) {
                if (!$this->user->is_logged) {
                    $this->globalRedirect('login');
                    return;
                }
            }
            
            $this->params->username = $first;
            $this->params->user = $u;
            
            $blocknumber = count($request);
            
            if ($blocknumber > 1) {
                $cadbloque01 = strtolower($request[1]);
                switch($cadbloque01) {
                    case 'activity':
                        $this->request[] = 'profile';
                        break;

                    case 'likes':
                        $this->request[] = 'profile-likes';
                        break;

                    case 'groups':
                        $this->request[] = 'profile-groups';
                        break;

                    case 'albums':
                        $this->request[] = 'profile-albums';
                        if ($blocknumber > 2) {
                             $this->params->codalbum = $request[2];
                        }
                        break;

                    case 'photos':
                        $this->request[] = 'profile-photos';
                        break;

                    case 'photo':
                        $this->request[] = 'profile-photo';
                        if ($blocknumber > 2) {
                            $this->params->codphoto = $request[2];
                        }
                        break;

                    case 'videos':
                        $this->request[] = 'profile-videos';
                        break;

                    case 'audios':
                        $this->request[] = 'profile-audios';
                        break;

                    case 'post':
                        $this->request[] = 'profile-post';
                        if ($blocknumber > 2) {
                            $this->params->codpost = $request[2];
                        }
                        break;

                    case 'info':
                        $this->request[] = 'profile-info';
                        break;

                    case 'friends':
                        $this->request[] = 'profile-friends';
                        break;

                    case 'followers':
                        $this->request[] = 'profile-followers';
                        break;

                    case 'following':
                        $this->request[] = 'profile-following';
                        break;

                    case 'messages':
                        $this->request[] = 'profile-messages';
                        break;

                    default:
                        $this->request[] = 'error404';
                }
            } else {
                $this->request[] = 'profile';
            }
            
        } elseif ( $g = $this->network->getGroupByName($first, TRUE) ) {
            
            if ($K->SITE_PRIVACY == 1) {
                if (!$this->user->is_logged) {
                    $this->globalRedirect('login');
                    return;
                }
            }

            $this->params->username = $first;
            $this->params->group = $g;
            
            $blocknumber = count($request);
            
            if ($blocknumber > 1) {
                $cadbloque01 = strtolower($request[1]);
                switch($cadbloque01) {
                    case 'settings':
                        $this->request[] = 'group-settings';
                        break;
                    case 'requests':
                        $this->request[] = 'group-requests';
                        break;
                    case 'members':
                        $this->request[] = 'group-members';
                        break;
                    case 'photos':
                        $this->request[] = 'group-photos';
                        break;
                    case 'videos':
                        $this->request[] = 'group-videos';
                        break;
                    case 'audios':
                        $this->request[] = 'group-audios';
                        break;

                    default:
                        $this->request[] = 'error404';
                }
            } else {
                $this->request[] = 'group';
            }
            
        } elseif ( $p = $this->network->getPageByName($first, TRUE) ) {
            
            if ($K->SITE_PRIVACY == 1) {
                if (!$this->user->is_logged) {
                    $this->globalRedirect('login');
                    return;
                }
            }
            
            $this->params->username = $first;
            $this->params->page = $p;
            
            $blocknumber = count($request);
            
            if ($blocknumber > 1) {
                $cadbloque01 = strtolower($request[1]);
                switch($cadbloque01) {
                    case 'settings':
                        $this->request[] = 'page-settings';
                        break;
                    case 'photos':
                        $this->request[] = 'page-photos';
                        break;
                    case 'photo':
                        $this->request[] = 'page-photo';
                        if ($blocknumber > 2) {
                            $this->params->codphoto = $request[2];
                        }
                        break;
                    case 'post':
                        $this->request[] = 'page-post';
                        if ($blocknumber > 2) {
                            $this->params->codpost = $request[2];
                        }
                        break;
                    case 'videos':
                        $this->request[] = 'page-videos';
                        break;
                    case 'audios':
                        $this->request[] = 'page-audios';
                        break;
                    default:
                        $this->request[] = 'error404';
                }
            } else {
                $this->request[] = 'page';
            }
            
        } else {
            $this->request[] = 'error404';
            return;
        }        

        unset($request[0]);
        foreach($request as $one) {
            $t = $this->request;
            $t[] = $one;
            if( file_exists( $this->controllers.implode('_', $t).'.php') ) {
                $this->request[] = $one;
                continue;
            }
            break;
        }
        if( ! $this->params->user ) {
            $this->params->user = $this->user->is_logged ? $this->user->id : FALSE;
        }
        if( 0 == count($this->request) ) {
            $this->request[] = 'home';
            return;
        }
    }
    
    private function _send_headers()
    {
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', FALSE);
        header('Pragma: no-cache');
        header('Last-Modified: '.gmdate('D, d M Y H:i:s'). ' GMT');
        if ( $this->request[0] == 'services' ) {
            header('Content-type: application/json; charset=utf-8');
        } elseif (isset($this->params->format)) {
            switch ($this->params->format) {
                case 'xml':  header('Content-type: application/xml');
                         break;
                case 'json': header('Content-type: application/json');
                         break;
                case 'rss':  header('Content-type: application/rss+xml');
                         break;
                case 'atom': header('Content-type: application/atom+xml');
                         break;
                default: header('Content-type: application/xml');
                         break;
            } 
        } else {
            header('Content-type: text/html; charset=utf-8');
        }
    }
    
    public function _set_template()
    {
        if( isset($GLOBALS['K']->THEME) && file_exists($GLOBALS['K']->INCPATH.'../themes/'.$GLOBALS['K']->THEME.'/theme.php') ) {
            $this->tpl_name  = $GLOBALS['K']->THEME;
        }
        $this->tpl_dir  = $GLOBALS['K']->INCPATH.'../themes/'.$this->tpl_name.'/';
        $current_theme = FALSE;
        @include( $this->tpl_dir.'theme.php' );
        $GLOBALS['K']->THEME = $this->tpl_name;
        return $current_theme;
    }
    
    private function _load_controller()
    {
        global $K, $D, $designer;
        $D = new stdClass;
        $D->page_title = $K->SITE_TITLE;
        $db1  = & $this->db1;
        $db2  = & $this->db2;
        $db  = & $db2;
        $user  = & $this->user;
        $network = & $this->network;
        
        $this->designer = new designer();

        // We define some global variables
        $D->_IN_DASHBOARD = FALSE;
        $D->_IN_PROFILE = FALSE;
        $D->_IN_ADMIN_PANEL = FALSE;
        $D->_IN_SETTING_PANEL = FALSE;

        $D->_IS_LOGGED = FALSE;
        $D->_IS_ADMIN_USER = FALSE;
        $D->_WITH_NOTIFIER = FALSE;
        
        if ($user->is_logged) $D->_IS_LOGGED = TRUE;
        if ($user->is_admin) $D->_IS_ADMIN_USER = TRUE;
        
        $D->base_files_js = array();
        
        if (!$K->SITE_LIVE && !$D->_IS_ADMIN_USER) {

            if ($this->request[0] != 'admin') {

                unset($this->request);
                $this->request = array();
                $this->request[] = 'siteoff';
            } else {

                $this->request[0] = 'loginoff';
            }
        }
        
        require_once( $this->controllers.implode('_',$this->request).'.php' );
    }

    public function load_extract_controller($file_extract)
    {
        global $K, $D;
        require_once($this->controllers.'extracts/'.$file_extract.'.php');
    }
    
    public function load_template($filename, $output_content=TRUE)
    {
        global $K, $D;
        $filename = $this->tpl_dir.'html/'.$filename;
        if( $output_content ) {
            require($filename);
            return TRUE;
        }
        else {
            ob_start();
            require($filename);
            $cnt = ob_get_contents();
            ob_end_clean();
            return $cnt;
        }
    }
    
    public function loadLanguage($filename)
    {
        if( ! isset($this->tmp_loaded_langfiles) ) {
            $this->tmp_loaded_langfiles = array();
        }
        $this->tmp_loaded_langfiles[] = $filename;
        global $K;
        $lang = array();
        ob_start();
        require( $GLOBALS['K']->INCPATH.'languages/'.$GLOBALS['K']->LANGUAGE.'/'.$filename );
        ob_end_clean();
        if( ! is_array($lang) ) {
            return FALSE;
        }
        foreach($lang as $k=>$v) {
            $this->lang_data[$k] = $v;
        }
    }
    
    public function lang($key, $replace_strings=array())
    {
        if( empty($key) ) {
            return '';
        }
        if( ! isset($this->lang_data[$key]) ) {
            return '';
        }
        $txt = $this->lang_data[$key];
        if( 0 == count($replace_strings) ) {
            return $txt;
        }
        return str_replace(array_keys($replace_strings), array_values($replace_strings), $txt);
    }
    
    
    public function param($key)
    {
        if( FALSE == isset($this->params->$key) ) {
            return FALSE;
        }
        $value = $this->params->$key;
        if( is_numeric($value) ) {
            return floatval($value);
        }
        if( $value=="true" || $value=="TRUE" ) {
            return TRUE;
        }
        if( $value=="false" || $value=="FALSE" ) {
            return FALSE;
        }
        return $value;
    }
    
    public function redirect($loc, $abs=FALSE)
    {
        global $K;
        if( ! $abs && preg_match('/^http(s)?\:\/\//', $loc) ) {
            $abs = TRUE;
        }
        if( ! $abs ) {
            if( $loc{0} != '/' ) {
                $loc = $K->SITE_URL.$loc;
            }
        }
        if( ! headers_sent() ) {
            header('Location: '.$loc);
        }
        echo '<meta http-equiv="refresh" content="0;url='.$loc.'" />';
        echo '<script type="text/javascript"> self.location = "'.$loc.'"; </script>';
        exit;
    }

	public function globalRedirect($loc, $abs=FALSE) {
		global $K;
		if (!$abs && preg_match('/^http(s)?\:\/\//', $loc)) $abs = TRUE;
		if (!$abs) {
			if ($loc{0} != '/') $loc = $K->SITE_URL.$loc;
		}
		echo '<meta http-equiv="refresh" content="0;url='.$loc.'" />';
		echo '<script type="text/javascript"> top.location = "'.$loc.'"; </script>';
		exit;
	}
    
    public function set_lasturl($url='')
    {
        if( ! empty($url) ) {
            $_SESSION['LAST_URL'] = $url;
        }
        else {
            $_SESSION['LAST_URL'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        }
        $_SESSION['LAST_URL'] = rtrim($_SESSION['LAST_URL'], '/');
    }
    public function get_lasturl()
    {
        return isset($_SESSION['LAST_URL']) ? $_SESSION['LAST_URL'] : '/';
    }

}
?>