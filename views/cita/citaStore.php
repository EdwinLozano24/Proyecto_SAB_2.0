<?php
require_once __DIR__ . '/../../config/database.php';
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
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/proyecto_sab/assets/css/admin/crudCitas.css';
    $cssUrl = '/proyecto_sab/assets/css/admin/crudCitas.css';
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
                            <option value="">-- Selecciona un paciente --</option>
                                <?php foreach ($pacientes as $paciente): ?>
                                    <option value="<?= $paciente['id_paciente'] ?>">
                                        <?= $paciente['paci_usuario'] ?> - <?= $paciente['usua_nombre'] ?>
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
                        <select name="cita_especialista" id="cita_especialista" required>
                            <option value="" disabled selected>Seleccionar especialista...</option>
                            <option value="1">Dr. Roberto Sánchez - Odontología General</option>
                            <option value="2">Dra. Laura Jiménez - Ortodoncia</option>
                            <option value="3">Dr. Miguel Torres - Endodoncia</option>
                            <option value="4">Dra. Patricia Morales - Periodoncia</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cita_consultorio">Consultorio <span class="required">*</span></label>
                        <select name="cita_consultorio" id="cita_consultorio" required>
                            <option value="" disabled selected>Seleccionar consultorio...</option>
                            <option value="1">Consultorio 101 - General</option>
                            <option value="2">Consultorio 102 - Especialidades</option>
                            <option value="3">Consultorio 103 - Cirugía</option>
                            <option value="4">Consultorio 104 - Urgencias</option>
                        </select>
                    </div>

                    <div class="form-group time-grid" style="grid-column: 1 / -1;">
                        <div>
                            <label for="cita_fecha">Fecha de la Cita <span class="required">*</span></label>
                            <input type="date" name="cita_fecha" id="cita_fecha" required min="2024-01-01">
                        </div>
                        <div>
                            <label for="cita_hora">Hora de la Cita <span class="required">*</span></label>
                            <input type="time" name="cita_hora" id="cita_hora" required min="08:00" max="18:00">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">📋</div>
                    Detalles de la Cita
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="cita_motivo">Motivo de la Consulta <span class="required">*</span></label>
                        <select name="cita_motivo" id="cita_motivo" required>
                            <option value="" disabled selected>Seleccionar motivo...</option>
                            <option value="1">Consulta General</option>
                            <option value="2">Control de Seguimiento</option>
                            <option value="3">Urgencia Odontológica</option>
                            <option value="4">Seguimiento de Tratamiento</option>
                            <option value="5">Examen de Rutina</option>
                            <option value="6">Otro</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cita_tratamiento">Tratamiento Asociado</label>
                        <select name="cita_tratamiento" id="cita_tratamiento">
                            <option value="" disabled selected>Seleccionar tratamiento...</option>
                            <option value="1">Limpieza Dental</option>
                            <option value="2">Obturación</option>
                            <option value="3">Extracción</option>
                            <option value="4">Ortodoncia</option>
                            <option value="5">Blanqueamiento</option>
                            <option value="6">Implante Dental</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label for="cita_observacion">Observaciones Adicionales</label>
                        <textarea name="cita_observacion" id="cita_observacion" maxlength="255" placeholder="Escriba cualquier observación relevante para la cita...">N/A</textarea>
                    </div>

                    <div class="form-group">
                        <label for="cita_estado">Estado Inicial <span class="required">*</span></label>
                        <select name="cita_estado" id="cita_estado" required>
                            <option value="" disabled>Seleccionar estado...</option>
                            <option value="1">Cumplida</option>
                            <option value="2">Incumplida</option>
                            <option value="3" selected>En Proceso</option>
                        </select>
                        <div class="status-indicator status-proceso">
                            🔄 Por defecto se asigna "En Proceso"
                        </div>
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
    $('#cita_paciente').select2({
        placeholder: "Buscar paciente...",
        allowClear: true
    });
});
</script>
</body>

</html>