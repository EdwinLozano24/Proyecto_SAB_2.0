<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginRegister</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/user/loginRegister.css?v=20250834">
</head>
<body>
    <?php if (isset($_GET['exito']) && $_GET['exito'] == 1): ?>
    <div class="alert alert-primary alert-dismissible fade show m-3" role="alert">
        ¡Registro exitoso! Ahora puedes iniciar sesión.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
<?php endif; ?>
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
                <form id="loginForm" action="/controllers/AuthController.php?accion=Login" method="POST" class="formulario__login">
                    <h2>Iniciar Sesión</h2>

                    <input type="hidden" name="origen_formulario" value="Usuario">

                    <label for="usua_documento">Numero de Documento</label>
                    <input type="text" id="documento" name="usua_documento" placeholder="Número De Documento" required>
                    <label for="usua_documento">Contraseña</label>
                    <input type="password" id="password" name="usua_password" placeholder="Contraseña" required>
                    <div id="error" style="color: blue;"></div>
                    <button type="submit" name="loginUsuario">Entrar</button>
                    <a href="../..

                    <button type="submit" name="registrarUsuario">Registrarse</button>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/user/loginRespon.js"></script>
</body>

</html>