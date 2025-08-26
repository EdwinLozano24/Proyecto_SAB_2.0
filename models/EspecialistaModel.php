<?php
require_once __DIR__ . '/../config/database.php';
class EspecialistaModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = conectarBD();
    }
    public function findAll()
    {
        $sql = "SELECT * FROM tbl_especialistas
        INNER JOIN tbl_usuarios ON espe_usuario = id_usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findCita($id_usuario)
{
    $sql = "SELECT e.*, u.*
            FROM tbl_especialistas e
            INNER JOIN tbl_usuarios u ON e.espe_usuario = u.id_usuario
            WHERE u.id_usuario = :id_usuario
            LIMIT 1";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC); // Solo uno
}

}