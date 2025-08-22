<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Bienvenido</title>
</head>
<body style="margin:0; padding:0; font-family: 'Open Sans', Arial, sans-serif; background-color:#f2f2f2;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#329FAB; background-image:url('https://tusitio.com/img/Login/fondoLogin.jpg'); background-size:cover; background-repeat:no-repeat; background-position:center;">
    <tr>
      <td align="center" style="padding:40px 20px;">
        <!-- Contenedor central -->
        <table width="600" border="0" cellspacing="0" cellpadding="0" style="background:#ffffff; border-radius:10px; overflow:hidden;">
          <tr>
            <td align="center" style="padding:30px 20px; color:#329FAB; font-size:28px; font-weight:600;">
              ¡Bienvenido a Nuestra Plataforma!
            </td>
          </tr>
          <tr>
            <td style="padding:20px 30px; color:#555; font-size:16px; line-height:1.5;">
              <p>Hola <strong>{{nombre}}</strong>,</p>
              <p>Gracias por registrarte en nuestro sistema. Ahora podrás acceder a todas las funcionalidades de la plataforma.</p>
              <p>Haz clic en el siguiente botón para confirmar tu cuenta:</p>
            </td>
          </tr>
          <tr>
            <td align="center" style="padding:20px;">
              <a href="{{url_confirmacion}}" style="display:inline-block; background:#329FAB; color:#ffffff; text-decoration:none; padding:12px 30px; font-size:16px; font-weight:bold; border-radius:5px;">
                Confirmar Cuenta
              </a>
            </td>
          </tr>
          <tr>
            <td style="padding:20px 30px; color:#777; font-size:14px; line-height:1.5;">
              Si no creaste esta cuenta, ignora este correo.  
              <br><br>
              <strong>Equipo de Soporte</strong>  
            </td>
          </tr>
        </table>
        <!-- Fin contenedor -->
      </td>
    </tr>
  </table>
</body>
</html>