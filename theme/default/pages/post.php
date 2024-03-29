<?php
require('modele/forum/date.php');
if (isset($_GET['id'])) :
    $id = $_GET['id'];
    if (isset($_Joueur_))
        $_JoueurForum_->topic_lu($id, $bddConnection);
    $topicd = $_Forum_->getTopic($id);
    $titleHTML = $topicd['nom'];
    if (!empty($topicd['id'])) :
        if ((Permission::getInstance()->verifPerm("createur") or (Permission::getInstance()->verifPerm('PermsDefault', 'forum', 'perms') >= $topicd['perms'] and Permission::getInstance()->verifPerm('PermsDefault', 'forum', 'perms') >= $topicd['permsCat']) and !$_SESSION['mode']) or ($topicd['perms'] == 0 and $topicd['permsCat'] == 0)) : ?>
            <script type="application/javascript">  document.title = "<?=$_Serveur_['General']['name'] . " | " . $titleHTML;?>"; </script>
            <section id="Post">
                <div class="container-fluid col-md-9 col-lg-9 col-sm-10 mt-4">

                    <div class="row">

                        <nav aria-label="breadcrumb" role="navigation" class="w-100">
                            <ol class="breadcrumb bg-lightest">

                                <li class="breadcrumb-item">
                                    <a href="/">
                                        Accueil
                                    </a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="index.php?page=forum">
                                        Forum
                                    </a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="index.php?page=forum_categorie&id=<?= $topicd['id_categorie']; ?>">
                                        <?= $topicd['nom_categorie']; ?>
                                    </a>
                                </li>

                                <?php if (isset($topicd['sous_forum'])) : ?>
                                    <li class="breadcrumb-item">
                                        <a href="index.php?page=sous_forum_categorie&id=<?= $topicd['id_categorie']; ?>&id_sous_forum=<?= $topicd['sous_forum']; ?>">
                                            <?= $topicd['nom_sf']; ?>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <li class="breadcrumb-item" aria-current="page">
                                    <?= $topicd['nom']; ?>
                                </li>

                            </ol>
                        </nav>

                        <div class="col my-3 pr-auto">
                            <div class="card">

                                <div class="card-header text-center">
                                    <h5 class='m-0'>Actions</h5>
                                </div>

                                <div class="card-body categories">
                                    <ul class="nav nav-pills nav-fill">
                                        <?php if (Permission::getInstance()->verifPerm("connect") && $_JoueurForum_->is_followed($id)) : ?>

                                            <li class="categorie-item nav-item">
                                                <a class="btn btn-warning" href="index.php?action=unfollow&id_topic=<?= $topicd['id']; ?>">
                                                    Ne plus suivre cette discussion
                                                </a>
                                            </li>

                                        <?php elseif (Permission::getInstance()->verifPerm("connect")) : ?>

                                            <li class="categorie-item nav-item">
                                                <a class="btn btn-primary" href="index.php?action=follow&id_topic=<?= $topicd['id']; ?>">
                                                    Suivre cette discussion
                                                </a>
                                            </li>

                                        <?php endif; ?>

                                        <li class="categorie-item nav-item">
                                            <a class="btn btn-primary" href="index.php?page=<?= (isset($topicd['sous_forum'])) ? "sous_" : ""; ?>forum_categorie&id=<?= $topicd['id_categorie']; ?><?= (isset($topicd['sous_forum'])) ? '&id_sous_forum=' . $topicd["sous_forum"] : ""; ?>">
                                                Revenir à l'accueil de la catégorie
                                            </a>
                                        </li>

                                        <li class="categorie-item nav-item">
                                            <a class="btn btn-primary" href="index.php?page=forum">
                                                Revenir à l'index du forum
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <?php if (Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'closeTopic') or Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'selTopic') and !$_SESSION['mode']) : ?>

                            <div class="col-md-6 col-lg-4 col-sm-12 my-3 ml-auto">

                                <div class="card">

                                    <div class="card-header text-center">
                                        <h5 class='m-0'>Modération</h5>
                                    </div>

                                    <div class="card-body categories">
                                        <ul class="categorie-content nav nav-tabs">

                                            <li class="categorie-item nav-item">
                                                <div class="dropdown">
                                                    <a class="nav-link categorie-link dropdown-toggle text-center" type="button" id="Actions-Modération" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        Actions de Modération ....
                                                    </a>
                                                    <div class="dropdown-menu" aria-labeledby="Actions-Modérations">

                                                        <?php if (Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'closeTopic')) :

                                                            if ($topicd['etat'] == 1) : ?>

                                                                <a class="dropdown-item" href="index.php?action=forum_moderation&id_topic=<?= $id; ?>&choix=4">
                                                                    Ouvrir la discussion
                                                                </a>

                                                            <?php else : ?>

                                                                <a class="dropdown-item" href="index.php?action=forum_moderation&id_topic=<?= $id; ?>&choix=1">
                                                                    Fermer la discussion
                                                                </a>

                                                            <?php endif; ?>

                                                        <?php endif; ?>

                                                        <?php if (Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'deleteTopic')) : ?>

                                                            <a class="dropdown-item" href="index.php?action=forum_moderation&id_topic=<?= $id; ?>&choix=2">Supprimer le topic</a>

                                                        <?php endif; ?>

                                                        <?php if (Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'mooveTopic')) : ?>

                                                            <a class="dropdown-item" href="index.php?action=forum_moderation&id_topic=<?= $id; ?>&choix=3">
                                                                Déplacer la discussion
                                                            </a>

                                                        <?php endif; ?>

                                                    </div>
                                                </div>
                                            </li>

                                            <li class="categorie-item nav-item">
                                                <div class="dropdown">
                                                    <a class="nav-link categorie-link dropdown-toggle text-center" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Niveau d'accès
                                                    </a>


                                                    <div class="dropdown-menu">

                                                        <form class="px-4 py-3" action="?action=modifPermsTopics" method="POST">
                                                            <div class="form-group">
                                                                <label for="perms">Niveau de permission</label>
                                                                <input type="hidden" name="id" value="<?= $id; ?>">
                                                                <input type="number" min="0" max="100" class="form-control custom-text-input" name="perms" value="<?= $topicd['perms']; ?>">
                                                            </div>
                                                            <button type="submit" class="btn btn-main bg-lightest w-100">Modifier</button>

                                                        </form>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>

                                </div>

                            </div>
                        <?php endif; ?>

                    </div>

                    <h3>Sujet : <?= $topicd['nom']; ?></h3>

                    <div class="row">
                        <div class="col-lg-3 col-md-12 col-sm-12">

                            <div class="col-12 text-center">
                                <img class="mx-auto p-3 bg-lightest" src="<?= $_ImgProfil_->getUrlHeadByPseudo($topicd['pseudo'],128); ?>" style="width: 128px; height: 128px;" alt="avatar de <?= $topicd['pseudo']; ?>" />
                            </div>
                            <div class="col-12 mx-auto bg-darkest" style="width: 128px; height: 128px;">
                                <div class="text-center py-3">
                                    <h4 class="text-active">
                                        <?= $topicd['pseudo']; ?>
                                    </h4>
                                    <h6>
                                        <?= Permission::getInstance()->gradeJoueur($topicd['pseudo']); ?>
                                    </h6>

                                    <!-- Edition -->
                                    <?php if (isset($_Joueur_) && ($_Joueur_['pseudo'] == $topicd['pseudo'] || Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'editTopic') && !$_SESSION['mode'])) : ?>
