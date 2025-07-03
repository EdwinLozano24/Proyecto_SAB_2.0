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
    }
}