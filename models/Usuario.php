<?php

require_once '../config/database.php';

class Usuario
{
    private $pdo;
    
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function registrarUsuario($data)
    {
        $sql = "INSERT INTO tbl_pacientes (paci_num_documento, paci_nombre, paci_correo_electronico, paci_password, paci_num_contacto, paci_direccion, paci_fecha_nacimiento, paci_num_acudiente, paci_eps, paci_sexo, paci_rh, paci_tipo_documento)
                VALUES (:paci_num_documento, :paci_nombre, :paci_correo_electronico, :paci_password, :paci_num_contacto, :paci_direccion, :paci_fecha_nacimiento, :paci_num_acudiente, :paci_eps, :paci_sexo, :paci_rh, :paci_tipo_documento)";
        $stmt= $this->pdo->prepare($sql);
        $data['paci_password'] = password_hash($data['paci_password'], PASSWORD_DEFAULT);
        return $stmt->execute($data);
    }
}