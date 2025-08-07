



    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <div class="logo">SAB</div>
            <h1 class="header-title">Sistema de Gestión Odontológica</h1>
        </div>
        <div class="user-info">
            <div class="user-avatar">U</div>
            <span>Administrador</span>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="nav">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="/proyecto_sab/controllers/HomeController.php?accion=home" class="nav-link active">
                    <div class="nav-icon"></div>
                    Inicio
                </a>
            </li>
            <li class="nav-item">
                <a href="/proyecto_sab/controllers/HomeController.php?accion=cita" class="nav-link">
                    <div class="nav-icon"></div>
                    Agenda tu Cita
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <div class="nav-icon"></div>
                    Tratamientos Disponibles
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <div class="nav-icon"></div>
                    Sobre Nosotros
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <div class="nav-icon"></div>
                    Contactanos
                </a>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-section">
            <h3 class="sidebar-title">Navegación Rápida</h3>
            <ul class="sidebar-menu">
                <li><a href="/proyecto_sab/controllers/HomeController.php?accion=home" class="active">🏠 Inicio</a></li>
                <li><a href="#">📆 Tus Citas</a></li>
                <li><a href="#">👤 Tu Perfil</a></li>
                <li><a href="#">⚙️ Configuración</a></li>
            </ul>
            <a href="/proyecto_sab/controllers/AuthController.php?accion=Logout" class="btn btn-primary" style="margin-top: 16px;">Cerrar Sesion</a>
        </div>

        <div class="sidebar-section">
            <h3 class="sidebar-title">Herramientas de Administrador</h3>
            <ul class="sidebar-menu">
                <li><a href="/proyecto_sab/controllers/UsuarioController.php?accion=index">👥 Usuarios</a></li>
                <li><a href="/proyecto_sab/controllers/CitaController.php?accion=index">📆 Citas</a></li>
                <li><a href="/proyecto_sab/controllers/TratamientoController.php?accion=index">💉 Tratamientos</a></li>
                <li><a href="/proyecto_sab/controllers/HistorialController.php?accion=index">📋 Historial Clinico</a></li>
                <li><a href="/proyecto_sab/controllers/PqrsController.php?accion=index">📝 Pqrs</a></li>
            </ul>
        </div>
        <!--<div class="info-card">
            <h3>💡 Recuerda</h3>
            <p>Utiliza las herramientas de desarrollo del navegador para inspeccionar y depurar tu código CSS más
                fácilmente.</p>
        </div> -->
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-header">
            <h2 class="content-title">Bienvenido a SAB</h2>
            <p class="content-subtitle">Explora las diferentes secciones y descubre todo lo que tenemos para ofrecer como sistema de gestión odontológica.</p>
</div> 

        
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-text">
                © 2025 SAB. Todos los derechos reservados.
            </div>
            <div class="footer-links">
                <a href="#">Términos</a>
                <a href="#">Contacto</a>
                <a href="#">Soporte</a>
            </div>
        </div>
    </footer>
