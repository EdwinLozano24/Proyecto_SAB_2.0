<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Restablecer contraseña</h2>
<form method="POST" action="index.php?action=resetPassword">
    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
    <input type="password" name="nueva_password" placeholder="Nueva contraseña" required>
    <button type="submit">Cambiar contraseña</button>
</form>
</body>
</html>