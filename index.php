<?php echo 'test'; 

$route = $_SERVER["REQUEST_URI"];

require_once 'router.php';
$router = new Router($route);


?>