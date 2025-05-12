<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Historial Clinico</title>
    <link rel="stylesheet" href="../../Assets/css/Historial.css" />
  </head>
  <body>
    <header class="encabezado">
      <div class="logo">
        <img src="../../Assets/img/sab.jpg" alt="Logo de SAB" />
      </div>

      <div class="titulo">Salud Benefit</div>
      <nav class="menu-superior">
        <a href="#">Perfil</a>
        <a href="#">Historial Clinico</a>
        <a href="#">Catálogo Tratamientos</a>
        <a href="#">PQRS</a>
        <button class="btn-cita">Agendar Cita</button>
      </nav>
    </header>

    <main class="contenido-historial">
      <h1>Historial Clinico</h1>

      <div class="menu-tabs">
        <button class="tab">Resumen del paciente</button>
        <button class="tab">Condición del paciente</button>
        <button class="tab">Observaciones Médicas</button>
        <button class="tab">Motivos del paciente</button>
        <button class="tab">Ordenes Médicas</button>
      </div>

      <form class="panel-historial" id="form-historial">
        <div class="panel-usuario">
          <p><strong>Jose Salazar</strong><br><small>Paciente</small></p>
        </div>

        <label class="sr-only" for="sintoma"></label>
        <input type="text" class="input-pequeno" id="sintoma" placeholder="Síntoma principal" />

        <label class="sr-only" for="notas"></label>
        <textarea class="textarea-grande" id="notas" placeholder="Escriba aquí las observaciones médicas..."></textarea>

        <button type="submit" class="btn-enviar">Enviar</button>
      </form>
    </main>

    <footer class="footer">
      <div class="footer-contenedor">
        <div class="footer-left">
          <p>S.A.B COPYRIGHT 2026</p>
        </div>
        <div class="footer-center">
          <a href="#">Preguntas frecuentes</a>
          <a href="#">Ayuda</a>
          <a href="#">Contacto</a>
        </div>
        <div class="footer-right">
          <a href="#"><img src="../../Assets/img/facebook.png" alt="Facebook" /></a>
          <a href="#"><img src="../../Assets/img/twitter.png" alt="Twitter" /></a>
          <a href="#"><img src="../../Assets/img/instagram.png" alt="Instagram" /></a>
        </div>
      </div>
    </footer>

    <script src="script.js"></script>
  </body>
</html>