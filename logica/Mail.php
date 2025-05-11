<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

class Mail {
    private $msg;
    private $asunto;
    private $correoDestino;
    private $mail;

    public function __construct($correoDestino, $asunto, $msg) {
        $this->correoDestino = $correoDestino;
        $this->asunto = $asunto;
        $this->msg = $msg;
        $this->mail = new PHPMailer(true);
        $this->configurarSMTP();
    }
    private function configurarSMTP() {
        try {
            // Server settings
            $this->mail->SMTPDebug = 0;                      // Disable verbose debug output
            $this->mail->isSMTP();                            // Send using SMTP
            $this->mail->Host = 'smtp.gmail.com';            // Set the SMTP server to send through
            $this->mail->SMTPAuth = true;                     // Enable SMTP authentication
            $this->mail->Username = 'oscaralejandrosoto9@gmail.com'; // SMTP username
            $this->mail->Password = 'lums bflm vqcd ntbu';   // SMTP password (consider using environment variables)
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
            $this->mail->Port = 465;                          // TCP port to connect to

            // Recipients
            $this->mail->setFrom('oscaralejandrosoto9@gmail.com', 'noreply');
            $this->mail->addAddress($this->correoDestino, 'Oscar Soto'); // Add a recipient

            // Content
            $this->mail->isHTML(true);                        // Set email format to HTML
            $this->mail->Subject = $this -> asunto;
            $this->mail->Body = $this->msg;
            $this->mail->AltBody = 'Este es el cuerpo en texto plano para clientes de correo no HTML';

        } catch (Exception $e) {
            echo "Error de configuración: {$this->mail->ErrorInfo}";
        }
    }

    public function enviar() {
        try {
            $this->mail->send();
            // echo 'El mensaje ha sido enviado';
            return true;
        } catch (Exception $e) {
            echo "El mensaje no pudo ser enviado. Error del Mailer: {$this->mail->ErrorInfo}";
            return false;
        }
    }
}

// Ejemplo de uso
// $emailRegistro = new EmailRegistro('destinatario@example.com', '123456');
// $emailRegistro->enviarCorreo();