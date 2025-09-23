<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soporte SAB</title>

    <!-- Íconos FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Layout principal del paciente -->
    <link rel="stylesheet" href="/Assets/css/layoutFinal/paciente/layout1.css">

    <!-- Estilos propios del soporte -->
    <link rel="stylesheet" href="/Assets/css/soporte/soporte.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/Assets/img/favicon.png">
</head>

<body>
    <?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/nav.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/aside.php');
    ?>

    <main class="main-content">
        <div class="soporte-container">
            <section class="soporte-section">
                <div class="content-header">
                    <h1 class="content-title">Soporte SAB</h1>
                    <p class="content-subtitle">Encuentra aquí respuestas, guías y recursos de ayuda</p>
                </div>

                <!-- Preguntas frecuentes -->
                <div class="content-card">
                    <h2 class="card-title"><i class="fas fa-question-circle"></i> Preguntas Frecuentes</h2>
                    <ul class="card-description">
                        <li><strong>¿Cómo agendar una cita?</strong> Ingresa a la sección 
                            <a href="/views/paciente/citas/agendar.php" class="link">Agendar cita</a> desde el menú y selecciona el día y la hora disponible.</li>
                        <li><strong>¿Cómo cancelar o reprogramar?</strong> Ve a 
                            <a href="/views/paciente/citas/misCitas.php" class="link">Mis citas</a>, selecciona la cita y haz clic en cancelar o reprogramar.</li>
                        <li><strong>¿Qué hago si olvidé mi contraseña?</strong> Utiliza la opción 
                            <a href="/views/.general/auth/recuperar.php" class="link">Recuperar contraseña</a> en la pantalla de inicio de sesión.</li>
                        <li><strong>¿Los precios son definitivos?</strong> No, los valores mostrados son aproximados, la clínica te confirmará el costo final.</li>
                    </ul>
                </div>

                <!-- Guía de uso rápida -->
                <div class="content-card">
                    <h2 class="card-title"><i class="fas fa-book-open"></i> Guía de Uso Rápida</h2>
                    <p class="card-description">Descarga nuestro manual de usuario para conocer paso a paso cómo utilizar SAB.</p>
                    <a href="/Assets/docs/manual_usuario.pdf" target="_blank" class="btn btn-primary">
                        <i class="fas fa-download"></i> Descargar Manual
                    </a>
                </div>

                <!-- Canales de contacto -->
                <div class="content-card">
                    <h2 class="card-title"><i class="fas fa-headset"></i> Canales de Contacto</h2>
                    <p class="card-description">¿Necesitas ayuda personalizada? Nuestro equipo de soporte está disponible para resolver tus dudas.</p>
                    <a href="/views/.general/contactenos/contactenos.php" class="btn btn-primary">
                        <i class="fas fa-envelope"></i> Contáctanos
                    </a>
                </div>

                <!-- Centro de documentación -->
                <div class="content-card">
                    <h2 class="card-title"><i class="fas fa-folder-open"></i> Centro de Documentación</h2>
                    <p class="card-description">Próximamente encontrarás aquí:</p>
                    <ul class="card-description">
                        <li>📘 Manual Técnico</li>
                        <li>👥 Manual de Usuario</li>
                        <li>🎨 Manual de Identidad</li>
                    </ul>
                    <p class="card-description"><em>Estos documentos estarán disponibles una vez completados.</em></p>
                </div>

            </section>
        </div>
    </main>

    <?php include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/footer.php'); ?>
</body>

</html>
