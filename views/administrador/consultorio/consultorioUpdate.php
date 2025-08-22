<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Consultorio</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/assets/css/admin/crudCitas.css';
    $cssUrl = '/assets/css/admin/crudCitas.css';
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
            <input type="hidden" name="id_consultorio" value="<?= $cons['id_consultorio'] ?>">
            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">👤</div>
                    Consultorio
                </div>
                <div class="form-grid">
    <div class="form-group full-width">
                    <div>
                        <label for="codigo">Actualizado Por (Especialista)<span class="required">*</span></label>
                            <select name="cons_numero" id="cons_numero">
                                <?php foreach ($consAll as $con): ?>
                                    <option value="<?= htmlspecialchars($con['cons_numero']) ?>"
                                        <?= $con['id_consultorio'] == $cons['id_consultorio'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($con['cons_numero']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="cons_estado">Estado</label>
                            <select name="cons_estado" id="cons_estado" required>
                                <option value="Disponible" <?= ($cons['cons_estado'] == "Disponible") ? 'selected' : '' ?>>Disponible</option>
                                <option value="No Disponible" <?= ($cons['cons_estado'] == "No Disponible") ? 'selected' : '' ?>>No Disponible</option>
                            </select>
                     </div>
    </div>
                        



</div>
            

                <div class="button-group">
                     <a href=".././controllers/ConsultorioController.php" class="btn-link">← Cancelar</a>
                    <button type="submit" id="actualizar_consultorio">💾 Actualizar Consultorio</button>
            </div>
            </div>
        </form>
