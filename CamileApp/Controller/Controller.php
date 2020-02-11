<?php


namespace CamileApp\Controller;

use CamileApp\Core\App;

/**
 * Class Controller parent of all Controller
 * @package CamileApp\Controller
 */
abstract class Controller
{
    /**
     * @var mixed
     */
    protected $posts;
    protected $comments;
    protected $categories;
    protected $users;
    protected $form_contacts;
    protected $postsValidationForm;
    protected $categoriesValidationForm;
    protected $commentsValidationForm;
    protected $registerValidationForm;
    protected $usersValidationForm;
    protected $contactValidationForm;
    protected $emailValidationForm;
    protected $changePassValidationForm;
    protected $password;
    protected $hijacking;
    protected $mail;
    protected $token;


    public function __construct()
    {
        $this->posts = App::getinstance()->getManager('posts');
        $this->comments = App::getinstance()->getManager('comments');
        $this->categories = App::getinstance()->getManager('categories');
        $this->users = App::getinstance()->getManager('users');
        $this->form_contacts = App::getinstance()->getManager('form_contacts');
        $this->postsValidationForm = App::getinstance()->getValidationForm('posts');
        $this->categoriesValidationForm = App::getinstance()->getValidationForm('categories');
        $this->commentsValidationForm = App::getinstance()->getValidationForm('comments');
        $this->registerValidationForm = App::getinstance()->getValidationForm('register');
        $this->usersValidationForm = App::getinstance()->getValidationForm('users');
        $this->contactValidationForm = App::getinstance()->getValidationForm('contact');
        $this->emailValidationForm = App::getinstance()->getValidationForm('email');
        $this->changePassValidationForm = App::getinstance()->getValidationForm('changePass');
        $this->password = App::getInstance()->getPassword();
        $this->hijacking = App::getInstance()->hijacking();
        $this->mail = App::getInstance()->getMailer();
        $this->token = App::getinstance()->getToken();
    }

    /**
     * view and template by transfering the variables
     * @param $view
     * @param array $compactVars
     */
    protected function render($view, $compactVars = [])
    {
        extract($compactVars);
        ob_start();
        require $this->viewPath . $view . '.php';
        $content = ob_get_clean();

        require ROOT . '/CamileApp/view/template/default.php';
    }

    /**
     * check if the user is admin
     */
    protected function isAdmin()
    {
        if($_SESSION['statut'] !== 'admin')
        {
            header('Location: index.php?route=front.connectionRegister&access=adminDenied');
            exit;
        }
    }

    /**
     * check if the user is connected
     */
    protected function isConnect()
    {
        if($_SESSION['statut'] !== 'user' AND $_SESSION['statut'] !=='admin')
        {
            header('Location: index.php?route=front.connectionRegister&access=userDenied');
            exit;
        }
    }

    /**
     *  Allow to know if a value of a field exist in the database for a different id
     * @param $field
     * @param $value
     * @return mixed
     */
    protected function exists($field, $value, $id = null)
    {
        $exists = $this->users->exists($field, $value, $id);
        return $exists->getPseudoExists();
    }

    /**
     * test if the pseudo or/and mail (in $array) exists in DB
     * @param null $id
     * @return mixed
     */
        protected function pseudoOrEmailExist($id=null)
    {
            if($this->exists('pseudo', $_POST['pseudo'], $id))
            {
                $formMessage['pseudo'] = 'Ce pseudo est déjà utilisé.';
            }
            if($this->exists('email', $_POST['email'], $id))
            {
                $formMessage['email'] = 'Ce courriel est déjà utilisé.';
            }
        if(isset($formMessage))
        {
            return $formMessage ;
        }
    }

    /**
     * Delete à table : user, post or category
     * @param $table
     */
    public function delete($table)
    {
        $this->isAdmin();

        switch($table)
        {
            case 'posts':
                $this->comments->deleteAllByPostId($_GET['commentId']);
                break;
            case 'categories':
                $this->posts->changeCategoryToUnknown();
                break;
            case 'users':
                $this->comments->commentsToAnonymous($_GET['id']);
                $this->posts->PostsToAnonymous($_GET['id']);
                break;
        }

        $this->$table->delete($_GET['id']);
        header('Location: index.php?route=admin.' . $table . '&success=delete');
        exit;
    }

    /**
     * display user management by admin
     * @param $display
     * @param $users
     */
    protected function displayUserAdmin($display, $users)
    {
        $numberUsersUnvalidated = $this->users->countUnvalidated();
        $numberUsersBlocked = $this->users->countBlocked();
        $this->render('users', compact('users', 'numberUsersUnvalidated', 'numberUsersBlocked', 'display'));
    }

    /**
     * view of postById (front, user and admin)
     */
    protected function viewPostById()
    {
        $post = $this->posts->postById($_GET['id']);
        $comments = $this->comments->commentsById($_GET['id']);
        $this->render('postById', compact('post', 'comments'));
    }

    /**
     * add a new comment
     */
    public function addComment()
    {
        $this->isConnect();

        $post = $this->token->check($_POST);

        $formMessage = $this->commentsValidationForm->checkForm($post);

        if(!$formMessage)
        {
            $post['user_id'] = $_SESSION['id'];
            $post['validated'] = ($_SESSION['statut'] === 'admin') ? 1 : null;
            $this->comments->add($post);
            header('Location: index.php?route=front.postById&id=' . $_POST['post_id'] . '&success=' . $_SESSION['statut'] . '#comments');
            exit;
        }
        else
        {
            $postAddUnvalid = $post;
            $post = $this->posts->postById($_GET['id']);
            $comments = $this->comments->commentsById($_GET['id']);
            $this->render('postById', compact('formMessage', 'postAddUnvalid', 'post', 'comments'));
        }
    }

    /**
     * message and reduce Try if password not match
     * @param $post
     * @param $infoPseudo
     * @return string
     */
    protected function passwordNotMatch($post, $infoPseudo)
    {
        $this->users->substractTry($post['pseudo']);

        $tryLeft = $this->hijacking - $infoPseudo->getTry() - 1;

        $connectionMessage = 'Le mot de passe est incorrect. Il vous reste ' . $tryLeft . ' tentatives.';
        $connectionMessage = $tryLeft == 0 ? $connectionMessage . ' Votre compte a été bloqué.<br/>Cliquez sur mot de passe oublié pour le débloquer.' : $connectionMessage;
        return $connectionMessage;
    }

    /**
     * update DB and sen mail when unlock user or forgotten password
     * @param $user
     * @throws \Exception
     */
    protected function unlock($user)
    {
        $newPass = bin2hex(random_bytes(6));
        $this->users->unlock(['id' => $user->getId(), 'pass' => $this->password->hash($newPass)]);
        $this->mail->send($this->mail->unlock($user, $newPass));
    }
}