<?php

require_once 'functions.php';
require_once 'C:\xampp\htdocs\PortfolioGit\public\assets\vendor\autoload.php';

use App\Comment;
use App\Person;

if ($_SERVER["REQUEST_METHOD"] == "POST" ||$_SERVER["REQUEST_METHOD"] == "GET" ) {

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $Comment = new Comment();
    $Person = new Person();

    if (isConnected()) {

        $_POST = cleanRequest($_POST);
        $_GET = cleanRequest($_GET);
        $_SESSION = cleanRequest($_SESSION);

        if (isset($_POST['commentMessage']) && isset($_POST['postId']) && is_numeric($_POST['postId'])
            && isset($_POST['ADDCOMMENT']) && $_POST['ADDCOMMENT'] == 'OK') {

            $Person->setPseudo($_SESSION['pseudo']);
            $person = $Person->showByPseudo();
            $commentAuthorId = $person->id;

            $commentSent = 'false';

            $Comment->setPostId($_POST['postId']);
            $Comment->setAuthor($commentAuthorId);
            $Comment->setContent($_POST['commentMessage']);
            $Comment->setStatut(0);

            if ($Comment->create()) {
                $commentSent = 'true';
            }

            setcookie("commentSent", $commentSent, [
                'expires' => time() + 60,
                'path' => '/',
                'secure' => false,
                'httponly' => true, // Non accessible via JavaScript
                'samesite' => 'Strict' // Limite les cookies aux requêtes du même site
            ]);
            header('Location: /PortfolioGit/singlePost/' . $_POST['postId'] . '/#sendComment');
        }

        // Suppression commentaire
        if (isset($_GET['id']) && isset($_GET['DELETECOMMENT']) && $_GET['DELETECOMMENT'] === 'OK') {

            $deletedComment = 'false';

            $Comment->setId($_GET['id']);
            $Comment->setAuthor($_SESSION['personId']);

            if ($Comment->delete()) {
                $deletedComment = 'true';
            }
            setcookie("deletedComment", $deletedComment, [
                'expires' => time() + 60,
                'path' => '/',
                'secure' => false,
                'httponly' => true,
                'samesite' => 'Strict'
            ]);
            header('Location: /PortfolioGit/mon-compte/#listComments');
        }

        //Validation commentaire
        if (isAdmin()) {

            $updatedComment = 'false';

            //Validation utilisateur
            if (isset($_GET['id']) && isset($_GET['VALIDCOMMENT']) && $_GET['VALIDCOMMENT'] === 'OK') {
                $Comment->setId($_GET['id']);
                $Comment->setStatut(1);
                if ($Comment->valid()) {
                    $updatedComment = 'true';
                }
            }

            setcookie("updatedComment", $updatedComment, [
                'expires' => time() + 60,
                'path' => '/',
                'secure' => false,
                'httponly' => true,
                'samesite' => 'Strict'
            ]);
            header('Location: /PortfolioGit/mon-compte/#listCommentsAdmin');
        }

    }
}