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
  $mail->Username   = 'nisedraina999@gmail.com';
  $mail->Password   = 'ckgt scon axrt czpu';
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port       = 587;


  $mail->setFrom($_POST['email'], 'Message via ton portfolio');
  $mail->addAddress('nisedraina999@gmail.com');
  $mail->addReplyTo($_POST['email'], $_POST['name']);

  $mail->isHTML(true);
  $mail->Subject = "Contact Form Submission from: {$_POST['name']}";
  $mail->Body    = "<h3>Nom : {$_POST['name']}</h3><br>
                    <h3>Email : {$_POST['email']}</h3><br>
                    <h3>Objet : {$_POST['phone']}</h3><br>
                    <h3>Message : {$_POST['message']}</h3><br>";

  $mail->send();
  echo 'success';
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
