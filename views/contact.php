<?php $title = "EH - Contact"; ?>

<?php ob_start(); ?>

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
            <form action="/controllers/Contact.php" method="post" role="form" class="php-email-form">
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

    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php
require('layout.php'); ?>
