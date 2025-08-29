<?php
require_once __DIR__ . '/../config/database.php';

class PqrsModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = conectarBD();
    }

  public function store(array $data)
{
    $sql = "INSERT INTO tbl_pqrs (
                pqrs_tipo,
                pqrs_asunto,
                pqrs_descripcion,
                pqrs_estado,
                pqrs_fecha_envio,
                pqrs_respuesta,
                pqrs_fecha_respuesta,
                pqrs_usuario,
                pqrs_empleado
            ) VALUES (
                :pqrs_tipo,
                :pqrs_asunto,
                :pqrs_descripcion,
                :pqrs_estado,
                :pqrs_fecha_envio,
                :pqrs_respuesta,
                :pqrs_fecha_respuesta,
                :pqrs_usuario,
                :pqrs_empleado
            )";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':pqrs_tipo'           => $data['pqrs_tipo'],
        ':pqrs_asunto'         => $data['pqrs_asunto'],
        ':pqrs_descripcion'    => $data['pqrs_descripcion'],
        ':pqrs_estado'         => $data['pqrs_estado'],
        ':pqrs_fecha_envio'    => $data['pqrs_fecha_envio'],
        ':pqrs_respuesta'      => $data['pqrs_respuesta'],
        ':pqrs_fecha_respuesta'=> $data['pqrs_fecha_respuesta'],
        ':pqrs_usuario'        => $data['pqrs_usuario'],
        ':pqrs_empleado'       => $data['pqrs_empleado'],
    ]);
}

    public function find($id_pqrs)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_pqrs WHERE id_pqrs = :id_pqrs");
        $stmt->execute([':id_pqrs' => $id_pqrs]);
        return $stmt->fetch();
    }

    public function update(array $data)
    {

        $sql = "UPDATE tbl_pqrs SET
            pqrs_tipo = :pqrs_tipo,
            pqrs_asunto = :pqrs_asunto,
            pqrs_descripcion = :pqrs_descripcion,
            pqrs_estado = :pqrs_estado,
            pqrs_respuesta = :pqrs_respuesta,
            pqrs_fecha_respuesta = :pqrs_fecha_respuesta,
            pqrs_usuario = :pqrs_usuario,
            pqrs_empleado = :pqrs_empleado
        WHERE id_pqrs = :id_pqrs";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id_pqrs)
    {
        $stmt = $this->pdo->prepare("UPDATE tbl_pqrs SET pqrs_estado = 'Cerrado' WHERE id_pqrs = :id_pqrs");
        return $stmt->execute([':id_pqrs' => $id_pqrs]);
    }

    public function findPendientes()
    {
        $sql = "SELECT p.*, u.usua_nombre
FROM tbl_pqrs p
INNER JOIN tbl_usuarios u ON p.pqrs_usuario = u.id_usuario
WHERE p.pqrs_estado = 'Pendiente';
";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function findResponder($id_pqrs)
    {
      $stmt = $this->pdo->prepare("SELECT 
    p.*,
    u.usua_nombre AS usuario_nombre,
    ue.usua_nombre AS empleado_nombre
FROM tbl_pqrs p
LEFT JOIN tbl_usuarios u 
    ON p.pqrs_usuario = u.id_usuario
LEFT JOIN tbl_empleados e 
    ON p.pqrs_empleado = e.id_empleado
LEFT JOIN tbl_usuarios ue 
    ON e.empl_usuario = ue.id_usuario
WHERE p.id_pqrs = :id_pqrs");
        $stmt->execute([':id_pqrs' => $id_pqrs]);
        return $stmt->fetch();  
    }

    public function findEmpleado($id_usuario)
    {
    $stmt = $this->pdo->prepare("SELECT id_empleado FROM tbl_empleados WHERE empl_usuario = :id_usuario");
    $stmt->execute([':id_usuario' => $id_usuario]);
    return $stmt->fetchColumn();
    }

    public function findUsuario($id_usuario)
    {
        $stmt = $this->pdo->prepare("SELECT 
    p.*,
    u.usua_nombre AS usuario_nombre,
    ue.usua_nombre AS empleado_nombre
FROM tbl_pqrs p
LEFT JOIN tbl_usuarios u 
    ON p.pqrs_usuario = u.id_usuario
LEFT JOIN tbl_empleados e 
    ON p.pqrs_empleado = e.id_empleado
LEFT JOIN tbl_usuarios ue 
    ON e.empl_usuario = ue.id_usuario
    WHERE pqrs_usuario = :id_usuario");
        $stmt->execute([':id_usuario' => $id_usuario]);
        return $stmt->fetchAll();
    }
}
