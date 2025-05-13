<?php

require_once '../config/database.php';

class Usuario
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function loginPaciente($paci_num_documento, $paci_password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_pacientes WHERE paci_num_documento = :paci_num_documento");
        $stmt->execute(['paci_num_documento' => $paci_num_documento]);
        $user = $stmt->fetch();
        if ($user && isset($user['paci_password']) && password_verify($paci_password, $user['paci_password'])) {
            return $user;
        }
        return false;
    }

    public function createPaciente($data)
    {
        $sql = "INSERT INTO tbl_pacientes (paci_num_documento, paci_nombre, paci_correo_electronico, paci_password, paci_num_contacto, paci_direccion, paci_fecha_nacimiento, paci_num_acudiente, paci_eps, paci_sexo, paci_rh, paci_tipo_documento)
                VALUES (:paci_num_documento, :paci_nombre, :paci_correo_electronico, :paci_password, :paci_num_contacto, :paci_direccion, :paci_fecha_nacimiento, :paci_num_acudiente, :paci_eps, :paci_sexo, :paci_rh, :paci_tipo_documento)";
        $stmt = $this->pdo->prepare($sql);
        $data['paci_password'] = password_hash($data['paci_password'], PASSWORD_DEFAULT);
        return $stmt->execute($data);
    }


    public function indexPaciente()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_pacientes");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function readPaciente($paci_num_documento)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_pacientes WHERE paci_num_documento = :paci_num_documento");
        $stmt->execute(['paci_num_documento' => $paci_num_documento]);
        return $stmt->fetch();
    }

}