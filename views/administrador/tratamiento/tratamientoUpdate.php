<?php
require_once '../config/auth.php';
requiereSesion();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
$pdo = conectarBD();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Tratamiento - Sistema Odontológico</title>
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
            <h1>Actualizar Tratamiento</h1>
            <p class="subtitle">Sistema de Gestión Odontológica</p>
        </div>

        <form action="/../controllers/TratamientoController.php?accion=update" method="POST" class="form-card">
            <input type="hidden" name="id_tratamiento" value="<?= $trat['id_tratamiento'] ?>">

            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">💊</div>
                    Información del Tratamiento
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="codigo">Código <span class="required">*</span></label>
                        <input type="text" name="trat_codigo" id="codigo" value="<?= $trat['trat_codigo'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre <span class="required">*</span></label>
                        <input type="text" name="trat_nombre" id="nombre" value="<?= $trat['trat_nombre'] ?>" required>
                    </div>

                    <div class="form-group">
                        <select name="trat_categoria" id="trat_categoria">
                            <?php foreach ($cate as $cat): ?>
                                <option value="<?= htmlspecialchars($cat['id_categoria']) ?>"
                                    <?= $cat['id_categoria'] == $trat['trat_categoria'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cat['cate_nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="duracion_minutos">Duración por sesión (minutos)</label>
                        <input type="number" name="trat_duracion_minutos" id="duracion_minutos"
                            value="<?= $trat['trat_duracion_minutos'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="riesgos">Riesgos</label>
                        <input type="text" name="trat_riesgos" id="riesgos" value="<?= $trat['trat_riesgos'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="duracion">Duración estimada</label>
                        <input type="text" name="trat_duracion" id="duracion" value="<?= $trat['trat_duracion'] ?>">
                    </div>

                    <div class="form-group full-width">
                        <label for="descripcion">Descripción</label>
                        <input type="text" name="trat_descripcion" id=descripcion
                            value="<?= $trat['trat_descripcion'] ?>">

                    </div>

                    <div class="form-group">
                        <label for="complejidad">Complejidad</label>
                        <select name="trat_complejidad" id="complejidad" required>
                            <option value="Baja" <?= ($trat['trat_complejidad'] == "Baja") ? 'selected' : '' ?>>Baja
                            </option>
                            <option value="Media" <?= ($trat['trat_complejidad'] == "Media") ? 'selected' : '' ?>>Media
                            </option>
                            <option value="Alta" <?= ($trat['trat_complejidad'] == "Alta") ? 'selected' : '' ?>>Alta
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select name="trat_estado" id="estado" required>
                            <option value="Activo" <?= ($trat['trat_estado'] == "Activo") ? 'selected' : '' ?>>Activo
                            </option>
                            <option value="Inactivo" <?= ($trat['trat_estado'] == "Inactivo") ? 'selected' : '' ?>>Inactivo
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="button-group">
                <button type="button" class="btn-secondary" onclick="window.history.back()">
                    ← Cancelar
                </button>
                <input type="submit" id="generar_cita" value="💉 Actualizar Tratamiento">
            </div>
            </div>
        </form>
    </div>
</body>

</html>