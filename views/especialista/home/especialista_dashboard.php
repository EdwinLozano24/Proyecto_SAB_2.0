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
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/especialista/header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/especialista/nav/navInicio.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/especialista/aside/asideInicio.php');
    ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-header">
            <h2 class="content-title">Bienvenido a SAB</h2>
            <p class="content-subtitle">Nos alegra que seas parte del equipo interno de SAB, utiliza las diferentes secciones para garantizar una excelente experiencia a los usuarios.</p>
        </div>
        <div class="content-grid">
            <div class="content-card">
                <h3 class="card-title">Agenda una Cita</h3>
                <p class="card-description">Reserva una cita para el usuario que la solicite. ¡La salud oral es nuestra prioridad!.</p>
                <a href="/controllers/CitaController.php?accion=viewAgendar&rol=Paciente" class="btn btn-primary" style="margin-top: 16px;">Ir ya</a>
            </div>

            <div class="content-card">
                <h3 class="card-title">Atender Citas</h3>
                <p class="card-description">Atiende las citas pendientes relacionadas a tu usuario. ¡La calidad de servicio es nuestra prioridad!</p>
                <a href="/controllers/CitaController.php?accion=especialistaCitaView&id_usuario=<?php echo $_SESSION['usuario']['id_usuario']; ?>" class="btn btn-primary" style="margin-top: 16px;">Ir ya</a>
            </div>

            <div class="content-card">
                <h3 class="card-title">Responder Pqrs</h3>
                <p class="card-description">En SAB estamos comprometidos con mejorar cada día.
        Si eres encargado de la gestion de Pqrs ingresa para ver las Pqrs pendientes de los usuarios.</p>
                <a href="/controllers/PqrsController.php?accion=visualizarPqrs&id_usuario=<?php echo $_SESSION['usuario']['id_usuario']; ?>" class="btn btn-primary" style="margin-top: 16px;">Ir ya</a>
            </div>
        </div>
    </main>
<?php 
include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/especialista/footer.php');
?>
</body>

</html>