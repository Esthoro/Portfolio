<?php

require_once 'functions.php';
require_once 'C:\xampp\htdocs\PortfolioGit\public\assets\vendor\autoload.php';

use App\DB;

//Affichage post précis, avec commmentaires
function singlePost($id) {
    $author = showAuthorByIdPost($id)[0];
    $post = showSinglePost($id)[0];
    $comments = showCommentsByPost($id);
    $lastPostsForFooter = showLastPosts(5);
    require ('views/single-post.php');
}

//Affichage page de modification de post
function showUpdatePost($id) {
    $post = showSinglePost($id)[0];
    $lastPostsForFooter = showLastPosts(5);
    require ('views/updatePost.php');
}

function errorPage() {
    $lastPostsForFooter = showLastPosts(5);
    require ('views/404.php');
}

//Affichage page d'accueil avec dernier post
function homepage() {
    /*$lastPost = showLastPosts()[0];*/
    $lastPostsForFooter = showLastPosts(5);
    require ('views/home.php');
}

//Affichage de la page du blog
function blog() {
    $posts = showAllPosts();
    $lastPostsForFooter = showLastPosts(5);
    require ('views/blog.php');
}

//Affichage de la page A propos
function about() {
    $lastPostsForFooter = showLastPosts(5);
    require ('views/about.php');
}

function showLastPosts($postsNumber = 1) {
    if (is_numeric($postsNumber)) {
        $sql = 'SELECT * FROM post
            ORDER BY updated_at DESC
            LIMIT ' . $postsNumber;
        if ($result = DB::exec($sql)) {
            return $result->fetchAll(PDO::FETCH_OBJ);
        }
    }
    return [];
}

function showAllPosts() {
        $sql = 'SELECT * FROM post
            ORDER BY updated_at DESC';
        if ($result = DB::exec($sql)) {
            return $result->fetchAll(PDO::FETCH_OBJ);
        }
    return [];
}

function showSinglePost($id) {
    if (is_numeric($id)) {
        $sql = 'SELECT * FROM post
            WHERE id = :id';
        $params = array(
            ':id' => $id
        );
        if ($result = DB::exec($sql, $params)) {
            return $result->fetchAll(PDO::FETCH_OBJ);
        }
    }
    return [];
}
function showCommentsByPost($id) {
    if (is_numeric($id)) {
        $sql = 'SELECT * FROM comment
            WHERE post_id = :id
            AND statut = 1
            ORDER BY edited_at DESC';
        $params = array(
            ':id' => $id
        );
        if ($result = DB::exec($sql, $params)) {
            return $result->fetchAll(PDO::FETCH_OBJ);
        }
    }
    return [];
}
function showAuthorByIdPost($idPost) {
    if (is_numeric($idPost)) {
        $sql = 'SELECT * FROM person
                LEFT JOIN post
                ON person.id = post.author_id
                WHERE post.id = ' . $idPost;
        if ($result = DB::exec($sql)) {
            return $result->fetchAll(\PDO::FETCH_OBJ);
        }
    }
    return [];
}

function showUserById($id) {
    if (is_numeric($id)) {
        $sql = 'SELECT * FROM person
                WHERE id = ' . $id;
        if ($result = DB::exec($sql)) {
            return $result->fetchAll(\PDO::FETCH_OBJ);
        }
    }
    return [];
}



