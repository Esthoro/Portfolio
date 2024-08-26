<?php

session_start();

require_once __DIR__ . '/public/assets/vendor/autoload.php';

require_once 'controllers/BlogController.php';
require_once 'controllers/PostController.php';
require_once 'controllers/Contact.php';
require_once 'controllers/AuthController.php';

$action = $_GET['action'] ?? null;

switch ($action) {
    case 'singlePost':
        $postId = $_GET['id'] ?? null;
        if (is_numeric($postId) && $postId > 0) {
            singlePost($postId);
        } else {
            errorPage();
        }
        break;

    case 'blog':
        blog();
        break;

    case 'about':
        about();
        break;

    case 'contact':
        contact();
        break;

    case 'mon-compte':
        isConnected() ? myAccount() : connexion();
        break;

    case 'admin':
        if (isConnected() && isAdmin()) {
            admin();
        } else {
            errorPage();
        }
        break;

    case 'updatePost':
        if (isConnected() && isAdmin()) {
            $postId = $_GET['id'] ?? null;
            if (is_numeric($postId) && $postId > 0) {
                showUpdatePost($postId);
            } else {
                errorPage();
            }
        } else {
            errorPage();
        }
        break;

    case '404':
        errorPage();
        break;

    default:
        homepage();
        break;
}
