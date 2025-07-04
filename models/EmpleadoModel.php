<?php
require_once __DIR__ . '/../config/database.php';
class EmpleadoModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = conectarBD();
    }
    public function findAll()
    {
        $sql = "SELECT * FROM tbl_empleados
        INNER JOIN tbl_usuarios ON empl_usuario = id_usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}