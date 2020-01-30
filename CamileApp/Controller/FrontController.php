<?php


namespace CamileApp\Controller;

/**
 * Class FrontController functionalities accessible for everybody
 * @package CamileApp\Controller
 */
class FrontController extends Controller
{
    protected $viewPath = ROOT . '/CamileApp/view/frontend/';

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
        $categories = $this->categories->allWithPostCount();
        $posts = $this->posts->allWithCommentCount();
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
        $categories = $this->categories->allWithPostCount();
        $this->render('postsByCategory', compact('posts', 'categories'));
    }
}