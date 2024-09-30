<?php $title = $post->title; ?>

<?php ob_start(); ?>

    <section class="single-post-content">
      <div class="container">
        <div class="row">
          <div class="col-md-12 post-content" data-aos="fade-up">

            <div class="single-post">
                <div class="post-meta">
                    <span class="date"><?= $author->first_name . ' ' . $author->surname; ?></span>
                    <span class="mx-1">&bullet;</span> <span><?= date('d-m-Y', strtotime($post->updated_at)); ?></span>
                </div>
                <h1 class="mb-5"><?= $post->title; ?></h1>
                <h4 class="mb-5"><?= $post->chapo; ?></h4>
                <p><?= nl2br($post->content); ?></p>

                    <div class="comments">
                        <h5 class="comment-title py-4">Commentaires</h5>
                        <?php if ($comments):
                        foreach ($comments as $comment): ?>
                            <div class="comment d-flex">
                                <div class="flex-shrink-1 ms-2 ms-sm-3">
                                    <div class="comment-meta d-flex">
                                        <h6 class="me-2"><?php /*= showUserById($comment->author_id)[0]->pseudo; */?></h6>
                                    </div>
                                    <div class="comment-body"><?= $comment->content; ?></div>
                                </div>
                            </div>
                        <?php endforeach;
                        else: ?>
                            <p>Il n'y a pas encore de commentaire sur cet article.</p>
                        <?php endif;?>
                    </div>

                <?php if (isConnected()): ?>
                    <div class="row justify-content-center mt-5">
                        <div class="container">
                            <div class="form mt-5 contact">
                                <form action="/controllers/CommentController.php" method="post" role="form" class="php-email-form" id="sendComment">
                                    <div class="row">
                                        <h5 class="comment-title">Laisser un commentaire en tant que <strong><?= cleanData($_SESSION['pseudo']); ?></strong></h5>
                                        <div class="form-group">
                                            <textarea class="form-control" name="commentMessage" id="comment-message" placeholder="Votre commentaire" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <input style="visibility: hidden" name="ADDCOMMENT" value="OK">
                                    <input style="visibility: hidden" name="postId" value="<?= $post->id; ?>">
                                    <div class="text-center"><button type="submit">Envoyer</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($_COOKIE['commentSent']) && $_COOKIE['commentSent'] == 'true'): ?>
                        <div class="row">
                            <h4>Commentaire envoyé ! Il s'affichera dès validation par le webmaster.</h4>
                        </div>
                    <?php elseif (isset($_COOKIE['commentSent']) && $_COOKIE['commentSent'] == 'false'): ?>
                        <div class="row">
                            <h4>Echec d'envoi du commentaire.</h4>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                <div class="row justify-content-center mt-5">
                    <div class="container">
                        <p>Vous devez être connecté pour laisser un commentaire.</p>
                        <p>Pas encore inscrit ? <a href="/mon-compte/"><strong>C'est par ici !</strong></a></p>
                    </div>
                </div>
                <?php endif; ?>

          </div>
        </div>
      </div>
    </section>

<?php $content = ob_get_clean(); ?>

<?php
require('layout.php'); ?>