<?php


namespace CamileApp\Core;

use CamileApp\Controller\ErrorController;
use CamileApp\Core\Database\MysqlDatabase;

/**
 * Class App prevent  dependency injection
 * @package CamileApp\Core
 */
class App
{
    private static $appInstance;
    private $router;
    private $error;
    private $db;

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
        if($this->router === null)
        {
            $this->router = new Router();
        }
        $this->router->run();
    }

    /**
     * to call the page depending on the type of error
     * @param $errorType
     */
    public function error($errorType)
    {
        if($this->error === null)
        {
            $this->error = new ErrorController();
        }

        $action = 'error'.ucfirst($errorType);
        if(method_exists($this->error, $action))
        {
            $this->error->$action();
        }
        else
        {
            $this->error->unclassified($errorType);
        }
    }

    public function getDB()
    {
        if($this->db === null)
        {
            $db = new MysqlDatabase();
            $this->db = $db->getDB();
        }
        return $this->db;
    }

    public function getManager($managerType)
    {
        $manager = 'CamileApp\\Model\\'.ucfirst($managerType).'Manager';
        return new $manager($this->getDB());
    }
}