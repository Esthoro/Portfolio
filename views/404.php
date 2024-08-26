<?php $title = "EH - 404"; ?>

<?php ob_start(); ?>

<?php $content = ob_get_clean(); ?>
<section>
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h1 class="page-title">Erreur...</h1>
            </div>
        </div>

        <div class="row mb-5 text-center">
            <p>La page que vous cherchez n'existe pas !</p>
            <p>
                <a href="/PortfolioGit/"><strong>Retour à l'accueil</strong></a>
            </p>
        </div>

    </div>
</section>
<?php
require('layout.php'); ?>
