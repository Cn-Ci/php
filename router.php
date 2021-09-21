<?php 

class Router {

    function __construct($route) {
        /* structure d'une route ../php/chemin/18 */

        $route =trim($route, '/');
        $route = filter_var($route, FILTER_SANITIZE_URL);
        $route = explode('/', $route);

        $controllerName = array_shift($route);
        /* var_dump($controllerName); */
        /* var_dump($route); */

        $controllerFilePath = "controller/$controllerName.controller.php";

        if(!file_exists($controllerFilePath)){
            die("File for the Controller:\"$controllerName\" not found");
        }

        /* require_once $controllerFilePath; */
        $controllerClassName = ucfirst($controllerName)."Controller";
        $this->controller = new $controllerClassName($route);
    }
}

?>