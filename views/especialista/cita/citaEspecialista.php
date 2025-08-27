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
    <title>Atender Citas</title>
</head>
<body>
    <?php 
        include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/especialista/header.php');
        include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/especialista/nav.php');
        include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/especialista/asideCita.php');
    ?>
    <main class="main-content">
        
    </main>
    <?php
        include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/especialista/footer.php');
    ?>
</body>
</html>