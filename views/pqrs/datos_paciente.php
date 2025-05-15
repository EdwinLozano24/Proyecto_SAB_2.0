<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos del Paciente</title>
    <link rel="stylesheet" href="../../Assets/css/pqr/pqrs.css">
  
</head>
<body>
   <!-- Encabezado -->
    <header>
        <div id="logo" class="d-flex align-items-center">
            <img src="../../Assets/img/logoSab/logo.jpg" alt="Logo" class="me-2">
            
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

     <footer class="text-center py-3">
        <p>&copy; <?=date('Y')?> Salud Benefit. Todos los derechos reservados.</p>
          <a href="#" class="social-link">
                    <img src="https://cdn-icons-png.flaticon.com/512/124/124010.png" alt="Facebook" class="imagenes--footer">
                </a>
                <a href="#" class="social-link">
                    <img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="Twitter" class="imagenes--footer">
                </a>
                <a href="#" class="social-link">
                    <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram" class="imagenes--footer">
                </a>
    </footer>

</body>
</html>
