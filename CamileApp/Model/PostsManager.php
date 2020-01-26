<?php


namespace CamileApp\Model;
use \PDO;

/**
 * Class PostsManager
 * @package CamileApp\Model
 */
class PostsManager extends Manager
{

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
        SELECT p.id, p.title, p.chapo, p.content, p.date_creation, p.date_modification, u.pseudo, ca.name As category, COUNT(co.validated) AS numberComments
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
        $sql ='
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

}