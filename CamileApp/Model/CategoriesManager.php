<?php


namespace CamileApp\Model;

/**
 * Class CategoriesManager
 * @package CamileApp\Model
 */
class CategoriesManager extends Manager
{
    /**
     * all categories
     * function request($sql, $param, $table, $fetchall)
     * @return mixed
     */
    public function all()
    {
        $sql = 'SELECT * FROM categories';
        return $this->db->request($sql, null, 'categories', true);
    }

}