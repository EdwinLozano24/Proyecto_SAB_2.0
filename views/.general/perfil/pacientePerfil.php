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
    <title>Tu Perfil</title>
    <!-- Fony Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/assets/css/user/userPerfil.css';
    $cssUrl = '/assets/css/user/userPerfil.css';
    if (file_exists($cssPath)) {
        echo '<link rel="stylesheet" href="' . $cssUrl . '">';
    } else {
        echo ' CSS File not fount at: ' . $cssPath . '';
    }
    ?>

</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">P</div>
            <h2>Datos de Perfil</h2>
            <p class="subtitle">Información personal y contacto</p>
            <div class="boton-volver">
                <button type="button" class="btn-custom btn-primary-custom" onclick="window.history.back()">
                    <i class="fa-solid fa-rotate-left"></i> Volver</a>
                </button>
            </div>
        </div>
        

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
                    <label>Nombre Completo</label>
                    <div class="data-field"><input type="text" name="usua_nombre" id="nombre" value="<?= $paciente['usua_nombreasdsad'] ?>" required></div>
                </div>
                <div class="form-group">
                    <label>Documento de Identidad</label>
                    <div class="data-field"><?= $paciente['usua_documento']?></div>
                </div>
                <div class="form-group">
                    <label>Tipo de Documento</label>
                    <div class="data-field"><?= $paciente['usua_tipo_documento']?></div>
                </div>
                <div class="form-group">
                    <label>Fecha de Nacimiento</label>
                    <div class="data-field"><?= $paciente['usua_fecha_nacimiento']?></div>
                </div>
                <div class="form-group">
                    <label>Sexo</label>
                    <div class="data-field"><?= $paciente['usua_sexo']?></div>
                </div>
                <div class="form-group">
                    <label>Rh</label>
                    <div class="data-field"><?= $paciente['usua_rh']?></div>
                </div>
                <div class="form-group">
                    <label>Eps</label>
                    <div class="data-field"><?= $paciente['usua_eps']?></div>
                </div>
            </div>
        </div>

        <!-- Información de Contacto -->
        <div class="form-section">
            <div class="section-title">
                <div class="section-icon">📧</div>
                Información de Contacto
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label>Correo Electrónico</label>
                    <div class="data-field"><?= $paciente['usua_correo_electronico']?></div>
                </div>
                <div class="form-group">
                    <label>Dirección</label>
                    <div class="data-field"><?= $paciente['usua_direccion']?></div>
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <div class="data-field"><?= $paciente['usua_num_contacto']?></div>
                </div>
                <div class="form-group">
                    <label>Teléfono Secundario</label>
                    <div class="data-field"><?= $paciente['usua_num_secundario']?></div>
                </div>
            </div>
        </div>

        <!-- Card de información -->
        <div class="info-card">
            <h3>📋 Información del Sistema</h3>
            <p>Los datos mostrados son de solo lectura. Para realizar modificaciones, contacte al administrador del sistema.</p>
        </div>
        <div class="boton-volver">
                <button type="button" class="btn-custom btn-primary-custom" onclick="window.history.back()">
                    <i class="fa-solid fa-rotate-left"></i> Volver</a>
                </button>
            </div>
    </div>

    </div>
</body>

</html>