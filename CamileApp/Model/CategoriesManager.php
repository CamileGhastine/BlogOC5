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

    public function categoryById()
    {
        $sql = 'SELECT * FROM categories WHERE id=:id';
        return $this->db->request($sql, ['id' => $_GET['id']], 'categories', false);
    }

    public function add()
    {
        $sql = 'INSERT INTO categories(name, description) VALUES (:name, :description)';
        return $this->db->request($sql, $_POST, 'categories');
    }

    public function delete()
    {
        $sql = 'DELETE from categories WHERE id=:id';
        return $this->db->request($sql,['id' => $_GET['id']], 'categories');
    }

    public function update()
    {
        $sql = 'UPDATE categories SET name=:name, description=:description WHERE id=:id';
        $_POST['id']= $_GET['id'];
        return $this->db->request($sql, $_POST, 'categories');
    }

}