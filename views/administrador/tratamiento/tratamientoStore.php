<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/auth.php';
requiereSesion();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
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
            <h1>Registrar Tratamiento</h1>
            <p class="subtitle">Sistema de Gestión Odontológica</p>
        </div>

        <form action="/controllers/TratamientoController.php?accion=store" method="POST" class="form-card">
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
                        <input type="text" name="trat_descripcion" id="descripcion">
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
                <button type="button" class="btn-secondary" onclick="window.history.back()">
                    ← Cancelar
                </button>
                <input type="submit" id="generar_cita" value="💉 Registrar Tratamiento">
            </div>
        </form>
    </div>
</body>
</html>
