<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre nosotros</title>
    <link rel="stylesheet" href="/Assets/css/layoutFinal/paciente/layout1.css">
    <link rel="stylesheet" href="/assets/css/sobreNosotros/sobreNosotros.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/nav.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/aside.php');
    ?>

    <main class="main-content">
        <div class="somos-container">
            <section class="somos-section">
                <h2 class="section-title">Sobre nosotros</h2>
                <p class="section-subtitle">Un grupo de aprendices comprometidos con la innovación</p>

                <div class="mision-vision">
                    <div class="mision">
                        <h3>Misión</h3>
                        <p>Nuestra misión es desarrollar soluciones digitales que mejoren la gestión de citas y procesos en el sector odontológico privado.</p>
                    </div>
                    <div class="vision">
                        <h3>Visión</h3>
                        <p>Ser un equipo reconocido por crear software innovador, accesible y seguro para el sector salud y otros ámbitos.</p>
                    </div>
                </div>

                <div class="valores">
                    <h3>Valores</h3>
                    <ul>
                        <li>Innovación</li>
                        <li>Compromiso</li>
                        <li>Responsabilidad</li>
                        <li>Trabajo en equipo</li>
                    </ul>
                </div>

                <div class="equipo">
                    <h3 class="section-title">Nuestro equipo</h3>
                    <p class="section-subtitle">Conoce a los aprendices que hicieron realidad este proyecto</p>

                    <div class="equipo-grid">
                        <!-- Miembro 1 -->
                        <div class="equipo-card">
                            <div class="card-img">
                                <img src="/assets/img/equipo/angelo.jpg" alt="Foto de Angelo">
                            </div>
                            <div class="card-content">
                                <h4>Angelo Gonzalez</h4>
                                <p>Desarrollador Backend</p>
                            </div>
                        </div>
                        <!-- Miembro 2 -->
                        <div class="equipo-card">
                            <div class="card-img">
                                <img src="/assets/img/equipo/integrante2.jpg" alt="Foto integrante">
                            </div>
                            <div class="card-content">
                                <h4>Nombre Apellido</h4>
                                <p>Frontend Developer</p>
                            </div>
                        </div>
                        <!-- Miembro 3 -->
                        <div class="equipo-card">
                            <div class="card-img">
                                <img src="/assets/img/equipo/integrante3.jpg" alt="Foto integrante">
                            </div>
                            <div class="card-content">
                                <h4>Nombre Apellido</h4>
                                <p>Analista de Requerimientos</p>
                            </div>
                        </div>
                        <!-- Miembro 4 -->
                        <div class="equipo-card">
                            <div class="card-img">
                                <img src="/assets/img/equipo/integrante4.jpg" alt="Foto integrante">
                            </div>
                            <div class="card-content">
                                <h4>Nombre Apellido</h4>
                                <p>QA Tester</p>
                            </div>
                        </div>
                        <!-- Miembro 5 -->
                        <div class="equipo-card">
                            <div class="card-img">
                                <img src="/assets/img/equipo/integrante5.jpg" alt="Foto integrante">
                            </div>
                            <div class="card-content">
                                <h4>Nombre Apellido</h4>
                                <p>Diseñador UI/UX</p>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </main>

    <?php include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/footer.php'); ?>
</body>

</html>
