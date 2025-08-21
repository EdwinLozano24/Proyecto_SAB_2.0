<?php
require_once '../config/auth.php';
requiereSesion();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cita - Sistema Odontológico</title>
    <!-- CSS de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/assets/css/admin/crudPage.css';
    $cssUrl = '/assets/css/admin/crudPage.css';
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
            <h2>Editar Cita</h2>
            <p class="subtitle">Sistema de Gestión de Citas Odontológicas</p>
        </div>

        <form id="citaStore" method="POST" action="/controllers/CitaController.php?accion=update">
            <input type="hidden" name="id_cita" value="<?= $cita['id_cita'] ?>">
            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">👤</div>
                    Información del Paciente
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="cita_usuario">Paciente<span class="required">*</span></label>
                        <select name="cita_paciente" id="cita_paciente" class="form-control select2" required>
                            <option value="">Seleccionar un paciente...</option>
                            <?php foreach ($paci as $pac): ?>
                                <option value="<?= htmlspecialchars($pac['id_paciente']) ?>"
                                    <?= $pac['id_paciente'] == $cita['cita_paciente'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($pac['usua_nombre']) ?>
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
                            <option value="">Seleccionar especialista...</option>
                            <?php foreach ($espe as $esp): ?>
                                <option value="<?= htmlspecialchars($esp['id_especialista']) ?>"
                                    <?= $esp['id_especialista'] == $cita['cita_especialista'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($esp['usua_nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cita_consultorio">Consultorio <span class="required">*</span></label>
                        <select name="cita_consultorio" id="cita_consultorio" class="form-control select2" required>
                            <option value="" disabled selected>Seleccionar consultorio...</option>
                            <?php foreach ($cons as $con): ?>
                                <option value="<?= htmlspecialchars($con['id_consultorio']) ?>"
                                    <?= $con['id_consultorio'] == $cita['cita_consultorio'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($con['cons_numero']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label for="cita_fecha">Fecha de la Cita <span class="required">*</span></label>
                        <input type="date" name="cita_fecha" id="cita_fecha" required min="2024-01-01"
                            value="<?= htmlspecialchars($cita['cita_fecha']) ?>">
                    </div>

                    <div class="form-group time-grid" style="grid-column: 1 / -1;">
                        <div>
                            <label for="cita_hora">Hora de Inicio <span class="required">*</span></label>
                            <input type="time" name="cita_hora_inicio" id="cita_hora_inicio" required min="06:00"
                                max="18:00" value="<?= htmlspecialchars($cita['cita_hora_inicio']) ?>">
                        </div>
                        <div>
                            <label for="cita_hora">Hora de Final <span class="required">*</span></label>
                            <input type="time" name="cita_hora_fin" id="cita_hora_fin" required min="06:00" max="18:00"
                                value="<?= htmlspecialchars($cita['cita_hora_fin']) ?>">
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
                    <div class="form-group full-width">
                        <label for="cita_motivo">Motivo de la Cita<span class="required">*</span></label>
                        <select name="cita_motivo" id="cita_motivo" required>
                            <option value="" disabled selected>Seleccionar motivo...</option>
                            <option value="Consulta general" <?= ($cita['cita_motivo'] == "Consulta general") ? 'selected' : '' ?>>Consulta General</option>
                            <option value="Control" <?= ($cita['cita_motivo'] == "Control") ? 'selected' : '' ?>>Control de
                                Seguimiento</option>
                            <option value="Urgencia" <?= ($cita['cita_motivo'] == "Urgencia") ? 'selected' : '' ?>>Urgencia
                                Odontológica</option>
                            <option value="Seguimiento" <?= ($cita['cita_motivo'] == "Seguimiento") ? 'selected' : '' ?>>
                                Seguimiento de Tratamiento</option>
                            <option value="Examen" <?= ($cita['cita_motivo'] == "Examen") ? 'selected' : '' ?>>Examen de
                                Rutina</option>
                            <option value="Otro" <?= ($cita['cita_motivo'] == "Otro") ? 'selected' : '' ?>>Otro</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label for="cita_observacion">Observaciones Adicionales</label>
                        <textarea name="cita_observacion" id="cita_observacion" maxlength="255"
                            placeholder="Escriba cualquier observación relevante para la cita..."><?= htmlspecialchars($cita['cita_observacion']) ?: 'N/A' ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="cita_motivo">Estado de la Cita<span class="required">*</span></label>
                        <select name="cita_estado" id="cita_estado" required>
                            <option value="" disabled selected>Seleccionar Estado...</option>
                            <option value="Cumplida" <?= ($cita['cita_estado'] == "Cumplida") ? 'selected' : '' ?>>Cumplida
                            </option>
                            <option value="Incumplida" <?= ($cita['cita_estado'] == "Incumplida") ? 'selected' : '' ?>>
                                Incumplida</option>
                            <option value="Proceso" <?= ($cita['cita_estado'] == "Proceso") ? 'selected' : '' ?>>En Proceso
                            </option>
                            <option value="Cancelada" <?= ($cita['cita_estado'] == "Cancelada") ? 'selected' : '' ?>>
                                Cancelada</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="button-group">
                <button type="button" class="btn-secondary" onclick="window.history.back()">
                    ← Cancelar
                </button>
                <input type="submit" id="generar_cita" value="📅 Actualizar Cita">
            </div>
        </form>
    </div>

    <!-- JS de jQuery y Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="script.js"></script> -->
    <script>
        $(document).ready(function () {
            $('#cita_paciente, #cita_especialista, #cita_consultorio').select2();
            });

    </script>
</body>

</html>