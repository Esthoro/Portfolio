<?php

require_once 'functions.php';
require_once 'C:\xampp\htdocs\PortfolioGit\public\assets\vendor\autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$_POST = cleanRequest($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset ($_POST['name']) && isset ($_POST['email']) && isset ($_POST['subject']) && isset ($_POST['message'])) {
        sendMail($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']);
    } else {
        echo 'Merci de remplir tous les champs';
    }
}

function contact() {
    require ('views/contact.php');
}

function sendMail($name, $email, $subject, $message) {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPAuth = true;
    $mail->Username = 'esther.portfolio.oc@gmail.com';
    $mail->Password = 'xiynjkbsmzpgnqpv';
    $mail->setFrom('esther.portfolio.oc@gmail.com');

    $mail->addReplyTo($email, $name);

    $mail->addAddress('esthoro28@gmail.com');

    $mail->Subject = $subject;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
    $mail->msgHTML($message);

//Replace the plain text body with one created manually
    $mail->AltBody = $message;

//send the message, check for errors
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
    }
}