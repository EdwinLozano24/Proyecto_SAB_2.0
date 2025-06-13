<?php
require_once '../models/Usuario.php';
require_once '../config/database.php';

$usuario = new Usuario($pdo);

//Login paciente
if (isset($_POST['loginUsuario'])) {
    $user = $usuario->loginUsuario($_POST['usua_documento'], $_POST['usua_password']);
    if ($user) {
        $_SESSION['usuario'] = $user;
        switch ($user['usua_tipo']) {
            case 'Paciente':
                header('Location: ../views/home/dashboard.php');
                break;
            case 'Empleados':
                header('Location: ../views/user/dashboard.php');
                break;
            case 'Especialista':
                header('Location: ../views/home/dashboard.php');
                break;
            case 'Administrador':
                header('Location: ../views/home/dashboard.php');
                break;
            }
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
