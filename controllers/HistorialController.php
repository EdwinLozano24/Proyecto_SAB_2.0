<?php
require_once __DIR__ . '/../models/HistorialModel.php';
require_once __DIR__ . '/../models/PacienteModel.php';
require_once __DIR__ . '/../models/EmpleadoModel.php';
require_once __DIR__ . '/../models/DiagnosticoModel.php';
$historial = new HistorialController();
$accion = $_GET['accion'] ?? 'index';

switch ($accion) {
    case 'view_store':
        $historial->view_store();
        break;
    case 'store':
        $historial->store();
        break;
    case 'view_update':
        $historial->view_update($_GET['id_historial']);
        break;
    case 'update':
        $historial->update();
        break;
    case 'delete':
        $historial->delete($_GET['id_historial']);
    default:
        $historial->index();
        break;
}

class HistorialController
{
    protected $HistorialModel;
    protected $PacienteModel;
    protected $EmpleadoModel;
    protected $DiagnosticoModel;

    public function __construct()
    {
        $this->HistorialModel = new HistorialModel();
        $this->PacienteModel = new PacienteModel();
        $this->EmpleadoModel = new EmpleadoModel();
        $this->DiagnosticoModel = new DiagnosticoModel();
    }

    public function index()
    {
        header('Location: ../views/historial/historialIndex.php');
        exit;
    }

    public function view_store()
    {
        header('Location: ../views/historial/historialStore.php');
        exit;
    }

    public function store()
    {
        $data = [
            'hist_paciente' => $_POST['hist_paciente'] ?? null,
            'hist_antecedentes_personales' => $_POST['hist_antecedentes_personales'] ?? null,
            'hist_antecedentes_familiares' => $_POST['hist_antecedentes_familiares'] ?? null,
            'hist_medicamentos_actuales' => $_POST['hist_medicamentos_actuales'] ?? null,
            'hist_alergias' => $_POST['hist_alergias'] ?? null,
            'hist_diagnostico' => $_POST['hist_diagnostico'] ?? null,
            'hist_fecha_registro' => date('Y-m-d H:i:s'),
            'hist_fecha_actualizacion' => date('Y-m-d H:i:s'),
            'hist_creado_por' => $_POST['hist_creado_por'] ?? null,
            'hist_actualizado_por' => $_POST['hist_actualizado_por'] ?? null,
            'hist_odontograma' => $_POST['hist_odontograma'] ?? null,
            'hist_indice_dmft' => $_POST['hist_indice_dmft'] ?? null,
            'hist_frecuencia_cepillado' => $_POST['hist_frecuencia_cepillado'] ?? null,
            'hist_hilo_dental' => $_POST['hist_hilo_dental'] ?? null,
            'hist_enjuague_bucal' => $_POST['hist_enjuague_bucal'] ?? null,
            'hist_sensibilidad_dental' => $_POST['hist_sensibilidad_dental'] ?? null,
            'hist_estado' => $_POST['hist_estado'] ?? 'Activo',
        ];
        try {
            $this->HistorialModel->store($data);
            header('Location: ../views/historial/historialIndex.php');
            exit;
        } catch (\Exception $exception) {
            echo '[Ocurrio un error al GENERAR el HISTORIAL CLINICO (Estamos trabajando para soluctionarlo)]';
            return;
        }
    }

    public function view_update($id_historial)
    {
        $hist = $this->HistorialModel->find($id_historial);
        $empl = $this->EmpleadoModel->findAll();
        $paci = $this->PacienteModel->findAll();
        $diag = $this->DiagnosticoModel->findAll();
        include '../views/historial/historialUpdate.php';
        exit;
    }

    public function update()
    {
        $data = [
            'hist_paciente' => $_POST['hist_paciente'] ?? null,
            'hist_antecedentes_personales' => $_POST['hist_antecedentes_personales'] ?? null,
            'hist_antecedentes_familiares' => $_POST['hist_antecedentes_familiares'] ?? null,
            'hist_medicamentos_actuales' => $_POST['hist_medicamentos_actuales'] ?? null,
            'hist_alergias' => $_POST['hist_alergias'] ?? null,
            'hist_diagnostico' => $_POST['hist_diagnostico'] ?? null,
            'hist_fecha_registro' => date('Y-m-d H:i:s'),
            'hist_fecha_actualizacion' => date('Y-m-d H:i:s'),
            'hist_creado_por' => $_POST['hist_creado_por'] ?? null,
            'hist_actualizado_por' => $_POST['hist_actualizado_por'] ?? null,
            'hist_odontograma' => $_POST['hist_odontograma'] ?? null,
            'hist_indice_dmft' => $_POST['hist_indice_dmft'] ?? null,
            'hist_frecuencia_cepillado' => $_POST['hist_frecuencia_cepillado'] ?? null,
            'hist_hilo_dental' => $_POST['hist_hilo_dental'] ?? null,
            'hist_enjuague_bucal' => $_POST['hist_enjuague_bucal'] ?? null,
            'hist_sensibilidad_dental' => $_POST['hist_sensibilidad_dental'] ?? null,
            'hist_estado' => $_POST['hist_estado'] ?? 'Activo',
        ];
        try {
            $this->HistorialModel->update($data);
            header('Location: ../views/historial/historialIndex.php');
            exit;
        } catch (\Exception $e) {
            echo '[Ocurrio un error al ACTUALIZAR el HISTORIAL CLINICO (Estamos trabajando para soluctionarlo)]';
            return;
        }
    }

    public function delete($id_historial)
    {
        try {
            $this->HistorialModel->delete($id_historial);
            header('Location: ../views/historial/historialIndex.php');
            exit;
        } catch (\Exception $exception) {
            echo '[Ocurrio un error al ELIMINAR el HISTORIAL CLINICO (Estamos trabajando para soluctionarlo)]';
            return;
        }
    }
}