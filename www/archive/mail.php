<?php

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.sendgrid.net';
$mail->Port = 587; // Gmail's SMTP port
$mail->SMTPAuth = true;
$mail->Username = 'apikey'; // Your Gmail email address
$mail->Password = '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'; // Your Gmail password
$mail->setFrom('vivekfaujdar06@gmail.com', 'Anubhav'); // Set the sender email and name
$mail->addAddress('arnavprajapati@gmail.com', 'Anubhav'); // Set the recipient email and name
$mail->Subject = 'Test Email'; // Set the email subject
$mail->Body = 'This is a test email sent using PHPMailer.'; // Set the email body

if (!$mail->send()) {
    echo 'Error sending email: ' . $mail->ErrorInfo;
} else {
    echo 'Email sent successfully!';
}
