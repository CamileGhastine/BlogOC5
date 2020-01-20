<?php


namespace CamileApp\Model;

use \PDO;

class PostsManager extends Manager
{
    public function all()
    {
        $posts = $this->db->query('SELECT * FROM posts');
        return $posts;
    }

}