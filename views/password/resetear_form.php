<h2>Restablecer contraseña</h2>
<form method="POST" action="index.php?action=resetPassword">
  <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
  <input type="password" name="nueva_password" placeholder="Nueva contraseña" required>
  <button type="submit">Cambiar contraseña</button>
</form>