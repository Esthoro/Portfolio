<?php

require_once 'functions.php';
require_once 'C:\xampp\htdocs\PortfolioGit\public\assets\vendor\autoload.php';

use App\Person;
use App\Post;
use App\Comment;

//Affichage post précis, avec commmentaires
function singlePost($id) {

    $Post = new Post();
    $Comment = new Comment();

    $Post->setId($id);
    $Comment->setPostId($id);

    $author = $Post->showAuthorByPostId();
    $post = $Post->showSinglePost();
    $comments = $Comment->showByPost();
    $lastPostsForFooter = $Post->showLastPosts(5);
    $User = new Person();
    require ('views/single-post.php');
}

//Affichage page de modification de post
function showUpdatePost($id) {
    $Post = new Post();
    $Post->setId($id);
    $post = $Post->showSinglePost();
    $lastPostsForFooter = $Post->showLastPosts(5);
    require ('views/updatePost.php');
}

function errorPage() {
    $Post = new Post();
    $lastPostsForFooter = $Post->showLastPosts(5);
    require ('views/404.php');
}

//Affichage page d'accueil avec dernier post
function homepage() {
    $Post = new Post();
    $lastPostsForFooter = $Post->showLastPosts(5);
    require ('views/home.php');
}

//Affichage de la page du blog
function blog() {
    $Post = new Post();
    $posts = $Post->showAll();
    $lastPostsForFooter = $Post->showLastPosts(5);
    require ('views/blog.php');
}

//Affichage de la page A propos
function about() {
    $Post = new Post();
    $lastPostsForFooter = $Post->showLastPosts(5);
    require ('views/about.php');
}