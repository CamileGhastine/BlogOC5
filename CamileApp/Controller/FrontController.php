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
        $posts = App::getInstance()->getManager('posts')->all();
        $this->render('posts', compact('posts'));
    }

    /**
     * one post
     * @param $id
     */
    public function post()
    {

        $post = App::getInstance()->getManager('posts')->postById($_GET['id']);
        $this->render('post', compact('post'));
    }
}