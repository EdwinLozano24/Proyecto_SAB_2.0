<?php
require_once __DIR__ . '/../models/UsuarioModel.php';
require_once __DIR__ . '/../app/services/MailService.php';


use app\services\MailService;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
date_default_timezone_set('America/Bogota');

class PasswordController
{
    private UsuarioModel $usuarioModel;
    private MailService $mailer;
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->usuarioModel = new UsuarioModel();
        $this->mailer = new MailService($this->config);
    }

    public function sendResetLink()
    {
        $correo = $_POST['email'] ?? '';
        if (! $correo) {
            $mensaje = "Ingresa un correo válido.";
            return require __DIR__ . '/../views/.general/password/mensaje.php';
        }

        $usuario = $this->usuarioModel->findCorreo($correo);
        if (! $usuario) {
            $mensaje = "El correo no existe.";
            require($_SERVER['DOCUMENT_ROOT'] . '/views/.general/password/mensaje.php');
            exit;
        }

        $token  = bin2hex(random_bytes(32));
        $expira = date("Y-m-d H:i:s", strtotime("+8 hour"));
        $this->usuarioModel->saveToken($usuario['id_usuario'], $token, $expira);

        $enlace = $this->config['app_url']
                . "/index.php?action=showResetForm&token={$token}";

        $sent = $this->mailer->send(
            $correo,
            'Recupera tu contraseña',
            'reset_password',
            ['enlace' => $enlace, 'usuario' => $usuario]
        );

        $mensaje = $sent
            ? "Revisa tu correo para restablecer tu contraseña."
            : "No se pudo enviar el correo. Intenta más tarde.";

        require($_SERVER['DOCUMENT_ROOT'] . '/views/.general/password/mensaje.php');
        // require __DIR__ . '/../views/password/mensaje.php';
    }

    public function showResetForm()
    {
        $token = $_GET['token'] ?? '';
        require($_SERVER['DOCUMENT_ROOT'] . '/views/.general/password/resetear_form.php');
        // require __DIR__ . '/../views/password/resetear_form.php';
    }

    public function resetPassword()
    {
        $token         = $_POST['token'] ?? '';
        $nuevaPassword = $_POST['nueva_password'] ?? '';

        if (! $token || ! $nuevaPassword) {
            $mensaje = "Datos incompletos.";
            return require __DIR__ . '/../views/.general/password/mensaje.php';
        }

        $usuario = $this->usuarioModel->findToken($token);
        if (! $usuario) {
            $mensaje = "El token es inválido o ha expirado.";
            require($_SERVER['DOCUMENT_ROOT'] . '/views/.general/password/mensaje.php');
            return;
        }

        $hash = password_hash($nuevaPassword, PASSWORD_DEFAULT);
        $this->usuarioModel->updatePassword($usuario['id_usuario'], $hash);

        $mensaje = "Contraseña actualizada correctamente.";
        require($_SERVER['DOCUMENT_ROOT'] . '/views/.general/password/mensaje.php');
    }
}
