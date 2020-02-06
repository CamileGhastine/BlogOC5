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
     * Dashboard user view
     */
    public function account()
    {
        $this->isConnect();

        $user = $this->users->infoPseudoWithPseudo($_SESSION['pseudo']);
        $this->render('account', compact('user'));
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
            header('Location: index.php?route=admin.postByid&id='. $_GET['id']);
            exit;
        }
        else
        {
            throw new Exception('session');
        }
    }

    /**
     * add a new comment
     */
    public function addComment()
    {
        $this->isConnect();

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
            $this->render('comment', compact('formMessage', 'postAddUnvalid', 'post', 'comments'));
            $this->viewPath = ROOT . '/CamileApp/view/backend/';
        }
    }
}