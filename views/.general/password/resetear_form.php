<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php
  $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/assets/css/user/resetPasword.css?v=20250845';
  $cssUrl = '/assets/css/user/resetPasword.css?v=20250845';
  if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="' . $cssUrl . '">';
  } else {
    echo ' CSS File not fount at: ' . $cssPath . '';
  }
  ?>
</head>

<body>
  <main>
    <div class="contenedor__todo">
      <div class="contenedor__reset">
        <form method="POST" action="index.php?action=resetPassword">
          <h2>Restablecer contraseña</h2>
          <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
          <input type="password" name="nueva_password" placeholder="Nueva contraseña" required>
          <button type="submit">Cambiar contraseña</button>
        </form>
      </div>
    </div>
</body>

</html>