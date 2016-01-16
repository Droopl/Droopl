<?php
session_start();

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

date_default_timezone_set('America/Phoenix');

define('DS',DIRECTORY_SEPARATOR);
define('WWW_ROOT', dirname(__FILE__).DS);

require_once WWW_ROOT . 'classes' .DS. 'Config.php';
require_once WWW_ROOT . 'classes' .DS. 'DatabasePDO.php';
require_once WWW_ROOT . 'includes' .DS. 'routes.php';


if(empty($_GET['page'])){
	$_GET['page'] = 'feed';
}
if(!isset($_SESSION["user"])){
	if($_GET['page'] != "register"){
		$_GET['page'] = 'login';
	}
}
if(empty($routes[$_GET['page']])){
	header('location:?page=404');
	exit();
}

$route = $routes[$_GET['page']];
$controllerName = $route['controller'] . 'Controller';

require_once WWW_ROOT . 'controller' .DS. $controllerName . '.php';

$controllerObj = new $controllerName();
$controllerObj->route = $route;
$controllerObj->filter();
$controllerObj->render();
