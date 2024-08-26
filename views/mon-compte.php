<?php $title = "EH - Mon compte";?>

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

        <div class="form mt-5">
            <form action="/PortfolioGit/controllers/AuthController.php" id="logout-form" method="post" role="form" class="php-email-form">
                <input style="visibility: hidden" name="DISCONNECT" value="OK">
                <div class="text-center"><button type="submit">Se déconnecter</button></div>
            </form>
        </div>
        <?php if (isset($_COOKIE['errorLogout']) && $_COOKIE['errorLogout'] === 'true'): ?>
            <div class="row">
                <h4>Erreur de déconnexion - veuillez actualiser la page et réessayer.</h4>
            </div>
        <?php endif; ?>

        <div class="form mt-5">
            <form action="/PortfolioGit/controllers/AuthController.php" id="update-data-form" method="post" role="form" class="php-email-form">
                <input style="visibility: hidden" name="UPDATEUSERDATA" value="OK">
                <input style="visibility: hidden" name="personId" value="<?= $person->id; ?>">
                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="text" name="name-update" class="form-control" id="name-update" value="<?= $person->surname; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" name="firstname-update" class="form-control" id="firstname-update" value="<?= $person->first_name; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="email" class="form-control" name="email-update" id="email-update" value="<?= $person->email; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" name="login-update" class="form-control" id="login-update" value="<?= $person->pseudo; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="password" class="form-control" name="password-update" id="password-update" placeholder="Choisissez un nouveau mot de passe">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="password" class="form-control" name="password-verif-update" id="password-verif-update" placeholder="Confirmez le nouveau mot de passe">
                    </div>
                </div>
                <div class="text-center"><button type="submit">Modifier mes informations personnelles</button></div>
            </form>
        </div>
        <?php if (isset($_COOKIE['updateUserData']) && $_COOKIE['updateUserData'] == 'true'): ?>
            <div class="row">
                <h4>Vos données ont bien été modifiées</h4>
            </div>
        <?php elseif (isset($_COOKIE['updateUserData']) && $_COOKIE['updateUserData'] == 'false'): ?>
            <div class="row">
                <h4>Echec de la modification de vos données, veuillez actualiser la page et réessayer ultérieurement.</h4>
            </div>
        <?php endif; ?>

        <div class="form mt-5">
            <form action="/PortfolioGit/controllers/AuthController.php" method="post" role="form" class="php-email-form">
                <input style="visibility: hidden" name="DELETEACCOUNT" value="OK">
                <div class="text-center post-meta mt-4">ATTENTION, CETTE ACTION EST IRREVERSIBLE !</div>
                <div class="text-center"><button type="submit" onclick="return confirmDeletion();">Supprimer mon compte</button></div>
            </form>
        </div>

    </div>
</section>

<section id="listComments">
    <div class="container">
        <div class="row">

            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="page-title">Mes commentaires</h2>
                </div>
            </div>
            <?php if (isset($_COOKIE['deletedComment']) && $_COOKIE['deletedComment'] == 'true'): ?>
                <div class="row">
                    <h4>Commentaire supprimé avec succès !</h4>
                </div>
            <?php elseif (isset($_COOKIE['deletedComment']) && $_COOKIE['deletedComment'] == 'false'): ?>
                <div class="row">
                    <h4>Erreur de suppression du commentaire</h4>
                </div>
            <?php endif; ?>
            <ul>
                <?php if ($myComments):
                    foreach ($myComments as $comment): ?>
                        <li>
                            <div class="row">
                                <div class="col-md-9" data-aos="fade-up">
                                    <div class="d-md-flex post-entry-2 half">
                                        <div>
                                            <p><strong>Titre du post : </strong><?= $comment->title; ?></p>
                                            <p><strong>Contenu : </strong><?= $comment->content; ?></p>
                                            <p><strong>Statut : </strong><?= $comment->statut == '1' ? 'Valide' : 'Invalide'; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" data-aos="fade-up">
                                    <p><a class="more" href="/PortfolioGit/controllers/CommentController.php?DELETECOMMENT=OK&id=<?= $comment->id; ?>">Supprimer le commentaire</a></p>
                                </div>
                            </div>
                        </li>
                    <?php endforeach;
                else: ?>
                    <p>Vous n'avez pas encore écrit de commentaire</p>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</section>

