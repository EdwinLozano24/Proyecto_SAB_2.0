<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/assets/css/error/acceso_denegado.css';
    $cssUrl = '/assets/css/error/acceso_denegado.css';
    if (file_exists($cssPath)) {
        echo '<link rel="stylesheet" href="' . $cssUrl . '">';
    } else {
        echo ' CSS File not fount at: ' . $cssPath . '';
    }
    ?>
    <title>Acceso Denegado</title>
    <link rel="icon" type="image/png" href="/Assets/img/favicon.png"> 
</head>
<body>
    <div class="container-custom">
        <!-- Icono de error -->
        <div class="error-icon">
            🚫
        </div>

        <!-- Código de error -->
        <div class="error-code">
            ERROR 
        </div>

        <!-- Título y subtítulo -->
        <h1 class="error-title">Ocurrio un error al visualizar tus citas pendientes</h1>
        <h2 class="error-subtitle">                   <?php foreach ($errors as $error): ?>
        <li><?= htmlspecialchars($error) ?></li>
      <?php endforeach; ?></h2>

        <!-- Descripción -->
        <p class="error-description">

        </p>

        <!-- Botones de acción -->
        <div class="button-group">
            <a href="#" class="btn-custom btn-primary-custom" onclick="window.history.back()">
                ← Volver Atrás
            </a>
            <a href="/controllers/AuthController.php?accion=index" class="btn-custom btn-secondary-custom">
                🏠 Ir al Inicio
            </a>
        </div>

        <!-- Información adicional -->
        <div class="additional-info">
            <h4>Posibles causas:</h4>
            <ul>
            </ul>
        </div>
    </div>
</body>
</html>