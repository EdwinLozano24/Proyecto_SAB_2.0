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
        $sql = "SELECT * FROM tbl_consultorios";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}