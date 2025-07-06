<?php
require_once __DIR__ . '/../models/EmpleadoModel.php';
//Variables para recibir 'accion'
$empleado = new EmpleadoController();
$accion = $_GET['accion'] ?? 'index';


switch ($accion) {
    case 'view_store':
        $empleado->view_store();
        break;
    case 'store':
        $empleado->store();
        break;
    case 'view_update':
        $empleado->view_update($_GET['id_empleado']);
        break;
    case 'update':
        $empleado->update();
        break;
    case 'delete':
        $empleado->delete($_GET['id_empleado']);
    default:
        $empleado->index();
        break;
}


class EmpleadoController
{
    protected $EmpleadoModel;
    //Definimos el modelo
    public function __construct()
    {
        $this->EmpleadoModel = new EmpleadoModel();
    }
    //Redireccion a vista default 'INDEX'
    public function index()
    {
        header('Location: ../views/empleados/empleadoIndex.php');
        exit;
    }
    //Redireccion a vista crear Empleado 'STORE'
    public function view_store()
    {
        header('Location: ../views/empleados/empleadoStore.php');
        exit;
    }
    //Funcion para generar Empleado
    public function store()
    {
        $data = [
            'empl_usuario' => $_POST['empl_usuario'] ?? null,
            'empl_fecha_ingreso' => $_POST['empl_fecha_ingreso'] ?? date('Y-m-d'),
            'empl_rol' => $_POST['empl_rol'] ?? null,
            'empl_descripcion_especifica' => $_POST['empl_descripcion_especifica'] ?? 'N/A',
            'empl_estado' => $_POST['empl_estado'] ?? 'Activo',
        ];

        try {
            $this->EmpleadoModel->store($data);
            header('Location: ../views/empleados/empleadoIndex.php');
            exit;
        } catch (\Exception $exception) {
            echo "Mensaje: " . $exception->getMessage() . "<br>";
            echo "Línea: " . $exception->getLine() . "<br>";
            echo '[Ocurrio un error al GENERAR el Empleado (Estamos trabajando para soluctionarlo)]';
            return;
        }
    }
    //Redireccion a vista editar EMPLEADO 'UPDATE'
    public function view_update($id_empleado)
    {
        $cons = $this->EmpleadoModel->find($id_empleado);   // el empleado actual
        $consAll = $this->EmpleadoModel->findAll();         // todos los empleados
        include '../views/empleados/empleadoUpdate.php';
        exit;
    }

 
    //Funcion para actualizar EMPLEADO
    public function update()
    {
        $data = [
            'empl_usuario' => $_POST['empl_usuario'] ?? null, // id del usuario (relación con tbl_usuarios)
            'empl_fecha_ingreso' => $_POST['empl_fecha_ingreso'] ?? date('Y-m-d'), // usa la fecha actual por defecto
            'empl_rol' => $_POST['empl_rol'] ?? null, // id del rol (relación con tbl_roles)
            'empl_descripcion_especifica' => $_POST['empl_descripcion_especifica'] ?? 'N/A',
            'empl_estado' => $_POST['empl_estado'] ?? 'Activo'
        ];
        try {
            $this->EmpleadoModel->update($data);
            header('Location: ../views/empleados/empleadoIndex.php');
            exit;
        } catch (\Exception $exception) {
            echo '[Ocurrio un error al ACTUALIZAR el EMPLEADO (Estamos trabajando para soluctionarlo)]';
            return;
        }
    }

    //Funcion para 'BORRAR' EMPLEADO    
    public function delete($id_empleado)
    {
        try {
            $this->EmpleadoModel->delete($id_empleado);
            header('Location: ../views/empleados/empleadoIndex.php');
            exit;
        } catch (\Exception $exception) {
            echo "Mensaje: " . $exception->getMessage() . "<br>";
            echo "Línea: " . $exception->getLine() . "<br>";
            echo '[Ocurrio un error al ELIMINAR el EMPLEADO (Estamos trabajando para soluctionarlo)]';
            return;
        }
    }
}
