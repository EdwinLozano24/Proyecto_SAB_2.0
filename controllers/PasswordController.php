<?php
require_once __DIR__ . '/../models/UsuarioModel.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
date_default_timezone_set('America/Bogota');

class PasswordController
{
    private $UsuarioModel;

    public function __construct()
    {
        $this->UsuarioModel = new UsuarioModel();
    }

    // Mostrar el formulario para escribir el correo
    public function showRecoverForm()
    {
        require '../views/password/recuperar_form.php';
    }

    // Procesar el envío del correo con token
    public function sendResetLink()
    {
        $correo = $_POST['email'] ?? null;

        if ($correo) {
            $usuario = $this->UsuarioModel->findCorreo($correo);  // Busca el usuario por correo

            if ($usuario) {
                $token = bin2hex(random_bytes(32));
                $expira = date("Y-m-d H:i:s", strtotime("+1 hour"));

                $this->UsuarioModel->saveToken($correo, $token, $expira);  // Guarda el token

                $enlace = "http://localhost/proyecto_sab/index.php?action=resetForm&token=$token";

                require 'vendor/autoload.php';

                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'saludbenefitt@gmail.com';
                    $mail->Password = 'iuxw rbta laja xrav';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    $mail->setFrom('saludbenefitt@gmail.com', 'Soporte');
                    $mail->addAddress($correo);
                    $mail->isHTML(true);
                    $mail->Subject = 'Recupera Tu Password';
                    $mail->Body = '
  <div style="font-family:-apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Arial, sans-serif;
              background:#f8fafc; padding:20px;">
    <div style="max-width:600px; margin:0 auto; background:#fff; border-radius:16px;
                padding:40px; box-shadow:0 20px 25px rgba(0,0,0,0.1);">
      
      <!-- Header -->
      <div style="text-align:center; margin-bottom:32px; border-bottom:2px solid #e2e8f0; padding-bottom:24px; display:flex; flex-direction:column; align-items:center;">
        <div style="width:80px; height:80px; background:linear-gradient(135deg,#0ea5e9,#0284c7);
                    border-radius:16px; align-items:center; line-height:80px;
                    justify-content:center; font-size:32px; color:#fff; font-weight:600; margin-bottom:20px;">
          🔐
        </div>
        <h1 style="font-size:24px; color:#1e293b; margin:0 0 8px;">Mi Aplicación</h1>
        <p style="color:#64748b; font-size:14px; margin:0;">Sistema de Gestión Seguro</p>
      </div>
      
      <!-- Mensaje -->
      <p style="font-size:18px; color:#1e293b; font-weight:600; margin:0 0 16px;">¡Hola!</p>
      <p style="font-size:16px; color:#475569; line-height:1.7; margin:0 0 24px;">
        Hemos recibido una solicitud para restablecer la contraseña de tu cuenta. 
        Si fuiste tú quien solicitó este cambio, haz clic en el botón de abajo.
      </p>
      
      <!-- Botón -->
      <div style="text-align:center; margin:40px 0;">
        <a href="' . $enlace . '" 
           style="display:inline-block; padding:16px 32px; background:linear-gradient(135deg,#0ea5e9,#0284c7);
                  color:#fff; text-decoration:none; border-radius:8px; font-size:16px; font-weight:600;">
          🔑 Restablecer mi contraseña
        </a>
      </div>
      
      <!-- Enlace alternativo -->
      <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px;
                  padding:16px; margin:24px 0; font-size:14px; color:#64748b;">
        <p style="margin:0 0 8px;"><strong>¿El botón no funciona?</strong> Copia y pega este enlace:</p>
        <p style="font-family:monospace; font-size:12px; color:#475569; margin:0; word-break:break-all;">
          ' . $enlace . '
        </p>
      </div>
      
      <!-- Footer -->
      <p style="font-size:12px; color:#94a3b8; text-align:center; margin:40px 0 0;">
        © 2025 Mi Aplicación. Este es un correo automático, por favor no respondas.
      </p>
    </div>
  </div>
';

                    $mail->send();
                    $mensaje = "Revisa tu correo para restablecer tu contraseña.";
                } catch (Exception $e) {
                    $mensaje = "Error al enviar correo: " . $mail->ErrorInfo;
                }
            } else {
                $mensaje = "El correo ingresado no existe.";
            }

            require 'views/password/mensaje.php';
        }
    }

    // Mostrar formulario de cambio de contraseña
    public function showResetForm()
    {
        $token = $_GET['token'] ?? '';
        require 'views/password/resetear_form.php';
    }

    // Procesar cambio de contraseña
    public function resetPassword()
    {
        $token = $_POST['token'] ?? '';
        $nuevaPassword = $_POST['nueva_password'] ?? '';

        if ($token && $nuevaPassword) {
            $usuario = $this->UsuarioModel->findToken($token);  // Encuentra el usuario por token

            if ($usuario) {
                $hash = password_hash($nuevaPassword, PASSWORD_DEFAULT);  // Crea un hash para la nueva contraseña
                $this->UsuarioModel->UpdatePassword($usuario['id_usuario'], $hash);  // Actualiza la contraseña
                $mensaje = "Contraseña actualizada correctamente.";
            } else {
                $mensaje = "El token es inválido o ha expirado.";
            }

            require 'views/password/mensaje.php';
        }
    }
}
