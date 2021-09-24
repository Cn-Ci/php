<?php session_start();

function autoload($className){
    if (strpos($className,"Controller")){
        $fileName = lcfirst(str_replace("Controller", "", $className));
        require_once "controller/$fileName.controller.php";
    } elseif (strpos($className,"Repository")){
        $fileName = lcfirst(str_replace("Repository", "", $className));
        require_once "repository/$fileName.repository.php";
    } else {
        $fileName = lcfirst($className);
        require_once "entity/$fileName.entity.php";
    }
}
spl_autoload_register("autoload");

$route = $_SERVER["REQUEST_URI"];

if(count($_POST) > 0){
    $_SESSION['post'] = $_POST;
    $_SESSION['files'] = $_FILES;
    foreach ($_SESSION['files'] as &$file) {
        if($file['error'] == 0){
            $ext = explode('.', $file['name']);
            $ext = array_pop($ext);
            $name = "img".(microtime(true)*10000).".$ext";
            move_uploaded_file($file['tmp_name'], $_SERVER["DOCUMENT_ROOT"]."/assets/img/temp/".$name);
            $file['tmp_name'] = $_SERVER["DOCUMENT_ROOT"]."/assets/img/temp/".$name;
        }
    }
}

require_once 'router.php';
$router = new Router($route);

?>

<header>
    HEADER
</header>
<main>
    <?= $router->render() ?>
</main>

<footer>
    FOOTER
</footer>