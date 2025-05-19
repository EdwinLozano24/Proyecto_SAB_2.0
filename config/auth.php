<?php
session_start();

function confirmarLogin() {
    return isset($_SESSION['usuario']);
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
        header('Location: .././error/acceso_denegado.php');
        exit;
    }
}
?>
