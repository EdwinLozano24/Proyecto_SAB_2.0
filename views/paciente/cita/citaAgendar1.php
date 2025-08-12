<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agendar Cita</title>
    <link rel="stylesheet" href='/proyecto_sab/assets/css/layoutFinal/paciente/layout.css'>
    <link rel="stylesheet" href='/proyecto_sab/assets/css/citas/citasAgendar1.css'>
</head>

<body class="citas-page">
    <?php
    session_start();
    include '../layoutsFinal/paciente/header.php';
    include '../layoutsFinal/paciente/nav.php';
    include '../layoutsFinal/paciente/aside.php';
    ?>
    <main class="main-content">
        <div class="citas-container">
            <section class="citas-section">
                <div class="form-header">
                    <h1 class="form-title">Agendar Nueva Cita</h1>
                    <p class="form-subtitle">Programa tu cita odontológica seleccionando la fecha, hora y motivo de consulta</p>
                </div>

                <form id="crearCitaForm" method="POST" action="../../controllers/CitaController.php?accion=store" class="form-card">
                    <?php if (isset($_SESSION['paciente_id'])): ?>
                        <input type="hidden" name="asignacion_automatica" value="1">
                        <input type="hidden" name="cita_hora_fin" id="hora_fin">
                        <!-- Asignar paciente automáticamente desde la sesión -->
                        <input type="hidden" name="cita_paciente" value="<?php echo htmlspecialchars($_SESSION['paciente_id']); ?>">


                        <div class="form-section">
                            <div class="section-title">📅 Detalles de la Cita</div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="fecha">Fecha de la Cita <span class="required">*</span></label>
                                    <input type="date" name="cita_fecha" id="fecha" required min="">
                                </div>

                                <div class="form-group">
                                    <label for="hora_inicio">Hora de Inicio <span class="required">*</span></label>
                                    <select name="cita_hora_inicio" id="hora_inicio" required>
                                        <option value="" disabled selected>Selecciona hora de inicio</option>
                                        <option value="08:00:00">08:00 AM</option>
                                        <option value="08:30:00">08:30 AM</option>
                                        <option value="09:00:00">09:00 AM</option>
                                        <option value="09:30:00">09:30 AM</option>
                                        <option value="10:00:00">10:00 AM</option>
                                        <option value="10:30:00">10:30 AM</option>
                                        <option value="11:00:00">11:00 AM</option>
                                        <option value="11:30:00">11:30 AM</option>
                                        <option value="14:00:00">02:00 PM</option>
                                        <option value="14:30:00">02:30 PM</option>
                                        <option value="15:00:00">03:00 PM</option>
                                        <option value="15:30:00">03:30 PM</option>
                                        <option value="16:00:00">04:00 PM</option>
                                        <option value="16:30:00">04:30 PM</option>
                                        <option value="17:00:00">05:00 PM</option>
                                        <option value="17:30:00">05:30 PM</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="motivo">Motivo de la Cita <span class="required">*</span></label>
                                    <select name="cita_motivo" id="motivo" required>
                                        <option value="" disabled selected>Selecciona el motivo</option>
                                        <option value="Consulta general" data-duration="30">Consulta General (30 min)</option>
                                        <option value="Control" data-duration="20">Control (20 min)</option>
                                        <option value="Urgencia" data-duration="45">Urgencia (45 min)</option>
                                        <option value="Seguimiento" data-duration="25">Seguimiento (25 min)</option>
                                        <option value="Examen" data-duration="40">Examen (40 min)</option>
                                        <option value="Otro" data-duration="30">Otro (30 min)</option>
                                    </select>
                                    <div id="duration-display" class="duration-info" style="display: none;">
                                        Duración estimada: <span id="duration-text"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="section-title">📝 Información Adicional</div>
                            <div class="form-group full-width">
                                <label for="observacion">Observaciones y Descripción del Motivo <span class="required">*</span></label>
                                <textarea name="cita_observacion" id="observacion" required></textarea>
                            </div>
                        </div>

                        <div class="form-info-card">
                            <h3>ℹ️ Información importante</h3>
                            <p>
                                • Las citas deben ser programadas con al menos 24 horas de anticipación.<br>
                                • El sistema asignará automáticamente el especialista y consultorio más adecuado según disponibilidad.<br>
                                • Si necesitas cancelar tu cita, hazlo con mínimo 2 horas de anticipación.<br>
                                • Llega 10 minutos antes de tu cita programada.<br>
                                • En caso de urgencia, contacta directamente al consultorio.
                            </p>
                        </div>

                        <div class="button-group">
                            <button type="button" class="btn-secondary" onclick="window.history.back()">← Cancelar</button>
                            <input type="submit" id="agendar_cita" value="📅 Agendar Cita">
                        </div>

                    <?php else: ?>
                        <div style="color: red; text-align: center; padding: 1rem;">
                            ⚠️ Error: Debes iniciar sesión como paciente para agendar una cita.
                        </div>
                        <script>
                            document.getElementById('crearCitaForm').style.display = 'none';
                        </script>
                    <?php endif; ?>
                </form>
            </section>
        </div>
    </main>
    <?php
    include '../layoutsFinal/paciente/footer.php';
    ?>
</body>

</html>