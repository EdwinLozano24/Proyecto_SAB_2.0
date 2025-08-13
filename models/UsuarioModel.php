<?php
require_once __DIR__ . '/../config/database.php';
date_default_timezone_set('America/Bogota');
class UsuarioModel
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = conectarBD();
    }
    public function store(array $data)
    {
        $sql = "INSERT INTO tbl_usuarios (
        usua_nombre,
        usua_documento,
        usua_tipo_documento,
        usua_correo_electronico,
        usua_direccion,
        usua_num_contacto,
        usua_num_secundario,
        usua_fecha_nacimiento,
        usua_sexo,
        usua_rh,
        usua_eps,
        usua_password,
        usua_tipo,
        usua_estado
        ) VALUES (
        :usua_nombre,
        :usua_documento,
        :usua_tipo_documento,
        :usua_correo_electronico,
        :usua_direccion,
        :usua_num_contacto,
        :usua_num_secundario,
        :usua_fecha_nacimiento,
        :usua_sexo,
        :usua_rh,
        :usua_eps,
        :usua_password,
        :usua_tipo,
        :usua_estado
        )";
        $stmt = $this->pdo->prepare($sql);
        $params = [];
        foreach ($data as $key => $value) {
            $params[":$key"] = $value;
        }
        return $stmt->execute($params);
    }
    public function find($id_usuario)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_usuarios WHERE id_usuario = :id_usuario");
        $stmt->execute([':id_usuario' => $id_usuario]);
        return $stmt->fetch();
    }
    public function update(array $data)
    {
        if (!isset($data['id_usuario'])) {
            throw new InvalidArgumentException("[El ID del USUARIO es obligatorio para ACTUALIZAR]");
        }
        $sql = "UPDATE tbl_usuarios SET
        usua_nombre = :usua_nombre,
        usua_documento = :usua_documento,
        usua_tipo_documento = :usua_tipo_documento,
        usua_correo_electronico = :usua_correo_electronico,
        usua_direccion = :usua_direccion,
        usua_num_contacto = :usua_num_contacto,
        usua_num_secundario = :usua_num_secundario,
        usua_fecha_nacimiento = :usua_fecha_nacimiento,
        usua_sexo = :usua_sexo,
        usua_rh = :usua_rh,
        usua_eps = :usua_eps,
        usua_password = :usua_password,
        usua_tipo = :usua_tipo,
        usua_estado = :usua_estado
    WHERE id_usuario = :id_usuario";
    $stmt = $this->pdo->prepare($sql);
        $params = [];
        foreach ($data as $key => $value) 
        {
            $params[":$key"] = $value;
        }
        return $stmt->execute($params);
    }
    public function delete($id_usuario)
    {
        $sql = "UPDATE tbl_usuarios SET usua_estado = 'Inactivo' WHERE id_usuario = :id_usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function findAll()
    {
        $sql = "SELECT * FROM tbl_usuarios";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //- - - - - - - - - - - - - - - - - - - - - - RESET PASSWORD - - - - - - - - - - - - - - - - - - - - - -//

    public function findCorreo(string $correo): ?array
    {
        $sql = "SELECT * FROM tbl_usuarios WHERE usua_correo_electronico = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$correo]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function saveToken(int $id_usuario, string $token, string $expira): bool
    {
        $sql  = "UPDATE tbl_usuarios SET usua_reset_token = ?, usua_token_expira = ? WHERE id_usuario = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$token, $expira, $id_usuario]);
    }

    public function findToken(string $token): ?array
    {
        $sql = "SELECT * FROM tbl_usuarios WHERE usua_reset_token = ? AND usua_token_expira > NOW()";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$token]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null; 
    }

    public function updatePassword(int $id_usuario, string $newPassword) : bool
{
    $sql = "UPDATE tbl_usuarios 
            SET usua_password = ?, 
                usua_reset_token = NULL, 
                usua_token_expira = NULL 
            WHERE id_usuario = ?";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([$newPassword, $id_usuario]);
}
}
