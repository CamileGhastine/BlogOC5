<?php


namespace CamileApp\Model;


/**
 * Class PostsManager
 * @package CamileApp\Model
 */
class PostsManager extends Manager
{


    /**
     *  all posts
     * @return mixed
     */
    public function allWithCommentCount()
    {
        $sql = '
SELECT p.id, p.title, p.chapo, p.date_creation, p.date_modification, COUNT(c.validated) AS numberComments
FROM posts AS p
LEFT JOIN comments AS c ON c.post_id = p.id
GROUP BY p.id
ORDER BY p.date_creation DESC ';
        $posts = $this->db->query($sql);
        return $posts;
    }

    /**
     * one post by id
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
        $req = $this->db->prepare($sql);
        $req->execute(['id' => $id]);
        return $req->fetch();

    }

}