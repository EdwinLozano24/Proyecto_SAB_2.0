<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Paciente</title>
    <title>Document</title>
</head>

<body>
    <h2>Registro de Paciente</h2>
    <form action="../controllers/Authcontroller.php" method="POST">

        <label for="nombre">Nombre Completo:</label>
        <input type="text" name="paci_nombre" id="nombre" required><br><br>

        <label for="doc_tipo">Tipo de Documento:</label>
        <select name="paci_tipo_documento" id="doc_tipo" required>
            <option value="" disabled selected>Seleccione</option>
            <option value="1">Cédula</option>
            <option value="2">Tarjeta de Identidad</option>
            <option value="3">Pasaporte</option>
        </select><br><br>

        <label for="num_documento">Número de Documento:</label>
        <input type="number" name="paci_num_documento" id="num_documento" required><br><br>

        <label for="correo">Correo Electrónico:</label>
        <input type="email" name="paci_correo_electronico" id="correo" required><br><br>


        <label for="contacto">Número de Contacto:</label>
        <input type="tel" name="paci_num_contacto" id="contacto"><br><br>

        <label for="acudiente">Número Secundario/Acudiente :</label>
        <input type="tel" name="paci_num_acudiente" id="acudiente"><br><br>

        <label for="direccion">Dirección:</label>
        <input type="text" name="paci_direccion" id="direccion"><br><br>

        <label for="nacimiento">Fecha de Nacimiento:</label>
        <input type="date" name="paci_fecha_nacimiento" id="nacimiento"><br><br>

        <label for="sexo">Sexo:</label>
        <select name="paci_sexo" id="sexo" required>
            <option value="">Seleccione</option>
            <option value="1">Masculino</option>
            <option value="2">Femenino</option>
        </select><br><br>

        <label for="rh">Tipo de Sangre (RH):</label>
        <select name="paci_rh" id="rh" required>
            <option value="">Seleccione</option>
            <option value="1">A+</option>
            <option value="2">A-</option>
            <option value="3">B+</option>
            <option value="4">B-</option>
            <option value="5">AB+</option>
            <option value="6">AB-</option>
            <option value="7">O+</option>
            <option value="8">O-</option>
        </select><br><br>

        <label for="eps">EPS:</label>
        <input type="text" name="paci_eps" id="eps"><br><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="paci_password" id="contrasena" required><br><br>

        <button type="submit" name="registrar">Registrarse</button>
    </form>
</body>

</html>