<?php if ($person->role == 2): ?>
    <section id="listPersonsAdmin">
        <div class="container">
            <div class="row">

                <div class="row">
                    <div class="col-lg-12 text-center mb-5">
                        <h2 class="page-title">Liste des utilisateurs</h2>
                    </div>
                </div>
                <?php if (isset($_COOKIE['updatedUser']) && $_COOKIE['updatedUser'] == 'true'): ?>
                    <div class="row">
                        <h4>Utilisateur mis à jour avec succès !</h4>
                    </div>
                <?php elseif (isset($_COOKIE['updatedUser']) && $_COOKIE['updatedUser'] == 'false'): ?>
                    <div class="row">
                        <h4>Erreur de mise à jour de l'utilisateur</h4>
                    </div>
                <?php endif; ?>
                <ul>
                    <?php if ($allUsers):
                        foreach ($allUsers as $user): ?>
                            <li>
                                <div class="row">
                                    <div class="col-md-9" data-aos="fade-up">
                                        <div class="d-md-flex post-entry-2 half">
                                            <div>
                                                <p><strong>Pseudo : </strong><?= $user->pseudo; ?></p>
                                                <p><strong>Nom : </strong><?= $user->first_name . ' ' . $user->surname; ?></p>
                                                <p><strong>Email : </strong><?= $user->email; ?></p>
                                                <p><strong>Statut : </strong><?= $user->statut == 1 ? 'Valide' : 'Invalide'; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3" data-aos="fade-up">
                                        <?php if ($user->statut == 1 && $user->role != 2): ?>
                                            <p><a class="more" href="/PortfolioGit/controllers/UserController.php?DELETEUSER=OK&id=<?= $user->id; ?>">Supprimer l'utilisateur</a></p>
                                        <?php elseif($user->statut == 0 && $user->role != 2): ?>
                                            <p><a class="more" href="/PortfolioGit/controllers/UserController.php?VALIDUSER=OK&id=<?= $user->id; ?>">Valider l'utilisateur</a></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach;
                    endif; ?>
                </ul>
            </div>
        </div>
    </section>
    <section id="listCommentsAdmin">
        <div class="container">
            <div class="row">

                <div class="row">
                    <div class="col-lg-12 text-center mb-5">
                        <h2 class="page-title">Liste des commentaires non validés</h2>
                    </div>
                </div>
                <?php if (isset($_COOKIE['updatedComment']) && $_COOKIE['updatedComment'] == 'true'): ?>
                    <div class="row">
                        <h4>Commentaire mis à jour avec succès !</h4>
                    </div>
                <?php elseif (isset($_COOKIE['updatedComment']) && $_COOKIE['updatedComment'] == 'false'): ?>
                    <div class="row">
                        <h4>Erreur de mise à jour du commentaire</h4>
                    </div>
                <?php endif; ?>
                <ul>
                    <?php if ($allNonValidComments):
                        foreach ($allNonValidComments as $comment): ?>
                            <li>
                                <div class="row">
                                    <div class="col-md-9" data-aos="fade-up">
                                        <div class="d-md-flex post-entry-2 half">
                                            <div>
                                                <p><strong>Numéro du post : </strong><?= $comment->post_id; ?></p>
                                                <p><strong>Pseudo de l'auteur : </strong><?= $comment->pseudo; ?></p>
                                                <p><strong>Contenu : </strong><?= $comment->content; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3" data-aos="fade-up">
                                        <p><a class="more" href="/PortfolioGit/controllers/CommentController.php?VALIDCOMMENT=OK&id=<?= $comment->id; ?>">Valider le commentaire</a></p>
                                        <p><a class="more" href="/PortfolioGit/controllers/CommentController.php?DELETECOMMENT=OK&id=<?= $comment->id; ?>">Supprimer le commentaire</a></p>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach;
                        else : ?>
                            <p>Il n'y aucun commentaire non validé pour le moment.</p>
                        <?php endif; ?>
                </ul>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>

<?php
require('layout.php'); ?>

<script>
    function confirmDeletion() {
        return confirm("Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.");
    }
</script>
