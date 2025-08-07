<?php
require_once '../../config/auth.php';
requiereSesion();
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

<?php 
include '../layouts/prueba/nav.php';
include '../layouts/prueba/header.php';
include '../layouts/prueba/aside.php';
?>

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

</body>

</html>