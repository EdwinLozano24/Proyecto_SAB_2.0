<?php
/*----------------------------------------------------------
| RUTEO BÁSICO
----------------------------------------------------------*/
require_once __DIR__ . '/../models/ConsultorioModel.php';

$controller = new ConsultorioController();
$action = $_GET['accion'] ?? 'index';

switch ($action) {
    case 'view_store';
        $controller->view_store();
        break;
    case 'store';
        $controller->store();
        break;
 
    case 'view_update';
        $controller->view_update($_GET['id_consultorio'] ?? null);
        break;
    
    case 'update';
        $controller->update();
        break;
    
    case 'delete';
        $controller->delete($_GET['id_consultorio'] ?? null);
        break;

    default:
        $controller->index();
        break;
}


/*----------------------------------------------------------
| CONTROLADOR
----------------------------------------------------------*/

class ConsultorioController
{
    protected $consultorioModel;
    public function __construct()
    {
        $this->consultorioModel = new ConsultorioModel();
    }

    /* ---------- VISTAS ---------- */
    public function index(): void {
        header('Location: ../views/consultorio/consultorioIndex.php');
        exit;
    }

    public function view_store(): void {
        header('Location: ../views/consultorio/consultorioStore.php');
        exit;
    }

    public function view_update($id_consultorio): void {
        if(!id_consultorio) {
            $this->index();
        }

        $consultorio = $this->ConsultorioModel->find(id_consultorio);
        include '../views/consultorio/consultorioUpdate.php';
        exit;
    }

/* ---------- ACCIONES ---------- */

    public function store(): void
    {
       $data = [
            'cons_numero' => $_PIST['cons_numero'] ?? null,
            'cons_estado' => $_POST['cons_estado'] ?? 'Disponible',
       ];

       try {
            $this->consultorioModel->store($data);
            header('Location: ../views/consultorio/consultorioIndex.php');
            exit;
       } catch (Exception $e) {
            echo "Error al guardar el consultorio: " . $e->getMessage();
            
       }

    }

    public function update(): void {
        $id_consultorio = $_POST['id_consultorio'] ?? null;
        if (!$id_consultorio) {
            echo '[Falta el id del consultorio]';
            return;
        }


        $data = [
            'cons_numero' => $_POST['cons_numero'] ?? null,
            'cons_estado' => $_POST['cons_estado'] ?? 'Disponible',
        ];

        try {
            $this->consultorioModel->update($data);
            header('Location: ../views/consultorio/consultorioIndex.php');
            exit;
        } catch (Exception $e) {
            echo "Error al actualizar el consultorio: " . $e->getMessage();
        }

    }

    public function delete($id_consultorio): void 
    {
        if(!$id_consultorio) {
            $this->index();
        }

        try {
            $this->consultorioModel->delete($id_consultorio);
            header('Location: ../views/consultorio/consultorioIndex.php');
            exit;
        } catch (Exception $e) {
            echo "Error al eliminar el consultorio: " . $e->getMessage();
        }
    
    }

   

}