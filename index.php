<?php
$config = require __DIR__ . '/config/configmailer.php';
require __DIR__ . '/config/database.php';
require __DIR__ . '/vendor/autoload.php';

date_default_timezone_set($config['app_timezone'] ?? 'America/Bogota');

require_once __DIR__ . '/controllers/UsuarioController.php';
require_once __DIR__ . '/controllers/PasswordController.php';

$pdo = conectarBD();

$usua_notificar = new UsuarioController($config);
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
    case 'storeUser':
        $usua_notificar->store();
        break;
    default:
        header('location: views/.general/usuario/loginRegister.php');
}



