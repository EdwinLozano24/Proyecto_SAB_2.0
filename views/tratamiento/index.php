<?php
require_once __DIR__ . '/../../config/database.php';
$sql = " SELECT * FROM tbl_tratamientos
    ORDER BY
        CASE trat_estado
            WHEN 'activo' THEN 1
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
    <title>Crud Tratamientos</title>
    <!-- Fony Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <h2>Tratamientos Registrados</h2>
    <a href="/proyecto_sab/controllers/TratamientoController.php?accion=crear">Añadir Tratamiento <i class="fa-solid fa-square-plus"></i></a>
    <table id="#example" class="display">
    <thead>
        <th>Nombre</th>
        <th>Duracion</th>
        <th>Descripcion</th>
        <th></th>
        <th></th>
        <th>Estado</th>
    </thead>



    </table>
</body>
</html>