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

    <link rel="stylesheet" href="../../assets/css/estilos.css">
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
                    <input type="text" placeholder="Nombre" name="nombre" id="nombre">
                    <input type="text"  placeholder="Numero de documento" name="documento" id="documentoR">
                    <input type="email" placeholder="Correo Electronico" name="email" id="email">
                    <input type="password" placeholder="Contraseña" name="password" id="passwordR">
                    <button>Registrarse</button>
                </form>
            </div>
        </div>
    </main>
    <script src="../../Assets/js/script.js"></script>
</body>

</html>