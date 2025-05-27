<?php

require_once '../config/database.php';

class Usuario
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function loginUsuario($usua_documento, $usua_password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_usuarios WHERE usua_documento = :usua_documento");
        $stmt->execute(['usua_documento' => $usua_documento]);
        $user = $stmt->fetch();
        if ($user && password_verify($usua_password, $user['usua_password'])) {
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
    public function obtenerTodos() {
        $stmt = $this->pdo->query("SELECT * FROM tbl_usuarios ORDER BY usua_estado DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerPorId($id_usuario) {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_usuarios WHERE id_usuario = ?");
        $stmt->execute([$id_usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($usua_nombre, $usua_tipo_documento, $usua_documento, $usua_correo_electronico, $usua_num_contacto, $usua_num_secundario, $usua_direccion, $usua_fecha_nacimiento, $usua_sexo, $usua_rh, $usua_eps, $usua_tipo, $usua_password) {
        $stmt = $this->pdo->prepare("INSERT INTO tbl_usuarios (usua_nombre, usua_tipo_documento, usua_documento, usua_correo_electronico, usua_num_contacto, usua_num_secundario, usua_direccion, usua_fecha_nacimiento, usua_sexo, usua_rh, usua_eps, usua_tipo, usua_password)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$usua_nombre, $usua_tipo_documento, $usua_documento, $usua_correo_electronico, $usua_num_contacto, $usua_num_secundario, $usua_direccion, $usua_fecha_nacimiento, $usua_sexo, $usua_rh, $usua_eps, $usua_tipo, $usua_password]);
    }
    public function actualizar($usua_nombre, $usua_tipo_documento, $usua_documento, $usua_correo_electronico, $usua_num_contacto, $usua_num_secundario, $usua_direccion, $usua_fecha_nacimiento, $usua_sexo, $usua_rh, $usua_eps, $usua_tipo, $usua_password, $usua_estado, $id_usuario) {
        $stmt = $this->pdo->prepare("UPDATE tbl_usuarios SET usua_nombre = ?, usua_tipo_documento = ?, usua_documento = ?, usua_correo_electronico = ?, usua_num_contacto = ?, usua_num_secundario = ?, usua_direccion = ?, usua_fecha_nacimiento = ?, usua_sexo = ?, usua_rh = ?, usua_eps = ?, usua_tipo = ?, usua_password = ?, usua_estado = ? WHERE id_usuario = ?");
        return $stmt->execute([$usua_nombre, $usua_tipo_documento, $usua_documento, $usua_correo_electronico, $usua_num_contacto, $usua_num_secundario, $usua_direccion, $usua_fecha_nacimiento, $usua_sexo, $usua_rh, $usua_eps, $usua_tipo, $usua_password, $usua_estado, $id_usuario]);
    }

    public function eliminar($id_usuario) {
        $stmt = $this->pdo->prepare("UPDATE tbl_usuarios SET usua_estado = 'Inactivo' WHERE id_usuario = ?");
        return $stmt->execute([$id_usuario]);
    }
}