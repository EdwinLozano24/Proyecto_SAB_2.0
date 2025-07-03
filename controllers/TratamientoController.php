<?php
require_once __DIR__ . '/../models/TratamientoModel.php';
//Variables para recibir 'accion'
$tratamiento = new TratamientoController();
$accion = $_GET['accion'] ?? 'index';

switch ($accion) {
    case 'view_store':
        $tratamiento->view_store();
        break;
    case 'store':
        $tratamiento->store();
        break;
    case 'view_update':
        $tratamiento->view_update($_GET['id_tratamiento']);
        break;
    case 'update':
        $tratamiento->update();
        break;
    case 'delete':
        $tratamiento->delete($_GET['id_tratamiento']);
    default:
        $tratamiento->index();
        break;
}

class TratamientoController
{
    protected $TratamientoModel;

    public function __construct()
    {
        $this->TratamientoModel = new TratamientoModel(); 
    }

    public function index()
    {
        header('Location: ../views/usuario/tratamientoIndex.php');
        exit;
    }

    public function view_store()
    {
        header('Location: ../views/tratamiento/tratamientoStore.php');
        exit;
    }

    public function store()
    {

    }

    public function view_update($id_tratamiento)
    {
        $trat = $this->TratamientoModel->find($id_tratamiento);
        include '../views/tratamiento/tratamientoUpdate.php';
        exit;
    }

    public function update()
    {

    }

    public function delete($id_tratamiento)
    {
        
    }
}