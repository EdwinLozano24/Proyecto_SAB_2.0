// Establecer fecha mínima como hoy
document.addEventListener('DOMContentLoaded', () => {
    const today = new Date().toISOString().split('T')[0];
    const citaFechaInput = document.getElementById('cita_fecha');
    if (citaFechaInput) {
        citaFechaInput.min = today;
    }
});

// Validación en tiempo real (al perder el foco o escribir)
document.querySelectorAll('input[required], select[required], textarea[required]').forEach(field => {
    field.addEventListener('blur', function() {
        const formGroup = this.closest('.form-group');
        if (formGroup) {
            if (this.value.length > 0) {
                formGroup.classList.remove('error');
                formGroup.classList.add('success');
            } else {
                formGroup.classList.remove('success');
                formGroup.classList.add('error');
            }
        }
    });

    field.addEventListener('input', function() {
        const formGroup = this.closest('.form-group');
        if (formGroup) {
            formGroup.classList.remove('error', 'success'); // Limpia estados al empezar a escribir
        }
    });
});

// Validación de hora de trabajo
document.getElementById('cita_hora').addEventListener('change', function() {
    const hora = this.value;
    const formGroup = this.closest('.form-group');

    if (hora && (hora < '08:00' || hora > '18:00')) {
        formGroup.classList.add('error');
        alert('⚠️ Las citas solo se pueden programar entre 8:00 AM y 6:00 PM');
        this.value = ''; // Limpia el valor si es inválido
    } else {
        formGroup.classList.remove('error');
    }
});

// Validación de fechas de fin de semana
document.getElementById('cita_fecha').addEventListener('change', function() {
    const fecha = new Date(this.value);
    const diaSemana = fecha.getDay(); // 0 = Domingo, 6 = Sábado
    const formGroup = this.closest('.form-group');

    if (fecha && (diaSemana === 0 || diaSemana === 6)) {
        formGroup.classList.add('error');
        alert('⚠️ No se pueden programar citas los fines de semana');
        this.value = ''; // Limpia el valor si es fin de semana
    } else {
        formGroup.classList.remove('error');
    }
});

// Loading state en submit del formulario
document.getElementById('citaStore').addEventListener('submit', function(e) {
    // Validación adicional antes del envío
    const fechaInput = document.getElementById('cita_fecha');
    const horaInput = document.getElementById('cita_hora');

    if (!fechaInput.value || !horaInput.value || fechaInput.closest('.form-group').classList.contains('error') || horaInput.closest('.form-group').classList.contains('error')) {
        e.preventDefault(); // Detiene el envío si hay campos vacíos o con errores
        alert('⚠️ Por favor complete todos los campos requeridos y corrija los errores.');
        return;
    }

    document.body.classList.add('loading');
    const submitBtn = document.getElementById('generar_cita');
    if (submitBtn) {
        submitBtn.value = '⏳ Programando...'; // Cambia el texto del botón
        submitBtn.disabled = true; // Deshabilita el botón para evitar doble clic
    }
});

// Actualizar indicador de estado (simulación visual)
document.getElementById('cita_estado').addEventListener('change', function() {
    const indicator = this.parentNode.querySelector('.status-indicator');
    const value = this.value;

    if (indicator) { // Asegurarse de que el indicador exista
        indicator.className = 'status-indicator'; // Resetear clases
        switch (value) {
            case '1':
                indicator.classList.add('status-cumplida');
                indicator.innerHTML = '✅ Cita Cumplida';
                break;
            case '2':
                indicator.classList.add('status-incumplida');
                indicator.innerHTML = '❌ Cita Incumplida';
                break;
            case '3':
                indicator.classList.add('status-proceso');
                indicator.innerHTML = '🔄 En Proceso';
                break;
            default:
                indicator.innerHTML = ''; // Si no hay valor seleccionado, vaciar
                break;
        }
    }
});


// Animación de entrada del contenedor
document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.container');
    if (container) {
        container.style.opacity = '0';
        container.style.transform = 'translateY(20px)';

        setTimeout(() => {
            container.style.transition = 'all 0.5s ease';
            container.style.opacity = '1';
            container.style.transform = 'translateY(0)';
        }, 100);
    }
});

// Simulación de verificación de disponibilidad (puede ser una llamada AJAX real)
let timeoutId;
function verificarDisponibilidad() {
    const especialista = document.getElementById('cita_especialista').value;
    const consultorio = document.getElementById('cita_consultorio').value;
    const fecha = document.getElementById('cita_fecha').value;
    const hora = document.getElementById('cita_hora').value;

    // Solo si todos los campos relevantes están llenos, simulamos la verificación
    if (especialista && consultorio && fecha && hora) {
        clearTimeout(timeoutId); // Limpiar cualquier timeout anterior
        timeoutId = setTimeout(() => {
            // Aquí iría tu lógica real de llamada AJAX al servidor
            // para verificar la disponibilidad en la base de datos.
            // Por ahora, solo un console.log
            console.log('Verificando disponibilidad de especialista, consultorio, fecha y hora...');
            //alert('Simulación: Disponibilidad verificada. Si hubiese conflicto, aparecería un mensaje aquí.');
        }, 1000); // Pequeño retraso para simular la llamada al servidor
    }
}

// Event listeners para la verificación de disponibilidad
document.getElementById('cita_especialista').addEventListener('change', verificarDisponibilidad);
document.getElementById('cita_consultorio').addEventListener('change', verificarDisponibilidad);
document.getElementById('cita_fecha').addEventListener('change', verificarDisponibilidad);
document.getElementById('cita_hora').addEventListener('change', verificarDisponibilidad);