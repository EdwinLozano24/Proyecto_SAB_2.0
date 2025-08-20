<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo Tratamientos</title>
    <link rel="stylesheet" href="/assets/css/layoutFinal/paciente/layout.css">
    <link rel="stylesheet" href="/assets/css/tratamiento/tratamientoVisualizar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="catalogo-page">
    <?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/nav.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/aside.php');
    ?>

    <main class="main-content">
        <div class="catalogo-container">
            <!-- Catálogo de tratamientos -->
            <section class="tratamientos-section">
                <h2 class="section-title">Nuestros Tratamientos</h2>
                <div class="search-container">
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="treatmentSearch" placeholder="Buscar tratamientos..." class="search-input">
                    </div>
                </div>
                <section class="carrusel-container">
                    <div class="carrusel">
                        <div class="slide active">
                            <img src="/assets/img/tratamiento2.jpg" alt="Promoción Blanqueamiento Dental">
                            <div class="slide-caption">
                                <h3>Blanqueamiento Dental Profesional</h3>
                                <p>30% de descuento este mes</p>
                            </div>
                        </div>
                        <div class="slide">
                            <img src="/assets/img/tratamiento3.jpg" alt="Ortodoncia Invisible">
                            <div class="slide-caption">
                                <h3>Ortodoncia Invisible</h3>
                                <p>Financiamiento disponible</p>
                            </div>
                        </div>
                        <div class="slide">
                            <img src="/assets/img/tratamiento1.jpg" alt="Implantes Dentales">
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

                    <div class="tratamiento-card">
                        <div class="card-image">
                            <img src="/assets/img/tratamientosVisualizar/ortodoncia.png" alt="Ortodoncia">
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
                            <img src="/assets/img/tratamientosVisualizar/implanteDental.jpg" alt="Implantes Dentales">
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
                            <img src="/assets/img/tratamientosVisualizar/implanteDental.jpg" alt="Implantes Dentales">
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
                            <img src="/assets/img/tratamientosVisualizar/blanqueamiento.webp" alt="Blanqueamiento Dental">
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
                    <div class="tratamiento-card">
                        <div class="card-image">
                            <img src="/assets/img/tratamientosVisualizar/implanteDental.jpg" alt="Implantes Dentales">
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
                <div id="noResultsMessage" class="no-results hidden">
                    No se encontraron tratamientos que coincidan con tu búsqueda.
                </div>
            </section>
        </div>
    </main>

    <?php
include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/footer.php');
    ?>
    <script src="/assets/js/tratamiento/tratamientoVisualizarBusqueda.js"></script>
    <script src="/assets/js/tratamiento/tratamientoVisualizar.js"></script>
</body>

</html>