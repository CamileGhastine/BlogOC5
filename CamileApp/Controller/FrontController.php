<?php


namespace CamileApp\Controller;

class FrontController extends Controller
{
    protected $viewPath = ROOT.'/CamileApp/view/frontend/';

    public function home()
    {
        $this->render('home');
    }
}