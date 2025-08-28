<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/auth.php';
requiereSesion();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pqrs - Sistema Odontológico</title>
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
            <div class="logo">🦷</div>
            <h2>Actualizar Información del PQRS</h2>
            <p class="subtitle">Sistema de Gestión Odontológica</p>
        </div>

        <form id="PqrsUpdate" method="POST" action="/controllers/PqrsController.php?accion=update">

            <input type="hidden" name="id_pqrs" value="<?= $pqrs['id_pqrs'] ?>">
            <input type="hidden" name="origen_formulario" value="responder">

            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">📝</div>
                    Información del Pqrs
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="pqrs_usuario">Usuario Responsable</label>
                        <input type="hidden" id="pqrs_usuario" name="pqrs_usuario" value="<?= htmlspecialchars($pqrs['pqrs_usuario']) ?>" readonly>
                        <input type="text" id="usuario_nombre" name="usuario_nombre" value="<?= htmlspecialchars($pqrs['usuario_nombre']) ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="pqrs_tipo">Tipo de Pqrs</label>
                        <input type="text" id="pqrs_tipo" name="pqrs_tipo" value="<?= htmlspecialchars($pqrs['pqrs_tipo']) ?>" readonly>
                    </div>

                    <div class="form-group full-width">
                        <label for="pqrs_asunto">Asunto</label>
                        <input type="text" name="pqrs_asunto" id="pqrs_asunto" required
                            value="<?= htmlspecialchars($pqrs['pqrs_asunto']) ?>" readonly>
                    </div>

                    <div class="form-group full-width">
                        <label for="pqrs_descripcion">Descripcion</label>
                        <textarea name="pqrs_descripcion" id="pqrs_descripcion" maxlength="255" readonly><?= htmlspecialchars($pqrs['pqrs_descripcion']) ?: 'N/A' ?></textarea>
                    </div>

                </div>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">🗓️</div>
                    Respuesta
                </div>

                <div class="form-grid">

                    <input type="hidden" name="pqrs_fecha_envio" id="pqrs_fecha_envio" required min="2024-01-01" value="<?= htmlspecialchars($pqrs['pqrs_fecha_envio']) ?>">

                    <input type="hidden" name="pqrs_empleado" id="pqrs_empleado" required value="<?= htmlspecialchars($pqrs['pqrs_empleado']) ?>" readonly>

                    <div class="form-group full-width">
                        <label for="pqrs_respuesta">Respuesta<span class="required"> *</span></label>
                        <textarea name="pqrs_respuesta" id="pqrs_respuesta" maxlength="255"
                            placeholder="Escriba su Respuesta..." readonly><?= htmlspecialchars($pqrs['pqrs_respuesta']) ?: 'N/A' ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="pqrs_estado">Estado de Pqrs<span class="required"> *</span></label>
                        <select name="pqrs_estado" id="pqrs_estado" required>
                            <option value="" disabled selected>Seleccionar estado...</option>
                            <option value="Pendiente" <?= ($pqrs['pqrs_estado'] == "Pendiente") ? 'selected' : '' ?>>
                                Pendiente</option>
                            <option value="Cerrado" <?= ($pqrs['pqrs_estado'] == "Cerrado") ? 'selected' : '' ?>>Cerrado
                            </option>
                        </select>
                    </div>

                </div>

            </div>
            
            <div class="button-group">
                    <button type="button" class="btn-secondary" onclick="window.history.back()">
                    ← Cancelar
                </button>
                <input type="submit" id="generar_cita" value="⚠️ Actualizar Pqrs">
            </div>
        </form>
    </div>

    <!-- JS de jQuery y Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="script.js"></script> -->
</body>

</html>