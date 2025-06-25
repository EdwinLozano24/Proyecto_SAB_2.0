<?php
require_once __DIR__ . '/../config/database.php';

class AuthModel
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = conectarBD();
    }

    public function getUser($usua_documento)
    {
        $sql = "SELECT * FROM tbl_usuarios WHERE usua_documento = :usua_documento";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':usua_documento',$usua_documento);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}