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
     * all posts by category id
     */
    public function postsByCategory()
    {
        $categories = $this->categories->allWithPostCount();
        $posts = $this->posts->allByCategoryWithCommentCount($_GET['id']);
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

    public function contact()
    {
        if(!$_POST)
        {
            $this->render('formContact');
        }
        else
        {
            $post = $_POST;
            $formMessage = $this->contactValidationForm->checkForm($post);
            if($formMessage)
            {
                $this->render('formContact', compact('post', 'formMessage'));
            }
            else
            {
                $this->form_contacts->add($post);
                $result = $this->mail->send($this->mail->answerFormContact($post));
                $this->render('formContact', compact('post', 'formMessage', 'result'));
            }
        }
    }
}