<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión PQR</title>
    <link rel="stylesheet" href="../../Assets/css/pqr/pqrs.css">
    
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


    <div class="viewport">
    <div class="container">
        <h1>PQR'S</h1>
        
        <a href="index.php?c=Pqrs&a=datosPaciente" class="btn">Enviar Petición</a>
        <a href="index.php?c=Pqrs&a=eliminarPqr" class="btn">Eliminar PQR</a>
        <a href="index.php?c=Home&a=home"class="btn">Volver</a>
    </div>
    </div>


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
</body>

</html>

