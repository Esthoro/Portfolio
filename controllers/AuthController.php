<?php

use App\DB;

require_once 'functions.php';
require_once 'C:\xampp\htdocs\PortfolioGit\public\assets\vendor\autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_POST = cleanRequest($_POST);

    if (isset ($_POST['login']) && isset ($_POST['password'])) {
        if (verifyPerson($_POST['login'], $_POST['password'])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['pseudo'] = $_POST['login'];
            header('Location: /PortfolioGit/mon-compte/');
            exit;
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect";
        }
    }

}
function isConnected() {
    if (isset($_SESSION['loggedin']) && isset($_SESSION['pseudo'])) {
        $connected = true;
    } else {
        $connected = false;
    }
    return $connected;
}

function verifyPerson($pseudo, $mdp) {
        $sql = 'SELECT * FROM person
            WHERE pseudo = :pseudo
            AND password = :password';
        $params = array(
            ':pseudo' => $pseudo,
            ':password' => $mdp
        );
        if ($result = DB::exec($sql, $params)) {
           if ($result->rowCount() == 1) {
               return true;
           }
        }
    return false;
}

//Affichage de la page 'Mon Compte'
function myAccount() {
    $person = showPersonByLogin($_SESSION['pseudo']);
    require ('views/mon-compte.php');
}

//Affichage de la page de connexion
function connexion() {
    require ('views/connexion.php');
}

function showPersonByLogin($login) {
        $sql = 'SELECT * FROM person
                WHERE pseudo = :pseudo';
        $params = array(
            ':pseudo' => $login
        );
        if ($result = DB::exec($sql)) {
            return $result->fetchAll(\PDO::FETCH_OBJ);
        }
    return [];
}