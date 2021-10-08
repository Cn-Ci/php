<?php session_start();

function autoload($className){
    if (strpos($className, "Controller")) {
        $fileName = lcfirst(str_replace("Controller", "", $className));
        require_once "controller/$fileName.controller.php";
    }
    else if (strpos($className, "Repository")){
        $fileName = lcfirst(str_replace("Repository", "", $className));
        require_once "repository/$fileName.repository.php";
    } 
    else {
        $fileName = lcfirst($className);
        if(file_exists("entity/$fileName.entity.php")){
            require_once "entity/$fileName.entity.php";
        }
        elseif (file_exists("helper/$fileName.helper.php")){
            require_once "helper/$fileName.helper.php";
        }
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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="/assets/css/style.css">

<header>
    <?= isset($_SESSION['logged']) && $_SESSION['logged'] == true ? 
        '<a href="/user/logout">Logout</a>' : 
        '<a href="/user/login">Login</a>' ?>
        <a href="/cart" class="ml-3">Panier</a>
</header>
<main>
    <?= $router->render() ?>
</main>

<footer>
    FOOTER
</footer>