<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Información Solicitud</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header>
        <img src="assets/img/logo.png" alt="Logo del Proyecto" class="logo">
    </header>
    <div class="container">
        <h2>Motivo de la Solicitud</h2>
        <form action="#" method="POST">
            <label>Tipo de Solicitud:</label>
            <select name="tipo" required>
                <option>Petición</option>
                <option>Queja</option>
                <option>Reclamo</option>
            </select>

            <label>Descripción:</label>
            <textarea name="descripcion" required></textarea>

            <button class="btn" type="submit">Enviar</button>
        </form>
        <a href="index.php" class="btn back">Volver</a>
    </div>
</body>
</html>