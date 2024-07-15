<?php

use App\DB;
use App\Post;

require_once 'functions.php';
require_once 'C:\xampp\htdocs\PortfolioGit\public\assets\vendor\autoload.php';

$BlogPost = new Post();

$_POST = cleanRequest($_POST);

//Création post
if (isset($_POST['title']) && isset($_POST['auteur']) && isset($_POST['chapo']) && isset($_POST['content']) && isset($_POST['ADDPOST']) && $_POST['ADDPOST'] == 'OK') {

    if (createPost ($_POST['title'], $_POST['chapo'], $_POST['content'], $_POST['auteur'])) {
        echo json_encode([true, 'Post créé']);
    } else {
        echo json_encode([false, 'Erreur dans la création du post']);
    }

}

//Modification post
if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['chapo']) && isset($_POST['content']) && isset($_POST['UPDATEPOST']) && $_POST['UPDATEPOST'] == 'OK') {

    if (updatePost ($_POST['title'], $_POST['chapo'], $_POST['content'])) {
        echo json_encode([true, 'Post modifié']);
    } else {
        echo json_encode([false, 'Erreur dans la modification du post']);
    }

}

//Suppression post
if (isset($_POST['id']) && isset($_POST['DELETEPOST']) && $_POST['DELETEPOST'] == 'OK') {

    if (deletePost($_POST['id'])) {
        echo json_encode([true, 'Post supprimé']);
    } else {
        echo json_encode([false, 'Erreur dans la suppression du post']);
    }

}

function showPostById($idPost)
{
    if (is_int($idPost)) {
        $sql = 'SELECT * FROM post
         WHERE id = :id
         ORDER BY `updated_at` DESC';
        $params = array(
            ':id' => $idPost
        );
        if ($result = DB::exec($sql)) {
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

function updatePost ($postId, $title = '', $chapo = '', $content = '')
{
    $post = showPostById($postId);

    if ($post != []) {
        $updateTitle = $title != '' ? $title : $post->title;
        $updateChapo = $chapo != '' ? $chapo : $post->chapo;
        $updateContent = $content != '' ? $content : $post->content;

        $sql = 'UPDATE post
        SET title = :title,
            chapo = :chapo,
            content = :content
        WHERE id = :id';
        $params = array(
            ':title' => $updateTitle,
            ':chapo' => $updateChapo,
            ':content' => $updateContent,
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
    return false;
}