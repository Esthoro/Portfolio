<?php $title = "EH - Modification de Post"; ?>

<?php ob_start(); ?>


<section id="updatePost" class="contact mb-5">
    <div class="container" data-aos="fade-up">

        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="page-title">Modifier le Post</h2>
            </div>
        </div>

        <div class="form mt-5">
            <form action="/controllers/PostController.php" method="post" role="form" class="php-email-form" id="updatePostForm">
                <input style="visibility: hidden" name="UPDATEPOST" value="OK">
                <input style="visibility: hidden" name="id" value="<?= $post->id; ?>">
                <div class="form-group">
                    <input type="text" value="<?= $post->title; ?>" name="title" class="form-control" id="title" required>
                </div>
                <div class="form-group">
                    <textarea type="text" rows="2" class="form-control" name="chapo" id="chapo" required><?= $post->chapo; ?></textarea>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="content" rows="5" required><?= $post->content; ?></textarea>
                </div>
                <div class="text-center"><button type="submit">Modifier</button></div>
            </form>
        </div>

        <?php if (isset($_COOKIE['updatedPost']) && $_COOKIE['updatedPost'] == 'true'): ?>
            <div class="row">
                <h4>Post modifié avec succès !</h4>
            </div>
        <?php elseif (isset($_COOKIE['updatedPost']) && $_COOKIE['updatedPost'] == 'false'): ?>
            <div class="row">
                <h4>Erreur de modification du post.</h4>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php
require('layout.php'); ?>
