<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendEmail($recipientEmail,  $subject, $message,)
{
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = getenv('SMTP_HOST'); // Read SMTP host from environment
    $mail->Port = getenv('SMTP_PORT'); // Read SMTP port from environment
    $mail->SMTPAuth = true;
    $mail->Username = getenv('SMTP_USERNAME'); // Read SMTP username from environment
    $mail->Password = getenv('SMTP_PASSWORD'); // Read SMTP password from environment
    $mail->setFrom(getenv('SMTP_FROM_EMAIL'), getenv('SMTP_FROM_NAME')); // Read sender email and name from environment
    $mail->addAddress($recipientEmail); // Set the recipient email
    $mail->Subject = $subject; // Set the email subject
    $mail->Body = $message; // Set the email body

    if (!$mail->send()) {
        return 'Error sending email: ' . $mail->ErrorInfo;
    } else {
        return 'Email sent successfully!';
    }
}
