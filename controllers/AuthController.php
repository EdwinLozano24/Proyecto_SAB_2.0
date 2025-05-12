<?php
require_once '../models/Usuario.php';
require_once '../config/database.php';

$usuario = new Usuario($pdo);

//Registro paciente
<<<<<<< HEAD
if (isset($_POST['registrar']))
{
=======
if (isset($_POST['registrar'])) {
>>>>>>> d557cec7b510a167ad337177493a34bb5edbeda5
    $data = [
        'paci_num_documento' => $_POST['paci_num_documento'],
        'paci_nombre' => $_POST['paci_nombre'],
        'paci_correo_electronico' => $_POST['paci_correo_electronico'],
        'paci_password' => $_POST['paci_password'],
        'paci_direccion' => $_POST['paci_direccion'],
        'paci_fecha_nacimiento' => $_POST['paci_fecha_nacimiento'],
<<<<<<< HEAD
=======
        'paci_num_contacto' => $_POST['paci_num_contacto'],
>>>>>>> d557cec7b510a167ad337177493a34bb5edbeda5
        'paci_num_acudiente' => $_POST['paci_num_acudiente'],
        'paci_eps' => $_POST['paci_eps'],
        'paci_sexo' => $_POST['paci_sexo'],
        'paci_rh' => $_POST['paci_rh'],
        'paci_tipo_documento' => $_POST['paci_tipo_documento'],
    ];
<<<<<<< HEAD
    $usuario->registrarUsuario($data);
    header('Location: ../views/usuario/login.php');
    exit;
}
=======
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
>>>>>>> d557cec7b510a167ad337177493a34bb5edbeda5
