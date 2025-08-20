<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail
{
    public function sendWelcome($recipient_mail, $recipient_name)
    {
        // Load Composer's autoloader
        require_once __DIR__ . '/../../vendor/autoload.php';

        try {
            $mail = new PHPMailer(true);

            // Server settings
            $mail->SMTPDebug = false;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'paingkyawmoe.pkm555@gmail.com'; // your Gmail
            $mail->Password   = 'ebil zeir eqwo vshq'; // Gmail App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('paingkyawmoe.pkm555@gmail.com', 'elderlycare');
            $mail->addAddress($recipient_mail, $recipient_name);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Welcome to Elderly Care System';

            // Simple HTML email template with SVG icons
            $mail->Body = "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Welcome to Elderly Care System</title>
                <style>
                    body {
                        margin: 0;
                        padding: 0;
                        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        line-height: 1.6;
                        color: #333;
                        background-color: #f4f4f4;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        background-color: #ffffff;
                        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                    }
                    .header {
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        color: white;
                        text-align: center;
                        padding: 30px 20px;
                    }
                    .header h1 {
                        margin: 0;
                        font-size: 24px;
                        font-weight: 400;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 10px;
                    }
                    .header .subtitle {
                        margin: 8px 0 0 0;
                        font-size: 14px;
                        opacity: 0.9;
                    }
                    .content {
                        padding: 30px;
                    }
                    .welcome-message {
                        text-align: center;
                        margin: 20px 0 30px 0;
                    }
                    .welcome-message h2 {
                        margin: 0 0 10px 0;
                        font-size: 20px;
                        font-weight: 500;
                        color: #667eea;
                    }
                    .welcome-message p {
                        margin: 0;
                        font-size: 16px;
                        color: #666;
                    }
                    .features {
                        margin: 25px 0;
                    }
                    .feature {
                        display: flex;
                        align-items: center;
                        margin: 15px 0;
                        padding: 15px;
                      
                        border-radius: 6px;
                        border-left: 3px solid #667eea;
                    }
                    .feature-icon {
                        width: 35px;
                        height: 35px;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin-right: 15px;
                        flex-shrink: 0;
                    }
                    .feature-text h3 {
                        margin: 0 0 3px 0;
                        font-size: 16px;
                        color: #333;
                        font-weight: 500;
                    }
                    .feature-text p {
                        margin: 0;
                        color: #666;
                        font-size: 14px;
                    }
                    .footer {
                        background-color: #f8f9fa;
                        padding: 20px;
                        text-align: center;
                        border-top: 1px solid #e9ecef;
                    }
                    .footer p {
                        margin: 3px 0;
                        color: #666;
                        font-size: 13px;
                    }
                    @media (max-width: 600px) {
                        .container {
                            margin: 0;
                            width: 100%;
                        }
                        .content {
                            padding: 20px;
                        }
                        .header {
                            padding: 25px 15px;
                        }
                        .feature {
                            flex-direction: column;
                            text-align: center;
                        }
                        .feature-icon {
                            margin: 0 0 10px 0;
                        }
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <!-- Header -->
                    <div class='header'>
                        <h1>
                             &nbsp;&nbsp; Elderly Care System
                        </h1>
                        <p class='subtitle'>Compassionate Care for Your Loved Ones</p>
                    </div>
                    
                    <!-- Main Content -->
                    <div class='content'>
                        <div class='welcome-message'>
                            <h2>Welcome, $recipient_name!</h2>
                            <p>We're thrilled to have you join our caring community.</p>
                        </div>
                        
                        <p style='font-size: 15px; color: #555; margin: 20px 0; text-align: center;'>
                            Thank you for choosing our Elderly Care System. We're committed to providing you with the best tools and support to ensure quality care for your elderly loved ones.
                        </p>
                        
                        <div class='features'>
                            <div class='feature'>
                                <div class='feature-icon'>
                                    &#x1F4F1;
                                </div>
                                <div class='feature-text'>
                                    <h3>Easy to Use</h3>
                                    <p>Intuitive interface designed with seniors and caregivers in mind</p>
                                </div>
                            </div>
                            
                            <div class='feature'>
                                <div class='feature-icon'>
                                    &#x1F512;
                                </div>
                                <div class='feature-text'>
                                    <h3>Secure & Private</h3>
                                    <p>Your data is protected with industry-standard security measures</p>
                                </div>
                            </div>
                            
                            <div class='feature'>
                                <div class='feature-icon'>
                                    &#x2764;&#xFE0F;
                                </div>
                                <div class='feature-text'>
                                    <h3>24/7 Support</h3>
                                    <p>Our caring team is always here to help when you need us</p>
                                </div>
                            </div>
                        </div>
                        
                        <p style='color: #666; font-size: 14px; margin: 25px 0; padding: 15px; background-color: #f8f9fa; border-radius: 6px; text-align: center;'>
                            <strong>Need help getting started?</strong><br>
                            Our support team is ready to assist you.<br>
                            Email: support@elderlycare.com | Phone: 09750231601
                        </p>
                    </div>
                    
                    <!-- Footer -->
                    <div class='footer'>
                        <p><strong>Elderly Care System</strong></p>
                        <p>123 Care Street, Health City, HC 12345</p>
                        <p>Phone: 09750231601 | Email: info@elderlycare.com</p>
                        <p style='margin-top: 15px; font-size: 12px;'>
                            © 2025 Elderly Care System. All rights reserved.
                        </p>
                    </div>
                </div>
            </body>
            </html>";

            // Plain text alternative for non-HTML email clients
            $mail->AltBody = "Hi $recipient_name,

Welcome to Elderly Care System!

We're thrilled to have you join our caring community. Your journey towards better elderly care starts here.

Thank you for choosing our Elderly Care System. We're committed to providing you with the best tools and support to ensure quality care for your elderly loved ones.

Key Features:
- Easy to Use: Intuitive interface designed with seniors and caregivers in mind
- Secure & Private: Your data is protected with industry-standard security measures  
- 24/7 Support: Our caring team is always here to help when you need us

Need help getting started?
Our support team is ready to assist you. Contact us at support@elderlycare.com or call (555) 123-4567.

Best regards,
The Elderly Care Team

Elderly Care System
123 Care Street, Health City, HC 12345
Phone: 09750231601 | Email: info@elderlycare.com";

            return $mail->send();
        } catch (Exception $e) {
            error_log("Mailer Error: {$mail->ErrorInfo}");
            return false;
        }
    }
}
