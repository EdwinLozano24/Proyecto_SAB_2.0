<?php
require_once __DIR__ . '/../config/database.php';
class TratamientoModel
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = conectarBD();
    }
    public function store(array $data)
    {
        $sql = "INSERT INTO tbl_tratamientos (
        id_tratamiento,
        trat_codigo,
        trat_nombre,
        trat_categoria,
        trat_duracion_minutos,
        trat_riesgos,
        trat_duracion,
        trat_descripcion,
        trat_complejidad,
        trat_estado    
        ) VALUES (
        :id_tratamiento,
        :trat_codigo,
        :trat_nombre,
        :trat_categoria,
        :trat_duracion_minutos,
        :trat_riesgos,
        :trat_duracion,
        :trat_descripcion,
        :trat_complejidad,
        :trat_estado
        )";
        $stmt = $this->pdo->prepare($sql);
        $params = [];
        foreach ($data as $key => $value){
            $params[":$key"] = $value;
        }
        return $stmt->execute($params);
    }
    public function find($id_tratamiento)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_tratamientos WHERE id_tratamiento = :id_tratamiento");
        $stmt->execute(([':id_tratamiento' => $id_tratamiento]));
        return $stmt->fetch();
    }
    public function update(array $data)
    {
        if(!isset($data['id_tratamiento'])){
            throw new InvalidArgumentException("[EL ID DEL TRATAMIENTO ES OBLIGATORIO PARA ACTUALIZAR]");
        }
        $sql = "UPDATE tbl_tratamientos SET
        id_tratamiento = :id_tratamiento,
        trat_codigo = :trat_codigo,
        trat_nombre = :trat_nombre,
        trat_categoria = :trat_categoria,
        trat_duracion_minutos = :trat_duracion_minutos,
        trat_riesgos = :trat_riesgos,
        trat_duracion = :trat_duracion,
        trat_descripcion = :trat_descripcion,
        trat_complejidad = :trat_complejidad,
        trat_estado = trat_estado
    WHERE id_tratamiento = :id_tratamiento";
    $stmt = $this->pdo->prepare($sql);
        $params = [];
        foreach ($data as $key => $value)
        {
            $params[":key"] = $value;
        }
        return $stmt->execute(($params));    
    }
    public function delete($id_tratamiento)
    {
        $sql = "UPDATE tbl_tratamientos SET trat_estado = 'Inactivo'
        WHERE id_tratamiento = :id_tratamiento";
        $stmt = $this->pdo->prepare($sql);
        $stmt -> bindParam(':id_tratamiento', $id_tratamiento, PDO::PARAM_INT);
        $stmt->execute();
    }
}