<?php
require_once __DIR__ . '/../../config/database.php';
$pdo = conectarBD();
$sql = " SELECT * FROM tbl_empleados
    ORDER BY
        CASE empl_estado
            WHEN 'Activo' THEN 1
            ELSE 2
        END";
$stmt = $pdo->query($sql);
$usuarios = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="/../../assets/css/admin/usuario.css"> -->
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/proyecto_sab/assets/css/admin/usuario.css';
    $cssUrl = '/proyecto_sab/assets/css/admin/usuario.css';
    if (file_exists($cssPath)) {
        echo '<link rel="stylesheet" href="' . $cssUrl . '">';
    } else {
        echo ' CSS File not fount at: ' . $cssPath . '';
    }
    ?>
    <title>Crud Usuarios</title>
    <!-- Css -->
    <link href="https://cdn.datatables.net/2.3.1/css/dataTables.bootstrap5.min.css" rel="stylesheet" integrity="sha384-5hBbs6yhVjtqKk08rsxdk9xO80wJES15HnXHglWBQoj3cus3WT+qDJRpvs5rRP2c" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/buttons/3.2.3/css/buttons.bootstrap5.min.css" rel="stylesheet" integrity="sha384-DJhypeLg79qWALC844KORuTtaJcH45J+36wNgzj4d1Kv1vt2PtRuV2eVmdkVmf/U" crossorigin="anonymous">
    <!-- Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <!-- Fony Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
     <h2>Empleados Registrados</h2>

    <a href="/proyecto_sab/controllers/EmpleadoController.php?accion=view_store">Nuevo Empleado<i class="fa-solid fa-square-plus"></i></a>
    <table id="example" class="display">
        <thead>
            <tr>
                <th>Nombre del empleado</th>
                <th>Fecha Ingreso</th>
                <th>Empleado rol</th>
                <th>Descripcion Especifica</th>
                <th>Estado empleado</th>
                <th>Acciones</th>
            </tr>
        </thead>
</body>

