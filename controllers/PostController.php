<?php

require_once 'functions.php';
require_once 'C:\xampp\htdocs\PortfolioGit\public\assets\vendor\autoload.php';

use App\DB;
use App\Post;

if ($_SERVER["REQUEST_METHOD"] == "POST" ||$_SERVER["REQUEST_METHOD"] == "GET" ) {

    $_POST = cleanRequest($_POST);
    $_GET = cleanRequest($_GET);

    $Post = new Post();

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

//Création post
    if (isset($_POST['title']) && isset($_POST['auteur']) && isset($_POST['chapo']) && isset($_POST['content']) && isset($_POST['ADDPOST']) && $_POST['ADDPOST'] == 'OK') {

        $createdPost = 'false';

        $Post->setTitle($_POST['title']);
        $Post->setChapo($_POST['chapo']);
        $Post->setContent($_POST['content']);
        $Post->setAuthorId($_POST['auteur']);

        if ($Post->create()) {
            $createdPost = 'true';
        }
        setcookie("createdPost", $createdPost, [
            'expires' => time() + 60,
            'path' => '/',
            'secure' => false,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
        header('Location: /PortfolioGit/admin/#createPostForm');
    }

//Modification post
    if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['chapo']) && isset($_POST['content']) && isset($_POST['UPDATEPOST']) && $_POST['UPDATEPOST'] == 'OK') {

        $updatedPost = 'false';

        $Post->setId($_POST['id']);
        $Post->setTitle($_POST['title']);
        $Post->setChapo($_POST['chapo']);
        $Post->setContent($_POST['content']);

        if ($Post->update()) {
            $updatedPost = 'true';
        }
        setcookie("updatedPost", $updatedPost, [
            'expires' => time() + 60,
            'path' => '/',
            'secure' => false,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
        header('Location: /PortfolioGit/admin/#listPostsAdmin');
    }

//Suppression post
    if (isset($_GET['id']) && isset($_GET['DELETEPOST']) && $_GET['DELETEPOST'] == 'OK') {
        if (isConnected() && isAdmin()) {
            $deletedPost = 'false';
            $Post->setId($_GET['id']);
            if ($Post->delete()) {
                $deletedPost = 'true';
            }
            setcookie("deletedPost", $deletedPost, [
                'expires' => time() + 60,
                'path' => '/',
                'secure' => false,
                'httponly' => true,
                'samesite' => 'Strict'
            ]);
            header('Location: /PortfolioGit/admin/#listPostsAdmin');
        }
    }

}