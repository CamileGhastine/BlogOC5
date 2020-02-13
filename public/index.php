<?php

use CamileApp\Core\App;
//
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

session_start();

define('ROOT', dirname(__DIR__));
require ROOT.'/vendor/autoload.php';

App::getInstance()->router();




