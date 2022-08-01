<section id="Token">
    <div class="container-fluid col-md-9 col-lg-9 col-sm-10">

        <div class="row">
            <!-- Présentation -->
            <div class="d-flex col-12 info-page">
                <i class="fas fa-info-circle notification-icon"></i>
                <div class="info-content">
                    Transformez votre argent en crédit afin d'effectuer vos achats tranquillement !
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-3 col-sm-12 mb-3">
                <!-- Moyens de Paiement -->
                <div class="card">
                    <div class="card-header">
                        <h4>Moyens de paiement :</h4>
                    </div>
                    <div class="card-body categories">
                        <ul class="categorie-content nav nav-tabs">
                            <!-- Affichage des moyens de paiement -->
                            <?php if ($_Serveur_['Payement']['paypal']) : ?>
                                <!-- Paypal -->
                                <li class="categorie-item nav-item">
                                    <a href="#buy-paypal" class="nav-link categorie-link active" data-toggle="tab">
                                        Payer avec Paypal
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if ($_Serveur_['Payement']['dedipass']) : ?>
                                <!-- Dedipass -->
                                <li class="categorie-item nav-item">
                                    <a href="#buy-dedipass" class="nav-link categorie-link" data-toggle="tab">
                                        Payer avec Dedipass
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if ($_Serveur_['Payement']['paysafecard']) : ?>
                                <!-- PaySafeCard -->
                                <li class="categorie-item nav-item">
                                    <a href="#buy-paysafecard" class="nav-link categorie-link" data-toggle="tab">
                                        Payer avec PaySafeCard
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (!$_Serveur_['Payement']['paypal'] && !$_Serveur_['Payement']['dedipass'] && !$_Serveur_['Payement']['paysafecard']) : ?>
                                <!-- Aucun moyen de paiement disponible -->
                                <li class="no-hover bg-danger categorie-item nav-item active">
                                    <div href="#buy-none" class="text-center nav-link categorie-link disabled"
                                         data-toggle="tab">
                                        <i class="fas fa-exclamation-triangle"></i> <br> Aucun Moyen de Paiement
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-9 col-sm-12 mb-3">
                <!-- Affichage des offres de paiement -->

                <div class="tab-content" id="nav-tabContent">
                    <?php if ($_Serveur_['Payement']['paypal']) : ?>
                        <div class="tab-pane fade show active" id="buy-paypal">
                            <div class="info-page">
                                <div class="text-center">
                                    <h5>Payer par Paypal :</h5>
                                    <h6>Payer par paypal avec votre solde ou par carte bancaire tout en étant en pleine
                                        sécurité !</h6>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Affichage des offres Paypal -->
                                <?php if (isset($tableauOffres)) : ?>
                                    <?php foreach ($tableauOffres as $tab) : ?>
                                        <div class="col-md-12 col-lg-4 col-sm-12 my-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="titre-offre">
                                                        <?= $tab['nom']; ?> <span
                                                                class="float-right badge badge-main"><?= $tab['prix']; ?>€</span>
                                                    </h5>
                                                </div>
                                                <div class="card-body">
                                                    <?= $tab['description']; ?>
                                                </div>
                                                <div class="card-footer">
                                                    <form action="<?= $lien; ?>" method="post">
                                                        <?php foreach ($tab['paramPaypal'] as $cle => $valeur) : ?>
                                                            <input type="hidden" name="<?= $cle ?>"
                                                                   value="<?= $valeur ?>"/>
                                                        <?php endforeach; ?>
                                                        <input type="submit" class="btn btn-main w-100"
                                                               value="Acheter !"/>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <div class="info-page bg-danger">
                                        <div class="text-center">Aucune offre de payement par paypal nest disponible
                                            pour le moment...
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($_Serveur_['Payement']['dedipass']) : ?>
                        <!-- Affichage de la page dedipass -->
                        <div class="tab-pane fade" id="buy-dedipass">
                            <div class="info-page">
                                <div class="text-center">
                                    <h5>Payer par Dedipass :</h5>
                                    <h6>Payer par Dedipass avec votre forfait téléphonique tout en simplicité !</h6>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3>Page de paiement Dedipass</h3>
                                </div>
                                <div class="card-body">
                                    <div data-dedipass="<?= $_Serveur_['Payement']['public_key']; ?>"
                                         data-dedipass-custom=""></div>
                                </div>
                                <div class="card-footer">
                                    <small>Support Dedipass en cas de code incorrect : <a
                                                href="https://dedipass.com/en/contact/"> SUPPORT DEDIPASS</a></small>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($_Serveur_['Payement']['paysafecard']) : ?>
                        <!-- Affichage des offres PSC -->
                        <div class="tab-pane fade" id="buy-paysafecard">
                            <div class="info-page">
                                <div class="text-center">
                                    <h5>Payer par PaySafeCard :</h5>
                                    <h6>Payer avec PaySafeCard en toute simplicité</h6>
                                </div>
                            </div>

                            <div class="row">
                                <?php foreach ($paysafecardTab as $key => $value) : ?>
                                    <div class="col">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="titre-offre">
                                                    Carte <?= $value['montant']; ?>€
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <?= $value['description']; ?>
                                            </div>
                                            <div class="card-footer">
                                                <a class="btn btn-main w-100" data-toggle="collapse"
                                                   href="#paysafecard<?= $value['id']; ?>" role="button"
                                                   aria-expanded="false"
                                                   aria-controls="paysafecard<?= $value['id']; ?>">Acheter !</a>
                                            </div>
                                        </div>
                                        <div class="container mt-4">
                                            <div class="collapse" id="paysafecard<?= $value['id']; ?>">
                                                <div class="card">
                                                    <form action="?action=buyPaysafecard" method="POST">
                                                        <input type="hidden" name="offre" value="<?= $value['id']; ?>">
                                                        <div class="card-header">
                                                            <h5 class="control-label">Entrez votre code</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <input type="number" name="code" class="form-control"
                                                                   required size="16"/>
                                                        </div>
                                                        <div class="card-footer">
                                                            <button type="submit" class="btn btn-reverse w-100">Envoyer
                                                                !
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>


            </div>
        </div>
    </div>
</section>