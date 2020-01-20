<?php

define('ROOT', dirname(__DIR__));

require ROOT.'/CamileApp/core/App.php';
use CamileApp\Core\App;

App::getInstance()->router();


