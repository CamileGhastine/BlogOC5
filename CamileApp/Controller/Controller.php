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
    protected $postsValidationForm;
    protected $categoriesValidationForm;
    protected $commentsValidationForm;


    public function __construct()
    {
        $this->posts = App::getinstance()->getManager('posts');
        $this->comments = App::getinstance()->getManager('comments');
        $this->categories = App::getinstance()->getManager('categories');
        $this->postsValidationForm = App::getinstance()->getValidationForm('posts');
        $this->categoriesValidationForm = App::getinstance()->getValidationForm('categories');
        $this->commentsValidationForm = App::getinstance()->getValidationForm('comments');
    }

    /**
     * view and template by transfering the variables
     * @param $view
     * @param array $compactVars
     */
    protected function render($view, $compactVars=[])
    {
        extract($compactVars);
        ob_start();
        require $this->viewPath.$view.'.php';
        $content = ob_get_clean();

        require  ROOT.'/CamileApp/view/template/default.php';
    }
}