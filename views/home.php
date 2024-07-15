<?php $title = "EH - Accueil"; ?>

<?php ob_start(); ?>

<section>
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h1 class="page-title">Bienvenue sur mon blog</h1>
            </div>
        </div>

        <div class="row mb-5">

            <div class="d-md-flex post-entry-2 half">
                <a href="#" class="me-4 thumbnail">
                    <img src="../PortfolioGit/public/assets/img/portrait.JPG" alt="" class="img-fluid">
                </a>
                <div class="ps-md-5 mt-4 mt-md-0">
                    <div class="post-meta mt-4"></div>
                    <h2 class="mb-4 display-4">A propos de moi...</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, perspiciatis repellat maxime, adipisci non ipsam at itaque rerum vitae, necessitatibus nulla animi expedita cumque provident inventore? Voluptatum in tempora earum deleniti, culpa odit veniam, ea reiciendis sunt ullam temporibus aut!</p>
                </div>
            </div>


        </div>

    </div>
</section>

<section class="mb-5 bg-light py-5">
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-between align-items-lg-center">
            <div class="col-lg-12 mb-5">
                <h2 class="display-4 mb-4"><?= var_dump( $lastPost); ?></h2>
                <p><?php /*= $lastPost->content;*/ ?></p>
                <p><a href="/PortfolioGit/blog/" class="more">Voir tous les posts</a></p>
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
            </div><!-- End Info Item -->

            <div class="col-md-4">
                <div class="info-item info-item-borders">
                    <i class="bi bi-phone"></i>
                    <h3>Téléphone</h3>
                    <p><a href="tel:+0123456789">+01 23 45 67 89</a></p>
                </div>
            </div><!-- End Info Item -->

            <div class="col-md-4">
                <div class="info-item">
                    <i class="bi bi-envelope"></i>
                    <h3>Email</h3>
                    <p><a href="mailto:contact@esther.horowitz.com">contact@esther.horowitz.com</a></p>
                </div>
            </div><!-- End Info Item -->

        </div>

        <div class="form mt-5">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
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
                <div class="my-3">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>
                <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
        </div><!-- End Contact Form -->

    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php
require('layout.php'); ?>
