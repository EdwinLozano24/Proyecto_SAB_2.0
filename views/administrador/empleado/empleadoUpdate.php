<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Empleado - Sistema Odontológico</title>
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
</head>


<body>
    <div class="container">
        <div class="header">
            <div class="logo">🦷</div>
            <h1>Actualizar Información del Empleado</h1>
            <p class="subtitle">Sistema de Gestión Odontológica</p>
        </div>

        <form action="../controllers/EmpleadoController.php?accion=update" method="POST" class="form-card">
            <input type="hidden" name="id_empleado" value="<?= $cons['id_empleado'] ?>">


            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">👤</div>
                    Información del Empleado
                </div>
                <div class="form-grid">
                    <div class="form-group">

                        <label for="empl_usuario">Nombre del empleado<span class="required">*</span></label>
                        <select name="empl_usuario" id="empl_usuario" required>
                            <option value="">Seleccione un empleado</option>
                            <?php foreach ($consAll as $empleado): ?>
                                <option value="<?= $empleado['empl_usuario'] ?>" <?= $empleado['empl_usuario'] == $cons['empl_usuario'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($empleado['empl_usuario']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            
                            
                            <div class="form-group">
                                <label for="estado">Estado <span class="required">*</span></label>
                                <select name="empl_estado" id="estado" required>
                                    <option value="" disabled selected>Seleccionar estado</option>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                                
                                <div class="button-group">
                                    <button type="button" class="btn-secondary" onclick="window.history.back()">
                                        ← Cancelar
                                    </button>
                                    <input type="submit" id="generar_cita" value="💉 Actualizar Empleado">
                                </div>
                            </div>




                    
        </form>
    </div>

</body>

</html>