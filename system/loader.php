<?php
/*Vitasha
* my@vitasha.tk
* vk.com/vitasha123
*/
ini_set('upload_max_filesize', '100M');
chdir(dirname(__FILE__)); //wait what????

require_once('helpers/functions.php');
require_once('config.php');

session_start();

$db1 = new mysql($K->DB_HOST, $K->DB_USER, $K->DB_PASS, $K->DB_NAME);
$db2 = &$db1;

$network = new network();
$network->load();

if (function_exists('date_default_timezone_set')) date_default_timezone_set($K->TIMEZONE);

$user = new user();
$user->load();

$page = new page();
$page->load();
?>