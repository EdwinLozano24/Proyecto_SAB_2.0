<?php
require_once __DIR__ . '/../models/DiagnosticoModel.php';
require_once __DIR__ . '/../models/TratamientoModel.php';

$diagnostico = new DiagnosticoController();
$accion = $_GET['accion'] ?? 'index';

switch ($accion) {
    case 'view_store':
        $diagnostico->view_store();
        break;
    case 'store':
        $diagnostico->store();
        break;
    case 'view_update':
        $diagnostico->view_update($_GET['id_diagnostico']);
        break;
    case 'update':
        $diagnostico->update();
        break;
    case 'delete':
        $diagnostico->delete($_GET['id_diagnostico']);
        break;
    default:
        $diagnostico->index();
        break;
}

class DiagnosticoController
    {
        protected $DiagnosticoModel;
        protected $TratamientoModel;
    
    public function __construct()
    {
        $this->DiagnosticoModel = new DiagnosticoModel ();
        $this->TratamientoModel = new TratamientoModel ();
    }

    public function index()
    {
        header ('Location: ../views/diagnostico/diagnosticoIndex.php');
        exit;
    }

    public function view_store()
    {
        header ('Location: ../views/diagnostico/diagnosticoStore.php');
        exit;
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'diag_nombre' => $_POST['diag_nombre'] ?? null,
            'diag_descripcion' => $_POST['diag_descripcion'] ?? null,
            'diag_tratamiento' => $_POST['diag_tratamiento'] ?? null,
            'diag_estado' => $_POST['diag_estado'] ?? null,
        ];

            try {
                $this->DiagnosticoModel->store($data);
                header('Location: ../controllers/DiagnosticoController.php?accion=index');
                exit;
            } catch (Exception $e) {
                echo "Error al guardar el Diagnostico: " . $e->getMessage();
            }
        }
    }

    public function view_update($id_diagnostico)
    {
        $diag = $this->DiagnosticoModel->find($id_diagnostico);
        $trat = $this->TratamientoModel->findAll();
        include '../views/diagnostico/diagnosticoUpdate.php';
        exit;
    }

        public function update()
    {
        $data = 
        [
            'id_diagnostico' => $_POST['id_diagnostico'] ?? null,
            'diag_nombre' => $_POST['diag_nombre'] ?? null,
            'diag_descripcion' => $_POST['diag_descripcion'] ?? null,
            'diag_tratamiento' => $_POST['diag_tratamiento'] ?? null,
            'diag_estado' => $_POST['diag_estado'] ?? null,
        ];
        try {
            $this->DiagnosticoModel->update($data);
            header('Location: ../controllers/DiagnosticoController.php?accion=index ');
            exit;
        } catch (\Exception $e) {
            echo '[Ocurrio un error al ACTUALIZAR el diagnostico (Estamos trabajando para soluctionarlo)]';
            return;
        }
    }

    public function delete($id_diagnostico)
    {
        try {
            $this->DiagnosticoModel->delete($id_diagnostico);
            header('Location: ../controllers/DiagnosticoController.php?accion=index');
            exit;
        } catch (\Exception $exception) {
            echo '[Ocurrio un error al ELIMINAR el diagnostico (Estamos trabajando para soluctionarlo)]';
            return;
        }
    }
}

