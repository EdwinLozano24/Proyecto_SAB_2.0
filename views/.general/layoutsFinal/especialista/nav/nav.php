
<nav class="nav">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="/views/especialista/home/especialista_dashboard.php" class="nav-link">
                    <div class="nav-icon"></div>
                    Inicio
                </a>
            </li>
            <li class="nav-item">
                <a href="/controllers/CitaController.php?accion=especialistaCitaView&id_usuario=<?php echo $_SESSION['usuario']['id_usuario']; ?>" class="nav-link">
                    <div class="nav-icon"></div>
                    Atender Citas
                </a>
            </li>
            <li class="nav-item">
                <a href="/controllers/CitaController.php?accion=pacienteAgendar" class="nav-link">
                    <div class="nav-icon"></div>
                    Agenda una Cita
                </a>
            </li>
            <li class="nav-item">
                <a href="/controllers/CitaController.php?accion=viewAgendar&rol=Especialista" class="nav-link">
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