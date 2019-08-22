<?php
require_once __DIR__.'/../vendor/autoload.php';
//echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$dotenv = Dotenv\Dotenv::create(__DIR__.'/../');
$dotenv->load();

require_once __DIR__.'/../config/ini.php';
require_once __DIR__.'/../config/settings.php';

$vars = require_once __DIR__.'/../config/vars.php';
$routes = require_once __DIR__.'/../config/routes.php'; 

$page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRING);
$page = preg_replace('/[^-a-zA-Z0-9_]/', '', $page);

if(isset($_GET['page']) && in_array($page, $routes)){
	if($page == 'ide'){
		$code = (new App\Core\Code)->findAll('code');
	}
    if($page == 'api'){
        $uri = 'http://localhost/_PROJECTS/ide/public/';
        //$files = (new App\Core\Files)->findAll('file');
    }
    if($page == 'db'){
        $tables = $db->getTableList();
        $fields = $db->getFields();
    }
	include(__DIR__.'/inc/'.$page.".php");
}else {
	include(__DIR__."/404.php");
}

