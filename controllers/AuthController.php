<?php
require_once '../models/Usuario.php';
require_once '../config/database.php';

$usuario = new Usuario($pdo);

//Registro paciente
if (isset($_POST['registrarUsuario'])) {
    $data = [
        'usua_documento' => $_POST['paci_num_documento'],
        'usua_nombre' => $_POST['paci_nombre'],
        'usua_correo_electronico' => $_POST['paci_correo_electronico'],
        'usua_password' => $_POST['paci_password'],
        'usua_direccion' => $_POST['paci_direccion'],
        'usua_fecha_nacimiento' => $_POST['paci_fecha_nacimiento'],
        'usua_num_contacto' => $_POST['paci_num_contacto'],
        'usua_num_secundario' => $_POST['paci_num_acudiente'],
        'usua_eps' => $_POST['paci_eps'],
        'usua_sexo' => $_POST['paci_sexo'],
        'usua_rh' => $_POST['paci_rh'],
        'usua_tipo_documento' => $_POST['paci_tipo_documento'],
    ];
    $usuario->createPaciente($data);
    header('Location: ../views/usuario/loginPaciente.php');
    exit;
}

//Login paciente
if (isset($_POST['login'])) {
    $user = $usuario->loginPaciente($_POST['paci_num_documento'], $_POST['paci_password']);
    if ($user) {
        $_SESSION['usuario'] = $user;
        header('Location: ../views/dashboard.php');
    } else {
        echo "Credenciales incorrectas.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['paci_num_documento'])) {
    $usuarios = $usuario->indexPaciente(); 
    include '../views/usuario/indexPaciente.php'; 

// Acción para ver los detalles de un usuario (read)
} elseif (isset($_GET['paci_num_documento'])) {
    $usuarioDetalle = $usuario->readPaciente($_GET['paci_num_documento']); 
    include '../views/usuario/readPaciente.php'; 
}
