<?php

use CamileApp\Core\App;

define('ROOT', dirname(__DIR__));

require ROOT.'/vendor/autoload.php';

App::getInstance()->router();


