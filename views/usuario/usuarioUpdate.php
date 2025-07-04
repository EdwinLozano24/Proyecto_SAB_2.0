<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario - Sistema Odontológico</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/proyecto_sab/assets/css/admin/crudUsuario.css';
    $cssUrl = '/proyecto_sab/assets/css/admin/crudUsuario.css';
    if (file_exists($cssPath)) {
        echo '<link rel="stylesheet" href="' . $cssUrl . '">';
    } else {
        echo ' CSS File not fount at: ' . $cssPath . '';
    }
    ?>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">🦷</div>
            <h1>Actualizar Información del Usuario</h1>
            <p class="subtitle">Sistema de Gestión Odontológica</p>
        </div>

        <form action="../controllers/UsuarioController.php?accion=update" method="POST" class="form-card">
            <input type="hidden" name="id_usuario" value="<?= $usua['id_usuario'] ?>">

            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">👤</div>
                    Información Personal
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nombre">Nombre Completo <span class="required">*</span></label>
                        <input type="text" name="usua_nombre" id="nombre" value="<?= $usua['usua_nombre'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="doc_tipo">Tipo de Documento <span class="required">*</span></label>
                        <select name="usua_tipo_documento" id="doc_tipo" required>
                            <option value="" disabled>Seleccionar tipo</option>
                            <option value="Cédula de ciudadanía" <?= ($usua['usua_tipo_documento'] == "Cédula de ciudadanía") ? 'selected' : '' ?>>Cédula</option>
                            <option value="Tarjeta de identidad" <?= ($usua['usua_tipo_documento'] == "Tarjeta de identidad") ? 'selected' : '' ?>>Tarjeta de Identidad</option>
                            <option value="Cédula de extranjería" <?= ($usua['usua_tipo_documento'] == "Cédula de extranjería") ? 'selected' : '' ?>>Cédula de Extranjería</option>
                            <option value="Permiso especial de permanencia" <?= ($usua['usua_tipo_documento'] == "Permiso especial de permanencia") ? 'selected' : '' ?>>Permiso Especial de Permanencia</option>
                            <option value="Pasaporte" <?= ($usua['usua_tipo_documento'] == "Pasaporte") ? 'selected' : '' ?>>Pasaporte</option>
                            <option value="Número de identificación tributaria" <?= ($usua['usua_tipo_documento'] == "Número de identificación tributaria") ? 'selected' : '' ?>>Numero de Identificacion Tributaria</option>
                            <option value="Otro" <?= ($usua['usua_tipo_documento'] == "Otro") ? 'selected' : '' ?>>Otro</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="num_documento">Número de Documento <span class="required">*</span></label>
                        <input type="number" name="usua_documento" id="num_documento" value="<?= $usua['usua_documento'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="nacimiento">Fecha de Nacimiento</label>
                        <input type="date" name="usua_fecha_nacimiento" id="nacimiento" value="<?= $usua['usua_fecha_nacimiento'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="sexo">Sexo <span class="required">*</span></label>
                        <select name="usua_sexo" id="sexo" required>
                            <option value="" disabled>Seleccionar</option>
                            <option value="Masculino" <?= ($usua['usua_sexo'] == "Masculino") ? 'selected' : '' ?>>Masculino</option>
                            <option value="Femenino" <?= ($usua['usua_sexo'] == "Femenino") ? 'selected' : '' ?>>Femenino</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="rh">Tipo de Sangre (RH) <span class="required">*</span></label>
                        <select name="usua_rh" id="rh" required>
                            <option value="" disabled>Seleccionar RH</option>
                            <option value="A+" <?= ($usua['usua_rh'] == "A+") ? 'selected' : '' ?>>A+</option>
                            <option value="A-" <?= ($usua['usua_rh'] == "A-") ? 'selected' : '' ?>>A-</option>
                            <option value="B+" <?= ($usua['usua_rh'] == "B+") ? 'selected' : '' ?>>B+</option>
                            <option value="B-" <?= ($usua['usua_rh'] == "B-") ? 'selected' : '' ?>>B-</option>
                            <option value="AB+" <?= ($usua['usua_rh'] == "AB+") ? 'selected' : '' ?>>AB+</option>
                            <option value="AB-" <?= ($usua['usua_rh'] == "AB-") ? 'selected' : '' ?>>AB-</option>
                            <option value="O+" <?= ($usua['usua_rh'] == "O+") ? 'selected' : '' ?>>O+</option>
                            <option value="O-" <?= ($usua['usua_rh'] == "O-") ? 'selected' : '' ?>>O-</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">📞</div>
                    Información de Contacto
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="correo">Correo Electrónico <span class="required">*</span></label>
                        <input type="email" name="usua_correo_electronico" id="correo" value="<?= $usua['usua_correo_electronico'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="contacto">Número de Contacto</label>
                        <input type="tel" name="usua_num_contacto" id="contacto" value="<?= $usua['usua_num_contacto'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="acudiente">Número Secundario / Emergencia</label>
                        <input type="tel" name="usua_num_secundario" id="acudiente" value="<?= $usua['usua_num_secundario'] ?>">
                    </div>

                    <div class="form-group full-width">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="usua_direccion" id="direccion" value="<?= $usua['usua_direccion'] ?>">
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">🏥</div>
                    Información Médica y Sistema
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="eps">EPS</label>
                        <input type="text" name="usua_eps" id="eps" value="<?= $usua['usua_eps'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="contrasena">Contraseña <span class="required">*</span></label>
                        <input type="password" name="usua_password" id="contrasena" value="" placeholder="Dejar en blanco si no desea cambiarla">
                    </div>

                    <div class="form-group">
                        <label for="tipo">Tipo de Usuario <span class="required">*</span></label>
                        <select name="usua_tipo" id="tipo" required>
                            <option value="" disabled>Tipo de usuario</option>
                            <option value="Administrador" <?=($usua['usua_tipo'] == "Administrador") ? 'selected' : '' ?>>Administrador</option>
                            <option value="Especialista" <?=($usua['usua_tipo'] == "Especialista") ? 'selected' : '' ?>>Especialista</option>
                            <option value="Empleado" <?=($usua['usua_tipo'] == "Empleado") ? 'selected' : '' ?>>Empleado</option>
                            <option value="Paciente" <?=($usua['usua_tipo'] == "Paciente") ? 'selected' : '' ?>>Paciente</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado del Usuario <span class="required">*</span></label>
                        <select name="usua_estado" id="estado" required>
                            <option value="" disabled>Seleccionar estado</option>
                            <option value="Activo" <?= ($usua['usua_estado'] == "Activo") ? 'selected' : '' ?>>Activo</option>
                            <option value="Inactivo" <?= ($usua['usua_estado'] == "Inactivo") ? 'selected' : '' ?>>Inactivo</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="button-group">
                <a href="../../controllers/TratamientoController.php?accion=index" class="btn-link">
                    ← Cancelar
                </a>
                <button type="submit">
                    💾 Actualizar Usuario
                </button>
            </div>
        </form>
    </div>

</body>

</html>