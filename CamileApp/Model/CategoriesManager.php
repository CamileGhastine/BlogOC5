<?php

namespace CamileApp\Model;

/**
 * Class CategoriesManager
 * @package CamileApp\Model
 */
class CategoriesManager extends Manager
{
    protected $table = 'categories';

    /**
     * all categories
     * function request($sql, $param, $table, $fetchall)
     * @return mixed
     */
    public function all()
    {
        $sql = 'SELECT * FROM categories ORDER BY name';
        return $this->db->request($sql, null, 'categories', true);
    }

    /**
     * one category (by id)
     * @return mixed
     */
    public function categoryById()
    {
        $sql = 'SELECT * FROM categories WHERE id=:id';
        return $this->db->request($sql, ['id' => $_GET['id']], 'categories', false);
    }

    /**
     * all categories with post count
     * @return mixed
     */
    public function allWithPostCount()
    {
        $sql = '
        SELECT ca.id, ca.name, ca.description, COUNT(p.id) AS numberPosts
        FROM categories AS ca
        LEFT JOIN posts AS p ON p.category_id=ca.id
        GROUP BY ca.id
        ORDER BY ca.name';
        return $this->db->request($sql, null, 'categories', true);
    }

    /**
     * INSERT INTO request
     * @return mixed
     */
    public function add()
    {
        $sql = 'INSERT INTO categories(name, description) VALUES (:name, :description)';
        return $this->db->request($sql, $_POST, 'categories');
    }

    /**
     * UPDATE request
     * @return mixed
     */
    public function update()
    {
        $sql = 'UPDATE categories SET name=:name, description=:description WHERE id=:id';
        return $this->db->request($sql, $_POST, 'categories');
    }
}