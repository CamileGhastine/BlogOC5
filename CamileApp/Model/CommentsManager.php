<?php


namespace CamileApp\Model;


class CommentsManager extends Manager
{
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