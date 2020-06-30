<div class="cmw-page-content-header"><strong>Réglages Paiement</strong> - Paramétrez les modes de paiement</div>

<div class="row">
    <?php if($_Joueur_['rang'] != 1 AND ($_PGrades_['PermsPanel']['payment']['actions']['editPayment'] == false AND $_PGrades_['PermsPanel']['payment']['actions']['editOffrePaypal'] == false AND $_PGrades_['PermsPanel']['payment']['actions']['addOffrePaypal'] == false)) { ?>
    <div class="col-xs-12 text-center">
        <div class="alert alert-danger">
            <strong>Vous avez aucune permission pour accéder aux réglages des paiements.</strong>
        </div>
    </div>
    <?php } else { ?>
    <div class="col-xs-12 text-center">
        <div class="alert alert-success">
            <strong>Les jetons sont la monnaie virtuelle du site. Les joueurs achètent des jetons avec leurs dons, et les utilisent dans la boutique.</strong>
        </div>
    </div>
    <?php }
    if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['payment']['actions']['editPayment'] == true) { ?>

    <div class="col-xs-12 col-md-6 text-center">
        <div class="panel panel-default cmw-panel">
            <div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Dedipass/Paypal ID</strong></h3>
            </div>
        <div class="panel-body">
            <div class="alert alert-success">
                <strong>Vous trouverez ces informations sur le site officiel de votre méthode de paiement ! <br/>
                    Si les inscriptions ne sont pas ouvertes, vous pouvez prendre <a href="https://dedipass.com" title="Dedipass">Dedipass</a> en attendant :) : <a href="https://craftmywebsite.fr/forum/index.php?threads/1-5-0-tuto-configurer-le-paiement-par-d%C3%A9dipass.3184/" title="Tuto Dedipass">Tuto Dedipass</a></strong>
            </div>
            <form method="POST" action="?&action=editPayement">
                <div class="col-md-12">
                    <h3>Statut des paiements</h3>
                    <div class="row">
                        <label class="checkbox-inline">
                            <input type="checkbox" name="paypal" <?php if($lectureP['paypal'] == true) echo 'checked'; ?>/> Paypal
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="dedipass" <?php if($lectureP['dedipass'] == true) echo 'checked'; ?>> Dedipass
                        </label>
                    </div>
                    <h3>Dedipass</h3>
                    <div class="row">
                        <label class="control-label">Dedipass clé publique</label>
                         <input type="text" name="public_key" class="form-control" value="<?php echo $lectureP['public_key']; ?>" placeholder="Trouvez la sur votre panel Dedipass en suivant le tuto" >
                    </div>
                    <div class="row">
                        <label class="control-label">Dedipass clé privée</label>
                         <input type="text" name="private_key" class="form-control" value="<?php echo $lectureP['private_key']; ?>" placeholder="Trouvez la sur votre panel Dedipass en suivant le tuto" >
                    </div>
                    <h3>PayPal</h3>
                    <div class="row">
                        <label class="control-label">
                            <input type="radio" name="paypalMethodeAPI" value="1"<?php if($lectureP['paypalMethodeAPI'] == 1) echo ' checked'; ?>/>Utiliser mon email pour être payé par paypal.
                        </label>
                    </div>
                    <div class="row">
                        <label class="control-label">Email paypal</label>
                        <input type="text" name="paypalEmail" class="form-control" value="<?php echo $lectureP['paypalEmail']; ?>" placeholder="L'email lié à votre compte paypal."/>
                    </div>
                    <div class="row">
                        <label>
                            <input type="radio" name="paypalMethodeAPI" value="2"<?php if($lectureP['paypalMethodeAPI'] == 2) echo ' checked'; ?>/>Utiliser mon compte buisness paypal pour être payé.
                        </label>
                    </div>
                    <div class="row">
                        <label class="control-label">User Paypal</label>
                        <input type="text" name="paypalUser" class="form-control" value="<?php echo $lectureP['paypalUser']; ?>" placeholder="Demander une signature API pour connaitre cette donnée"/>
                    </div>
                    <div class="row">
                        <label class="control-label">Mot de passe Paypal</label>
                        <input type="text" name="paypalPass" class="form-control" value="<?php echo $lectureP['paypalPass']; ?>"/>
                    </div>
                    <div class="row">
                        <label class="control-label">Signature API Paypal</label>
                        <input type="text" name="paypalSignature" class="form-control" value="<?php echo $lectureP['paypalSignature']; ?>"/>
                    </div>
                    <hr>
                    <div class="row">
                        <input type="submit" class="btn btn-success" value="Valider les changements !"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
    <?php }
    if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['payment']['actions']['addOffrePaypal'] == true) { ?>
    <div class="col-xs-12 col-md-6 text-center">
        <div class="panel panel-default cmw-panel">
            <div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Création d'une offre Paypal</strong></h3>
            </div>
            <div class="panel-body">
                <div class="alert alert-success">
                    <strong>Une fois votre compte paypal configuré, vous allez devoir créer une offre paypal pour que les joueurs puissent l'acheter !</strong>
                </div>
                <form method="POST" action="?&action=creerOffrePaypal">
                    <div class="col-md-12">
                        <h3>Créer une offre</h3>
                        <div class="row">
                            <label class="control-label">Titre de l'offre</label>
                            <input type="text" name="nom" class="form-control" placeholder="ex: 5€ - 1500Jetons"/>
                        </div>
                        <div class="row">
                            <label class="control-label">Message de l'offre</label>
                            <input type="text" name="description" class="form-control" placeholder="ex: < img src=... / >"/>
                        </div>
                        <div class="row">
                            <label class="control-label">Prix de l'offre</label>
                            <input type="number" step="0.01" name="prix" class="form-control" placeholder="ex: 5" >
                        </div>
                        <div class="row">
                            <label class="control-label">Jetons donnés</label>
                            <input type="number" name="jetons_donnes" class="form-control" placeholder="ex: 1500" >
                        </div>
                        <hr>
                        <div class="row">
                            <input type="submit" class="btn btn-success" value="Créer l'offre !" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php }
    if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['payment']['actions']['editOffrePaypal'] == true) { ?>
    <div class="col-xs-12 text-center">
        <div class="panel panel-default cmw-panel">
            <div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Mes offres PayPal</strong></h3>
            </div>
        <div class="panel-body">
        <?php if(!isset($paypalOffres) AND empty($paypalOffres)) { ?>
            <div class="alert alert-warning">
                <strong>Vous devez créer une offre paypal !</strong>
            </div>
        <?php } else { ?>
            <div class="alert alert-success">
                <strong>Vous pouvez avoir une multitude d'offres PayPal, vous pourrez gérer ces offres en les modifiant ou les supprimant !</strong>
            </div>
        <?php } ?>
    <?php if(isset($paypalOffres) AND !empty($paypalOffres)) { ?>
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <?php for($i = 0; $i < count($paypalOffres) ; $i++)   { ?>
                        <li <?php if($i == 0) echo 'class="active"'; ?>><a href="#payementPaypal<?php echo $i; ?>" data-toggle="tab">Offre #<?php echo $i; ?></a></li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content">
                        <?php for($i = 0; $i < count($paypalOffres) ; $i++)   { ?>
                        <div class="tab-pane well <?php if($i == 0) echo 'active'; ?>" id="payementPaypal<?php echo $i; ?>">
                            <form method="POST" action="?&action=modifierOffrePaypal&id=<?php echo $paypalOffres[$i]['id']; ?>">
                                <div class="row">
                                    <label class="control-label">Titre de l'offre</label>
                                    <input type="text" name="nom" value="<?php echo $paypalOffres[$i]['nom']; ?>" class="form-control" placeholder="ex: 5€ - 1500Jetons"/>
                                </div>
                                <div class="row">
                                    <label class="control-label">Message de l'offre</label>
                                    <input type="text" name="description" value="<?php echo htmlspecialchars($paypalOffres[$i]['description']); ?>" class="form-control" placeholder="ex: < img src=... / >"/>
                                </div>
                                <div class="row">
                                    <label class="control-label">Prix de l'offre</label>
                                    <input type="number" step="0.01" name="prix" value="<?php echo $paypalOffres[$i]['prix']; ?>" class="form-control" placeholder="ex: 5"/>
                                </div>
                                <div class="row">
                                    <label class="control-label">Jetons donnés</label>
                                    <input type="number" name="jetons_donnes" value="<?php echo $paypalOffres[$i]['jetons_donnes']; ?>" class="form-control" placeholder="ex: 1500"/>
                                </div>
                                <hr>
                                <div class="row">
                                    <a href="?&action=supprimerPaypalOffre&id=<?php echo $paypalOffres[$i]['id']; ?>" class="btn btn-danger">Supprimer</a>
                                </div>
                                <div class="row">
                                    <input type="submit" class="btn btn-success" value="Modifier Les changements !"/>
                                </div>
                            </form>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php } ?>
</div>
