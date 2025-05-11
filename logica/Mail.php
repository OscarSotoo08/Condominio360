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
    private $correoDestino;
    private $nombreDestino;
    private $mail;

    public function __construct($correoDestino, $nombreDestino, $codigoVerificacion, $usuario) {
        $this->correoDestino = $correoDestino;
        $this->nombreDestino = $nombreDestino;
        $this->msg = $this->crearMensaje($codigoVerificacion, $usuario);
        $this->mail = new PHPMailer(true);
        $this->configurarSMTP();
    }

    public function crearMensaje($codigo, $usuario) {
        $codigo_encode = base64_encode($codigo);
        return  "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Correo de Registro</title>
</head>
<body style='margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333;'>
    <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px; background-color: #fff; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-top: 20px;'>
        <tr>
            <td style='padding: 20px; text-align: center; background-color: #FFC107; border-radius: 10px 10px 0 0;'>
                <img src='https://ltakopulso.wuaze.com/img/image.png' alt='Logo' style='max-width: 100px; border-radius: 50%; object-fit: fill;'/>
            </td>
        </tr>
        <tr>
            <td style='padding: 20px;'>
                <h2 style='text-align: center; color: #FFC107;'>¡Bienvenido a Nuestra Plataforma!</h2>
                <p style='text-align: justify; font-size: 16px; line-height: 1.6;'>
                    Hola <strong>{$this->nombreDestino}</strong>, estamos encantados de que te unas a nuestra plataforma LTA - Kopulso (Learning Taekwondo Application). 
                    Para completar tu registro y comenzar a disfrutar de nuestros servicios, por favor haz clic en el botón de abajo.
                </p>
                <div style='text-align: center; margin: 20px 0;'>
                    <a href='http://localhost/ProyectoTKD/?pid=dWkvc2Vzc2lvbi9wYWdlcy92ZXJpZnlfY29kZS5waHA&Y29kaWdv={$codigo_encode}' style='display: inline-block; background-color: #FFC107; color: #000; text-decoration: none; padding: 12px 20px; font-size: 16px; font-weight: bold; border-radius: 5px; box-shadow: 0 4px 10px rgba(0,0,0,0.2);'>
                        Completar Registro
                    </a>
                </div>
                <p style='text-align: justify; font-size: 14px; line-height: 1.6; color: #666;'>
                    Si no solicitaste este correo, ignóralo. Puedes ponerte en contacto con nosotros si necesitas más información.
                </p>
            </td>
        </tr>
        <tr>
            <td style='padding: 10px; text-align: center; background-color: #f4f4f4; color: #999; font-size: 12px; border-radius: 0 0 10px 10px;'>
                © 2024 LTA - Kopulso. Todos los derechos reservados.
            </td>
        </tr>
    </table>
</body>
</html>
";
    }
    private function configurarSMTP() {
        try {
            // Server settings
            $this->mail->SMTPDebug = 0;                      // Disable verbose debug output
            $this->mail->isSMTP();                            // Send using SMTP
            $this->mail->Host = 'smtp.gmail.com';            // Set the SMTP server to send through
            $this->mail->SMTPAuth = true;                     // Enable SMTP authentication
            $this->mail->Username = 'oscaralejandrosoto9@gmail.com'; // SMTP username
            $this->mail->Password = 'qgyx htqr bwjm farx';   // SMTP password (consider using environment variables)
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
            $this->mail->Port = 465;                          // TCP port to connect to

            // Recipients
            $this->mail->setFrom('oscaralejandrosoto9@gmail.com', 'noreply');
            $this->mail->addAddress($this->correoDestino, 'Oscar Soto'); // Add a recipient

            // Content
            $this->mail->isHTML(true);                        // Set email format to HTML
            $this->mail->Subject = 'Correo desde la app de LTA Kopulso';
            $this->mail->Body = $this->msg;
            $this->mail->AltBody = 'Este es el cuerpo en texto plano para clientes de correo no HTML';

        } catch (Exception $e) {
            echo "Error de configuración: {$this->mail->ErrorInfo}";
        }
    }

    public function enviarCorreo() {
        try {
            $this->mail->send();
            echo 'El mensaje ha sido enviado';
        } catch (Exception $e) {
            echo "El mensaje no pudo ser enviado. Error del Mailer: {$this->mail->ErrorInfo}";
        }
    }
}

// Ejemplo de uso
// $emailRegistro = new EmailRegistro('destinatario@example.com', '123456');
// $emailRegistro->enviarCorreo();