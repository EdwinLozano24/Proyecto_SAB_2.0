<?php
require_once '../../../config/auth.php';

requiereSesion();
$id_usuario = $_SESSION['usuario']['id_usuario'];
$nombreUsuario = $_SESSION['usuario']['usua_nombre'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Assets/css/layoutFinal/paciente/layout1.css">
    <title>¡Bienvenido a SAB!</title>
</head>

<body>
    <?php 
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/nav/nav.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/aside/asideHistorial.php');
    ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-header">
            <h2 class="content-title">Historial Clinico</h2>
            <p class="content-subtitle">Informacion del Paciente.</p>
        </div>
        <div class="content-grid">
            <div class="content-card">
                <h3 class="card-title">Historial Clinico</h3>
                <p class="card-description">Dentro se visualizara algunas opciones.</p>
                <a href="controllers/HistorialController.php?accion=solicitarHistorial&id_usuario=<?php echo($id_usuario) ?>" class="btn btn-primary" style="margin-top: 16px;">Solicitalo Aqui.</a>
            </div>
        </div>
    </main>
<?php 
include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/footer.php');
?>
</body>

</html>