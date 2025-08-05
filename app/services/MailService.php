<?php
namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    protected PHPMailer $mail;
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config['smtp'];

        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host       = $this->config['host'];
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = $this->config['user'];
        $this->mail->Password   = $this->config['pass'];
        $this->mail->SMTPSecure = $this->config['secure'];
        $this->mail->Port       = $this->config['port'];
        $this->mail->setFrom($this->config['from'], $this->config['fromName']);
        $this->mail->isHTML(true);
    }

    public function send(string $to, string $subject, string $view, array $params = []): bool
    {
        try {
            $this->mail->clearAllRecipients();
            $this->mail->addAddress($to);
            $this->mail->Subject = $subject;

            // Renderiza la plantilla de correo
            ob_start();
            extract($params, EXTR_SKIP);
            require __DIR__ . "/../../views/emails/{$view}.php";
            $this->mail->Body = ob_get_clean();

            return $this->mail->send();
        } catch (Exception $e) {
            error_log("MailService Error: {$e->getMessage()}");
            return false;
        }
    }
}