<table class="text-center w-100">
    <tr>
        <td>
                                        <form action="?action=editPost" method="post">
                                            <input type="hidden" name="objet" value="topic" />
                                            <input type="hidden" name="id" value="<?= $id; ?>" />
                                            <button type="submit" class="btn btn-secondary">
                                                <i class="fa fa-pen"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>

                                    <?php if (isset($_Joueur_) && ($_Joueur_['pseudo'] == $topicd['pseudo'] || Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'deleteTopic') && !$_SESSION['mode'])) : ?>
        </td>
        <td>
                                        <form action="?action=remove_topic" method="post">
                                            <input type="hidden" name="id_topic" value="<?= $id; ?>" />
                                            <a class="btn btn-danger no-hover" role="button" data-toggle="modal" href="#topic_<?= $id; ?>" aria-expanded="false" aria-controls="modalConfirmation">
                                                <i class="fa fa-trash"></i>
                                            </a>

                                            <div class="modal fade" id="topic_<?= $id; ?>" tabindex="-1" role="dialog" aria-labelledby="modalConfirmation" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content bg-danger">

                                                        <div class="modal-header bg-danger">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body bg-danger rounded py-4">
                                                            <h5>Voulez-vous vraiment <span class="font-weight-bolder">Supprimer</span> ce topic ?</h5>
                                                            <h6>Plus aucune données de ce topic ne pourra être récupérées.</h6>
                                                        </div>

                                                        <div class="modal-footer bg-danger">
                                                            <button type="submit" class="btn btn-secondary w-100">
                                                                Confirmer la suppression de ce Topic !
                                                            </button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    <?php endif; ?>
        </td>
    </tr>
