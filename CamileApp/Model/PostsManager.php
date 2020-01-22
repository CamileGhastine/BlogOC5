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
     * @return mixed all posts in DB
     */
    public function all()
    {
        $posts = $this->db->query('SELECT * FROM posts');
        return $posts;
    }

}