<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Recuperar contraseña</h2>
<form method="POST" action="../../index.php?action=sendResetLink">
    <input type="email" name="email" placeholder="Correo" required>
    <button type="submit">Enviar</button>
</form>
</body>
</html>