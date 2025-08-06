<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/proyecto_sab/assets/css/user/resetpasword.css';
    $cssUrl = '/proyecto_sab/assets/css/user/resetpasword.css';
    if (file_exists($cssPath)) {
        echo '<link rel="stylesheet" href="' . $cssUrl . '">';
    } else {
        echo ' CSS File not fount at: ' . $cssPath . '';
    }
    ?>
</head>

<body>
    <main>
        <div class="contenedor__todo">
            <div class="contenedor__reset">
                <form action="">
                <h2><?= htmlspecialchars($mensaje) ?></h2>
                <a href="index.php?action=showRecoverForm" class="link-login">Volver</a>
                </form>
            </div>
        </div>
</body>

</html>