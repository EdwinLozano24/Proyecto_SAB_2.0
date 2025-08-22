        // Establecer fecha mímima (hoy)
        document.addEventListener('DOMContentLoaded', function() {
            const fechaInput = document.getElementById('fecha');
            const today = new Date().toISOString().split('T')[0];
            fechaInput.setAttribute('min', today);

            // Variables para el cálculo automático de duración
            const motivoSelect = document.getElementById('motivo');
            const horaInicioSelect = document.getElementById('hora_inicio');
            const horaFinInput = document.getElementById('hora_fin');
            const durationDisplay = document.getElementById('duration-display');
            const durationText = document.getElementById('duration-text');

            // Función para calcular hora de fin automáticamente
            function calcularHoraFin() {
                const motivoOption = motivoSelect.options[motivoSelect.selectedIndex];
                const horaInicio = horaInicioSelect.value;
                
                if (motivoOption && horaInicio && motivoOption.dataset.duration) {
                    const duracionMinutos = parseInt(motivoOption.dataset.duration);
                    
                    // Convertir hora inicio a minutos
                    const [horas, minutos] = horaInicio.split(':').map(Number);
                    const minutosInicio = horas * 60 + minutos;
                    
                    // Calcular hora fin
                    const minutosFin = minutosInicio + duracionMinutos;
                    const horasFin = Math.floor(minutosFin / 60);
                    const minutosFinResto = minutosFin % 60;
                    
                    // Formatear hora fin
                    const horaFinFormatted = `${horasFin.toString().padStart(2, '0')}:${minutosFinResto.toString().padStart(2, '0')}:00`;
                    
                    // Actualizar campo de hora fin
                    horaFinInput.value = horaFinFormatted;
                    
                    // Mostrar información de duración
                    durationText.textContent = `${duracionMinutos} minutos`;
                    durationDisplay.style.display = 'block';
                    
                    // Formatear hora para mostrar (AM/PM)
                    const horaFinDisplay = formatearHora(horasFin, minutosFinResto);
                    horaFinInput.placeholder = `Finaliza a las ${horaFinDisplay}`;
                }
            }

            // Función para formatear hora en formato 12 horas
            function formatearHora(horas, minutos) {
                const periodo = horas >= 12 ? 'PM' : 'AM';
                const horas12 = horas > 12 ? horas - 12 : (horas === 0 ? 12 : horas);
                return `${horas12}:${minutos.toString().padStart(2, '0')} ${periodo}`;
            }

            // Event listeners para recalcular cuando cambie el motivo o la hora
            motivoSelect.addEventListener('change', calcularHoraFin);
            horaInicioSelect.addEventListener('change', calcularHoraFin);

            // Validar que la hora calculada no exceda el horario de trabajo
            function validarHorario() {
                const horaFin = horaFinInput.value;
                if (horaFin) {
                    const [horas] = horaFin.split(':').map(Number);
                    if (horas > 18) {
                        alert('⚠️ La cita se extiende más allá del horario de trabajo (6:00 PM). Por favor selecciona una hora de inicio más temprana.');
                        horaInicioSelect.value = '';
                        horaFinInput.value = '';
                        durationDisplay.style.display = 'none';
                        return false;
                    }
                }
                return true;
            }

            // Validar horario cuando se calculate la hora fin
            horaInicioSelect.addEventListener('change', function() {
                setTimeout(validarHorario, 100); // Pequeño delay para que se calcule primero
            });

            // Validación del formulario
            document.getElementById('crearCitaForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const fecha = document.getElementById('fecha').value;
                const horaInicio = document.getElementById('hora_inicio').value;
                const horaFin = document.getElementById('hora_fin').value;
                const motivo = document.getElementById('motivo').value;
                const observacion = document.getElementById('observacion').value;

                // Validaciones
                if (!fecha || !horaInicio || !horaFin || !motivo || !observacion.trim()) {
                    alert('Por favor completa todos los campos obligatorios');
                    return;
                }

                // Validar que la fecha no sea en el pasado
                const fechaSeleccionada = new Date(fecha);
                const hoy = new Date();
                hoy.setHours(0, 0, 0, 0);
                
                if (fechaSeleccionada < hoy) {
                    alert('No puedes agendar una cita en el pasado');
                    return;
                }

                // Validar horario de trabajo final
                if (!validarHorario()) {
                    return;
                }

                // Si todo está bien, enviar el formulario
                const motivoOption = motivoSelect.options[motivoSelect.selectedIndex];
                const duracion = motivoOption.dataset.duration;
                const confirmacion = confirm(`¿Confirmas que deseas agendar tu cita de ${motivo} con una duración de ${duracion} minutos?`);
                
                if (confirmacion) {
                    alert('¡Cita agendada exitosamente! El sistema asignará automáticamente el especialista y consultorio más adecuado.');
                    // Descomenta la siguiente línea para enviar realmente el formulario
                    // this.submit(); 
                }
            });
        });
