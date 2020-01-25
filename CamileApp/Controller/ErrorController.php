<?php


namespace CamileApp\Controller;


/**
 * Class ErrorController
 * @package CamileApp\Controller
 */
class ErrorController extends Controller
{
    protected $viewPath = ROOT . '/CamileApp/view/error/';

    /**
     * return the message error to the view error
     * @param $errorType
     */
    public function getErrorMessage($errorType)
    {
        switch($errorType)
        {
            case 'Connection' : $message = 'Problème de connexion à la base de données !!!';
            break;
            case 'notFound' : $message = 'Erreur 404 : Page introuvable !!!';
            break;
            case 'typage' : $message = 'Problème de typage, renouveler votre requête !!!';
            break;
            default : $message = 'Erreur : '.$errorType;
        }
        $this->render('error', compact('message'));
    }
}