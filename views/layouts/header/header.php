<!-- header.php 
// Este archivo contendrá el encabezado común para todas las páginas
// Puedes incluirlo en tus vistas principales para mantener la consistencia en el diseño
// Asegúrate de que la ruta a los archivos CSS e imágenes sea correcta según tu estructura de carpetas -->

<!DOCTYPE html>
<html lang="es">

<head>
    <?php
// Ruta absoluta a layout.css
$cssPath = $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/cssLayouts/layout.css';

// Ruta para el navegador (desde la raíz pública)
$cssUrl = '/views/layouts/cssLayouts/layout.css';

if (file_exists($cssPath)) {
    echo '<link rel="stylesheet" href="' . $cssUrl . '">';
} else {
    echo '<!-- CSS file not found at: ' . $cssPath . ' -->';
}
?>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
</head>

<body>
    <header class="main-header">
        <div class="main-header__logo">
            <img src="../../../Assets/img/Logo.png" alt="Logo Salud Benefit">
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

</body>

</html>