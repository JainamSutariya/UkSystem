<?php
   require 'vendor/autoload.php';
   use PHPMailer\PHPMailer\PHPMailer;
   $mail = new PHPMailer;
   $mail->isSMTP();
   $mail->SMTPDebug = 2;
   $mail->Host = 'smtp.hostinger.com';
   $mail->Port = 465;
   $mail->SMTPAuth = true;
   $mail->Username = 'advance@advancegroup.co.in';
   $mail->Password = 'AdPrivaTe123++';
   $mail->setFrom('advance@advancegroup.co.in', 'Your Name');
   $mail->addReplyTo('advance@advancegroup.co.in', 'Your Name');
   $mail->addAddress('milankakadiya29@gmail.com', 'Receiver Name');
   $mail->Subject = 'Checking if PHPMailer works';
   $mail->msgHTML('');
   $mail->Body = 'This is just a plain text message body';
   //$mail->addAttachment('attachment.txt');
   if (!$mail->send()) {
       echo 'Mailer Error: ' . $mail->ErrorInfo;
   } else {
       echo 'The email message was sent.';
   }
?>
