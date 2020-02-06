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
    protected $PDO;


    /**
     * Instance of PDO
     * @return DBconnection|PDO|null
     */
    public function getPDO()
    {
        if($this->PDO === null)
        {
            try
            {
                $this->PDO = new PDO('mysql:host=' . $this->db_host . ';' . 'dbname=' . $this->db_name . ';charset=utf8', $this->db_user, $this->db_pass);
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
     * function request (query or prepare)
     * @param $sql
     * @param $param
     * @param $table
     * @param $fetchall
     * @return array|mixed
     */
    public function request($sql, $param, $table = null, $fetchall = null)
    {
        if($param === null)
        {
            $req = $this->getPDO()->query($sql);
        }
        else
        {
            $req = $this->getPDO()->prepare($sql);
            $req->execute($param);
        }

        if($fetchall === null)
        {
            return $req;
        }

        if($table != null)
        {
            $req->setFetchMode(PDO::FETCH_CLASS, 'CamileApp\Model\Entity\\' . ucfirst($table) . 'Entity');
        }

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