<?php
//Incluimos los archivos requeridos
require_once "Model/database.php";

// Verificamos si existe el parámetro 'c' (El controlador que utilizaremos) en la URL
$controller = isset($_GET['c']) ? $_GET['c'] : 'Login'; // Si no existe 'C', se usa 'Login' por defecto
$action = isset($_GET['a']) ? $_GET['a'] : 'LoginView'; // Y la acción por defecto del controlador 'Login' es 'loginView'

// Armamos el nombre del controlador y el archivo correspondiente (Aplicamos Formato)
$controllerFile = "Controller/{$controller}.controller.php";
$controllerClass = ucwords($controller) . "Controller";

// Verificamos si el archivo del controlador existe
if (file_exists($controllerFile)) {
    require_once $controllerFile; // Incluimos el controlador

    // Verificamos si la clase existe
    if (class_exists($controllerClass)) {
        $controllerInstance = new $controllerClass(); // Instanciamos el controlador

        // Verificamos si el método de la acción existe
        if (method_exists($controllerInstance, $action)) {
            call_user_func([$controllerInstance, $action]); // Llamamos al método correspondiente
        } else {
            die("El método '$action' no existe en la clase '$controllerClass'.");
        }
    } else {
        die("La clase '$controllerClass' no existe.");
    }
} else {
    die("El archivo del controlador '$controllerFile' no existe.");
}
