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
}