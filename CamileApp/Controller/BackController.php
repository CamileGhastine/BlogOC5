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
     * disconnection
     */
    public function disconnect()
    {
        session_destroy();
        header('Location: index.php');
        exit;
    }

    /**
     * One postById (by id) comment allow
     */
    public function postById()
    {
        $this->isConnect();

        if($_SESSION['statut'] == 'user')
        {
            $this->viewPostById();
        }
        elseif($_SESSION['statut'] == 'admin')
        {
            header('Location: index.php?route=admin.postByid&id=' . $_GET['id']);
            exit;
        }
        else
        {
            throw new Exception('session');
        }
    }

    /**
     * Dashboard user view
     */
    public function account()
    {
        $this->isConnect();

        $user = $this->users->infoPseudoWithPseudo($_SESSION['pseudo']);
        $this->render('account', compact('user'));
    }

    /**
     * change email user
     */
    public function updateEmail()
    {
        $this->isConnect();
        $this->token->check($_GET);

        $formMessage = $this->pseudoOrEmailExist($_GET['id']) ? $this->pseudoOrEmailExist($_GET['id']) : $this->usersValidationForm->checkForm($_POST);
        unset($formMessage['statut']);

        $user = $this->users->infoPseudoWithPseudo($_POST['pseudo']);

        if(!$formMessage AND !$this->password->verify($_POST['pass'], $user->getPass()))
        {
            $formMessage['pass'] = 'Le mot de passe est incorrect.';
        }

        if($formMessage)
        {
            $user->setEmail($_POST['email']);
            $this->render('account', compact('user', 'formMessage'));
        }
        else
        {
            $this->users->update(['id' => $_GET['id'], 'pseudo' => $user->getPseudo(), 'email' => $_POST['email'], 'statut' => $user->getStatut()]);
            header('Location: index.php?route=back.account&id=' . $_GET['id'] . '&modification=success');
        }

    }

    /**
     * change pass user
     */
    public function updatePass()
    {
        $this->isConnect();
        $this->token->check($_GET);

        $formMessage = $this->changePassValidationForm->checkForm($_POST);

        $user = $this->users->infoPseudoWithPseudo($_POST['pseudo']);

        if(!$formMessage AND !$this->password->verify($_POST['oldPass'], $user->getPass()))
        {
            $formMessage['oldPass'] = 'Le mot de passe est incorrect.';
        }
        if($formMessage)
        {
            $this->render('account', compact('user', 'formMessage'));
        }
        else
        {
            $pass = $this->password->hash($_POST['pass']);
            $this->users->updatePass(['pass' => $pass, 'id' => $_GET['id']]);
            header('Location: index.php?route=back.account&id=' . $_GET['id'] . '&modification=success');
        }
    }
}