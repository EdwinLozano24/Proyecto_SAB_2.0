<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Codificación UTF-8 para soportar tildes, ñ, etc. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Página responsive en móviles -->
    <title>LoginRegister</title>

    <!-- Fuente de Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- CSS personalizado (se fuerza actualización con versión al final) -->
    <link rel="stylesheet" href="/assets/css/user/loginRegister.css?v=20250836">
</head>
<body>
    <?php 
    // Si existe ?exito=1 en la URL, muestra mensaje de confirmación de registro
    if (isset($_GET['exito']) && $_GET['exito'] == 1): ?>
        <div class="alert alert-primary alert-dismissible fade show m-3" role="alert">
            ¡Registro exitoso! Ahora puedes iniciar sesión.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>

    <main>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/views/.general/error/alerta.php'); ?>
        <div class="contenedor__todo">
            
            <!-- Caja trasera con botones para alternar entre login y registro -->
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para continuar</p>
                    <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__registrarse">Registrarse</button>
                </div>
            </div>

            <!-- Contenedor de los formularios -->
            <div class="contenedor__login-register">

                <!-- FORMULARIO LOGIN -->
                <form id="loginForm" action="/controllers/AuthController.php?accion=Login" method="POST" class="formulario__login">
                    <h2>Iniciar Sesión</h2>

                    <!-- Campo oculto para identificar origen -->
                    <input type="hidden" name="origen_formulario" value="Usuario">

                    <!-- Documento -->
                    <label for="login_documento">Número de Documento</label>
                    <input type="text" id="login_documento" name="usua_documento" placeholder="Número de Documento" required>

                    <!-- Contraseña -->
                    <label for="login_password">Contraseña</label>
                    <input type="password" id="login_password" name="usua_password" placeholder="Contraseña" required>

                    <!-- Mensajes de error -->
                    <div id="error" style="color: blue;"></div>

                    <!-- Botón login -->
                    <button type="submit" name="loginUsuario">Entrar</button>

                    <!-- Enlace recuperar contraseña -->
                    <a href="../../../views/.general/password/recuperar_form.php" style="text-decoration: none; padding-left: 10px;">
                        ¿Olvidaste la contraseña?
                    </a>
                </form>

                <!-- FORMULARIO REGISTRO -->
                <form id="registerForm" action="/controllers/UsuarioController.php?accion=store" method="POST" class="formulario__register">
                    <h2>Registrarse</h2>

                    <!-- Scroll interno por ser formulario largo -->
                    <div class="form-scroll-inner">

                        <!-- Tipo de Documento -->
                        <label for="doc_tipo">Tipo de Documento</label><label for="" class="required">*</label>
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

                        <!-- Documento -->
                        <label for="num_documento">Número de Documento *</label>
                        <input type="number" placeholder="Número de Documento" name="usua_documento" id="num_documento" required>

                        <!-- Nombre -->
                        <label for="nombre">Nombre Completo *</label>
                        <input type="text" placeholder="Nombre Completo" name="usua_nombre" id="nombre" required>
                        
                        <!-- Correo -->
                        <label for="correo">Correo Electrónico *</label>
                        <input type="email" placeholder="Correo Electrónico" name="usua_correo_electronico" id="correo" required>

                        <!-- Teléfono principal -->
                        <label for="contacto">Número de contacto *</label>
                        <input type="tel" placeholder="Número de Contacto" name="usua_num_contacto" id="contacto" required>

                        <!-- Teléfono secundario -->
                        <label for="acudiente">Número de contacto secundario</label>
                        <input type="tel" placeholder="Número Secundario / Acudiente" name="usua_num_secundario" id="acudiente">

                        <!-- Dirección -->
                        <label for="direccion">Dirección *</label>
                        <input type="text" placeholder="Dirección" name="usua_direccion" id="direccion" required>

                        <!-- Fecha nacimiento -->
                        <label for="nacimiento">Fecha de Nacimiento *</label>
                        <input type="date" name="usua_fecha_nacimiento" id="nacimiento" required>

                        <!-- Sexo -->
                        <label for="sexo">Sexo *</label>
                        <select name="usua_sexo" id="sexo" required>
                            <option value="" disabled selected>Sexo</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
    
                        <!-- Tipo de sangre -->
                        <label for="rh">Tipo de sangre *</label>
                        <select name="usua_rh" id="rh" required>
                            <option value="" disabled selected>Tipo de Sangre (RH)</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                        
                        <!-- EPS -->
                        <label for="eps">EPS *</label>
                        <input type="text" placeholder="EPS" name="usua_eps" id="eps" required>

                        <!-- Contraseña -->
                        <label for="contrasena">Contraseña *</label>
                        <input type="password" placeholder="Contraseña" name="usua_password" id="contrasena" required>
                    </div>

                    <!-- Botón registro -->
                    <button type="submit" name="registrarUsuario">Registrarse</button>
                </form>
            </div>
        </div>
        
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script propio para alternar entre login/registro -->
    <script src="/assets/js/user/loginRespon.js"></script>
</body>
</html>
