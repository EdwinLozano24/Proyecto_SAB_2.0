<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/css/citas/CitasHome.css">
    <title>Solicitud Cita</title>
</head>

<body>
    <nav>
        <!-- Esta es la pagina del formulario para agendar la cita-->

        <img id="nav--logo-imagen" src="Assets/img/logo.png" alt="Imagen del logo de SAB">
        <h1>Salud Benefit</h1>

        <li class="items--nav">
            <ol><a href="#">Perfil</a></ol>
            <ol><a href="#">Historial Clinico</a></ol>
            <ol><a href="#">Catalogo Tratamientos</a></ol>
            <ol><a href="#">PQR'S</a></ol>
        </li>


    </nav>



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


    <footer>
        <div class="footer-container">
            <div class="footer-content">
                <div id="title--footer">
                    <h2>S.A.B COPYRIGHT 2026</h2>
                </div>
                <ul class="footer-links">
                    <li><a href="#">Preguntas Frecuentes</a></li>
                    <li><a href="#">Ayuda</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </div>

            <div class="social-icons">
                <a href="#" class="social-link">
                    <img src="https://cdn-icons-png.flaticon.com/512/124/124010.png" alt="Facebook" class="imagenes--footer">
                </a>
                <a href="#" class="social-link">
                    <img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="Twitter" class="imagenes--footer">
                </a>
                <a href="#" class="social-link">
                    <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram" class="imagenes--footer">
                </a>
            </div>
        </div>
    </footer>



    <script src="/Agendar Cita/Agendar Cita/Validacion/validacion.js"></script>
</body>

</html>