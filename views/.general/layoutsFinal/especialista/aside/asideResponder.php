    <aside class="sidebar">
        <div class="sidebar-section">
            <h3 class="sidebar-title">Acciones de Especialista</h3>
            <ul class="sidebar-menu">
                <li><a href="/controllers/HomeController.php?accion=homeEspecialista">🏠 Inicio</a></li>
                <li><a href="/controllers/HomeController.php?accion=especialistaPerfil&id_usuario=<?php echo $_SESSION['usuario']['id_usuario']; ?>">👤 Tu Perfil</a></li>
                <li><a href="/controllers/CitaController.php?accion=especialistaCitaView&id_usuario=<?php echo $_SESSION['usuario']['id_usuario']; ?>">⌚ Atender Citas</a></li>
                <li><a href="/views/especialista/pqr/responderPQR.php">⚙️ Configuración</a></li>
            </ul>
            <a href="/controllers/AuthController.php?accion=Logout" class="btn btn-primary" style="margin-top: 16px;">Cerrar Sesion</a>
        </div>

        <div class="sidebar-section">
            <h3 class="sidebar-title">Acciones de Empleado</h3>
                <ul class="sidebar-menu">
                <li><a href="/controllers/UsuarioController.php?accion=index">📆 Agendar Cita</a></li>
                <li><a href="/controllers/PqrsController.php?accion=visualizarPqrs" class="active">📝 Responder Pqrs </a></li>
                <li><a href="/controllers/HistorialController.php?accion=index">🏥 Historial Clinico</a></li>
            </ul>
        </div>
    </aside>