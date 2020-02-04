<?php

use CamileApp\Core\App;

session_start();

define('ROOT', dirname(__DIR__));
require ROOT.'/vendor/autoload.php';

App::getInstance()->router();

try
{
    $a = new PDO('mysql:host=localhost;dbname=ghasxuup_projet5oc;charset=utf8','ghasxuup_test', 't(q17:q)%yt_&0I=fZ');
    echo 'connexion ok';
}
catch (Exception $e)
{
    echo $e->getMessage();
}




