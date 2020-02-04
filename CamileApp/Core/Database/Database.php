<?php


namespace CamileApp\Core\Database;


/**
 * Class Database
 * @package CamileApp\Core\Database
 */
abstract class Database
{
    protected $db_host;
    protected $db_name;
    protected $db_user;
    protected $db_pass;

    public function __construct($config)
    {
        $this->db_host = $config['db_host'];
        $this->db_name = $config['db_name'];
        $this->db_user = $config['db_user'];
        $this->db_pass = $config['db_pass'];
    }


}