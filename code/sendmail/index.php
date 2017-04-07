<?php
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = "smtp.gmail.com"; // specify main and backup server
$mail->Port = 587; // set the port to use
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->SMTPSecure = 'tls';
$mail->Username = ""; // your SMTP username or your gmail username
$mail->Password = ""; // your SMTP password or your gmail password

$mail->setFrom('admin@pif.vn', 'Passion Investment');
$mail->addAddress('thele@ecpvn.com', 'The Le');     // Add a recipient
$mail->addAddress('quangthe2104@gmail.com');               // Name is optional
$mail->addAddress('admin@pif.vn');               // Name is optional
$mail->addReplyTo('admin@pif.vn', 'Passion Investment');
$mail->addCC('test@lac.edu.vn');
$mail->addCC('test@gmhn.edu.vn');
$mail->addCC('test@cokhi19-8.vn');

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
