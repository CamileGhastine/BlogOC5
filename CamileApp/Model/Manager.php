<?php


namespace CamileApp\Model;


/**
 * Class Manager
 * @package CamileApp\Model
 */
abstract class Manager
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
}