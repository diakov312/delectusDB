<?php

class Router {
    public static function init() {
        $controllerName = "Main";
        $actionName = "index";

        $routes = explode("/" , $_SERVER["REQUEST_URI"]);

        if (!empty($routes[1]) && ($routes[1] != "index.php")) {
            $controllerName = $routes[1];
        }

        if (!empty($routes[2])) {
            $actionName = $routes[2];
        }

        $controllerName = "Controller_".$controllerName;
        $controller = new $controllerName;

        if (method_exists($controller, $actionName)) {
            $controller->$actionName();
        } else {
            echo "Status: Not Found.";
        }
    }
}