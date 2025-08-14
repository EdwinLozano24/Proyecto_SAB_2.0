<?php
require_once __DIR__ . '/../models/UsuarioModel.php';
//Variables para recibir 'accion'
$usuario = new UsuarioController();
$accion = $_GET['accion'] ?? 'index';

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
    default:
        $usuario->index();
        break;
}

class UsuarioController
{
    protected $UsuarioModel;
    //Definimos el modelo
    public function __construct()
    {
        $this->UsuarioModel = new UsuarioModel();
    }
    //Redireccion a vista default 'INDEX'
    public function index()
    {
        header('Location: ../views/usuario/usuarioIndex.php');
        exit;
    }
    //Redireccion a vista crear usuario 'STORE'
    public function view_store()
    {
        header('Location: ../views/usuario/usuarioStore.php');
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
            
            if ($origen === 'Administrador') {
                header('Location: ../../views/usuario/usuarioIndex.php');
            } else {
                header('Location: ../views/.general/usuario/loginRegister.php');
            }
            exit;
        } catch (\Exception $exception) {
            echo '[Ocurrio un error al CREAR el USUARIO (Estamos trabajando para soluctionarlo)]';
            return;
        }
    }
    //Redireccion a vista editar usuario 'UPDATE'
    public function view_update($id_usuario)
    {
        $usua = $this->UsuarioModel->find($id_usuario);
        include '../views/usuario/usuarioUpdate.php';
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
            header('Location: ../views/usuario/usuarioIndex.php');
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
            header('Location: ../views/usuario/usuarioIndex.php');
            exit;
        } catch (\Exception $exception) {
            echo '[Ocurrio un error al ELIMINAR el USUARIO (Estamos trabajando para soluctionarlo)]';
            return;
        }
    }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
}