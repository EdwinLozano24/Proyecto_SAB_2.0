<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo Tratamientos</title>
    <link rel="stylesheet" href="/Assets/css/layoutFinal/paciente/layout1.css">
    <link rel="stylesheet" href="/assets/css/tratamiento/tratamientoVisualizar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="catalogo-page">
    <?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/nav/navTratamiento.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/aside/aside.php');

    // CONEXIÓN A LA BASE DE DATOS
    require_once($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');
    $pdo = conectarBD(); 

    try {
        // Consulta para obtener todos los tratamientos activos
        $query = "SELECT * FROM tbl_tratamientos WHERE trat_estado = 'Activo'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $tratamientos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $tratamientos = [];
        error_log("Error al cargar tratamientos: " . $e->getMessage());
    }
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
                            <img src="/assets/img/tratamientoVisualizar/Logo_resized.png/" alt="Promoción SAB">
                            <div class="slide-caption">
                                <h3>¡Contactanos ya!</h3>
                                <p>No te vas a arepentir</p>
                            </div>
                        </div>
                        <div class="slide">
                            <img src="/assets/img/tratamientoVisualizar/gestionar.jpg/" alt="Podrás gestionar tus Citas, Usuarios, Pqrs, Tratamientos, e Historiales Clínicos.">
                            <div class="slide-caption">
                                <h3>¡No pierdas la oportunidad!</h3>
                                <p>Podrás gestionar tus Citas, Usuarios, Pqrs, Tratamientos, e Historiales Clínicos</p>
                            </div>
                        </div>
                        <div class="slide">
                            <img src="/assets/img/tratamientoVisualizar/confianza.jpg" alt="Tu bienestar y comodidad son nuestra prioridad">
                            <div class="slide-caption">
                                <h3>¡Creemos en la innovación!</h3>
                                <p>Tu bienestar y comodidad son nuestra prioridad</p>
                            </div>
                        </div>
                    </div>
                    <button class="carrusel-btn prev">‹</button>
                    <button class="carrusel-btn next">›</button>
                    <div class="carrusel-dots"></div>
                </section>
                <div class="tratamientos-grid">

                    <?php if (!empty($tratamientos)): ?>
                        <?php foreach ($tratamientos as $tratamiento): ?>
                            <div class="tratamiento-card" data-name="<?php echo htmlspecialchars($tratamiento['trat_nombre']); ?>">
                                <div class="card-image">
                                    <img src="https://www.odontosupport.es/wp-content/uploads/2023/02/Diseno-sin-titulo-min-2.jpg"<?php echo htmlspecialchars($tratamiento['trat_imagen'] ?? 'default.jpg'); ?>"
                                        alt="<?php echo htmlspecialchars($tratamiento['trat_nombre']); ?>">
                                </div>
                                <div class="card-content">
                                    <h3><?php echo htmlspecialchars($tratamiento['trat_nombre']); ?></h3>
                                    <p class="card-desc"><?php echo htmlspecialchars($tratamiento['trat_descripcion']); ?></p>
                                    <div class="card-footer">
                                        <span class="card-duracion"><?php echo htmlspecialchars($tratamiento['trat_duracion']); ?></span>
                                        <button class="btn btn-vermas">Ver más</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="no-results show">
                            No hay tratamientos disponibles en este momento.
                        </div>
                    <?php endif; ?>

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