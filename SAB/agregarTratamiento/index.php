<?php
if (isset($_POST['submit'])) {
    $servername = "localhost"; // Cambia esto si tu host no es localhost
    $username = "root"; // Usuario de tu base de datos
    $password = ""; // Contraseña de tu base de datos
    $dbname = "catalogotratamientos"; // Nombre de la base de datos

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Recibir datos del formulario
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $tiempoEstimado = $conn->real_escape_string($_POST['tiempoEstimado']);
    $descripcion = $conn->real_escape_string($_POST['descripcion']);

    // Insertar datos en la base de datos
    $sql = "INSERT INTO tratamientos (nombre, tiempo_estimado, descripcion) VALUES ('$nombre', '$tiempoEstimado', '$descripcion')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Tratamiento agregado exitosamente.');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Tratamientos</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="validacion1.js" defer></script>
</head>

<body>
    <!-- Encabezado -->
    <header>
        <div id="logo" class="d-flex align-items-center">
            <img src="img/sab.jpg" alt="Logo" class="me-2">
            <p>Salud Benefit</p>
        </div>

        <!-- Menú de navegación -->
        <nav>
            <ul class="nav justify-content-center">
                <li class="nav-item"><a class="nav-link" href="#">Perfil</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Historial clínico</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Catálogo</a></li>
                <li class="nav-item"><a class="nav-link" href="#">PQRS</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Agendar Cita</a></li>
            </ul>
        </nav>
    </header>

    <!-- Contenido principal -->
    <div id="content">
        <h1>Agregar Nuevo Tratamiento</h1>
        <form id="agregarTratamiento" method="POST">
            <label for="nombre">Nombre del Tratamiento:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre del tratamiento"><br><br>

            <label for="tiempoEstimado">Tiempo Estimado:</label>
            <input type="text" id="tiempoEstimado" name="tiempoEstimado" placeholder="Ej. 30 minutos, 1 hora"><br><br>

            <label for="descripcion">Descripción del Tratamiento:</label>
            <textarea id="descripcion" name="descripcion" placeholder="Descripción del tratamiento" rows="4" cols="50"></textarea><br><br>

            <button type="submit" name="submit" class="btn btn-primary">Agregar Tratamiento</button>

            <p id="errorMensaje" style="color: red;"></p>
        </form>
    </div>
        <!-- Pie de página -->
        <footer class="text-center py-3">
            <p>&copy; <?=date('Y')?> Salud Benefit. Todos los derechos reservados.</p>
        </footer>
</body>
</html>
