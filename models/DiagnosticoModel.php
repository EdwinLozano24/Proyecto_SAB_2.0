<?php
require_once __DIR__ . '/../config/database.php';
class DiagnosticoModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = conectarBD();
    }
    public function findAll()
    {
        $sql = "SELECT * FROM tbl_diagnosticos";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}