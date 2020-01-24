<?php


namespace CamileApp\Model;


/**
 * Class CommentsManager
 * @package CamileApp\Model
 */
class CommentsManager extends Manager
{
    /**
     * all comment by postById id
     * @param $id
     * @return mixed
     */
    public function commentsById($id)
    {
        $req = $this->db->prepare('
            SELECT * FROM comments AS co 
            LEFT JOIN users AS u ON u.id = co.user_id 
            WHERE co.validated=1 AND co.post_id=:id
            ORDER BY co.date_creation DESC');
        $req ->execute(['id' => $id]);
        return $req;
    }
}