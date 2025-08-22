<?php
session_start();



// Unificar nombre de sesión siempre que haya usuario logueado para evitar errores despues con agendamiento de citas y otras cuestiones
if (isset($_SESSION['usuario']['id_usuario'])) {
    $_SESSION['paciente_id'] = $_SESSION['usuario']['id_usuario'];
}

function confirmarLogin() {
    return isset($_SESSION['usuario']);
}

function requiereSesion() {
    if(!confirmarLogin()) {
        header('Location: ../../views/.general/error/acceso_denegado.php');
        exit;
    }
}

function obtenerTipo() {
    return $_SESSION['usuario']['usua_tipo'] ?? null;
}

function requiereTipo($role) {
    if (!confirmarLogin() || obtenerTipo() !== $role) {
        header('Location: .././error/acceso_denegado.php');
        exit;
    }
}

function requireVariosTipos(array $roles) {
    if (!confirmarLogin() || !in_array(obtenerTipo(), $roles)) {
        header('Location: ../././general/error/acceso_denegado.php');
        exit;
    }
}
?>
