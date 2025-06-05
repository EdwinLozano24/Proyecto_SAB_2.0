<?php
require_once __DIR__ . '/../../config/database.php';
$pdo = conectarBD();

// Cargar listas para selects
$especialistas = $pdo->query("SELECT * FROM tbl_especialistas INNER JOIN tbl_usuarios ON espe_usuario = id_usuario")->fetchAll();
$consultorios = $pdo->query("SELECT * FROM tbl_consultorios")->fetchAll();
$usuarios = $pdo->query("SELECT * FROM tbl_usuarios")->fetchAll();
$tratamientos = $pdo->query("SELECT * FROM tbl_tratamientos")->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cita</title>
</head>
<body>

    <h2>Editar Cita</h2>
    <form method="POST" action="../controllers/CitaController.php?accion=update">
        <input type="hidden" name="id_cita" value="<?= htmlspecialchars($cita['id_cita']) ?>">

        <select name="cita_usuario" id="cita_usuario">
            <option value="" disabled>Usuario Solicitante</option>
            <?php foreach ($usuarios as $usuario): ?>
                <option value="<?= $usuario['id_usuario'] ?>" <?= $usuario['id_usuario'] == $cita['cita_usuario'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($usuario['usua_nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select name="cita_especialista" id="cita_especialista">
            <option value="" disabled>Especialista Encargado</option>
            <?php foreach ($especialistas as $especialista): ?>
                <option value="<?= $especialista['id_especialista'] ?>" <?= $especialista['id_especialista'] == $cita['cita_especialista'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($especialista['usua_nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="date" name="cita_fecha" value="<?= htmlspecialchars($cita['cita_fecha']) ?>">
        <input type="time" name="cita_hora" value="<?= htmlspecialchars($cita['cita_hora']) ?>">

        <select name="cita_consultorio" id="cita_consultorio">
            <option value="" disabled>Consultorio</option>
            <?php foreach ($consultorios as $consultorio): ?>
                <option value="<?= $consultorio['id_consultorio'] ?>" <?= $consultorio['id_consultorio'] == $cita['cita_consultorio'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($consultorio['cons_numero']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select name="cita_motivo" id="cita_motivo">
            <option value="" disabled>Motivo</option>
            <?php
                $motivos = [
                    1 => 'Consulta general',
                    2 => 'Control',
                    3 => 'Urgencia',
                    4 => 'Seguimiento',
                    5 => 'Examen',
                    6 => 'Otro'
                ];
                foreach ($motivos as $key => $label):
            ?>
                <option value="<?= $key ?>" <?= $cita['cita_motivo'] == $key ? 'selected' : '' ?>><?= $label ?></option>
            <?php endforeach; ?>
        </select>

        <input type="text" name="cita_observacion" maxlength="255" value="<?= htmlspecialchars($cita['cita_observacion']) ?>">

        <select name="cita_estado" id="cita_estado">
            <option value="" disabled>Estado</option>
            <option value="1" <?= $cita['cita_estado'] == 1 ? 'selected' : '' ?>>Cumplida</option>
            <option value="2" <?= $cita['cita_estado'] == 2 ? 'selected' : '' ?>>Incumplida</option>
            <option value="3" <?= $cita['cita_estado'] == 3 ? 'selected' : '' ?>>Proceso</option>
        </select>

        <select name="cita_tratamiento" id="cita_tratamiento">
            <option value="" disabled>Tratamiento</option>
            <?php foreach ($tratamientos as $tratamiento): ?>
                <option value="<?= $tratamiento['id_tratamiento'] ?>" <?= $tratamiento['id_tratamiento'] == $cita['cita_tratamiento'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($tratamiento['trat_nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Actualizar Cita">
    </form>

</body>
</html>
