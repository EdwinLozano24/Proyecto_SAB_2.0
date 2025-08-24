<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Términos y Condiciones</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Enlace a tu layout principal -->
    <link rel="stylesheet" href="/Assets/css/layoutFinal/paciente/layout1.css">
    <!-- Enlace a los estilos específicos de términos -->
    <link rel="stylesheet" href="/Assets/css/terminosCondiciones/terminosCondiciones.css">
</head>

<body>
    <?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/nav.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/aside.php');
    ?>

    <main class="main-content">
        <div class="terminos-container">
            <section class="terminos-section">
                <div class="content-header">
                    <h1 class="content-title">Términos y Condiciones SAB</h1>
                    <p class="content-subtitle">Por favor, lee atentamente nuestros términos antes de utilizar nuestros servicios</p>
                </div>

                <div class="info-card last-updated">
                    <p><strong>Última actualización:</strong> 24 de Agosto, 2025</p>
                </div>

                <div class="terminos-content">
                    <!-- Sección 1 -->
                    <div class="content-card terminos-item">
                        <h2 class="card-title"><i class="fas fa-user-check"></i> Aceptación de Términos</h2>
                        <p>Al acceder y utilizar los servicios de SAB, usted acepta estar legalmente obligado por estos Términos y Condiciones...</p>
                    </div>

                    <!-- Sección 2 -->
                    <div class="content-card terminos-item">
                        <h2 class="card-title"><i class="fas fa-teeth-open"></i> Servicios</h2>
                        <p>Nuestro software ofrece los siguientes servicios:</p>
                        <ul>
                            <li>Gestión de Usuarios</li>
                            <li>Gestión de Citas</li>
                            <li>Gestión de Tratamientos</li>
                            <li>Gestión de Pqrs</li>
                            <li>Gestión de Historial Clínico</li>
                        </ul>
                    </div>

                    <!-- Sección 3 -->
                    <div class="content-card terminos-item">
                        <h2 class="card-title"><i class="fas fa-calendar-check"></i> Sistema de Citas</h2>
                        <p>Para agendar una cita, los pacientes pueden utilizar nuestro sistema en línea...</p>
                        <div class="info-card highlight-box">
                            <p><strong>Política de cancelación:</strong> Las citas deben cancelarse con al menos 12 horas de antelación...</p>
                        </div>
                    </div>

                    <!-- Sección 4: Política de Pagos -->
                    <div class="terminos-item">
                        <h2><i class="fas fa-money-bill-wave"></i> Política de Pagos</h2>
                        <p>SAB no será intermediario de ningun tipo de pago. Los precios que se visualizan en el catalogo de tratamientos son parte de un precio aproximado registrado por la clínica odontológica.</p>
                    </div>

                    <!-- Sección 5: Privacidad y Confidencialidad -->
                    <div class="terminos-item">
                        <h2><i class="fas fa-shield-alt"></i> Privacidad y Confidencialidad</h2>
                        <p>Respetamos su derecho a la privacidad. Toda la información personal y médica se maneja de acuerdo con nuestra Política de Privacidad y las leyes aplicables de protección de datos.</p>
                        <p>Su información de salud dental se mantendrá confidencial y solo se compartirá con terceros con su consentimiento explícito, excepto cuando la ley exija lo contrario.</p>
                    </div>

                    <!-- Sección 6: Limitación de Responsabilidad -->
                    <div class="terminos-item">
                        <h2><i class="fas fa-exclamation-circle"></i> Limitación de Responsabilidad</h2>
                        <p>No garantizamos resultados específicos de los tratamientos. Los resultados están bajo la responsabilidad del personal de la clínica odontológica.</p>
                        <p>No seremos responsables por daños indirectos, incidentales o consecuentes resultantes del uso de nuestros servicios.</p>
                    </div>

                    <!-- Sección 7: Propiedad Intelectual -->
                    <div class="terminos-item">
                        <h2><i class="fas fa-gavel"></i> Propiedad Intelectual</h2>
                        <p>Todo el contenido del sitio web, incluyendo texto, gráficos, logotipos, imágenes y software, es propiedad de SAB y está protegido por las leyes de propiedad intelectual.</p>
                    </div>

                    <!-- Sección 8: Modificaciones a los Términos -->
                    <div class="terminos-item">
                        <h2><i class="fas fa-balance-scale"></i> Modificaciones a los Términos</h2>
                        <p>Nos reservamos el derecho de modificar estos Términos y Condiciones en cualquier momento. Los cambios entrarán en vigor inmediatamente después de su publicación en nuestra aplicación web. El uso continuado de nuestros servicios después de dichos cambios constituye su aceptación de los nuevos términos.</p>
                    </div>

                    <!-- Información de contacto -->
                    <div class="contact-info">
                        <h3><i class="fas fa-question-circle"></i> ¿Tienes preguntas?</h3>
                        <p>No dudes en contactarnos si necesitas aclaraciones o tienes inquietudes.</p>
                        <a href="/views/.general/contactenos/contactenos.php" class="btn btn-primary">
                            <i class="fas fa-envelope"></i> Contáctanos
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?php include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/footer.php'); ?>
</body>

</html>