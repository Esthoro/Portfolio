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
      <form action="../public/process/post.php" method="post" role="form" class="php-email-form">
          <input style="visibility: hidden" id="ADDPOST" value="OK">
          <div class="form-group">
              <input type="text" name="title" class="form-control" id="title" placeholder="Titre du post" required>
          </div>
          <div class="form-group">
              <textarea type="text" rows="2" class="form-control" name="chapo" id="chapo" placeholder="Chapô" required></textarea>
          </div>
          <div class="form-group">
              <select class="form-control" name="auteur" id="auteur" required>
                  <option value="1">Auteur 1</option>
                  <option value="2">Auteur 2</option>
              </select>
          </div>
          <div class="form-group">
              <textarea class="form-control" name="content" rows="5" placeholder="Que voulez-vous écrire ?" required></textarea>
          </div>
        <div class="my-3">
          <div class="loading">Loading</div>
          <div class="error-message"></div>
          <div class="sent-message">Your message has been sent. Thank you!</div>
        </div>
        <div class="text-center"><button type="submit">Créer</button></div>
      </form>
    </div>

  </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php
require('layout.php'); ?>
