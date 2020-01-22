<?php


namespace CamileApp\Core;

use Exception;

class Router
{
    public function run()
    {
        if(!isset($_GET['route']))
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

            $controller = 'CamileApp\\Controller\\' . ucfirst($routeExplode[0]) . 'Controller';
            if(isset($routeExplode[1]))
            {
                $action = $routeExplode[1];
            }

            if(class_exists($controller) && method_exists($controller, $action))
            {
                $controller = new $controller();
                $controller->$action();
            }
            else
            {
                throw new Exception('notFound');
            }
        }
        catch(Exception $e)
        {
            App::getInstance()->error($e->getMessage());
        }

    }
}
