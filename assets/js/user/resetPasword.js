    function showSuccessModal() {
      document.getElementById('successModal').style.display = 'block';
    }

    function closeModal() {
      document.getElementById('successModal').style.display = 'none';
    }

    // Cerrar modal al hacer clic fuera de él
    document.getElementById('successModal').addEventListener('click', function(e) {
      if (e.target === this) {
        closeModal();
      }
    });

    // Manejar el envío del formulario
    document.querySelector('form').addEventListener('submit', function(e) {
      e.preventDefault(); // Prevenir el envío normal
      
      const email = document.getElementById('email').value;
      
      // Validar email
      if (!email || !email.includes('@')) {
        alert('Por favor, ingresa un email válido');
        return;
      }
      
      // Simular envío exitoso (aquí deberías hacer la petición AJAX real)
      // En tu caso real, harías una petición AJAX a logicamail.php
      setTimeout(() => {
        showSuccessModal();
        document.getElementById('email').value = ''; // Limpiar el campo
      }, 500);
      
    //   Para integrar con tu PHP, descomenta estas líneas y comenta el setTimeout:
      fetch('../app/logicamail.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
          email: email,
          send: 'true'
        })
      })
      .then(response => response.text())
      .then(data => {
        showSuccessModal();
        document.getElementById('email').value = '';
      })
      .catch(error => {
        alert('Error al enviar el email. Inténtalo de nuevo.');
      });
    });