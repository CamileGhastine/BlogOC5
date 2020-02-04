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

    /**
     * Instance of App
     * @return App
     */
    public static function getInstance()
    {
        if(self::$appInstance === null)
        {
            self::$appInstance = new App();
            return self::$appInstance;
        }
        return self::$appInstance;
    }

    /**
     * Instance of router
     * @throws \Exception
     */
    public function router()
    {
        if($this->router === null)
        {
            $this->router = new Router();
        }
        $this->router->run();
    }

    /**
     * Instance of error
     * to call the page depending on the type of error
     * @param $errorType
     */
    public function error($errorType)
    {
        if($this->error === null)
        {
            $this->error = new ErrorController();
        }
        $this->error->getErrorMessage($errorType);
    }

    /**
     * Instance of MysqlDatabase
     * @return MysqlDatabase
     */
    public function getDB()
    {
        if($this->db === null)
        {
            require ROOT . '/Config/Config.php';
            $this->db = new MysqlDatabase(Config::configDB());
        }
        return $this->db;
    }

    /**
     * Instance of manger
     * @param $managerType
     * @return mixed
     */
    public function getManager($managerType)
    {
        $manager = 'CamileApp\\Model\\' . ucfirst($managerType) . 'Manager';
        return new $manager($this->getDB());
    }

    /**
     * Instance of ValidationForm
     * @param $validationType
     * @return mixed
     */
    public function getValidationForm($validationType)
    {
        $validation = 'CamileApp\\Core\\Constraints\\ValidationForm\\' . ucfirst($validationType) . 'ValidationForm';
        return new $validation();
    }

    /**
     * Instance of Password
     * @return Password
     */
    public function getPassword()
    {
        return new Password();
    }

    /**
     * Return number of try before blok account
     * @return mixed
     */
    public function hijacking()
    {
        return Hijacking::getTry();
    }

}