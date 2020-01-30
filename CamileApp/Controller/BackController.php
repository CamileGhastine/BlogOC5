<?php


namespace CamileApp\Controller;


/**
 * Class BackController  functionalities accessible for administrator and registered user
 * @package CamileApp\Controller
 */
class BackController extends Controller
{
    protected $viewPath = ROOT . '/CamileApp/view/backend/';

    /**
     * connection/register view
     */
    public function connectionRegister()
    {
        $this->render('connectionRegister');
    }

    /**
     * user connection
     */
    public function connect()
    {
        if($this->exists('pseudo', $_POST['pseudo']))
        {
            $infoPseudo = $this->users->infoPseudo($_POST['pseudo']);

            if($infoPseudo->getTry() >= 5)
            {
                $connectionMessage = 'Votre compte a été bloqué après 5 tentatives infructueuses.';
                $this->render('connectionRegister', compact('connectionMessage'));
            }

            if($this->password->verify($_POST['pass'], $infoPseudo->getPass()))
            {
                if($infoPseudo->getValidated() === null)
                {
                    $connectionMessage = 'Encore un peu de patience ! Votre compte sera validé sous peu.';
                    $this->render('connectionRegister', compact('connectionMessage'));
                }

                $this->users->TryToZero($_POST['pseudo']);

                $_SESSION['id'] = $infoPseudo->getID();
                $_SESSION['pseudo'] = $infoPseudo->getPseudo();
                $_SESSION['statut'] = $infoPseudo->getStatut();
                header('Location: index.php');
                exit;
            }
            else
            {
                $this->users->substractTry($_POST['pseudo']);

                $tryLeft = $this->hijacking - $infoPseudo->getTry() - 1;

                $connectionMessage = 'Le mot de passe est incorrect. Il vous reste ' . $tryLeft . ' tentatives.';
                $connectionMessage = $tryLeft == 0 ? $connectionMessage . ' Votre compte a été bloqué.' : $connectionMessage;
                $this->render('connectionRegister', compact('connectionMessage'));
            }
        }
        else
        {
            $connectionMessage = 'Le pseudo et/ou le mot de passe sont incorrects.';
            $this->render('connectionRegister', compact('connectionMessage'));
        }
    }

    /**
     * disconnection
     */
    public function disconnect()
    {
        session_destroy();
        header('Location: index.php');
        exit;
    }

    /**
     * user registration
     */
    public function register()
    {
        if ($this->exists('pseudo', $_POST['pseudo']) or $this->exists('email', $_POST['email']))
        {
            if($this->exists('pseudo', $_POST['pseudo']))
            {
                $formRegisterMessage['pseudo'] = 'Ce pseudo est déjà utilisé.';
            }
            if($this->exists('email', $_POST['email']))
            {
                $formRegisterMessage['email'] = 'Ce courriel est déjà utilisé.';
            }
        }

        $postRegister = $_POST;

        if(isset($formRegisterMessage))  // pseudo and/or mail exists
        {
            $this->render('connectionRegister', compact('formRegisterMessage', 'postRegister'));
        }
        else
        {
            $formRegisterMessage = $this->registerValidationForm->checkForm($_POST);

            if($formRegisterMessage) // problem with input format
            {
                $this->render('connectionRegister', compact('formRegisterMessage', 'postRegister'));
            }
            else // no problem => register in DB ok
            {
                $param = ['pseudo' => $_POST['pseudo'], 'email' => $_POST['email'], 'pass' => $this->password->hash($_POST['pass'])];
                $success = $this->users->add($param);
                $pseudoRegister = $_POST['pseudo'];
                $this->render('connectionRegister', compact('success', 'pseudoRegister'));
            }
        }



    }

    /**
     * Dashboard user view
     */
    public function account()
    {
        $user = $this->users->infoPseudo($_SESSION['pseudo']);
        $this->render('account', compact('user'));
    }

    /**
     *  Allow to know if a value of a field exist in the database
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
        $formMessage = $this->commentsValidationForm->checkForm($_POST);

        if(!$formMessage)
        {
            $this->comments->add($_POST);
            header('Location: index.php?route=front.postById&id=' . $_POST['post_id'] . '&success=add#comments');
            exit;
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