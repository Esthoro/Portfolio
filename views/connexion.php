<?php $title = "EH - Connexion"; ?>

<?php ob_start(); ?>

    <section id="connexion" class="connexion mb-5">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h1 class="page-title">Se connecter</h1>
                </div>
            </div>

            <div class="form mt-5 contact">
                <form action="/PortfolioGit/controllers/AuthController.php" method="post" role="form" class="php-email-form">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" name="login" class="form-control" id="login" placeholder="Login" required>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe" required>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                    </div>
                    <div class="text-center"><button type="submit">Se connecter</button></div>
                </form>
            </div>
            <div class="post-meta mt-4">Pas encore inscrit ? N'attendez pas, <a href="#">rejoignez-nous</a> !</div>
            <div class="post-meta mt-4">L'inscription est sujette à confirmation par le webmaster.</div>

        </div>
    </section>

    <section id="register" class="connexion mb-5">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h1 class="page-title">S'inscrire</h1>
                </div>
            </div>

            <div class="form mt-5 contact">
                <form action="/PortfolioGit/controllers/AuthController.php" method="post" role="form" class="php-email-form">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <input type="text" name="name-registration" class="form-control" id="name-registration" placeholder="Nom" required>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" name="firstname-registration" class="form-control" id="firstname-registration" placeholder="Prénom" required>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="email" class="form-control" name="email-registration" id="email-registration" placeholder="Email" required>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" name="login-registration" class="form-control" id="login-registration" placeholder="Choisissez un login" required>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="password" class="form-control" name="password-registration" id="password-registration" placeholder="Choisissez un mot de passe" required>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="password" class="form-control" name="password-verif-registration" id="password-verif-registration" placeholder="Confirmez le mot de passe" required>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                    </div>
                    <div class="text-center"><button type="submit">S'inscrire</button></div>
                </form>
            </div>
            <div class="post-meta mt-4">L'inscription est sujette à confirmation par le webmaster.</div>

        </div>
    </section>

<?php $content = ob_get_clean(); ?>

<?php
require('layout.php'); ?>
