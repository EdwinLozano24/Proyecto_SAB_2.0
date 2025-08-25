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
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/assets/css/admin/pqrCrear.css';
    $cssUrl = '/assets/css/admin/pqrCrear.css';
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
        <div class="pqr-container">
            <div class="pqr-section">
                <!-- Header del formulario -->
                <div class="container-about">
                    <div class="dental-logo"></div>
                    <h2 class="section-title">Generar PQRS</h2>
                    <p class="system-subtitle">Sistema de Gestión Odontológica SAB</p>
                </div>

                <!-- Formulario -->
                <div class="form-card">
                    <form action="/controllers/PqrsController.php?accion=store" method="POST">
                        <!-- Campos ocultos -->
                        <input type="hidden" name="origen_formulario" value="Usuario">
                        <input type="hidden" name="pqrs_usuario" value="<?php echo $_SESSION['usuario']['id_usuario']; ?>">

                        <!-- Sección de información -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">ℹ</div>
                                <h3 class="section-title">Información del Pqrs</h3>
                            </div>


                                <div class="form-group">
                                    <label for="pqrs_tipo">Tipo de Pqrs<span class="required">*</span></label>
                                    <div class="input-with-icon">
                                        <i class="input-icon">📋</i>
                                        <select name="pqrs_tipo" id="pqrs_tipo" required>
                                            <option value="" disabled selected>Seleccionar tipo...</option>
                                            <option value="Petición">Petición</option>
                                            <option value="Queja">Queja</option>
                                            <option value="Reclamo">Reclamo</option>
                                            <option value="Sugerencia">Sugerencia</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group full-width">
                                    <label for="pqrs_asunto">Asunto<span class="required">*</span></label>
                                    <div class="input-with-icon">
                                        <i class="input-icon">📄</i>
                                        <input type="text" name="pqrs_asunto" id="pqrs_asunto" placeholder="Ingrese el asunto del PQRS" required>
                                    </div>
                                </div>

                                <div class="form-group full-width">
                                    <label for="pqrs_descripcion">Descripción<span class="required">*</span></label>
                                    <div class="textarea-container">
                                        <textarea name="pqrs_descripcion" id="pqrs_descripcion" maxlength="255" placeholder="Escriba su Pqrs..." required></textarea>
                                        <div class="textarea-footer">
                                            <i>💬</i>
                                            <span>Máximo 255 caracteres</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="button-group">
                            <button type="button" class="btn-secondary" onclick="window.history.back()">
                                <i>←</i>
                                Cancelar
                            </button>
                            <button type="submit" class="btn-primary">
                                <i>⚠️</i>
                                Registrar Pqrs
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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