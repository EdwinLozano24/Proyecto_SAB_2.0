<?php
class PqrsController
{
    public function home()
    {
        include 'View/Pqrs/pqrs.php';
    }

    public function eliminarPqr()
    {
        include 'View/Pqrs/eliminar_pqr.php';
    }

    public function datosPaciente()
    {
        include 'View/Pqrs/datos_paciente.php';
    }

    public function infoSolicitud()
    {
        include 'View/Pqrs/info_solicitud.php';
    }
}
