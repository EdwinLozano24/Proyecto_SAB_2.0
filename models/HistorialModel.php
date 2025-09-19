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
        hist_creado_por,
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
        :hist_creado_por,
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
    $sql = "
        SELECT 
            h.*,
            up.usua_nombre      AS paciente_nombre,
            up.id_usuario       AS paciente_id_usuario,
            d.diag_nombre       AS diagnostico_nombre,
            e.id_especialista   AS especialista_id,
            ue.usua_nombre      AS especialista_nombre,
            ue.id_usuario       AS especialista_id_usuario
        FROM tbl_historial_clinico h
        LEFT JOIN tbl_pacientes p ON h.hist_paciente = p.id_paciente
        LEFT JOIN tbl_usuarios up ON p.paci_usuario = up.id_usuario
        LEFT JOIN tbl_diagnosticos d ON h.hist_diagnostico = d.id_diagnostico
        LEFT JOIN tbl_especialistas e ON h.hist_creado_por = e.id_especialista
        LEFT JOIN tbl_usuarios ue ON e.espe_usuario = ue.id_usuario
        WHERE h.id_historial = :id_historial
        LIMIT 1
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':id_historial' => $id_historial]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
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
        foreach ($data as $key => $value) {
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

    public function findByPaciente($id_paciente)
{
    $stmt = $this->pdo->prepare("SELECT * FROM tbl_historial_clinico WHERE hist_paciente = :id_paciente AND hist_estado = 'Activo' LIMIT 1");
    $stmt->execute([':id_paciente' => $id_paciente]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    public function findIdHistorial($id_paciente)
    {
        $stmt = $this->pdo->prepare("SELECT id_historial FROM tbl_historial_clinico WHERE hist_paciente = :id_paciente LIMIT 1");
        $stmt->execute([':id_paciente' => $id_paciente]);
        return $stmt->fetchColumn();
    }

    public function findForPaciente($id_paciente)
    {
        $stmt = $this->pdo->prepare("SELECT
        -- Campos del historial
        h.id_historial,
        h.hist_antecedentes_personales,
        h.hist_antecedentes_familiares,
        h.hist_medicamentos_actuales,
        h.hist_alergias,
        h.hist_fecha_registro,
        h.hist_fecha_actualizacion,
        h.hist_odontograma,
        h.hist_indice_dmft,
        h.hist_frecuencia_cepillado,
        h.hist_hilo_dental,
        h.hist_enjuague_bucal,
        h.hist_sensibilidad_dental,
        h.hist_estado,

        -- Nombres de las tablas relacionadas
        pu.usua_nombre   AS paciente_nombre,
        d.diag_nombre    AS diagnostico_nombre,
        eu.usua_nombre   AS creado_por_nombre,
        eau.usua_nombre  AS actualizado_por_nombre

    FROM tbl_historial_clinico h
    LEFT JOIN tbl_pacientes p ON h.hist_paciente = p.id_paciente
    LEFT JOIN tbl_usuarios pu ON p.paci_usuario = pu.id_usuario

    LEFT JOIN tbl_diagnosticos d ON h.hist_diagnostico = d.id_diagnostico

    LEFT JOIN tbl_especialistas ec ON h.hist_creado_por = ec.id_especialista
    LEFT JOIN tbl_usuarios eu ON ec.id_usuario = eu.id_usuario

    LEFT JOIN tbl_especialistas ea ON h.hist_actualizado_por = ea.id_especialista
    LEFT JOIN tbl_usuarios eau ON ea.id_usuario = eau.id_usuario

    WHERE h.hist_paciente = ? 
      AND h.hist_estado = 'Activo'
    LIMIT 1;");
        $stmt->execute([$id_paciente]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}