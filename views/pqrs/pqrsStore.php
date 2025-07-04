<?php
/*-----------------------------------------------------------------
| 1. Cargar listas de usuarios y empleados para los <select>
-----------------------------------------------------------------*/
require_once __DIR__ . '/../../config/database.php';
$pdo = conectarBD();

/*‑‑ Usuarios activos (si quieres filtrar por tipo, agrega WHERE) */
$usuarios = $pdo->query("SELECT id_usuario, usua_nombre FROM tbl_usuarios ORDER BY usua_nombre ASC")
                ->fetchAll(PDO::FETCH_ASSOC);

/*‑‑ Empleados activos (LEFT JOIN para sacar el nombre desde tbl_usuarios) */
$empleados = $pdo->query("
    SELECT  e.id_empleado,
            u.usua_nombre
    FROM    tbl_empleados e
    JOIN    tbl_usuarios  u ON e.empl_usuario = u.id_usuario
    ORDER BY u.usua_nombre ASC")
    ->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear PQR - Sistema Odontológico</title>

    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/proyecto_sab/assets/css/admin/crudUsuario.css';
    $cssUrl  = '/proyecto_sab/assets/css/admin/crudUsuario.css';
    echo file_exists($cssPath)
        ? "<link rel='stylesheet' href='$cssUrl'>"
        : "CSS File not found at: $cssPath";
    ?>
</head>

<body>
<div class="container">
    <div class="header">
        <div class="logo">📩</div>
        <h1>Crear Nueva PQR</h1>
        <p class="subtitle">Registra la petición, queja, reclamo o sugerencia de un paciente.</p>
    </div>

    <form id="crearPqrForm" method="POST"
          action="../../controllers/PqrsController.php?accion=store"
          class="form-card">

        <div class="form-grid">

            <div class="form-group">
                <label for="tipo_pqrs">Tipo de PQR <span class="required">*</span></label>
                <select name="pqrs_tipo" id="tipo_pqrs" required>
                    <option value="" disabled selected>Seleccione</option>
                    <option value="Petición">Petición</option>
                    <option value="Queja">Queja</option>
                    <option value="Reclamo">Reclamo</option>
                    <option value="Sugerencia">Sugerencia</option>
                </select>
            </div>

            <div class="form-group">
                <label for="asunto">Asunto <span class="required">*</span></label>
                <input type="text" name="pqrs_asunto" id="asunto"
                       placeholder="Asunto" maxlength="150" required>
            </div>

            <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" placeholder="Describe la petición o queja…" name="pqrs_descripcion" id="descripcion">
                </div>
            <div class="form-group">
                <label for="usuario">Usuario <span class="required">*</span></label>
                <select name="pqrs_usuario" id="usuario" required>
                    <option value="" disabled selected>Selecciona usuario</option>
                    <?php foreach ($usuarios as $u): ?>
                        <option value="<?= $u['id_usuario'] ?>"><?= htmlspecialchars($u['usua_nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="empleado">Empleado asignado</label>
                <select name="pqrs_empleado" id="empleado">
                    <option value="" selected>— Sin asignar —</option>
                    <?php foreach ($empleados as $e): ?>
                        <option value="<?= $e['id_empleado'] ?>"><?= htmlspecialchars($e['usua_nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="hidden" name="pqrs_estado" value="Pendiente">

        </div>
        <div class="button-group">
            <a href="/proyecto_sab/views/pqrs/pqrsIndex.php" class="btn-link">Volver</a>
            <button type="submit">Crear PQR</button>
        </div>
    </form>
</div>
</body>
</html>
