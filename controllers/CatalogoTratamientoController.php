<?php

require_once 'C:/xampp/htdocs/Proyecto_SAB_2.0/models/CatalogoTratamientos.php';
require_once '../config/database.php';

$catalogo = new CatalogoTratamiento($pdo);

if (isset($_POST['registrar'])){
    $data = [
        'cat_nombre' => $_POST['cat_nombre'],
        'cat_costos' => $_POST['cat_costos'],
        'cat_recomendaciones' => $_POST['cat_recomendaciones'],
        'cat_estado' => $_POST['cat_estado'],
        'cat_procedimiento' => $_POST['cat_procedimiento'],
        'cat_duracion' => $_POST['cat_duracion'],
        'cat_categoria' => $_POST['cat_categoria'],
        'cat_descripcion' => $_POST['cat_descripcion'],
    ];
    $catalogo->createTratamiento($data);
    header('Location: ../views/catalogo/createTratamiento.php');
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'GET' && !isset ($_GET['cat_id'])){
    $tratamientos = $catalogo ->indexTratamiento();
    include '../views/catalogo/indexTratamiento.php';
    exit;
}


if (isset($_GET['cat_id'])) {
    $tratamiento = $catalogo->readTratamiento($_GET['cat_id']); 
    include '../views/catalogo/readTratamiento.php'; 
    exit;
}

?>