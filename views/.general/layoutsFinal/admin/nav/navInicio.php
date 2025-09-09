
<nav class="nav">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="/controllers/HomeController.php?accion=home" class="nav-link active">
                    <div class="nav-icon"></div>
                    Inicio
                </a>
            </li>
            <li class="nav-item">
                <a href="/controllers/CitaController.php?accion=pacienteAgendar" class="nav-link">
                    <div class="nav-icon"></div>
                    Agenda tu Cita
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo dirname(dirname($_SERVER['SCRIPT_NAME'])) ?>/views/tratamiento/tratamientoVisualizar.php" class="nav-link">
                    <div class="nav-icon"></div>
                    Tratamientos Disponibles
                </a>
            </li>
            <li class="nav-item">
                <a href="/views/paciente/pqr/crearPQR.php" class="nav-link">
                    <div class="nav-icon"></div>
                    Crear Pqrs
                </a>
            </li>
            <li class="nav-item">
                <a href="/views/.general/contactenos/contactenos.php" class="nav-link">
                    <div class="nav-icon"></div>
                    Contáctanos
                </a>
            </li>
        </ul>
    </nav>