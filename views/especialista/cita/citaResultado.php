<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado Cita</title>
    <!-- CSS de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/Assets/css/especialista/citaResultado.css';
    $cssUrl = '/Assets/css/especialista/citaResultado.css';
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
            <p class="subtitle">Complete la información para atender la cita</p>
        </div>

        <form id="registroForm" action="/controllers/CitaController.php?accion=store_resultado_cita" method="POST">
            <input type="hidden" name="resu_cita" value="<?= htmlspecialchars($cita['id_cita']) ?>">
            <input type="hidden" name="id_cita" value="<?= htmlspecialchars($cita['id_cita']) ?>">
            <div class="info-card">
                <h3>Información importante</h3>
                <p>Los campos marcados con asterisco " * " son obligatorios. Asegúrese de completar toda la información requerida antes de enviar.</p>
            </div>

            <div class="form-section">

                <div class="section-title">
                    <div class="section-icon">1</div>
                    Información de la Cita
                </div>
                
                <div class="form-grid">

                    <div class="form-group">
                        <label for="cita_paciente">Nombre del Paciente</label>
                        <input type="text" id="cita_paciente" name="cita_paciente" value="<?= htmlspecialchars($cita['cita_paciente']) ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="cita_motivo">Motivo de la Cita</label>
                        <input type="text" id="cita_motivo" name="cita_motivo" value="<?= htmlspecialchars($cita['cita_motivo']) ?>" readonly>
                    </div>

                    <div class="form-group full-width">
                        <label for="cita_observacion">Observaciones</label>
                        <input type="text" id="cita_observacion" name="cita_observacion" value="<?= htmlspecialchars($cita['cita_observacion']) ?>" placeholder="N/A" readonly>
                    </div>

                </div>

            </div>

            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">2</div>
                    Resultado de la Cita
                </div>

                <div class="form-grid">

                    <div class="form-group full-width">
                        <label for="resu_detalle">Detalles de la Cita<span class="required"> *</span></label>
                        <textarea id="resu_detalle" name="resu_detalle" placeholder="Ingrese los detalles de la cita tan claros como sean posibles..." required></textarea>
                    </div>

                    <div class="form-group full-width">
                        <label for="resu_recomendacion">Recomendaciones<span class="required"> *</span></label>
                        <textarea id="resu_detalle" name="resu_recomendacion" placeholder="Ingrese las recomendaciones tan claras como sean posibles..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="resu_diagnostico">Diagnostico<span class="required"> *</span></label>
                        <select name="resu_diagnostico" id="resu_diagnostico" class="form-control select2" required>
                            <option value="" disabled selected>Seleccionar diagnostico...</option>
                                <?php foreach ($diags as $diag): ?>
                                    <option value="<?= $diag['id_diagnostico'] ?>">
                                        <?= $diag['diag_nombre'] ?>
                                    </option>
                            <?php endforeach; ?>
                        </select>
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
                        Cambie el estado a "Cumplida" si desea finalizar definitivamente la cita (Esto la eliminara de sus citas pendientes).
                    </p>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="cita_estado">Estado del Proceso <span class="required"> *</span></label>
                        <select id="cita_estado" name="cita_estado" required>
                            <option value="Proceso">En Proceso</option>
                            <option value="Cumplida">Cumplida</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="button-group">
                <button type="button" class="btn-secondary" onclick="window.history.back()">
                    ← Cancelar
                </button>
                <input type="submit" value="Guardar Resultado">
            </div>
        </form>
    </div>
<!-- JS de jQuery y Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="script.js"></script> -->
    <script>
$(document).ready(function() {
    $('#resu_diagnostico').select2();
});
</script>
</body>
</html>