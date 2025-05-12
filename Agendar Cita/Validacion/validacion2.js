// ATENCION! Este es el archivo de validacion para el problemasCita.php
// Evalua que el problema no este vacio y sea mayor a 10 caracteres etc..

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formProblema');
    const textarea = document.getElementById('descripcion');
    const errorDescripcion = document.getElementById('error-descripcion');

    // Validación en tiempo real
    textarea.addEventListener('input', function() {
        validarTextarea();
    });

    // Validación al enviar el formulario
    form.addEventListener('submit', function(event) {
        if (!validarTextarea()) {
            event.preventDefault();
        }
    });

    function validarTextarea() {
        const valor = textarea.value.trim();
        
        // Limpiar mensaje de error
        errorDescripcion.style.display = 'none';
        errorDescripcion.textContent = '';
        
        // Validar longitud mínima
        if (valor.length < 10) {
            errorDescripcion.textContent = 'Por favor, describa su problema con al menos 10 caracteres.';
            errorDescripcion.style.display = 'block';
            return false;
        }
        
        // Validar longitud máxima
        if (valor.length > 1000) {
            errorDescripcion.textContent = 'La descripción no puede exceder los 1000 caracteres.';
            errorDescripcion.style.display = 'block';
            return false;
        }
        
        // Validar contenido (por ejemplo, que no sean solo espacios o caracteres especiales)
        if (/^[\s\W]+$/.test(valor)) {
            errorDescripcion.textContent = 'La descripción debe contener texto válido.';
            errorDescripcion.style.display = 'block';
            return false;
        }
        
        return true;
    }
});