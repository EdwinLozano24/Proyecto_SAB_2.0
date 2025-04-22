// Validación en tiempo real para el campo "nombre"
document.getElementById('nombre').addEventListener('input', function(event) {
    const regex = /^[a-zA-Z\s]+$/; // Solo letras y espacios
    const errorMensaje = document.getElementById('errorMensaje');

    if (!regex.test(event.target.value)) {
        errorMensaje.textContent = 'El nombre solo puede contener letras y espacios.';
        event.target.value = event.target.value.replace(/[^a-zA-Z\s]/g, ''); // Eliminar caracteres no válidos
    } else {
        errorMensaje.textContent = ''; // Limpiar el mensaje de error
    }
});

// Validación al enviar el formulario
document.getElementById('agregarTratamiento').addEventListener('submit', function(event) {
    const nombre = document.getElementById('nombre').value.trim();
    const tiempoEstimado = document.getElementById('tiempoEstimado').value.trim();
    const descripcion = document.getElementById('descripcion').value.trim();

    const errorMensaje = document.getElementById('errorMensaje');
    errorMensaje.textContent = ''; // Limpiar mensaje previo

    // Validaciones
    if (!nombre || !tiempoEstimado || !descripcion) {
        errorMensaje.textContent = 'Todos los campos son obligatorios.';
        event.preventDefault(); // Detiene el envío del formulario
        return;
    }

    if (nombre.length > 50) {
        errorMensaje.textContent = 'El nombre no debe tener más de 50 caracteres.';
        event.preventDefault(); // Detiene el envío del formulario
        return;
    }

    if (descripcion.length < 20) {
        errorMensaje.textContent = 'La descripción debe tener al menos 20 caracteres.';
        event.preventDefault(); // Detiene el envío del formulario
        return;
    }
});
