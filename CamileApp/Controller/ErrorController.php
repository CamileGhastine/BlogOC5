<?php


namespace CamileApp\Controller;


/**
 * Class ErrorController
 * @package CamileApp\Controller
 */
class ErrorController extends Controller
{
    protected $viewPath = ROOT . '/CamileApp/view/Error/';

    /**
     * probleme of connection to DB
     */
    public function errorConnection()
    {
        $this->render('error_connection');
    }

    /**
     * Page note found
     */
    public function ErrorNotFound()
    {
        $this->render('error_notFound');
    }

}