</table>
                                </div>
                            </div>

                        </div>

                        <!-- Contenue du topic de l'auteur -->
                        <div class="col-lg-8 col-md-12 col-sm-12 mt-3 p-4 bg-lightest border border-1 shadow rounded ml-auto">

                            <?php
                            unset($contenue);
                            $contenue = $topicd['contenue'];

                            $signature = $_Forum_->getSignature($topicd['pseudo']);

                            $d_edition = explode('-', $topicd['d_edition']);

                            $countlike = $_Forum_->compteLike($topicd['id'], $count1, 1);
                            $countdislike = $_Forum_->compteDisLike($topicd['id'], $count2, 1);

                            ?>

                            <h4>Contenue du message :</h4>
                            <hr class="bg-darkest mt-0" style="border-top-style: dotted;">

                            <div class="m-2 h5" id="contenuePost" style="text-overflow: clip; word-wrap: break-word;">
                                <?= $contenue; ?>
                            </div>

                            <hr class="bg-main mt-3 w-80">

                            <div class="col-12">
                                <div class="ml-3">
                                    <?= $signature; ?>
                                </div>
                                <?php if (isset($_Joueur_)) : ?>
                                        <form class="text-center" action="?action=signalement_topic" method="post">
                                            <button type="button" onclick="addBlockQuote('ckeditorPost','contenuePost', '<?= $topicd['pseudo']; ?>');" class="mb-2 btn btn-dark float-right" style="margin-right:15px;">Citer le message</button>
                                            <input type="hidden" name="id_topic" value='<?= $id; ?>' />
                                            <button  type="submit" class="mb-2 btn btn-danger float-right">Signaler !</button>
                                        </form>
                                        
                                <?php endif; ?>
                            </div>
                            <div class="text-center w-100">
                            <p class="h6">
                                Posté le <?=  $_Forum_->conversionDate($topicd['date_creation']); 
                                 if($topicd['d_edition'] != NULL) {
                                       
                                        echo " et édité le ".  $_Forum_->conversionDate($topicd['d_edition']);
                                    }?>
                            </p>
                            </div>

                        </div>
                    </div>

                    <!-- Affichage des réponses -->
                    <?php
                    $count_Max = $_Forum_->compteReponse($id);
                    $count_nbrOfPages = ceil($count_Max / 20);

                    $page = (isset($_GET['page_post'])) ? $_GET['page_post'] : 1;

                    $count_FirstDisplay = ($page - 1) * 20;
                    $answerd = $_Forum_->affichageReponse($id, $count_FirstDisplay);

                    for ($i = 0; $i < count($answerd); $i++) : ?>







                        <div class="row">

                            <div class="col-lg-3 col-md-12 col-sm-12 m-3 border-1">

                                <div class="col-12 text-center">
                                    <img class="mx-auto p-3 bg-lightest" src="<?= $_ImgProfil_->getUrlHeadByPseudo($answerd[$i]['pseudo'], 128); ?>" style="width: 128px; height: 128px;" alt="avatar de <?= $answerd[$i]['pseudo']; ?>"/>
                                </div>
                                <div class="col-12 mx-auto bg-darkest" style="width: 192px; height: 192px;">
                                    <div class="text-center py-3">
                                        <h4 class="text-active">
                                            <?= $answerd[$i]['pseudo']; ?>
                                        </h4>
                                        <h6>
                                            <?= Permission::getInstance()->gradeJoueur($answerd[$i]['pseudo']); ?>
                                        </h6>

                                        <!-- Edition -->
                                        <?php if ($_Joueur_['pseudo'] === $answerd[$i]['pseudo'] or Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'editMessage') and !$_SESSION['mode']) : ?>


