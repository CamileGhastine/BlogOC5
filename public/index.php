<?php

use CamileApp\Core\App;

session_start();

define('ROOT', dirname(__DIR__));
require ROOT.'/vendor/autoload.php';

App::getInstance()->router();




