<?php 
require_once __DIR__ . '/../models/CitaModel.php';

$cita = new CitaController();
$accion = $_GET['accion'] ?? 'index';

switch ($accion) 
{
    case 'create':
        $cita->create();
        break;
    case 'index':
        $cita->index();
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
        
    }
    public function create()
    {
        require_once __DIR__ .'/../views/citas/citaStore.php';
    }
}