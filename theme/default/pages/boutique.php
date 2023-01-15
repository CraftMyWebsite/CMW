<section id="Shop">
    <div class="container-fluid col-md-9 col-lg-9 col-sm-10">

        <div class="row mt-4">
            <div class="col-md-12 col-lg-2 col-sm-12 mb-3">
                <!-- Catégories -->
                <div class="card">
                    <div class="card-header">
                        <h4>Catégories :</h4>
                    </div>
                    <div class="card-body categories">
                        <ul class="categorie-content nav nav-tabs">
                            <?php if (isset($categories)) : ?>
                                <!-- Affichage noms catégories -->
                                <?php for ($j = 0; $j < count($categories); $j++) : ?>
                                    <li class="categorie-item nav-item<?= ($j == 0) ? ' active' : '' ?>">
                                        <a href="#categorie-<?= $j ?>" class="nav-link categorie-link<?= ($j == 0) ? ' active' : '' ?>" data-toggle="tab">
                                            <?= $categories[$j]['titre']; ?>
                                        </a>
                                    </li>
                                <?php endfor; ?>
                            <?php else : ?>
                                <li class="no-hover bg-danger categorie-item nav-item active">
                                    <div href="#categorie-none" class="text-center nav-link categorie-link disabled" data-toggle="tab">
                                        <i class="fas fa-exclamation-triangle"></i> <br> Aucune Catégorie !
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Offres -->
            <div class="col-md-12 col-lg-8 col-sm-12 mb-5">
                <?php if (isset($categories)) : ?>
                    <div class="offres tab-content">
                        <!-- Affichage de la catégorie -->
                        <?php for ($j = 0; $j < count($categories); $j++) : ?>
                            <div id="categorie-<?= $j ?>" class="tab-pane fade <?= ($j == 0) ? ' in active show' : ''; ?>" aria-expanded="<?= ($j == 0) ? 'true' : 'false' ?>">
                                <?php if (!empty($categories[$j]['message'])) : ?>
                                    <div class="info-page">
                                        <div class="text-center"><span class="font-weight-bold">Description :</span> <?= $categories[$j]['message']; ?></div>
                                    </div>
                                <?php endif; ?>

                                <div class="row">
                                    <!-- Affichage des offres -->
                                    <?php foreach ($categories as $key => $value) {
                                        $categories[$key]['offres'] = 0;
                                    }
                                    
                                    if(isset($offresTableau) && !empty($offresTableau)) : for ($i = 1; $i <= count($offresTableau); $i++) :
                                        if(isset($_SESSION['panier']['id']) && !empty($_SESSION['panier']['id'])) {
                                            foreach($_SESSION['panier']['id'] as $itemId) {
                                                $req = $bddConnection->prepare('SELECT id FROM cmw_boutique_offres WHERE evo = :evo');
                                                $req->execute(array('evo' => $itemId));
                                                $d = $req->fetch(PDO::FETCH_ASSOC);
                                                if (isset($d['id']) && !empty($d['id'])) {
                                                    unset($offresTableau[($d['id'])]['buy']);
                                                }
                                                $req = $bddConnection->prepare('SELECT max_vente FROM cmw_boutique_offres WHERE id = :id');
                                                $req->execute(array('id' => $itemId));
                                                $s = $req->fetch(PDO::FETCH_ASSOC);
                                                if ($offresTableau[$i]['id'] == $d['id']) {
                                                    $keyPanier = array_search($d['id'], $_SESSION['panier']['id']);
                                                    if(isset($keyPanier) && $keyPanier) {
                                                        if ($_SESSION['panier']['quantite'][$keyPanier] >= $s['max_vente']) {
                                                            $offresTableau[$i]['maxbuy'] = 1;
                                                        }
                                                    }
                                                }                                       
                                            }
                                        }

                                        if(isset($_SESSION['Player']['id'])) {
                                            $req = $bddConnection->prepare('SELECT achats FROM cmw_users WHERE id = :id');
                                            $req->execute(array('id' => $_SESSION['Player']['id']));
                                            $e = $req->fetch(PDO::FETCH_ASSOC);
                                            if (isset($e['achats']) && !empty($e['achats'])) {
                                                $arrayAchat = array();
                                                $arrayAchat = (json_decode($e['achats'], true));
                                                foreach($arrayAchat as $achats) {
                                                    $req = $bddConnection->prepare('SELECT id FROM cmw_boutique_offres WHERE evo = :evo');
                                                    $req->execute(array('evo' => $achats['id2']));
                                                    $d = $req->fetch(PDO::FETCH_ASSOC);
                                                    if (isset($d['id']) && !empty($d['id']) && $offresTableau[$i]['id'] == $d['id']) {
                                                        $_SESSION['bddachat'][$i] = 1;
                                                    } else {
                                                        unset($_SESSION['bddachat'][$i]);
                                                    }
                                                    $req = $bddConnection->prepare('SELECT max_vente FROM cmw_boutique_offres WHERE id = :id');
                                                    $req->execute(array('id' => $achats['id2']));
                                                    $s = $req->fetch(PDO::FETCH_ASSOC);
                                                    if($achats['nombre']>=$s['max_vente'] && $s['max_vente'] != -1) {
                                                        if ($offresTableau[$i]['id'] == $achats['id2']) {
                                                            $offresTableau[$i]['maxbuy'] = 1;
                                                        }
                                                    }
                                                }
                                            } else {
                                                unset($_SESSION['bddachat'][$i]);
                                            }
                                        }

                                        if ($offresTableau[$i]['categorie'] == $categories[$j]['id']) : 
                                            $categories[$j]['showNumber'] = ($categories[$j]['showNumber'] == 0) ? 1 : $categories[$j]['showNumber']; ?>
                                            <div class="col-12 card mx-3 col-md-<?php echo ((12/$categories[$j]['showNumber'])-1); ?>">
                                                <div class="card-header">
                                                    <div class="text-center">
                                                    <img class="p-2" alt="Images non trouvé !" src="<?= ($offresTableau[$i]['images']) ?>" style="width: 160px; height: 160px">
                                                </div>
                                                    
                                                    <h3 class="text-center">
                                                    <?= (($offresTableau[$i]['nbre_vente'] == 0) ? '<s>' . $offresTableau[$i]['nom'] . '</s>' : $offresTableau[$i]['nom']); ?></h3>
                                                    <br />
                                                    <small>
                                                        <?php
                                                        if ($offresTableau[$i]['nbre_vente'] == 0) {
                                                            echo 'vide';
                                                        } else {
                                                            echo ($offresTableau[$i]['nbre_vente'] == -1) ? 'Stock Non limité' : 'Stock : ' . $offresTableau[$i]['nbre_vente'];
                                                        }
                                                        ?>
                                                    </small>
                                                </div>
                                                <div class="card-body">
                                                    <?= htmlspecialchars_decode($offresTableau[$i]['description']) ?>
                                                </div>
                                                <div class="card-footer">
                                                    <?php if (Permission::getInstance()->verifPerm('connect')) : ?>
                                                        <?php if (isset($offresTableau[$i]['buy']) && !isset($_SESSION['bddachat'][$i])) { ?>
                                                            <a href="#" class="btn btn-main disabled" disabled>Vous devez d'abord acheter: <?php foreach($offresTableau[$i]['buy'] as $value) { echo $offresByGet[$value]; } ?></a>
                                                        <?php } else if (isset($offresTableau[$i]['maxbuy'])) { ?>
                                                            <a href="#" class="btn btn-main disabled" disabled>Vous avez dépassé le nombre d'achat maximum de cette offre</a>
                                                        <?php } else if ($offresTableau[$i]['nbre_vente'] == 0) { ?>
                                                            <a href="#" class="btn btn-main disabled" disabled>Rupture de stock</a>
                                                        <?php } else { ?>
                                                            <a href="index.php?action=addOffrePanier&offre=<?= $offresTableau[$i]['id'] ?>&quantite=1" class="btn btn-main">
                                                                <i class="fa fa-cart-arrow-down"></i> Ajouter au panier
                                                            </a>
                                                        <?php } ?>
                                                    <?php else : ?>
                                                        <a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-main">
                                                            <span class="fas fa-user"></span> Se connecter
                                                        </a>
                                                    <?php endif; ?>
                                                    <button class="btn btn-main">Prix : <?= ($offresTableau[$i]['prix'] == '0' ? 'gratuit' : $offresTableau[$i]['prix']) ?> <i class='fa-solid fa-coins'></i></button>
                                                </div>
                                                <?php $categories[$j]['offres']++; ?>
                                            </div>

                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    <?php endif; ?>
                                </div>

                                <?php if ($categories[$j]['offres'] == 0) : ?>
                                    <!-- Aucune offre disponible -->
                                    <div class="info-page bg-danger">
                                        <div class="text-center">Aucune offre disponible pour la catégorie : <?= $categories[$j]['titre'] ?> !</div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        <?php endfor; ?>
                    </div>
                <?php else : ?>
                    <!-- Aucune Catégorie disponible -->
                    <div id="categorie-none" class="tab-pane fade in active show">
                        <div class="info-page bg-danger">
                            <div class="text-center">Aucune catégorie disponible !</div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Compte -->
            <div class="col-md-12 col-lg-2 col-sm-12 mb-3">
                <!-- Affichage du compte -->
                <div class="card">
                    <div class="card-header">
                        <h4><?= $_Joueur_['pseudo']; ?> :</h4>
                    </div>
                    <div class="card-body player-shop">
                        <?php if (Permission::getInstance()->verifPerm('connect')) : ?>
                            <!-- Affichage nom, panier, crédits -->
                            <div class="categorie-content" >
                                <a href="../token" class="categorie-link">
                                    <div class="categorie-item">
                                    Crédits :
                                    <div class="text-center">
                                        <?= $_Joueur_['tokens']; ?> <i class='fa-solid fa-coins'></i></i>
                                    </div>
                                </div></a>
                                <div class="categorie-item">
                                    <a href="<?= $_Panier_->compterArticle() > 0 ? '?page=panier' : '#' ?>" class="categorie-link">
                                        Panier :
                                        <div class="text-center">
                                            <?= $_Panier_->compterArticle() . ($_Panier_->compterArticle() > 1 ? ' articles' : ' article') ?>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="player-shop-person h5 mb-2">
                                Bonjour Visiteur,
                            </div>
                            <div class="categorie-content">
                                <div class="categorie-item text-justify">
                                    <small>Connectez-vous pour accéder à la boutique</small>
                                    <div class="categorie-item">
                                        <a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-main"><span class="glyphicon glyphicon-user"></span>Connexion</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            </div>
                    </div>
                </div>
            </div>
</section>