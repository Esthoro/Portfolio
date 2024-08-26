<?php

require_once 'functions.php';
require_once 'C:\xampp\htdocs\PortfolioGit\public\assets\vendor\autoload.php';

use App\DB;

if ($_SERVER["REQUEST_METHOD"] == "POST" ||$_SERVER["REQUEST_METHOD"] == "GET" ) {

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isConnected()) {

        $_POST = cleanRequest($_POST);
        $_GET = cleanRequest($_GET);

        //Création commentaire
        if (isset($_POST['commentMessage']) && isset($_POST['postId']) && is_numeric($_POST['postId'])
            && isset($_POST['ADDCOMMENT']) && $_POST['ADDCOMMENT'] == 'OK') {
            $commentAuthorId = showPersonByLogin($_SESSION['pseudo'])[0]->id;
            $commentSent = 'false';
            if (createComment($_POST['postId'], $commentAuthorId, $_POST['commentMessage'])) {
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
            exit();
        }

        // Suppression commentaire
        if (isset($_GET['id']) && isset($_GET['DELETECOMMENT']) && $_GET['DELETECOMMENT'] === 'OK') {
            $deletedComment = 'false';
            if (deleteComment($_GET['id'], $_SESSION['personId'])) {
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
            exit();
        }

        //Validation commentaire
        if (isAdmin()) {

            $updatedComment = 'false';

            //Validation utilisateur
            if (isset($_GET['id']) && isset($_GET['VALIDCOMMENT']) && $_GET['VALIDCOMMENT'] === 'OK') {
                if (validComment($_GET['id'])) {
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
            exit();

        }

    }
}

function createComment ($postId, $authorId, $content) {
    $sql = 'INSERT INTO comment (post_id, author_id, content, statut)
                VALUES (:postId, :authorId, :content, 0)';
    $params = array(
        ':postId' => $postId,
        ':authorId' => $authorId,
        ':content' => $content
    );

    if (!DB::exec($sql, $params)) {
        return false;
    }
    return true;
}

function validComment ($commentId) {
    $sql = 'UPDATE comment
        SET statut = 1
        WHERE id = :commentId';
    $params = array (
        ':commentId' => $commentId
    );
    if (!DB::exec($sql, $params)) {
        return false;
    }
    return true;
}

function deleteComment ($commentId, $userId) {
    if (isAdmin()) {
        $sql = 'DELETE FROM comment
            WHERE id = :commentId';
        $params = array (
            ':commentId' => $commentId
        );
    } else {
        $sql = 'DELETE FROM comment
            WHERE id = :commentId
            AND author_id = :userId';
        $params = array (
            ':commentId' => $commentId,
            ':userId' => $userId
        );
    }
    if (!DB::exec($sql, $params)) {
        return false;
    }
    return true;
}