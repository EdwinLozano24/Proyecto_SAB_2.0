<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/auth.php';
requiereSesion();

$id_usuario = $_SESSION['usuario']['id_usuario'];
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
    // Usar el CSS estilizado para PQRS
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
        <div class="pqr-container">
            <!-- Header del formulario -->
            <div class="container-about"></div>
                <h1 class="section-title">Generar PQRS</h1>
                <p class="system-subtitle">Programa tu consulta seleccionando los detalles de tu solicitud</p>
            </div>

            <!-- Formulario -->
            <div class="form-card">
                <form action="/controllers/PqrsController.php?accion=store" method="POST">
                    <!-- Campos ocultos -->
                    <input type="hidden" name="origen_formulario" value="Usuario">
                    <input type="hidden" name="pqrs_usuario" value="<?php echo $_SESSION['usuario']['id_usuario']; ?>">

                    <!-- Sección de detalles -->
                    <div class="form-section">
                        <div class="section-header">
                            <span class="section-icon">📋</span>
                            <h3 class="section-title">Detalles del PQRS</h3>
                        </div>

                        <!-- Tipo de PQRS -->
                        <div class="form-group">
                            <label for="pqrs_tipo">
                                Tipo de PQRS <span class="required">*</span>
                            </label>
                            <div class="input-with-icon">
                                <span class="input-icon">📝</span>
                                <select name="pqrs_tipo" id="pqrs_tipo" required>
                                    <option value="" disabled selected>Seleccionar tipo</option>
                                    <option value="Petición">Petición</option>
                                    <option value="Queja">Queja</option>
                                    <option value="Reclamo">Reclamo</option>
                                    <option value="Sugerencia">Sugerencia</option>
                                </select>
                            </div>

                        <!-- Asunto -->
                        <div class="form-group">
                            <label for="pqrs_asunto">
                                Asunto <span class="required">*</span>
                            </label>
                            <div class="input-with-icon">
                                <span class="input-icon">📄</span>
                                <input type="text" name="pqrs_asunto" id="pqrs_asunto"
                                    placeholder="Ingrese el asunto" required>
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="form-group full-width">
                            <label for="pqrs_descripcion">
                                Descripción <span class="required">*</span>
                            </label>
                            <div class="textarea-container">
                                <textarea name="pqrs_descripcion" id="pqrs_descripcion"
                                    maxlength="255"
                                    placeholder="Describe el motivo de tu PQRS con más detalle..."
                                    required></textarea>
                                <div class="textarea-footer">
                                    <span>💬</span>
                                    <span>Sé lo más específico posible</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información importante -->
                    <div class="form-info-card">
                        <div class="info-card-header">
                            <div class="info-icon">ℹ️</div>
                            <h3>Información importante</h3>
                        </div>
                        <ul class="info-list">
                            <li>
                                <span class="list-icon">🕐</span>
                                <span>Los PQRS deben procesarse con 24 horas de anticipación</span>
                            </li>
                            <li>
                                <span class="list-icon">👨‍⚕️</span>
                                <span>Se asignará automáticamente el especialista más adecuado</span>
                            </li>
                            <li>
                                <span class="list-icon">⏰</span>
                                <span>Respuesta en un plazo máximo de 5 días hábiles</span>
                            </li>
                            <li>
                                <span class="list-icon">📧</span>
                                <span>Recibirás una notificación por email</span>
                            </li>
                            <li>
                                <span class="list-icon">📞</span>
                                <span>En urgencias, contacta directamente al consultorio</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Botones -->
                    <div class="button-group">
                        <button type="button" class="btn-secondary" onclick="window.history.back()">
                            ← Cancelar
                        </button>
                        <button type="submit" class="btn-primary">
                            📝 Registrar PQRS
                        </button>
                    </div>
                </form>
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
            // Inicializar Select2
            $('#pqrs_tipo').select2({
                width: '100%'
            });

            // Contador de caracteres para textarea
            $('#pqrs_descripcion').on('input', function() {
                var maxLength = 255;
                var currentLength = $(this).val().length;
                var remaining = maxLength - currentLength;

                var footer = $(this).siblings('.textarea-footer');
                footer.find('span:last-child').text(`${remaining} caracteres restantes`);

                if (remaining < 50) {
                    footer.find('span:last-child').css('color', '#f59e0b');
                } else if (remaining < 20) {
                    footer.find('span:last-child').css('color', '#ef4444');
                } else {
                    footer.find('span:last-child').css('color', '#64748b');
                }
            });

            // Mostrar información del tipo seleccionado
            $('#pqrs_tipo').on('change', function() {
                var tipo = $(this).val();
                var link = $(this).closest('.form-group').find('.motivo-link');

                if (tipo) {
                    link.text(`ℹ️ Información sobre ${tipo} - Clic para más detalles`);
                } else {
                    link.text('⚠️ Selecciona un tipo para ver la información');
                }
            });

            // Loading state en submit
            $('form').on('submit', function() {
                $(this).addClass('loading');
                $('button[type="submit"]').prop('disabled', true);
            });
        });
    </script>
</body>

</html>
