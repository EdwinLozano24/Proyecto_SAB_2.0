<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos del Paciente</title>
    <link rel="stylesheet" href="../../Assets/css/pqr/pqrs.css">
</head>
<body>
    <header>
        <img src="../../Assets/img/logoSab/logo.jpg" alt="Logo del Proyecto" class="logo">
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

            <a href="index.php?c=Pqrs&a=infoSolicitud" class="btn" type="submit">Siguiente</a>
            <a href="index.php?c=Pqrs&a=home" class="btn back">Volver</a>
        </form>
    </div>
</body>
</html>
