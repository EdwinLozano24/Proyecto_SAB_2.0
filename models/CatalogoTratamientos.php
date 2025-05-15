<?php

require_once '../config/database.php';

class CatalogoTratamiento{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function indexTratamiento(){
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_catalogo_trat");
        $stmt->execute();
        return $stmt ->fetchAll(PDO::FETCH_ASSOC);
    }
    public function createTratamiento($data){
        $sql = "INSERT INTO tbl_catalogo_trat (cat_nombre, cat_costos, cat_recomendaciones, cat_estado, cat_procedimiento, cat_duracion, cat_categoria, cat_descripcion) 
                VALUES (:nombre, :costos, :recomendaciones, :estado, :procedimiento, :duracion, :categoria, :descripcion)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }
public function readTratamiento($cat_id) {
    $stmt = $this->pdo->prepare("SELECT * FROM tbl_catalogo_trat WHERE cat_id = :cat_id");
    $stmt->execute(['cat_id' => $cat_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


}
?>