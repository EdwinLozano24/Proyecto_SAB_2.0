<?php

$home = new HomeController();
$accion = $_GET['accion'] ?? 'home';

switch ($accion) {
    case 'Login':
        $home->login();
        break;
    case 'Logout':
        $home->logout();
    default:
        $home->home();
        break;
}

class HomeController
{
    public function home()
    {
        header('Location: ../views/home/dashboard.php');
        exit;
    }
}