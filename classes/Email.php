<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email {
    public $nombre;
    public $email;
    public $token;

    public function __construct($nombre, $email, $token) {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = $_ENV['MAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV['MAIL_PORT'];
            $mail->Username = $_ENV['MAIL_USERNAME'];
            $mail->Password = $_ENV['MAIL_PASSWORD'];

            // Configuración del email
            $mail->setFrom('cuentas@cosmetica.com', 'Cosmética');
            $mail->addAddress($this->email, $this->nombre);
            $mail->Subject = 'Confirma tu cuenta';

            // Habilitar HTML en el email
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Contenido del email
            $contenido = "<html>";
            $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>, has creado una cuenta en Cosmética. Solo debes confirmar presionando el siguiente enlace:</p>";
            $contenido .= "<p>Presiona aquí: <a href='". $_ENV['APP_URL'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar cuenta</a></p>";
            $contenido .= "<p>Si tú no solicitaste esta cuenta, puedes ignorar este mensaje.</p>";
            $contenido .= "</html>";

            $mail->Body = $contenido;

            // Enviar el email
            $mail->send();
        } catch (Exception $e) {
            echo "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function enviarInstrucciones() {
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = $_ENV['MAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV['MAIL_PORT'];
            $mail->Username = $_ENV['MAIL_USERNAME'];
            $mail->Password = $_ENV['MAIL_PASSWORD'];

            // Configuración del email
            $mail->setFrom('cuentas@cosmetica.com', 'Cosmética');
            $mail->addAddress($this->email, $this->nombre);
            $mail->Subject = 'Restablecer password';

            // Habilitar HTML en el email
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Contenido del email
            $contenido = "<html>";
            $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>, has solicitado restablecer su password. Sigue el siguiente enlace para hacerlo:</p>";
            $contenido .= "<p>Presiona aquí: <a href='". $_ENV['APP_URL'] . "/recuperar?token=" . $this->token . "'>Restablece password</a></p>";
            $contenido .= "<p>Si tú no solicitaste esta cuenta, puedes ignorar este mensaje.</p>";
            $contenido .= "</html>";

            $mail->Body = $contenido;

            // Enviar el email
            $mail->send();
        } catch (Exception $e) {
            echo "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

?>