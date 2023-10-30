<?php
use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

function posti($emailTo,$msg,$subject){
    $mail = new PHPMailer();//
    $mail->isSMTP();//
    $mail->Host = $_ENV['EMAIL_HOST'];
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = $_ENV['EMAIL_USERNAME'];
    $mail->Password = $_ENV['EMAIL_PASSWORD'];

    $emailFrom = $_ENV['EMAIL_ADMIN'];
    $emailFromName = "Lähde";
    $emailToName = "";

    $mail->setFrom($emailFrom, $emailFromName);
    $mail->addAddress($emailTo, $emailToName);
    $mail->Subject = $subject;
    $mail->CharSet = 'UTF-8';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->msgHTML($msg);

    if ($mail->send()) {
        echo 'Sähköposti lähetetty onnistuneesti';
    } else {
        echo 'Sähköpostin lähetys epäonnistui: ' . $mail->ErrorInfo;
    }
}
?>