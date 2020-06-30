<div class="cmw-page-content-header"><strong>Réglages Paiement</strong> - Paramétrez les modes de paiement</div>

<div class="row">
    <?php if(!Permission::getInstance()->verifPerm('PermsPanel', 'payment', 'actions', 'editPayment') AND !Permission::getInstance()->verifPerm('PermsPanel', 'payment', 'actions', 'editOffrePaypal') AND !Permission::getInstance()->verifPerm('PermsPanel', 'payment', 'actions', 'addOffrePaypal')) { ?>
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
    if(Permission::getInstance()->verifPerm('PermsPanel', 'payment', 'actions', 'editPayment')) { ?>

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
                        <label class="checkbox-inline">
                            <input type="checkbox" name="paysafecard" <?php if($lectureP['paysafecard'] == true) echo 'checked'; ?>> Paysafecard
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
                        <label class="control-label">Email paypal</label>
                        <input type="text" name="paypalEmail" class="form-control" value="<?php echo $lectureP['paypalEmail']; ?>" placeholder="L'email lié à votre compte paypal."/>
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
    if(Permission::getInstance()->verifPerm('PermsPanel', 'payment', 'actions', 'addOffrePaypal')) { ?>
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
    if(Permission::getInstance()->verifPerm('PermsPanel', 'payment', 'actions', 'editOffrePaypal')) { ?>
    <div class="col-xs-12 text-center">
        <div class="panel panel-default cmw-panel">
            <div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Mes offres PayPal</strong></h3>
            </div>
        <div class="panel-body">
        <?php if(!isset($paypalOffres) OR empty($paypalOffres)) { ?>
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
            <?php } ?>
            </div>
        </div>
    </div>
    <?php } 
    if(Permission::getInstance()->verifPerm('PermsPanel', 'payment', 'actions', 'editOffrePaysafeCard')) { ?>
    <div class="col-xs-12 text-center">
        <div class="panel panel-default cmw-panel">
            <div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Mes offres PaysafeCard</strong></h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <?php for($i = 0; $i < count($paysafecard) ; $i++)   { ?>
                        <li <?php if($i == 0) echo 'class="active"'; ?>><a href="#payementPaysafecard<?php echo $i; ?>" data-toggle="tab">Offre #<?php echo $i; ?></a></li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content">
                        <?php for($i = 0; $i < count($paysafecard) ; $i++)   { ?>
                        <div class="tab-pane well <?php if($i == 0) echo 'active'; ?>" id="payementPaysafecard<?php echo $i; ?>">
                            <form method="POST" action="?&action=modifierOffrePaysafecard&id=<?php echo $paysafecard[$i]['id']; ?>">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="statut" <?php if($paysafecard[$i]['statut'] == true) echo 'checked'; ?>> Activer l'offre
                                        </label>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="control-label">Message de l'offre</label>
                                        <textarea name="description" class="form-control" ><?php echo htmlspecialchars($paysafecard[$i]['description']); ?></textarea>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Prix de l'offre</label>
                                        <input type="number" step="0.01" value="<?php echo $paysafecard[$i]['montant']; ?>" class="form-control" disabled />
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Jetons donnés</label>
                                        <input type="number" name="jetons" value="<?php echo $paysafecard[$i]['jetons']; ?>" class="form-control" placeholder="ex: 1500"/>
                                    </div>
                                </div><hr>
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
    <?php } 
    if(Permission::getInstance()->verifPerm('PermsPanel', 'payment', 'actions', 'verifPaysafecard') && !empty($tabPaysafe)) { ?>
    <div class="col-xs-12 text-center">
        <div class="panel panel-default cmw-panel">
            <div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Liste des achats Paysafecard</strong></h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Pseudo</th>
                        <th>Code</th>
                        <th>Montant</th>
                        <th>Jetons</th>
                        <th>Traité ?</th>
                        <th>Actions</th>
                    </tr>
                <?php
                    foreach($tabPaysafe as $value)
                    {
                        ?><tr>
                            <td><?=$value['pseudo'];?></td>
                            <td><?=$value['code'];?></td>
                            <td><?=$value['montant'];?></td>
                            <td><?=$value['jetons'];?></td>
                            <td><?=($value['statut']) ? '<span class="badge badge-success">Traité !</span>' : 'En attente';?></td>
                            <td>
                            <?php if(!$value['statut'])
                                echo '<a href="?action=validerPaysafecard&offre='.$value['id'].'" class="btn btn-success">Valider l\'achat</a>';
                            ?>
                            <a href="?action=supprHistoPaysafecard&offre=<?=$value['id'];?>" class="btn btn-danger">Supprimer de l'historique</a>
                            </td>
                        </tr><?php
                    }
                ?>
                </table>
            </div>
        </div>
    </div>
    <?php } ?> 
</div>
