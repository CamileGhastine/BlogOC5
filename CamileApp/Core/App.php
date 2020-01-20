<?php


namespace CamileApp\Core;

use CamileApp\Controller\ErrorController;
use CamileApp\Core\Database\MysqlDatabase;

class App
{
    private static $appInstance;
    private $router;
    private $manager;
    private $db;

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
        if($this->db === null)
        {
            $db = new MysqlDatabase();
            $this->db = $db->getDB();
            return $this->db;
        }
        return $this->db;
    }

    public function getManager($managerType)
    {
        $manager = 'CamileApp\\Model\\'.ucfirst($managerType).'Manager';
        return $this->manager = new $manager($this->getDB());
    }
}