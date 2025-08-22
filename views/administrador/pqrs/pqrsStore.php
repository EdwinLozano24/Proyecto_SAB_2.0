<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/auth.php';
requiereSesion();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
$pdo = conectarBD();
$sql = "SELECT * FROM tbl_usuarios";
$stmt = $pdo->query($sql);
$usua = $stmt->fetchAll();

$sql = "SELECT * FROM tbl_empleados
    INNER JOIN tbl_usuarios ON empl_usuario = id_usuario";
$stmt = $pdo->query($sql);
$empl = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Pqrs - Sistema Odontológico</title>
    <!-- CSS de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/assets/css/admin/crudPage.css';
    $cssUrl = '/proyecto_sab/assets/css/admin/crudPage.css';
    if (file_exists($cssPath)) {
        echo '<link rel="stylesheet" href="' . $cssUrl . '">';
    } else {
        echo ' CSS File not fount at: ' . $cssPath . '';
    }
    ?>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">🦷</div>
            <h2>Generar PQRS</h2>
            <p class="subtitle">Sistema de Gestión Odontológica SAB</p>
        </div>

        <form id="PqrsStore" method="POST" action="/controllers/PqrsController.php?accion=store">
            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">📝</div>
                    Información del Pqrs
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="pqrs_usuario">Usuario Responsable<span class="required">*</span></label>
                        <select name="pqrs_usuario" id="pqrs_usuario" class="form-control select2" required>
                            <option value="" selected disabled>Seleccionar un usuario...</option>
                                <?php foreach ($usua as $usu): ?>
                                    <option value="<?= $usu['id_usuario'] ?>">
                                        <?= $usu['usua_nombre'] ?>
                                    </option>
                                <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pqrs_tipo">Tipo de Pqrs<span class="required">*</span></label>
                        <select name="pqrs_tipo" id="pqrs_tipo" required>
                            <option value="" disabled selected>Seleccionar tipo...</option>
                            <option value="Petición">Petición</option>
                            <option value="Queja">Queja</option>
                            <option value="Reclamo">Reclamo</option>
                            <option value="Sugerencia">Sugerencia</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label for="pqrs_asunto">Asunto<span class="required">*</span></label>
                        <input type="text" name="pqrs_asunto" id="pqrs_asunto" required>
                    </div>

                    <div class="form-group full-width">
                        <label for="pqrs_descripcion">Descripcion<span class="required">*</span></label>
                        <textarea name="pqrs_descripcion" id="pqrs_descripcion" maxlength="255"
                            placeholder="Escriba su Pqrs..."></textarea>
                    </div>
                </div>
            </div>

            <div class="button-group">
                    <button type="button" class="btn-secondary" onclick="window.history.back()">
                    ← Cancelar
                </button>
                <input type="submit" id="generar_cita" value="⚠️ Registrar Pqrs">
            </div>
        </form>
    </div>

    <!-- JS de jQuery y Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="script.js"></script> -->
    <script>
        $(document).ready(function () {
            $('#pqrs_usuario').select2();
            });

    </script>
</body>

</html>