<?php
require_once __DIR__ . '/../../config/database.php';
$pdo = conectarBD();

// Validar que venga el ID por GET
if (!isset($_GET['id_diagnostico'])) {
    echo "ID de diagnóstico no proporcionado.";
    exit;
}

$id = $_GET['id_diagnostico'];

// Obtener diagnóstico actual
$sql = "SELECT * FROM tbl_diagnosticos WHERE id_diagnostico = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$diagnostico = $stmt->fetch();

if (!$diagnostico) {
    echo "Diagnóstico no encontrado.";
    exit;
}

// Obtener tratamientos para el select
$sqlTratamientos = "SELECT id_tratamiento, trat_nombre FROM tbl_tratamientos";
$stmtTratamientos = $pdo->query($sqlTratamientos);
$tratamientos = $stmtTratamientos->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Diagnóstico</title>
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/proyecto_sab/assets/css/admin/crudUsuario.css';
    $cssUrl = '/proyecto_sab/assets/css/admin/crudUsuario.css';
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
            <h1>Actualizar Diagnóstico</h1>
            <p class="subtitle">Sistema de Gestión Odontológica</p>
        </div>

        <form action="../../controllers/DiagnosticoController.php?accion=update" method="POST" class="form-card">
            <input type="hidden" name="id_diagnostico" value="<?= $diagnostico['id_diagnostico'] ?>">

            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">📝</div>
                    Diagnóstico
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="nombre">Nombre <span class="required">*</span></label>
                        <input type="text" name="diag_nombre" id="nombre" required value="<?= htmlspecialchars($diagnostico['diag_nombre']) ?>">
                    </div>

                    <div class="form-group full-width">
                        <label for="descripcion">Descripción</label>
                        <input type="text" name="diag_descripcion" id="descripcion" value="<?= htmlspecialchars($diagnostico['diag_descripcion']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="tratamiento">Tratamiento asociado <span class="required">*</span></label>
                        <select name="diag_tratamiento" id="tratamiento" required>
                            <option value="" disabled>Seleccionar tratamiento...</option>
                            <?php foreach ($tratamientos as $tratamiento): ?>
                                <option value="<?= $tratamiento['id_tratamiento'] ?>" 
                                    <?= $tratamiento['id_tratamiento'] == $diagnostico['diag_tratamiento'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($tratamiento['trat_nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado <span class="required">*</span></label>
                        <select name="diag_estado" id="estado" required>
                            <option value="Activo" <?= $diagnostico['diag_estado'] === 'Activo' ? 'selected' : '' ?>>Activo</option>
                            <option value="Inactivo" <?= $diagnostico['diag_estado'] === 'Inactivo' ? 'selected' : '' ?>>Inactivo</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="button-group">
                <a href="../../controllers/DiagnosticoController.php?accion=index" class="btn-link">← Cancelar</a>
                <button type="submit">💾 Actualizar Diagnóstico</button>
            </div>
        </form>
    </div>
</body>
</html>
