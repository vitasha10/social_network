<?php
/*Vitasha
* my@vitasha.tk
* vk.com/vitasha123
*/
$SCRIPT_START_TIME	= microtime(TRUE);
$K = new stdClass;    
$K->VERSION = '1.2.7';    
$K->INCPATH = dirname(__FILE__).'/';
chdir( $K->INCPATH );

//The URL must end with a slash at the end.
$K->SITE_URL = 'https://blat.tk/';

/*______________________________________________________*/
/*______________________________________________________*/  

$K->DB_HOST = 'localhost';
$K->DB_USER = 'blat_tk_usr';
$K->DB_PASS = 'Hack8908';
$K->DB_NAME = 'blat_tk';
$K->DB_MYEXT = 'mysqli';

/*______________________________________________________*/
/*______________________________________________________*/  

$K->STORAGE_URL = $K->SITE_URL.'data/';
$K->STORAGE_DIR = $K->INCPATH.'../data/';

// Temporary folder
$K->STORAGE_URL_TMP = $K->STORAGE_URL.'tmp/';
$K->STORAGE_DIR_TMP = $K->STORAGE_DIR.'tmp/';

// Albums of users
$K->STORAGE_URL_ALBUMS_USERS = $K->STORAGE_URL.'albums/users/';
$K->STORAGE_DIR_ALBUMS_USERS = $K->STORAGE_DIR.'albums/users/';

// Albums of groups
$K->STORAGE_URL_ALBUMS_GROUPS = $K->STORAGE_URL.'albums/groups/';
$K->STORAGE_DIR_ALBUMS_GROUPS = $K->STORAGE_DIR.'albums/groups/';

// Albums of pages
$K->STORAGE_URL_ALBUMS_PAGES = $K->STORAGE_URL.'albums/pages/';
$K->STORAGE_DIR_ALBUMS_PAGES = $K->STORAGE_DIR.'albums/pages/';

// Albums of events
$K->STORAGE_URL_ALBUMS_EVENTS = $K->STORAGE_URL.'albums/events/';
$K->STORAGE_DIR_ALBUMS_EVENTS = $K->STORAGE_DIR.'albums/events/';

$K->STORAGE_URL_PHOTOS = $K->STORAGE_URL.'photos/';
$K->STORAGE_DIR_PHOTOS = $K->STORAGE_DIR.'photos/';
$K->FILE_SIZE_PHOTO = 10 * 1024 * 1024; // 5 MB;

$K->STORAGE_URL_VIDEOS = $K->STORAGE_URL.'videos/';
$K->STORAGE_DIR_VIDEOS = $K->STORAGE_DIR.'videos/';
$K->FILE_SIZE_VIDEO = 30 * 1024 * 1024; // 5 MB;
$K->EXTENSIONS_VIDEOS = 'mp4, mov, webm';

$K->STORAGE_URL_AUDIOS = $K->STORAGE_URL.'audios/';
$K->STORAGE_DIR_AUDIOS = $K->STORAGE_DIR.'audios/';
$K->FILE_SIZE_AUDIO = 10 * 1024 * 1024; // 5 MB;
$K->EXTENSIONS_AUDIOS = 'mp3, wav';

$K->SIZE_IMAGEN_COVER = 5 * 1024 * 1024; // 5 MB;
$K->SIZE_IMAGEN_AVATAR = 2 * 1024 * 1024; // 2 MB;

$K->STORAGE_URL_AVATARS = $K->STORAGE_URL.'avatars/';
$K->STORAGE_DIR_AVATARS = $K->STORAGE_DIR.'avatars/';
$K->DEFAULT_AVATAR_USER = 'default.jpg';

$K->STORAGE_URL_COVERS = $K->STORAGE_URL.'covers/';
$K->STORAGE_DIR_COVERS = $K->STORAGE_DIR.'covers/';

$K->STORAGE_URL_AVATARS_PAGE = $K->STORAGE_URL.'avatars_pages/';
$K->STORAGE_DIR_AVATARS_PAGE = $K->STORAGE_DIR.'avatars_pages/';
$K->DEFAULT_AVATAR_PAGE = 'default.jpg';

