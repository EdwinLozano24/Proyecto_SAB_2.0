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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/Assets/css/layoutFinal/paciente/layout1.css">
    <link rel="stylesheet" href="/assets/css/citas/citasAgendar1.css?v=202509023">

</head>

<body class="citas-page">
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/nav/navAgendarCita.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/aside/aside.php');
    ?>

    <main class="main-content">
        <div class="citas-container">
            <!-- Sección de agendar cita -->
            <section class="citas-section">
                <h2 class="section-title">Horas Disponibles</h2>
                <p class="section-subtitle">Programa tu cita odontológica seleccionando hora de la misma</p>

                <form id="crearCitaForm" method="POST" action="/../controllers/CitaController.php?accion=agendarHora" class="form-card">

                    <div class="form-section">

                        <div class="section-header">
                            <i class="fas fa-calendar-alt section-icon"></i>
                            <h3 class="section-title">Detalles de la Cita</h3>
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

                        <div class="form-grid">
                        
                            <div class="form-group">
                                <label for="cita_especialista">Especialista Seleccionado</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-user-doctor input-icon"></i>
                                    <input type="text" name="usua_nombre" value="<?= htmlspecialchars($especialista['usua_nombre']) ?>" readonly>
                                </div>
                            </div>
                        


                            <div class="form-group">
                                <label for="fecha">Fecha de la Cita <span class="required">*</span></label>
                                <div class="input-with-icon">
                                    <i class="fas fa-calendar input-icon"></i>
                                    <input type="date" name="cita_fecha" id="fecha" value="<?= htmlspecialchars($cita_fecha)?>">
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
                                <div id="duration-display" class="duration-info">
                                    <i class="fas fa-hourglass-half"></i>
                                    <span id="duration-text">Selecciona un motivo para ver la duración</span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group full-width">
                        <label for="observacion">Observaciones <span class="required">*</span></label>
                        <div class="textarea-container">
                            <textarea name="cita_observacion" id="observacion" required
                                placeholder="Describe el motivo de tu cita con más detalle..."
                                rows="5"></textarea>
                            <div class="textarea-footer">
                                <i class="fas fa-info-circle"></i> Sé lo más específico posible
                            </div>
                        </div>
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
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/footer.php');
    ?>

    <script src="/assets/js/cita/citaAgendar.js"></script>
</body>

</html>