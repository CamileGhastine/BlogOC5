<?php


namespace CamileApp\Controller;


class ErrorController extends Controller
{
    protected $viewPath = ROOT.'/CamileApp/view/Error/';

    public function errorServer()
    {
        $this->render('Error_500');
    }
}