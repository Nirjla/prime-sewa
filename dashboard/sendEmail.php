<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;

require_once 'vendor/autoload.php';

function sendEmail($fromEmail, $fromName, $toEmail, $toName, $subject, $body)
{
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
        $mail->Username = 'shakyanirjala6@gmail.com';   // Update with your email
        $mail->Password = 'gxdw ihop ozxt flvl';       // Update with your app password
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->setFrom($fromEmail, $fromName);
        $mail->addAddress($toEmail, $toName);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        if (!$mail->send()) {
            echo 'Email not sent an error was encountered: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent.';
        }
    } catch (Exception $e) {
        echo 'Email not sent an error was encountered: ' . $e->getMessage();
    }
}
