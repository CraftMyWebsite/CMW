<?php
$id = $_GET['id'];
$categoried = $_Forum_->infosCategorie($id);

if (!isset($id)) {
    header('Location: ?page=erreur&erreur=16');
}

if (!$_Forum_->exist($id)) {
    header('Location: index.php?page=erreur&erreur=17');
}

if (isset($_GET['id_sous_forum'])) {
    $id_sous_forum = $_GET['id_sous_forum'];
}

if (isset($id_sous_forum)) {
    $sousforumd = $_Forum_->SousForum($id_sous_forum);
} else {
    $sousforumd = $_Forum_->infosSousForum($id, 0);
}

if (!(((Permission::getInstance()->verifPerm("createur") || Permission::getInstance()->verifPerm('PermsDefault', 'forum', 'perms') >= $categoried['perms']) && !$_SESSION['mode']) or $categoried['perms'] == 0)) {
    header('Location: ?page=erreur&erreur=7');
}

$titleHTML = $categoried['nom'];
if(isset($id_sous_forum))
    $titleHTML .= " > ".$sousforumd['nom'];
?>
<script type="application/javascript">  document.title = "<?=$_Serveur_['General']['name'] . " | " . $titleHTML;?>"; </script>
<section id="ForumCategorie">
    <div class="container-fluid col-md-9 col-lg-9 col-sm-10">
        <div class="row">

            <?php if ($_SESSION['mode']) : ?>
                <div class="alert alert-warning w-80 mx-auto mt-3" role="alert">
                    <p style="margin-bottom: 0;" class="text-center">Vous êtes en Mode Joueur. Pour changer de mode, passez sur la page forum.</p>
                </div>
            <?php endif; ?>

        </div>

        <div class="row mt-4">

            <nav aria-label="breadcrumb" role="navigation" class='w-100'>
                <ol class="breadcrumb bg-lightest">

                    <li class="breadcrumb-item ml-4"><a href="/">Accueil</a></li>

                    <li class="breadcrumb-item"><a href="?page=forum">Forum</a></li>

                    <?php if (isset($id_sous_forum)) : ?>
                        <li class="breadcrumb-item"> <a href="?page=forum_categorie&id=<?= $id ?>"> <?= $categoried['nom'] ?> </a></li>
                    <?php else : ?>
                        <li class="breadcrumb-item"><?= $categoried['nom'] ?> </li>
                    <?php endif; ?>

                    <?php if (isset($id_sous_forum)) : ?>
                        <li class="breadcrumb-item"><?= $sousforumd['nom'] ?></li>;
                    <?php endif; ?>

                </ol>
            </nav>

        </div>

        <!-- Affichage des sous-forums -->

        <div class="row">

            <?php if (!empty($sousforumd['id']) && !isset($id_sous_forum)) : ?>

                <h3>Les sous-Catégories de <?= $categoried['nom']; ?></h3>

                <table class="table table-dark table-striped">
                    <thead>
                        <tr>

                            <th style="width: 5%"></th>
                            <th style="width: 65%">Nom</th>
                            <th>Discussions</th>
                            <th>Messages</th>
                            <?php if (Permission::getInstance()->verifPerm('PermsForum', 'general', 'deleteSousForum') and !$_SESSION['mode']) : ?>
                                <th style="width: 28%">Actions</th>
                            <?php endif; ?>

                        </tr>
                    </thead>

                    <tbody>

                        <?php $sousforumd = $_Forum_->infosSousForum($id, 1); ?>

                        <?php for ($a = 0; $a < count($sousforumd); $a++) : ?>

                            <?php if (((Permission::getInstance()->verifPerm("createur") or Permission::getInstance()->verifPerm('PermsDefault', 'forum', 'perms') >= $sousforumd[$a]['perms']) and !$_SESSION['mode']) or $sousforumd[$a]['perms'] == 0) : ?>

                                <tr>

                                    <td>

                                        <?php if ($sousforumd[$a]['img'] == NULL) : ?>
                                            <a style="font-size: 28px;" href="?page=sous_forum_categorie&id=<?= $id; ?>&id_sous_forum=<?= $sousforumd[$a]['id']; ?>">
                                               <i class="far fa-comment-dots"></i>
                                            </a>
                                        <?php else : ?>
                                            <a style="font-size: 28px;" href="?page=sous_forum_categorie&id=<?= $id; ?>&id_sous_forum=<?= $sousforumd[$a]['id']; ?>"><i class="<?= $sousforumd[$a]['img']; ?>"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <a href="?page=sous_forum_categorie&id=<?= $id; ?>&id_sous_forum=<?= $sousforumd[$a]['id']; ?>">
                                            <?= $sousforumd[$a]['nom']; ?>
                                        </a>
                                    </td>

                                    <td>
                                        <a href="?page=sous_forum_categorie&id=<?= $id; ?>&id_sous_forum=<?= $sousforumd[$a]['id']; ?>">
                                            <?= $_Forum_->compteTopicsSF($sousforumd[$a]['id']); ?>
                                        </a>
                                    </td>

                                    <td>
                                        <a href="?page=sous_forum_categorie&id=<?= $id; ?>&id_sous_forum=<?= $sousforumd[$a]['id']; ?>">
                                            <?= $_Forum_->compteAnswerSF($sousforumd[$a]['id']); ?>
                                        </a>
                                    </td>

                                    <?php if (Permission::getInstance()->verifPerm('PermsForum', 'general', 'deleteSousForum') and !$_SESSION['mode']) : ?>

                                        <td>
                                            <div class="mx-auto d-flex align-self-center">

                                                    <div class="dropdown d-inline ml-1">
                                                        <button type="button" class="btn btn-main dropdown-toggle" id="Perms<?= $categorie[$j]['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-edit"></i>
                                                        </button>

                                                        <div class="dropdown-menu">
                                                            <form action="?action=modifPermsSousForum" method="POST">
                                                                <input type="hidden" name="id" value="<?= $sousforumd[$a]['id']; ?>" />
                                                                <a class="dropdown-item"><input class="form-control custom-text-input" type="number" name="perms" value="<?= $sousforumd[$a]['perms']; ?>" class="form-control"></a>
                                                                <button type="submit" class="dropdown-item text-center btn btn-reverse w-80 mx-auto mt-3">Modifier</button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <div class="dropdown d-inline ml-1">
                                                        <button type="button" class="btn btn-main dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-list"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="?action=ordreSousForum&ordre=<?= $sousforumd[$a]['ordre']; ?>&id=<?= $sousforumd[$a]['id']; ?>&id_cat=<?= $sousforumd[$a]['id_categorie']; ?>&modif=monter"><i class="fas fa-arrow-up"></i> Monter d'un cran</a>
                                                            <a class="dropdown-item" href="?action=ordreSousForum&ordre=<?= $sousforumd[$a]['ordre']; ?>&id=<?= $sousforumd[$a]['id']; ?>&id_cat=<?= $sousforumd[$a]['id_categorie']; ?>&modif=descendre"><i class="fas fa-arrow-down"></i> Descendre d'un cran</a>
                                                        </div>
                                                    </div>

                                                    <button type="button" onclick="openModalEditSousForum(<?= $id; ?>,<?= $sousforumd[$a]['id']; ?>, <?= $a; ?>, '<?= $sousforumd[$a]['nom']; ?>', <?php if ($sousforumd[$a]['img'] == NULL) { echo 'null';} else { echo "'".$sousforumd[$a]['img']."'"; } ?>);" class="btn btn-main ml-1" > 
                                                        <i class="fas fa-cog"></i>
                                                    </button>

                                                    <?php if ($sousforumd[$a]['close'] == 0) : ?>

                                                        <a href="?action=lock_sf&id_f=<?= $sousforumd[$a]['id_categorie']; ?>&id=<?= $sousforumd[$a]['id']; ?>&lock=1" title="Fermer le sous-forum" class="btn btn-reverse ml-1 no-hover">
                                                            <i class="fas fa-unlock-alt" aria-hidden="true"></i>
                                                        </a>

                                                    <?php else : ?>

                                                        <a href="?action=unlock_sf&id_f=<?= $sousforumd[$a]['id_categorie']; ?> &id=<?= $sousforumd[$a]['id']; ?>&lock=0" title="Ouvrir le sous-forum" class="btn btn-reverse ml-1 no-hover">
                                                            <i class="fas fa-lock" aria-hidden="true"></i>
                                                        </a>

                                                    <?php endif; ?>


                                                    <a class="btn btn-danger no-hover ml-1" href="?action=remove_sf&id_cat=<?php echo $id; ?>&id_sf=<?php echo $sousforumd[$a]['id']; ?>"><i class="fas fa-trash-alt"></i></a>

                                                </div>

                                        </td>

                                    <?php endif; ?>

                                </tr>

                        <?php endif;
                        endfor; ?>
                    </tbody>
                </table>
            <?php endif; ?>

        </div>

        <!-- Création de sous-forum -->


        <?php if (Permission::getInstance()->verifPerm('PermsForum', 'general', 'addSousForum') and !$_SESSION['mode'] && !isset($id_sous_forum)) : ?>
            <div class="row">

                <div class="col-12">
                    <div class="float-right">
                        <a class="btn btn-main px-4" role="button" data-toggle="collapse" href="#sous_cat" aria-expanded="false" aria-controls="collapseExample">
                            Créez un sous-forum
                        </a>
                    </div>
                </div>

                <div class="collapse col-8 mt-3 mx-auto" id="sous_cat">
                    <div class="card">
                        <form action="?action=create_sf" method="post">

                            <div class="card-header">
                                <h4>Création d'un sous-forum</h4>
                            </div>

                            <div class="card-body">

                                <div class="form-row ">
                                    <input type="hidden" name="id_categorie" value="<?= $id; ?>" />
                                    <label class="control-label" for="nomSF">Nom</label>
                                    <input type="text" required class="form-control custom-text-input" name="nom" id="nomSF" maxlength="40" />
                                </div>

                                <div class="form-row py-2">
                                    <label class="control-label" for="img">Icône</label>
                                    <input type="text" maxlength="300" name="img" id="img" placeholder='<i class="far fa-comment-dots"></i>' class="form-control custom-text-input" />
                                    <small id="iconHelp" class="form-text text-muted">
                                        Icônes disponible : <a href="https://fontawesome.com/icons/" target="_blank">https://fontawesome.com/icons/</a>
                                    </small>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-main w-100">Créer un sous-forum</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        <?php endif; ?>

        <div class="row">

            <h3>
                Les topics de <?= $categoried['nom'] ?> <?= (isset($id_sous_forum)) ? ' - ' . $sousforumd['nom'] : ''; ?>
            </h3>
            <?php
            $count_topic_max2 = (isset($id_sous_forum)) ?  $_Forum_->compteTopicsSF($id_sous_forum) :  $_Forum_->compteTopics($id);
            $count_topic_nbrOfPages2 = ceil($count_topic_max2 / 20);

            $page = (isset($_GET['page_topic'])) ? $_GET['page_topic'] : 1;

            $count_topic_FirstDisplay2 = ($page - 1) * 20;
            $topicd = (isset($id_sous_forum)) ? $_Forum_->infosSousForumTopics($id_sous_forum, $count_topic_FirstDisplay2) : $_Forum_->infosTopics($id, $count_topic_FirstDisplay2);

            if ($count_topic_max2 > 0) : ?>

                <table class="table table-dark table-striped">

                    <thead>
                        <tr>
                            <?php if (Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'selTopic')  && !$_SESSION['mode']) : ?>
                                <th>
                                    <!-- Vide -->
                                </th>
                            <?php endif; ?>
                            <th style="width: 5%">
                                <!-- Vide -->
                            </th>
                            <th class="w-50">
                                Nom du topic
                            </th>
                            <th>
                                Réponses
                            </th>
                            <th>
                                Dernière réponse
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        for ($i = 0; $i < count($topicd); $i++) :
                            if (((Permission::getInstance()->verifPerm("createur") or Permission::getInstance()->verifPerm('PermsDefault', 'forum', 'perms') >= $topicd[$i]['perms']) and !$_SESSION['mode']) or $topicd[$i]['perms'] == 0) : ?>

                                <tr>
                                    <?php if (Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'selTopic') && !$_SESSION['mode']) : ?>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input name="selection" id="selection-<?= $topicd[$i]['id']; ?>" type="checkbox" class="custom-control-input" value="<?= $topicd[$i]['id']; ?>" />
                                                <label for="selection-<?= $topicd[$i]['id']; ?>" class="custom-control-label"></label>
                                            </div>
                                        </td>
                                    <?php endif; ?>

                                    <td>
                                        <a href="?page=profil&profil=<?= $topicd[$i]['pseudo']; ?>">
                                            <img src="<?= $_ImgProfil_->getUrlHeadByPseudo($topicd[$i]['pseudo'], 42); ?>" style="width: 42px; height: 42px;" alt="avatar de l'auteur <?= $_Joueur_['pseudo']; ?>" title="<?= $topicd[$i]['pseudo']; ?>" />
                                        </a>
                                    </td>

                                    <td>
                                        <a href="?page=post&id=<?= $topicd[$i]['id']; ?>">
                                            <?php if (isset($topicd[$i]['prefix']) && $topicd[$i]['prefix'] != 0) : ?>
                                                <?= $_Forum_->getPrefix($topicd[$i]['prefix']); ?>
                                            <?php endif; ?>
                                            <?= $topicd[$i]['nom']; ?>
                                        </a>
                                        <p>
                                            <small>
                                                <a href="?page=profil&profil=<?= $topicd[$i]['pseudo']; ?>">
                                                    <?= $topicd[$i]['pseudo']; ?>
                                                </a>, le <?= $_Forum_->conversionDate($topicd[$i]['date_creation']); ?>
                                            </small>
                                        </p>
                                    </td>

                                    <td>
                                        <p>Réponses : <?= $_Forum_->compteReponse($topicd[$i]['id']); ?>
                                    </td>

                                    <td>
                                        <a href="?page=post&id=<?= $topicd[$i]['id']; ?>">
                                            <?= $_Forum_->conversionLastAnswer($topicd[$i]['last_answer']); ?>
                                        </a>
                                    </td>
                                </tr>

                        <?php endif;
                        endfor; ?>
                    </tbody>
                </table>

                <?php if ((Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'selTopic') or Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'closeTopic')) and !$_SESSION['mode']) : ?>
                    <div id="popover" class="w-100 container mb-3" style="display: none;">
                        <hr />

                        <form id="sel-form" method='POST' action='?action=selTopic'>

                            <div class="card">

                                <div class="card-header">
                                    <h4>Edition d'un topic</h4>
                                </div>

                                <div class="card-body">
                                    <input type='hidden' name='idCat' value='<?= $id; ?>'>
                                    <?php if (isset($id_sous_forum)) echo "<input type='hidden' name='idSF' value='$id_sous_forum'>";

                                    if (Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'addPrefix')) : ?>

                                        <div class="row">
                                            <div class="col-12 my-2">
                                                <label for='prefix'>Appliquer un préfix de discussion : </label>
                                                <select name='prefix' id='prefix' class="form-control custom-text-input">
                                                    <option value="NULL">Ne pas changer le préfix</option>
                                                    <option value='0'>Aucun</option>
                                                    <?php
                                                    $reqPrefix = $_Forum_->getPrefixModeration();
                                                    while ($donnees_prefix = $reqPrefix->fetch(PDO::FETCH_ASSOC)) : ?>
                                                        <option value="<?= $donnees_prefix['id']; ?>">
                                                            <?= $donnees_prefix['nom']; ?>
                                                        </option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>

                                    <?php endif; ?>

                                    <?php if (Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'epingle')) : ?>

                                        <div class="row my-2">
                                            <div class="col-12">
                                                    <label for='epingle' class="d-block">Epingler la discussion : </label> 
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" id="ouiEp" name="epingle" value="1">
                                                        <label class="custom-control-label" for="ouiEp">Oui</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" id="nonEp" name="epingle" value="0">
                                                        <label class="custom-control-label" for="nonEp">Non</label>
                                                    </div>
                                            </div>
                                        </div>

                                    <?php endif; ?>

                                    <?php if (Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'closeTopic')) : ?>

                                        <div class="row my-2">
                                            <div class="col-12">
                                                <label for='close'>Fermer la discussion : </label>
                                                <div class="custom-control custom-radio"> 
                                                    <input type='radio' class="custom-control-input" name='close' value='1' id='yes' />
                                                    <label for='yes' class="custom-control-label">Oui</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type='radio' class="custom-control-input" name='close' value='0' id='no' />
                                                    <label for='no' class="custom-control-label">Non</label>
                                                </div>
                                            </div>
                                        </div>

                                    <?php endif; ?>

                                    <?php if (Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'deleteTopic')) : ?>

                                        <div class="row my-2">
                                            <div class="col-12">
                                                <label for='remove'>Supprimer les discussions : </label>
                                                <div class="custom-control custom-radio">
                                                        <input type='radio' class="custom-control-input" name='remove' value='1' id='ouiSP' />
                                                        <label for='ouiSP' class="custom-control-label">Oui</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                        <input type='radio' class="custom-control-input" name='remove' value='0' id='nonSp' checked />
                                                        <label for='nonSp' class="custom-control-label">Non</label>
                                                </div>
                                            </div>
                                        </div>

                                    <?php endif; ?>

                                </div>

                                <div class="card-footer">
                                    <button type='submit' class='btn btn-main w-100'>Valider</button>
                                </div>

                            </div>

                        </form>
                    </div>
                <?php endif; ?>
            
                <nav aria-label="Page forum catégorie">
                    <ul class="pagination">
                        <?php
                        for ($i = 1; $i <= $count_topic_nbrOfPages2; $i++) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= (isset($id_sous_forum)) ? "sous_" : ""; ?>forum_categorie&id=<?= $id ?><?= (isset($id_sous_forum)) ? "&id_sous_forum=$id_sous_forum" : ""; ?>&page_topic=<?= $i; ?>">
                                    <?= $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>

            <?php else :  ?>

                <div class="alert alert-danger col-10 mx-auto my-3" role="alert">
                    <p class="text-center" style="margin-bottom: 0;">Aucun sujet n'a été posté.</p>
                </div>

            <?php endif; ?>

        </div>

        <div class="row">
            <?php if (Permission::getInstance()->verifPerm("connect") && ((($categoried['close'] == 0 and $sousforumd['close'] == 0) or Permission::getInstance()->verifPerm('PermsForum', 'general', 'seeForumHide')) and !$_SESSION['mode'])) : ?>

                <div class="card col-8 mx-auto">
                    <form action="?action=create_topic" method="post">

                        <div class="card-header">
                            <h4>
                                Poster un topic dans la catégorie <?= $categoried['nom']; ?> <?= (isset($id_sous_forum)) ?  ' et le sous-forum ' . $sousforumd['nom'] : '' ?>
                            </h4>
                        </div>

                        <div class="card-body">

                            <input type="hidden" name="id_categorie" value="<?= $id; ?>" />
                            <input type="hidden" name="sous-forum" value="<?= (isset($id_sous_forum)) ? $id_sous_forum : 'NULL' ?>" />

                            <div class="form-row my-3">
                                <label for="nom">
                                    Rentrez le nom de votre sujet/topic
                                </label>
                                <input type="text" class="form-control custom-text-input" id="nom" name="nom" placeholder="Le titre de votre topic ici" required />
                            </div>

                            <div class="col-md-12 text-center">
                               <textarea  data-UUID="0003" id="ckeditor" name="contenue" style="height: 350px; margin: 0px; width: 100%;"></textarea>

                            </div>
                        </div>

                        <div class="card-footer">
                                <button type="submit" class="btn btn-main w-100">Poster</button>
                        </div>
                    </form>
                </div>
            <?php
            elseif (!Permission::getInstance()->verifPerm("connect")) :
                echo '<div class="alert alert-warning text-center">Connectez-vous pour pouvoir interragir ! </div>';
            endif; ?>
        </div>
    </div>

    </div>

    </div>
</section>
