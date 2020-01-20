<?php


namespace CamileApp\Core\Database;

use \PDO;
use CamileApp\Core\App;

class MysqlDatabase extends Database
{
    private $db;

    public function getDB()
    {
        if ($this->db === null)
        {
            $this->getConnection();
        }
        return $this->db;
    }

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
            App::getInstance()->Error('Connection');
        }
    }
}