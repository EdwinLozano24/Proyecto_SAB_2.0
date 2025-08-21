<?php
require_once '../config/auth.php';
requiereSesion();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Historial Clinico</title>
    <!-- CSS de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
            <h1>Actualizar Historial Clinico</h1>
            <p class="subtitle">Sistema de Gestión Odontológica</p>
        </div>

        <form action="../controllers/HistorialController.php?accion=update" method="POST" class="form-card">
            <input type="hidden" name="id_historial" value="<?= $hist['id_historial'] ?>">

            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">👤</div>
                    Datos del Paciente
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="codigo">Nombre del Paciente<span class="required">*</span></label>
                        <select name="hist_paciente" id="hist_paciente">
                            <?php foreach ($paci as $pac): ?>
                                <option value="<?= htmlspecialchars($pac['id_paciente']) ?>"
                                    <?= $pac['id_paciente'] == $hist['hist_paciente'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($pac['usua_nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Antecedentes Personales<span class="required">*</span></label>
                        <input type="text" name="hist_antecedentes_personales" id="hist_antecedentes_personales"
                            value="<?= $hist['hist_antecedentes_personales'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Antecedentes Familiares<span class="required">*</span></label>
                        <input type="text" name="hist_antecedentes_familiares" id="hist_antecedentes_familiares"
                            value="<?= $hist['hist_antecedentes_familiares'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Medicamentos Actuales<span class="required">*</span></label>
                        <input type="text" name="hist_medicamentos_actuales" id="hist_medicamentos_actuales"
                            value="<?= $hist['hist_medicamentos_actuales'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Alergias<span class="required">*</span></label>
                        <input type="text" name="hist_alergias" id="hist_alergias" value="<?= $hist['hist_alergias'] ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="codigo">Diagnostico Asignado<span class="required">*</span></label>
                        <select name="hist_diagnostico" id="hist_diagnostico">
                            <?php foreach ($diag as $dia): ?>
                                <option value="<?= htmlspecialchars($dia['id_diagnostico']) ?>"
                                    <?= $dia['id_diagnostico'] == $hist['hist_diagnostico'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($dia['diag_nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estado">Odontograma<span class="required">*</span></label>
                        <select name="hist_odontograma" id="hist_odontograma" required>
                            <option value="" disabled>¿Posee Odontograma?</option>
                            <option value="1" <?= ($hist['hist_odontograma'] == "1") ? 'selected' : '' ?>>Si</option>
                            <option value="0" <?= ($hist['hist_odontograma'] == "0") ? 'selected' : '' ?>>No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Indice DMFT<span class="required">*</span></label>
                        <input type="integer" name="hist_indice_dmft" id="hist_indice_dmft"
                            value="<?= $hist['hist_indice_dmft'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="estado">Frecuencia de Cepillado<span class="required">*</span></label>
                        <select name="hist_frecuencia_cepillado" id="hist_frecuencia_cepillado" required>
                            <option value="" disabled>¿Frecuencia de Cepillado?</option>
                            <option value="1 vez/dia" <?= ($hist['hist_frecuencia_cepillado'] == "1 vez/dia") ? 'selected' : '' ?>>Una vez al dia</option>
                            <option value="2 veces/dia" <?= ($hist['hist_frecuencia_cepillado'] == "2 veces/dia") ? 'selected' : '' ?>>Dos veces al dia</option>
                            <option value=">2 veces/dia" <?= ($hist['hist_frecuencia_cepillado'] == ">2 veces/dia") ? 'selected' : '' ?>>Mas de dos veces al dia</option>
                            <option value="Ocasional" <?= ($hist['hist_frecuencia_cepillado'] == "Ocasional") ? 'selected' : '' ?>>Ocasionalmente</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estado">Hilo Dental<span class="required">*</span></label>
                        <select name="hist_hilo_dental" id="hist_hilo_dental" required>
                            <option value="" disabled>¿Usa Hilo Dental?</option>
                            <option value="1" <?= ($hist['hist_hilo_dental'] == "1") ? 'selected' : '' ?>>Si</option>
                            <option value="0" <?= ($hist['hist_hilo_dental'] == "0") ? 'selected' : '' ?>>No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estado">Enjuague Bucal<span class="required">*</span></label>
                        <select name="hist_enjuague_bucal" id="hist_enjuague_bucal" required>
                            <option value="" disabled>¿Usa Enjuague Bucal?</option>
                            <option value="1" <?= ($hist['hist_enjuague_bucal'] == "1") ? 'selected' : '' ?>>Si</option>
                            <option value="0" <?= ($hist['hist_enjuague_bucal'] == "0") ? 'selected' : '' ?>>No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estado">Sensibilidad Dental<span class="required">*</span></label>
                        <select name="hist_sensibilidad_dental" id="hist_sensibilidad_dental" required>
                            <option value="" disabled>¿Posee sensibilidad dental?</option>
                            <option value="Ninguna" <?= ($hist['hist_sensibilidad_dental'] == "Ninguna") ? 'selected' : '' ?>>Ninguna</option>
                            <option value="Frío" <?= ($hist['hist_sensibilidad_dental'] == "Frío") ? 'selected' : '' ?>>
                                Frío</option>
                            <option value="Calor" <?= ($hist['hist_sensibilidad_dental'] == "Calor") ? 'selected' : '' ?>>
                                Calor</option>
                            <option value="Dulce" <?= ($hist['hist_sensibilidad_dental'] == "Dulce") ? 'selected' : '' ?>>
                                Dulce</option>
                            <option value="Oclusion" <?= ($hist['hist_sensibilidad_dental'] == "Oclusion") ? 'selected' : '' ?>>Oclusion</option>
                        </select>
                    </div>

                </div>

                <br>

                <div class="section-title">
                    <div class="section-icon">👤</div>
                    Datos de Manejo
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="codigo">Actualizado Por (Especialista)<span class="required">*</span></label>
                        <select name="hist_actualizado_por" id="hist_actualizado_por">
                            <?php foreach ($espe as $esp): ?>
                                <option value="<?= htmlspecialchars($esp['id_especialista']) ?>"
                                    <?= $esp['id_especialista'] == $hist['hist_actualizado_por'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($esp['usua_nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado<span class="required">*</span></label>
                        <select name="hist_estado" id="hist_estado" required>
                            <option value="" disabled>Estado</option>
                            <option value="Activo" <?= ($hist['hist_estado'] == "Activo") ? 'selected' : '' ?>>Activo
                            </option>
                            <option value="Inactivo" <?= ($hist['hist_estado'] == "Inactivo") ? 'selected' : '' ?>>Inactivo
                            </option>
                        </select>
                    </div>



                </div>
            </div>

            <div class="button-group">
                <button type="button" class="btn-secondary" onclick="window.history.back()">
                    ← Cancelar
                </button>
                <input type="submit" id="generar_cita" value="📋 Actualizar Historial Clinico">
            </div>
        </form>
    </div>

    <!-- JS de jQuery y Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="script.js"></script> -->
    <script>
        $(document).ready(function () {
            $('#hist_paciente, #hist_actualizado_por').select2();
            });

    </script>
</body>

</html>