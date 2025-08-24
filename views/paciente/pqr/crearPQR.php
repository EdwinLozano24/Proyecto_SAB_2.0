<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/auth.php';
requiereSesion();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$pdo = conectarBD();

// Obtener el id del usuario logueado desde la sesión
$id_usuario = $_SESSION['id_usuario'] ?? null;

if ($id_usuario) {
    $stmt = $pdo->prepare("SELECT * FROM tbl_usuarios WHERE id_usuario = :id_usuario");
    $stmt->execute([':id_usuario' => $id_usuario]);
    $paciente = $stmt->fetch(PDO::FETCH_ASSOC);
}
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
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/Assets/css/pqr/pqrCrear2.css';
    $cssUrl = '/Assets/css/pqr/pqrCrear2.css';
    if (file_exists($cssPath)) {
        echo '<link rel="stylesheet" href="' . $cssUrl . '">';
    } else {
        echo ' CSS File not fount at: ' . $cssPath . '';
    }
    ?>
    <link rel="stylesheet" href="/Assets/css/layoutFinal/paciente/layout1.css">
</head>

<body>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/nav.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/aside.php');
    ?>
    <main class="main-content">
        <div class="container-about">
            <h2 class="section-title">Crear PQR</h2>
            <p>Usuario responsable: <strong><?= $nombreUsuario ?></strong></p>
        </div>
            <div class="container">


        <!-- Información del Avatar -->
        <div class="avatar-container">
            <div class="avatar"><?= obtenerIniciales($paciente['usua_nombre']) ?></div>
            <div class="avatar-info">
                <h2><?= $paciente['usua_nombre']?></h2>
                <h3></h3> <p><?= $paciente['usua_tipo'] ?>
                
                <span class="status-badge status-active">● <?= $paciente['usua_estado'] ?></span>
            </div>
        </div>

        <!-- Información Personal -->
        <div class="form-section">
            <div class="section-title">
                <div class="section-icon">👤</div>
                Información Personal
            </div>
            <div class="form-grid">
                <div class="form-group">
        <form action="/controllers/PqrsController.php?accion=storeUser" method="POST">
                    <label>Nombre Completo</label>
                    <input type="hidden" name="origen_formulario" id="origen_formulario" value="Usuario" required>
                    <input type="hidden" name="id_usuario" id="id_usuario" value="<?= $paciente['id_usuario'] ?>" required>
                    <input type="hidden" name="usua_nombre" id="usua_nombre" value="<?= $paciente['usua_nombre'] ?>" required>
                    <div class="data-field"><?= $paciente['usua_nombre']?></div>
                </div>
            

            <div class="form-group">
                <label>Nombre Completo</label>
                    <input type="hidden" name="origen_formulario" id="origen_formulario" value="Usuario" required>
                    <input type="hidden" name="id_usuario" id="id_usuario" value="<?= $paciente['id_usuario'] ?>" required>
                    <input type="hidden" name="usua_nombre" id="usua_nombre" value="<?= $paciente['usua_nombre'] ?>" required>
                </div>
                <label for="pqrs_tipo">Tipo de PQR</label>
                <select name="pqrs_tipo" id="pqrs_tipo" required>
                    <option value="" disabled selected>Seleccionar tipo...</option>
                    <option value="Petición">Petición</option>
                    <option value="Queja">Queja</option>
                    <option value="Reclamo">Reclamo</option>
                    <option value="Sugerencia">Sugerencia</option>
                </select>
            </div>

            <div class="form-group">
                <label for="pqrs_asunto">Asunto</label>
                <input type="text" name="pqrs_asunto" id="pqrs_asunto" required>
            </div>

            <div class="form-group">
                <label for="pqrs_descripcion">Descripción</label>
                <textarea name="pqrs_descripcion" id="pqrs_descripcion" maxlength="255" required></textarea>
            </div>

            <div class="button-group">
                <button type="button" onclick="window.history.back()">← Cancelar</button>
                <button type="submit">⚠️ Registrar PQR</button>
            </div>
        </form>
        </div>

    </main>
    <!-- JS de jQuery y Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="script.js"></script> -->
    <script>
        $(document).ready(function () {
            $('#pqrs_usuario').select2();
            });

    </script>

    <?php include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/footer.php'); ?>

</body>

</html>