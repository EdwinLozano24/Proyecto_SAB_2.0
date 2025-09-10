<?php
require_once __DIR__ . '/../config/database.php';
class ConsultorioModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = conectarBD();
    }


    public function store(array $data)

    {
            $sql = "INSERT INTO tbl_consultorios (
                    cons_numero,
                    cons_estado
                ) VALUES (
                    :cons_numero,
                    :cons_estado
                )";

            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($data);
    
    }

    public function find($id_consultorio)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_consultorios WHERE id_consultorio = :id_consultorio");
        $stmt->execute([':id_consultorio' => $id_consultorio]);
        return $stmt->fetch();
    }

    public function update(array $data)
    {
        if (!isset($data['id_consultorio'])) {
            throw new InvalidArgumentException("[El ID del consultorio es obligatorio para ACTUALIZAR]");
        }

        $sql = "UPDATE tbl_consultorios SET
            cons_numero = :cons_numero,
            cons_estado = :cons_estado
            WHERE id_consultorio = :id_consultorio";

            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($data);
    }


    public function delete($id_consultorio)
    {
        $stmt = $this->pdo->prepare("UPDATE tbl_consultorios SET cons_Estado = 'No Disponible' WHERE id_consultorio = :id_consultorio");
        return $stmt->execute([':id_consultorio' => $id_consultorio]);
    }

    public function findAll()
{
    $sql = "SELECT * FROM tbl_consultorios
            ORDER BY CASE cons_estado
                WHEN 'Disponible' THEN 1
                WHEN 'No Disponible' THEN 2
                ELSE 3 END,
            id_consultorio ASC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function findConsultorioLibre($fecha, $hora_inicio, $hora_fin)
    {
        $sql = "SELECT c.id_consultorio
                FROM tbl_consultorios c
                WHERE c.id_consultorio NOT IN (
                    SELECT cita_consultorio
                    FROM tbl_citas
                    WHERE cita_fecha = :fecha
                    AND (
                            (:hora_inicio BETWEEN cita_hora_inicio AND cita_hora_fin)
                            OR (:hora_fin BETWEEN cita_hora_inicio AND cita_hora_fin)
                            OR (cita_hora_inicio BETWEEN :hora_inicio AND :hora_fin)
                    )
                )
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':fecha' => $fecha,
            ':hora_inicio' => $hora_inicio,
            ':hora_fin' => $hora_fin,
        ]);

        return $stmt->fetchColumn(); // consultorio libre o false si no hay
    }
}