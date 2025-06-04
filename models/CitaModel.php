<?php
require_once __DIR__ . '/../config/database.php';
class CitaModel
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = conectarBD();
    }
    public function store(array $data)
    {
        $sql = "INSERT INTO tbl_citas (
        cita_usuario,
        cita_especialista,
        cita_fecha,
        cita_hora,
        cita_consultorio,
        cita_motivo,
        cita_observacion,
        cita_estado,
        cita_tratamiento
        ) VALUES (
        :cita_usuario,
        :cita_especialista,
        :cita_fecha,
        :cita_hora,
        :cita_consultorio,
        :cita_motivo,
        :cita_observacion,
        :cita_estado,
        :cita_tratamiento
        )";
        $stmt = $this->pdo->prepare($sql);
        $params = [];
        foreach ($data as $key => $value) {
            $params[":$key"] = $value;
        }
        return $stmt->execute($params);
    }
}