<?php
require_once __DIR__ . '/../config/database.php';
class EmpleadoModel
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = conectarBD();
    }
    public function store(array $data)
    {
        $sql = "INSERT INTO tbl_empleados (
        empl_usuario,
        empl_fecha_ingreso,
        empl_rol,
        empl_descripcion_especifica,
        empl_estado
        ) VALUES (
        :empl_usuario,
        :empl_fecha_ingreso,
        :empl_rol,
        :empl_descripcion_especifica,
        :empl_estado
        )";
        $stmt = $this->pdo->prepare($sql);
        $params = [];
        foreach ($data as $key => $value) {
            $params[":$key"] = $value;
        }
        return $stmt->execute($params);
    }
    public function find($id_empleado)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_empleados WHERE id_empleado = :id_empleado");
        $stmt->execute([':id_empleado' => $id_empleado]);
        return $stmt->fetch();
    }
    public function update(array $data)
    {
        if (!isset($data['id_empleado'])) {
            throw new InvalidArgumentException("[El ID del Empleado es obligatorio para ACTUALIZAR]");
        }
        $sql = "UPDATE tbl_empleados SET
        empl_usuario = :empl_usuario,
        empl_fecha_ingreso = :empl_fecha_ingreso,
        empl_rol = :empl_rol,
        empl_descripcion_especifica = :empl_descripcion_especifica,
        empl_estado = :empl_estado
    WHERE id_empleado = :id_empleado";
    $stmt = $this->pdo->prepare($sql);
        $params = [];
        foreach ($data as $key => $value) 
        {
            $params[":$key"] = $value;
        }
        return $stmt->execute($params);
    }
    public function delete($id_empleado)
    {
        $sql = "UPDATE tbl_empleados SET empl_estado = 'Inactivo' WHERE id_empleado = :id_empleado";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function findAll()
    {
        $sql = "SELECT * FROM tbl_empleados";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
