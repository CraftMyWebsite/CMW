<!-- Inscription -->

<div class="modal fade" id="InscriptionSlide" tabindex="-1" role="dialog" aria-labelledby="InscriptionSlide" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" action="?&action=inscription">
                <div class="modal-header">
                    <h5 class="modal-title">Inscription</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: var(--base-color);">&times;</span>
                    </button>
                </div>

                <div class="modal-body pt-3">

                    <div class="text-center">
                        <small>Les champs obligatoires sont précédés par une étoile <span class="star-required"></span></small>
                    </div>

                    <div class="form-row py-1">
                        <div class="col-md-12 py-2">
                            <label for="PseudoInscriptionForm"> Pseudo <span class="star-required"></span></label>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <div class="input-group-text bg-main border-0">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </span>
                                <input type="text" name="pseudo" class="form-control custom-text-input" id="PseudoInscriptionForm" placeholder="Entrez votre pseudo" required autofocus>
                            </div>
                        </div>

                        <div class="col-md-12 py-2">
                            <label for="EmailInscriptionForm"> Email <span class="star-required"></span></label>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <div class="input-group-text bg-main border-0">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </span>
                                <input type="text" name="email" class="form-control custom-text-input" id="EmailInscriptionForm" placeholder="Entrez votre mail" required>
                            </div>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="show_email" name="show_email">
                                <label class="custom-control-label" for="show_email">Rendre votre adresse email publique</label>
                            </div>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="souvenir" name="souvenir">
                                <label class="custom-control-label" for="souvenir">S'inscrire à la newsletter</label>
                            </div>

                        </div>

                    </div>

                    <div class="form-row py-1">

                        <div class="col-md-6">
                            <label for="MdpInscriptionForm"> Mot de passe <span class="star-required"></span></label>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <div class="input-group-text bg-main border-0">
                                        <i class="fas fa-key"></i>
                                    </div>
                                </span>
                                <input type="password" name="mdp" class="form-control custom-text-input" id="MdpInscriptionForm" placeholder="Entrez votre mot de passe" onKeyUp="securPass();" required>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <label for="MdpConfirmInscriptionForm"> Confirmation <span class="star-required"></span></label>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <div class="input-group-text bg-main border-0">
                                        <i class="fas fa-key"></i>
                                    </div>
                                </span>
                                <input type="password" name="mdpConfirm" class="form-control custom-text-input" id="MdpConfirmInscriptionForm" placeholder="Entrez votre mot de passe" onKeyUp="securPass();" required>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="col-md-12 d-none" id="progress">
                                <div class="progress">
                                    <div class="progress-bar" id="progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <p id="correspondance"></p>
                            </div>
                        </div>

                    </div>

                    <div class="form-row py-1">

                        <div class="col-md-12">
                            <label for="MdpageForm"> Âge (<small>0 pour cacher</small>) </label>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <div class="input-group-text bg-main border-0">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </span>
                                <input type="number" name="age" class="form-control custom-text-input" id="MdpageForm" placeholder="Entrez votre Âge" value="0" min="0" max="999">
                            </div>
                        </div>

                    </div>

                    <div class="form-row py-2">

                        <div class="col-md-12">
                            <label for="CAPTCHA">Captcha <span class="star-required"></span></label>
                        </div>
                        <div class="col-md-6 mb-3">
                            <img id='captcha' src='include/purecaptcha/purecaptcha_img.php?t=login_form' style="width: 80%;height: 100px;" />
                        </div>
                        <div class="col-md-6">
                            <button type="button" onclick='var t=document.getElementById("captcha"); t.src=t.src+"&amp;"+Math.random();' class="btn btn-reverse" style="margin-top:35px">
                                <i class="fas fa-sync"></i> Recharger le captcha
                            </button>
                        </div>

                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <div class="input-group-text bg-main border-0">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </span>
                                <input type='text' name='CAPTCHA' class="form-control custom-text-input" id="captcha" placeholder="Entrez le captcha">
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-main w-100" id="InscriptionBtn" disabled>S'inscrire</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Connexion -->

