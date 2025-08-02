<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../models/CitaModel.php';
require_once __DIR__ . '/../models/PacienteModel.php';
require_once __DIR__ . '/../models/EspecialistaModel.php';
require_once __DIR__ . '/../models/ConsultorioModel.php';
require_once __DIR__ . '/../models/TratamientoModel.php';
require_once __DIR__ . '/../models/HistorialModel.php';

$cita = new CitaController();
$accion = $_GET['accion'] ?? 'index';

switch ($accion) {
    case 'view_store':
        $cita->view_store();
        break;
    case 'store':
        $cita->store();
        break;
    case 'view_update':
        $cita->view_update($_GET['id_cita']);
        break;
    case 'update':
        $cita->update();
        break;
    case 'delete':
        $cita->delete($_GET['id_cita']);
        break;
    default:
        $cita->index();
        break;
}

class CitaController
{
    protected $CitaModel;
    protected $PacienteModel;
    protected $EspecialistaModel;
    protected $ConsultorioModel;
    protected $TratamientoModel;
    protected $HistorialModel;

    public function __construct()
    {
        $this->CitaModel = new CitaModel();
        $this->PacienteModel = new PacienteModel();
        $this->EspecialistaModel = new EspecialistaModel();
        $this->ConsultorioModel = new ConsultorioModel();
        $this->TratamientoModel = new TratamientoModel();
        $this->HistorialModel = new HistorialModel();
    }

    public function index()
    {
        header('Location: ../views/cita/citaIndex.php');
        exit;
    }

    public function view_store()
    {
        header('Location: ../views/cita/citaStore.php');
        exit;
    }

    public function store()
    {
        $cita_paciente = $_POST['cita_paciente'] ?? $_SESSION['paciente_id'] ?? null;
        if (!$cita_paciente) {
            echo "Error: No se encontró sesión activa de paciente.";
            return;
        }

        $cita_hora_inicio = $_POST['cita_hora_inicio'] ?? null;
        $cita_fecha = $_POST['cita_fecha'] ?? null;
        $cita_motivo = $_POST['cita_motivo'] ?? null;
        $cita_observacion = $_POST['cita_observacion'] ?? null;
        $cita_estado = $_POST['cita_estado'] ?? 'Proceso';

        $duraciones = [
            'Consulta general' => 30,
            'Control' => 20,
            'Urgencia' => 45,
            'Seguimiento' => 25,
            'Examen' => 40,
            'Otro' => 30
        ];
        $cita_duracion = $duraciones[$cita_motivo] ?? 30;

        $inicio = strtotime($cita_hora_inicio);
        $fin = $inicio + ($cita_duracion * 60);
        $cita_hora_fin = date('H:i:s', $fin);

        $hora_sola = date('H:i', $inicio);
        if ($hora_sola >= '08:00' && $hora_sola <= '12:00') {
            $cita_turno = 'Mañana';
        } elseif ($hora_sola > '12:00' && $hora_sola <= '18:00') {
            $cita_turno = 'Tarde';
        } else {
            $cita_turno = 'Otro';
        }

        $historial = $this->HistorialModel->findByPaciente($cita_paciente);
        if (!$historial) {
            echo "Este paciente aún no tiene historial clínico registrado.";
            return;
        }
        $cita_historial = $historial['id_historial'];

        $asignarAuto = $_POST['asignacion_automatica'] ?? null;
        if ($asignarAuto == '1') {
            $especialistas = $this->EspecialistaModel->findAll();
            $id_especialista = null;
            foreach ($especialistas as $esp) {
                if ($this->CitaModel->verificarDisponibilidad($esp['id_especialista'], $cita_fecha, $cita_hora_inicio, $cita_hora_fin)) {
                    $id_especialista = $esp['id_especialista'];
                    break;
                }
            }

            $consultorios = $this->ConsultorioModel->findAll();
            $id_consultorio = null;
            foreach ($consultorios as $cons) {
                if ($this->CitaModel->verificarConsultorio($cons['id_consultorio'], $cita_fecha, $cita_hora_inicio, $cita_hora_fin)) {
                    $id_consultorio = $cons['id_consultorio'];
                    break;
                }
            }

            if (!$id_especialista || !$id_consultorio) {
                echo "No hay disponibilidad de especialista o consultorio.";
                return;
            }
        } else {
            $id_especialista = $_POST['cita_especialista'] ?? null;
            $id_consultorio = $_POST['cita_consultorio'] ?? null;
        }

        $data = [
            'cita_paciente' => $cita_paciente,
            'cita_historial' => $cita_historial,
            'cita_especialista' => $id_especialista,
            'cita_fecha' => $cita_fecha,
            'cita_hora_inicio' => $cita_hora_inicio,
            'cita_hora_fin' => $cita_hora_fin,
            'cita_turno' => $cita_turno,
            'cita_duracion' => $cita_duracion,
            'cita_consultorio' => $id_consultorio,
            'cita_motivo' => $cita_motivo,
            'cita_observacion' => $cita_observacion,
            'cita_estado' => $cita_estado,
        ];

        try {
            $this->CitaModel->store($data);
            header('Location: ../views/cita/citaIndex.php?mensaje=Cita creada exitosamente');
            exit;
        } catch (Exception $e) {
            echo "Error al crear la cita: " . $e->getMessage();
            return;
        }
    }

