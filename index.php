<?php
$config = require __DIR__ . '/config/configMailer.php';
date_default_timezone_set($config['app_timezone'] ?? 'America/Bogota');

require_once 'config/database.php';
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/controllers/PasswordController.php';

$pdo = conectarBD();
$resetPass = new PasswordController($config);
$action = $_GET['action'] ?? 'index';
switch ($action) {
    case 'showResetForm':
        $resetPass->showResetForm();
        break;
    case 'sendResetLink':
        $resetPass->sendResetLink();
        break;
    case 'resetForm':
        $resetPass->showResetForm();
        break;
    case 'resetPassword':
        $resetPass->resetPassword();
        break;
    default:
        header('location: views/usuario/loginRegister.php');
}



