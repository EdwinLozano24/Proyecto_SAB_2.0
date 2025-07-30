<?php
require_once __DIR__ . '/../models/UsuarioModel.php';
$home = new HomeController();
$accion = $_GET['accion'] ?? 'home';

switch ($accion) {
    case 'Login':
        $home->login();
        break;
    case 'Logout':
        $home->logout();
        break;
    case 'PacientePerfilView':
        $home->pacientePerfilView($_GET['id_usuario']);
    default:
        $home->home();
        break;
}

class HomeController
{
    protected $UsuarioModel;

    public function __construct()
    {
        $this->UsuarioModel = new UsuarioModel();
    }

    public function home()
    {
        header('Location: ../views/home/dashboard.php');
        exit;
    }

    public function PacientePerfilView($id_usuario)
    {
        $paciente = $this->UsuarioModel->find($id_usuario);
        include '../views/paciente/perfil/pacientePerfil.php';
        exit;
    }
}