    public function view_update($id_cita)
    {
        $cita = $this->CitaModel->find($id_cita);
        $paci = $this->PacienteModel->findAll();
        $espe = $this->EspecialistaModel->findAll();
        $cons = $this->ConsultorioModel->findAll();
        $trat = $this->TratamientoModel->findAll();
        include '../views/cita/citaUpdate.php';
        exit;
    }

    public function update()
    {
        $cita_hora_inicio = $_POST['cita_hora_inicio'] ?? null;
        $cita_hora_fin = $_POST['cita_hora_fin'] ?? null;
        $cita_duracion = null;
        $cita_turno = null;

        if ($cita_hora_inicio && $cita_hora_fin) {
            $cita_duracion = (strtotime($cita_hora_fin) - strtotime($cita_hora_inicio)) / 60;
        }

        $hora_sola = date('H:i', strtotime($cita_hora_inicio));
        if ($hora_sola >= '06:00' && $hora_sola <= '12:00') {
            $cita_turno = 'Mañana';
        } elseif ($hora_sola > '12:00' && $hora_sola <= '18:00') {
            $cita_turno = 'Tarde';
        }

        $data = [
            'id_cita' => $_POST['id_cita'] ?? null,
            'cita_paciente' => $_POST['cita_paciente'] ?? null,
            'cita_especialista' => $_POST['cita_especialista'] ?? null,
            'cita_fecha' => $_POST['cita_fecha'] ?? null,
            'cita_hora_inicio' => $cita_hora_inicio,
            'cita_hora_fin' => $cita_hora_fin,
            'cita_turno' => $cita_turno,
            'cita_duracion' => $cita_duracion,
            'cita_consultorio' => $_POST['cita_consultorio'] ?? null,
            'cita_motivo' => $_POST['cita_motivo'] ?? null,
            'cita_observacion' => $_POST['cita_observacion'] ?? null,
            'cita_estado' => $_POST['cita_estado'] ?? 'Proceso',
        ];

        try {
            $this->CitaModel->update($data);
            header('Location: ../views/cita/citaIndex.php');
            exit;
        } catch (Exception $e) {
            echo "Error al actualizar la cita: " . $e->getMessage();
            return;
        }
    }

    public function delete($id_cita)
    {
        try {
            $this->CitaModel->delete($id_cita);
            header('Location: ../views/cita/citaIndex.php');
            exit;
        } catch (Exception $e) {
            echo "Error al eliminar la cita: " . $e->getMessage();
            return;
        }
    }
}