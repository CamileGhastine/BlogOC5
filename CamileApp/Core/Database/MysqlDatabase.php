<?php


namespace CamileApp\Core\Database;

use \PDO;
use CamileApp\Core\App;

/**
 * Class MysqlDatabase
 * @package CamileApp\Core\Database
 */
class MysqlDatabase extends Database
{
    /**
     * @var DBconnection
     */
    private $db;

    /**
     * @return $db
     */
    public function getDB()
    {
        if ($this->db === null)
        {
            $this->getConnection();
        }
        return $this->db;
    }

    /**
     * @return PDO PDO connection to DB
     */
    private function getConnection()
    {
        try
        {
            $this->db = new PDO('mysql:host=localhost;dbname=projet5OC;charset=utf8', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->db;
        }
        catch (Exception $e)
        {
            App::getInstance()->error('connection');
        }
    }
}