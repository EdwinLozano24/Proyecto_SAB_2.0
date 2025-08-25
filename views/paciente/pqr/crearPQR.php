<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/auth.php';
requiereSesion();

$id_usuario = $_SESSION['usuario']['id_usuario'];
// $idUsuario = $_SESSION['id_usuario'];

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
    $cssUrl = '/assets/css/admin/crudPage.css';
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
        </div>

        <form action="/controllers/PqrsController.php?accion=store" method="POST">
            <!-- ID oculto del usuario logueado -->
            <input type="hidden" name="origen_formulario" value="Usuario">
            <input type="hidden" name="pqrs_usuario" value="<?php echo $_SESSION['usuario']['id_usuario']; ?>">


            <div class="form-group">
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
    <?php 
        include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/footer.php');
        ?>
</body>

</html>