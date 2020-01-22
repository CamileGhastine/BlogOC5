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
    public function all()
    {
        $posts = $this->db->query('SELECT * FROM posts');
        return $posts;
    }

    /**
     * one post by id
     * @param $id
     * @return mixed
     */
    public function postById($id)
    {
        $req = $this->db->prepare('SELECT * FROM posts WHERE id=:id');
        $req->execute(['id' => $id]);
        return $req->fetch();

    }

}