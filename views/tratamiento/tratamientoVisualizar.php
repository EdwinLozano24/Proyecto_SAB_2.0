<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo Tratamientos</title>
    <link rel="stylesheet" href="../../Assets/css/layoutFinal/paciente/layout.css">
    <link rel="stylesheet" href="../../Assets/css/tratamiento/tratamientoVisualizar.css">
</head>

<body class="catalogo-page">
    <?php
    session_start();
    include '../layoutsFinal/paciente/header.php';
    include '../layoutsFinal/paciente/nav.php';
    include '../layoutsFinal/paciente/aside.php';
    ?>

    <main class="main-content">
        <div class="catalogo-container">
            <!-- Catálogo de tratamientos -->
            <section class="tratamientos-section">
                <h2 class="section-title">Nuestros Tratamientos</h2>
                            <section class="carrusel-container">
                <div class="carrusel">
                    <div class="slide active">
                        <img src="../../Assets/img/tratamiento2.jpg" alt="Promoción Blanqueamiento Dental">
                        <div class="slide-caption">
                            <h3>Blanqueamiento Dental Profesional</h3>
                            <p>30% de descuento este mes</p>
                        </div>
                    </div>
                    <div class="slide">
                        <img src="../../Assets/img/tratamiento3.jpg" alt="Ortodoncia Invisible">
                        <div class="slide-caption">
                            <h3>Ortodoncia Invisible</h3>
                            <p>Financiamiento disponible</p>
                        </div>
                    </div>
                    <div class="slide">
                        <img src="../../Assets/img/tratamiento1.jpg" alt="Implantes Dentales">
                        <div class="slide-caption">
                            <h3>Implantes Dentales</h3>
                            <p>Recupera tu sonrisa completa</p>
                        </div>
                    </div>
                </div>
                <button class="carrusel-btn prev">‹</button>
                <button class="carrusel-btn next">›</button>
                <div class="carrusel-dots"></div>
            </section>
                <div class="tratamientos-grid">
                    <!-- Tarjeta 1 -->
                    <div class="tratamiento-card">
                        <div class="card-image">
                            <img src="../../Assets/img/tratamientosVisualizar/blanqueamiento.webp" alt="Blanqueamiento Dental">
                        </div>
                        <div class="card-content">
                            <h3>Blanqueamiento Dental</h3>
                            <p class="card-desc">Aclara varios tonos tu sonrisa con nuestro tratamiento profesional.</p>
                            <div class="card-footer">
                                <span class="card-price">Desde $300.000</span>
                                <button class="btn btn-vermas">Ver más</button>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="tratamiento-card">
                        <div class="card-image">
                            <img src="../../Assets/img/tratamientosVisualizar/ortodoncia.png" alt="Ortodoncia">
                        </div>
                        <div class="card-content">
                            <h3>Ortodoncia</h3>
                            <p class="card-desc">Corrige la posición de tus dientes con nuestros brackets estéticos.</p>
                            <div class="card-footer">
                                <span class="card-price">Desde $2'500.000</span>
                                <button class="btn btn-vermas">Ver más</button>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="tratamiento-card">
                        <div class="card-image">
                            <img src="../../Assets/img/tratamientosVisualizar/implanteDental.jpg" alt="Implantes Dentales">
                        </div>
                        <div class="card-content">
                            <h3>Implantes Dentales</h3>
                            <p class="card-desc">Solución permanente para dientes perdidos con tecnología de última generación.</p>
                            <div class="card-footer">
                                <span class="card-price">Desde $1'800.000</span>
                                <button class="btn btn-vermas">Ver más</button>
                            </div>
                        </div>
                        
                    </div>
                    <div class="tratamiento-card">
                        <div class="card-image">
                            <img src="../../Assets/img/tratamientosVisualizar/implanteDental.jpg" alt="Implantes Dentales">
                        </div>
                        <div class="card-content">
                            <h3>Implantes Dentales</h3>
                            <p class="card-desc">Solución permanente para dientes perdidos con tecnología de última generación.</p>
                            <div class="card-footer">
                                <span class="card-price">Desde $1'800.000</span>
                                <button class="btn btn-vermas">Ver más</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?php
    include '../layoutsFinal/paciente/footer.php';
    ?>
    <script src="../../Assets/js/tratamiento/tratamientoVisualizar.js"></script>
</body>

</html>