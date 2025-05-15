<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form action="/proyecto_sab/controllers/Authcontroller.php" method="POST">
        <label for="paci_num_documento">Número de Documento:</label>
        <input type="text" name="paci_num_documento" id="paci_num_documento" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="paci_password" id="password" required><br><br>

        <button type="submit" name="login">Ingresar</button>
    </form>
</body>
</html>
