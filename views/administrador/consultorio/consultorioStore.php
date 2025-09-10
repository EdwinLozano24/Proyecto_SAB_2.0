<?php
require_once __DIR__ . '/../config/database.php';
$pdo = conectarBD();

// Obtener todas las categorías para el select
$sql = "SELECT * FROM tbl_consultorios  ";
$stmt = $pdo->query($sql);
$consultorios = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Consultorio</title>
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/assets/css/admin/crudUsuario.css';
    $cssUrl = '/assets/css/admin/crudUsuario.css';
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
            <h1>Registrar Consultorio Odontologico</h1>
            <p class="subtitle">Sistema de Gestión Odontológica</p>
        </div>

        <form action="/controllers/ConsultorioController.php?accion=store" method="POST" class="form-card">
            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">💊</div>
                    Datos del Consultorio
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="codigo">Numero Consultorio <span class="required">*</span></label>
                        <input type="text" name="cons_numero" id="numero" required>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado <span class="required">*</span></label>
                        <select name="cons_estado" id="estado" required>
                            <option value="" disabled selected>Seleccionar estado</option>
                            <option value="Disponible">Disponible</option>
                            <option value="No Disponible">No Disponible</option>
                        </select>

            <div class="button-group">
                <a href="/controllers/ConsultorioController.php?accion=index" class="btn-link">← Cancelar</a>
                <button type="submit">💾 Registrar Consultorio</button>
            </div>
        </form>
    </div>
</body>
</html>
