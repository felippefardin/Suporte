<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

function enviarEmail($para, $assunto, $mensagem) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.seudominio.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'email@seudominio.com';
        $mail->Password = 'sua_senha';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('email@seudominio.com', 'Suporte');
        $mail->addAddress($para);

        $mail->isHTML(true);
        $mail->Subject = $assunto;
        $mail->Body    = nl2br($mensagem);

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>