<table class="text-center w-100">
    <tr>
        <td>

                                            <form action="?action=editPost" method="post">
                                                <input type="hidden" name="objet" value="answer" />
                                                <input type="hidden" name="id" value="<?= $answerd[$i]['id']; ?>" />
                                                <button type="submit" class="btn btn-secondary">
                                                    <i class="fa-solid fa-pen"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                        <?php if ($_Joueur_['pseudo'] === $answerd[$i]['pseudo'] or Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'deleteMessage') and !$_SESSION['mode']) : ?>
        </td>
        <td>
<form action="?action=remove_answer" method="post">
                                                <input type="hidden" name="id_answer" value="<?= $answerd[$i]['id']; ?>" />
                                                <input type="hidden" name="page" value="<?= (isset($_GET['page_post'])) ? $_GET['page_post'] : 1; ?>" />
                                                <a class="btn btn-danger no-hover" role="button" data-toggle="modal" href="#awnser_<?= $answerd[$i]['id']; ?>" aria-expanded="false" aria-controls="modalConfirmation">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>

                                                <div class="modal fade" id="awnser_<?= $answerd[$i]['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalConfirmation" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content bg-danger">

                                                            <div class="modal-header bg-danger">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body bg-danger rounded py-4">
                                                                <h5>Voulez-vous vraiement <span class="font-weight-bolder">Supprimer</span> ce message ?</h5>
                                                                <h6>Plus aucune donnée de ce message ne pourra être récupéré.</h6>
                                                            </div>

                                                            <div class="modal-footer bg-danger">
                                                                <button type="submit" class="btn btn-secondary w-100">
                                                                    Confirmer la suppression de ce message !
                                                                </button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php endif; ?>

        </td>
    </tr>
