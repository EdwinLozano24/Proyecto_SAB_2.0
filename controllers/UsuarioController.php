<?php
require_once __DIR__ . '/../app/services/MailService.php';
require_once __DIR__ . '/../models/UsuarioModel.php';
require_once __DIR__ . '/../vendor/autoload.php';

use app\services\MailService;

//Variables para recibir 'accion'
$usuario = new UsuarioController();
$accion = $_GET['accion'] ?? 'Login';

switch ($accion) {
    case 'view_store':
        $usuario->view_store();
        break;
    case 'store':
        $usuario->store();
        break;
    case 'view_update':
        $usuario->view_update($_GET['id_usuario']);
        break;
    case 'update':
        $usuario->update();
        break;
    case 'delete':
        $usuario->delete($_GET['id_usuario']);
    case 'Login':
        $usuario->login();
        break;
    default:
        $usuario->index();
        break;
}

class UsuarioController
{
    protected $UsuarioModel;
    private MailService $mailer;
    private array $config;
    //Definimos el modelo
    public function __construct()
    {
        $this->config = require __DIR__ . '/../config/configmailer.php';
        date_default_timezone_set($this->config['app_timezone'] ?? 'America/Bogota');
        $this->UsuarioModel = new UsuarioModel();
        $this->mailer = new MailService($this->config);

    }
    //Redireccion a vista default 'INDEX'
    public function index()
    {
        header('Location: ../views/administrador/usuario/usuarioIndex.php');
        exit;
    }
    public function login()
    {
        header('Location: ../views/.general/usuario/LoginRegister.php');
        exit;
    }
    //Redireccion a vista crear usuario 'STORE'
    public function view_store()
    {
        header('Location: ../views/administrador/usuario/usuarioStore.php');
        exit;
    }
    //Funcion para generar USUARIO
    public function store()
    {
        $data = [
            'usua_nombre' => $_POST['usua_nombre'] ?? null,
            'usua_documento' => $_POST['usua_documento'] ?? null,
            'usua_tipo_documento' => $_POST['usua_tipo_documento'] ?? null,
            'usua_correo_electronico' => $_POST['usua_correo_electronico'] ?? null,
            'usua_direccion' => $_POST['usua_direccion'] ?? null,
            'usua_num_contacto' => $_POST['usua_num_contacto'] ?? null,
            'usua_num_secundario' => $_POST['usua_num_secundario'] ?? null,
            'usua_fecha_nacimiento' => $_POST['usua_fecha_nacimiento'] ?? null,
            'usua_sexo' => $_POST['usua_sexo'] ?? null,
            'usua_rh' => $_POST['usua_rh'] ?? null,
            'usua_eps' => $_POST['usua_eps'] ?? null,
            'usua_password' => password_hash($_POST['usua_password'] ?? '', PASSWORD_DEFAULT),
            'usua_tipo' => $_POST['usua_tipo'] ?? 'Paciente',
            'usua_estado' => $_POST['usua_estado'] ?? 'Activo',
        ];
        $origen = $_POST['origen_formulario'] ?? 'Usuario';
        try {
            $this->UsuarioModel->store($data);
                $usuarioGuardado = $this->UsuarioModel->findCorreo($data['usua_correo_electronico']);
                    if ($usuarioGuardado) {
                        $this->mailer->send(
                            $data['usua_correo_electronico'],
                            'Bienvenido',
                            'welcome_user',
                            ['usuario' => $usuarioGuardado, 'app_url' => $this->config['app_url']]
                            );
                    }   
                    header('Location: ../views/.general/usuario/loginRegister.php');
                    exit;

        } catch (\Exception $e) {
            error_log("Error al registrar usuario: " . $e->getMessage());
            echo "Ocurrió un error al registrar el usuario.";
        }
    
    }
    //Redireccion a vista editar usuario 'UPDATE'
    public function view_update($id_usuario)
    {
        $usua = $this->UsuarioModel->find($id_usuario);
        include '../views/administrador/usuario/usuarioUpdate.php';
        exit;
    }
    //Funcion para actualizar USUARIO
    public function update()
    {
        $data = [
            'usua_nombre' => $_POST['usua_nombre'] ?? null,
            'usua_documento' => $_POST['usua_documento'] ?? null,
            'usua_tipo_documento' => $_POST['usua_tipo_documento'] ?? null,
            'usua_correo_electronico' => $_POST['usua_correo_electronico'] ?? null,
            'usua_direccion' => $_POST['usua_direccion'] ?? null,
            'usua_num_contacto' => $_POST['usua_num_contacto'] ?? null,
            'usua_num_secundario' => $_POST['usua_num_secundario'] ?? null,
            'usua_fecha_nacimiento' => $_POST['usua_fecha_nacimiento'] ?? null,
            'usua_sexo' => $_POST['usua_sexo'] ?? null,
            'usua_rh' => $_POST['usua_rh'] ?? null,
            'usua_eps' => $_POST['usua_eps'] ?? null,
            'usua_password' => password_hash($_POST['usua_password'] ?? '', PASSWORD_DEFAULT),
            'usua_tipo' => $_POST['usua_tipo'] ?? null,
            'usua_estado' => $_POST['usua_estado'] ?? null,
            'id_usuario' => $_POST['id_usuario'] ?? null,
        ];
        try {
            $this->UsuarioModel->update($data);
            header('Location: ../views/administrador/usuario/usuarioIndex.php');
            exit;
        } catch (\Exception $exception) {
            echo '[Ocurrio un error al ACTUALIZAR el USUARIO (Estamos trabajando para soluctionarlo)]';
            return;
        }
    }
    //Funcion para 'BORRAR' USUARIO
    public function delete($id_usuario)
    {
        try {
            $this->UsuarioModel->delete($id_usuario);
            header('Location: ../views/administrador/usuario/usuarioIndex.php');
            exit;
        } catch (\Exception $exception) {
            echo '[Ocurrio un error al ELIMINAR el USUARIO (Estamos trabajando para soluctionarlo)]';
            return;
        }
    }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
}