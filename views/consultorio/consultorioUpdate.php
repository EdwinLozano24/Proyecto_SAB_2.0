<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Consultorio</title>
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


<div class="container">
        <div class="header">
            <div class="logo">✏️</div>
            <h2>Editar Consultorio Existente</h2>
            <p class="subtitle">Modifique el consultorio</p>
        </div>

 <div class="info-card">
            <h3>ℹ️ Nota Importante</h3>
            <p>Asegúrese de verificar la disponibilidad si cambia la fecha, hora, especialista o consultorio.</p>
        </div>


        <form id="consultorioEditForm" method="POST" action="../controllers/ConsultorioController.php?accion=update">
            <input type="hidden" name="id_consultorio" value="<?= htmlspecialchars($consultorios['id_consultorio'] ?? '') ?>">

            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">👤</div>
                    Consultorio
                </div>
                <div class="form-grid">
    <div class="form-group full-width">
        <label for="cons_numero">Numero del Consultorio <span class="required">*</span></label>
        <select name="cons_numero" id="cons_numero" required>
            <?php foreach ($cons as $con): ?>
                    <option value="<?= htmlspecialchars($con['id_consultorio']) ?>"
                        <?= $con['id_consultorio'] == $hist['hist_paciente'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($pac['usua_nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

<div class="form-grid">
                    <div class="form-group">
                        <label for="codigo">Actualizado Por (Especialista)<span class="required">*</span></label>
                            <select name="hist_actualizado_por" id="hist_actualizado_por">
                                <?php foreach ($espe as $esp): ?>
                                    <option value="<?= htmlspecialchars($esp['id_especialista']) ?>"
                                        <?= $esp['id_especialista'] == $hist['hist_actualizado_por'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($esp['usua_nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                    </div
tengo este select que reitera en una consulta con inner join, quiero adaptarlo a uno que solo me traiga los datos que hay en mi tabla (es un campo normal sin inner join) y me deje seleccionado el correspondiente en la base de datos


    <div class="form-group">
        <label for="cons_estado">Estado</label>
        <select name="cons_estado" id="cons_estado" required>
            <option value="Disponible" <?= ($consultorio['cons_estado'] == "Disponible") ? 'selected' : '' ?>>Disponible</option>
            <option value="No Disponible" <?= ($consultorio['cons_estado'] == "No Disponible") ? 'selected' : '' ?>>No Disponible</option>
        </select>
    </div>
</div>
            

                <div class="button-group">
                     <a href=".././controllers/ConsultorioController.php" class="btn-link">← Cancelar</a>
                    <button type="submit" id="actualizar_consultorio">💾 Actualizar Consultorio</button>
            </div>
            </div>
        </form>
