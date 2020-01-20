<?php


namespace CamileApp\Model;


abstract class Manager
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
}