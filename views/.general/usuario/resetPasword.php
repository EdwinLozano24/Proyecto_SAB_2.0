
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset contraseña</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/user/resetPasword.css?v=20250845">
  
</head>

<body>
  <main>
    <div class="contenedor__todo">


      <div class="contenedor__reset">
        <form method="POST" action="../../index.php?action=sendResetLink">
          <h2>Cambiar Contraseña</h2>
          
          <label for="email">Correo Electrónico</label>
          <input type="email" name="email" id="email" placeholder="Escriba su email" required>



          <button type="submit" name="send">Enviar</button>
          <a href="/views/.general/usuario/loginRegister.php" class="link-login">Volver al Login</a>
        </form>
      </div>
    </div>
  </main>

  <!-- Modal de éxito -->
  <div id="successModal" class="modal-overlay">
    <div class="modal-content">
      <div class="success-icon">✓</div>
      <h3>¡Enlace Enviado!</h3>
      <p>Se ha enviado un enlace de recuperación a tu correo electrónico. Revisa tu bandeja de entrada y sigue las instrucciones.</p>
      <button onclick="closeModal()">Aceptar</button>
    </div>
  </div>

  <script src= "/assets/js/user/resetPasword.js"></script>
</body>
</html>


