<?php $title = "EH - Blog"; ?>

<?php ob_start(); ?>

    <section id="posts" class="posts">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h1 class="page-title">Tous les posts</h1>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-12">
                    <div class="row g-5">
                        <div class="col-lg-12 border-start custom-border">
                            <?php if($posts):
                            foreach ($posts as $post):
                                    $Post = new \App\Post();
                                    $Post->setId($post->id);
                                    $author = $Post->showAuthorByPostId(); ?>
                                <div class="post-entry-1">
                                    <div class="post-meta"><span class="date"><?= $author->pseudo; ?></span> <span class="mx-1">&bullet;</span> <span><?= date('d-m-Y', strtotime($post->updated_at)); ?></span></div>
                                    <a href="/singlePost/<?= $post->id; ?>/">
                                        <h2><?= $post->title; ?></h2>
                                        <p><?= $post->chapo; ?></p>
                                    </a>
                                </div>
                            <?php endforeach;
                            endif; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

<?php $content = ob_get_clean(); ?>

<?php
require('layout.php'); ?>
