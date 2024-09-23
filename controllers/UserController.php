<?php

require_once 'functions.php';
require_once 'C:\xampp\htdocs\PortfolioGit\public\assets\vendor\autoload.php';

use App\DB;

if ($_SERVER["REQUEST_METHOD"] == "POST" ||$_SERVER["REQUEST_METHOD"] == "GET" ) {

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isConnected() && isAdmin()) {

        $_POST = cleanRequest($_POST);
        $_GET = cleanRequest($_GET);

        $updatedUser = 'false';

        //Validation utilisateur
        if (isset($_GET['id']) && isset($_GET['VALIDUSER']) && $_GET['VALIDUSER'] == 'OK') {
            if (validUser($_GET['id'], 1)) {
            $updatedUser = 'true';
            }
        }

        //Suppression utilisateur
        if (isset($_GET['id']) && isset($_GET['DELETEUSER']) && $_GET['DELETEUSER'] == 'OK') {
            if (validUser($_GET['id'], 0)) {
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
        header('Location: /PortfolioGit/mon-compte/#listPersonsAdmin');
    }
}

function validUser($id, $statut) {
        $sql = 'UPDATE person
        SET statut = :statut
        WHERE id = :id';
        $params = array(
            ':statut' => $statut,
            ':id' => $id
        );

        if (!DB::exec($sql, $params)) {
            return false;
        }
        return true;
}