<?php


namespace CamileApp\Core;

use CamileApp\Controller\ErrorController;
use CamileApp\Core\Database\MysqlDatabase;

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

    public function error($errorType)
    {
        $error = new ErrorController();
        $action = 'error'.ucfirst($errorType);
        $error -> $action();
    }

    public function getDB()
    {
        $db = new MysqlDatabase();
        $db->getDB();
    }
}