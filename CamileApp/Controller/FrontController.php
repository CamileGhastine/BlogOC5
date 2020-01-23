<?php


namespace CamileApp\Controller;

use CamileApp\Core\App;

/**
 * Class FrontController
 * @package CamileApp\Controller
 */
class FrontController extends Controller
{
    protected $viewPath = ROOT.'/CamileApp/view/frontend/';
    protected $posts;
    protected $comment;

    public function __construct()
    {
        $this->posts = App::getinstance()->getManager('posts');
        $this->comments = App::getinstance()->getManager('comments');
        $this->posts = App::getinstance()->getManager('posts');
    }


    /**
     * home page
     */
    public function home()
    {
        $this->render('home');
    }

    /**
     * all posts
     */
    public function posts()
    {
        $posts = $this->posts->allWithCommentCount();
        $this->render('posts', compact('posts'));
    }

    /**
     * one post
     * @param $id
     */
    public function post()
    {
        $post = $this->posts->postById($_GET['id']);
        $comments = $this->comments->commentsById($_GET['id']);
        $this->render('post', compact('post', 'comments'));
    }
}