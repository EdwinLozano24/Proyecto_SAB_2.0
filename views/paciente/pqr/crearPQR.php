<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/auth.php';
requiereSesion();
session_start();

// Traemos al usuario de la sesión
$idUsuario = $_SESSION['id_usuario'];
$nombreUsuario = $_SESSION['nombre'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear PQR</title>
    <link rel="stylesheet" href="/Assets/css/pqr/pqrCrear2.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Crear PQR</h2>
            <p>Usuario responsable: <strong><?= $nombreUsuario ?></strong></p>
        </div>

        <form action="/controllers/PqrsController.php?accion=storeUser" method="POST">
            <!-- ID oculto del usuario logueado -->
            <input type="hidden" name="pqrs_usuario" value="<?= $idUsuario ?>">

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
</body>
</html>
