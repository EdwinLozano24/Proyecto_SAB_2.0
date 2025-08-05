<div style="font-family:-apple-system, sans-serif; padding:20px;">
  <h1>Mi Aplicación</h1>
  <p>¡Hola <?= htmlspecialchars($usuario['usua_nombre']) ?>!</p>
  <p>Haz clic en el siguiente botón para restablecer tu contraseña:</p>
  <a href="<?= htmlspecialchars($enlace) ?>" style="padding:12px 24px; background:#0ea5e9; color:#fff; text-decoration:none; border-radius:6px;">
    🔑 Restablecer contraseña
  </a>
  <p>Si no funciona, copia este enlace:</p>
  <p><small><?= htmlspecialchars($enlace) ?></small></p>
  <p>© <?= date('Y') ?> Mi Aplicación. No responda este correo.</p>
</div>
