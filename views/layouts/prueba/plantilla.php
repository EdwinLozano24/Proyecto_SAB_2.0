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
    </aside>