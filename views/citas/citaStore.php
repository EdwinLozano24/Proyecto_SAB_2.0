<?php
require_once __DIR__ . '/../../config/database.php';
$sql = "SELECT * FROM tbl_especialistas
    INNER JOIN tbl_usuarios ON espe_usuario = id_usuario
    ";
$stmt = $pdo->query($sql);
$especialistas = $stmt->fetchAll();
$sql = "SELECT * FROM tbl_usuarios";
$stmt = $pdo->query($sql);
$usuarios = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cita</title>
</head>
<body>
    <form id="citaStore" method="POST" action="../controllers/CitaController.php?accion=guardar">
    <h2>Crear Cita</h2>
    <select name="cita_usuario" id="cita_usuario">
        <option value="" disabled selected>Usuario Solicitante</option>
        <?php foreach ($usuarios as $usuario): ?>
        <option value="<?= htmlspecialchars($usuario['usua_nombre']) ?>">
            <?=htmlspecialchars($usuario['usua_nombre']) ?>
        </option>
        <?php endforeach; ?>
    </select>
    
    <select name="cita_especialista" id="cita_especialista">
        <option value="" disabled selected>Especialista Encargado</option>
        <?php foreach ($especialistas as $especialista): ?>
        <option value="<?= htmlspecialchars($especialista['usua_nombre']) ?>">
            <?=htmlspecialchars($especialista['usua_nombre']) ?>
        </option>
        <?php endforeach; ?>
    </select>


    </form>
</body>
</html>