<?php
require_once __DIR__ . '/../models/AuthModel.php';
//Variables para recibir 'accion'
$auth = new AuthController();
$accion = $_GET['accion'] ?? 'index';

switch ($accion) {
    case 'Login':
        $auth->login();
        break;
    case 'Logout':
        $auth->logout();
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
        header('Location: ../views/.general/usuario/loginRegister.php');
        exit;
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usua_documento = trim($_POST['usua_documento'] ?? '');
            $usua_password = trim($_POST['usua_password'] ?? '');

            if ($usua_documento === '' || $usua_password === '') {
                header('Location: ../views/.general/error/acceso_denegado.php');
                exit;
            }

            $usuario = $this->AuthModel->getUser($usua_documento);

            if ($usuario && password_verify($usua_password, $usuario['usua_password'])) {
                session_start();
                $_SESSION['usuario'] = [
                'id_usuario' => $usuario['id_usuario'],
                'usua_nombre' => $usuario['usua_nombre'],
                'usua_documento' => $usuario['usua_documento'],
                'usua_tipo' => $usuario['usua_tipo']
            ];

            switch ($usuario['usua_tipo']) {
                case 'Administrador':
                    header('Location: ../views/administrador/home/admin_dashboard.php');
                    break;
                case 'Especialista':
                    header('Location: ../views/home/especialista_dashboard.php');
                    break;
                case 'Empleado':
                    header('Location: ../views/home/empleado_dashboard.php');
                    break;
                case 'Paciente':
                    header('Location: ../views/paciente/home/paciente_dashboard.php');
                    break;
                default:
                    header('Location: ../views/.general/error/acceso_denegado.php');
                    break;
            }
                exit;
            } else {
                header('Location: ../views/.general/error/acceso_denegado.php');
                exit;
            }
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        header('Location: ../views/.general/usuario/loginRegister.php');
        exit;
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
