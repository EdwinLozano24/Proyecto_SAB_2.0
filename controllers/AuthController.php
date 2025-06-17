<?php
require_once __DIR__ . '/../models/UsuarioModel.php';
//Variables para recibir 'accion'
$auth = new AuthController();
$accion = $_GET['accion'] ?? 'index';

switch($accion) {
    case 'Login':
        $auth->login();
        break;
    default:
        $auth->index();
        break;
}

class AuthController
{
    protected $AuthModel;
    //Definimos el modelo
    public function __construct()
    {
        $this->AuthModel = new AuthModel();
    }
    //Redireccion a vista default 'INDEX'
    public function index()
    {
        header('Location: ../views/usuario/loginRegister.php');
        exit;
    }
    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usua_documento = $_POST['usua_documento'] ?? '';
            $usua_password = $_POST['usua_password'] ?? '';

            if (empty($usua_documento) || empty($usua_password)){
                header('Location: ../views/usuario/loginRegister.php?error=1');
                exit;
            }

            $usuario=$this->AuthModel->getUser($usua_documento);

            if($usuario && password_verify($usua_password, $usuario['password'])) {
                session_start();
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['usua_documemto'] = $usuario['usua_documento'];
                $_SESSION['usua_tipo'] = $usuario['usua_tipo'];

                header('Location: ../views/home/dashboard.php');
                exit;
            } else {
                header('Location: ../views/usuario/loginRegister.php?error=1');
                exit;
            }
        }
    } 
}

//Login paciente
if (isset($_POST['loginUsuario'])) {
    $user = $usuario->loginUsuario($_POST['usua_documento'], $_POST['usua_password']);
    if ($user) {
        $_SESSION['usuario'] = $user;
        switch ($user['usua_tipo']) {
            case 'Paciente':
                header('Location: ../views/home/dashboard.php');
                break;
            case 'Empleados':
                header('Location: ../views/user/dashboard.php');
                break;
            case 'Especialista':
                header('Location: ../views/home/dashboard.php');
                break;
            case 'Administrador':
                header('Location: ../views/home/dashboard.php');
                break;
            }
    } else {
        echo "Credenciales incorrectas.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['paci_num_documento'])) {
    $usuarios = $usuario->indexPaciente(); 
    include '../views/usuario/indexPaciente.php'; 

// Acción para ver los detalles de un usuario (read)
} elseif (isset($_GET['paci_num_documento'])) {
    $usuarioDetalle = $usuario->readPaciente($_GET['paci_num_documento']); 
    include '../views/usuario/readPaciente.php'; 
}
