<?php
require_once __DIR__ . '/../config/database.php';
class PacienteModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = conectarBD();
    }
    public function findAll()
    {
        $sql = "SELECT * FROM tbl_pacientes 
        INNER JOIN tbl_usuarios ON paci_usuario = id_usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findPaciente($id_usuario)
    {
        $sql = "SELECT * FROM tbl_pacientes WHERE paci_usuario = :id_usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findIdPaciente($id_usuario)
    {
        $sql = "SELECT id_paciente FROM tbl_pacientes WHERE paci_usuario = :id_usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function findUsuario($id_paciente)
    {
        $sql = "SELECT id_usuario FROM tbl_pacientes WHERE id_paciente = :id_paciente";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_paciente', $id_paciente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}