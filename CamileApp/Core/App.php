<?php


namespace CamileApp\Core;

use CamileApp\Controller\ErrorController;
use CamileApp\Core\Database\MysqlDatabase;
use Config\Config;
use CamileApp\Core\Password\Password;
use CamileApp\Core\Constraints\Hijacking;

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
        if(self::$appInstance === null)
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
        $this->error->getErrorMessaage($errorType);
    }

    public function getDB()
    {
        if($this->db === null)
        {
            require ROOT.'/Config/Config.php';
            $this->db = new MysqlDatabase(Config::configDB());
        }
        return $this->db;
    }

    public function getManager($managerType)
    {
        $manager = 'CamileApp\\Model\\' . ucfirst($managerType) . 'Manager';
        return new $manager($this->getDB());
    }

    public function getValidationForm($validationType)
    {
        $validation =  'CamileApp\\Core\\Constraints\\' . ucfirst($validationType) . 'ValidationForm';
        return new $validation();
    }

    public function getPassword()
    {
        return new Password();
    }

    public function hijacking()
    {
        return Hijacking::getTry();
    }

}