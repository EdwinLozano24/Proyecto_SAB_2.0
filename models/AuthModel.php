<?php
require_once __DIR__ . '/../config/database.php';

class AuthModel
{
    private $conn;
    public function __construct()
    {
        $this->conn = conectarBD_MySQLi();
    }

    public function getUser(string $usua_documento): ?array
    {
        $sql = "SELECT 
                    id_usuario, 
                    usua_documento, 
                    usua_tipo, 
                    usua_password 
                FROM tbl_usuarios 
                WHERE usua_documento = ?";
        
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return null;
        }

        $stmt->bind_param("s", $usua_documento);
        $stmt->execute();

        $result = $stmt->get_result();
        $user   = $result->fetch_assoc() ?: null;

        $stmt->close();
        return $user;
    }
}
