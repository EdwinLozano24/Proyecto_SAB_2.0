<!-- <?php
// Plantilla para restriccion por rol
// require_once '../../config/auth.php';
// requiereSesion();
//requiereTipo('Administrador');
//requireVariosTipos(['Especialista', 'Empleados']);
?> -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Sistema Odontológico</title>
    <link rel="stylesheet" href="../../Assets/css/dashboard/homePaciente.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <header class="main-header">
        <div class="main-header__logo">
            <img src="../../Assets/img/logoSab/logo.jpg" alt="Logo Salud Benefit">
        </div>
        <nav class="main-nav">
            <ul class="main-nav__list">
                <li class="main-nav__item"><a href="#" class="main-nav__link">Perfil</a></li>
                <li class="main-nav__item"><a href="#" class="main-nav__link">Historial clínico</a></li>
                <li class="main-nav__item"><a href="#" class="main-nav__link">Catálogo</a></li>
                <li class="main-nav__item"><a href="#" class="main-nav__link">PQRS</a></li>
                <li class="main-nav__item"><a href="#" class="main-nav__link">Agendar Cita</a></li>
            </ul>
        </nav>
    </header>

    <div class="page-wrapper">
        <aside class="sidebar">
            <ul class="sidebar__menu">
                <li class="sidebar__item">
                    <a href="index.php?c=Citas&a=home" class="sidebar__link">
                        <div class="sidebar__icon">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19,4H5C3.89,4 3,4.89 3,6V20A2,2 0 0,0 5,22H19A2,2 0 0,0 21,20V6C21,4.89 20.1,4 19,4M19,20H5V6H19V20M17,8H7V10H17V8M13,14H7V12H13V14M7,16H15V18H7V16Z" />
                            </svg>
                        </div>
                        <span class="sidebar__text">Consultar Citas</span>
                    </a>
                </li>
                <li class="sidebar__item">
                    <a href="index.php?c=Catalogo&a=home" class="sidebar__link">
                        <div class="sidebar__icon">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19,3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3M19,19H5V5H19V19M12,17H17V15H14V7H12V17Z" />
                            </svg>
                        </div>
                        <span class="sidebar__text">Ver Catálogo</span>
                    </a>
                </li>
                <li class="sidebar__item">
                    <a href="index.php?c=Pqrs&a=home" class="sidebar__link">
                        <div class="sidebar__icon">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20,2H4C2.9,2 2,2.9 2,4V22L6,18H20C21.1,18 22,17.1 22,16V4C22,2.9 21.1,2 20,2M20,16H5.2L4,17.2V4H20V16Z" />
                            </svg>
                        </div>
                        <span class="sidebar__text">Enviar PQR</span>
                    </a>
                </li>
                <li class="sidebar__item">
                    <a href="index.php?c=Historial&a=home" class="sidebar__link">
                        <div class="sidebar__icon">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12,8A4,4 0 0,1 16,12A4,4 0 0,1 12,16A4,4 0 0,1 8,12A4,4 0 0,1 12,8M12,10A2,2 0 0,0 10,12A2,2 0 0,0 12,14A2,2 0 0,0 14,12A2,2 0 0,0 12,10M10,22C9.75,22 9.54,21.82 9.5,21.58L9.13,18.93C8.5,18.68 7.96,18.34 7.44,17.94L4.95,18.95C4.73,19.03 4.46,18.95 4.34,18.73L2.34,15.27C2.21,15.05 2.27,14.78 2.46,14.63L4.57,12.97L4.5,12L4.57,11L2.46,9.37C2.27,9.22 2.21,8.95 2.34,8.73L4.34,5.27C4.46,5.05 4.73,4.96 4.95,5.05L7.44,6.05C7.96,5.66 8.5,5.32 9.13,5.07L9.5,2.42C9.54,2.18 9.75,2 10,2H14C14.25,2 14.46,2.18 14.5,2.42L14.87,5.07C15.5,5.32 16.04,5.66 16.56,6.05L19.05,5.05C19.27,4.96 19.54,5.05 19.66,5.27L21.66,8.73C21.79,8.95 21.73,9.22 21.54,9.37L19.43,11L19.5,12L19.43,13L21.54,14.63C21.73,14.78 21.79,15.05 21.66,15.27L19.66,18.73C19.54,18.95 19.27,19.04 19.05,18.95L16.56,17.95C16.04,18.34 15.5,18.68 14.87,18.93L14.5,21.58C14.46,21.82 14.25,22 14,22H10M11.25,4L10.88,6.61C9.68,6.86 8.62,7.5 7.85,8.39L5.44,7.35L4.69,8.65L6.8,10.2C6.4,11.37 6.4,12.64 6.8,13.8L4.68,15.36L5.43,16.66L7.86,15.62C8.63,16.5 9.68,17.14 10.87,17.38L11.24,20H12.76L13.13,17.39C14.32,17.14 15.37,16.5 16.14,15.62L18.57,16.66L19.32,15.36L17.2,13.81C17.6,12.64 17.6,11.37 17.2,10.2L19.31,8.65L18.56,7.35L16.15,8.39C15.38,7.5 14.32,6.86 13.12,6.62L12.75,4H11.25Z" />
                            </svg>
                        </div>
                        <span class="sidebar__text">Historial Odontológico</span>
                    </a>
                </li>
                <li class="sidebar__item">
                    <a href="../../controllers/authController.php?accion=Logout" class="sidebar__link sidebar__link--logout">
                        <div class="sidebar__icon">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17,17H7V14L3,18L7,22V19H19V13H17M7,7H17V10L21,6L17,2V5H5V11H7V7Z" />
                            </svg>
                        </div>
                        <span class="sidebar__text">Cerrar Sesión</span>
                    </a>
                </li>
            </ul>
        </aside>

        <main class="main-content">
            <section class="welcome-section">
                <div class="welcome-section__text">
                    <h1 class="welcome-section__title">¡Bienvenido a Salud Benefit!</h1>
                    <p class="welcome-section__description">Sistema integral para el manejo de tu salud dental. Aquí
                        podrás gestionar tus citas, revisar tu historial clínico y mucho más.</p>
                </div>
                <div class="welcome-section__image">
                    <img src="../../Assets/img/dashboard/perfilFondoDash.jpg" alt="Odontología">
                </div>
            </section>
        </main>
    </div>

    <footer class="main-footer">
        <div class="main-footer__content">
            <p>&copy;
                <?=date('Y')?> Salud Benefit. Todos los derechos reservados.
            </p>
            <div class="social-links">
                <a href="#" class="social-link">
                    <img src="https://cdn-icons-png.flaticon.com/512/124/124010.png" alt="Facebook">
                </a>
                <a href="#" class="social-link">
                    <img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="Twitter">
                </a>
                <a href="#" class="social-link">
                    <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram">
                </a>
            </div>
        </div>
    </footer>

    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    <df-messenger chat-title="Mark" agent-id="d13b7d8d-a8d9-4b85-88c8-9858f780da52" language-code="es">
    </df-messenger>
</body>

</html>