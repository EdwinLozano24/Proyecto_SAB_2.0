<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Historial Clinico</title>
  <link rel="stylesheet" href="../../Assets/css/historial/Historial.css" />
  
</head>

<body>
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
</body>

</html>