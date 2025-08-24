<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/auth.php';
requiereSesion();
function obtenerIniciales($nombreCompleto) {
    $palabras = explode(' ', trim($nombreCompleto));
    $iniciales = '';
    foreach ($palabras as $palabra) {
        if (!empty($palabra)) {
            $iniciales .= strtoupper($palabra[0]);
        }
    }
    return $iniciales;
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

        <form action="/controllers/PqrsController.php?accion=storeUser" method="POST">
            <!-- ID oculto del usuario logueado -->
            <input type="hidden" name="pqrs_usuario" value="<?= $idUsuario ?>">

            <div class="form-group">
                <label>Nombre Completo</label>
                    <input type="hidden" name="origen_formulario" id="origen_formulario" value="Usuario" required>
                    <input type="hidden" name="id_usuario" id="id_usuario" value="<?= $paciente['id_usuario'] ?>" required>
                    <input type="hidden" name="usua_nombre" id="usua_nombre" value="<?= $paciente['usua_nombre'] ?>" required>
                    <div class="data-field"><?= $paciente['usua_nombre']?></div>
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