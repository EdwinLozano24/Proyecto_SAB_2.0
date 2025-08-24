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

}
