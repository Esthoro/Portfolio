<?php $title = "EH - Admin"; ?>

<?php ob_start(); ?>


<section id="creationPost" class="contact mb-5">
  <div class="container" data-aos="fade-up">

    <div class="row">
      <div class="col-lg-12 text-center mb-5">
        <h2 class="page-title">Créer un Post</h2>
      </div>
    </div>

    <div class="form mt-5">
      <form action="/controllers/PostController.php" method="post" role="form" class="php-email-form" id="createPostForm">
          <input style="visibility: hidden" name="ADDPOST" value="OK">
          <div class="form-group">
              <input type="text" name="title" class="form-control" id="title" placeholder="Titre du post" required>
          </div>
          <div class="form-group">
              <textarea type="text" rows="2" class="form-control" name="chapo" id="chapo" placeholder="Chapô" required></textarea>
          </div>
          <div class="form-group">
              <select class="form-control" name="auteur" id="auteur" required>
                  <option value="<?= $author->id; ?>"><?= $author->pseudo; ?></option>
              </select>
          </div>
          <div class="form-group">
              <textarea class="form-control" name="content" rows="5" placeholder="Que voulez-vous écrire ?" required></textarea>
          </div>
        <div class="text-center"><button type="submit">Créer</button></div>
      </form>
    </div>

      <?php if (isset($_COOKIE['createdPost']) && $_COOKIE['createdPost'] == 'true'): ?>
          <div class="row">
              <h4>Post créé avec succès !</h4>
          </div>
      <?php elseif (isset($_COOKIE['createdPost']) && $_COOKIE['createdPost'] == 'false'): ?>
          <div class="row">
              <h4>Erreur de création du post.</h4>
          </div>
      <?php endif; ?>

  </div>
</section>

<section id="listPostsAdmin">
    <div class="container">
        <div class="row">

            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="page-title">Liste des Posts</h2>
                </div>
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
            <ul>
            <?php if ($allPosts):
                foreach ($allPosts as $post):
                    $Post = new \App\Post();
                    $Post->setId($post->id);
                    $author = $Post->showAuthorByPostId(); ?>
                    <li>
                        <div class="row">
                            <div class="col-md-9" data-aos="fade-up">
                                <div class="d-md-flex post-entry-2 half">
                                    <div>
                                        <h3><?= $post->title; ?></h3>
                                        <div class="post-meta"><span><?= date('d-m-Y', strtotime($post->updated_at)); ?></span></div>
                                        <h5><?= $post->chapo; ?></h5>
                                        <p><?= $post->content; ?></p>
                                        <div class="d-flex align-items-center author">
                                            <div class="name">
                                                <h3 class="m-0 p-0">Auteur : <?= $author->pseudo; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3" data-aos="fade-up">
                                <p><a class="more" href="/updatePost/<?= $post->id; ?>/">Modifier le Post</a></p>
                                <p><a class="more" href="/controllers/PostController.php?DELETEPOST=OK&id=<?= $post->id; ?>">Supprimer le Post</a></p>
                            </div>
                        </div>
                    </li>
            <?php endforeach;
            endif; ?>
            </ul>
            <?php if (isset($_COOKIE['deletedPost']) && $_COOKIE['deletedPost'] == 'true'): ?>
                <div class="row">
                    <h4>Post supprimé avec succès !</h4>
                </div>
            <?php elseif (isset($_COOKIE['deletedPost']) && $_COOKIE['deletedPost'] == 'false'): ?>
                <div class="row">
                    <h4>Erreur de suppression du post.</h4>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php
require('layout.php'); ?>
