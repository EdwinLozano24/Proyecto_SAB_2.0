<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/auth.php';
requiereSesion();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pqrs</title>
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
    <link rel="icon" type="image/png" href="/Assets/img/favicon.png"> 
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">🦷</div>
            <h2>Actualizar Información del PQRS</h2>
            <p class="subtitle">Sistema de Gestión Odontológica</p>
        </div>

        <form id="PqrsUpdate" method="POST" action="/controllers/PqrsController.php?accion=updateAdmin">
            <input type="hidden" name="id_pqrs" value="<?= $pqrs['id_pqrs'] ?>">
            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">📝</div>
                    Información del Pqrs
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="pqrs_usuario">Usuario Responsable<span class="required">*</span></label>
                        <select name="pqrs_usuario" id="pqrs_usuario" class="form-control select2" required>
                            <option value="" selected disabled>Seleccionar un paciente...</option>
                            <?php foreach ($usua as $usu): ?>
                                <option value="<?= htmlspecialchars($usu['id_usuario']) ?>"
                                    <?= $usu['id_usuario'] == $pqrs['pqrs_usuario'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($usu['usua_nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pqrs_tipo">Tipo de Pqrs<span class="required">*</span></label>
                        <select name="pqrs_tipo" id="pqrs_tipo" required>
                            <option value="" disabled selected>Seleccionar Tipo...</option>
                            <option value="Petición" <?= ($pqrs['pqrs_tipo'] == "Petición") ? 'selected' : '' ?>>Petición
                            </option>
                            <option value="Queja" <?= ($pqrs['pqrs_tipo'] == "Queja") ? 'selected' : '' ?>>Queja</option>
                            <option value="Reclamo" <?= ($pqrs['pqrs_tipo'] == "Reclamo") ? 'selected' : '' ?>>Reclamo
                            </option>
                            <option value="Sugerencia" <?= ($pqrs['pqrs_tipo'] == "Sugerencia") ? 'selected' : '' ?>>
                                Sugerencia</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label for="pqrs_asunto">Asunto<span class="required">*</span></label>
                        <input type="text" name="pqrs_asunto" id="pqrs_asunto" required
                            value="<?= htmlspecialchars($pqrs['pqrs_asunto']) ?>">
                    </div>

                    <div class="form-group full-width">
                        <label for="pqrs_descripcion">Descripcion<span class="required">*</span></label>
                        <textarea name="pqrs_descripcion" id="pqrs_descripcion" maxlength="255"
                            placeholder="Escriba su Pqrs..."><?= htmlspecialchars($pqrs['pqrs_descripcion']) ?: 'N/A' ?></textarea>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">🗓️</div>
                    Datos de Manejo
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="pqrs_fecha_envio">Fecha de Envio<span class="required">*</span></label>
                        <input type="date" name="pqrs_fecha_envio" id="pqrs_fecha_envio" required min="2024-01-01"
                            value="<?= htmlspecialchars($pqrs['pqrs_fecha_envio']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="pqrs_estado">Estado de Pqrs<span class="required">*</span></label>
                        <select name="pqrs_estado" id="pqrs_estado" required>
                            <option value="" disabled selected>Seleccionar estado...</option>
                            <option value="Pendiente" <?= ($pqrs['pqrs_estado'] == "Pendiente") ? 'selected' : '' ?>>
                                Pendiente</option>
                            <option value="En proceso" <?= ($pqrs['pqrs_estado'] == "En proceso") ? 'selected' : '' ?>>En
                                proceso</option>
                            <option value="Respondido" <?= ($pqrs['pqrs_estado'] == "Respondido") ? 'selected' : '' ?>>
                                Respondido</option>
                            <option value="Cerrado" <?= ($pqrs['pqrs_estado'] == "Cerrado") ? 'selected' : '' ?>>Cerrado
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pqrs_fecha_respuesta">Fecha de Respuesta<span class="required">*</span></label>
                        <input type="date" name="pqrs_fecha_respuesta" id="pqrs_fecha_respuesta"
                            value="<?= htmlspecialchars($pqrs['pqrs_fecha_respuesta']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="pqrs_empleado">Empleado Encargado<span class="required">*</span></label>
                        <select name="pqrs_empleado" id="pqrs_empleado" class="form-control select2">
                            <option value="">Seleccionar empleado...</option>
                            <?php foreach ($empl as $emp): ?>
                                <option value="<?= htmlspecialchars($emp['id_empleado']) ?>"
                                    <?= $emp['id_empleado'] == $pqrs['pqrs_empleado'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($emp['usua_nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label for="pqrs_respuesta">Respuesta<span class="required">*</span></label>
                        <textarea name="pqrs_respuesta" id="pqrs_respuesta" maxlength="255"
                            placeholder="Escriba su Respuesta..."><?= htmlspecialchars($pqrs['pqrs_respuesta']) ?: 'N/A' ?></textarea>
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
    <script>
        $(document).ready(function () {
            $('#pqrs_usuario, #pqrs_empleado').select2();
            });

    </script>
</body>

</html>