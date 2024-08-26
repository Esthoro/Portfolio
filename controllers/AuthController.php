<?php

require_once 'functions.php';
require_once 'C:\xampp\htdocs\PortfolioGit\public\assets\vendor\autoload.php';

use App\DB;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_POST = cleanRequest($_POST);

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset ($_POST['login']) && isset ($_POST['password'])) {
        if ($personId = verifyPerson($_POST['login'], $_POST['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['pseudo'] = $_POST['login'];
            $_SESSION['personId'] = $personId;
            header('Location: /PortfolioGit/');
            exit;
        } else {
            setcookie("errorLogin", 'true', [
                'expires' => time() + 60,
                'path' => '/',
                'secure' => false,
                'httponly' => true,
                'samesite' => 'Strict'
            ]);
            header('Location: /PortfolioGit/mon-compte/#connexion');
            exit();
        }
    }

    if (isset($_POST['DISCONNECT']) && $_POST['DISCONNECT'] === 'OK') {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
            header('Location: /PortfolioGit/');
            exit();
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
            exit();
        }
    }

    if (isset ($_POST['REGISTER']) && $_POST['REGISTER'] == 'OK') {
        if (isset ($_POST['name-registration']) && isset ($_POST['firstname-registration'])
            && isset ($_POST['email-registration']) && isset ($_POST['login-registration'])
        && isset($_POST['password-registration']) && isset($_POST['password-verif-registration'])
        && $_POST['password-registration'] === $_POST['password-verif-registration']) {

            $inscriptionSent = 'false';

            $password = password_hash($_POST['password-registration'], PASSWORD_DEFAULT);

            if (register($_POST['firstname-registration'], $_POST['name-registration'], $_POST['email-registration'], $_POST['login-registration'], $password)) {
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
    exit();
    }

    if (isset ($_POST['personId']) && ($_POST['personId'] == $_SESSION['personId']) && isset ($_POST['UPDATEUSERDATA']) && $_POST['UPDATEUSERDATA'] == 'OK') {
        if (isset ($_POST['name-update']) && isset ($_POST['firstname-update'])
            && isset ($_POST['email-update']) && isset ($_POST['login-update'])) {

            $updateUserData = 'false';

            if (!empty($_POST['password-update']) && !empty($_POST['password-verif-update']) && $_POST['password-update'] === $_POST['password-verif-update']) {
                $password = password_hash($_POST['password-update'], PASSWORD_DEFAULT);
                if (updateUserPassword($_POST['personId'], $password)) {
                    $updateUserData = 'true';
                }
            }
            if (updateUserData($_POST['personId'], $_POST['firstname-update'], $_POST['name-update'], $_POST['email-update'], $_POST['login-update'])) {
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
            exit();
        }
    }

    if (isset ($_POST['DELETEACCOUNT']) && $_POST['DELETEACCOUNT'] == 'OK') {
        if($personId = $_SESSION['personId']) {
            if (deleteUser($personId)) {
                if (session_status() == PHP_SESSION_ACTIVE) {
                    session_unset();
                    session_destroy();
                    header('Location: /PortfolioGit/');
                    exit();
                }
            }
        };
    }
}

function verifyPerson($pseudo, $mdp) {
    $sql = 'SELECT * FROM person WHERE pseudo = :pseudo
            AND statut = 1';
    $params = array(':pseudo' => $pseudo);
    if ($result = DB::exec($sql, $params)) {
        if ($result->rowCount() == 1) {
            $user = $result->fetch(\PDO::FETCH_OBJ);
            if (password_verify($mdp, $user->password)) {
                return $user->id;
            }
        }
    }
    return false;
}

function myAccount() {
    $lastPostsForFooter = showLastPosts(5);
    $person = showPersonByLogin($_SESSION['pseudo'])[0];
    $allUsers = showAllUsers();
    $myComments = showCommentsByUser($_SESSION['personId']);
    $allNonValidComments = showAllInvalidComments();
    require ('views/mon-compte.php');
}
function connexion() {
    $lastPostsForFooter = showLastPosts(5);
    require ('views/connexion.php');
}
function admin() {
    $allPosts = showAllPosts();
    $author = showPersonByLogin($_SESSION['pseudo'])[0];
    $lastPostsForFooter = showLastPosts(5);
    require ('views/admin.php');
}

function register($firstName, $surname, $email, $pseudo, $password) {
    $sql = 'INSERT INTO person (first_name, surname, email, pseudo, password, role, statut)
                VALUES (:first_name, :surname, :email, :pseudo, :password, 1, 0)';
    $params = array(
        ':first_name' => $firstName,
        ':surname' => $surname,
        ':email' => $email,
        ':pseudo' => $pseudo,
        ':password' => $password
    );

    if (!DB::exec($sql, $params)) {
        return false;
    }
    return true;
}

function showAllUsers() {
    $sql = 'SELECT * FROM person
            ORDER BY pseudo';
    if ($result = DB::exec($sql)) {
        return $result->fetchAll(PDO::FETCH_OBJ);
    }
    return [];
}

function showAllInvalidComments() {
    $sql = 'SELECT comment.*, person.pseudo
        FROM comment
        LEFT JOIN person
        ON comment.author_id = person.id
        WHERE comment.statut = 0
        ORDER BY comment.edited_at DESC';
    if ($result = DB::exec($sql)) {
        return $result->fetchAll(PDO::FETCH_OBJ);
    }
    return [];
}

function updateUserData($id, $firstName, $name, $email, $pseudo) {
    $sql = 'UPDATE person
        SET first_name = :firstName,
            surname = :surname,
            email = :email,
            pseudo = :pseudo
        WHERE id = :id';
    $params = array(
        ':firstName' => $firstName,
        ':surname' => $name,
        ':email' => $email,
        ':pseudo' => $pseudo,
        ':id' => $id
    );

    if (!DB::exec($sql, $params)) {
        return false;
    }
    return true;
}
function updateUserPassword($id, $password) {
    $sql = 'UPDATE person
        SET password = :password
        WHERE id = :id';
    $params = array(
        ':password' => $password,
        ':id' => $id
    );

    if (!DB::exec($sql, $params)) {
        return false;
    }
    return true;
}
function deleteUser($id) {
    $sql = 'DELETE FROM person
       WHERE id = :id';
    $params = array(
        ':id' => $id
    );
    if (!DB::exec($sql, $params)) {
        return false;
    }
    return true;
}

function showCommentsByUser($userId) {
    if (is_numeric($userId)) {
        $sql = 'SELECT comment.*, post.title
                FROM comment
                LEFT JOIN post
                ON comment.post_id = post.id
                WHERE comment.author_id = :userId';
        $params = array(':userId' => $userId);
        if ($result = DB::exec($sql, $params)) {
            return $result->fetchAll(\PDO::FETCH_OBJ);
        }
    }
    return [];
}