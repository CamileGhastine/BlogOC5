<?php


namespace CamileApp\Controller;


abstract class Controller
{
    protected function render($view)
    {
        ob_start();
        require $this->viewPath.$view.'.php';
        $content = ob_get_clean();

        require  ROOT.'/CamileApp/view/template/default.php';
    }
}