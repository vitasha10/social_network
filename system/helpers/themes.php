<?php
function get_available_themes() {
    global $K;
    $data	= array();
    $path	= $K->INCPATH.'../themes/';
    $tmp	= opendir($path);
    while($f = readdir($tmp)) {
        if( $f == '.' || $f == '..' ) {
            continue;
        }
        $theme_code	= $f;
        $theme_path	= $path.$f.'/';
        if( ! is_dir($theme_path) ) {
            continue;
        }
        $theme_metafile	= $theme_path.'theme.php';
        if( ! file_exists($theme_metafile) ) {
            continue;
        }
        $current_theme	= FALSE;
        include($theme_metafile);
        if( !$current_theme || !is_object($current_theme) || !isset($current_theme->name) || empty($current_theme->name) ) {
            continue;
        }
        $theme_name	= trim($current_theme->name);

        $data[$theme_code]	= $current_theme;
    }
    closedir($tmp);
    asort($data);
    return $data;
}
?>