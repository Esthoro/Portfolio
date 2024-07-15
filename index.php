<?php

require_once __DIR__ . '/public/assets/vendor/autoload.php';

require_once 'controllers/BlogController.php';
require_once 'controllers/PostController.php';
require_once 'controllers/Contact.php';
require_once 'controllers/AuthController.php';

if (isset($_GET['action']) && $_GET['action'] !== '') {

    if ($_GET['action'] === 'singlePost') {

        if (isset($_GET['id']) && is_int($_GET['id']) && $_GET['id'] > 0) {

            $postId = $_GET['id'];
            singlePost($postId);

        } else {
            echo 'Erreur : aucun post ne correspond à votre recherche.';
            die;
        }
    } elseif ($_GET['action'] === 'blog') {
        blog();
    }  elseif ($_GET['action'] === 'about') {
        about();
    }  elseif ($_GET['action'] === 'contact') {
        contact();
    } elseif ($_GET['action'] === 'mon-compte') {
        if(!isConnected()) {
            connexion();
        } else {
            myAccount();
        }
    }
    else {
        echo "Erreur 404 : la page que vous recherchez n'existe pas.";
    }
} else {
    homepage();
}
