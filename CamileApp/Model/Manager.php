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

    /**
     * DELETE request
     * @return mixed
     */
    public function delete()
    {
        $sql = 'DELETE from posts WHERE id=:id';
        return $this->db->request($sql,['id' => $_GET['id']], 'posts');
    }
}