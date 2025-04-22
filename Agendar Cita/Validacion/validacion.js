// ATENCION! ESTE EL ARCHIVO VALIDACION PARA EL formulario_cita PHP y evalua las fechas entre otras cositas

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#formulario--agendarCita form');
    
    // Establecer fecha mínima como hoy
    const fechaInput = document.getElementById('horaCita');
    const today = new Date().toISOString().split('T')[0];
    fechaInput.min = today;
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        let isValid = true;
        
        // Validar motivo de la cita
        const motivoCita = document.getElementById('motivoCita');
        if (motivoCita.value === '') {
            alert('Por favor selecciona un motivo para la cita');
            motivoCita.focus();
            isValid = false;
            return;
        }
        
        // Validar fecha
        const fechaCita = document.getElementById('horaCita');
        if (fechaCita.value === '') {
            alert('Por favor selecciona una fecha para la cita');
            fechaCita.focus();
            isValid = false;
            return;
        }
        
        // Validar hora
        const horaInputs = document.querySelectorAll('input[type="time"]');
        const horaCita = horaInputs[0];
        if (!horaCita.value) {
            alert('Por favor selecciona una hora para la cita');
            horaCita.focus();
            isValid = false;
            return;
        }
        
        // Validar horario laboral (8am - 5pm)
        const horaParts = horaCita.value.split(':');
        const hora = parseInt(horaParts[0]);
        if (hora < 8 || hora >= 17) {
            alert('El horario de atención es de 8:00 AM a 5:00 PM');
            horaCita.focus();
            isValid = false;
            return;
        }
        
        // Si todo es válido, enviar formulario
        if (isValid) {
            // Aquí podrías agregar AJAX para enviar los datos o:
            form.submit();
        }
    });
});