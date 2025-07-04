<?php
require_once __DIR__ . '/../models/TratamientoModel.php';
require_once __DIR__ . '/../models/CategoriaModel.php';

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
        break;
    default:
        $tratamiento->index();
        break;
}

class TratamientoController
{
    protected $TratamientoModel;
    protected $CategoriaModel;

    public function __construct()
    {
        $this->TratamientoModel = new TratamientoModel();
        $this->CategoriaModel = new CategoriaModel();
    }

    public function index()
    {
        header ('Location: ../views/tratamiento/tratamientoIndex.php');
        exit;
    }

    public function view_store()
    {
        header ('Location: ../views/tratamiento/tratamientoStore.php');
        exit;
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'trat_codigo' => $_POST['trat_codigo'] ?? null,
            'trat_nombre' => $_POST['trat_nombre'] ?? null,
            'trat_categoria' => $_POST['trat_categoria'] ?? null,
            'trat_duracion_minutos' => $_POST['trat_duracion_minutos'] ?? null,
            'trat_riesgos' => $_POST['trat_riesgos'] ?? null,
            'trat_duracion' => $_POST['trat_duracion'] ?? null,
            'trat_descripcion' => $_POST['trat_descripcion'] ?? null,
            'trat_complejidad' => $_POST['trat_complejidad'] ?? null,
            'trat_estado' => $_POST['trat_estado'] ?? null,
        ];

            try {
                $this->TratamientoModel->store($data);
                header('Location: ../controllers/TratamientoController.php?accion=index');
                exit;
            } catch (Exception $e) {
                echo "Error al guardar el tratamiento: " . $e->getMessage();
            }
        }
    }

    public function view_update($id_tratamiento)
    {
        $trat = $this->TratamientoModel->find($id_tratamiento);
        $cate = $this->CategoriaModel->findAll();
        include '../views/tratamiento/tratamientoUpdate.php';
        exit;
    }

    public function update()
    {
        $data = 
        [
            'id_tratamiento' => $_POST['id_tratamiento'] ?? null,
            'trat_codigo' => $_POST['trat_codigo'] ?? null,
            'trat_nombre' => $_POST['trat_nombre'] ?? null,
            'trat_categoria' => $_POST['trat_categoria'] ?? null,
            'trat_duracion_minutos' => $_POST['trat_duracion_minutos'] ?? null,
            'trat_riesgos' => $_POST['trat_riesgos'] ?? null,
            'trat_duracion' => $_POST['trat_duracion'] ?? null,
            'trat_descripcion' => $_POST['trat_descripcion'] ?? null,
            'trat_complejidad' => $_POST['trat_complejidad'] ?? null,
            'trat_estado' => $_POST['trat_estado'] ?? null,
        ];
        try {
            $this->TratamientoModel->update($data);
            header('Location: ../controllers/tratamientoController.php?accion=index');
            exit;
        } catch (\Exception $e) {
            echo '[Ocurrio un error al ACTUALIZAR el TRATAMIENTO (Estamos trabajando para soluctionarlo)]';
            return;
        }
    }

    public function delete($id_tratamiento)
    {
        try {
            $this->TratamientoModel->delete($id_tratamiento);
            header('Location: ../views/tratamiento/tratamientoIndex.php');
            exit;
        } catch (\Exception $exception) {
            echo '[Ocurrio un error al ELIMINAR el TRATAMIENTO (Estamos trabajando para soluctionarlo)]';
            return;
        }
    }
}
