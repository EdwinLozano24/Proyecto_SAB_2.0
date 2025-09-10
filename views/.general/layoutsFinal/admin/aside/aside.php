<?php
$id_usuario = $_SESSION['usuario']['id_usuario'];
?>    
    <aside class="sidebar">
        <div class="sidebar-section">
            <h3 class="sidebar-title">Navegación Rápida</h3>
            <ul class="sidebar-menu">
                <li><a href="/controllers/HomeController.php?accion=home">🏠 Inicio</a></li>
                <li><a href="/controllers/HomeController.php?accion=pacientePerfil&id_usuario=<?php echo $_SESSION['usuario']['id_usuario']; ?>">👤 Tu Perfil</a></li>
            </ul>
            <a href="/controllers/AuthController.php?accion=Logout" class="btn btn-primary" style="margin-top: 16px;">Cerrar Sesion</a>
        </div>

        <div class="sidebar-section">
            <h3 class="sidebar-title">Herramientas de Administrador</h3>
            <ul class="sidebar-menu">
                <li><a href="/controllers/UsuarioController.php?accion=index">👥 Usuarios</a></li>
                <li><a href="/controllers/CitaController.php?accion=index">📆 Citas</a></li>
                <li><a href="/controllers/TratamientoController.php?accion=index">💉 Tratamientos</a></li>
                <li><a href="/controllers/HistorialController.php?accion=index">🏥 Historial Clinico</a></li>
                <li><a href="/controllers/PqrsController.php?accion=index">📝 Pqrs</a></li>
            </ul>
        </div>
    </aside>