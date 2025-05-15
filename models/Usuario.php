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

    public function createUsuario($data)
    {
        $sql = "INSERT INTO tbl_usuarios (usua_nombre, usua_documento, usua_tipo_documento, usua_correo_electronico, usua_direccion, usua_num_contacto, usua_num_secundario, usua_fecha_nacimiento, usua_sexo, usua_rh, usua_eps, usua_password)
                VALUES (:usua_nombre, :usua_documento, :usua_tipo_documento, :usua_correo_electronico, :usua_direccion, :usua_num_contacto, :usua_num_secundario, :usua_fecha_nacimiento, :usua_sexo, :usua_rh, :usua_eps, :usua_password)";
        $stmt = $this->pdo->prepare($sql);
        $data['usua_password'] = password_hash($data['usua_password'], PASSWORD_DEFAULT);
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