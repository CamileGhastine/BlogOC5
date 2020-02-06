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
    public function delete($id)
    {
        $sql = 'DELETE from ' . $this->table . ' WHERE id=:id';
        return $this->db->request($sql, ['id' => $id]);
    }

    /**
     * get all $table order by $attribut
     * @param $table
     * @param $attribut
     */
    public function all($table, $attribut)
    {
        $sql = 'SELECT * FROM ' . $table . ' ORDER BY ' . $attribut;
        return $this->db->request($sql, null, $table, true);
    }
}