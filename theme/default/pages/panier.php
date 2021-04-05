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
                                        <?= $infos; ?>
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
                    <div class="col-lg-4 col-md-12 col-sm-12 align-self-center mb-2 ml-auto">
                        <div class="card">
                            <div class="card-header">
                                <h4>Récapitulatif</h4>
                            </div>
                        </div>
                        <div class="card-body">

                            <?php if (!empty($_SESSION['panier']['reduction'])) : ?>
                                <div class="remises">
                                    <div class="title-vote-listing">
                                        <?= htmlspecialchars($_SESSION['panier']['reduction_titre']) ?>

                                        <div class="vote-line mt-2"></div>

                                        <small class="text-muted mr-2">
                                            (<?= htmlspecialchars($_SESSION['panier']['code']) ?>)
                                        </small>
                                        - <?= $_SESSION['panier']['reduction'] * 100 ?> %
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