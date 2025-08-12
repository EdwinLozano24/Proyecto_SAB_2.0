<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Información Solicitud</title>
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
        <a href="index.php?c=Pqrs&a=datosPaciente" class="btn back">Volver</a>
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