<html>
  <body>
    <h2>Bienvenido, <?php echo htmlspecialchars($usuario['usua_nombre']); ?> 🎉</h2>
    <p>Gracias por registrarte en nuestra plataforma.</p>
    <p>Puedes acceder al sistema en: <a href="<?php echo $app_url; ?>"><?php echo $app_url; ?></a></p>
    <br>
    <p>Atentamente,<br>El equipo de soporte</p>
  </body>
</html>