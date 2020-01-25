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
    private $PDO;
    private $host;
    private $db_name;
    private $db_user;
    private $db_pass;

    public function __construct()
    {
        $this->db_host = 'localhost' ;
        $this->db_name = 'projet5oc';
        $this->db_user = 'root';
        $this->db_pass = '';
    }

    /**
     * @return DBconnection|PDO|null
     */
    public function getPDO()
    {
        if ($this->PDO === null)
        {
            try
            {
                $this->PDO = new PDO('mysql:host='.$this->db_host.';'.'dbname='.$this->db_name.';charset=utf8', $this->db_user, $this->db_pass);
                $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e)
            {
                App::getInstance()->error('connection');
            }
        }
        return $this->PDO;
    }

    /**
     * @param $sql
     * @param $param
     * @param $table
     * @param $fetchall
     * @return array|mixed
     */
    public function request($sql, $param, $table, $fetchall)
    {
        if($param === null)
        {
            $req = $this->getPDO()->query($sql);
        }
        else
        {
            $req = $this->getPDO()->prepare($sql);
            $req->execute([':id' => $param]);
        }

        $req->setFetchMode(PDO::FETCH_CLASS, 'CamileApp\Model\Entity\\'.$table.'Entity');
        if($fetchall)
        {
            return $req->fetchall();
        }
        else
        {
            return $req->fetch();
        }
    }
}