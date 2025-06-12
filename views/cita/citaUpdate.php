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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cita</title>
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
            <div class="logo">✏️</div>
            <h2>Editar Cita</h2>
            <p class="subtitle">Modifique los detalles de la cita existente</p>
        </div>

        <div class="info-card">
            <h3>ℹ️ Nota Importante</h3>
            <p>Asegúrese de verificar la disponibilidad si cambia la fecha, hora, especialista o consultorio.</p>
        </div>

        <form id="citaEditForm" method="POST" action="../controllers/CitaController.php?accion=update">
            <input type="hidden" name="id_cita" value="<?= htmlspecialchars($cita['id_cita'] ?? '') ?>">

            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">👤</div>
                    Paciente
                </div>
                <div class="form-grid">
                    <div class="form-group full-width"> <label for="cita_usuario">Paciente <span class="required">*</span></label>
                        <select name="cita_usuario" id="cita_usuario" required>
                            <option value="" disabled>Seleccionar paciente...</option>
                            <?php foreach (($usuarios ?? []) as $usuario): ?>
                                <option value="<?= htmlspecialchars($usuario['id_usuario'] ?? '') ?>" <?= (isset($cita['cita_usuario']) && $usuario['id_usuario'] == $cita['cita_usuario']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($usuario['usua_nombre'] ?? '') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">🗓️</div>
                    Detalles de la Cita
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="cita_especialista">Especialista <span class="required">*</span></label>
                        <select name="cita_especialista" id="cita_especialista" required>
                            <option value="" disabled>Seleccionar especialista...</option>
                            <?php foreach (($especialistas ?? []) as $especialista): ?>
                                <option value="<?= htmlspecialchars($especialista['id_especialista'] ?? '') ?>" <?= (isset($cita['cita_especialista']) && $especialista['id_especialista'] == $cita['cita_especialista']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($especialista['usua_nombre'] ?? '') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cita_consultorio">Consultorio <span class="required">*</span></label>
                        <select name="cita_consultorio" id="cita_consultorio" required>
                            <option value="" disabled>Seleccionar consultorio...</option>
                            <?php foreach (($consultorios ?? []) as $consultorio): ?>
                                <option value="<?= htmlspecialchars($consultorio['id_consultorio'] ?? '') ?>" <?= (isset($cita['cita_consultorio']) && $consultorio['id_consultorio'] == $cita['cita_consultorio']) ? 'selected' : '' ?>>
                                    Consultorio <?= htmlspecialchars($consultorio['cons_numero'] ?? '') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group time-grid" style="grid-column: 1 / -1;">
                        <div>
                            <label for="cita_fecha">Fecha de la Cita <span class="required">*</span></label>
                            <input type="date" name="cita_fecha" id="cita_fecha" required value="<?= htmlspecialchars($cita['cita_fecha'] ?? '') ?>" min="2024-01-01">
                        </div>
                        <div>
                            <label for="cita_hora">Hora de la Cita <span class="required">*</span></label>
                            <input type="time" name="cita_hora" id="cita_hora" required value="<?= htmlspecialchars($cita['cita_hora'] ?? '') ?>" min="08:00" max="18:00">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cita_motivo">Motivo de la Consulta <span class="required">*</span></label>
                        <select name="cita_motivo" id="cita_motivo" required>
                            <option value="" disabled>Seleccionar motivo...</option>
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
                                <option value="<?= htmlspecialchars($key) ?>" <?= (isset($cita['cita_motivo']) && $cita['cita_motivo'] == $key) ? 'selected' : '' ?>><?= htmlspecialchars($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cita_tratamiento">Tratamiento Asociado</label>
                        <select name="cita_tratamiento" id="cita_tratamiento">
                            <option value="" disabled>Seleccionar tratamiento...</option>
                            <?php foreach (($tratamientos ?? []) as $tratamiento): ?>
                                <option value="<?= htmlspecialchars($tratamiento['id_tratamiento'] ?? '') ?>" <?= (isset($cita['cita_tratamiento']) && $tratamiento['id_tratamiento'] == $cita['cita_tratamiento']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($tratamiento['trat_nombre'] ?? '') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label for="cita_observacion">Observaciones Adicionales</label>
                        <textarea name="cita_observacion" id="cita_observacion" maxlength="255" placeholder="Escriba cualquier observación relevante para la cita..."><?= htmlspecialchars($cita['cita_observacion'] ?? 'N/A') ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="cita_estado">Estado <span class="required">*</span></label>
                        <select name="cita_estado" id="cita_estado" required>
                            <option value="" disabled>Seleccionar estado...</option>
                            <option value="1" <?= (isset($cita['cita_estado']) && $cita['cita_estado'] == 1) ? 'selected' : '' ?>>Cumplida</option>
                            <option value="2" <?= (isset($cita['cita_estado']) && $cita['cita_estado'] == 2) ? 'selected' : '' ?>>Incumplida</option>
                            <option value="3" <?= (isset($cita['cita_estado']) && $cita['cita_estado'] == 3) ? 'selected' : '' ?>>En Proceso</option>
                        </select>
                        <div class="status-indicator <?= (isset($cita['cita_estado'])) ? ($cita['cita_estado'] == 1 ? 'status-cumplida' : ($cita['cita_estado'] == 2 ? 'status-incumplida' : 'status-proceso')) : 'status-proceso' ?>">
                            <?= (isset($cita['cita_estado'])) ? ($cita['cita_estado'] == 1 ? '✅ Cita Cumplida' : ($cita['cita_estado'] == 2 ? '❌ Cita Incumplida' : '🔄 En Proceso')) : '🔄 Por defecto se asigna "En Proceso"' ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="button-group">
                <button type="button" class="btn-secondary" onclick="window.history.back()">
                    ← Cancelar
                </button>
                <input type="submit" id="actualizar_cita" value="💾 Actualizar Cita">
            </div>
        </form>
    </div>

    <!-- <script src="script.js"></script> </body> -->

</html>