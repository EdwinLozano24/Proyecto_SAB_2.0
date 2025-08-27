<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <div class="logo">📋</div>
            <h1>Resultado de la Cita</h1>
            <p class="subtitle">Complete la información para crear un nuevo registro en el sistema</p>
        </div>

        <form id="registroForm" action="#" method="POST">
            <div class="info-card">
                <h3>Información importante</h3>
                <p>Los campos marcados con asterisco (*) son obligatorios. Asegúrese de completar toda la información requerida antes de enviar.</p>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">1</div>
                    Información Básica
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nombre">Nombre <span class="required">*</span></label>
                        <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre" required>
                    </div>

                    <div class="form-group">
                        <label for="ct_cita">Código de Cita</label>
                        <input type="number" id="ct_cita" name="ct_cita" placeholder="Ingrese el código de cita" min="1">
                    </div>

                    <div class="form-group">
                        <label for="ct_diagnostico">Código de Diagnóstico</label>
                        <input type="number" id="ct_diagnostico" name="ct_diagnostico" placeholder="Ingrese el código de diagnóstico" min="1">
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">2</div>
                    Detalles del Registro
                </div>
                
                <div class="info-card">
                    <h3>Información editable</h3>
                    <p contenteditable="true" class="editable-info">
                        Aquí puede agregar información adicional que considere relevante para este registro. 
                        Este texto es completamente editable - haga clic para modificarlo según sus necesidades.
                    </p>
                </div>

                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="ct_observaciones">Observaciones <span class="required">*</span></label>
                        <textarea id="ct_observaciones" name="ct_observaciones" placeholder="Ingrese las observaciones detalladas..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="ct_fecha_aplicacion">Fecha de Aplicación <span class="required">*</span></label>
                        <input type="date" id="ct_fecha_aplicacion" name="ct_fecha_aplicacion" required>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">3</div>
                    Estado del Proceso
                </div>

                <div class="info-card" style="background: #fefce8; border-color: #fde047;">
                    <h3 style="color: #a16207;">⚠️ Aviso Importante</h3>
                    <p style="color: #a16207;">
                        El estado del proceso es crucial para el seguimiento del registro. 
                        Asegúrese de seleccionar el estado correcto según el avance actual del procedimiento.
                    </p>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="estado">Estado del Proceso <span class="required">*</span></label>
                        <select id="estado" name="estado" required>
                            <option value="">Seleccione un estado</option>
                            <option value="proceso">En Proceso</option>
                            <option value="cumplida">Cumplida</option>
                            <option value="incumplida">Incumplida</option>
                            <option value="pendiente">Pendiente</option>
                            <option value="cancelada">Cancelada</option>
                        </select>
                        <div class="error-message">Debe seleccionar un estado</div>
                    </div>

                    <div class="form-group">
                        <div class="status-preview" id="statusPreview" style="margin-top: 28px;">
                            <span class="status-indicator status-proceso" style="display: none;">
                                🔄 En Proceso
                            </span>
                            <span class="status-indicator status-cumplida" style="display: none;">
                                ✅ Cumplida
                            </span>
                            <span class="status-indicator status-incumplida" style="display: none;">
                                ❌ Incumplida
                            </span>
                            <span class="status-indicator" style="display: none; background: #f3f4f6; color: #6b7280;">
                                ⏳ Pendiente
                            </span>
                            <span class="status-indicator" style="display: none; background: #fef2f2; color: #991b1b;">
                                🚫 Cancelada
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="button-group">
                <button type="button" class="btn-secondary" onclick="limpiarFormulario()">
                    Limpiar
                </button>
                <input type="submit" value="Guardar Registro">
            </div>
        </form>
    </div>
</body>
</html>