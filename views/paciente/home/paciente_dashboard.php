<?php
require_once '../../../config/auth.php';

requiereSesion();
$id_usuario = $_SESSION['usuario']['id_usuario'];
$nombreUsuario = $_SESSION['usuario']['usua_nombre'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/proyecto_sab/assets/css/home/dashboard.css';
    $cssUrl = '/proyecto_sab/assets/css/home/dashboard.css';
    if (file_exists($cssPath)) {
        echo '<link rel="stylesheet" href="' . $cssUrl . '">';
    } else {
        echo ' CSS File not fount at: ' . $cssPath . '';
    }
    ?>
    <title>SAB</title>
</head>

<body>
    <!-- Header -->
    <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($id_usuario); ?>">
    <header class="header">
        <div class="header-content">
            <div class="logo">SAB</div>
            <h1 class="header-title"></h1>
        </div>
        <a href="/proyecto_sab/controllers/HomeController.php?accion=PacientePerfilView&id_usuario=<?php echo $id_usuario; ?>" class="user-info" style="text-decoration: none; color: inherit;">
            <div class="user-avatar">👤</div>
            <span><?php echo htmlspecialchars($nombreUsuario); ?></span>
        </a>
    </header>
    
    <!-- Navigation -->
    <nav class="nav">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="/proyecto_sab/controllers/HomeController.php?accion=homePaciente" class="nav-link active">
                    <div class="nav-icon"></div>
                    Inicio
                </a>
            </li>
            <li class="nav-item">
                <a href="/proyecto_sab/controllers/HomeController.php?accion=homeAgendarCita" class="nav-link">
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
            <h3 class="sidebar-title">Configuraciones</h3>
            <ul class="sidebar-menu">
                <li><a href="#">📆 Tus Citas</a></li>
                <li><a href="#">👤 Tu Perfil</a></li>
            </ul>
            <a href="/proyecto_sab/controllers/AuthController.php?accion=Logout" class="btn btn-primary" style="margin-top: 16px;">Cerrar Sesion</a>
        </div>

        
       <!-- <div class="sidebar-section">
            <h3 class="sidebar-title">Herramientas de Administrador</h3>
            <ul class="sidebar-menu">
                <li><a href="/proyecto_sab/controllers/UsuarioController.php?accion=index">👥 Usuarios</a></li>
                <li><a href="/proyecto_sab/controllers/CitaController.php?accion=index">📆 Citas</a></li>
                <li><a href="/proyecto_sab/controllers/TratamientoController.php?accion=index">💉 Tratamientos</a></li>
                <li><a href="/proyecto_sab/controllers/HistorialController.php?accion=index">📋 Historial Clinico</a></li>
                <li><a href="/proyecto_sab/controllers/PqrsController.php?accion=index">📝 Pqrs</a></li>
            </ul>
        </div> -->
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

        <div class="info-card">
            <h3>🎉 ¡Nuevo Diseño!</h3>
            <p>Hemos actualizado el diseño de nuestra pagina esperamos tenga una mejor experiencia como usuario.</p>
        </div>

        <div class="content-grid">
            <div class="content-card">
                <h3 class="card-title">Agenda Tu Cita</h3>
                <p class="card-description">Reserva fácilmente tu cita para chequeos, limpiezas, tratamientos especializados o cualquier consulta.
                ¡Tu salud oral es nuestra prioridad!.</p>
                <a href="#" class="btn btn-primary" style="margin-top: 16px;">Ver más</a>
            </div>

            <div class="content-card">
                <h3 class="card-title">Tratamientos</h3>
                <p class="card-description">En nuestro Centro Odontológico te ofrecemos una amplia gama de tratamientos diseñados para cuidar y mejorar tu salud bucal.</p>
                <a href="#" class="btn btn-primary" style="margin-top: 16px;">Ver más</a>
            </div>

            <div class="content-card">
                <h3 class="card-title">Pqrs</h3>
                <p class="card-description">En SAB estamos comprometidos con mejorar cada día.
        Envía tus peticiones, quejas, reclamos o sugerencias y ayúdanos a brindarte una mejor atención.</p>
                <a href="#" class="btn btn-primary" style="margin-top: 16px;">Ver más</a>
            </div>
        </div>

        <div class="content-section">
            <h3 style="color: #1e293b; font-size: 20px; font-weight: 600; margin-bottom: 16px;">Últimos Cambios</h3>
            <p style="color: #64748b; line-height: 1.6; margin-bottom: 20px;">
                Actualmente SAB se encuentra en desarrollo.
                Cada integrante trabaja en busca de implementar nuevas funcionalidades Y optimizar las ya existentes.
            </p>
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
</body>

</html>