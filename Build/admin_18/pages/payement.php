<?php
unset($affichage);
if(isset($_GET['paypal'])){
    $affichage = "paypal";
}elseif(isset($_GET['dedipass'])){
    $affichage = "dedipass";
}else{
    $affichage = "paysafecard";
}    
?>
<style>
:disabled{
    cursor: not-allowed;
}
</style>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h2 class="h2 gray">
        Réglages des moyens de paiement
	</h2>
</div>
<div class="row">
    <?php if(!Permission::getInstance()->verifPerm('PermsPanel', 'payment', 'actions', 'editPayment') AND !Permission::getInstance()->verifPerm('PermsPanel', 'payment', 'actions', 'editOffrePaypal') AND !Permission::getInstance()->verifPerm('PermsPanel', 'payment', 'actions', 'addOffrePaypal')) { ?>
    <div class="col-md-12 text-center">
        <div class="alert alert-danger">
            <strong>Vous avez aucune permission pour accéder aux réglages des paiements.</strong>
        </div>
    </div>
    <?php } else { ?>
    <div class="col-md-12 text-center">
        <div class="alert alert-success">
            <strong>Les jetons sont la monnaie virtuelle du site. Les joueurs achètent des jetons avec leurs dons, et les utilisent dans la boutique.</strong>
        </div>
    </div>
    <?php }
    if(Permission::getInstance()->verifPerm('PermsPanel', 'payment', 'actions', 'editPayment')){ 
        ?>
    
    <div class="col-md-12 text-center">
        <div class="card  ">
            <div class="card-header ">
                <h3 class="card-title"><?php if($affichage == "paypal"){ echo 'PayPal'; }elseif($affichage == "dedipass"){echo 'Dedipass';}else{echo 'PaySafeCard';}?></h3>
            </div>
        <div class="card-body">
            <form method="POST" action="?&action=editPayement">
                <div class="col-md-12">
                    <div class="row">
                    <?php if($affichage == "paypal"){ ?>
                        <div class="offset-md-4 col-md-4">
                            <label class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="paypal" id="paypallabel" <?php if($lectureP['paypal'] == true) echo 'checked'; ?>/> 
                                <label for="paypallabel" class="custom-control-label">Activé</label>
                            </label>
                        </div>
                    <?php }elseif($affichage == "dedipass"){?>
                        <div class="offset-md-4 col-md-4">
                            <label class="custom-control custom-switch">
                                <input type="checkbox" name="dedipass" id="dedipasslabel" class="custom-control-input" <?php if($lectureP['dedipass'] == true) echo 'checked'; ?>>
                                <label for="dedipasslabel" class="custom-control-label">Activé</label>
                            </label>
                        </div>
                    <?php }else{ ?>
                        <div class="offset-md-4 col-md-4">
                            <label class="custom-control custom-switch">
                                <input type="checkbox" id="paysafecardlabel" class="custom-control-input" name="paysafecard" <?php if($lectureP['paysafecard'] == true) echo 'checked'; ?>>
                                <label for="paysafecardlabel" class="custom-control-label">Activé</label>
                            </label>
                        </div>
                    <?php } ?>
                    <input style="visibility: hidden;display: inline;" type="text" value="<?=$affichage;?>" id="quelretour" />
                    </div>
                    <div style="<?php if($affichage == "dedipass"){ echo 'display: block;';}elseif($affichage == "paypal"){echo'display: none';}else{echo 'display: none;';}?>">
                    <!-- Dedipass -->
                    <div class="alert alert-success">
                        <p class="text-center">
                            Vous avez du mal à crée / configurer la solution de paiement DediPass ? Consultez notre <a href="https://craftmywebsite.fr/forum/index.php?threads/tuto-configurer-le-paiement-par-d%C3%A9dipass.3184/" target="_blank" rel="noopener noreferrer">tutoriel complet</a> !
                        </p>
                    </div>
                        <div class="row">
                            <label class="control-label">Dedipass clé publique</label>
                            <input type="text" name="public_key" class="form-control" value="<?php echo $lectureP['public_key']; ?>" placeholder="Trouvez la sur votre panel Dedipass en suivant le tuto" >
                        </div>
                        <input type="hidden" name="dedipasspage" value="1">
                        <div class="row">
                            <label class="control-label">Dedipass clé privée</label>
                            <input type="text" name="private_key" class="form-control" value="<?php echo $lectureP['private_key']; ?>" placeholder="Trouvez la sur votre panel Dedipass en suivant le tuto" >
                        </div>
                    </div>
                    <div style="<?php if($affichage == "paypal"){ echo 'display: block;';}elseif($affichage == "dedipass"){echo'display: none';}else{echo 'display: none;';}?>">
                     <!-- PayPal  -->
                        <div class="row">
                            <label class="control-label">Email paypal</label>
                            <input type="text" name="paypalEmail" class="form-control" value="<?php echo $lectureP['paypalEmail']; ?>" placeholder="L'email lié à votre compte paypal."/>
                        </div>
                        <input type="hidden" name="paypalpage" value="1">
                    </div>
                    <div style="<?php if($affichage == "paypal"){ echo 'display: none;';}elseif($affichage == "dedipass"){echo'display: none';}else{echo 'display: block;';}?>">
                        <div class="row">
                            <div class="alert alert-danger">
                                <p>Notre système "PaySafeCard" n'est pas affilié à PaySafe / PaySafeCard LTD et repose sur une validation manuelle ! Lorsqu'un joueur achète des jetons via une offre PaySafeCard il faut venir sur cette page afin de récupérer le code du joueur, prélever le montant de l'offre et cliquer sur le bouton de validation afin de livrer les jetons à l'acheteur ! Pour valider des codes paysafecard / vérifier le solde de la carte paysafecard rendez-vous <a href="https://www.paysafecard.com/fr-fr/" target="_blank" rel="noopener noreferrer">sur le site officiel de PaySafe</a> </p>
                                Le saviez-vous: <strong>Vous pouvez payer l'hébergement de votre site web via code PaySafeCard <a href="https://webstrator.fr/" target="_blank" rel="noopener noreferrer">chez notre partenaire Webstrator.fr</a> !</strong>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <input type="submit" class="btn btn-success w-100" value="Valider les changements !" />
            </div>
        </div>
        </form>
    </div>
</div>
    <?php }
    if(Permission::getInstance()->verifPerm('PermsPanel', 'payment', 'actions', 'addOffrePaypal') AND ($affichage == "paypal")) { ?>
    <div class="col-md-6 text-center">
        <div class="card  ">
            <div class="card-header ">
                <h3 class="card-title">Création d'une offre Paypal</h3>
            </div>
            <div class="card-body">
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

                    </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <input type="submit" class="btn btn-success w-100" value="Créer l'offre !" />
                </div>
            </div>
            </form>
        </div>
    </div>
    <?php }
    if(Permission::getInstance()->verifPerm('PermsPanel', 'payment', 'actions', 'editOffrePaypal') AND $affichage == "paypal") { ?>
    <div class="col-md-6 text-center">
        <div class="card  ">
            <div class="card-header ">
                <h3 class="card-title">Mes offres PayPal</h3>
            </div>
        <div class="card-body">
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
                        <li class="nav-item"><a href="#payementPaypal<?php echo $i; ?>" data-toggle="tab" style="color: #000 !important" class="nav-link <?php if($i == 0) echo 'active'; ?>">Offre #<?php echo $i+1; ?></a></li>
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
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="?&action=supprimerPaypalOffre&id=<?php echo $paypalOffres[$i]['id']; ?>" class="btn btn-danger w-100">Supprimer</a>                                        
                                            </div>
                                            <div class="col-md-6">
                                                <input type="submit" class="btn btn-success w-100" value="Modifier Les changements !"/>
                                            </div>
                                        </div>
                                    </div>
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
    if(Permission::getInstance()->verifPerm('PermsPanel', 'payment', 'actions', 'editOffrePaysafeCard') AND $affichage != "paypal" AND $affichage != "dedipass") { ?>
    <div class="col-md-12 text-center">
        <div class="card  ">
            <div class="card-header ">
                <h3 class="card-title">Mes offres PaySafeCard</h3>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <?php for($i = 0; $i < count($paysafecard) ; $i++)   { ?>
                        <li class="nav-item"><a href="#payementPaysafecard<?php echo $i; ?>" class="nav-link <?php if($i == 0) echo 'active'; ?>"  style="color: #000 !important;" data-toggle="tab">Offre #<?php echo $i+1; ?></a></li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content">
                        <?php for($i = 0; $i < count($paysafecard) ; $i++)   { ?>
                        <div class="tab-pane well <?php if($i == 0) echo 'active'; ?>" id="payementPaysafecard<?php echo $i; ?>">
                            <form method="POST" action="?&action=modifierOffrePaysafecard&id=<?php echo $paysafecard[$i]['id']; ?>">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="active<?=$i;?>" name="statut"
                                            <?php if($paysafecard[$i]['statut'] == true) echo 'checked'; ?>>
                                            <label class="custom-control-label" for="active<?=$i;?>"> Activé l'offre #<?=$i+1;?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="control-label">Message de l'offre</label>
                                        <textarea name="description" class="form-control" rows="1"><?php echo htmlspecialchars($paysafecard[$i]['description']); ?></textarea>
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
                                    <div class="offset-md-4 col-md-4">
                                        <input type="submit" class="btn btn-success align-center w-75" value="Modifier Les changements !"/>
                                    </div>
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
    if(Permission::getInstance()->verifPerm('PermsPanel', 'payment', 'actions', 'verifPaysafecard') && !empty($tabPaysafe) AND $affichage != "paypal" AND $affichage != "dedipass") { ?>
    <div class="col-md-12 text-center">
        <div class="card  ">
            <div class="card-header ">
                <h3 class="card-title">Liste des achats PaySafeCard</h3>
            </div>
            <div class="card-body">
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
<br/>
