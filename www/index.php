<?php
error_reporting(E_ALL);

$url = strtolower($_SERVER['REQUEST_URI']);
$url = explode('?', $url);
$url = trim($url[0], '/');
if(!preg_match('|^[a-z0-9\.\-\_]+$|i', $_SERVER['HTTP_HOST'])){
	exit('IP SAVED');
}

if(!preg_match('|^[a-z0-9_\.\?\&\=/\-\%]+$|i', $_SERVER['REQUEST_URI'])){
	exit('IP SAVED');
}

define('BASE_PATH', realpath(dirname(__FILE__).'/..'));
define('INDEX_PATH', BASE_PATH.'/App/index');
define('ADMIN_PATH', BASE_PATH.'/App/admin');
define('MODELS_PATH', realpath(BASE_PATH.'/App/models'));

spl_autoload_register(function($className){//Автоподключим классы
    $tmp = explode('\\', $className);
    $classPath = realpath(BASE_PATH.DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, $tmp).'.php');
    if( $classPath)
        if( file_exists($classPath)) {
            require_once($classPath);
        }
});

require_once(BASE_PATH.'/App/config.php');
require_once(BASE_PATH.'/App/core/DB.php');
require_once(BASE_PATH.'/smarty/Smarty.class.php');

require_once(BASE_PATH.'/App/core/Routes.php');
$routes = [];
require_once(BASE_PATH.'/App/routes.php');
foreach( $routes as $routeUrl => $route )
    \App\Core\Routes::getInstance()->addRoute($routeUrl, $route[0], $route[1], isset( $route[2] ) ? $route[2] : []);
\App\Core\Routes::getInstance()->loadRoute($url);

\App\Core\View::display();