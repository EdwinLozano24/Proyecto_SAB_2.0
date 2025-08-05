<?php
require_once 'config/database.php';
require_once 'controllers/PasswordController.php';
require __DIR__ . '/vendor/autoload.php';

$config = require __DIR__ . '/config/configMailer.php';
date_default_timezone_set($config['app_timezone']);

$pdo = conectarBD();
$controller = new PasswordController($pdo);

$action = $_GET['action'] ?? 'index';
switch ($action) {
    case 'showRecoverFor':
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



