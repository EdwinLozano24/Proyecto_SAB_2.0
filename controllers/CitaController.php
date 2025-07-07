<?php
require_once __DIR__ . '/../models/CitaModel.php';
require_once __DIR__ . '/../models/PacienteModel.php';
require_once __DIR__ . '/../models/EspecialistaModel.php';
require_once __DIR__ . '/../models/ConsultorioModel.php';
require_once __DIR__ . '/../models/TratamientoModel.php';
//Variables para recibir 'accion'
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
    //Definimos el modelo
    public function __construct()
    {
        $this->CitaModel = new CitaModel();
        $this->PacienteModel = new PacienteModel();
        $this->EspecialistaModel = new EspecialistaModel();
        $this->ConsultorioModel = new ConsultorioModel();
        $this->TratamientoModel = new TratamientoModel();
    }
    //Redireccion a vista default 'INDEX'
    public function index()
    {
        header('Location: ../views/cita/citaIndex.php');
        exit;
    }
    //Redireccion a vista crear cita 'STORE'
    public function view_store()
    {
        header('Location: ../views/cita/citaStore.php');
        exit;
    }
    //Funcion para generar CITA
    public function store()
    {
        $cita_hora_inicio = $_POST['cita_hora_inicio'] ?? null;
        $cita_hora_fin = $_POST['cita_hora_fin'] ?? null;
        $cita_duracion = null;
        $cita_turno = null;

        if ($cita_hora_inicio && $cita_hora_fin) {
            $cita_duracion = (strtotime($cita_hora_fin) - strtotime($cita_hora_inicio)) / 60; // en minutos
        }

        $hora_sola = date('H:i', strtotime($cita_hora_inicio));
        if ($hora_sola >= '08:00' && $hora_sola <= '12:00') {
            $cita_turno = 'Mañana';
        } elseif ($hora_sola > '12:00' && $hora_sola <= '18:00') {
            $cita_turno = 'Tarde';
        }
        
        $data = [
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
            $this->CitaModel->store($data);
            header('Location: ../views/cita/citaIndex.php');
            exit;
        } catch (\Exception $exception) {
            echo "Mensaje: " . $exception->getMessage() . "<br>";
            echo "Línea: " . $exception->getLine() . "<br>";
            echo '[Ocurrio un error al GENERAR la CITA (Estamos trabajando para soluctionarlo)]';
            return;
        }
        //Redireccion a vista editar cita 'UPDATE'
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
    //Funcion para actualizar CITA
    public function update()
    {
        $cita_hora_inicio = $_POST['cita_hora_inicio'] ?? null;
        $cita_hora_fin = $_POST['cita_hora_fin'] ?? null;
        $cita_duracion = null;
        $cita_turno = null;

        if ($cita_hora_inicio && $cita_hora_fin) {
            $cita_duracion = (strtotime($cita_hora_fin) - strtotime($cita_hora_inicio)) / 60; // en minutos
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
        } catch (\Exception $e) {
            echo '[Ocurrio un error al ACTUALIZAR la CITA (Estamos trabajando para soluctionarlo)]';
            return;
        }
    }
    //Funcion para 'BORRAR'
    public function delete($id_cita)
    {
        try {
            $this->CitaModel->delete($id_cita);
            header('Location: ../views/cita/citaIndex.php');
            exit;
        } catch (\Exception $exception) {
            echo '[Ocurrio un error al ELIMINAR la CITA (Estamos trabajando para soluctionarlo)]';
            return;
        }
    }
}