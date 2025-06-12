<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Assets/css/citas/CitasHome.css">
 
    <title>Solicitud Cita</title>
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
    </header>



    <div id="formulario--agendarCita">


        <form action="procesar_cita.php" method="POST">
            <label for="motivoCita">Motivo Cita</label>
            <select name="motivoCita" id="motivoCita" required>
                <option value="">-- Elige una opción --</option>
                <option value="consultaOdontologica">Consulta Odontologica</option>
                <option value="tratamiento">Tratamiento Odontologico</option>
            </select>

            <label for="horaCita">Fecha</label>
            <input type="date" id="horaCita" name="horaCita" required>

            <label for="hora">Hora</label>
            <input type="time" id="hora" name="hora" min="08:00" max="17:00" required>


            <button type="submit">Pedir Cita</button>
            <a href="problemaCita.php">
                <p>¿Problemas para agendar su cita?</p>
            </a>
        </form>


    </div>



    <!-- Pie de página -->
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



    <script src="/Agendar Cita/Agendar Cita/Validacion/validacion.js"></script>
</body>

</html>