$K->STORAGE_URL_COVERS_PAGE = $K->STORAGE_URL.'covers_pages/';
$K->STORAGE_DIR_COVERS_PAGE = $K->STORAGE_DIR.'covers_pages/';

$K->STORAGE_URL_COVERS_GROUP = $K->STORAGE_URL.'covers_groups/';
$K->STORAGE_DIR_COVERS_GROUP = $K->STORAGE_DIR.'covers_groups/';

$K->STORAGE_URL_COVERS_EVENT = $K->STORAGE_URL.'covers_events/';
$K->STORAGE_DIR_COVERS_EVENT = $K->STORAGE_DIR.'covers_events/';

$K->STORAGE_URL_PHOTOS_MESSAGES = $K->STORAGE_URL.'messages/photos/';
$K->STORAGE_DIR_PHOTOS_MESSAGES = $K->STORAGE_DIR.'messages/photos/';
$K->FILE_SIZE_PHOTO_MESSAGES = 10 * 1024 * 1024; // 2 MB;

$K->STORAGE_URL_ATTACH_MESSAGES = $K->STORAGE_URL.'messages/files/';
$K->STORAGE_DIR_ATTACH_MESSAGES = $K->STORAGE_DIR.'messages/files/';
$K->FILE_SIZE_ATTACH_MESSAGES = 30 * 1024 * 1024; // 2 MB;

$K->STORAGE_URL_ARTICLES = $K->STORAGE_URL.'articles/';
$K->STORAGE_DIR_ARTICLES = $K->STORAGE_DIR.'articles/';
$K->FILE_SIZE_PHOTO_ARTICLES = 10 * 1024 * 1024; // 5 MB;
$K->WIDTH_PHOTO_ARTICLE_1 = 620;
$K->WIDTH_PHOTO_ARTICLE_2 = 300;

$K->STORAGE_URL_PRODUCTS = $K->STORAGE_URL.'products/';
$K->STORAGE_DIR_PRODUCTS = $K->STORAGE_DIR.'products/';
$K->FILE_SIZE_PHOTO_PRODUCTS = 10 * 1024 * 1024; // 5 MB;
$K->WIDTH_PHOTO_PRODUCT_1 = 620;
$K->WIDTH_PHOTO_PRODUCT_2 = 300;

$K->STORAGE_URL_ADS_BASIC = $K->STORAGE_URL.'adsbasic/';
$K->STORAGE_DIR_ADS_BASIC = $K->STORAGE_DIR.'adsbasic/';
$K->FILE_SIZE_PHOTO_ADS_BASIC = 5 * 1024 * 1024; // 5 MB;

$K->STORAGE_URL_GAMES = $K->STORAGE_URL.'games/';
$K->STORAGE_DIR_GAMES = $K->STORAGE_DIR.'games/';
$K->FILE_SIZE_THUMBNAIL_GAMES = 1 * 1024 * 1024; // 1 MB;


$K->BAD_EXT_FILES = '';//'exe,html,js,php,php3,php4,phtml,pl,py,jsp,asp,htm,shtml,sh,cgi,dll,dat,app,cpp,c,obj';

$K->NUM_CHARS_NAME_FILE = 100;//35;

/*______________________________________________________*/
/*______________________________________________________*/

$K->DEBUG_USERS = array('::1');
$K->DEBUG_MODE = in_array($_SERVER['REMOTE_ADDR'], $K->DEBUG_USERS);
$K->DEBUG_CONSOLE = TRUE;
if ( $K->DEBUG_MODE ) {
    ini_set( 'error_reporting', E_ALL | E_STRICT );
    ini_set( 'display_errors', 1 );
}

/*______________________________________________________*/
/*______________________________________________________*/

/**********************************/
/* Version 1.1.7 */

$K->STORAGE_URL_APPS = $K->STORAGE_URL.'apps/';
$K->STORAGE_DIR_APPS = $K->STORAGE_DIR.'apps/';
$K->STORAGE_FOLDER_APPS = 'data/apps/';
$K->FILE_SIZE_APPS = 5 * 1024 * 1024; // 5 MB;
$K->NAME_FILE_APK = 'appAndroid.apk';


/* End Version 1.1.7 */
/**********************************/
    
?>