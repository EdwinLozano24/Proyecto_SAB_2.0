<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soporte SAB</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Enlace a tu layout principal -->
    <link rel="stylesheet" href="/Assets/css/layoutFinal/paciente/layout1.css">
    <!-- Estilos propios del soporte -->
    <link rel="stylesheet" href="/assets/css/soporte/soporte.css">
    <link rel="icon" type="image/png" href="/Assets/img/favicon.png">
</head>

<body>
    <?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/admin/header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/admin/nav/nav.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/admin/aside/aside.php');
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
                        <li><strong>¿Cómo agendar una cita?</strong> Ingresa a la sección "Agendar cita" desde el menú y selecciona el día y la hora disponible.</li>
                        <li><strong>¿Cómo cancelar o reprogramar?</strong> Ve a "Mis citas", selecciona la cita y haz clic en cancelar o reprogramar.</li>
                        <li><strong>¿Qué hago si olvidé mi contraseña?</strong> Utiliza la opción "Recuperar contraseña" en la pantalla de inicio de sesión.</li>
                        <li><strong>¿Los precios son definitivos?</strong> No, los valores mostrados son aproximados, la clínica te confirmará el costo final.</li>
                    </ul>
                </div>

                <!-- Centro de documentación -->
                <div class="content-card">
                    <h2 class="card-title"><i class="fas fa-folder-open"></i> Centro de Documentación</h2>
                    <p class="card-description">Accede a los documentos oficiales del sistema SAB:</p>
                    <ul class="card-description">
                        <li>📘 <a href="https://drive.google.com/drive/u/0/folders/1MuHPP3ZnmY7lxyoYofJd_OP-3XafH_qv" target="_blank">Manual Técnico</a></li>
                        <li>👥 <a href="https://drive.google.com/drive/u/0/folders/1tpchxaIP_S-Btx8QAwGB2BK4Kazf7v7x" target="_blank">Manual de Usuario</a></li>
                        <li>🎨 <a href="https://drive.google.com/drive/u/0/folders/1OrD2fm4jHsC-QgkYZOSwEvnOsobYKbeA" target="_blank">Manual de Identidad</a></li>
                        <li>📑 <a href="https://drive.google.com/drive/u/0/folders/1uptmklbw6PxTrPKKNCrcvP7iV_lICXtt" target="_blank">Informe Final</a></li>
                    </ul>
                </div>

                <!-- Canales de contacto -->
                <div class="content-card">
                    <h2 class="card-title"><i class="fas fa-headset"></i> Canales de Contacto</h2>
                    <p class="card-description">¿Necesitas ayuda personalizada? Nuestro equipo de soporte está disponible para resolver tus dudas.</p>
                    <a href="/views/.general/contactenos/contactenos.php" class="btn btn-primary">
                        <i class="fas fa-envelope"></i> Contáctanos
                    </a>
                </div>
            </section>
        </div>
    </main>

    <?php include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/admin/footer.php'); ?>
</body>

</html>