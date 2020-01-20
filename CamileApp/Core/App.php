<?php


namespace CamileApp\Core;

require ROOT.'/CamileApp/core/Router.php';

use CamileApp\Core\Router;


class App
{
    private static $appInstance;
    private $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    public static function getInstance()
    {
        if (self::$appInstance === null)
        {
            self::$appInstance = new App();
            return self::$appInstance;
        }
        return self::$appInstance;
    }

    public function router()
    {
        $this->router->run();
    }
}