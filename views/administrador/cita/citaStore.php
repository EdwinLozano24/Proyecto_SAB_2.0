<?php
require_once '../../../config/auth.php';
requiereSesion();
require_once __DIR__ . '/../../../config/database.php';
$pdo = conectarBD();
$sql = "SELECT * FROM tbl_pacientes
    INNER JOIN tbl_usuarios ON paci_usuario = id_usuario
    ";
$stmt = $pdo->query($sql);
$pacientes = $stmt->fetchAll();

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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cita - Sistema Odontológico</title>
    <!-- CSS de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/proyecto_sab/assets/css/admin/crudPage.css';
    $cssUrl = '/proyecto_sab/assets/css/admin/crudPage.css';
    if (file_exists($cssPath)) {
        echo '<link rel="stylesheet" href="' . $cssUrl . '">';
    } else {
        echo ' CSS File not fount at: ' . $cssPath . '';
    }
    ?>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">📅</div>
            <h2>Programar Nueva Cita</h2>
            <p class="subtitle">Sistema de Gestión de Citas Odontológicas</p>
        </div>

        <div class="info-card">
            <h3>ℹ️ Información Importante</h3>
            <p>Complete todos los campos requeridos para programar la cita. El sistema verificará automáticamente la disponibilidad del especialista y consultorio.</p>
        </div>

        <form id="citaStore" method="POST" action="/proyecto_sab/controllers/CitaController.php?accion=store">

            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">👤</div>
                    Información del Paciente
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="cita_usuario">Paciente <span class="required">*</span></label>
                        <select name="cita_paciente" id="cita_paciente" class="form-control select2" required>
                            <option value="" disabled selected>Seleccionar un paciente..</option>
                                <?php foreach ($pacientes as $paciente): ?>
                                    <option value="<?= $paciente['id_paciente'] ?>">
                                        <?= $paciente['usua_nombre'] ?>
                                    </option>
                                <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">🗓️</div>
                    Programación de la Cita
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="cita_especialista">Especialista <span class="required">*</span></label>
                        <select name="cita_especialista" id="cita_especialista" class="form-control select2" required>
                            <option value="" >Seleccionar especialista...</option>
                            <?php foreach ($especialistas as $especialista): ?>
                                <option value="<?= $especialista['id_especialista'] ?>">
                                    <?=$especialista['usua_nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cita_consultorio">Consultorio <span class="required">*</span></label>
                        <select name="cita_consultorio" id="cita_consultorio" class="form-control select2" required>
                            <option value="" disabled selected>Seleccionar consultorio...</option>
                                <?php foreach ($consultorios as $consultorio): ?>
                                    <option value="<?= $consultorio['id_consultorio'] ?>">
                                        <?= $consultorio['cons_numero'] ?>
                                    </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label for="cita_fecha">Fecha de la Cita <span class="required">*</span></label>
                        <input type="date" name="cita_fecha" id="cita_fecha" required min="2024-01-01">
                    </div>
                    
                    <div class="form-group time-grid" style="grid-column: 1 / -1;">
                        <div>
                            <label for="cita_hora">Hora de Inicio <span class="required">*</span></label>
                            <input type="time" name="cita_hora_inicio" id="cita_hora_inicio" required min="06:00" max="18:00">
                        </div>
                        <div>
                            <label for="cita_hora">Hora de Final <span class="required">*</span></label>
                            <input type="time" name="cita_hora_fin" id="cita_hora_fin" required min="06:00" max="18:00">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">📋</div>
                    Detalles de la Cita
                </div>
                <div class="form-group full-width">
                    <div class="form-group">
                        <label for="cita_motivo">Motivo de la Consulta <span class="required">*</span></label>
                        <select name="cita_motivo" id="cita_motivo" required>
                            <option value="" disabled selected>Seleccionar motivo...</option>
                            <option value="Consulta general">Consulta General</option>
                            <option value="Control">Control de Seguimiento</option>
                            <option value="Urgencia">Urgencia Odontológica</option>
                            <option value="Seguimiento">Seguimiento de Tratamiento</option>
                            <option value="Examen">Examen de Rutina</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group full-width">
                        <label for="cita_observacion">Observaciones Adicionales</label>
                        <textarea name="cita_observacion" id="cita_observacion" maxlength="255" placeholder="Escriba cualquier observación relevante para la cita...">N/A</textarea>
                    </div>
                </div>
            </div>

            <div class="button-group">
                <button type="button" class="btn-secondary" onclick="window.history.back()">
                    ← Cancelar
                </button>
                <input type="submit" id="generar_cita" value="📅 Programar Cita">
            </div>
        </form>
    </div>

    <!-- JS de jQuery y Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="script.js"></script> -->
    <script>
$(document).ready(function() {
    $('#cita_paciente, #cita_especialista, #cita_consultorio').select2();
});
</script>
</body>

</html>