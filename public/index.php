<?php
define('ROOT', dirname(__DIR__));
require ROOT.'/CamileApp/core/Router.php';
use CamileApp\Core\Router;
use CamileApp\Core\App;

$router = new Router();
$router->run();