<div class="modal fade" id="ConnectionSlide" tabindex="-1" role="dialog" aria-labelledby="ConnectionSlide" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-signin" role="form" method="post" action="?&action=connection">
                <div class="modal-header">
                    <h5 class="modal-title">Connexion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: var(--base-color);">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="PseudoConectionForm"> Pseudo </label>
                        <div class="col-md-12">

                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <div class="input-group-text bg-main border-0">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </span>
                                <input type="text" name="pseudo" class="form-control custom-text-input" id="PseudoConectionForm" placeholder="Pseudo" required autofocus>
                            </div>

                        </div>
                    </div>


                    <div class="form-group">
                        <label for="MdpConnectionForm"> Mot de passe </label>
                        <div class="col-md-12">

                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <div class="input-group-text bg-main border-0">
                                        <i class="fa fa-key"></i>
                                    </div>
                                </span>
                                <input type="password" name="mdp" class="form-control custom-text-input" id="MdpConnectionForm" placeholder="Votre mot de passe" required>
                            </div>

                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="reconnexion" name="reconnexion">
                                <label class="custom-control-label" for="reconnexion">Se souvenir de moi</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <a href="#" data-target="#passRecover" data-toggle="modal" class="float-right" data-dismiss="modal">Mot de passe oublié ?</a>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-main w-100">Se connecter</button>
                </div>

            </form>

        </div>
    </div>
</div>


<!-- Mot de passe oublié -->

<div class="modal fade" id="passRecover" tabindex="-1" role="dialog" aria-labelledby="passRecover" aria-hidden="true" style="padding-right: 16px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" action="?&action=passRecover">
                <div class="modal-header">
                    <h5 class="modal-title">Mot de passe oublié</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: var(--base-color);">&times;</span>
                    </button>
                </div>

                <div class="modal-body pt-3">

                    <label for="EmailRecoverForm"> Mail de votre compte :</label>
                    <div class="col-10">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <div class="input-group-text bg-main border-0">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </span>
                            <input type="email" name="email" class="form-control custom-text-input" id="EmailRecoverForm" placeholder="Votre mail" required autofocus>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-main w-100 mt-4">Retrouver mon mot de passe !</button>
                </div>

            </form>
        </div>
    </div>
</div>


<!-- Système de news -->

<?php if (!isset($_GET['page'])) :
    if (isset($news) && count($news) > 0) :
        for ($i = 0; $i < 10; $i++) :
            if ($i < count($news)) :
