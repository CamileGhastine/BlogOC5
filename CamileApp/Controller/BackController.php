<?php


namespace CamileApp\Controller;


/**
 * Class BackController  fonctionalities accessible for adminstrator and registered user
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

    /**
     * connexion
     */
    public function connect()
    {
        if($this->exists('pseudo', $_POST['pseudo']))
        {
            $infoPseudo = $this->users->infoPseudo($_POST['pseudo']);

            if($infoPseudo->getTry() >= 5)
            {
                $connexionMessage = 'Votre compte a été bloqué après 5 tentatives infructueuses.';
                $this->render('connexionRegister', compact('connexionMessage'));
            }

            if($this->password->verify($_POST['pass'], $infoPseudo->getPass()))
            {
                if($infoPseudo->getValidated() === null)
                {
                    $connexionMessage = 'Encore un peu de patience ! Votre compte sera validé sous peu.';
                    $this->render('connexionRegister', compact('connexionMessage'));
                }

                $this->users->TryToZero($_POST['pseudo']);

                $_SESSION['id'] = $infoPseudo->getID();
                $_SESSION['pseudo'] = $infoPseudo->getPseudo();
                $_SESSION['statut'] = $infoPseudo->getStatut();
                header('Location: index.php');
            }
            else
            {
                $this->users->substractTry($_POST['pseudo']);

                $tryLeft = $this->hijacking - $infoPseudo->getTry() - 1;

                $connexionMessage = 'Le mot de passe est incorrect. Il vous reste '.$tryLeft.' tentatives.';
                $connexionMessage = $tryLeft == 0 ? $connexionMessage.' Votre compte a été bloqué.' : $connexionMessage;
                $this->render('connexionRegister', compact('connexionMessage'));
            }
        }
        else
        {
            $connexionMessage = 'Le pseudo et/ou le mot de passe sont incorrects.';
            $this->render('connexionRegister', compact('connexionMessage'));
        }
    }

    /**
     * disconnexion
     */
    public function disconnect()
    {
        session_destroy();
        header('Location: index.php');
    }
    /**
     * new user's register form
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
            $param = ['pseudo' => $_POST['pseudo'], 'email' => $_POST['email'], 'pass' => $this->password->hash($_POST['pass'])];
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
     * Dashboard user view
     */
    public function account()
    {
        $this->render('account');
    }

    /**
     *  Allow to know if a value of a certain field exist
     * @param $field
     * @param $value
     * @return mixed
     */
    private function exists($field, $value)
    {
        $exists = $this->users->exists($field, $value);
        return $exists[0];
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