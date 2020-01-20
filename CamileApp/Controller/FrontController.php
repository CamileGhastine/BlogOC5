<?php


namespace CamileApp\Controller;

use CamileApp\Core\App;

class FrontController extends Controller
{
    protected $viewPath = ROOT.'/CamileApp/view/frontend/';

    public function home()
    {
        $this->render('home');
    }

    public function posts()
    {
        $posts = App::getInstance()->getManager('posts')->all();
        $this->render('posts', compact('posts'));
    }
}