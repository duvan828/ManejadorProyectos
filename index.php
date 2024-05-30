<?php




ini_set('display_errors', 1);
error_reporting(E_ALL);

// require_once 'config/config.php';


// 1. Validar la existencia del parametro 'controller'
// ...
if (!is_null($_GET['controller'])&&!is_null($_GET['action'])) {
    $nameController = ucfirst($_GET['controller']).'Controller'; 
    $pathController = __DIR__. '/Controller/' . $nameController . '.php';


    // 2. Validar la existencia del archivo
    // ...

    // 3. Validar la existencia del parámetro 'action'
    // ..
    $action = $_GET['action'];

    $data = json_decode(file_get_contents("php://input"), true);

    require $pathController;
    $controller = new $nameController();
    $controller->$action();
} else {
    header('Location: view/personas.php');
    exit();
}
?>
