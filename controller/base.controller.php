<?php 

class BaseController {

    function __construct($params){
        //var_dump($params);
        $this->action = $params[0] ?? 'index';
        $this->id = $params[1] ?? null;

        if(!method_exists(get_called_class(), $this->action)){
            header("Location: /error404");
            die;
        }
        $this->entities = [];
        
        $templatesFolder = lcfirst(str_replace("Controller", "", get_called_class()));
        $this->template =  "template/$templatesFolder/$this->action.view.php";

        $this->{$this->action}();
    }

    public function render(){
        foreach ($this->entities as $k => $v) {
            ${$k} = $v;
        }
        // var_dump($this->template);
        // if(file_exists($this->template)){
        //     echo 'ok';
        // }
        ob_start();
        include_once $this->template;
        $this->content = ob_get_clean();
    }
}

?>
