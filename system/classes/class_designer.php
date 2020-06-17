<?php
class designer
{
    public function createBlockMenuLeft($title_block, $menu_items, $with_separator = FALSE, $add_name_var = '')
    {
        global $D;
        
        if (!is_array($menu_items)) return '';

        $html_block = '<div>';
        if (!empty($title_block)) {
            $html_block .= '<div class="titleseparator">'.$title_block.'</div>';
        }

        foreach ($menu_items as $item) {
            $html_block .= $this->createOptionMenuLeft($item);
        }        
        
        $html_block .= !empty($add_name_var)? '{%'.$add_name_var.'%}' : '';
        
        if ($with_separator) {
            $html_block .= $this->insertSeparatorMenuLeft();
            $D->_MENU_LEFT_WITH_SEPARATOR_BOTTOM = TRUE;
        }
        
        $html_block .= '</div>';
        
        return $html_block;        
    }
    
    public function createOptionMenuLeft($item)
    {
        global $K;
        
        $the_option = '<div id="'.$item['id_option'].'" title="'.$item['tag_title'].'">
                <a href="'.$K->SITE_URL.$item['url'].'" rel="'.$item['rel'].'" target="'.$item['target'].'">
                <div class="opc-menu-left '.($item['active'] ? "active" : "").'">
                    <div id="'.$item['id_icono'].'" class="ico-mini"><img src="'.getImageTheme($item['icono']).'"></div>
                    <div class="txt-opc ellipsis">'.$item['text_option'].'</div>';
                    
        $the_option .= (isset($item['id_notification']) && isset($item['num_notifications'])) ? '<div id="'.$item['id_notification'].'" class="txt-notif">'.$item['num_notifications'].'</div>' : '';
        $the_option .= '<div class="clear"></div>
                </div>
                </a></div>';

        return $the_option;
    }


    public function createCardUserMenuLeft($info)
    {
        global $K;

        $the_card = '<a href="'.$K->SITE_URL.$info['username'].'" rel="'.$info['rel'].'" target="'.$info['target'].'" title="'.$info['tag_title'].'">
                    <div id="left-infouser">
                        <div id="avatar"><img src="'.$info['avatar'].'"></div>
                        <div id="username" class="ellipsis">'.$info['firstname'].'</div>
                        <div class="clear"></div>
                    </div>
                    </a>';


        return $the_card;
    }
    
    public function insertSeparatorMenuLeft()
    {
        return '<div class="separatorm "></div>';
    }

    /*=================================================================================*/

    public function createMenuActivity($menu_items)
    {
        global $D;
        
        if (!is_array($menu_items)) return '';

        $html_block = '<div>';

        foreach ($menu_items as $item) {
            $html_block .= $this->createOptionMenuActivity($item);
        }
        
        $html_block .= '</div>';
        
        return $html_block;        
    }

    public function createOptionMenuActivity($item)
    {
        global $K;
		
		if (isset($item['status']) && $item['status'] == 'hide') $cadstatus = 'style="display:none;"';
		else $cadstatus = '';
        
        $the_option = '<div id="'.$item['id_option'].'" '.$cadstatus.'>';
        $the_option .= (isset($item['url']) && !empty($item['url'])) ? '<a href="'.$K->SITE_URL.$item['url'].'" rel="'.$item['rel'].'" target="'.$item['target'].'">' : '';
        $the_option .= '<div class="opc-menu-activity">'.$item['text_option'].'</div>';
        $the_option .= (isset($item['url']) && !empty($item['url'])) ? '</a>' : '';
        $the_option .= '</div>';

        return $the_option;
    }

    /*=================================================================================*/

    public function createMenuTopBasic($menu_items)
    {
        global $D;
        
        if (!is_array($menu_items)) return '';

        $html_block = '<div id="options-top-basic">';

        foreach ($menu_items as $item) {
            $html_block .= $this->createOptionMenuTopBasic($item);
        }
        
        $html_block .= '<div class="clear"></div></div>';
        
        return $html_block;        
    }

