<?php

require_once 'functions.php';
require_once 'C:\xampp\htdocs\PortfolioGit\public\assets\vendor\autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_POST = cleanRequest($_POST);

    $messageSent = 'false';
    if (!empty ($_POST['name']) && !empty ($_POST['email']) && !empty ($_POST['subject']) && !empty ($_POST['message'])) {
        $subject = 'Formulaire de contact du blog : ' . $_POST['subject'];
        if (sendMail($_POST['name'], $_POST['email'], $subject, $_POST['message'])) {
            $messageSent = 'true';
        }
    } else {
        $messageSent = 'dataLack';
    }
    setcookie("messageSent", $messageSent, [
        'expires' => time() + 60,
        'path' => '/',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
    header('Location: /PortfolioGit/#contactForm');
    exit;
}

function contact() {
    require ('views/contact.php');
}