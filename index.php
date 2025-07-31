<?php
require_once 'config/database.php';
require_once 'controllers/PasswordController.php';
date_default_timezone_set('America/Bogota');

$pdo = conectarBD();
$controller = new PasswordController($pdo);

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'showRecoverForm':
        $controller->showRecoverForm();
        break;
    case 'sendResetLink':
        $controller->sendResetLink();
        break;
    case 'resetForm':
        $controller->showResetForm();
        break;
    case 'resetPassword':
        $controller->resetPassword();
        break;
    default:
        header('location: views/usuario/loginRegister.php');
}