    public function createOptionMenuTopBasic($item)
    {
        global $K;
        
        $the_option = '<div id="'.$item['id_option'].'" class="opc-menu-top-basic">';
        
        $the_option .= (isset($item['url']) && !empty($item['url'])) ? '<a href="'.$K->SITE_URL.$item['url'].'" rel="'.$item['rel'].'" target="'.$item['target'].'">' : '';
        $the_option .= $item['text_option'];
        $the_option .= (isset($item['url']) && !empty($item['url'])) ? '</a>' : '';
        $the_option .= '</div>';

        return $the_option;
    }
    
    /*=================================================================================*/


    public function createBlockMenuTop($menu_items, $with_mini_user = FALSE)
    {
        global $D;
        
        if (!is_array($menu_items)) return '';

        $html_block = '<div id="options_top">';
        
        if ($with_mini_user) $html_block .= $this->createMiniUserTop();

        foreach ($menu_items as $item) {
            $html_block .= $this->createOptionMenuTop($item);
        }
        
        $html_block .= '<div class="clear"></div></div>';
        
        return $html_block;        
    }

    public function createMiniUserTop()
    {
        global $D, $K;
        global $user;
        
        if (!$D->_IS_LOGGED) $the_mini_html = '';
        else {
            $the_avatar_user = $user->getAvatar(1);
            $the_name_user = stripslashes($user->info->firstname);
            $the_username = $user->info->user_username;
            $the_mini_html = '
            <a href="'.$K->SITE_URL.$the_username.'" rel="phantom-all" target="dashboard-main-area">
            <div class="ico-top nonspaceright" id="opt-user-top">
                <div class="opt-user">
                    <div class="the_avatar"><img src="'.$the_avatar_user.'"></div>
                    <div class="the_name">'.$the_name_user.'</div>
                    <div class="clear"></div>
                </div>
            </div>
            </a>';
        }
        
        return $the_mini_html;
    }
    
    public function createOptionMenuTop($item)
    {
        global $K;

        $the_option = '<div id="'.$item['id_option'].'" class="ico-top luminity"><span title="'.$item['tag_title'].'">';
        
        if (isset($item['url']) && !empty($item['url'])) {
            $the_option .= '<a href="'.$K->SITE_URL.$item['url'].'" rel="'.$item['rel'].'" target="'.$item['target'].'"><img src="'.getImageTheme($item['icono']).'"></a>';
        } else {
            $the_option .= '<img src="'.getImageTheme($item['icono']).'">';
        }
        $the_option .= '</span>';
        
        if (isset($item['id_notification'])) {
            $the_option .= '<span id="'.$item['id_notification'].'" class="count-notif"><span class="count-notif-value">'.$item['value_notification'].'</span></span>';
        }
        
        $the_option .= '</div>';

        return $the_option;
    }

    
    /*=================================================================================*/
    

    public function createMenuMore($menu_items)
    {
        global $D;
        
        if (!is_array($menu_items)) return '';

        $html_block = '';

        foreach ($menu_items as $item) {
            $html_block .= $this->createOptionMenuMore($item);
        }        
        
        return $html_block;        
    }

    public function createOptionMenuMore($item)
    {
        global $K;
        
        $the_option = '<div id="'.$item['id_option'].'">';
        $the_option .= (isset($item['url']) && !empty($item['url'])) ? '<a href="'.$K->SITE_URL.$item['url'].'" rel="'.$item['rel'].'" target="'.$item['target'].'">' : '';
        $the_option .= '<div class="optionsMenu">'.$item['text_option'].'</div>';
        $the_option .= (isset($item['url']) && !empty($item['url'])) ? '</a>' : '';
        $the_option .= '</div>';

        return $the_option;
    }


    /*=================================================================================*/

    public function createBlockMenuLeftAdmin($menu_items, $with_separator = FALSE)
    {
        global $D;
        
        if (!is_array($menu_items)) return '';

        $html_block = '<div>';

        foreach ($menu_items as $item) {
            $html_block .= $this->createOptionMenuLeftAdmin($item);
        }
        
        if ($with_separator) $html_block .= $this->insertSeparatorMenuLeftAdmin();
        
        $html_block .= '</div>';
        
        return $html_block;        
    }
    
