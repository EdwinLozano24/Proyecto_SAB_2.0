<?php
require_once __DIR__ . '/../config/database.php';
class HistorialModel
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = conectarBD();
    }
    public function store(array $data)
    {
        $sql = "INSERT INTO tbl_historial_clinico (
        hist_paciente,
        hist_antecedentes_personales,
        hist_antecedentes_familiares,
        hist_medicamentos_actuales,
        hist_alergias,
        hist_diagnostico,
        hist_fecha_registro,
        hist_creado_por,
        hist_actualizado_por,
        hist_odontograma,
        hist_indice_dmft,
        hist_frecuencia_cepillado,
        hist_hilo_dental,
        hist_enjuague_bucal,
        hist_sensibilidad_dental,
        hist_estado
        ) VALUES (
        :hist_paciente,
        :hist_antecedentes_personales,
        :hist_antecedentes_familiares,
        :hist_medicamentos_actuales,
        :hist_alergias,
        :hist_diagnostico,
        :hist_fecha_registro,
        :hist_creado_por,
        :hist_actualizado_por,
        :hist_odontograma,
        :hist_indice_dmft,
        :hist_frecuencia_cepillado,
        :hist_hilo_dental,
        :hist_enjuague_bucal,
        :hist_sensibilidad_dental,
        :hist_estado
        )";
        $stmt = $this->pdo->prepare($sql);
        $params = [];
        foreach ($data as $key => $value) {
            $params[":$key"] = $value;
        }
        return $stmt->execute($params);
    }
    public function find($id_historial)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_historial_clinico WHERE id_historial = :id_historial");
        $stmt->execute([':id_historial' => $id_historial]);
        return $stmt->fetch();
    }
    public function update(array $data)
    {
        if (!isset($data['id_historial'])) {
            throw new InvalidArgumentException("El ID de el HISTORIAL CLINICO es obligatorio para actualizar.");
        }
        $sql = "UPDATE tbl_historial_clinico SET
        hist_paciente = :hist_paciente,
        hist_antecedentes_personales = :hist_antecedentes_personales,
        hist_antecedentes_familiares = :hist_antecedentes_familiares,
        hist_medicamentos_actuales = :hist_medicamentos_actuales,
        hist_alergias = :hist_alergias,
        hist_diagnostico = :hist_diagnostico,
        hist_fecha_actualizacion = :hist_fecha_actualizacion,
        hist_actualizado_por = :hist_actualizado_por,
        hist_odontograma = :hist_odontograma,
        hist_indice_dmft = :hist_indice_dmft,
        hist_frecuencia_cepillado = :hist_frecuencia_cepillado,
        hist_hilo_dental = :hist_hilo_dental,
        hist_enjuague_bucal = :hist_enjuague_bucal,
        hist_sensibilidad_dental = :hist_sensibilidad_dental,
        hist_estado = :hist_estado
        WHERE id_historial = :id_historial";
    $stmt = $this->pdo->prepare($sql);
        $params = [];
        foreach ($data as $key => $value) 
        {
            $params[":$key"] = $value;
        }
        return $stmt->execute($params);
    }
    public function delete($id_historial)
    {
        $sql = "UPDATE tbl_historial_clinico SET hist_estado = 'Inactivo' WHERE id_historial = :id_historial";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_historial', $id_historial, PDO::PARAM_INT);
        $stmt->execute();
    }
}