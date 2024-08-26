<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="/PortfolioGit/public/assets/img/favicon.png" rel="icon">
    <link href="/PortfolioGit/public/assets/img/logo.png" rel="logo">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <link href="/PortfolioGit/public/assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="/PortfolioGit/public/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/PortfolioGit/public/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="/PortfolioGit/public/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/PortfolioGit/public/assets/vendor/aos/aos.css" rel="stylesheet">

    <link href="/PortfolioGit/public/assets/css/variables.css" rel="stylesheet">
    <link href="/PortfolioGit/public/assets/css/main.css" rel="stylesheet">
    <link href="/PortfolioGit/public/assets/css/custom.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: ZenBlog
    * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/
    * Updated: Mar 17 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https:///bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="/PortfolioGit/" class="logo d-flex align-items-center">
            <h1>Esther Horowitz</h1>
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="/PortfolioGit/blog/">Blog</a></li>
                <li><a href="/PortfolioGit/about/">A propos</a></li>
                <li><a href="/PortfolioGit/contact/">Contact</a></li>
                <li><a href="/PortfolioGit/public/assets/pdf/cv.pdf" target="_blank">CV</a></li>
            </ul>
        </nav>

        <div class="position-relative">
                <a href="/PortfolioGit/mon-compte/" class="mx-2"><span class="bi-person"></span></a>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </div>

    </div>

</header>

<main id="main">

        <?= $content ?>

</main>

<footer id="footer" class="footer">

    <div class="footer-content">
        <div class="container">

            <div class="row g-5">
                <div class="col-lg-4">
                    <h3 class="footer-heading">A propos de moi</h3>
                    <p>Jeune développeuse de 23 ans, titulaire d'un Master en Informatique et forte d'une expérience de plus de deux ans dans le monde de la programmation, j'ai hâte de découvrir votre projet et vous aider à le réaliser.</p>
                    <p><a href="/PortfolioGit/about/" class="footer-link-more">En savoir plus</a></p>
                </div>
                <div class="col-6 col-lg-2">
                    <h3 class="footer-heading">Navigation</h3>
                    <ul class="footer-links list-unstyled">
                        <li><a href="/PortfolioGit/"><i class="bi bi-chevron-right"></i> Accueil</a></li>
                        <li><a href="/PortfolioGit/blog/"><i class="bi bi-chevron-right"></i> Blog</a></li>
                        <li><a href="/PortfolioGit/about/"><i class="bi bi-chevron-right"></i> A propos</a></li>
                        <li><a href="/PortfolioGit/contact/"><i class="bi bi-chevron-right"></i> Contact</a></li>
                        <li><a href="/PortfolioGit/public/assets/pdf/cv.pdf" target="_blank"><i class="bi bi-chevron-right"></i> CV</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h3 class="footer-heading">Espace perso</h3>
                    <ul class="footer-links list-unstyled">
                        <li><a href="/PortfolioGit/mon-compte/"><i class="bi bi-chevron-right"></i> Mon compte</a></li>
                        <li><a href="/PortfolioGit/admin/"><i class="bi bi-chevron-right"></i> Administration</a></li>
                    </ul>
                </div>

                <div class="col-lg-4">
                    <h3 class="footer-heading">Les derniers posts</h3>

                    <ul class="footer-links footer-blog-entry list-unstyled">
                        <?php foreach ($lastPostsForFooter as $postFooter): ?>
                        <li>
                            <a href="/PortfolioGit/singlePost/<?= $postFooter->id; ?>/" class="d-flex align-items-center">
                                <div>
                                    <div class="post-meta d-block"><span class="date"><?= $postFooter->title; ?></span> <span class="mx-1">&bullet;</span> <span><?= $postFooter->updated_at; ?></span></div>
                                    <span><?= $postFooter->chapo; ?></span>
                                </div>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <div class="footer-legal">
        <div class="container">

            <div class="row justify-content-between">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <div class="copyright">
                        © Copyright <strong><span>ZenBlog</span></strong>. All Rights Reserved
                    </div>

                    <div class="credits">
                        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
                        <a href="#" class="github"><i class="bi bi-github"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>

                </div>

            </div>

        </div>
    </div>

</footer>

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="/PortfolioGit/public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/PortfolioGit/public/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="/PortfolioGit/public/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="/PortfolioGit/public/assets/vendor/aos/aos.js"></script>

<!-- Template Main JS File -->
<script src="/PortfolioGit/public/assets/js/main.js"></script>

</body>

</html>