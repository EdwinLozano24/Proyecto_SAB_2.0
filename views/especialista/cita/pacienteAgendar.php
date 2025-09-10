<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/auth.php';
requiereSesion();

$id_usuario = $_SESSION['usuario']['id_usuario'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita</title>
    <!-- CSS de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/Assets/css/layoutFinal/paciente/layout1.css">
    <link rel="stylesheet" href="/assets/css/citas/citasAgendar1.css?v=20250909">

</head>

<body class="citas-page">
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/especialista/header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/especialista/nav/navAgendarCita.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/especialista/aside/aside.php');
    ?>

    <main class="main-content">
        <div class="citas-container">
            <!-- Sección de agendar cita -->
            <section class="citas-section">
                <h2 class="section-title">Agendar Nueva Cita</h2>
                <p class="section-subtitle">Programa tu cita odontológica seleccionando la fecha, hora y motivo de consulta</p>


                <form id="crearCitaForm" method="POST" action="/../controllers/CitaController.php?accion=agendarHora&rol=Especialista" class="form-card">
                    <input type="hidden" name="origen_formulario" value="Usuario">
                    <input type="hidden" name="pqrs_usuario" value="<?php echo $_SESSION['usuario']['id_usuario']; ?>">




                    <div class="form-section">
                        <div class="section-header">
                            <i class="fas fa-calendar-alt section-icon"></i>
                            <h3 class="section-title">Detalles de la Cita</h3>
                        </div>


                        <div class="form-grid">
                        
                            <div class="form-group">
                                <label for="cita_paciente">Paciente<span class="required">*</span></label>
                                <div class="input-with-icon">
                                    <i class="fas fa-user-doctor input-icon"></i>
                                    <select name="cita_paciente" id="cita_paciente" class="form-control select2" required>
                                        <option value="">Seleccionar paciente...</option>
                                        <?php foreach ($pacientes as $paciente): ?>
                                            <option value="<?= $paciente['id_paciente'] ?>">
                                                <?= $paciente['usua_nombre'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cita_especialista">Especialista <span class="required">*</span></label>
                                <div class="input-with-icon">
                                    <i class="fas fa-user-doctor input-icon"></i>
                                    <select name="id_especialista" id="id_especialista" class="form-control select2" required>
                                        <option value="">Seleccionar especialista...</option>
                                        <?php foreach ($especialistas as $especialista): ?>
                                            <option value="<?= $especialista['id_especialista'] ?>">
                                                <?= $especialista['usua_nombre'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        

                            <div class="form-group">
                                <label for="motivo">Motivo de la Cita <span class="required">*</span></label>
                                <div class="input-with-icon">
                                    <i class="fas fa-stethoscope input-icon"></i>
                                    <select name="cita_motivo" id="motivo" required>
                                        <option value="" disabled selected>Selecciona el motivo</option>
                                        <option value="Consulta general" data-duration="30">Consulta General (30 min)</option>
                                        <option value="Control" data-duration="20">Control (20 min)</option>
                                        <option value="Urgencia" data-duration="45">Urgencia (45 min)</option>
                                        <option value="Seguimiento" data-duration="25">Seguimiento (25 min)</option>
                                        <option value="Examen" data-duration="40">Examen (40 min)</option>
                                        <option value="Otro" data-duration="30">Otro (30 min)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fecha">Fecha de la Cita <span class="required">*</span></label>
                                <div class="input-with-icon">
                                    <i class="fas fa-calendar input-icon"></i>
                                    <input type="date" name="cita_fecha" id="fecha" required min="">
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="form-info-card">
                        <div class="info-card-header">
                            <i class="fas fa-info-circle"></i>
                            <h3>Información importante</h3>
                        </div>
                        <ul class="info-list">
                            <li><i class="fas fa-clock"></i> Las citas deben programarse con 24 horas de anticipación</li>
                            <li><i class="fas fa-user-md"></i> Se asignará automáticamente el especialista más adecuado</li>
                            <li><i class="fas fa-ban"></i> Cancela con mínimo 2 horas de anticipación</li>
                            <li><i class="fas fa-calendar-check"></i> Llega 10 minutos antes de tu cita</li>
                            <li><i class="fas fa-phone-alt"></i> En urgencias, contacta directamente al consultorio</li>
                        </ul>
                    </div>

                    <div class="button-group">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                            <i class="fas fa-arrow-left"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-calendar-plus"></i> Agendar Cita
                        </button>
                    </div>

                </form>
            </section>
        </div>
    </main>

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/especialista/footer.php');
    ?>

    <script src="/assets/js/cita/citaAgendar.js"></script>
    <!-- JS de jQuery y Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="script.js"></script> -->
    <script>
$(document).ready(function() {
    $('#cita_especialista, #cita_paciente').select2();
});
</script>
</body>

</html>