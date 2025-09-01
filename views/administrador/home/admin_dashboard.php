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
    <link rel="stylesheet" href="../../../Assets/css/layoutFinal/admin/layout1.css">
    <title>¡Bienvenido a SAB!</title>
</head>

<body>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/admin/header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/admin/nav.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/admin/aside.php');

    ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-header">
            <h2 class="content-title">Panel Administrativo
          
            </h2>


        </div>

        <div class="content-grid">



            <div class="content-card">
                <h2><a href="#">HISTORIAS CLINICAS</a></h2>

            </div>
            <div class="content-card">
                <h2><a href="#">TRATAMIENTOS</a></h2>

            </div>
            <div class="content-card">
                <h2><a href="#">PQR'S</a></h2>

            </div>
            <div class="content-card">
                <h2><a href="#">USUARIOS</a></h2>

            </div>
            <div class="content-card ">
                <h2><a href="#">CITAS</a></h2>

            </div>
        </div>

        <div class="content-grid">





        </div>

    </main>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/admin/footer.php');
    ?>
</body>

</html>