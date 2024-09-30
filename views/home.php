<?php $title = "EH - Accueil"; ?>

<?php ob_start(); ?>

<section>
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h1 class="page-title">... Quelqu'un a parlé de développement web ?</h1>
            </div>
        </div>

        <div class="row mb-5">

            <div class="d-md-flex post-entry-2 half">
                <a href="#" class="me-4 thumbnail">
                    <img src="../public/assets/img/portrait.JPG" alt="" class="img-fluid">
                </a>
                <div class="ps-md-5 mt-4 mt-md-0">
                    <div class="post-meta mt-4"></div>
                    <h2 class="mb-4 display-4">A propos de moi</h2>

                    <p>
                        Développeuse web passionnée, je suis titulaire d'un Master en Informatique. Pendant mes études, j'ai commencé à travailler en alternance,
                        cumulant au master une formation OpenClassrooms et des journées en entreprise.
                    </p>
                    <p>
                        Cela fait à présent plus de deux ans que je travaille en tant que développeuse back-end (utilisant principalement PHP et JS).
                        Mes missions incluent la création et la maintenance de site via un CMS personnalisé, mais aussi avec Wordpress, ainsi que le développement de plugins et d'applications dédiées.
                        En parallèle, j'ai réalisé plusieurs projets pour OpenClassrooms, allant de la rédaction d'un cahier des charges pour un client à la création d'un blog from scratch.
                    </p>
                    <p>
                        J'ai hâte de découvrir votre projet et vous aider à le réaliser !
                    </p>
                </div>
            </div>


        </div>

    </div>
</section>

<section id="contact" class="contact mb-5">
    <div class="container" data-aos="fade-up">

        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="page-title">Contact</h2>
            </div>
        </div>

        <div class="row gy-4">

            <div class="col-md-4">
                <div class="info-item">
                    <i class="bi bi-geo-alt"></i>
                    <h3>Adresse</h3>
                    <address>Strasbourg, France</address>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-item info-item-borders">
                    <i class="bi bi-phone"></i>
                    <h3>Téléphone</h3>
                    <p><a href="tel:+0123456789">+01 23 45 67 89</a></p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-item">
                    <i class="bi bi-envelope"></i>
                    <h3>Email</h3>
                    <p><a href="mailto:contact@esther.horowitz.com">contact@esther.horowitz.com</a></p>
                </div>
            </div>

        </div>

        <div class="form mt-5">
            <form id="contactForm" action="/controllers/Contact.php" method="post" role="form" class="php-email-form">
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Nom*" required>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email*" required>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Sujet*" required>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="message" rows="5" placeholder="Dites-m'en un peu plus sur vos projets..." required></textarea>
                </div>
                <div class="text-center"><button type="submit">Envoyer</button></div>
            </form>
        </div>

        <?php if (isset($_COOKIE['messageSent']) && $_COOKIE['messageSent'] == 'true'): ?>
            <div class="row">
                <h4>Message envoyé, merci !</h4>
            </div>
        <?php elseif (isset($_COOKIE['messageSent']) && $_COOKIE['messageSent'] == 'false'): ?>
            <div class="row">
                <h4>Echec de l'envoi de votre message, merci de réessayer ultérieurement.</h4>
            </div>
        <?php elseif (isset($_COOKIE['messageSent']) && $_COOKIE['messageSent'] == 'dataLack'): ?>
            <div class="row">
                <h4>Merci de remplir tous les champs.</h4>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php
require('layout.php'); ?>
