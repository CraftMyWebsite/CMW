<?php require_once('theme/'. $_Serveur_['General']['theme'].'/assets/php/alerts.php'); ?>
<!-- Header -->
<header>
    <div class="header-content" style="background: linear-gradient(to bottom, rgba(77, 77, 77, 0.52), rgba(68, 68, 68, 0.73)), url('theme/upload/bg.png') center;">
        <div class="container-fluid col-9">
            <!-- Navigation : -->
            <!-- Navigation Left -->
            <?php if(!isset($maintenanceOn) || Permission::getInstance()->verifPerm("PermsPanel", "maintenance", "actions", "connexionAdmin"))
            { ?>
            <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
                
                <button class="navbar-toggler navbar-toggler-right ml-auto" type="button" data-toggle="collapse" data-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarMain"> 
                
                    <?php
                    for ($i = 0; $i < count($_Menu_['MenuTexte']); $i++) :
                        // Affichage des dropdowns
                        if (isset($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]])) :
                    ?>
                        <li class="nav-item dropdown">
                            <a id="Listdefil<?php echo $i; ?>" class="nav-link dropdown-toggle" href="#" id="dropdown-tools" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_Menu_['MenuTexte'][$i]; ?></a>
                            <div class="dropdown-menu" aria-labelledby="Listdefil<?php echo $i; ?>">
                                <?php

                                for ($k = 0; $k < count($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]]); $k++) :

                                    if ($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]][$k] == '-divider-') : ?>

                                        <div class="dropdown-divider"></div>

                                    <?php else : ?>

                                        <a href="<?= $_Menu_['MenuListeDeroulanteLien'][$_Menu_['MenuTexteBB'][$i]][$k] ?>" class="dropdown-item"><?= $_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]][$k] ?></a>

                                    <?php endif; ?>
                                <?php endfor; ?>

                            </div>
                        </li>
                    <?php else :
                        // Gestion de l'active, pour la page actuelle
                        $quellePage = str_replace('index.php?&page=', '', $_Menu_['MenuLien'][$i]);
                        $quellePage1 = str_replace('?&page=', '', $_Menu_['MenuLien'][$i]);
                        $quellePage2 = str_replace('?page=', '', $_Menu_['MenuLien'][$i]);

                        if (isset($_GET['page']) and ($quellePage == $_GET['page'] or $quellePage1 == $_GET['page'] or $quellePage2 == $_GET['page'])) {
                            $active = ' active';
                        } elseif (!isset($_GET['page']) and $i == 0) {
                            $active = ' active';
                        } else {
                            $active = '';
                        } ?>

                        <li class="nav-item<?= $active ?>">
                            <a href="<?= $_Menu_['MenuLien'][$i] ?>" class="nav-link"><?= $_Menu_['MenuTexte'][$i] ?></a>
                        </li>
                <?php endif;
                endfor; ?>

                <!-- Navigation Right, s'affiche seulement si l'utilisateur n'est pas banni -->
                <?php if ($banned == false) : ?>
                    <?php if (Permission::getInstance()->verifPerm("connect")) : //Si nous avons un joueur connecté
                        $Img = new ImgProfil($_Joueur_['id']); ?>
                        <li class="nav-item dropdown ml-auto">

                            <a id="profil-<?= $_Joueur_['pseudo']; ?>" class="nav-link dropdown-toggle btn btn-main" href="#" id="dropdown-tools" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?= $_ImgProfil_->getUrlHeadByPseudo($_Joueur_['pseudo'], 24); ?>" style="margin-left: -10px; width: 24px; height: 24px"> <?= $_Joueur_['pseudo']; ?>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="profil-<?= $_Joueur_['pseudo']; ?>">

                                <?php if (Permission::getInstance()->verifPerm('PermsPanel', 'access')) : ?>
                                    <!-- Administration -->
                                    <a href="admin.php" class="dropdown-item text-success"><i class="fas fa-tachometer-alt"></i> Administration</a>
                                    <div class="dropdown-divider"></div>
                                <?php endif; ?>

                                <a class="dropdown-item" href="?page=profil&profil=<?= $_Joueur_['pseudo']; ?>"><i class="fas fa-user"></i> Mon profil</a>
                                <div class="dropdown-divider"></div>

                                <?php if (Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'seeSignalement')) :
                                    $req_report = $bddConnection->query('SELECT id FROM cmw_forum_report WHERE vu = 0');
                                    $signalement = $req_report->rowCount(); ?>
                                    <!-- Signalements -->
                                    <a href="?page=signalement" class="dropdown-item text-warning"><i class="fa fa-bell"></i> Signalement <span class="badge badge-pill badge-warning" id="signalement"><?= $signalement ?></span></a>
                                <?php endif; ?>
                                <a class="dropdown-item" href="?page=alert"><i class="fa fa-bell"></i> Alertes : <span class="badge badge-pill badge-primary" id="alerts"><?= $alerte; ?></span></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?page=token"></i> Mon solde : <?php if (isset($_Joueur_['tokens'])) echo $_Joueur_['tokens']; ?> <i class="fas fa-gem"></i></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="?action=deco"><i class="fas fa-sign-out-alt"></i> Se déconnecter</a>

                            </div>
                        </li>

                    <?php else : //Si nous avons un invité 
                    ?>
                        <li class="nav-item dropdown ml-auto">
                            <a class="nav-link dropdown-toggle btn btn-main" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i> Compte
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item hvr-forward" href="#" data-toggle="modal" data-target="#InscriptionSlide"><i class="fa fa-user-plus"></i> Inscription</a>
                                <a class="dropdown-item hvr-forward" href="#" data-toggle="modal" data-target="#ConnectionSlide"><i class="fas fa-sign-in-alt"></i> Connexion</a>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endif; 
            } ?>
            
                </div>
            </nav>

            <!-- Hero Section -->
            <section id="#Header">
                <?php if (((!isset($_GET['page']) && !isset($_GET['redirection'])) || $_GET['page'] == "accueil") && ($banned == false)) : //Si c'est la page d'acceuil 
                ?>
                    <!-- Title & Slogan -->
                    <div class="main-header-text">
                        <div class="text-center">
                            <h1><?= $_Serveur_['General']['name']; ?></h1>
                            <h3><?= $_Serveur_['General']['description']; ?></h3>
                        </div>
                    </div>


                    <!-- Social Network -->

                    <!-- Alert + Info server -->
                    <div class="header-info">
                        <div class="row">
                            <?php if (!empty($_Serveur_['General']['ipTexte'])) { ?>
                            <div class="py-3 mr-3 mb-3 col-md-12 col-sm-12 col-lg-7 d-flex align-self-center alert alert-main">
                                <h5>Tu veux nous rejoindre ? Copie l'ip ! </h5>
                                <button class="btn btn-light copy-ip ml-auto" onclick="copierIP();" type="button" >Copier l'ip !</button>
                                <input type="text" style="position:absolute;top:0;left:0;z-index:-9999;" id="iptexte" value="<?= $_Serveur_['General']['ipTexte']; ?>">
                            </div>
                            <?php }
                             ?>
                            <div class="card col-md-12 col-sm-12 col-lg-4">
                                <div class="card-header">
                                    <h3 class="text-center main-color"><?= $_Serveur_['General']['name']; ?></h3>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        État de votre serveur :
                                        <?php if ($_Serveur_['General']['statut'] == 0 || $servEnLigne == false) : ?>
                                            <span class="badge badge-danger">Hors-Ligne</span>
                                        <?php elseif ($_Serveur_['General']['statut'] == 1 && $servEnLigne == true) : ?>
                                            <span class="badge badge-success">En Ligne</span>
                                            <div class="card-text">Nombres de Joueurs : <strong><?= $playeronline ?></strong>/<?= $maxPlayers; ?></div>
                                        <?php else : ?>
                                            <span class="badge badge-warning">En Maintenance</span>
                                        <?php endif; ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : //Si c'est une page autre que celle de l'acceuil 
                ?>

                    <!-- Affichage du titre de la page -->

                    <div class="header-text">
                        <div class="text-right">

                            <?php if (isset($banned) && $banned == true) : //Si l'utilisateur est banni 
                            ?>
                                <h1 class="text-uppercase"><?= $data['titre']; ?></h1>

                            <?php elseif (isset($_GET['redirection'])) : //Si l'utilisateur doit être redirigé (maintenance) 
                            ?>
                                <h1 class="text-uppercase"><?= htmlentities($_GET['redirection']) ?></h1>

                            <?php elseif (isset($_GET['page']) && isset($_GET['profil']) && $_GET['page'] == 'profil') : //Si c'est la page de profile 
                            ?>
                                <h1 class="text-uppercase"><?= htmlentities($_GET['page']) ?> de <?= htmlentities($_GET['profil']) ?></h1>

                                <!-- Partie Forum -->
                            <?php elseif (isset($_GET['page']) && $_GET['page'] == 'editForum') : //Si c'est la page d'édition de forum
                            ?>
                                <h1 class="text-uppercase"> Edition d'<?= ($_GET['objet'] == 1) ? 'un topic' : 'une réponse'; ?> </h1>

                            <?php elseif (isset($_GET['page']) && $_GET['page'] == "forum_categorie") : //Si c'est la catégorie d'un forum
                            ?>
                                <h1 class="text-uppercase"> Forum: <?= $_Forum_->infosCategorie($_GET['id'])['nom'] ?> </h1>

                            <?php elseif (isset($_GET['page']) && $_GET['page'] == "post") : //Si c'est la page de post
                            ?>
                                <h2 class="text-uppercase"> Post: <?= $_Forum_->getTopic($_GET['id'])['nom'] ?> </h2>
                                <!-- Fin Forum -->
                                
                            <?php elseif (isset($_GET['page'])) : //Autre page 
                            ?>
                                <h1 class="text-uppercase"><?= htmlentities($_GET['page']) ?></h1>

                            <?php endif; ?>
                        </div>
                    </div>
                </section>
                <?php endif; ?>
        </div>
    </div>
</header>
