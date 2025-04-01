<?php
require_once 'controllers/PqrController.php';

$controller = new PqrController();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'eliminar':
            $controller->eliminarPqr();
            break;
        case 'datos':
            $controller->datosPaciente();
            break;
        case 'informacion':
            $controller->infoSolicitud();
            break;
        default:
            $controller->home();
    }
} else {
    $controller->home();
}
?>