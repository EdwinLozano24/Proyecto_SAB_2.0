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
        $sql = "SELECT * 
                FROM tbl_especialistas
                WHERE espe_usuario = :id_usuario
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // false si no encuentra nada
    }

}