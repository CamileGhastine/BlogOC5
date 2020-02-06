<?php


namespace CamileApp\Controller;

use CamileApp\Core\App;

/**
 * Class Controller parent of all Controller
 * @package CamileApp\Controller
 */
abstract class Controller
{
    protected $posts;
    protected $comment;
    protected $categories;
    protected $users;
    protected $postsValidationForm;
    protected $categoriesValidationForm;
    protected $commentsValidationForm;
    protected $registerValidationForm;
    protected $usersValidationForm;
    protected $password;
    protected $hijacking;

    public function __construct()
    {
        $this->posts = App::getinstance()->getManager('posts');
        $this->comments = App::getinstance()->getManager('comments');
        $this->categories = App::getinstance()->getManager('categories');
        $this->users = App::getinstance()->getManager('users');
        $this->postsValidationForm = App::getinstance()->getValidationForm('posts');
        $this->categoriesValidationForm = App::getinstance()->getValidationForm('categories');
        $this->commentsValidationForm = App::getinstance()->getValidationForm('comments');
        $this->registerValidationForm = App::getinstance()->getValidationForm('register');
        $this->usersValidationForm = App::getinstance()->getValidationForm('users');
        $this->password = App::getInstance()->getPassword();
        $this->hijacking = App::getInstance()->hijacking();
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
            header('Location: index.php?route=back.connectionRegister&access=adminDenied');
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

}