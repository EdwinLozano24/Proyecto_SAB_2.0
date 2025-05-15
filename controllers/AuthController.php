<?php
require_once '../models/Usuario.php';
require_once '../config/database.php';

$usuario = new Usuario($pdo);

//Registro usuario
if (isset($_POST['registrarUsuario'])) {
    $data = [
        'usua_documento' => $_POST['usua_documento'],
        'usua_nombre' => $_POST['usua_nombre'],
        'usua_correo_electronico' => $_POST['usua_correo_electronico'],
        'usua_password' => $_POST['usua_password'],
        'usua_direccion' => $_POST['usua_direccion'],
        'usua_fecha_nacimiento' => $_POST['usua_fecha_nacimiento'],
        'usua_num_contacto' => $_POST['usua_num_contacto'],
        'usua_num_secundario' => $_POST['usua_num_secundario'],
        'usua_eps' => $_POST['usua_eps'],
        'usua_sexo' => $_POST['usua_sexo'],
        'usua_rh' => $_POST['usua_rh'],
        'usua_tipo_documento' => $_POST['usua_tipo_documento'],
    ];
    $usuario->createUsuario($data);
    header('Location: ../views/user/loginRegister.php');
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
