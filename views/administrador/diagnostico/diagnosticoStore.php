<?php
require_once __DIR__ . '/../../config/database.php';
$pdo = conectarBD();

// Obtener tratamientos para el select
$sql = "SELECT id_tratamiento, trat_nombre FROM tbl_tratamientos";
$stmt = $pdo->query($sql);
$tratamientos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Diagnóstico</title>
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/assets/css/admin/crudPage.css';
    $cssUrl = '/assets/css/admin/crudPage.css';
    if (file_exists($cssPath)) {
        echo '<link rel="stylesheet" href="' . $cssUrl . '">';
    } else {
        echo 'CSS no encontrado en: ' . $cssPath;
    }
    ?>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">🦷</div>
            <h1>Registrar Diagnóstico</h1>
            <p class="subtitle">Sistema de Gestión Odontológica</p>
        </div>

        <form action="../../controllers/DiagnosticoController.php?accion=store" method="POST" class="form-card">
            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">📝</div>
                    Diagnóstico
                </div>
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="nombre">Nombre <span class="required">*</span></label>
                        <input type="text" name="diag_nombre" id="nombre" required>
                    </div>

                    <div class="form-group full-width">
                        <label for="descripcion">Descripción</label>
                        <input type="text" name="diag_descripcion" id="descripcion">
                    </div>

                    <div class="form-group full-width">
                        <label for="tratamiento">Tratamiento asociado <span class="required">*</span></label>
                        <select name="diag_tratamiento" id="tratamiento" required>
                            <option value="" disabled selected>Seleccionar tratamiento...</option>
                            <?php foreach ($tratamientos as $tratamiento): ?>
                                <option value="<?= $tratamiento['id_tratamiento'] ?>">
                                    <?= htmlspecialchars($tratamiento['trat_nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>
            </div>

            <div class="button-group">
                <a href="../../controllers/DiagnosticoController.php?accion=index" class="btn-link">← Cancelar</a>
                <button type="submit">💾 Registrar Diagnóstico</button>
            </div>
        </form>
    </div>
</body>
</html>