    public function createOptionMenuLeftAdmin($item)
    {
        global $K;
        
        $the_option = '<div id="'.$item['id_option'].'" title="'.$item['tag_title'].'">
                <a href="'.$K->SITE_URL.$item['url'].'" rel="'.$item['rel'].'" target="'.$item['target'].'">
                <div class="opc-menu-left '.($item['active'] ? "active" : "").'">
                    <div id="'.$item['id_icono'].'" class="ico-mini"><img src="'.getImageTheme($item['icono']).'"></div>
                    <div class="txt-opc ellipsis">'.$item['text_option'].'</div>';
                    
        $the_option .= (isset($item['id_notification']) && isset($item['num_notifications'])) ? '<div id="'.$item['id_notification'].'" class="txt-notif">'.$item['num_notifications'].'</div>' : '';
        $the_option .= '<div class="clear"></div>
                </div>
                </a></div>';

        return $the_option;
    }

    public function insertSeparatorMenuLeftAdmin()
    {
        return '<div class="separatorm "></div>';
    }
    
    public function createTitleMenuAdmin($info)
    {
        global $K;

        $the_title = '<div style="text-align:center; font-weight:bold; font-size:14px; padding:4px 0 10px;" class="ellipsis">'.$info['title'].'</div>';
        $the_title .= '<div class="separatorm "></div>';

        return $the_title;
    }

    /*=================================================================================*/

    public function createBlockMenuLeftSetting($menu_items, $with_separator = FALSE)
    {
        global $D;
        
        if (!is_array($menu_items)) return '';

        $html_block = '<div>';

        foreach ($menu_items as $item) {
            $html_block .= $this->createOptionMenuLeftSetting($item);
        }
        
        if ($with_separator) $html_block .= $this->insertSeparatorMenuLeftSetting();
        
        $html_block .= '</div>';
        
        return $html_block;        
    }
    
    public function createOptionMenuLeftSetting($item)
    {
        global $K;
        
        $the_option = '<div id="'.$item['id_option'].'" title="'.$item['tag_title'].'">
                <a href="'.$K->SITE_URL.$item['url'].'" rel="'.$item['rel'].'" target="'.$item['target'].'">
                <div class="opc-menu-left '.($item['active'] ? "active" : "").'">
                    <div id="'.$item['id_icono'].'" class="ico-mini"><img src="'.getImageTheme($item['icono']).'"></div>
                    <div class="txt-opc ellipsis">'.$item['text_option'].'</div>';

        $the_option .= '<div class="clear"></div>
                </div>
                </a></div>';

        return $the_option;
    }

    public function insertSeparatorMenuLeftSetting()
    {
        return '<div class="separatorm "></div>';
    }
    
    public function createTitleMenuSetting($info)
    {
        global $K;

        $the_title = '<div id="bar-title" class="ellipsis">'.$info['title'].'</div>';
        $the_title .= '<div class="separatorm "></div>';

        return $the_title;
    }

    /*=================================================================================*/
    
    public function getMetaData()
    {
        global $K;
        $html = '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'."\n";
        $html .= '    <meta name="keywords" content="'.$K->SITE_TITLE.', '.$K->SEO_KEYWORDS .'">'."\n";
        $html .= '    <meta name="description" content="'.$K->SITE_TITLE.', '.$K->SEO_DESCRIPTION .'">'."\n";
        $html .= '    <meta name="author" content="'.$K->COMPANY.'">'."\n";

        return $html;
    }
    
    /*=================================================================================*/
    
    public function loadJSData()
    {
        global $K;
        
        $html = '';
        $html .= '    <script type="text/javascript"> var _SITE_URL = "'. $K->SITE_URL .'"; </script>'."\n";
        $html .= '    <script type="text/javascript"> var _STORAGE_URL = "'. $K->STORAGE_URL .'"; </script>'."\n";
        $html .= '    <script type="text/javascript"> var _THEME = "'. $K->THEME .'"; </script>'."\n";
        $files_location = $K->SITE_URL.'themes/'.$K->THEME.'/js/';
        
        foreach ($this->base_files as $f) {
            $html .= '    <script type="text/javascript" src="'.$files_location.$f.'.js?v='.$K->VERSION.'"></script>'."\n";
        }
        
        foreach ($this->base_string_js as $stringjs) {
            $html .= '    <script type="text/javascript">'.$stringjs.'</script>'."\n";
        }
    
        return $html;
    }
    
    /*=================================================================================*/
    
    public function loadCSSData()
    {
        global $K;
        
        $html = '';
        $files_location = $K->SITE_URL.'themes/'.$K->THEME.'/css/';
        
        foreach ($this->base_files as $f ) {
            $html .= '    <link href="'. $files_location . $f .'.css?v='. $K->VERSION .'" type="text/css" rel="stylesheet" media="all" />'."\n";
        }

        return $html;
    }
    
