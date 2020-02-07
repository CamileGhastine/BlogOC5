<?php


namespace CamileApp\Core\Token;


class Token
{

    public function check($post)
    {


        if(isset($_SESSION['token']) AND $post['token'] AND !empty($_SESSION['token']) AND !empty($post['token']) AND $_SESSION['token'] == $post['token'])
        {
            unset($post['token']);
            return $post;
        }
        else
        {
            session_destroy();
            header('Location: index.php?route=front.connectionRegister&access=token');
            exit;
        }
    }
}