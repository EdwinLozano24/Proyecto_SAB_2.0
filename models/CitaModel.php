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
        cita_historial,
        cita_especialista,
        cita_fecha,
        cita_hora_inicio,
        cita_hora_fin,
        cita_turno,
        cita_duracion,
        cita_consultorio,
        cita_motivo,
        cita_observacion,
        cita_estado
    ) VALUES (
        :cita_paciente,
        :cita_historial,
        :cita_especialista,
        :cita_fecha,
        :cita_hora_inicio,
        :cita_hora_fin,
        :cita_turno,
        :cita_duracion,
        :cita_consultorio,
        :cita_motivo,
        :cita_observacion,
        :cita_estado
    )";

    $stmt = $this->pdo->prepare($sql);

    // ✅ Lista corregida de parámetros esperados
    $paramsEsperados = [
        ':cita_paciente',
        ':cita_historial',
        ':cita_especialista',
        ':cita_fecha',
        ':cita_hora_inicio',
        ':cita_hora_fin',
        ':cita_turno',
        ':cita_duracion',
        ':cita_consultorio',
        ':cita_motivo',
        ':cita_observacion',
        ':cita_estado'
    ];

    $params = [];
    foreach ($paramsEsperados as $param) {
        $key = ltrim($param, ':');
        $params[$param] = $data[$key] ?? null;
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
        cita_hora_inicio = :cita_hora_inicio,
        cita_hora_fin = :cita_hora_fin,
        cita_turno = :cita_turno,
        cita_duracion = :cita_duracion,
        cita_consultorio = :cita_consultorio,
        cita_motivo = :cita_motivo,
        cita_observacion = :cita_observacion,
        cita_estado = :cita_estado
        WHERE id_cita = :id_cita";
        $stmt = $this->pdo->prepare($sql);
        $params = [];
        foreach ($data as $key => $value) {
            $params[":$key"] = $value;
        }
        return $stmt->execute($params);
    }
    public function delete($id_cita)
    {
        $sql = "UPDATE tbl_citas SET cita_estado = 'Cancelada' WHERE id_cita = :id_cita";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_cita', $id_cita, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Verifica si un especialista está disponible en la fecha y hora dadas
    public function verificarDisponibilidad($id_especialista, $fecha, $hora_inicio, $hora_fin)
    {
        $sql = "SELECT COUNT(*) FROM tbl_citas
            WHERE cita_especialista = :id_especialista
            AND cita_fecha = :fecha
            AND (
                (cita_hora_inicio <= :hora_inicio AND cita_hora_fin > :hora_inicio)
                OR (cita_hora_inicio < :hora_fin AND cita_hora_fin >= :hora_fin)
                OR (cita_hora_inicio >= :hora_inicio AND cita_hora_fin <= :hora_fin)
            )
            AND cita_estado != 'Cancelada'";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id_especialista' => $id_especialista,
            ':fecha' => $fecha,
            ':hora_inicio' => $hora_inicio,
            ':hora_fin' => $hora_fin
        ]);

        $count = $stmt->fetchColumn();
        return $count == 0; // true si está disponible
    }

    // Verifica si un consultorio está disponible en la fecha y hora dadas
    public function verificarConsultorio($id_consultorio, $fecha, $hora_inicio, $hora_fin)
    {
        $sql = "SELECT COUNT(*) FROM tbl_citas
            WHERE cita_consultorio = :id_consultorio
            AND cita_fecha = :fecha
            AND (
                (cita_hora_inicio <= :hora_inicio AND cita_hora_fin > :hora_inicio)
                OR (cita_hora_inicio < :hora_fin AND cita_hora_fin >= :hora_fin)
                OR (cita_hora_inicio >= :hora_inicio AND cita_hora_fin <= :hora_fin)
            )
            AND cita_estado != 'Cancelada'";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id_consultorio' => $id_consultorio,
            ':fecha' => $fecha,
            ':hora_inicio' => $hora_inicio,
            ':hora_fin' => $hora_fin
        ]);

        $count = $stmt->fetchColumn();
        return $count == 0;
    }

public function findCita($id_especialista)
{
    $sql = "SELECT 
                c.id_cita,
                c.cita_fecha,
                c.cita_hora_inicio,
                c.cita_hora_fin,
                c.cita_turno,
                c.cita_duracion,
                c.cita_motivo,
                c.cita_observacion,
                c.cita_estado,

                p.id_paciente,
                u_p.usua_nombre AS paciente_nombre,

                h.id_historial,

                e.id_especialista,
                u_e.usua_nombre AS especialista_nombre,

                cons.id_consultorio,
                cons.cons_numero

            FROM tbl_citas c
            INNER JOIN tbl_pacientes p ON c.cita_paciente = p.id_paciente
            INNER JOIN tbl_usuarios u_p ON p.paci_usuario = u_p.id_usuario
            INNER JOIN tbl_historial_clinico h ON c.cita_historial = h.id_historial
            INNER JOIN tbl_especialistas e ON c.cita_especialista = e.id_especialista
            INNER JOIN tbl_usuarios u_e ON e.espe_usuario = u_e.id_usuario
            INNER JOIN tbl_consultorios cons ON c.cita_consultorio = cons.id_consultorio
            WHERE c.cita_especialista = :id_especialista";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id_especialista', $id_especialista, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
