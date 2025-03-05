<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {

  // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
  $mail->isSMTP();
  $mail->Host       = 'smtp.gmail.com';
  $mail->SMTPAuth   = true;
  $mail->Username   = 'fundev261@gmail.com';
  $mail->Password   = 'fckh sfqk mxoi tnbu';
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port       = 587;


  $mail->setFrom('fundev261@gmail.com', 'I&N Compagnie');
  $mail->addAddress('andrynante26@gmail.com');
  $mail->addReplyTo($_POST['email'], $_POST['name']);

  $mail->isHTML(true);
  $mail->Subject = "Contact Form Submission from: {$_POST['name']}";
  $mail->Body    = "<h3>Name : {$_POST['name']}</h3><br>
                    <h3>Email : {$_POST['email']}</h3><br>
                    <h3>Phone : {$_POST['phone']}</h3><br>
                    <h3>Message : {$_POST['message']}</h3><br>";

  $mail->send();
  echo 'success';
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
