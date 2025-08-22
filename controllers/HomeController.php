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
        $home->PacientePerfilView($_GET['id_usuario']);
        break;
    case 'homePaciente':
        $home->homePaciente();
        break;

    case 'homeAgendarCita':
        $home->homeAgendarCita();
        break;

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
        
        header('Location: ../views/administrador/home/admin_dashboard.php');
        exit;
    } 

    // Vista del home del paciente para que lo mande a esta
    public function homePaciente()
    {
        header('Location: ../views/paciente/home/paciente_dashboard.php');
        exit;
    }

    // Vista de citaAgendar.php para que cuando el paciente pulse el boton agendar cita lo mande a dicha vista
    public function homeAgendarCita()
    {
        header('Location: ../views/cita/citaAgendar.php');
        exit;
    }




    public function PacientePerfilView($id_usuario)
    {
        $paciente = $this->UsuarioModel->find($id_usuario);
        include '../views/.general/perfil/pacientePerfil.php';
        exit;
    }
}