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