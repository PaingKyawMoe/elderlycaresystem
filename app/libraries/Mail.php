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
    <title>Email Verification - Elderly Care System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            line-height: 1.6;
        }
        
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .header {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            padding: 30px 20px;
            text-align: center;
            color: white;
        }
        
        .header h1 {
            font-size: 24px;
            font-weight: 300;
            margin-bottom: 8px;
        }
        
        .header p {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .content {
            padding: 40px 30px;
        }
        
        .greeting {
            font-size: 20px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 500;
        }
        
        .message {
            color: #666;
            margin-bottom: 25px;
            font-size: 16px;
        }
        
        .otp-section {
            background: linear-gradient(135deg, #f8f9ff 0%, #e8f2ff 100%);
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            margin: 30px 0;
            border-left: 4px solid #4CAF50;
        }
        
        .otp-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .otp-code {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
            margin-bottom: 10px;
        }
        
        .otp-validity {
            font-size: 12px;
            color: #999;
        }
        
        .divider {
            text-align: center;
            margin: 30px 0;
            position: relative;
        }
        
        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e0e0e0;
        }
        
        .divider span {
            background: white;
            padding: 0 15px;
            color: #999;
            font-size: 14px;
        }
        
        .btn-container {
            text-align: center;
            margin: 30px 0;
        }
        
        .verify-btn {
            display: inline-block;
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white !important;
            padding: 15px 35px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .verify-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
        }
        
        .warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin: 25px 0;
            color: #856404;
            font-size: 14px;
        }
        
        .footer {
            background: #f8f9fa;
            padding: 25px 30px;
            border-top: 1px solid #e9ecef;
            color: #666;
            font-size: 14px;
        }
        
        .signature {
            margin-top: 20px;
            font-weight: 500;
            color: #333;
        }
        
        .company-info {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #e9ecef;
            font-size: 12px;
            color: #999;
        }
        
        /* Responsive Design */
        @media only screen and (max-width: 600px) {
            body {
                padding: 10px;
            }
            
            .content {
                padding: 25px 20px;
            }
            
            .header {
                padding: 25px 15px;
            }
            
            .otp-code {
                font-size: 24px;
                letter-spacing: 4px;
            }
            
            .verify-btn {
                padding: 12px 25px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class='email-wrapper'>
        <!-- Header Section -->
        <div class='header'>
            <h1>Elderly Care System</h1>
            <p>Your trusted healthcare companion</p>
        </div>
        
        <!-- Main Content -->
        <div class='content'>
            <div class='greeting'>Hello $recipient_name,</div>
            
            <p class='message'>
                Welcome to <strong>Elderly Care System</strong>! We're excited to have you join our community dedicated to providing exceptional care and support.
            </p>
            
            <p class='message'>
                To complete your registration and secure your account, please verify your email address using one of the methods below:
            </p>
            
            <!-- OTP Section -->
            <div class='otp-section'>
                <div class='otp-label'>Your Verification Code</div>
                <div class='otp-code'>$otp</div>
                <div class='otp-validity'>⏱️ Valid for 10 minutes only</div>
            </div>
            
            <div class='divider'>
                <span>OR</span>
            </div>
            
            <!-- Button Section -->
            <div class='btn-container'>
                <a href='$verifyLink' class='verify-btn'>✓ Verify My Account</a>
            </div>
            
            <!-- Warning -->
            <div class='warning'>
                <strong>🛡️ Security Notice:</strong> If you didn't create an account with Elderly Care System, please ignore this email. Your security is our priority.
            </div>
        </div>
        
        <!-- Footer -->
        <div class='footer'>
            <div class='signature'>
                Best regards,<br>
                <strong>The Elderly Care Team</strong>
            </div>
            
            <div class='company-info'>
                This email was sent from an automated system. Please do not reply to this email.<br>
                For support, contact us at support@elderlycare.com
            </div>
        </div>
    </div>
</body>
</html>";

            $mail->AltBody = "Hi $recipient_name,

Welcome to Elderly Care System!

Thank you for registering with us. To complete your registration, please verify your email address.

Your verification code: $otp
(This code is valid for 10 minutes only)

Alternatively, you can verify instantly by clicking this link:
$verifyLink

SECURITY NOTICE: If you didn't create an account with Elderly Care System, please ignore this email.

Best regards,
The Elderly Care Team

---
This is an automated email. For support, contact us at support@elderlycare.com";

            return $mail->send();
        } catch (Exception $e) {
            error_log("Mailer Error: {$mail->ErrorInfo}");
            return false;
        }
    }
}
