<?php

function get_available_languages() {
    global $K;
    $data	= array();
    $path	= $K->INCPATH.'languages/';
    $tmp	= opendir($path);
    while($f = readdir($tmp)) {
        if( $f == '.' || $f == '..' ) {
            continue;
        }
        $lang_code	= $f;
        $lang_path	= $path.$f.'/';
        if( ! is_dir($lang_path) ) {
            continue;
        }
        $lang_metafile	= $lang_path.'language.php';
        if( ! file_exists($lang_metafile) ) {
            continue;
        }
        $current_language	= FALSE;
        include($lang_metafile);
        if( !$current_language || !is_object($current_language) || !isset($current_language->name) || empty($current_language->name) ) {
            continue;
        }
        $lang_name	= trim($current_language->name);

        $data[$lang_code]	= $current_language;
    }
    closedir($tmp);
    asort($data);
    return $data;
}

?>