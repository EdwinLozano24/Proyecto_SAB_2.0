<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/auth.php';
requiereSesion();
$id_usuario = $_SESSION['usuario']['id_usuario'];
$nombreUsuario = $_SESSION['usuario']['usua_nombre'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Assets/css/layoutFinal/admin/layout1.css?v=20250901">
    <title>¡Bienvenido a SAB!</title>
</head>

<body>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/admin/header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/admin/nav/navInicio.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/admin/aside/asideInicio.php');

    ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-header">
            <h2 class="content-title">Bienvenido a SAB</h2>
            <p class="content-subtitle">Panel de administración</p>
        </div>

        <div class="content-grid">
            <div class="content-card">
                <h3 class="card-title">Gestionar usuarios</h3>
                <p class="card-description"></p>
                <a href="/controllers/UsuarioController.php?accion=index" class="btn btn-primary" style="margin-top: 16px;">Ir</a>
            </div>
            <div class="content-card">
                <h3 class="card-title">Gestionar citas</h3>
                <p class="card-description"></p>
                <a href="/controllers/CitaController.php?accion=index" class="btn btn-primary" style="margin-top: 16px;">Ir</a>
            </div>
        </div>

        <div class="content-grid">
            <div class="content-card">
                <h3 class="card-title">Usuario activos</h3>
                <p class="card-description">32 (ejemplo)</p>
                <a href="#" class="btn btn-primary" style="margin-top: 16px;">Ver más</a>
            </div>

            <div class="content-card">
                <h3 class="card-title">Resumen citas</h3>
                <p class="card-description">18 (ejemplo)</p>
                <a href="#" class="btn btn-primary" style="margin-top: 16px;">Ver más</a>
            </div>

        <div class="content-card">
            <h3 class="card-title">Solicitudes Historial Clínico</h3>
            <p class="card-description">3 (ejemplo)</p>
            <a href="#" class="btn btn-primary" style="margin-top: 16px;">Ver más</a>
        </div>

        <div class="content-grid">
            <div class="content-card">
                <h3 class="card-title">Solucione PQRS</h3>
                <p class="card-description"></p>
                <a href="/controllers/PqrsController.php?accion=index" class="btn btn-primary" style="margin-top: 16px;">Ir</a>
            </div>

            <div class="content-card">
                <h3 class="card-title">Consultorios</h3>
                <p class="card-description"></p>
                <a href="/controllers/ConsultorioController.php?accion=index" class="btn btn-primary" style="margin-top: 16px;">Ver más</a>
            </div>
        </div>


    </main>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/admin/footer.php');
    ?>
</body>

</html>