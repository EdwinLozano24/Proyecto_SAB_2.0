<?php
$id_usuario = $_SESSION['usuario']['id_usuario'];
?>
    <aside class="sidebar">
        <div class="sidebar-section">
            <h3 class="sidebar-title">Navegación Rápida</h3>
            <ul class="sidebar-menu">
                <li><a href="/controllers/HomeController.php?accion=homePaciente" class="active">🏠 Inicio</a></li>
                <li><a href="#">📆 Tus Citas</a></li>
                <li><a href="/controllers/HomeController.php?accion=PacientePerfilView&id_usuario=<?php echo $_SESSION['usuario']['id_usuario']; ?>">👤 Tu Perfil</a></li>
                <li><a href="/views/paciente/historial/historial_dashboard.php">🏥 Historial Clínico</a></li>
                <li><a href="#">⚙️ Configuración</a></li>
            </ul>
            <a href="/controllers/AuthController.php?accion=Logout" class="btn btn-primary" style="margin-top: 16px;">Cerrar Sesion</a>
        </div>

    </aside>