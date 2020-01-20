<?php


namespace CamileApp\Controller;


abstract class Controller
{
    protected function render($view, $compactVars)
    {
        extract($compactVars);
        ob_start();
        require $this->viewPath.$view.'.php';
        $content = ob_get_clean();

        require  ROOT.'/CamileApp/view/template/default.php';
    }
}