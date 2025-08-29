<?php
/*----------------------------------------------------------
| RUTEO BÁSICO
----------------------------------------------------------*/
require_once __DIR__ . '/../models/PqrsModel.php';
require_once __DIR__ . '/../models/EmpleadoModel.php';
require_once __DIR__ . '/../models/UsuarioModel.php';

$controller = new PqrsController();
$action     = $_GET['accion'] ?? 'index';

switch ($action) {
    case 'view_store':
        $controller->view_store();
        break;

    case 'store':
        $controller->store();
        break;

    case 'view_update':
        $controller->view_update($_GET['id_pqrs'] ?? null);
        break;

    case 'update':
        $controller->update();
        break;

    case 'delete':
        $controller->delete($_GET['id_pqrs'] ?? null);
        break;

    case 'visualizarPqrs':
        $controller->visualizarPqrs();
        break;

    case 'responderPqrs':
        $controller->responderPqrs($_GET['id_pqrs']);
        break;
    
    case 'pacientePqrs':
        $controller->pacientePqrs($_GET['id_usuario']);
        break;

    default:
        $controller->index();
        break;
}

/*----------------------------------------------------------
| CONTROLADOR
----------------------------------------------------------*/
class PqrsController
{
    /** @var PqrsModel */
    protected $pqrsModel;
    protected $EmpleadoModel;
    protected $UsuarioModel;

    public function __construct()
    {
        $this->pqrsModel = new PqrsModel();
        $this->EmpleadoModel = new EmpleadoModel();
        $this->UsuarioModel = new UsuarioModel();
    }

    /* ---------- VISTAS ---------- */

    public function index(): void
    {
        header('Location: ../views/administrador/pqrs/pqrsIndex.php');
        exit;
    }

    public function view_store(): void
    {
        header('Location: ../views/administrador/pqrs/pqrsStore.php');
        exit;
    }

    public function view_update($id_pqrs)
    {
        $pqrs = $this->pqrsModel->find($id_pqrs);
        $empl = $this->EmpleadoModel->findAll();
        $usua = $this->UsuarioModel->findAll();
        include '../views/administrador/pqrs/pqrsUpdate.php';
        exit;
    }

    /* ---------- ACCIONES ---------- */

    public function store(): void
    {
        $data = [
            'pqrs_tipo'           => $_POST['pqrs_tipo']        ?? null,
            'pqrs_asunto'         => $_POST['pqrs_asunto']      ?? null,
            'pqrs_descripcion'    => $_POST['pqrs_descripcion'] ?? null,
            'pqrs_estado'         => $_POST['pqrs_estado']      ?? 'Pendiente',
            'pqrs_fecha_envio'    => date('Y-m-d'),
            'pqrs_respuesta'      => null,
            'pqrs_fecha_respuesta' => null,
            'pqrs_usuario'        => $_POST['pqrs_usuario']     ?? null,
            'pqrs_empleado'       => $_POST['pqrs_empleado'] ?? null,
        ];
        $origen = $_POST['origen_formulario'] ?? 'Usuario';
        try {
            $this->pqrsModel->store($data);
            if ($origen === 'Administrador') {
            header('Location: ../views/administrador/pqrs/pqrsIndex.php');
        } else {
            header('Location: ../views/paciente/home/paciente_dashboard.php');
        }
        exit;
        } catch (\Throwable $e) {
            echo '[Ocurrió un error al CREAR la PQR. Estamos trabajando para solucionarlo]';
        }
    }

    public function update(): void
    {
        $id_usuario = $_POST['pqrs_empleado'] ?? null;
        $empleado = $this->pqrsModel->findEmpleado($id_usuario);
        $data = [
            'id_pqrs'             => $_POST['id_pqrs'] ?? null,
            'pqrs_tipo'           => $_POST['pqrs_tipo']        ?? null,
            'pqrs_asunto'         => $_POST['pqrs_asunto']      ?? null,
            'pqrs_descripcion'    => $_POST['pqrs_descripcion'] ?? null,
            'pqrs_estado'         => $_POST['pqrs_estado']      ?? 'Pendiente',
            'pqrs_respuesta'      => $_POST['pqrs_respuesta']   ?? null,
            'pqrs_fecha_respuesta' => $_POST['pqrs_fecha_respuesta'] ?? date("Y-m-d H:i:s"),
            'pqrs_usuario' => $_POST['pqrs_usuario'] ?? null,
            'pqrs_empleado'       => $empleado,
        ];

        $origen = $_POST['origen_formulario'] ?? 'Administrador';

        try {
            $this->pqrsModel->update($data);

            if ($origen === 'Administrador') {
            header('Location: ../views/administrador/pqrs/pqrsIndex.php');
        } else {
            header('Location: /controllers/PqrsController.php?accion=visualizarPqrs');
        }

        exit;
        } catch (\Throwable $e) {
            echo '[Ocurrió un error al ACTUALIZAR la PQR. Estamos trabajando para solucionarlo]';
        }
    }

    public function delete(?int $id_pqrs): void
    {
        if (!$id_pqrs) {
            $this->index();
        }

        try {
            $this->pqrsModel->delete($id_pqrs);
            header('Location: ../views/administrador/pqrs/pqrsIndex.php');
            exit;
        } catch (\Throwable $e) {
            echo '[Ocurrió un error al ELIMINAR la PQR. Estamos trabajando para solucionarlo]';
        }
    }

    public function visualizarPqrs()
    {
        $pendientes = $this->pqrsModel->findPendientes();
        include '../views/especialista/pqr/visualizarPQR.php';
        exit;
    }

    public function responderPqrs($id_pqrs)
    {
        $pqrs = $this->pqrsModel->findResponder($id_pqrs);
        include '../views/especialista/pqr/responderPQR.php';
        exit;
    }

    public function pacientePqrs($id_usuario)
    {
        $pqrs = $this->pqrsModel->findUsuario($id_pqrs);
        var_dump($pqrs); exit;
    }

}