<?php

namespace CamileApp\Model;

/**
 * Class PostsManager
 * @package CamileApp\Model
 */
class PostsManager extends Manager
{
    protected $table = 'posts';

    /**
     * all posts (with number of comments)
     * function request($sql, $param, $table, $fetchall)
     * @return mixed
     */
    public function allWithCommentCount()
    {
        $sql = '
SELECT p.id, p.title, p.chapo, p.date_creation, p.date_modification, COUNT(co.validated) AS numberComments
FROM posts AS p
LEFT JOIN comments AS co ON co.post_id = p.id
GROUP BY p.id
ORDER BY p.date_creation DESC ';
        return $this->db->request($sql, null, 'posts', true);
    }

    /**
     * one postById by id
     * function request($sql, $param, $table, $fetchall)
     * @param $id
     * @return mixed
     */
    public function postById($id)
    {
        $sql = '
        SELECT p.id, p.title, p.chapo, p.content, p.date_creation, p.date_modification, p.category_id, u.pseudo, ca.name As category, COUNT(co.validated) AS numberComments
        FROM posts AS p
        LEFT JOIN users AS u ON u.id = p.user_id
        LEFT JOIN categories AS ca ON ca.id = p.category_id
        LEFT JOIN comments AS co ON co.post_id = p.id
        WHERE p.id=:id';
        return $this->db->request($sql, ['id' => $id], 'posts', false);
    }

    /**
     * all postById by category id (with number of comments)
     * function request($sql, $param, $table, $fetchall)
     * @param $id
     * @return mixed
     */
    public function allByCategoryWithCommentCount($id)
    {
        $sql = '
SELECT p.id, p.title, p.chapo, p.date_creation, p.date_modification, COUNT(co.validated) AS numberComments
FROM posts AS p
LEFT JOIN comments AS co ON co.post_id = p.id
LEFT JOIN categories AS ca ON ca.id = p.category_id
WHERE ca.id = :id
GROUP BY p.id
ORDER BY p.date_creation DESC
        ';
        return $this->db->Request($sql, ['id' => $id], 'posts', true);
    }

    /**
     * all posts with all infos (category, number of validated and unvalidated comments)
     * @return mixed
     */
    public function allWithAllInfos()
    {
        $sql = '
SELECT p.id, p.title, p.chapo, p.date_creation, p.date_modification, COUNT(co.validated) AS numberComments, ca.name as category, (SELECT COUNT(*)-COUNT(validated) FROM `comments` where post_id =p.id) AS numberUnvalidated
FROM posts AS p
LEFT JOIN comments AS co ON co.post_id = p.id
LEFT JOIN categories AS ca ON ca.id = p.category_id
GROUP BY p.id
ORDER BY p.date_creation DESC
        ';
        return $this->db->Request($sql, null, 'posts', true);
    }

    /**
     * INSERT INTO request
     * @return mixed
     */
    public function add($post)
    {
        $sql = 'INSERT INTO posts(title, chapo, content, category_id, user_id) VALUES (:title, :chapo, :content, :category_id, :user_id)';
        return $this->db->request($sql, $post, 'posts');
    }

    /**
     * UPDATE request
     * @return mixed
     */
    public function update($post)
    {
        $sql = 'UPDATE posts SET title=:title, chapo=:chapo, content=:content, category_id=:category_id WHERE id=:id';
        return $this->db->request($sql, $post, 'posts');
    }

    /**
     * change Post Category to Unknown (id=1) when the category is delete
     * @return mixed
     */
    public function changeCategoryToUnknown()
    {
        $sql = 'UPDATE posts SET category_id=1 WHERE category_id=:id';
        return $this->db->request($sql, ['id' => $_GET['id']], 'posts');
    }
}