<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/HistorialModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/PacienteModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/EspecialistaModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/DiagnosticoModel.php';

$autoloadPath = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadPath)) {
    require_once $autoloadPath;
} else {
    // Fallback: intenta en la raíz pública (por si tu vendor está en /public_html/vendor)
    $alt = $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
    if (file_exists($alt)) {
        require_once $alt;
    } else {
        die('No se encontró vendor/autoload.php. Ejecuta composer install o ajusta la ruta.');
    }
}

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
    case 'solicitarHistorial':
        $historial->solicitarHistorial($_GET['id_usuario']);
        break;
    default:
        $historial->index();
        break;
}


class HistorialController
{
    protected $HistorialModel;
    protected $PacienteModel;
    protected $EspecialistaModel;
    protected $DiagnosticoModel;

    public function __construct()
    {
        $this->HistorialModel = new HistorialModel();
        $this->PacienteModel = new PacienteModel();
        $this->EspecialistaModel = new EspecialistaModel();
        $this->DiagnosticoModel = new DiagnosticoModel();
    }

    public function index()
    {
        header('Location: ../views/administrador/historial/historialIndex.php');
        exit;
    }

    public function view_store()
    {
        header('Location: /views/administrador/historial/historialStore.php');
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
            'hist_creado_por' => $_POST['hist_creado_por'] ?? null,
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
            header('Location: ../views/administrador/historial/historialIndex.php');
            exit;
        } catch (\Exception $exception) {
            echo '[Ocurrio un error al GENERAR el HISTORIAL CLINICO (Estamos trabajando para soluctionarlo)]';
            echo $exception->getMessage();
            echo "\n</pre>";

            return;
        }
    }

    public function view_update($id_historial)
    {
        $hist = $this->HistorialModel->find($id_historial);
        $espe = $this->EspecialistaModel->findAll();
        $paci = $this->PacienteModel->findAll();
        $diag = $this->DiagnosticoModel->findAll();
        include '../views/administrador/historial/historialUpdate.php';
        exit;
    }

    public function update()
    {
        $data = [
            'id_historial' => $_POST['id_historial'] ?? null,
            'hist_paciente' => $_POST['hist_paciente'] ?? null,
            'hist_antecedentes_personales' => $_POST['hist_antecedentes_personales'] ?? null,
            'hist_antecedentes_familiares' => $_POST['hist_antecedentes_familiares'] ?? null,
            'hist_medicamentos_actuales' => $_POST['hist_medicamentos_actuales'] ?? null,
            'hist_alergias' => $_POST['hist_alergias'] ?? null,
            'hist_diagnostico' => $_POST['hist_diagnostico'] ?? null,
            'hist_fecha_actualizacion' => date('Y-m-d H:i:s'),
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
            header('Location: ../views/administrador/historial/historialIndex.php');
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
            header('Location: ../views/administrador/historial/historialIndex.php');
            exit;
        } catch (\Exception $exception) {
            echo '[Ocurrio un error al ELIMINAR el HISTORIAL CLINICO (Estamos trabajando para soluctionarlo)]';
            return;
        }
    }

    public function solicitarHistorial($id_usuario)
    {
        if (!$id_usuario)
        {
            echo 'No se a proporciono un usuario valido, esto puede ocurrir pq no se cuenta con una sesion iniciada.';
            header('Location: ../views/paciente/historial/historial_dashboard.php');
            exit;
        }

        $id_paciente = $this->PacienteModel->findIdPaciente($id_usuario);

        if (!$id_paciente)
        {
            echo 'No se a proporciono un paciente relacionado al usuario proporcionado, avisa a un usuario administrador.';
            header('Location: ../views/paciente/historial/historial_dashboard.php');
            exit;
        }

        $historial = $this->HistorialModel->findForPaciente($id_paciente);
        
        if(!$historial)
        {
            echo 'No se encontro un hisotrial relacionado al paciente proporcionado, avisa a un usuario administrador.';
            header('Location: ../views/paciente/historial/historial_dashboard.php');
            exit;
        }

        $pdf = new \FPDF('P', 'mm', 'A4'); // orientación, unidad, tamaño
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, "Historial Clinico del Paciente", 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 8, "Nombre: " . ($historial['paciente_nombre'] ?? 'No disponible'), 0, 1);
    $pdf->Ln(2);
    $pdf->MultiCell(0, 7, "Antecedentes Personales: " . ($historial['hist_antecedentes_personales'] ?? 'N/A'));
    $pdf->MultiCell(0, 7, "Antecedentes Familiares: " . ($historial['hist_antecedentes_familiares'] ?? 'N/A'));
    $pdf->MultiCell(0, 7, "Medicamentos: " . ($historial['hist_medicamentos_actuales'] ?? 'N/A'));
    $pdf->MultiCell(0, 7, "Alergias: " . ($historial['hist_alergias'] ?? 'N/A'));
    $pdf->Cell(0, 8, "Posee Odontograma: " . (isset($historial['hist_odontograma']) ? ($historial['hist_odontograma'] ? 'Sí' : 'No') : 'N/A'), 0, 1);
    $pdf->Cell(0, 8, "Diagnostico: " . ($historial['diagnostico_nombre'] ?? ($historial['hist_diagnostico'] ?? 'N/A')), 0, 1);
    $pdf->Cell(0, 8, "Fecha de Registro: " . ($historial['hist_fecha_registro'] ?? 'N/A'), 0, 1);
    $pdf->Cell(0, 8, "Registrado Por: " . ($historial['creado_por_nombre'] ?? 'N/A'), 0, 1);
    $pdf->Cell(0, 8, "Fecha de Actualizacion: " . ($historial['hist_fecha_actualizacion'] ?? 'N/A'), 0, 1);
    $pdf->Cell(0, 8, "Actualizado Por: " . ($historial['actualizado_por_nombre'] ?? 'N/A'), 0, 1);

    // Entregar en el navegador (I = inline, D = descargar)
    $pdf->Output('I', 'historial_paciente.pdf');
    exit;
    }


}