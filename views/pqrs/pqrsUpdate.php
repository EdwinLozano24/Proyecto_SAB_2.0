<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar PQRS - Sistema Odontológico</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/proyecto_sab/assets/css/admin/crudUsuario.css';
    $cssUrl = '/proyecto_sab/assets/css/admin/crudUsuario.css';
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
            <h1>Actualizar Información de la PQR</h1>
            <p class="subtitle">Sistema de Gestión Odontológica</p>
        </div>
        <form action="../controllers/PqrsController.php?accion=update" method="POST" class="form-card">
            <input type="hidden" name="1d_pqrs" value="<?= $pqr['id_pqrs'] ?>">

            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">👤</div>
                    Información de la pqr
                </div>
                    <div class="form-group">
                        <label for="tipo">Tipo <span class="required">*</span></label>
                        <select name="pqrs_tipo" id="pqrs_tipo" required>
                            <option value="" disabled>Seleccionar tipo de pqr</option>
                            <option value="Petición" <?= ($pqr['pqrs_tipo'] == "Petición") ? 'selected' : '' ?>>Peticion</option>
                            <option value="Queja" <?= ($pqr['pqrs_tipo'] == "Queja") ? 'selected' : '' ?>>Queja</option>
                            <option value="Reclamo" <?= ($pqr['pqrs_tipo'] == "Reclamo") ? 'selected' : '' ?>>Reclamo</option>
                            <option value="Sugerencia" <?= ($pqr['pqrs_tipo'] == "Sugerencia") ? 'selected' : '' ?>>Sugerencia</option>
                            </select>
                    </div>

                    <div class="form-grid">
                    <div class="form-group">
                        <label for="asunto">Asunto <span class="required">*</span></label>
                        <input type="text" name="pqrs_asunto" id="pqrs_asunto" value="<?= $pqr['pqrs_asunto'] ?>" required>
                    </div>
                    <div class="form-grid">
                    <div class="form-group">
                        <label for="descripcion">Descripcion <span class="required">*</span></label>
                        <input type="text" name="pqrs_descripcion" id="pqrs_descripcion" value="<?= $pqr['pqrs_descripcion'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha de envio">Fecha de Envio</label>
                        <input type="date" name="pqrs_fecha_envio" id="pqrs_fecha_envio" value="<?= $pqr['pqrs_fecha_envio'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado <span class="required">*</span></label>
                        <select name="pqrs_estado" id="pqrs_estado" required>
                            <option value="" disabled>Seleccionar el estado de la pqr</option>
                            <option value="Pendiente" <?= ($pqr['pqrs_estado'] == "Pendiente") ? 'selected' : '' ?>>Pendiente</option>
                            <option value="En proceso" <?= ($pqr['pqrs_estado'] == "En proceso") ? 'selected' : '' ?>>En proceso</option>
                            <option value="Respondido" <?= ($pqr['pqrs_estado'] == "Respondido") ? 'selected' : '' ?>>Respondido</option>
                            <option value="Cerrado" <?= ($pqr['pqrs_estado'] == "Cerrado") ? 'selected' : '' ?>>Cerrado</option>
                            </select>
                    </div>

                    <div class="form-grid">
                    <div class="form-group">
                        <label for="respuesta">respuesta <span class="required">*</span></label>
                        <input type="text" name="pqrs_respuesta" id="pqrs_respuesta" value="<?= $pqr['pqrs_respuesta'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha de respuesta">Fecha de Respuesta</label>
                        <input type="date" name="pqrs_fecha_respuesta" id="pqrs_fecha_respuesta" value="<?= $pqr['pqrs_fecha_respuesta'] ?>">
                    </div>
                    


    
</body>
</html>