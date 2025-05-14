<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>loginSab</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="Assets/css/loginRegister/loginregister.css"
</head>

<body>

    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para continuar</p>
                    <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__registrarse">Registrarse</button>
                </div>
            </div>

            <!--Formulario de Login y registro-->
            <div class="contenedor__login-register">
                <!--Login-->
                <form id="loginForm" action="/login" method="POST" class="formulario__login">
                    <h2>Iniciar Sesión</h2>
                    <input type="text" id="documento" name="documento" placeholder="Número De Documento" required>
                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                    <div id="error" style="color: blue;"></div>
                    <button type="submit">Entrar</button>
                </form>

                <!--Register-->
                <form id="registerForm" action="index.php?c=Login&a=register" method="POST" class="formulario__register">
                    <h2>Registrarse</h2>

                    <!-- Contenedor con scroll -->
                    <div class="form-scroll-inner">
                        <input type="text" placeholder="Nombre Completo" name="paci_nombre" id="nombre" required>

                        <select name="paci_tipo_documento" id="doc_tipo" required>
                            <option value="" disabled selected>Tipo de Documento</option>
                            <option value="1">Cédula</option>
                            <option value="2">Tarjeta de Identidad</option>
                            <option value="3">Pasaporte</option>
                        </select>

                        <input type="number" placeholder="Número de Documento" name="paci_num_documento" id="num_documento" required>
                        <input type="email" placeholder="Correo Electrónico" name="paci_correo_electronico" id="correo" required>
                        <input type="tel" placeholder="Número de Contacto" name="paci_num_contacto" id="contacto">
                        <input type="tel" placeholder="Número Secundario / Acudiente" name="paci_num_acudiente" id="acudiente">
                        <input type="text" placeholder="Dirección" name="paci_direccion" id="direccion">
                        <input type="date" placeholder="Fecha de Nacimiento" name="paci_fecha_nacimiento" id="nacimiento">

                        <select name="paci_sexo" id="sexo" required>
                            <option value="">Sexo</option>
                            <option value="1">Masculino</option>
                            <option value="2">Femenino</option>
                        </select>

                        <select name="paci_rh" id="rh" required>
                            <option value="">Tipo de Sangre (RH)</option>
                            <option value="1">A+</option>
                            <option value="2">A-</option>
                            <option value="3">B+</option>
                            <option value="4">B-</option>
                            <option value="5">AB+</option>
                            <option value="6">AB-</option>
                            <option value="7">O+</option>
                            <option value="8">O-</option>
                        </select>

                        <input type="text" placeholder="EPS" name="paci_eps" id="eps">
                        <input type="password" placeholder="Contraseña" name="paci_password" id="contrasena" required>
                    </div>

                    <button type="submit" name="registrar">Registrarse</button>
                </form>
            </div>
        </div>
    </main>
    <script src="Assets/js/loginRespon.js"></script>
</body>

</html>