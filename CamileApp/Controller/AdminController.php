<?php


namespace CamileApp\Controller;


class AdminController extends Controller
{
    protected $viewPath = ROOT.'/CamileApp/view/admin/';

    public function home()
    {
        $this->render('home');
    }

}