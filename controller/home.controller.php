<?php 

class HomeController {

    function __construct($params){
        var_dump($params);
        // $this->action = $params[0] ?? 'index';
        // $this->id = $params[1] ?? null;

        // if(!method_exists(get_called_class(), $this->action)){
        //     $controllerName = get_called_class();
        //     die("Action \"$this->action\" of the Controller \"$controllerName\" not exists");
        // }
    }
}

?>