<?php
class PqrController
{
    public function home()
    {
        include 'views/home.php';
    }

    public function eliminarPqr()
    {
        include 'views/eliminar_pqr.php';
    }

    public function datosPaciente()
    {
        include 'views/datos_paciente.php';
    }

    public function infoSolicitud()
    {
        include 'views/info_solicitud.php';
    }
}
