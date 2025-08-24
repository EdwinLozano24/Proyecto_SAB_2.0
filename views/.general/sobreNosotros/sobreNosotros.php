<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre nosotros</title>
    <link rel="stylesheet" href="/Assets/css/layoutFinal/paciente/layout1.css">
    <link rel="stylesheet" href="/assets/css/sobreNosotros/sobreNosotros2.css">
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

                <!-- Objetivos del proyecto -->
                <div class="objetivos">
                    <h3>Objetivo General</h3>
                    <p>Desarrollar un sistema web para la gestión de citas en una clínica odontológica privada, optimizando los procesos administrativos y mejorando la experiencia de los pacientes.</p>

                    <h3>Objetivos Específicos</h3>
                    <ul>
                        <li>Analizar los procesos actuales de agendamiento de citas en el sector odontológico privado.</li>
                        <li>Diseñar un modelo de datos que garantice la seguridad y organización de la información.</li>
                        <li>Implementar módulos para la gestión de citas, tratamientos y usuarios.</li>
                        <li>Validar el funcionamiento del sistema mediante pruebas de usabilidad y seguridad.</li>
                    </ul>
                </div>

                <!-- Misión y Visión -->
                <div class="mision-vision">
                    <div class="mision">
                        <h3>Misión</h3>
                        <p>Nuestra misión es crear soluciones digitales que faciliten la gestión de citas y mejoren la relación entre clínicas odontológicas y pacientes.</p>
                    </div>
                    <div class="vision">
                        <h3>Visión</h3>
                        <p>Ser un equipo reconocido por la creación de software accesible, seguro e innovador para el sector salud y otras áreas relacionadas.</p>
                    </div>
                </div>

                <!-- Equipo -->
                <div class="equipo">
                    <h3 class="section-title">Nuestro equipo</h3>
                    <p class="section-subtitle">Conoce a los aprendices que hicieron realidad este proyecto</p>

                    <div class="equipo-grid">
                        <!-- Miembro 1 -->
                        <div class="equipo-card">
                            <div class="card-img">
                                <img src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/cristiano-ronaldo-cr7%3A-limited-special-editio-design-template-1ade76990ca076687849a104fb3d70b1_screen.jpg?ts=1733770873" alt="Foto Santiago">
                            </div>
                            <div class="card-content">
                                <h4>Santiago Carranza</h4>
                                <p>Desarrollador Backend</p>
                            </div>
                        </div>
                        <!-- Miembro 2 -->
                        <div class="equipo-card">
                            <div class="card-img">
                                <img src="https://img.chelseafc.com/image/upload/f_auto,w_1440,c_fill,g_faces,q_90/editorial/news/2023/06/20/Kante_PL_trophy_2016_GettyImages-686388948.jpg" alt="Foto Angelo">
                            </div>
                            <div class="card-content">
                                <h4>Angelo Gonzalez</h4>
                                <p>Analista de Requerimientos</p>
                            </div>
                        </div>
                        <!-- Miembro 3 -->
                        <div class="equipo-card">
                            <div class="card-img">
                                <img src="https://thumbs.dreamstime.com/b/lionel-messi-22716478.jpg" alt="Foto Edwin">
                            </div>
                            <div class="card-content">
                                <h4>Edwin Lozano</h4>
                                <p>Frontend Developer</p>
                            </div>
                        </div>
                        <!-- Miembro 4 -->
                        <div class="equipo-card">
                            <div class="card-img">
                                <img src="https://thumbs.dreamstime.com/b/vector-de-perfil-avatar-predeterminado-foto-usuario-medios-sociales-icono-183042379.jpg" alt="Foto Juan">
                            </div>
                            <div class="card-content">
                                <h4>Juan Castro</h4>
                                <p>QA Tester</p>
                            </div>
                        </div>
                        <!-- Miembro 5 -->
                        <div class="equipo-card">
                            <div class="card-img">
                                <img src="https://thumbs.dreamstime.com/b/vector-de-perfil-avatar-predeterminado-foto-usuario-medios-sociales-icono-183042379.jpg" alt="Foto Agnel">
                            </div>
                            <div class="card-content">
                                <h4>Agnel Tinoco</h4>
                                <p>Diseñador UI/UX</p>
                            </div>
                        </div>
                    </div>
                    <!-- Valores -->
                    <div class="valores">
                        <h3>Valores</h3>
                        <ul>
                            <li>Innovación</li>
                            <li>Compromiso</li>
                            <li>Responsabilidad</li>
                            <li>Trabajo en equipo</li>
                        </ul>
                    </div>
                    <!-- Documento general del proyecto -->
                    <div class="documento-proyecto">
                        <h3>Documentación del Proyecto</h3>
                        <p>Consulta el documento general del proyecto, con los diagramas, modelos de datos y análisis completo del sistema.</p>
                        <a href="https://docs.google.com/document/d/1QPj8asAXbAwXNvvhILz0kmkowixvlbXu/edit" target="_blank" class="btn-doc">
                            <i class="fa-solid fa-file-pdf"></i> Ver Documento Completo
                        </a>
                    </div>
                </div>

            </section>
        </div>
    </main>


    <?php include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/footer.php'); ?>
</body>

</html>