<?php

use App\DB;

require_once 'functions.php';
require_once 'C:\xampp\htdocs\PortfolioGit\public\assets\vendor\autoload.php';

//Affichage post précis, avec commmentaires
function singlePost($id) {
    $author = showAuthorByIdPost($id);
    $post = showSinglePost($id);
    $comments = showCommentsByPost($id);
    require ('views/single-post.php');
}

//Affichage page d'accueil avec dernier post
function homepage() {
    $lastPost = showLastPosts();
    $lastPostsForFooter = showLastPosts(5);
    require ('views/home.php');
}

//Affichage de la page du blog
function blog() {
    $posts = showAllPosts();
    require ('views/blog.php');
}

//Affichage de la page A propos
function about() {
    require ('views/about.php');
}

function showLastPosts($postsNumber = 1) {
    if (is_int($postsNumber)) {
        $sql = 'SELECT * FROM post
            ORDER BY updated_at DESC
            LIMIT :postsNumber';
        $params = array(
            ':postsNumber' => $postsNumber
        );
        if ($result = DB::exec($sql, $params)) {
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
    if (is_int($id)) {
        $sql = 'SELECT * FROM post
            ORDER BY updated_at DESC
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
    if (is_int($id)) {
        $sql = 'SELECT * FROM comment
            ORDER BY edited_at DESC
            WHERE post_id = :id';
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
    if (is_int($idPost)) {
        $sql = 'SELECT * FROM person
                LEFT JOIN post
                ON person.id = post.author_id
                WHERE post.id = :id';
        $params = array(
            ':id' => $idPost
        );
        if ($result = DB::exec($sql)) {
            return $result->fetchAll(\PDO::FETCH_OBJ);
        }
    }
    return [];
}


