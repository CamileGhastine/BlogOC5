<?php


namespace CamileApp\Core;

use Exception;

/**
 * Class Router
 * @package CamileApp\Core
 */
class Router
{
    /**
     * route the client request
     */
    public function run()
    {
        $route = !isset($_GET['route']) ? 'front.home' : $route = $_GET['route'];

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
