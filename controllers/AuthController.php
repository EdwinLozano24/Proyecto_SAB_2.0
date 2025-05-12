<?php
require_once '../models/Usuario.php';
require_once '../config/database.php';

$usuario = new Usuario($pdo);

//Registro paciente
if (isset($_POST['registrar']))
{
    $data = [
        'paci_num_documento' => $_POST['paci_num_documento'],
        'paci_nombre' => $_POST['paci_nombre'],
        'paci_correo_electronico' => $_POST['paci_correo_electronico'],
        'paci_password' => $_POST['paci_password'],
        'paci_direccion' => $_POST['paci_direccion'],
        'paci_fecha_nacimiento' => $_POST['paci_fecha_nacimiento'],
        'paci_num_acudiente' => $_POST['paci_num_acudiente'],
        'paci_eps' => $_POST['paci_eps'],
        'paci_sexo' => $_POST['paci_sexo'],
        'paci_rh' => $_POST['paci_rh'],
        'paci_tipo_documento' => $_POST['paci_tipo_documento'],
    ];
    $usuario->registrarUsuario($data);
    header('Location: ../views/usuario/login.php');
    exit;
}