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
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/assets/css/user/userPerfil2.css';
    $cssUrl = '/assets/css/user/userPerfil2.css';
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
            <form action="/controllers/UsuarioController.php?accion=update" method="POST">
                    <label>Nombre Completo</label>
                    <input type="hidden" name="origen_formulario" id="origen_formulario" value="Usuario" required>
                    <input type="hidden" name="id_usuario" id="id_usuario" value="<?= $paciente['id_usuario'] ?>" required>
                    <input type="hidden" name="usua_nombre" id="usua_nombre" value="<?= $paciente['usua_nombre'] ?>" required>
                    <div class="data-field"><?= $paciente['usua_nombre']?></div>
                </div>
                <div class="form-group">
                    <label>Documento de Identidad</label>
                    <input type="hidden" name="usua_documento" id="usua_documento" value="<?= $paciente['usua_documento'] ?>" required>
                    <div class="data-field"><?= $paciente['usua_documento']?></div>
                </div>
                <div class="form-group">
                    <label>Tipo de Documento</label>
                    <input type="hidden" name="usua_tipo_documento" id="usua_tipo_documento" value="<?= $paciente['usua_tipo_documento'] ?>" required>
                    <div class="data-field"><?= $paciente['usua_tipo_documento']?></div>
                </div>
                <div class="form-group">
                    <label>Fecha de Nacimiento</label>
                    <input type="hidden" name="usua_fecha_nacimiento" id="usua_fecha_nacimiento" value="<?= $paciente['usua_fecha_nacimiento'] ?>" required>
                    <div class="data-field"><?= $paciente['usua_fecha_nacimiento']?></div>
                </div>
                <div class="form-group">
                    <label>Sexo</label>
                    <input type="hidden" name="usua_sexo" id="usua_sexo" value="<?= $paciente['usua_sexo'] ?>" required>
                    <div class="data-field"><?= $paciente['usua_sexo']?></div>
                </div>
                <div class="form-group">
                    <label>Rh</label>
                    <input type="hidden" name="usua_rh" id="usua_rh" value="<?= $paciente['usua_rh'] ?>" required>
                    <div class="data-field"><?= $paciente['usua_rh']?></div>
                </div>
                <div class="form-group">
                    <label>Eps</label>
                    <input type="hidden" name="usua_password" id="usua_password" value="<?= $paciente['usua_password'] ?>" required>
                    <input type="hidden" name="usua_tipo" id="usua_tipo" value="<?= $paciente['usua_tipo'] ?>" required>
                    <input type="hidden" name="usua_estado" id="usua_estado" value="<?= $paciente['usua_estado'] ?>" required>
                    <input type="hidden" name="usua_eps" id="usua_eps" value="<?= $paciente['usua_eps'] ?>" required>
                    <div class="data-field"><input type="text" name="usua_eps" id="usua_eps" value="<?= $paciente['usua_eps'] ?>" required></div>
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
                    <div class="data-field"><input type="text" name="usua_correo_electronico" id="usua_correo_electronico" value="<?= $paciente['usua_correo_electronico'] ?>" required></div>
                </div>
                <div class="form-group">
                    <label>Dirección</label>
                    <div class="data-field"><input type="text" name="usua_direccion" id="usua_direccion" value="<?= $paciente['usua_correo_electronico'] ?>" required></div>
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <div class="data-field"><input type="text" name="usua_num_contacto" id="usua_num_contacto" value="<?= $paciente['usua_num_contacto'] ?>" required></div>
                </div>
                <div class="form-group">
                    <label>Teléfono Secundario</label>
                    <div class="data-field"><input type="text" name="usua_num_secundario" id="usua_num_secundario" value="<?= $paciente['usua_num_secundario'] ?>" required></div>
                </div>
            </div>
        </div>

        <!-- Card de información -->
        <div class="info-card">
            <h3>📋 Información del Sistema</h3>
            <p>Los datos mostrados son de solo lectura. Para realizar modificaciones, contacte al administrador del sistema.</p>
        </div>
        <div class="boton-volver">
                <button type="button" class="btn-custom btn-secundary-custom" onclick="window.history.back()">
                    <i class="fa-solid fa-rotate-left"></i> Volver</a>
                </button>
                <input type="submit" class="btn-custom btn-primary-custom" value="Actualizar">
            </div>
            </form>
    </div>

    </div>
</body>

</html>