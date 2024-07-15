<?php $title = "EH - Mon compte"; ?>

<?php ob_start(); ?>

<section class="contact mb-5">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h1 class="page-title">Mon compte</h1>
            </div>
        </div>

        <div class="row gy-4">

            <div class="col-md-4">
                <div class="info-item">
                    <i class="bi bi-person-vcard"></i>
                    <h3>Nom :</h3>
                    <p><?= $person->first_name . ' '. $person->surname; ?></p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-item info-item-borders">
                    <i class="bi bi-person"></i>
                    <h3>Pseudo :</h3>
                    <p><?= $person->pseudo; ?></p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-item">
                    <i class="bi bi-envelope"></i>
                    <h3>Email :</h3>
                    <p><?= $person->email; ?></p>
                </div>
            </div>

        </div>

        <br>
        <br>
        <br>
        <br>

        <div class="col-12 text-center mb-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <p>Afin de modifier vos informations personnelles, merci d'envoyer un mail à l'admin via la page de contact.</p>
                </div>
            </div>
        </div>

    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php
require('layout.php'); ?>
