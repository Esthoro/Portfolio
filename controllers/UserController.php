<?php

require_once 'functions.php';
require_once 'C:\xampp\htdocs\PortfolioGit\public\assets\vendor\autoload.php';

use App\DB;
use App\Person;

if ($_SERVER["REQUEST_METHOD"] == "POST" ||$_SERVER["REQUEST_METHOD"] == "GET" ) {

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isConnected() && isAdmin()) {

        $_POST = cleanRequest($_POST);
        $_GET = cleanRequest($_GET);

        $updatedUser = 'false';

        $User = new Person();

        //Validation utilisateur
        if (isset($_GET['id']) && isset($_GET['VALIDUSER']) && $_GET['VALIDUSER'] == 'OK') {
            $User->setId($_GET['id']);
            $User->setStatus(1);
            if ($User->valid()) {
            $updatedUser = 'true';
            }
        }

        //Suppression utilisateur
        if (isset($_GET['id']) && isset($_GET['DELETEUSER']) && $_GET['DELETEUSER'] == 'OK') {
            $User->setId($_GET['id']);
            $User->setStatus(0);
            if ($User->valid()) {
                $updatedUser = 'true';
            }
        }

        setcookie("updatedUser", $updatedUser, [
            'expires' => time() + 60,
            'path' => '/',
            'secure' => false,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
        header('Location: /mon-compte/#listPersonsAdmin');
    }
}
