<?php


namespace CamileApp\Core;


class Router
{
    public function run()
    {
        if (!isset($_GET['route']))
        {
            $route = 'front.home';
        } else
        {
            $route = $_GET['route'];
        }

        if ($route === 'front.home')
        {
            require ROOT . '/CamileApp/view/frontend/home.php';
        }
    }
}