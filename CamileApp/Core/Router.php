<?php


namespace CamileApp\Core;

class Router
{
    public function run()
    {
        if (!isset($_GET['route']))
        {
            $route = 'front.home';
        }
        else
        {
            $route = $_GET['route'];
        }

        try
        {
            $routeExplode = explode('.', $route);
            $controller = 'CamileApp\\Controller\\'.ucfirst($routeExplode[0]).'Controller';
            $action = $routeExplode[1];

            $controller = new $controller();
            $controller->$action();

        }
        catch (Exception $e)
        {
            App::getInstance()->error('server');
        }

    }
}
