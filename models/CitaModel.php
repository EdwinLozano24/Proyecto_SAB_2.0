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
    public function find($id_cita)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_citas WHERE id_cita = :id_cita");
        $stmt->execute([':id_cita' => $id_cita]);
        return $stmt->fetch();
    }
    public function update(array $data)
    {
        if (!isset($data['id_cita'])) {
            throw new InvalidArgumentException("El ID de la cita es obligatorio para actualizar.");
        }

        $sql = "UPDATE tbl_citas SET
        cita_usuario = :cita_usuario,
        cita_especialista = :cita_especialista,
        cita_fecha = :cita_fecha,
        cita_hora = :cita_hora,
        cita_consultorio = :cita_consultorio,
        cita_motivo = :cita_motivo,
        cita_observacion = :cita_observacion,
        cita_estado = :cita_estado,
        cita_tratamiento = :cita_tratamiento
    WHERE id_cita = :id_cita";

        $stmt = $this->pdo->prepare($sql);

        $params = [];
        foreach ($data as $key => $value) {
            $params[":$key"] = $value;
        }

        return $stmt->execute($params);
    }
}