<?php


namespace CamileApp\Controller;



/**
 * Class BackController
 * @package CamileApp\Controller
 */
class BackController extends Controller
{
    protected $viewPath = ROOT . '/CamileApp/view/backend/';

    /**
     * Connexion/register view
     */
    public function connexionRegister()
    {
        $this->render('connexionRegister');
    }

    private function exists($field, $value)
    {
        $exists = $this->users->exists($field, $value);
        return $exists[0];
    }

    /**
     * new user's register
     */
    public function register()
    {
        $formRegisterMessage = $this->registerValidationForm->checkValidity($_POST);

        if($this->exists('pseudo', $_POST['pseudo']))
        {
            $postRegister = $_POST;
            $formRegisterMessage['pseudo'] = 'Ce pseudo est déjà utilisé.';
            $this->render('connexionRegister', compact('formRegisterMessage', 'postRegister'));
        }

        if($this->exists('email', $_POST['email']))
        {
            $postRegister = $_POST;
            $formRegisterMessage['email'] = 'Ce courriel est déjà utilisé.';
            $this->render('connexionRegister', compact('formRegisterMessage', 'postRegister'));
        }

        if(!$formRegisterMessage)
        {
            $param = [ 
                'pseudo' => $_POST['pseudo'],
                'email' => $_POST['email'],
                'pass' => $this->password->hash($_POST['pass'])
                ];
            $success = $this->users->add($param);
            $pseudoRegister = $_POST['pseudo'];
            $this->render('connexionRegister', compact('formRegisterMessage', 'success', 'pseudoRegister'));
        }
        else
        {
            $postRegister = $_POST;
            $this->render('connexionRegister', compact('formRegisterMessage', 'postRegister'));
        }

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