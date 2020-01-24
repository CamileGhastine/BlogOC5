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
     * @return mixed
     */
    public function all()
    {
        $sql = 'SELECT * FROM categories';
        return $this->db->query($sql);
    }

}