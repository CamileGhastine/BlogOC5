<?php

namespace CamileApp\Model;

/**
 * Class CommentsManager
 * @package CamileApp\Model
 */
class CommentsManager extends Manager
{
    protected $table = 'comments';

    /**
     * all comment by postById id
     * function request($sql, $param, $table, $fetchall)
     * @param $id
     * @return mixed
     */
    public function commentsById($id)
    {
        $sql = '
            SELECT co.id, co.content, co.date_creation, u.pseudo AS pseudo, co.validated FROM comments AS co 
            LEFT JOIN users AS u ON u.id = co.user_id 
            WHERE co.post_id=:id
            ORDER BY co.date_creation DESC';
        return $this->db->request($sql, ['id' => $id], 'comments', true);
    }

    /**
     * INSERT INTO request
     * @return mixed
     */
    public function add($post)
    {
        $sql = 'INSERT INTO comments(content, post_id, user_id, validated) VALUES (:content, :post_id, :user_id, :validated)';
        return $this->db->request($sql, $post);
    }

    /**
     * Validate comment
     * @param $id
     * @return mixed
     */
    public function validate($id)
    {
        $sql = 'UPDATE comments SET validated=1 WHERE id=:id ';
        return $this->db->request($sql,['id' => $id]);
    }

    /**
     * All comments of one posts (post_id)
     * @param $id
     */
    public function deleteALlByPostId($id)
    {
        $sql='DELETE from comments WHERE post_id=:post_id';
        $this->db->request($sql, ['post_id' => $id]);
    }

    /**
     * UPDATE request
     * @param $id
     */
    public function update($id, $content)
    {
        $sql = 'UPDATE comments SET content=:content WHERE id=:id';
        $this->db->request($sql, ['id' => $id, 'content' => $content ]);
    }
}