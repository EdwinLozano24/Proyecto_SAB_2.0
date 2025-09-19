<?php
require_once '../../../config/auth.php';
requiereSesion();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/assets/css/admin/crudPage.css';
    $cssUrl = '/assets/css/admin/crudPage.css';
    if (file_exists($cssPath)) {
        echo '<link rel="stylesheet" href="' . $cssUrl . '">';
    } else {
        echo ' CSS File not fount at: ' . $cssPath . '';
    }
    ?>
    <link rel="icon" type="image/png" href="/Assets/img/favicon.png">
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">🦷</div>
            <h1>Crear Nuevo Usuario</h1>
            <p class="subtitle">Ingresa la información para registrar un nuevo usuario en el sistema</p>
        </div>

        <form id="crearForm" method="POST" action="/controllers/UsuarioController.php?accion=store" class="form-card">
            <div class="form-grid">
                <div class="form-group">
                    <input type="hidden" name="origen_formulario" value="Administrador">
                    <label for="nombre">Nombre Completo <span class="required">*</span></label>
                    <input type="text" placeholder="Nombre Completo" name="usua_nombre" id="nombre" required>
                </div>

                <div class="form-group">
                    <label for="doc_tipo">Tipo de Documento <span class="required">*</span></label>
                    <select name="usua_tipo_documento" id="doc_tipo" required>
                        <option value="" disabled selected>Tipo de Documento</option>
                        <option value="Cédula de ciudadanía">Cédula</option>
                        <option value="Tarjeta de identidad">Tarjeta de Identidad</option>
                        <option value="Cédula de extranjería">Cédula de Extranjería</option>
                        <option value="Permiso especial de permanencia">Permiso Especial de Permanencia</option>
                        <option value="Pasaporte">Pasaporte</option>
                        <option value="Número de identificación tributaria">Número de Identificación Tributaria</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="num_documento">Número de Documento <span class="required">*</span></label>
                    <input type="number" placeholder="Número de Documento" name="usua_documento" id="num_documento" required>
                </div>

                <div class="form-group">
                    <label for="correo">Correo Electrónico <span class="required">*</span></label>
                    <input type="email" placeholder="Correo Electrónico" name="usua_correo_electronico" id="correo" required>
                </div>

                <div class="form-group">
                    <label for="contacto">Número de Contacto</label>
                    <input type="tel" placeholder="Número de Contacto" name="usua_num_contacto" id="contacto">
                </div>

                <div class="form-group">
                    <label for="acudiente">Número Secundario / Emergencia</label>
                    <input type="tel" placeholder="Número Secundario / Acudiente" name="usua_num_secundario" id="acudiente">
                </div>

                <div class="form-group full-width">
                    <label for="direccion">Dirección</label>
                    <input type="text" placeholder="Dirección" name="usua_direccion" id="direccion">
                </div>

                <div class="form-group">
                    <label for="nacimiento">Fecha de Nacimiento</label>
                    <input type="date" placeholder="Fecha de Nacimiento" name="usua_fecha_nacimiento" id="nacimiento">
                </div>

                <div class="form-group">
                    <label for="sexo">Sexo <span class="required">*</span></label>
                    <select name="usua_sexo" id="sexo" required>
                        <option value="" disabled selected>Sexo</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="rh">Tipo de Sangre (RH) <span class="required">*</span></label>
                    <select name="usua_rh" id="rh" required>
                        <option value="" disabled selected>Tipo de Sangre (RH)</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="eps">EPS</label>
                    <input type="text" placeholder="EPS" name="usua_eps" id="eps">
                </div>

                <div class="form-group">
                    <label for="contrasena">Contraseña <span class="required">*</span></label>
                    <input type="password" placeholder="Contraseña" name="usua_password" id="contrasena" required>
                </div>

                <div class="form-group">
                    <label for="tipo">Tipo de usuario <span class="required">*</span></label>
                    <select name="usua_tipo" id="tipo" required>
                        <option value="" disabled selected>Tipo de usuario</option>
                        <option value="Paciente">Paciente</option>
                        <option value="Empleado">Empleado</option>
                        <option value="Especialista">Especialista</option>
                        <option value="Administrador">Administrador</option>
                    </select>
                </div>

            </div>

            <div class="button-group">
                <button type="button" class="btn-secondary" onclick="window.history.back()">
                    ← Cancelar
                </button>
                <input type="submit" id="generar_cita" value="👤 Registrar Usuario">
            </div>
        </form>
    </div>
</body>

</html>