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
        return $stmt->execute($data);
    }

    public function find($id_pqrs)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_pqrs WHERE id_pqrs = :id_pqrs");
        $stmt->execute([':id_pqrs' => $id_pqrs]);
        return $stmt->fetch();
    }

    public function update(array $data)
    {
        if (!isset($data['id_pqrs'])) {
            throw new InvalidArgumentException("[El ID de la PQR es obligatorio para ACTUALIZAR]");
        }

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
    public function crearPqrUsuario($usuarioId, $tipo, $asunto, $descripcion)
    {
        $sql = "INSERT INTO tbl_pqrs (pqrs_tipo, pqrs_asunto, pqrs_descripcion, pqrs_usuario, pqrs_estado) 
            VALUES (:tipo, :asunto, :descripcion, :usuarioId, 'Pendiente')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':asunto', $asunto);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':usuarioId', $usuarioId);
        return $stmt->execute();
    }
}
