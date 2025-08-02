<?php
session_start();
if (!isset($_SESSION['paciente_id'])) {
    $_SESSION['paciente_id'] = 1; // ⚠️ ID de un paciente válido en tu BD
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agendar Cita - Sistema Odontológico</title>
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/proyecto_sab/assets/css/citas/citasAgendar.css';
    $cssUrl = '/proyecto_sab/assets/css/citas/citasAgendar.css';
    echo file_exists($cssPath)
        ? '<link rel="stylesheet" href="' . $cssUrl . '">'
        : '<p style="color:red">CSS no encontrado: ' . $cssPath . '</p>';
    ?>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">🦷</div>
            <h1>Agendar Nueva Cita</h1>
            <p class="subtitle">Programa tu cita odontológica seleccionando la fecha, hora y motivo de consulta</p>
        </div>

        <form id="crearCitaForm" method="POST" action="../../controllers/CitaController.php?accion=store" class="form-card">
            <?php if (isset($_SESSION['paciente_id'])): ?>
                <input type="hidden" name="asignacion_automatica" value="1">
                <input type="hidden" name="cita_hora_fin" id="hora_fin">

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

                <div class="info-card">
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
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const fechaInput = document.getElementById('fecha');
            const today = new Date().toISOString().split('T')[0];
            fechaInput.setAttribute('min', today);

            const motivoSelect = document.getElementById('motivo');
            const horaInicioSelect = document.getElementById('hora_inicio');
            const horaFinInput = document.getElementById('hora_fin');
            const durationDisplay = document.getElementById('duration-display');
            const durationText = document.getElementById('duration-text');

            function calcularHoraFin() {
                const motivoOption = motivoSelect.options[motivoSelect.selectedIndex];
                const horaInicio = horaInicioSelect.value;
                if (motivoOption && horaInicio && motivoOption.dataset.duration) {
                    const duracion = parseInt(motivoOption.dataset.duration);
                    const [h, m] = horaInicio.split(':').map(Number);
                    const minutosTotales = h * 60 + m + duracion;
                    const hFin = String(Math.floor(minutosTotales / 60)).padStart(2, '0');
                    const mFin = String(minutosTotales % 60).padStart(2, '0');
                    horaFinInput.value = `${hFin}:${mFin}:00`;
                    durationText.textContent = `${duracion} minutos`;
                    durationDisplay.style.display = 'block';
                }
            }

            motivoSelect.addEventListener('change', calcularHoraFin);
            horaInicioSelect.addEventListener('change', calcularHoraFin);

            document.getElementById('crearCitaForm').addEventListener('submit', function(e) {
                const motivo = motivoSelect.value;
                const observacion = document.getElementById('observacion').value;
                if (!fechaInput.value || !horaInicioSelect.value || !horaFinInput.value || !motivo || !observacion.trim()) {
                    e.preventDefault();
                    alert('Por favor completa todos los campos obligatorios');
                } else {
                    const duracion = motivoSelect.options[motivoSelect.selectedIndex].dataset.duration;
                    if (!confirm(`¿Confirmas agendar tu cita de ${motivo} con duración de ${duracion} minutos?`)) {
                        e.preventDefault();
                    }
                }
            });
        });
    </script>
</body>

</html>