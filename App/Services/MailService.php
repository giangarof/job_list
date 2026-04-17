<?php 

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Framework\Env;

require __DIR__ . '/../../vendor/autoload.php';

class MailService{

    public static function sendEmail($to, $subject, $body){
        $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = Env::get('SMTP_HOST'); // or Mailgun, SendGrid, etc.
        $mail->SMTPAuth = true;
        $mail->Username = Env::get('SMTP_USER');
        $mail->Password = Env::get('SMTP_PASS');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = Env::get('SMTP_PORT');

        $mail->setFrom(
            Env::get('SMTP_FROM'),
            Env::get('SMTP_NAME')
        );
        $mail->addAddress($to);

        $mail->Subject = $subject;
        $mail->Body = $body;

        return $mail->send();

    } catch (Exception $e) {
        error_log("Mail error: " . $mail->ErrorInfo);
        return false;
    }
    }

}
?>