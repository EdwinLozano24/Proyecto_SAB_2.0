<?php
require_once __DIR__ . '/../../config/database.php';
$pdo = conectarBD();

// Obtener todas las categorías para el select
$sql = "SELECT * FROM tbl_categorias_tratamientos";
$stmt = $pdo->query($sql);
$categorias = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Tratamiento - Sistema Odontológico</title>
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
            <h1>Registrar Tratamiento</h1>
            <p class="subtitle">Sistema de Gestión Odontológica</p>
        </div>

        <form action="../../controllers/TratamientoController.php?accion=store" method="POST" class="form-card">
            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">💊</div>
                    Datos del Tratamiento
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="codigo">Código <span class="required">*</span></label>
                        <input type="text" name="trat_codigo" id="codigo" required>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre <span class="required">*</span></label>
                        <input type="text" name="trat_nombre" id="nombre" required>
                    </div>

                    <div class="form-group">
                        <label for="categoria">Categoría <span class="required">*</span></label>
                        <select name="trat_categoria" id="categoria" required>
                            <option value="" disabled selected>Seleccionar categoría...</option>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria['id_categoria'] ?>">
                                    <?= $categoria['cate_nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="duracion_min">Duración (minutos)</label>
                        <input type="number" name="trat_duracion_minutos" id="duracion_min">
                    </div>

                    <div class="form-group">
                        <label for="duracion_texto">Duración (texto)</label>
                        <input type="text" name="trat_duracion" id="duracion_texto">
                    </div>

                    <div class="form-group">
                        <label for="riesgos">Riesgos</label>
                        <input type="text" name="trat_riesgos" id="riesgos">
                    </div>

                    <div class="form-group">
                        <label for="complejidad">Complejidad</label>
                        <select name="trat_complejidad" id="complejidad">
                            <option value="" disabled selected>Seleccionar</option>
                            <option value="Baja">Baja</option>
                            <option value="Media">Media</option>
                            <option value="Alta">Alta</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label for="descripcion">Descripción</label>
                        <textarea name="trat_descripcion" id="descripcion" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado <span class="required">*</span></label>
                        <select name="trat_estado" id="estado" required>
                            <option value="" disabled selected>Seleccionar estado</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="button-group">
                <a href="./../controllers/TratamientoController.php" class="btn-link">← Cancelar</a>
                <button type="submit">💾 Registrar Tratamiento</button>
            </div>
        </form>
    </div>
</body>
</html>
