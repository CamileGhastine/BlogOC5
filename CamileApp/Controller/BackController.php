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
        $infoPseudo = $this->users->infoPseudoWithPseudo($_POST['pseudo']);

        if($infoPseudo) // pseudo exists in database
        {
            if($infoPseudo->getTry() >= $this->hijacking) // maximum number of trials reached
            {
                $connectionMessage = 'Votre compte a été bloqué après ' . $this->hijacking . ' tentatives infructueuses.';
                $this->render('connectionRegister', compact('connectionMessage'));
            }
            else
            {
                if($this->password->verify($_POST['pass'], $infoPseudo->getPass())) // password is ok
                {
                    if($infoPseudo->getValidated() === null) // user not yet validated by the administrator
                    {
                        $connectionMessage = 'Encore un peu de patience ! Votre compte sera validé sous peu.';
                        $this->render('connectionRegister', compact('connectionMessage'));
                    }
                    else // Connection to user page
                    {
                        $this->users->TryToZero($_POST['pseudo']);

                        $_SESSION['id'] = $infoPseudo->getID();
                        $_SESSION['pseudo'] = $infoPseudo->getPseudo();
                        $_SESSION['statut'] = $infoPseudo->getStatut();
                        $_SESSION['token'] = bin2hex(random_bytes(10));

                        header('Location: index.php');
                        exit;
                    }
                }
                else // password not ok
                {
                    $this->users->substractTry($_POST['pseudo']);

                    $tryLeft = $this->hijacking - $infoPseudo->getTry() - 1;

                    $connectionMessage = 'Le mot de passe est incorrect. Il vous reste ' . $tryLeft . ' tentatives.';
                    $connectionMessage = $tryLeft == 0 ? $connectionMessage . ' Votre compte a été bloqué.' : $connectionMessage;
                    $this->render('connectionRegister', compact('connectionMessage'));
                }
            }
        }
        else // pseudo doesn't exist
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
        $postRegister = $_POST;

        // Form verification
        $formRegisterMessage = $this->pseudoOrEmailExist() ? $this->pseudoOrEmailExist() : $this->registerValidationForm->checkForm($_POST);

        if($formRegisterMessage)  // form not ok
        {
            $this->render('connectionRegister', compact('formRegisterMessage', 'postRegister'));
        }
        else // form ok
        {
            $param = ['pseudo' => $_POST['pseudo'], 'email' => $_POST['email'], 'pass' => $this->password->hash($_POST['pass']), 'statut' => 'user'];
            $success = $this->users->add($param);
            $pseudoRegister = $_POST['pseudo'];
            $this->render('connectionRegister', compact('success', 'pseudoRegister'));
        }
    }

    /**
     * Dashboard user view
     */
    public function account()
    {
        $user = $this->users->infoPseudoWithPseudo($_SESSION['pseudo']);
        $this->render('account', compact('user'));
    }

    /**
     * add a new comment
     */
    public function addComment()
    {
        $formMessage = $this->commentsValidationForm->checkForm($_POST);

        if(!$formMessage)
        {
            $_POST['user_id'] = $_SESSION['id'];
            $_POST['validated'] = ($_SESSION['statut'] === 'admin') ? 1 : null;
            $this->comments->add($_POST);
            header('Location: index.php?route=front.postById&id=' . $_POST['post_id'] . '&success=' . $_SESSION['statut'] . '#comments');
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