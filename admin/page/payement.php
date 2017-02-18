<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"> Paiement
            <small>Gestionnaire des Paiements</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a data-toggle="collapse" data-parent="#adminPanel" href="#informations">Informations</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Paiement
            </li>
        </ol>
        <hr>
        <?php if($_Joueur_['rang'] != 1 AND ($_PGrades_['PermsPanel']['payment']['actions']['editPayment'] == false AND $_PGrades_['PermsPanel']['payment']['actions']['editOffrePaypal'] == false AND $_PGrades_['PermsPanel']['payment']['actions']['addOffrePaypal'] == false)) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="alert alert-danger">
                    <strong>Vous avez aucune permission pour accéder aux réglages des paiements.</strong>
                </div>
            </div>
        <?php } else { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="alert alert-success">
                    <strong>Les jetons sont la monnaie virtuelle du site. Les joueurs achètent des jetons avec leurs dons, et les utilisent dans la boutique.</strong>
                </div>
            </div>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['payment']['actions']['editPayment'] == true) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="row">
                    <h3>AlloConv/Paypal ID</h3>
                </div>
                <div class="row">
                    <div class="alert alert-success">
                        <strong>Vous trouverez ces informations sur le site officiel de votre méthode de paiement !</strong>
                    </div>
                </div>
            </div>
            <form method="POST" action="?&action=editPayement">
                <div class="col-lg-6 col-lg-offset-3 text-center">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="col-lg-6 col-lg-offset-3">
                                <h3>Status des paiements</h3>
                                <div class="row">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="paypal" <?php if($lectureP['paypal'] == true) echo 'checked'; ?>/> Paypal
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="alloconv" <?php if($microTokens['enabled'] == true) echo 'checked'; ?>/> Alloconv
                                    </label>
                                </div>
                                <h3>AlloConv</h3>
                                <div class="row">
                                    <label class="control-label">Jetons</label>
                                    <input type="number" name="alloconv_tokens" class="form-control text-center" value="<?php echo $microTokens['tokens']; ?>" placeholder="Nombre de Jetons"/>
                                </div>
                                <div class="row">
                                    <label class="control-label">Palier</label>
                                    <input type="text" name="alloconv_palier" class="form-control text-center" value="<?php echo $microTokens['palier']; ?>" placeholder="Voir palier disponible sur alloconv"/>
                                </div>
                                <div class="row">
                                    <label class="control-label">ID Client</label>
                                    <input type="text" name="alloconv_idClient" class="form-control text-center" value="<?php echo $microTokens['Infos']['idClient']; ?>" placeholder="ID de votre compte sur alloconv"/>
                                </div>
                                <div class="row">
                                    <label class="control-label">ID Site</label>
                                    <input type="number" name="alloconv_idSite" class="form-control text-center" value="<?php echo $microTokens['Infos']['idSite']; ?>" placeholder="ID de votre site confirmé par alloconv"/>
                                </div>
                                <div class="row">
                                    <label class="control-label">Cle API</label>
                                    <input type="text" name="alloconv_cle" class="form-control text-center" value="<?php echo $microTokens['Infos']['cle']; ?>" placeholder="Cle API de votre compte sur alloconv"/>
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
                                    <input type="text" name="paypalUser" class="form-control" value="<?php echo $lectureP['paypalUser']; ?>" placeholder="Demmandez une signature API pour connaitre cette donnée"/>
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
                        </div>
                    </div>
                </div>
            </form>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['payment']['actions']['addOffrePaypal'] == true) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="row">
                    <h3>Création d'une offre PayPal</h3>
                </div>
                <div class="row">
                    <div class="alert alert-success">
                        <strong>Une fois votre compte paypal configuré, vous allez devoir créer une offre paypal pour que les joueurs puissent l'acheter !</strong>
                    </div>
                </div>
            </div>
            <form method="POST" action="?&action=creerOffrePaypal">
                <div class="col-lg-6 col-lg-offset-3 text-center">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="col-lg-6 col-lg-offset-3">
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
                                    <input type="number" name="prix" class="form-control" placeholder="ex: 5" >
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
                        </div>
                    </div>
                </div>
            </form>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['payment']['actions']['editOffrePaypal'] == true) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="row">
                    <h3>Mes offres PayPal</h3>
                </div>
                <?php if(!isset($paypalOffres) AND empty($paypalOffres)) { ?>
                    <div class="row">
                        <div class="alert alert-warning">
                            <strong>Vous devez créer une offre paypal !</strong>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="row">
                        <div class="alert alert-success">
                            <strong>Vous pouvez avoir une multitude d'offres paypal, vous pourrez gérer ces offres en les modifiants ou les supprimant !</strong>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php if(isset($paypalOffres) AND !empty($paypalOffres)) { ?>
                <div class="col-lg-6 col-lg-offset-3 text-center">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="col-lg-6 col-lg-offset-3">
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
                                                    <input type="text" name="description" value="<?php echo $paypalOffres[$i]['description']; ?>" class="form-control" placeholder="ex: < img src=... / >"/>
                                                </div>
                                                <div class="row">
                                                    <label class="control-label">Prix de l'offre</label>
                                                    <input type="number" name="prix" value="<?php echo $paypalOffres[$i]['prix']; ?>" class="form-control" placeholder="ex: 5"/>
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
</div>
<!-- /.row -->