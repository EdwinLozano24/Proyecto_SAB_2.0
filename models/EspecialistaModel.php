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

    public function findEspecialista($id_usuario)
    {
        $sql = "SELECT id_especialista 
                FROM tbl_especialistas
                WHERE espe_usuario = :id_usuario
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // false si no encuentra nada
    }

    public function find($id_especialista)
    {
        $sql = "SELECT u.usua_nombre 
                FROM tbl_especialistas e
                INNER JOIN tbl_usuarios u ON e.espe_usuario = u.id_usuario
                WHERE e.id_especialista = :id_especialista";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id_especialista' => $id_especialista]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}