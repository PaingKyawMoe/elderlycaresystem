<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail
{
    public function sendResetPassword($recipient_mail, $recipient_name, $token)
    {
        require_once __DIR__ . '/../../vendor/autoload.php';

        try {
            $mail = new PHPMailer(true);

            // Server settings
            $mail->SMTPDebug = false;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'paingkyawmoe.pkm555@gmail.com';
            $mail->Password   = 'ebil zeir eqwo vshq'; // Gmail App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('paingkyawmoe.pkm555@gmail.com', 'Elderly Care');
            $mail->addAddress($recipient_mail, $recipient_name);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';

            $resetLink = URLROOT . "/auth/resetPassword?token=$token";

            $mail->Body = "
        <p>Hi $recipient_name,</p>
        <p>We received a request to reset your password.</p>
        <p>Click the link below to reset your password (valid for 1 hour):</p>
        <p><a href='$resetLink'>$resetLink</a></p>
        <p>If you did not request this, please ignore this email.</p>
        <p>Regards,<br>Elderly Care System</p>
        ";

            $mail->AltBody = "Hi $recipient_name,\n\n"
                . "We received a request to reset your password.\n"
                . "Click the link below to reset your password (valid for 1 hour):\n"
                . "$resetLink\n\n"
                . "If you did not request this, please ignore this email.\n\n"
                . "Regards,\nElderly Care System";

            return $mail->send();
        } catch (Exception $e) {
            error_log("Mailer Error: {$mail->ErrorInfo}");
            return false;
        }
    }


    public function sendVerifyMail($recipient_mail, $recipient_name, $otp, $verifyLink)
    {
        require_once __DIR__ . '/../../vendor/autoload.php';

        try {
            $mail = new PHPMailer(true);

            // Server settings
            $mail->SMTPDebug = false;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'paingkyawmoe.pkm555@gmail.com';
            $mail->Password   = 'ebil zeir eqwo vshq'; // Gmail App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('paingkyawmoe.pkm555@gmail.com', 'Elderly Care');
            $mail->addAddress($recipient_mail, $recipient_name);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Verify your Elderly Care Account';

            $mail->Body = "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Email Verification</title>
            <style>
                body { font-family: Arial, sans-serif; background-color: #f9f9f9; padding:20px; }
                .container { background:#fff; padding:20px; border-radius:8px; box-shadow:0 2px 5px rgba(0,0,0,.1); max-width:600px; margin:auto; }
                .btn { display:inline-block; background:#28a745; color:#fff; padding:10px 20px; text-decoration:none; border-radius:5px; }
                .otp { font-size:18px; font-weight:bold; color:#333; }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>Hi $recipient_name,</h2>
                <p>Thank you for registering with <strong>Elderly Care System</strong>.</p>
                <p>Please verify your account using the OTP below (valid for 10 minutes):</p>
                <p class='otp'>$otp</p>
                <p>Or click the button below to verify instantly:</p>
                <p><a href='$verifyLink' class='btn'>Verify My Account</a></p>
                <br>
                <p>If you did not request this, please ignore this email.</p>
                <p>Regards,<br>Elderly Care Team</p>
            </div>
        </body>
        </html>";

            $mail->AltBody = "Hi $recipient_name,\n\n"
                . "Thank you for registering with Elderly Care System.\n"
                . "Your OTP: $otp (valid for 10 minutes).\n\n"
                . "Or click this link to verify: $verifyLink\n\n"
                . "If you did not request this, ignore this email.\n\n"
                . "Regards,\nElderly Care Team";

            return $mail->send();
        } catch (Exception $e) {
            error_log("Mailer Error: {$mail->ErrorInfo}");
            return false;
        }
    }
}
