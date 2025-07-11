<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/proyecto_sab/assets/css/error/acceso_denegado.css';
    $cssUrl = '/proyecto_sab/assets/css/error/acceso_denegado.css';
    if (file_exists($cssPath)) {
        echo '<link rel="stylesheet" href="' . $cssUrl . '">';
    } else {
        echo ' CSS File not fount at: ' . $cssPath . '';
    }
    ?>
    <title>Acceso Denegado</title>
</head>
<body>
    <div class="container-custom">
        <!-- Icono de error -->
        <div class="error-icon">
            🚫
        </div>

        <!-- Código de error -->
        <div class="error-code">
            ERROR 403
        </div>

        <!-- Título y subtítulo -->
        <h1 class="error-title">Acceso Denegado</h1>
        <h2 class="error-subtitle">No tienes permisos para acceder</h2>

        <!-- Descripción -->
        <p class="error-description">
            Lo sentimos, no tienes los permisos necesarios para acceder a esta página o recurso. 
            Si crees que esto es un error, contacta con el administrador del sistema.
        </p>

        <!-- Botones de acción -->
        <div class="button-group">
            <a href="javascript:history.back()" class="btn-custom btn-primary-custom">
                ← Volver Atrás
            </a>
            <a href="/proyecto_sab/controllers/AuthController.php?accion=index" class="btn-custom btn-secondary-custom">
                🏠 Ir al Inicio
            </a>
        </div>

        <!-- Información adicional -->
        <div class="additional-info">
            <h4>Posibles causas:</h4>
            <ul>
                <li>Tu sesión ha expirado</li>
                <li>No tienes los permisos necesarios</li>
                <li>La página requiere autenticación</li>
                <li>El recurso ha sido movido o eliminado</li>
            </ul>
        </div>
    </div>
</body>
</html>