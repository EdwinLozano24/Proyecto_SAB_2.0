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
    case 'homePaciente':
        $home->homePaciente();
        break;
    case 'homeEspecialista':
        $home->homeEspecialista();
        break;
    case 'homeAgendarCita':
        $home->homeAgendarCita();
        break;
    case 'pacientePerfil':
        $home->pacientePerfil($_GET['id_usuario']);
        break;
    case 'especialistaPerfil':
        $home->especialistaPerfil($_GET['id_usuario']);
        break;
    case 'homeAdministrador':
        $home->homeAdministrador();
        break;
    default:
        $home->homeAdministrador();
        break;
}

class HomeController
{
    protected $UsuarioModel;

    public function __construct()
    {
        $this->UsuarioModel = new UsuarioModel();
    }

    public function homeAdministrador()
    {
        
        header('Location: ../views/administrador/home/admin_dashboard.php');
        exit;
    } 

    // Vista del home del paciente para que lo mande a esta
    public function homePaciente()
    {
        header('Location: ../views/paciente/home/paciente_dashboard.php');
        exit;
    }

    public function homeEspecialista()
    {
        header('Location: ../views/especialista/home/especialista_dashboard.php');
        exit;
    }

    // Vista de citaAgendar.php para que cuando el paciente pulse el boton agendar cita lo mande a dicha vista
    public function homeAgendarCita()
    {
        header('Location: ../views/cita/citaAgendar.php');
        exit;
    }
    
    public function pacientePerfil($id_usuario)
    {
        $paciente = $this->UsuarioModel->find($id_usuario);
        include '../views/.general/perfil/pacientePerfil.php';
        exit;
    }

    public function especialistaPerfil($id_usuario)
    {
        $paciente = $this->UsuarioModel->find($id_usuario);
        include '../views/.general/perfil/especialistaPerfil.php';
        exit;
    }



}