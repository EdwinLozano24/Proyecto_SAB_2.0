<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="../controllers/UsuarioController.php?accion=actualizar" method="POST">
        <input type="hidden" name="id_usuario" value="<?= $usua['id_usuario'] ?>">
        <input type="text" name="usua_nombre" id="nombre" value="<?= $usua['usua_nombre'] ?>" required>

        <select name="usua_tipo_documento" id="doc_tipo" required>
            <option value="" disabled>Tipo de Documento</option>
            <option value="1" <?= ($usua['usua_tipo_documento'] == "CC (Cédula de ciudadanía)") ? 'selected' : '' ?>>Cédula</option>
            <option value="2" <?= ($usua['usua_tipo_documento'] == "TI (Tarjeta de identidad)") ? 'selected' : '' ?>>Tarjeta de Identidad</option>
            <option value="3" <?= ($usua['usua_tipo_documento'] == "CE (Cédula de extranjería)") ? 'selected' : '' ?>>Cédula de Extranjería</option>
            <option value="4" <?= ($usua['usua_tipo_documento'] == "PED (Permiso especial de permanencia)") ? 'selected' : '' ?>>Permiso Especial de Permanencia</option>
            <option value="5" <?= ($usua['usua_tipo_documento'] == "PAS (Pasaporte)") ? 'selected' : '' ?>>Pasaporte</option>
            <option value="6" <?= ($usua['usua_tipo_documento'] == "NIT (Número de identificación tributaria)") ? 'selected' : '' ?>>Numero de Identifiacion Tributaria</option>
            <option value="7" <?= ($usua['usua_tipo_documento'] == "Otro") ? 'selected' : '' ?>>Otro</option>
        </select>

        <input type="int" placeholder="Número de Documento" name="usua_documento" id="num_documento"
            value="<?= $usua['usua_documento'] ?>" required>
        <input type="email" placeholder="Correo Electrónico" name="usua_correo_electronico" id="correo"
            value="<?= $usua['usua_correo_electronico'] ?>" required>
        <input type="tel" placeholder="Número de Contacto" name="usua_num_contacto" id="contacto"
            value="<?= $usua['usua_num_contacto'] ?>">
        <input type="tel" placeholder="Número Secundario / Acudiente" name="usua_num_secundario" id="acudiente"
            value="<?= $usua['usua_num_secundario'] ?>">
        <input type="text" placeholder="Dirección" name="usua_direccion" id="direccion"
            value="<?= $usua['usua_direccion'] ?>">
        <input type="date" placeholder="Fecha de Nacimiento" name="usua_fecha_nacimiento" id="nacimiento"
            value="<?= $usua['usua_fecha_nacimiento'] ?>">

        <select name="usua_sexo" id="sexo" required>
            <option value="" disabled >Sexo</option>
            <option value="1" <?= ($usua['usua_sexo'] == "Masculino") ? 'selected' : '' ?>>Masculino</option>
            <option value="2" <?= ($usua['usua_sexo'] == "Femenino") ? 'selected' : '' ?>>Femenino</option>
        </select>

        <select name="usua_rh" id="rh" required>
            <option value="" disabled>Tipo de Sangre (RH)</option>
            <option value="1" <?= ($usua['usua_rh'] == "A+") ? 'selected' : '' ?>>A+</option>
            <option value="2" <?= ($usua['usua_rh'] == "A-") ? 'selected' : '' ?>>A-</option>
            <option value="3" <?= ($usua['usua_rh'] == "B+") ? 'selected' : '' ?>>B+</option>
            <option value="4" <?= ($usua['usua_rh'] == "B-") ? 'selected' : '' ?>>B-</option>
            <option value="5" <?= ($usua['usua_rh'] == "AB+") ? 'selected' : '' ?>>AB+</option>
            <option value="6" <?= ($usua['usua_rh'] == "AB-") ? 'selected' : '' ?>>AB-</option>
            <option value="7" <?= ($usua['usua_rh'] == "O+") ? 'selected' : '' ?>>O+</option>
            <option value="8" <?= ($usua['usua_rh'] == "O-") ? 'selected' : '' ?>>O-</option>
        </select>

        <input type="text" placeholder="EPS" name="usua_eps" id="eps" value="<?= $usua['usua_eps'] ?>">
        <input type="password" placeholder="Contraseña" name="usua_password" id="contrasena"
            value="<?= $usua['usua_password'] ?>" required>
        <select name="usua_tipo" id="tipo" required>
            <option value="" disabled>Tipo de usuario</option>
            <option value="1" <?= ($usua['usua_tipo'] == "Administrador") ? 'selected' : '' ?>>Administrador</option>
            <option value="2" <?= ($usua['usua_tipo'] == "Especialista") ? 'selected' : '' ?>>Especialista</option>
            <option value="3" <?= ($usua['usua_tipo'] == "Empleado") ? 'selected' : '' ?>>Empleado</option>
            <option value="4" <?= ($usua['usua_tipo'] == "Paciente") ? 'selected' : '' ?>>Paciente</option>
        </select>
        <select name="usua_estado" id="tipo" required>
            <option value="" disabled>Estado</option>
            <option value="1" <?= ($usua['usua_estado'] == "Activo") ? 'selected' : '' ?>>Activo</option>
            <option value="2" <?= ($usua['usua_estado'] == "Inactivo") ? 'selected' : '' ?>>Inactivo</option>
        </select>
        <button type="submit">Actualizar</button>
        <a href=".././controllers/UsuarioController.php">Volver</a>
    </form>

</body>

</html>