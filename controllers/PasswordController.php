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
                    $mail->Body = "Haz clic para restablecer tu contraseña: <a href='$enlace'>$enlace</a>";

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
