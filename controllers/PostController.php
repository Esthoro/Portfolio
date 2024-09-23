<?php

require_once 'functions.php';
require_once 'C:\xampp\htdocs\PortfolioGit\public\assets\vendor\autoload.php';

use App\DB;

if ($_SERVER["REQUEST_METHOD"] == "POST" ||$_SERVER["REQUEST_METHOD"] == "GET" ) {

    $_POST = cleanRequest($_POST);
    $_GET = cleanRequest($_GET);

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

//Création post
    if (isset($_POST['title']) && isset($_POST['auteur']) && isset($_POST['chapo']) && isset($_POST['content']) && isset($_POST['ADDPOST']) && $_POST['ADDPOST'] == 'OK') {
        $createdPost = 'false';
        if (createPost($_POST['title'], $_POST['chapo'], $_POST['content'], $_POST['auteur'])) {
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
        if (updatePost($_POST['id'], $_POST['title'], $_POST['chapo'], $_POST['content'])) {
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
            if (deletePost($_GET['id'])) {
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

function showPostById($idPost)
{
    if (is_numeric($idPost)) {
        $sql = 'SELECT * FROM post
         WHERE id = :id';
        $params = array(':id' => $idPost);
        if ($result = DB::exec($sql, $params)) {
            return $result->fetchAll(\PDO::FETCH_OBJ);
        }
    }
    return [];
}

function createPost ($title, $chapo, $content, $author_id) {
    $sql = 'INSERT INTO post (title, chapo, content, author_id)
                VALUES (:title, :chapo, :content, :author_id)';
    $params = array(
        ':title' => $title,
        ':chapo' => $chapo,
        ':content' => $content,
        ':author_id' => $author_id
    );

    if (!DB::exec($sql, $params)) {
        return false;
    }
    return true;
}

function updatePost ($postId, $title, $chapo, $content)
{
    $post = showPostById($postId);

    if ($post != []) {

        $sql = 'UPDATE post
        SET title = :title,
            chapo = :chapo,
            content = :content,
            updated_at = NOW()
        WHERE id = :id';
        $params = array(
            ':title' => $title,
            ':chapo' => $chapo,
            ':content' => $content,
            ':id' => $postId
        );

        if (!DB::exec($sql, $params)) {
            return false;
        }
        return true;
    }
}

function deletePost ($postId) {

    $post = showPostById($postId);

    if ($post != []) {

        $sql = 'DELETE FROM post WHERE id = :id';
        $params = array(
            ':id' => $postId
        );

        if (DB::exec($sql, $params)) {
            return true;
        }
    }
    return $post;
}