<?php
require_once __DIR__ . '/../models/CitaModel.php';
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
    //Definimos el modelo
    public function __construct()
    {
        $this->CitaModel = new CitaModel();
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
        $data = [
            'cita_paciente' => $_POST['cita_paciente'] ?? null,
            'cita_especialista' => $_POST['cita_especialista'] ?? null,
            'cita_fecha' => $_POST['cita_fecha'] ?? null,
            'cita_hora' => $_POST['cita_hora'] ?? null,
            'cita_turno' => $_POST['cita_turno'] ?? null,
            'cita_duracion'=> $_POST['cita_duracion'] ?? null,
            'cita_consultorio' => $_POST['cita_consultorio'] ?? null,
            'cita_motivo' => $_POST['cita_motivo'] ?? null,
            'cita_observacion' => $_POST['cita_observacion'] ?? null,
            'cita_estado' => $_POST['cita_estado'] ?? null,
        ];
        try {
            $this->CitaModel->store($data);
            header('Location: ../views/cita/citaIndex.php');
            exit;
        } catch (\Exception $exception) {
            echo '[Ocurrio un error al GENERAR la CITA (Estamos trabajando para soluctionarlo)]';
            return;
        }
    //Redireccion a vista editar cita 'UPDATE'
    }
    public function view_update($id_cita)
    {
        $cita = $this->CitaModel->find($id_cita);
        include '../views/cita/citaUpdate.php';
        exit;
    }
    //Funcion para actualizar CITA
    public function update()
    {
        $data = [
            'cita_paciente' => $_POST['cita_paciente'] ?? null,
            'cita_especialista' => $_POST['cita_especialista'] ?? null,
            'cita_fecha' => $_POST['cita_fecha'] ?? null,
            'cita_hora' => $_POST['cita_hora'] ?? null,
            'cita_turno' => $_POST['cita_turno'] ?? null,
            'cita_duracion'=> $_POST['cita_duracion'] ?? null,
            'cita_consultorio' => $_POST['cita_consultorio'] ?? null,
            'cita_motivo' => $_POST['cita_motivo'] ?? null,
            'cita_observacion' => $_POST['cita_observacion'] ?? null,
            'cita_estado' => $_POST['cita_estado'] ?? null,
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