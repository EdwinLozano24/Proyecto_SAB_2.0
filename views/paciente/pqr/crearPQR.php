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
    
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/assets/css/pqr/pqrCrear.css';
    $cssUrl = '/assets/css/pqr/pqrCrear.css';
    if (file_exists($cssPath)) {
        echo '<link rel="stylesheet" href="' . $cssUrl . '">';
    } else {
        echo ' CSS File not found at: ' . $cssPath . '';
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
        <div class="form-container">
            <!-- Header del formulario -->
            <div class="container-about">
                <div class="dental-logo"></div>
                <h2 class="section-title">Generar PQRS</h2>
                <p class="system-subtitle">Sistema de Gestión Odontológica SAB</p>
            </div>

            <!-- Formulario -->
            <form action="/controllers/PqrsController.php?accion=store" method="POST">
                <!-- Campos ocultos -->
                <input type="hidden" name="origen_formulario" value="Usuario">
                <input type="hidden" name="pqrs_usuario" value="<?php echo $_SESSION['usuario']['id_usuario']; ?>">

                <!-- Título de sección -->
                <div class="section-info">
                    <div class="info-icon">ℹ</div>
                    <span>Información del Pqrs</span>
                </div>

                <!-- Primera fila - dos columnas -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="pqrs_usuario_responsable">Usuario Responsable<span class="required">*</span></label>
                        <select name="pqrs_usuario_responsable" id="pqrs_usuario_responsable" required>
                            <option value="" disabled selected>Seleccionar un usuario...</option>
                            <!-- Aquí irían las opciones de usuarios -->
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
                </div>

                <!-- Segunda fila - campo completo -->
                <div class="form-group full-width">
                    <label for="pqrs_asunto">Asunto<span class="required">*</span></label>
                    <input type="text" name="pqrs_asunto" id="pqrs_asunto" required>
                </div>

                <!-- Tercera fila - campo completo -->
                <div class="form-group full-width">
                    <label for="pqrs_descripcion">Descripcion<span class="required">*</span></label>
                    <textarea name="pqrs_descripcion" id="pqrs_descripcion" maxlength="255" placeholder="Escriba su Pqrs..." required></textarea>
                </div>

                <!-- Botones -->
                <div class="button-group">
                    <button type="button" onclick="window.history.back()">Cancelar</button>
                    <button type="submit">⚠️ Registrar Pqrs</button>
                </div>
            </form>
        </div>
    </main>

    <?php 
    include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/layoutsFinal/paciente/footer.php');
    ?>

    <!-- JavaScript de Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializar Select2 en los selects
            $('#pqrs_usuario_responsable, #pqrs_tipo').select2({
                width: '100%'
            });
        });
    </script>
</body>
</html>