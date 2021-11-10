<?php
declare(strict_types=1);

if(!isset($_SESSION)){
    session_start();
}

if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}


require_once("src/Utils/debug.php");
require_once("src/Utils/escape.php");
require_once("src/Utils/addLog.php");
require_once("vendor/autoload.php");

spl_autoload_register(function(string $classNamespace){
    $path = str_replace(['\\'], ['/'],  $classNamespace);
    $path = "$path.php";
    require_once($path);
});

use src\Utils\Request;
use src\Controller\PortfolioController;

//dump($_SESSION);

try {
    $params = new Request($_GET,$_POST,$_SERVER, $_COOKIE, $_SESSION ?? []);
    new PortfolioController($params);
}
catch (Exception $e){
    dump($e);
}