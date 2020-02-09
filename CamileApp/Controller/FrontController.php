<?php

namespace CamileApp\Controller;

use Exception;

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
        if($_SESSION == null)
        {
            $this->viewPostById();
        }
        elseif($_SESSION['statut'] == 'user' OR $_SESSION['statut'] == 'admin')
        {
            header('Location: index.php?route=back.postByid&id=' . $_GET['id']);
            exit;
        }
        else
        {
            throw new Exception('session');
        }
    }

    /**
     * form contact
     */
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

    /**
     * user registration
     */
    public function register()
    {
        $postRegister = $_POST;

        // Form verification
        $formRegisterMessage = $this->pseudoOrEmailExist() ? $this->pseudoOrEmailExist() : $this->registerValidationForm->checkForm($_POST);

        if($formRegisterMessage)  // form not ok
        {
            $this->render('connectionRegister', compact('formRegisterMessage', 'postRegister'));
        }
        else // form ok
        {
            $param = ['pseudo' => $_POST['pseudo'], 'email' => $_POST['email'], 'pass' => $this->password->hash($_POST['pass']), 'statut' => 'user', 'validated' => null];
            $success = $this->users->add($param);
            $pseudoRegister = $_POST['pseudo'];
            $this->render('connectionRegister', compact('success', 'pseudoRegister'));
        }
    }

    /**
     * connection/register view
     */
    public function connectionRegister()
    {
        $this->render('connectionRegister');
    }

    /**
     * user or admin connection
     * @throws \Exception
     */
    public function connect()
    {
        $infoPseudo = $this->users->infoPseudoWithPseudo($_POST['pseudo']);

        $connectionMessage = $this->checkConnect($infoPseudo);


        if(!$connectionMessage) // Connection to user page
        {
            $this->users->TryToZero($_POST['pseudo']);

            $_SESSION['id'] = $infoPseudo->getID();
            $_SESSION['pseudo'] = $infoPseudo->getPseudo();
            $_SESSION['statut'] = $infoPseudo->getStatut();
            $_SESSION['token'] = bin2hex(random_bytes(10));

            header('Location: index.php');
            exit;
        }
        else
        {
            $this->render('connectionRegister', compact('connectionMessage'));

        }
    }

    /**
     * test pseudo, number of try, password, validate user
     * @param $infoPseudo
     * @return string
     */
    private function checkConnect($infoPseudo)
    {

        if(!$infoPseudo) // pseudo doesn't exist
        {
            return 'Le pseudo et/ou le mot de passe sont incorrects.';
        }
        if($infoPseudo->getTry() >= $this->hijacking) // maximum number of trials reached
        {
            return 'Votre compte a été bloqué après ' . $this->hijacking . ' tentatives infructueuses.';
        }
        if(!$this->password->verify($_POST['pass'], $infoPseudo->getPass())) // password not ok
        {
            return $this->passwordNotMatch($_POST, $infoPseudo);
        }

        if($infoPseudo->getValidated() === null) // user not yet validated by the administrator
        {
            return 'Encore un peu de patience ! Votre compte sera validé sous peu.';
        }
    }

    public function forgottenPassword()
    {
        if($_POST != null)
        {
            $post = $_POST;
            $formMessage = $this->emailValidationForm->checkForm($_POST);

            if($formMessage)
            {
                $this->render('forgottenPassword', compact('formMessage', 'post'));
            }
            else
            {
                echo 'message envoyé';
//                $this->mail->send($this->mail($_POST));
            }

        }
        else
        {
            $this->render('forgottenPassword');
        }
    }
}