</table>

                                            

                                    </div>
                                </div>

                            </div>

                            <!-- Contenue du topic de l'auteur -->
                            <div class="col-lg-8 col-md-12 col-sm-12 mt-3 p-4 bg-lightest border border-1 shadow rounded">

                                <?php
                                $answere = $answerd[$i]['contenue'];

                                $signature = $_Forum_->getSignature($answerd[$i]['pseudo']);

                                $d_edition = explode('-', $answerd[$i]['d_edition']);

                                $countlike = $_Forum_->compteLike($answerd[$i]['id'], $count3, 1);
                                $countdislike = $_Forum_->compteDisLike($answerd[$i]['id'], $count4, 1);

                                $count1 += 1;
                                $count2 += 1;
                                ?>

                                <h4>Contenue du message :</h4>
                                <hr class="bg-darkest mt-0" style="border-top-style: dotted;">

                                <div class="m-2 h5" id="contenuePost<?=$i?>" style="text-overflow: clip; word-wrap: break-word;">
                                    <?= $answere; ?>
                                </div>

                                <hr class="bg-main mt-3 w-80">

                                <div class="col-12 text-center">
                                    <div class="ml-3">
                                        <?= $signature; ?>
                                    </div>

                                    <?php if (isset($_Joueur_)) : ?>
                                            <form action="?action=signalement" method="post">
                                                <button type="button" onclick="addBlockQuote('ckeditorPost','contenuePost<?=$i?>', '<?= $answerd[$i]['pseudo']; ?>');" class="btn btn-dark float-right mb-2" style="margin-right:15px;">Citer le message</button>
                                                <input type="hidden" name="id_topic" value='<?= $answerd[$i]['id']; ?>' />
                                                <button type="submit" class="btn btn-danger float-right mb-2">Signaler le message !</button>
                                            </form>
                                            
                                    <?php endif; ?>
                                <p class="text-right h6">
                                    <?php 
                                    echo 'Posté le  '.$_Forum_->conversionDate($answerd[$i]['date_post']); 
                                    if($answerd[$i]['d_edition'] != NULL) {
                                        echo " et édité le ". $_Forum_->conversionDate($answerd[$i]['d_edition']);
                                    }?>
                                </p>
                                </div>
                            </div>
                        </div>

                    <?php endfor; ?>
                    <hr class="bg-main" />

                    <nav aria-label="Page Navigation Post">
                        <ul class="pagination justify-content-end">
                            <?php for ($i = 1; $i <= $count_nbrOfPages; $i++) : ?>

                                <li class="page-item">
                                    <a class="page-link" href="index.php?page=post&id=<?= $id; ?>&page_post=<?= $i; ?>">
                                        <?= $i; ?>
                                    </a>
                                </li>

                            <?php endfor; ?>
                        </ul>
                    </nav>

                    <?php if ($topicd['etat'] == 1 and (!Permission::getInstance()->verifPerm('PermsForum', 'general', 'seeForumHide') and $_SESSION['mode'])) : ?>

                        <div class="d-flex col-12 info-page">
                            <i class="fas fa-window-close notification-icon"></i>
                            <div class="info-content">
                                Le topic est fermé ! Aucune réponse n'est possible !
                            </div>
                        </div>

                    <?php elseif (isset($_Joueur_) && ($topicd['etat'] == 0 or (Permission::getInstance()->verifPerm('PermsForum', 'general', 'seeForumHide') and !$_SESSION['mode']))) : ?>

                        <hr class="my-2 bg-lightest w-80" />

                        <div class="col-12 mb-4 mx-auto">

                            <?php $data = $_Forum_->isLock($topicd['id_categorie']);
                            if ($data['close'] == 0 or Permission::getInstance()->verifPerm('PermsForum', 'general', 'seeForumHide') and !$_SESSION['mode']) : ?>



                                <form action="?action=post_answer" method="post">
                                    <input type='hidden' name="id_topic" value="<?= $id; ?>" />

                                    <div class="form-row">

                                        <div class="col-md-12 text-center">
                                            
                                            <textarea  data-UUID="0003" id="ckeditorPost" name="contenue" style="height: 750px; margin: 0px; width: 100%;"></textarea>
                                        </div>

                                    </div>

                                    <div class="form-row text-center" style="margin-top:15px;">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Poster votre réponse</button>
                                        </div>
                                    </div>

                                </form>


                            <?php elseif (!Permission::getInstance()->verifPerm("connect")) : ?>
                                <div class="d-flex col-12 info-page">
                                    <i class="fas fa-sign-in-alt notification-icon"></i>
                                    <div class="info-content">
                                        Connectez-vous pour intéragir !
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>

                    <?php endif; ?>

                </div>
            </section>

<?php else :
            header('Location: index.php?page=erreur&erreur=7');
        endif;
    else :
        header('Location: index.php');
    endif;
else :
    header('Location: index.php?page=erreur&erreur=17'); //fatale
endif; ?>