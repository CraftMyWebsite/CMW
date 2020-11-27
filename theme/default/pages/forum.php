<?php
$fofo = $_Forum_->affichageForum();
?>

<section id="Forum">
    <div class="container-fluid col-md-9 col-lg-9 col-sm-10">
        <div class="row">
            <!-- Présentation -->
            <div class="info-page col-12">
                <div class="d-flex">
                    <i class="fas fa-info-circle notification-icon"></i>
                    <div class="info-content">
                        Bienvenue sur le forum de <?= $_Serveur_['General']['name']; ?>, <br>
                        Ici vous pourrez échanger et partager avec toute la communauté du serveur !
                    </div>
                </div>
                <div class="d-flex col-12 col-sm-6 col-lg-4" style="margin:auto;">
                     <div class="input-group" >
                        <input type="text" id="search-topic" class="form-control" placeholder="Rechercher un topic ou un message" />
                            <div class="input-group-append" >
                                 <span onclick="searchForum(document.getElementById('search-topic').value, document.getElementById('all-search'), document.getElementById('table-search'),document.getElementById('title-search'))" style="border: none;" class="input-group-text btn btn-main" style="cursor:pointer;"><i class="fas fa-search"></i>
                                </span>
                        </div>
                    </div>
                </div>
             </div>
        </div>
        <div class="row" style="display:none;" id="all-search">
            <table class="table table-dark table-striped" style="display:none;">
                <thead>
                    <tr>
                     <th colspan="5" style="width: <?= (Permission::getInstance()->verifPerm('PermsForum', 'general', 'deleteCategorie') and !$_SESSION['mode']) ? '75%' : '100%'; ?>;">
                        <h5 class="text-center" id="title-search"></h5>
                    </tr>
                    <tr>
                        <th style="width: 5%">
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
                <tbody id="table-search">

                </tbody>
            </table>
            </hr>
        </div>
        <div class="row">
            <?php if (Permission::getInstance()->verifPerm('PermsForum', 'general', 'modeJoueur')) : ?>
                <p class="text-center">
                    <a href="?action=mode_joueur" class="btn btn-main w-100">Passer en mode visuel <?= ($_SESSION['mode']) ? "Administrateur" : "Joueur"; ?></a>
                </p>
            <?php endif; ?>

            <?php for ($i = 0; $i < count($fofo); $i++) :
                if (((Permission::getInstance()->verifPerm('PermsDefault', 'forum', 'perms') >= $fofo[$i]['perms'] or Permission::getInstance()->verifPerm("createur")) and !$_SESSION['mode']) or $fofo[$i]['perms'] == 0) : ?>

                    <table class="table table-dark table-striped">

                        <!-- Edition du forum -->
                        <div class="row ml-auto">
                            <?php if (Permission::getInstance()->verifPerm('PermsForum', 'general', 'deleteForum') and !$_SESSION['mode']) : ?>

                                <div>


                                    <div class="dropdown d-inline-block">

                                        <button class="btn btn-main dropdown-toggle" type="button" id="perms<?= $fofo[$i]['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Modifier les Permissions
                                        </button>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                            <form action="?action=modifPermsForum" method="POST">
                                                <input type="hidden" name="id" value="<?= $fofo[$i]['id']; ?>" />
                                                <a class="dropdown-item"><input type="number" name="perms" value="<?= $fofo[$i]['perms']; ?>" class="form-control"></a>
                                                <button type="submit" class="dropdown-item text-center">Modifier</button>
                                            </form>

                                        </div>

                                    </div>

                                    <div class="dropdown d-inline-block">

                                        <button class="btn btn-main dropdown-toggle" type="button" id="ordreforum<?= $fofo[$i]['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Modifier l'ordre
                                        </button>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="?action=ordreForum&ordre=<?= $fofo[$i]['ordre']; ?>&id=<?= $fofo[$i]['id']; ?>&modif=monter">
                                                <i class="fas fa-arrow-up"></i> Monter d'un cran
                                            </a>
                                            <a class="dropdown-item" href="?action=ordreForum&ordre=<?= $fofo[$i]['ordre']; ?>&id=<?= $fofo[$i]['id']; ?>&modif=descendre">
                                                <i class="fas fa-arrow-down"></i> Descendre d'un cran
                                            </a>
                                        </div>

                                    </div>

                                    <a href="?action=remove_forum&id=<?php echo $fofo[$i]['id']; ?>" class="btn btn-danger no-hover">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </a>

                                </div>

                            <?php endif; ?>
                        </div>

                        <thead>
                            <tr>
                                <th colspan="5" style="width: <?= (Permission::getInstance()->verifPerm('PermsForum', 'general', 'deleteCategorie') and !$_SESSION['mode']) ? '75%' : '100%'; ?>;">
                                    <h5 class="text-center" <?php if (Permission::getInstance()->verifPerm('PermsForum', 'general', 'deleteForum') and !$_SESSION['mode']) { ?>data-editforum-index="<?= $i; ?>" data-editforum="<?php echo $fofo[$i]['id']; ?>" <?php } ?>>
                                        <span style="display:inline;"><?= ucfirst($fofo[$i]['nom']); ?></span> <input type="text" class="text-center no-hover" value="<?= ucfirst($fofo[$i]['nom']); ?>" style="width:auto;color:white;display:none;background: transparent;border: none;" > <i style="display:none;" style="cursor:pointer" class="fas fa-cog"></i>
                                    </h5>
                                </th>
                                <?php if (Permission::getInstance()->verifPerm('PermsForum', 'general', 'deleteCategorie') and !$_SESSION['mode']) : ?>
                                    <th class="text-center">
                                        <h5>
                                            Actions
                                        </h5>
                                    </th>
                                <?php endif; ?>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $categorie = $_Forum_->infosForum($fofo[$i]['id']);
                            for ($j = 0; $j < count($categorie); $j++) :
                                $derniereReponse = $_Forum_->derniereReponseForum($categorie[$j]['id']);

                                if (((Permission::getInstance()->verifPerm("createur") or Permission::getInstance()->verifPerm('PermsDefault', 'forum', 'perms') > $categorie[$j]['perms']) and !$_SESSION['mode']) or $categorie[$j]['perms'] == 0) :

                                    
                                    if (Permission::getInstance()->verifPerm("createur") and !$_SESSION['mode'])
                                        $perms = 100;
                                    elseif (Permission::getInstance()->verifPerm('PermsDefault', 'forum', 'perms') > 0)
                                        $perms = Permission::getInstance()->verifPerm('PermsDefault', 'forum', 'perms');
                                    else
                                        $perms = 0;

                                    $sousforum = $bddConnection->prepare('SELECT * FROM cmw_forum_sous_forum WHERE id_categorie = :id_categorie AND perms <= :perms');
                                    $sousforum->execute(array(
                                        'id_categorie' => $categorie[$j]['id'],
                                        'perms' => $perms
                                    ));
                                    $sousforum = $sousforum->fetchAll(PDO::FETCH_ASSOC);

                            ?>

                                    <tr>

                                        <td style="width: 3%;">
                                            <?php if ($categorie[$j]['img'] == NULL) : ?>
                                                <a href="?&page=forum_categorie&id=<?= $categorie[$j]['id']; ?>" style="font-size: 38px;" class="d-flex align-self-center text-center">
                                                    <i class="far fa-comment-dots"></i>
                                                </a>
                                            <?php else : ?>
                                                <a href="?page=forum_categorie&id=<?= $categorie[$j]['id']; ?>" style="font-size: 38px;" class="d-flex align-self-center text-center">
                                                    <i class="<?php echo $categorie[$j]['img']; ?>"></i>
                                                </a><?php endif; ?>
                                        </td>

                                        <td style="width: 25%;">
                                            <a href="?&page=forum_categorie&id=<?= $categorie[$j]['id']; ?>" class="d-flex align-self-center">
                                                <?= $categorie[$j]['nom']; ?>
                                            </a>

                                            <?php if (count($sousforum) != 0) : ?>
                                                <small>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle" href="sous-forum<?= $categorie[$j]['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="width: 99.5%;">
                                                            Sous-forum :<?= count($sousforum); ?>
                                                        </a>
                                                        <?php if (count($sousforum) != "0") : ?>
                                                            <div class="dropdown-menu" aria-labelledby="sous-forum<?php echo $categorie[$j]['id']; ?>">
                                                                <?php for ($s = 0; $s < count($sousforum); $s++) : ?>
                                                                    <a class="dropdown-item" href="?&page=forum_categorie&id=<?= $categorie[$j]['id']; ?>&id_sous_forum=<?= $sousforum[$s]['id']; ?>">
                                                                        <?= $sousforum[$s]['nom']; ?>
                                                                    </a>
                                                                <?php endfor; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </small>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-center">
                                            <a href="?&page=forum_categorie&id=<?= $categorie[$j]['id']; ?>">
                                                <?= $CountTopics = $_Forum_->compteTopicsForum($categorie[$j]['id']); ?>
                                                <br>
                                                <span class="text-uppercase">Discussions</span>
                                            </a>
                                        </td>

                                        <td class="text-center">
                                            <a href="?page=forum_categorie&id=<?= $categorie[$j]['id']; ?>">
                                                <?= $_Forum_->compteMessages($categorie[$j]['id']) + $CountTopics; ?>
                                                <br>
                                                <span class="text-uppercase">Messages</span>
                                            </a>
                                        </td>

                                        <td class="text-center">
                                            <?php if ($derniereReponse) : ?>
                                                <a href="?page=post&id=<?= $derniereReponse['id']; ?>" title="<?= $derniereReponse['titre']; ?>">
                                                    Dernier: <?php $taille = strlen($derniereReponse['titre']);
                                                                echo substr($derniereReponse['titre'], 0, 15);
                                                                if (strlen($taille > 15)) {
                                                                    echo '...';
                                                                } ?>
                                                    <br>
                                                    <?= $derniereReponse['pseudo']; ?>, Le
                                                    <?php $date = explode('-', $derniereReponse['date_post']);
                                                    echo '' . $date[2] . '/' . $date[1] . '/' . $date[0] . ''; ?>
                                                </a>
                                            <?php else : ?>
                                                <p> Il n'y a pas de sujet dans ce forum </p>
                                            <?php endif; ?>
                                        </td>

                                        <?php if (Permission::getInstance()->verifPerm('PermsForum', 'general', 'deleteCategorie') and !$_SESSION['mode']) : ?>

                                            <td>
                                                <div class="mx-auto d-flex align-self-center">

                                                    <div class="dropdown d-inline ml-1">
                                                        <button type="button" class="btn btn-main dropdown-toggle" id="Perms<?= $categorie[$j]['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-edit"></i>
                                                        </button>

                                                        <div class="dropdown-menu">
                                                            <form action="?action=modifPermsCategorie" method="POST">
                                                                <input type="hidden" name="id" value="<?= $categorie[$j]['id']; ?>" />
                                                                <a class="dropdown-item">
                                                                    <input type="number" name="perms" value="<?= $categorie[$j]['perms']; ?>" class="form-control custom-text-input">
                                                                </a>
                                                                <button type="submit" class="dropdown-item text-center btn btn-reverse w-80 mx-auto mt-3">Modifier</button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <div class="dropdown d-inline ml-1">
                                                        <button type="button" class="btn btn-main dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-list"></i>
                                                        </button>

                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="?action=ordreCat&ordre=<?= $categorie[$j]['ordre']; ?>&id=<?= $categorie[$j]['id']; ?>&forum=<?= $categorie[$j]['forum']; ?>&modif=monter">
                                                                <i class="fas fa-arrow-up"></i> Monter d'un cran
                                                            </a>
                                                            <a class="dropdown-item" href="?action=ordreCat&ordre=<?= $categorie[$j]['ordre']; ?>&id=<?= $categorie[$j]['id']; ?>&forum=<?= $categorie[$j]['forum']; ?>&modif=descendre">
                                                                <i class="fas fa-arrow-down"></i> Descendre d'un cran
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <button type="button" onclick="openModalEditForum(<?= $categorie[$j]['id']; ?>,'<?= $categorie[$j]['nom']; ?>',<?php echo $fofo[$i]['id']; ?>, <?php if ($categorie[$j]['img'] == NULL) { echo 'null'; }  else { echo "'".$categorie[$j]['img']."'";} ?> );" class="btn btn-main ml-1" >
                                                        <i class="fas fa-cog"></i>
                                                    </button>

                                                    <?php if ($categorie[$j]['close'] == 0) : ?>

                                                        <a href="?action=lock_cat&id=<?= $categorie[$j]['id']; ?>&lock=1" title="Fermer le forum" class="btn btn-reverse ml-1 no-hover">
                                                            <i class="fas fa-unlock-alt" aria-hidden="true"></i>
                                                        </a>

                                                    <?php else : ?>

                                                        <a href="?action=unlock_cat&id=<?= $categorie[$j]['id']; ?>&lock=0" title="Ouvrir le forum" class="btn btn-reverse ml-1 no-hover">
                                                            <i class="fas fa-lock" aria-hidden="true"></i>
                                                        </a>

                                                    <?php endif; ?>


                                                    <a href="?action=remove_cat&id=<?= $categorie[$j]['id']; ?>" class="btn btn-danger no-hover ml-1">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>




                                                </div>
                                            </td>

                                        <?php endif; ?>

                                    </tr>

                                <?php endif; ?>

                            <?php endfor; ?>
                        </tbody>

                    </table>

                <?php endif; ?>
            <?php endfor; ?>
        </div>

        <hr>

        <div class="row">
            <?php if (Permission::getInstance()->verifPerm('PermsForum', 'general', 'addForum') and !$_SESSION['mode']) : ?>

                <a class="btn btn-reverse no-hover col-5 mr-auto" role="button" data-toggle="collapse" href="#add_forum" aria-expanded="false" aria-controls="add_forum">
                    Ajouter une Catégorie
                </a>

            <?php endif; ?>

            <?php if (Permission::getInstance()->verifPerm('PermsForum', 'general', 'addCategorie') and !$_SESSION['mode']) : ?>

                <a class="btn btn-reverse no-hover col-5 ml-auto" role="button" data-toggle="collapse" href="#add_categorie" aria-exepanded="false" aria-controls="add_categorie">
                    Ajouter un Forum
                </a>

                <div class="collapse col-8 m-3 mx-auto" id="add_categorie">

                    <div class="card">
                        <form action="?action=create_cat" method="post">

                            <div class="card-header">
                                <h4>Ajouter un forum</h4>
                            </div>

                            <div class="card-body">

                                <div class="form-row my-2">

                                    <label for="nomCat">Nom du Forum <span class="star-required"></span></label>
                                    <input type="text" name="nom" id="nomCat" maxlength="40" class="form-control custom-text-input" required />

                                </div>

                                <div class="form-row my-2">

                                    <label for="img">
                                        Icône
                                    </label>
                                    <input type="text" name="img" id="img" maxlength="300" placeholder='<i class="far fa-comment-dots"></i>' class="form-control custom-text-input" />
                                    <small id="imgHelp" class="form-text text-muted">
                                        disponible sur : <a href="https://fontawesome.com/icons/" target="_blank">https://fontawesome.com/icons/</a>
                                    </small>

                                </div>

                                <div class="form-row my-2">

                                    <label for="forum">Catégorie <span class="star-required"></span></label>
                                    <select name="forum" class="form-control custom-text-input" required>

                                        <?php for ($z = 0; $z < count($fofo); $z++) : ?>
                                            <option value="<?= $fofo[$z]['id']; ?>">
                                                <?= $fofo[$z]['nom']; ?>
                                            </option>
                                        <?php endfor; ?>

                                    </select>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-main w-100">Créer un Forum</button>
                            </div>
                        </form>
                    </div>
                </div>

            <?php endif; ?>



            <?php if (Permission::getInstance()->verifPerm('PermsForum', 'general', 'addForum') and !$_SESSION['mode']) :  ?>

                <div class="collapse col-8 m-3 mx-auto" id="add_forum">
                    <div class="card">
                        <form action="?action=create_forum" method="post">

                            <div class="card-header">
                                <h4>Ajouter une catégorie</h4>
                            </div>

                            <div class="card-body">

                                <label for="nomFo">Nom de la catégorie <span class="star-required"></span></label>
                                <input type="text" name="nom" id="nomFo" maxlength="80" class="form-control custom-text-input" required>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-main w-100">Créer une catégorie</button>
                            </div>

                        </form>
                    </div>
                </div>

            <?php endif; ?>
        </div>
        
    </div>
</section>