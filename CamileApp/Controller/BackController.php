<?php


namespace CamileApp\Controller;


/**
 * Class BackController
 * @package CamileApp\Controller
 */
class BackController extends Controller
{
    protected $viewPath = ROOT . '/CamileApp/view/backend/';

    public function connexionRegister()
    {
        $this->render('connexionRegister');
    }
    /**
     * add a new comment
     */
    public function addComment()
    {
        $formMessage = $this->commentsValidationForm->checkValidity($_POST);

        if(!$formMessage)
        {
            $this->comments->add($_POST);
            header('Location: index.php?route=front.postById&id=' . $_POST['post_id'] . '&success=add#comments');
        }
        else
        {
            $postAddUnvalid = $_POST;
            $post = $this->posts->postById($_GET['id']);
            $comments = $this->comments->commentsById($_GET['id']);
            $this->viewPath = ROOT . '/CamileApp/view/frontend/';
            $this->render('postById', compact('formMessage', 'postAddUnvalid', 'post', 'comments'));
            $this->viewPath = ROOT . '/CamileApp/view/backend/';
        }
    }
}