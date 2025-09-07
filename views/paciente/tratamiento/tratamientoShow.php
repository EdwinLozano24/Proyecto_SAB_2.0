<?php
header('Content-Type: application/json');
require_once($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');

$pdo = conectarBD();
$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("SELECT t.id_tratamiento, t.trat_nombre, t.trat_descripcion, t.trat_duracion, 
                        t.trat_riesgos, t.trat_complejidad, t.trat_estado,
                        c.cate_nombre AS trat_categoria
                        FROM tbl_tratamientos t
                        INNER JOIN tbl_categorias_tratamientos c ON t.trat_categoria = c.id_categoria
                        WHERE t.id_tratamiento = ?");
    $stmt->execute([$id]);
    $tratamiento = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($tratamiento) {
        echo json_encode($tratamiento);
    } else {
        echo json_encode(["error" => "Tratamiento no encontrado"]);
    }
} else {
    echo json_encode(["error" => "ID no recibido"]);
}
