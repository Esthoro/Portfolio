<?php

require_once 'functions.php';
require_once 'C:\xampp\htdocs\PortfolioGit\public\assets\vendor\autoload.php';

use App\Comment;
use App\Person;
use App\Post;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_POST = cleanRequest($_POST);
    $_SESSION = cleanRequest($_SESSION);

    $Comment = new Comment();
    $User = new Person();

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset ($_POST['login']) && isset ($_POST['password'])) {

        $User->setPseudo($_POST['login']);
        $User->setPassword($_POST['password']);

        if ($personId = $User->verify()) {
            $_SESSION['loggedin'] = 'true';
            $_SESSION['pseudo'] = $_POST['login'];
            $_SESSION['personId'] = $personId;
            header('Location: /PortfolioGit/');
        } else {
            setcookie("errorLogin", 'true', [
                'expires' => time() + 60,
                'path' => '/',
                'secure' => false,
                'httponly' => true,
                'samesite' => 'Strict'
            ]);
            header('Location: /PortfolioGit/mon-compte/#connexion');
        }
    }

    if (isset($_POST['DISCONNECT']) && $_POST['DISCONNECT'] === 'OK') {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
            header('Location: /PortfolioGit/');
        }
        else {
            setcookie("errorLogout", 'true', [
                'expires' => time() + 60,
                'path' => '/',
                'secure' => false,
                'httponly' => true,
                'samesite' => 'Strict'
            ]);
            header('Location: /PortfolioGit/mon-compte/#logout-form');
        }
    }

    if (isset ($_POST['REGISTER']) && $_POST['REGISTER'] == 'OK') {
        if (isset ($_POST['name-registration']) && isset ($_POST['firstname-registration'])
            && isset ($_POST['email-registration']) && isset ($_POST['login-registration'])
        && isset($_POST['password-registration']) && isset($_POST['password-verif-registration'])
        && $_POST['password-registration'] === $_POST['password-verif-registration']) {

            $inscriptionSent = 'false';

            $password = password_hash($_POST['password-registration'], PASSWORD_DEFAULT);

            $User->setFirstname($_POST['firstname-registration']);
            $User->setSurname($_POST['name-registration']);
            $User->setEmail($_POST['email-registration']);
            $User->setPseudo($_POST['login-registration']);
            $User->setPassword($password);
            $User->setRole(1);

            if ($User->register()) {
                $message = 'Bonjour ! ' . $_POST['firstname-registration'] . ' ' . $_POST['name-registration'] . ' veut s\'inscrire sur le blog.';
                $message .= ' Voici son login : ' . $_POST['login-registration'] . ' . Bonne journée !';

                if (sendMail($_POST['name-registration'], $_POST['email-registration'], 'Demande d\'inscription', $message)) {
                    $inscriptionSent = 'true';
                }
            }
        }
        setcookie("inscriptionSent", $inscriptionSent, [
            'expires' => time() + 60,
            'path' => '/',
            'secure' => false,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
        header('Location: /PortfolioGit/mon-compte/#register-form');
    }

    if (isset ($_POST['personId']) && ($_POST['personId'] == $_SESSION['personId']) && isset ($_POST['UPDATEUSERDATA']) && $_POST['UPDATEUSERDATA'] == 'OK') {
        if (isset ($_POST['name-update']) && isset ($_POST['firstname-update'])
            && isset ($_POST['email-update']) && isset ($_POST['login-update'])) {

            $updateUserData = 'false';

            $User->setId($_POST['personId']);
            $User->setFirstname($_POST['firstname-update']);
            $User->setSurname($_POST['name-update']);
            $User->setEmail($_POST['email-update']);
            $User->setPseudo($_POST['login-update']);

            if (!empty($_POST['password-update']) && !empty($_POST['password-verif-update']) && $_POST['password-update'] === $_POST['password-verif-update']) {
                $password = password_hash($_POST['password-update'], PASSWORD_DEFAULT);
                $User->setPassword($password);
                if ($User->updatePassword()) {
                    $updateUserData = 'true';
                }
            }

            if ($User->updateData()) {
                $_SESSION['pseudo'] = $_POST['login-update'];
                $updateUserData = 'true';
            } else {
                $updateUserData = 'false';
            }
            setcookie("updateUserData", $updateUserData, [
                'expires' => time() + 60,
                'path' => '/',
                'secure' => false,
                'httponly' => true,
                'samesite' => 'Strict'
            ]);
            header('Location: /PortfolioGit/mon-compte/#update-data-form');
        }
    }

    if (isset ($_POST['DELETEACCOUNT']) && $_POST['DELETEACCOUNT'] == 'OK') {
        if ($personId = $_SESSION['personId']) {
            $User->setId($personId);
            if ($User->delete()) {
                if (session_status() == PHP_SESSION_ACTIVE) {
                    session_unset();
                    session_destroy();
                    header('Location: /PortfolioGit/');
                }
            }
        };
    }
}
function myAccount() {

    $Comment = new Comment();
    $Person = new Person();
    $Post = new Post();

    $Comment->setAuthor($_SESSION['personId']);
    $Person->setPseudo($_SESSION['pseudo']);

    $lastPostsForFooter = $Post->showLastPosts(5);
    $person = $Person->showByPseudo();
    $allUsers = $Person->showAll();
    $myComments = $Comment->showByUser();
    $allNonValidComments = $Comment->showAllInvalidComments();
    require ('views/mon-compte.php');
}
function connexion() {
    $Post = new Post();
    $lastPostsForFooter = $Post->showLastPosts(5);
    require ('views/connexion.php');
}
function admin() {
    $Post = new Post();
    $Person = new Person();
    $Person->setPseudo($_SESSION['pseudo']);
    $allPosts = $Post->showAll();
    $author = $Person->showByPseudo();
    $lastPostsForFooter = $Post->showLastPosts(5);
    require ('views/admin.php');
}
