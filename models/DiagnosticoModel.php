<?php
require_once __DIR__ . '/../config/database.php';
class DiagnosticoModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = conectarBD();
    }

    public function store(array $data)
    {
        $sql = "INSERT INTO tbl_diagnosticos(
        diag_nombre,
        diag_descripcion,
        diag_tratamiento,
        diag_estado   
        ) VALUES (
        :diag_nombre,
        :diag_descripcion,
        :diag_tratamiento,
        :diag_estado  
        )";
        $stmt = $this->pdo->prepare($sql);
        $params = [];
        foreach ($data as $key => $value){
            $params[":$key"] = $value;
        }
        return $stmt->execute($params);
    }

    public function find($id_diagnostico)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_diagnosticos WHERE id_diagnostico = :id_diagnostico");
        $stmt->execute(([':id_diagnostico' => $id_diagnostico]));
        return $stmt->fetch();
    }

public function update(array $data)
{
    if (!isset($data['id_diagnostico'])) {
        throw new InvalidArgumentException("[EL ID DEL DIAGNOSTICO ES OBLIGATORIO PARA ACTUALIZAR]");
    }

    $sql = "UPDATE tbl_diagnosticos SET
        diag_nombre = :diag_nombre,
        diag_descripcion = :diag_descripcion,
        diag_tratamiento = :diag_tratamiento,
        diag_estado = :diag_estado
    WHERE id_diagnostico = :id_diagnostico";

    $stmt = $this->pdo->prepare($sql);

    $params = [];
    foreach ($data as $key => $value) 
    {
    }
}
}