<?php

if (Permission::getInstance()->verifPerm("connect")) :

    //Création du Panier : 
    $nbArticles = $_Panier_->compterOffre();
    $precedent = 0;
?>
    <section id="Panier">
        <div class="container-fluid col-md-9 col-lg-9 col-sm-10 mt-lg-5 mb-lg-5">

            <div class="row">

                <!-- Affichage du panier -->
                <table class="table table-dark border  rounded-1 table-hover">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Nom</th>
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
                                $_Panier_->infosArticle(htmlspecialchars($_SESSION['panier']['id'][$i]), $nom, $infos, $images);
                                $precedent += htmlspecialchars($_SESSION['panier']['prix'][$i]) * htmlspecialchars($_SESSION['panier']['quantite'][$i]); ?>
                                <tr>
                                    <td class="text-center" scope="row">
                                        <img class="mr-2" alt="Images non trouvé !" src="<?= $images; ?>" style="width: 32px; height: 32px"><?= $nom; ?>
                                    </td>
                                    <td class="text-center">
                                        <?= htmlspecialchars_decode($infos); ?>
                                    </td>
                                    <td class="text-center">
                                        <?= htmlspecialchars($_SESSION['panier']['quantite'][$i]); ?>
                                    </td>
                                    <td class="text-center">
                                        <?= htmlspecialchars($_SESSION['panier']['prix'][$i]); ?> <i class="fa-solid fa-coins"></i>
                                    </td>
                                    <td class="text-center">
                                        <?= $precedent; ?> <i class="fa-solid fa-coins"></i>
                                    </td>
                                    <td class="text-center">
                                        <a href="index.php?action=supprItemPanier&id=<?= htmlspecialchars($_SESSION['panier']['id'][$i]); ?>" class=""><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </tbody>
                </table>


                <?php if ($nbArticles != 0) : ?>

                    <!-- Affichage du formulaire des codes de promotion -->
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                Code de Promotion
                            </div>
                            <div class="card-body">
                                <form action="?action=ajouterCode" method="POST">
                                    
                                        <label for="codepromo"> Entrez votre code de promotion</label>
                                        <div class="input-group">
                                        <input type="text" aria-describedby="btnGroupAddon2" class="form-control" id="codepromo" name="codepromo" placeholder="Code promo">


                                    <button id="btnGroupAddon2" type="submit" class="input-group-text btn btn-primary">Valider le code</button>
                                </div>
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
                                <h6>Solde après achat : 
                                    <?php
                                        if($_Joueur_['tokens'] >= $_Panier_->montantGlobal())
                                        {
                                    echo $_Joueur_['tokens'] - $_Panier_->montantGlobal(), " <i class='fa-solid fa-coins'></i>";
                                    } else {
                                        echo "<span class='bg-warning px-2'>Vous n'avez pas assez de token !</span>";
                                    }

                                    ?>
                                </h6>
                            <h4 class="">
                                    Total :
                                    <?= number_format($_Panier_->montantGlobal(), 0, ',', ' '); ?> <i class="fa-solid fa-coins"></i>
                                </h4>
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

            </div>

        </div>
    </section>
<?php endif; ?>