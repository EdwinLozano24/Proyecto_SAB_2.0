
<nav class="nav">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="/controllers/HomeController.php?accion=homePaciente" class="nav-link active">
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
                <a href="#" class="nav-link">
                    <div class="nav-icon"></div>
                    Pqrs
                </a>
            </li>
            <li class="nav-item">
                <a href="/views/.general/contactenos/contactenos.php" class="nav-link">
                    <div class="nav-icon"></div>
                    Contáctenos
                </a>
            </li>
        </ul>
    </nav>