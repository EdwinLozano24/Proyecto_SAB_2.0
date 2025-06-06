<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tratamientos Sab</title>
    <link rel="stylesheet" href="../../Assets/css/catalogo/Catalogo.css">
    <!-- Bootstrap -->
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    
</head>

<body>
    <!-- Encabezado -->
    <header>
        <div id="logo" class="d-flex align-items-center">
            <img src="../../Assets/img/logoSab/logo.jpg" alt="Logo" class="me-2">
            
        </div>

        <!-- Menú de navegación -->
        <nav>
            <ul class="nav justify-content-center">
                <li class="nav-item"><a class="nav-link" href="#">Perfil</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Historial clínico</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Catálogo</a></li>
                <li class="nav-item"><a class="nav-link" href="#">PQRS</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Agendar Cita</a></li>
            </ul>
        </nav>
    </header>

    <!-- Contenido principal -->
    <main class="container my-4">
        <!-- Información sobre tratamientos -->
        <section id="informacionTratamiento">
            <h1 class="text-center">Tratamientos</h1>
            <p class="text-center">Selecciona un tratamiento para ver más detalles y agendar tu cita.</p>
        </section>

        <!-- Carrusel de tratamientos -->
        <section id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../../Assets/img/Tratamientos/tratamiento1.jpg" class="d-block w-100" alt="Tratamiento 1">
                </div>
                <div class="carousel-item">
                    <img src="../../Assets/img/Tratamientos/tratamiento2.jpg" class="d-block w-100" alt="Tratamiento 2">
                </div>
                <div class="carousel-item">
                    <img src="../../Assets/img/Tratamientos/tratamiento3.jpg" class="d-block w-100" alt="Tratamiento 3">
                </div>
            </div>
            <!-- Controles del carrusel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </section>

        <!-- Filtros -->
        <aside class="my-3">
            <div class="filtro">
                <label for="filtroTratamiento">Filtros </label>
                <select id="filtroTratamiento" class="form-select">
                    <option value="todos">Todos</option>
                    <option value="tipo1">Recientes</option>
                    <option value="tipo2">Relevantes</option>
                </select>
            </div>
        </aside>

        <!-- Listado de tratamientos -->
        <section class="tratamientos row g-3">
            <div class="col-md-3 tratamiento-item">
                <h3>Tratamiento 1</h3>
                <p>Descripción breve del Tratamiento 1.</p>
            </div>
            <div class="col-md-3 tratamiento-item">
                <h3>Tratamiento 2</h3>
                <p>Descripción breve del Tratamiento 2.</p>
            </div>
            <div class="col-md-3 tratamiento-item">
                <h3>Tratamiento 3</h3>
                <p>Descripción breve del Tratamiento 3.</p>
            </div>
            <div class="col-md-3 tratamiento-item">
                <h3>Tratamiento 4</h3>
                <p>Descripción breve del Tratamiento 4.</p>
            </div>
            <div class="col-md-3 tratamiento-item">
                <h3>Tratamiento 5</h3>
                <p>Descripción breve del Tratamiento 5.</p>
            </div>
            <div class="col-md-3 tratamiento-item">
                <h3>Tratamiento 6</h3>
                <p>Descripción breve del Tratamiento 6.</p>
            </div>
            <div class="col-md-3 tratamiento-item">
                <h3>Tratamiento 7</h3>
                <p>Descripción breve del Tratamiento 7.</p>
            </div>
            <div class="col-md-3 tratamiento-item">
                <h3>Tratamiento 8</h3>
                <p>Descripción breve del Tratamiento 8.</p>
            </div>
        </section>
    </main>

    <!-- Pie de página -->
    <footer class="text-center py-3">
        <p>&copy; <?=date('Y')?> Salud Benefit. Todos los derechos reservados.</p>
          <a href="#" class="social-link">
                    <img src="https://cdn-icons-png.flaticon.com/512/124/124010.png" alt="Facebook" class="imagenes--footer">
                </a>
                <a href="#" class="social-link">
                    <img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="Twitter" class="imagenes--footer">
                </a>
                <a href="#" class="social-link">
                    <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram" class="imagenes--footer">
                </a>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>