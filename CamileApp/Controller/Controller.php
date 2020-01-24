<?php


namespace CamileApp\Controller;


/**
 * Class Controller parent of all Controller
 * @package CamileApp\Controller
 */
abstract class Controller
{
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