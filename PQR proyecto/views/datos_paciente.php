<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos del Paciente</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header>
        <img src="assets/img/logo.png" alt="Logo del Proyecto" class="logo">
    </header>
    <div class="container">
        <h2>Datos del Paciente</h2>
        <form action="index.php?action=informacion" method="POST">
            <label>Nombre Completo:</label>
            <input type="text" name="nombre" required>

            <label>Documento:</label>
            <input type="text" name="documento" required>

            <label>Correo Electrónico:</label>
            <input type="email" name="correo" required>

            <button class="btn" type="submit">Siguiente</button>
        </form>
        <a href="index.php" class="btn back">Volver</a>
    </div>
</body>
</html>
