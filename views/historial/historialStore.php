<?php
require_once __DIR__ . '/../../config/database.php';
$pdo = conectarBD();
$sql = "SELECT * FROM tbl_pacientes
    INNER JOIN tbl_usuarios ON paci_usuario = id_usuario";
$stmt = $pdo->query($sql);
$pacientes = $stmt->fetchAll();

$sql = "SELECT * FROM tbl_especialistas
    INNER JOIN tbl_usuarios ON espe_usuario = id_usuario";
$stmt = $pdo->query($sql);
$especialistas = $stmt->fetchAll();

$sql = "SELECT * FROM tbl_diagnosticos";
$stmt = $pdo->query($sql);
$diagnosticos = $stmt->fetchAll();

$sql = "SELECT * FROM tbl_usuarios";
$stmt = $pdo->query($sql);
$usuarios = $stmt->fetchAll();

$sql = "SELECT * FROM tbl_tratamientos";
$stmt = $pdo->query($sql);
$tratamientos = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Historial Clinico</title>
    <!-- CSS de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/proyecto_sab/assets/css/admin/crudUsuario.css';
    $cssUrl = '/proyecto_sab/assets/css/admin/crudUsuario.css';
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
            <h1>Registrar Historial Clinico</h1>
            <p class="subtitle">Sistema de Gestión Odontológica SAB</p>
        </div>

        <form action="../../controllers/HistorialController.php?accion=store" method="POST" class="form-card">
            <div class="form-section">

                <div class="section-title">
                    <div class="section-icon">👤</div>
                    Datos del Paciente
                </div>

                <div class="form-grid">

                    <div class="form-group">
                        <label for="codigo">Nombre del Paciente<span class="required">*</span></label>
                        <select name="hist_paciente" id="hist_paciente" class="form-control select2" required>
                            <option value="" disabled selected>Seleccionar un paciente..</option>
                            <?php foreach ($pacientes as $paciente): ?>
                                <option value="<?= $paciente['id_paciente'] ?>">
                                    <?= $paciente['usua_nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Antecedentes Personales<span class="required">*</span></label>
                        <input type="text" placeholder="Ingrese los antecedentes personales..."
                            name="hist_antecedentes_personales" id="hist_antecedentes_personales">
                    </div>

                    <div class="form-group">
                        <label for="nombre">Antecedentes Familiares<span class="required">*</span></label>
                        <input type="text" placeholder="Ingrese los antecedentes familiares"
                            name="hist_antecedentes_familiares" id="hist_antecedentes_familiares...">
                    </div>

                    <div class="form-group">
                        <label for="nombre">Medicamentos Actuales<span class="required">*</span></label>
                        <input type="text" placeholder="Ingrese los Medicamentos actuales..."
                            name="hist_medicamentos_actuales" id="hist_medicamentos_actuales">
                    </div>

                    <div class="form-group">
                        <label for="nombre">Alergias<span class="required">*</span></label>
                        <input type="text" placeholder="Ingrese las alergias del paciente..." name="hist_alergias"
                            id="hist_alergias">
                    </div>

                    <div class="form-group">
                        <label for="codigo">Diagnostico Asignado<span class="required">*</span></label>
                        <select name="hist_diagnostico" id="hist_diagnostico">
                            <option value="" disabled selected>Seleccionar diagnostico...</option>
                            <?php foreach ($diagnosticos as $diagnostico): ?>
                                <option value="<?= $diagnostico['id_diagnostico'] ?>">
                                    <?= $diagnostico['diag_nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estado">Odontograma<span class="required">*</span></label>
                        <select name="hist_odontograma" id="hist_odontograma" required>
                            <option value="" disabled selected>¿Posee Odontograma?</option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Indice DMFT<span class="required">*</span></label>
                        <input type="integer" placeholder="Ingrese el indice DMFT" name="hist_indice_dmft"
                            id="hist_indice_dmft">
                    </div>

                    <div class="form-group">
                        <label for="estado">Frecuencia de Cepillado<span class="required">*</span></label>
                        <select name="hist_frecuencia_cepillado" id="hist_frecuencia_cepillado" required>
                            <option value="" disabled selected>Seleccionar frecuencia...</option>
                            <option value="1 vez/dia">Una vez al dia</option>
                            <option value="2 veces/dia">Dos veces al dia</option>
                            <option value=">2 veces/dia">Mas de dos veces al dia</option>
                            <option value="Ocasional">Ocasionalmente</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estado">Hilo Dental<span class="required">*</span></label>
                        <select name="hist_hilo_dental" id="hist_hilo_dental" required>
                            <option value="" disabled selected>¿Usa Hilo Dental?</option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estado">Enjuague Bucal<span class="required">*</span></label>
                        <select name="hist_enjuague_bucal" id="hist_enjuague_bucal" required>
                            <option value="" disabled selected>¿Usa Enjuague Bucal?</option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estado">Sensibilidad Dental<span class="required">*</span></label>
                        <select name="hist_sensibilidad_dental" id="hist_sensibilidad_dental" required>
                            <option value="" disabled selected>¿Posee sensibilidad dental?</option>
                            <option value="Ninguna">Ninguna</option>
                            <option value="Frío">Frío</option>
                            <option value="Calor">Calor</option>
                            <option value="Dulce">Dulce</option>
                            <option value="Oclusion">Oclusion</option>
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
                        <label for="codigo">Creado Por (Especialista)<span class="required">*</span></label>
                        <select name="hist_creado_por" id="hist_creado_por">
                            <option value="" disabled selected>Seleccionar un especialista..</option>
                            <?php foreach ($especialistas as $especialista): ?>
                                <option value="<?= $especialista['id_especialista'] ?>">
                                    <?= $especialista['usua_nombre'] ?>
                                </option>
                            <?php endforeach; ?>>
                        </select>
                    </div>
                </div>
            </div>

            <div class="button-group">
                <a href="/proyecto_sab/controllers/HistorialController.php?accion=index" class="btn-link">← Cancelar</a>
                <button type="submit" id="Guardar_Historial">💾 Guardar Historial</button>
            </div>
        </form>
    </div>
    <!-- JS de jQuery y Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="script.js"></script> -->
    <script>
        $(document).ready(function () {
            $('#hist_paciente, #hist_creado_por').select2({
                allowClear: true
            });
        });
    </script>
</body>

</html>