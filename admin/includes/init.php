<?php
// /opt/lampp/htdocs/oop_project/oop_project

// defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
// define('SITE_ROOT', DS . 'opt' . DS . 'lampp' . DS . 'htdocs' . DS . 'oop_project' . DS . 'gallery');
// // define('SITE_ROOT', 'images' . DS);
// define('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');
//
// require_once("functions.php");
// require_once("new_config.php");
// require_once("database.php");
// require_once("db_object.php");
// require_once("user.php");
// require_once("photo.php");
// require_once("session.php");

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', __DIR__ . DS . '..' . DS . '..');
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');

require_once(INCLUDES_PATH.DS."functions.php");
require_once(INCLUDES_PATH.DS."new_config.php");
require_once(INCLUDES_PATH.DS."database.php");
require_once(INCLUDES_PATH.DS."db_object.php");
require_once(INCLUDES_PATH.DS."user.php");
require_once(__DIR__ . DS . "photo.php");
require_once(INCLUDES_PATH.DS."comment.php");
require_once(INCLUDES_PATH.DS."session.php");
require_once(INCLUDES_PATH.DS."paginate.php");


?>
