<?php
require_once __DIR__ . '/../models/CitaModel.php';
//Variables para recibir 'accion'
$cita = new CitaController();
$accion = $_GET['accion'] ?? 'index';

switch ($accion) {
    case 'create':
        $cita->create();
        break;
    case 'index':
        $cita->index();
        break;
    case 'store':
        $cita->store();
        break;
}


class CitaController
{
    protected $model;
    public function __construct()
    {
        $this->model = new CitaModel();
    }
    public function index()
    {
        require_once __DIR__ . '/../views/citas/citaIndex.php';
    }
    //Funcion para redirigir vista 'citaStore.php'
    public function create()
    {
        require_once __DIR__ . '/../views/citas/citaStore.php';
    }
    //Funcion para generar cita
    public function store()
    {
        $data = [
            'cita_usuario' => $_POST['cita_usuario'] ?? null,
            'cita_especialista' => $_POST['cita_especialista'] ?? null,
            'cita_fecha' => $_POST['cita_fecha'] ?? null,
            'cita_hora' => $_POST['cita_hora'] ?? null,
            'cita_consultorio' => $_POST['cita_consultorio'] ?? null,
            'cita_motivo' => $_POST['cita_motivo'] ?? null,
            'cita_observacion' => $_POST['cita_observacion'] ?? null,
            'cita_estado' => $_POST['cita_estado'] ?? null,
            'cita_tratamiento' => $_POST['cita_tratamiento'] ?? null,
        ];

        try{
            $this->model->store($data);
            header('Location: CitaController.php?accion=index');
            exit;
        } catch (\Exception $exception){
            echo 'Ocurrio un error al generar la cita. Intentalo nuevamente mas tarde (:c)';
            require_once __DIR__ . '/../views/citas/citaIndex.php';
            return;
        }
    }
}