<?php


namespace CamileApp\Controller;


class ErrorController extends Controller
{
    protected $viewPath = ROOT . '/CamileApp/view/Error/';

    public function errorServer()
    {
        $this->render('error_500');
    }

    public function errorConnection()
    {
        $this->render('error_connection');
    }

    public function ErrorNotFound()
    {
        $this->render('error_notFound');
    }

}