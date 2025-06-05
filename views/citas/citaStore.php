<?php
require_once __DIR__ . '/../../config/database.php';
$pdo = conectarBD();
$sql = "SELECT * FROM tbl_especialistas
    INNER JOIN tbl_usuarios ON espe_usuario = id_usuario
    ";
$stmt = $pdo->query($sql);
$especialistas = $stmt->fetchAll();

$sql = "SELECT * FROM tbl_consultorios";
$stmt = $pdo->query($sql);
$consultorios = $stmt->fetchAll();

$sql = "SELECT * FROM tbl_usuarios";
$stmt = $pdo->query($sql);
$usuarios = $stmt->fetchAll();

$sql = "SELECT * FROM tbl_tratamientos";
$stmt = $pdo->query($sql);
$tratamientos = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cita</title>
</head>

<body>

    <form id="citaStore" method="POST" action="/proyecto_sab/controllers/CitaController.php?accion=store">
    <h2>Crear Cita</h2>

    <select name="cita_usuario" id="cita_usuario">
        <option value="" disabled selected>Usuario Solicitante</option>
        <?php foreach ($usuarios as $usuario): ?>
        <option value="<?= htmlspecialchars($usuario['id_usuario']) ?>">
            <?=htmlspecialchars($usuario['usua_nombre']) ?>
        </option>
        <?php endforeach; ?>
    </select>
    
    <select name="cita_especialista" id="cita_especialista">
        <option value="" disabled selected>Especialista Encargado</option>
        <?php foreach ($especialistas as $especialista): ?>
        <option value="<?= htmlspecialchars($especialista['id_especialista']) ?>">
            <?=htmlspecialchars($especialista['usua_nombre']) ?>
        </option>
        <?php endforeach; ?>
    </select>
    
    <input type="date" name="cita_fecha" id="cita_fecha">
    <input type="time" name="cita_hora" id="cita_hora">
    
    <select name="cita_consultorio" id="cita_consultorio">
        <option value="" disabled selected>Consultorio</option>
        <?php foreach ($consultorios as $consultorio): ?>
        <option value="<?= htmlspecialchars($consultorio['id_consultorio']) ?>">
            <?=htmlspecialchars($consultorio['cons_numero']) ?>
        </option>
        <?php endforeach; ?>
    </select>

    <select name="cita_motivo" id="cita_motivo">
        <option value="" disabled selected>Motivo</option>
        <option value="1">Consulta general</option>
        <option value="2">Control</option>
        <option value="3">Urgencia</option>
        <option value="4">Seguimiento</option>
        <option value="5">Examen</option>
        <option value="6">Otro</option>
    </select>
    
    <input type="text" name="cita_observacion" id="cita_observacion" maxlength="255" value="N/A">
    <select name="cita_estado" id="cita_estado">
        <option value="" disabled selected>Estado</option>
        <option value="1">Cumplida</option>
        <option value="2">Incumplida</option>
        <option value="3">Proceso</option>
    </select>

    <select name="cita_tratamiento" id="cita_tratamiento">
        <option value="" disabled selected>Tratamiento</option>
        <?php foreach ($tratamientos as $tratamiento): ?>
        <option value="<?= htmlspecialchars($tratamiento['id_tratamiento']) ?>">
            <?=htmlspecialchars($tratamiento['trat_nombre']) ?>
        </option>
        <?php endforeach; ?>
    </select>
    
    <input type="submit" id="generar_cita" value="Generar Cita">

    </form>

</body>

</html>