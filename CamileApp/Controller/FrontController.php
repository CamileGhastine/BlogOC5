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
        $this->categories = App::getinstance()->getManager('categories');
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
        $categories = $this->categories->all();
        $this->render('posts', compact('posts', 'categories'));
    }

    /**
     * One postById (by id)
     */
    public function postById()
    {
        $post = $this->posts->postById($_GET['id']);
        $comments = $this->comments->commentsById($_GET['id']);
        $this->render('postById', compact('post', 'comments'));
    }

    /**
     * all posts by category id
     */
    public function postsByCategory()
    {
        $posts = $this->posts->allByCategoryWithCommentCount($_GET['id']);
        $categories = $this->categories->all();
        $this->render('postsByCategory', compact('posts', 'categories'));
    }
}