?>

                <!-- Espace commentaire -->

                <div class="modal fade" id="news<?= $news[$i]['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="news<?= $news[$i]['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Commentaires</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" style="color: var(--base-color);">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <br>
                                <?php
                                $getNewsCommentaires = $accueilNews->newsCommentaires($news[$i]['id']);
                                while ($newsComments = $getNewsCommentaires->fetch(PDO::FETCH_ASSOC)) :
                                    if (Permission::getInstance()->verifPerm("connect")) :

                                        $getCheckReport = $accueilNews->checkReport($_Joueur_['pseudo'], $newsComments['pseudo'], $news[$i]['id'], $newsComments['id']);
                                        $checkReport = $getCheckReport->rowCount();

                                        $getCountReportsVictimes = $accueilNews->countReportsVictimes($newsComments['pseudo'], $news[$i]['id'], $newsComments['id']);
                                        $countReportsVictimes = $getCountReportsVictimes->rowCount();
                                    endif; ?>


                                    <!-- Commentaires News -->

                                    <div class="media m-2 pb-4">
                                        <p class="username">
                                            <img class="mr-3" src="<?= $_ImgProfil_->getUrlHeadByPseudo($newsComments['pseudo'], 32); ?>" style="width: 32px; height: 32px;" alt="avatar de <?= $newsComments['pseudo'] ?>" />
                                            <div class="media-body">
                                                <h5 class="mt-0">
                                                    <?= $newsComments['pseudo'] ?>
                                                    <small class="font-weight-light float-right text-muted">
                                                        le <?= date('d/m', $newsComments['date_post']) ?> à <?= date('H:i', $newsComments['date_post']); ?>
                                                    </small> <b></b>
                                                    <?= Permission::getInstance()->gradeJoueur($newsComments['pseudo']) ?>
                                                </h5>
                                                <?php echo $newsComments['commentaire'];?>
                                            </div>
                                        </p>


                                        <!-- Gestion du message -->
                                        <?php if (Permission::getInstance()->verifPerm("connect")) : ?>

                                            <span style="color: red;">
                                                <?= ($newsComments['nbrEdit'] != "0") ? 'Nombre d\'édition: ' . $newsComments['nbrEdit'] . ' <br> ' : '' ?>
                                                <?= ($countReportsVictimes != "0") ? $countReportsVictimes . ' Signalement <br> ' : '' ?>
                                            </span>

                                            <div class="dropdown mt-3 ml-5">
                                                <button class="btn btn-reverse dropdown-toggle" data-toggle="dropdown"> Actions </button>
                                                <ul class="dropdown-menu">
                                                    <?php if ($newsComments['pseudo'] == $_Joueur_['pseudo'] or Permission::getInstance()->verifPerm("createur")) : ?>


                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#news<?= $news[$i]['id'] ?>-<?= $newsComments['id'] ?>-edit" data-dismiss="modal">
                                                            Editer
                                                        </a>
                                                        <a class="dropdown-item text-danger" href="?&action=delete_news_commentaire&id_comm=<?= $newsComments['id'] ?>&id_news=<?= $news[$i]['id'] ?>&auteur=<?= $newsComments['pseudo'] ?>">
                                                            Supprimer
                                                        </a>

                                                    <?php endif; ?>
                                                    <?php if ($newsComments['pseudo'] != $_Joueur_['pseudo']) :
                                                        if ($checkReport == "0") : ?>
                                                            <a class="dropdown-item" href="?&action=report_news_commentaire&id_news=<?= $news[$i]['id'] ?>&id_comm=<?= $newsComments['id'] ?>&victime=<?= $newsComments['pseudo'] ?>">
                                                                Signaler
                                                            </a>
                                                        <?php else : ?>
                                                            <a class="dropdown-item" href="#" disabled>Déjà signalé</a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                            <?php if (Permission::getInstance()->verifPerm("connect")) : ?>
                                <div class="modal-footer w-100">
                                    <form action="?&action=post_news_commentaire&id_news=<?php echo $news[$i]['id']; ?>" method="post" class="w-100">
                                        <h5>
                                            Commenter !
                                        </h5>
                                        <textarea name="commentaire" class="form-control w-100 mb-3" required></textarea>
                                        <small>
                                            <span class="float-left"><b>Min : </b> 6 charactères. </span>
                                            <span class="float-right"><b>Max : </b> 255 charactères.</span>
                                        </small>
                                        <button type="submit" class="btn btn-main w-100 mt-3">Commenter</button>
                                    </form>
                                </div>
                            <?php else : ?>
                                <div class="modal-footer text-center">
                                    <div class="alert alert-danger">Veuillez-vous connecter pour mettre un commentaire.</div>
                                    <a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning">Connexion</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>


                <!-- Edition d'un commentaire -->

                <?php unset($Img);
                if (Permission::getInstance()->verifPerm("connect")) :
                    $getNewsCommentaires = $accueilNews->newsCommentaires($news[$i]['id']);

                    while ($newsComments = $getNewsCommentaires->fetch(PDO::FETCH_ASSOC)) :
                        $reqEditCommentaire = $accueilNews->editCommentaire($newsComments['pseudo'], $news[$i]['id'], $newsComments['id']);
                        $getEditCommentaire = $reqEditCommentaire->fetch(PDO::FETCH_ASSOC);
                        $editCommentaire = $getEditCommentaire['commentaire'];
                        if ($newsComments['pseudo'] == $_Joueur_['pseudo'] or Permission::getInstance()->verifPerm("createur")) :  ?>
                            <div class="modal fade" id="news<?= $news[$i]['id'] . '-' . $newsComments['id'] . '-edit'; ?>" tabindex="-1" role="dialog" aria-labelledby="news<?= $news[$i]['id'] . '-' . $newsComments['id'] . '-edit'; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Édition du commentaire</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" style="color: var(--base-color);">&times;</span>
                                            </button>
                                        </div>

                                        <form action="?&action=edit_news_commentaire&id_news=<?= $news[$i]['id'] . '&auteur=' . $newsComments['pseudo'] . '&id_comm=' . $newsComments['id']; ?>" method="post">
                                            <div class="modal-body">
                                                <h6>Commentaire de base :</h6>
                                                <textarea name="old_commentaire" id="old_commentaire" rows="3" style="resize: none;" class="form-control disabled mb-5" disabled><?= $editCommentaire; ?></textarea>

                                                <h6>Édition de votre commentaire :</h6>
                                                <textarea name="edit_commentaire" class="form-control" rows="3" style="resize: none;" maxlength="255" required><?= $editCommentaire; ?></textarea>
                                            </div>
                                            <div class="modal-footer text-center">
                                                <small class="w-100">
                                                    <span class="float-left"><b>Min : </b> 6 charactères. </span>
                                                    <span class="float-right"><b>Max : </b> 255 caractères.</span>
                                                </small>
                                                <button type="submit" class="btn btn-main w-100 btn-block">Valider la modification</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>

            <?php endif; ?>
        <?php endfor; ?>
    <?php endif; ?>
<?php endif; ?>

<?php if(isset($_GET['page']) && $_GET['page'] == "forum" && Permission::getInstance()->verifPerm('PermsForum', 'general', 'deleteCategorie') && !$_SESSION['mode']) : ?>
<div class="modal fade" id="editForum" tabindex="-1" role="dialog" aria-labelledby="editForum" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-signin" role="form" method="post" action="?&action=editForum">
                <div class="modal-header">
                    <h5 class="modal-title">Édition du forum "<span id="editForumTitle" ></span>"</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: var(--base-color);">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id" value="" id="editForumId"/>
                    <div class="form-row my-2">
                        <label for="nomForum">Nom du Forum <span class="star-required"></span></label>
                        <input type="text" name="nom" id="editForumName" maxlength="40" class="form-control custom-text-input" required />
                    </div>

                    <div class="form-row my-2">
                        <label for="img">Icône</label>
                            <input type="text" name="img" id="editForumImg" maxlength="300" placeholder='<i class="far fa-comment-dots"></i>' class="form-control custom-text-input" />
                            <small id="imgHelp" class="form-text text-muted">
                                disponible sur : <a href="https://fontawesome.com/icons/" target="_blank">https://fontawesome.com/icons/</a>
                            </small>
                    </div>
                    <div class="form-row my-2">
                        <label for="forum">Catégorie <span class="star-required"></span></label>
                        <select name="forum" class="form-control custom-text-input" required>
                        <?php for ($z = 0, $zMax = count($fofo); $z < $zMax; $z++) : ?>
                            <option id="editForumCat<?= $fofo[$z]['id']; ?>" value="<?= $fofo[$z]['id']; ?>">
                                <?= $fofo[$z]['nom']; ?>
                            </option>
                        <?php endfor; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-main w-100">Valider les changements</button>
                </div>

            </form>

        </div>
    </div>
</div>
<?php endif ?>
<?php if(isset($_GET['page']) && $_GET['page'] == "forum_categorie") : ?>
<div class="modal fade" id="editSForum" tabindex="-1" role="dialog" aria-labelledby="editSForum" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-signin" role="form" method="post" action="?&action=editSousForum">
                <div class="modal-header">
                    <h5 class="modal-title">Édition du sous-forum "<span id="editForumTitle" ></span>"</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: var(--base-color);">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id" value="" id="editForumId"/>
                     <input type="hidden" name="idSF" value="" id="editForumSFId"/>
                     <input type="hidden" name="index" value="" id="editForumIndex"/>
                    <div class="form-row my-2">
                        <label for="nomForum">Nom du sous-Forum <span class="star-required"></span></label>
                        <input type="text" name="nom" id="editForumName" maxlength="40" class="form-control custom-text-input" required />
                    </div>

                    <div class="form-row my-2">
                        <label for="img">Icône</label>
                            <input type="text" name="img" id="editForumImg" maxlength="300" placeholder='<i class="far fa-comment-dots"></i>' class="form-control custom-text-input" />
                            <small id="imgHelp" class="form-text text-muted">
                                disponible sur : <a href="https://fontawesome.com/icons/" target="_blank">https://fontawesome.com/icons/</a>
                            </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-main w-100">Valider les changements</button>
                </div>

            </form>

        </div>
    </div>
</div>
<?php endif; ?>

<div id="modal-image" class="img-modal">
  <div class="modal-img-close" onclick="this.parentElement.style.display='none';"><i class="fas fa-times"  ></i></div>
  <img class="modal-img-content" id="modal-image-src" />
</div>
