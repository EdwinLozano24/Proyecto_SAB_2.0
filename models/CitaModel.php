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
        cita_paciente,
        cita_especialista,
        cita_fecha,
        cita_hora,
        cita_turno,
        cita_duracion,
        cita_consultorio,
        cita_motivo,
        cita_observacion,
        cita_estado
        ) VALUES (
        :cita_usuario,
        :cita_especialista,
        :cita_fecha,
        :cita_hora,
        :cita_turno,
        :cita_duracion,
        :cita_consultorio,
        :cita_motivo,
        :cita_observacion,
        :cita_estado
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
        cita_paciente = :cita_paciente,
        cita_especialista = :cita_especialista,
        cita_fecha = :cita_fecha,
        cita_hora = :cita_hora,
        cita_turno = :cita_turno,
        cita_duracion = :cita_duracion,
        cita_consultorio = :cita_consultorio,
        cita_motivo = :cita_motivo,
        cita_observacion = :cita_observacion,
        cita_estado = :cita_estado
    WHERE id_cita = :id_cita";
    $stmt = $this->pdo->prepare($sql);
        $params = [];
        foreach ($data as $key => $value) 
        {
            $params[":$key"] = $value;
        }
        return $stmt->execute($params);
    }
    public function delete($id_cita)
    {
        $sql = "UPDATE tbl_citas SET cita_estado = 'Cancelada' WHERE id_cita = :id_cita";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
    }
}