    /*=================================================================================*/
    
    public function loadLogo()
    {
        global $K, $D;
        $the_logo = '';
        if ($D->_IS_LOGGED) {
            $the_logo .= '<a href="'. $K->SITE_URL .'dashboard" title="'. htmlspecialchars($K->SITE_TITLE) .'" rel="phantom-max" target="dashboard-main-area">';
            $the_logo .= '<div id="logo"><span id="logo-normal"><img src="'. getImageTheme('logo.png') .'"></span><span id="logo-mini"><span id="for-menu-resp"><img src="'. getImageTheme('top-moredash.png') .'"></span></span></div>';
        } else {
            $the_logo .= '<a href="'. $K->SITE_URL .'" title="'. htmlspecialchars($K->SITE_TITLE) .'">';
            $the_logo .= '<div id="logo"><span id="logo-normal"><img src="'. getImageTheme('logo.png') .'"></span><span id="logo-mini"><img src="'. getImageTheme('logo-mini.png') .'"></span></div>';
        }
        $the_logo .= '</a>';
        return $the_logo;
    }
    
    /*=================================================================================*/
    
    public function loadFavicon()
    {
        global $K;
        $the_favicon = '    <link href="'. getImageTheme('favicon.ico') .'" rel="shortcut icon" />'."\n";
        return $the_favicon;
    }
    
    /*=================================================================================*/
        
    public function getJSData($js_nologin = array(), $js_login = array())
    {
        global $D;
        
        if ($D->_IS_LOGGED) {
            $this->base_files = $js_login;
        } else {
            $this->base_files = $js_nologin;
        }

        if (isset($D->base_files_js) && is_array($D->base_files_js)) {
            foreach ($D->base_files_js as $onejs) {
                $this->base_files[] = $onejs;
            }
        }
        
        $this->base_string_js = array();

        if (isset($D->string_js) && is_array($D->string_js)) {
            foreach ($D->string_js as $onecadjs) {
                $this->base_string_js[] = $onecadjs;
            }
        }
        
        return $this->loadJSData();
    }
    
    /*=================================================================================*/
    
    public function getCSSData($css_nologin = array(), $css_login = array())
    {
        global $D;
        
        if ($D->_IS_LOGGED) {
            $this->base_files = $css_login;
        } else {
            $this->base_files = $css_nologin;
        }

        if (isset($D->base_files_css) && is_array($D->base_files_css)) {
            foreach ($D->base_files_css as $onecss) {
                $this->base_files[] = $onecss;
            }
        }
    
        return $this->loadCSSData();
    }
    
    /*=================================================================================*/
    
    public function boxAlert($title, $text, $txtbclose, $closebtn=TRUE)
    {
        $html = '<div id="box_alert"><div id="inside_box_alert"><div class="box_title"><div id="space_title">'.$title.'</div>';
        if ($closebtn) $html .= '<div id="space_close">X</div>';
        $html .= '<div class="clear"></div></div><div class="box_msg">'.$text.'</div><div id="box_bottom"><span id="bclose_alert">'.$txtbclose.'</span></div></div></div>';
        return $html;
    }

    /*=================================================================================*/

    public function boxConfirm($title, $text, $txtconfirm, $txtcancel, $closebtn=TRUE)
    {
        $html = '<div id="box_confirm"><div id="inside_box_confirm"><div class="box_title"><div id="space_title">'.$title.'</div>';
        if ($closebtn) $html .= '<div id="space_close">X</div>';
        $html .= '<div class="clear"></div></div><div class="box_msg">'.$text.'</div><div id="box_bottom"><span id="b_cancel">'.$txtcancel.'</span><span id="b_ok">'.$txtconfirm.'</span></div></div></div>';
        return $html;
    }
    
    /*=================================================================================*/
        
    public function getStringJS($namejs)
    {
        global $K;
        $stringJS = '<script type="text/javascript" src="'.$K->SITE_URL.'themes/'.$K->THEME.'/js/'.$namejs.'.js?v='.$K->VERSION.'"></script>'."\n";
        return $stringJS;
    }

    /*=================================================================================*/

}
?>