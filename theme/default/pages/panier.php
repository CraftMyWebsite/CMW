<?php

if (Permission::getInstance()->verifPerm("connect")) :

    //Création du Panier : 
    $nbArticles = $_Panier_->compterOffre();
    $precedent = 0;
?>
    <section id="Panier">
        <div class="container-fluid col-md-9 col-lg-9 col-sm-10">
            <div class="row">
                <!-- Présentation -->
                <div class="d-flex col-12 info-page">
                    <i class="fas fa-info-circle notification-icon"></i>
                    <div class="info-content">
                        Achetez plusieurs items en déboursant une seule fois.
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Affichage du panier -->
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Item/Grade</th>
                            <th scope="col">Description</th>
                            <th scope="col">Quantite</th>
                            <th scope="col">Prix Unitaire</th>
                            <th scope="col">Sous-Total</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($nbArticles == 0) : ?>
                            <tr class="p-0 no-hover">
                                <td colspan="6" class="p-0 no-hover">
                                    <div class="m-0 info-page bg-danger">
                                        <div class="text-center">Votre panier est vide.</div>
                                    </div>
                                </td>
                            </tr>
                            <?php else :
                            //Affichage de l'offre

                            for ($i = 0; $i < $nbArticles; $i++) :
                                $_Panier_->infosArticle(htmlspecialchars($_SESSION['panier']['id'][$i]), $nom, $infos);
                                $precedent += htmlspecialchars($_SESSION['panier']['prix'][$i]) * htmlspecialchars($_SESSION['panier']['quantite'][$i]); ?>
                                <tr>
                                    <td scope="row">
                                        <?= $nom; ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars_decode($infos); ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($_SESSION['panier']['quantite'][$i]); ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($_SESSION['panier']['prix'][$i]); ?> <i class="fa fa-diamond"></i>
                                    </td>
                                    <td>
                                        <?= $precedent; ?> <i class="fas fa-gem"></i>
                                    </td>
                                    <td>
                                        <a href="index.php?action=supprItemPanier&id=<?= htmlspecialchars($_SESSION['panier']['id'][$i]); ?>" class="btn btn-danger link no-hover"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </tbody>
                </table>


                <?php if ($nbArticles != 0) : ?>

                    <!-- Affichage du formulaire des codes de promotion -->
                    <div class="col-lg-6 col-md-12 col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-header">
                                Code de Promotion
                            </div>
                            <div class="card-body">
                                <form action="?action=ajouterCode" method="POST">
                                    <div class="form-group">
                                        <label for="codepromo"> Entrez votre code de promotion</label>
                                        <input type="text" class="form-control" id="codepromo" name="codepromo" placeholder="Code promo">
                                    </div>
                                    <button type="submit" class="btn btn-reverse w-100">Envoyer</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Affichage du récapitulatif -->
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                Récapitulatif
                            </div>
 
                        <div class="card-body">
 
                        <div class="text-center">
                            <?php if (!empty($_SESSION['panier']['reduction'])) : ?>
                                <div class="remises">
                                    <div class="title-vote-listing">
                                        <h6 class="text-muted">
                                            Code promotionnel "<?= htmlspecialchars($_SESSION['panier']['code']) ?>"
 
                                        de <?= $_SESSION['panier']['reduction'] * 100 ?> % appliqué !
                                    </h6>
                                    </div>
                                </div>
                            <?php endif; ?>
 
                                <h6 class="mt-4">Votre solde : <b><?= number_format($_Joueur_['tokens'], 0, ',', ' '); ?></b> <i class="fa-solid fa-coins"></i><h6>
                                <h5 class="title-vote-listing">
                                    Total :
                                    <?= number_format($_Panier_->montantGlobal(), 0, ',', ' '); ?> <i class="fa-solid fa-coins"></i>
                                </h5>
                                <h6>Solde après achat : 
                                    <?php
                                        if($_Joueur_['tokens'] >= $_Panier_->montantGlobal())
                                        {
                                    echo $_Joueur_['tokens'] - $_Panier_->montantGlobal();
                                    } else {
                                        echo "<span class='bg-warning px-2'>Vous n'avez pas assez de token !</span>";
                                    }
 
                                    ?>
                                </h6>
 
                            </div>
                        </div>
 
                            <table class="text-center">
                                <?php
                                    if($_Joueur_['tokens'] >= $_Panier_->montantGlobal())
                                { ?>
                                <tr>
                                    <td><a href="index.php?action=achat" class="btn btn-primary mb-2 no-hover">
                                    Passer à l'achat 
                                </a></td>
                                <?php } else { ?>
                                <td><a href="/token" class="btn btn-warning mb-2">
                                            <i class="fa-solid fa-coins"></i>
                                            Acheter des coins
                                    </a>   
                                </td>
                                <?php }
                                ?>
                                    <td><a href="index.php?action=viderPanier" class="btn btn-danger mb-2 no-hover">
                                    Vider le panier
                                </a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                            <?php endif; ?>

                            <div class="total-panier">
                                <h5 class="title-vote-listing">
                                    Total

                                    <div class="vote-line mt-2"></div>

                                    <?= number_format($_Panier_->montantGlobal(), 0, ',', ' '); ?> <i class="fas fa-gem ml-2"></i>
                                </h5>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="index.php?action=viderPanier" class="btn btn-danger w-100 mb-2 no-hover">
                                    Vider le panier
                                </a>
                                <a href="index.php?action=achat" class="btn btn-reverse w-100 mb-2 no-hover">
                                    Passer à l'achat 
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>

        </div>
    </section>
<?php endif; ?>