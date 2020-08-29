<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
//require 'PHPMailer/src/PHPMailerAutoload.php';
require 'PHPMailer/src/SMTP.php';

$email = 'patilvrushabh1008@gmail.com';
$password = 'patil27vrushabh';
$to_id = "vrushabh.patil@vabinformatics.com";
$message="This is test message.";
$subject = 'Welcome To EXIM BNI';
    
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = $email;
$mail->Password = $password;
$mail->SetFrom($email);
$mail->Subject = "Test";
$mail->Body = "hello";
$mail->AddAddress($to_id);

 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    echo "Message has been sent";
 }
?>