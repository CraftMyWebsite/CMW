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
    <?php if(!$_Permission_->verifPerm('PermsPanel', 'payment', 'actions', 'editPayment') AND !$_Permission_->verifPerm('PermsPanel', 'payment', 'actions', 'editOffrePaypal') AND !$_Permission_->verifPerm('PermsPanel', 'payment', 'actions', 'addOffrePaypal')) { ?>
    <div class="col-md-12 text-center">
        <div class="alert alert-danger">
            <strong>Vous avez aucune permission pour accéder aux réglages des paiements.</strong>
        </div>
    </div>
    <?php } else { ?>
    <div class="col-md-12 text-center">
        <div class="alert alert-success">
            <strong>Les <?=$_Serveur['General']['moneyName'];?> sont la monnaie virtuelle du site. Les joueurs achètent des <?=$_Serveur['General']['moneyName'];?> avec leurs dons, et les utilisent dans la boutique.</strong>
        </div>
    </div>
    <?php }
    if($_Permission_->verifPerm('PermsPanel', 'payment', 'actions', 'editPayment')){ 
        ?>
    
    <div class="col-md-12 col-xl-12 col-12 text-center">
        <div class="card  ">
            <div class="card-header ">
                <h3 class="card-title"><?php if($affichage == "paypal"){ echo 'PayPal'; }elseif($affichage == "dedipass"){echo 'Dedipass';}else{echo 'PaySafeCard';}?></h3>
            </div>
        <div class="card-body" id="payementinfo">
            <div class="col-md-12">
                <div class="row">
                <?php if($affichage == "paypal"){ ?>
                    <div class="offset-md-4 col-md-4">
                        <label class="custom-control custom-switch">
                            <input onclick="sendPost('payementinfo');" type="checkbox" class="custom-control-input" name="paypal" id="paypallabel" <?php if($lectureP['paypal'] == true) echo 'checked'; ?>/> 
                            <label for="paypallabel" class="custom-control-label">Activé</label>
                        </label>
                    </div>
                <?php }elseif($affichage == "dedipass"){?>
                    <div class="offset-md-4 col-md-4">
                        <label class="custom-control custom-switch">
                            <input onclick="sendPost('payementinfo');" type="checkbox" name="dedipass" id="dedipasslabel" class="custom-control-input" <?php if($lectureP['dedipass'] == true) echo 'checked'; ?>>
                            <label for="dedipasslabel" class="custom-control-label">Activé</label>
                        </label>
                    </div>
                <?php }else{ ?>
                    <div class="offset-md-4 col-md-4">
                        <label class="custom-control custom-switch">
                            <input onclick="sendPost('payementinfo');" type="checkbox" id="paysafecardlabel" class="custom-control-input" name="paysafecard" <?php if($lectureP['paysafecard'] == true) echo 'checked'; ?>>
                            <label for="paysafecardlabel" class="custom-control-label">Activé</label>
                        </label>
                    </div>
                <?php } ?>
                <input style="visibility: hidden;display: inline;" type="text" value="<?=$affichage;?>" id="quelretour" />
                </div>
                <?php if($affichage == "dedipass") { ?>
                    <!-- Dedipass -->
                    <div class="alert alert-success">
                        <p class="text-center">
                            Vous avez du mal à créer / configurer la solution de paiement DediPass ? Consultez notre <a href="https://craftmywebsite.fr/forum/index.php?threads/tuto-configurer-le-paiement-par-d%C3%A9dipass.3184/" target="_blank" rel="noopener noreferrer">tutoriel complet</a> !
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
                    <script>initPost('payementinfo', 'admin.php?&action=editPayement');</script>
                    <div class="card-footer">
                        <div class="row">
                            <input type="submit" class="btn btn-success w-100" onclick="sendPost('payementinfo');" value="Valider les changements !" />
                        </div>
                    </div>
                <?php } elseif($affichage == "paypal")
                { ?>
                <!-- PayPal  -->
                <div class="row">
                    <label class="control-label">Email paypal</label>
                    <input type="text" name="paypalEmail" class="form-control" value="<?php echo $lectureP['paypalEmail']; ?>" placeholder="L'email lié à votre compte paypal."/>
                </div>
                <input type="hidden" name="paypalpage" value="1">
                <script>initPost('payementinfo', 'admin.php?&action=editPayement');</script>
                <div class="card-footer">
                    <div class="row">
                        <input type="submit" class="btn btn-success w-100" onclick="sendPost('payementinfo');" value="Valider les changements !" />
                    </div>
                </div>
            <?php } else {
                ?>
                <input type="hidden" name="paysafecardpage" value="1">
                <div class="row">
                    <div class="alert alert-danger">
                        <p>Notre systéme "PaySafeCard" n'est pas affilié à PaySafe / PaySafeCard LTD et repose sur une validation manuelle ! Lorsqu'un joueur achète des <?=$_Serveur['General']['moneyName'];?> via une offre PaySafeCard il vous faut venir sur cette page afin de récupérer le code du joueur, prélever le montant de l'offre et cliquer sur le bouton de validation afin de livrer les <?=$_Serveur['General']['moneyName'];?> à l'acheteur ! Pour valider des codes paysafecard / vérifier le solde de code paysafecard rendez-vous <a href="https://www.paysafecard.com/fr-fr/" target="_blank" rel="noopener noreferrer">sur le site officiel de PaySafe</a> </p>
                        Le saviez-vous: <strong>Vous pouvez payer l'hébergement de votre site web via code PaySafeCard <a href="https://webstrator.fr/" target="_blank" rel="noopener noreferrer">chez notre partenaire Webstrator.fr</a> !</strong>
                    </div>
                </div>
                <script>initPost('payementinfo', 'admin.php?&action=editPayement');</script>
            <?php } ?>
            </div>
        </div>
    </div>
</div>
    <?php }
    if($_Permission_->verifPerm('PermsPanel', 'payment', 'actions', 'addOffrePaypal') AND ($affichage == "paypal")) { ?>
    <div class="col-md-12 col-xl-6 col-12 text-center">
        <div class="card  ">
            <div class="card-header ">
                <h3 class="card-title">Création d'une offre Paypal</h3>
            </div>
            <div class="card-body" id="newpaypal">
                <div class="alert alert-success">
                    <strong>Une fois votre compte paypal configuré, vous allez devoir créer une offre paypal pour que les joueurs puissent l'acheter !</strong>
                </div>
                    <div class="col-md-12">
                        <h3>Créer une offre</h3>
                        <div class="row">
                            <label class="control-label">Titre de l'offre</label>
                            <input type="text" name="nom" class="form-control" placeholder="ex: 5€ - 1500<?=$_Serveur['General']['moneyName'];?>" required/>
                        </div>
                        <div class="row">
                            <label class="control-label">Message de l'offre</label>
                            <input type="text" name="description" class="form-control" placeholder="ex: < img src=... / >" required/>
                        </div>
                        <div class="row">
                            <label class="control-label">Prix de l'offre</label>
                            <input type="number" step="0.01" name="prix" class="form-control" placeholder="ex: 5" required>
                        </div>
                        <div class="row">
                            <label class="control-label"><?=$_Serveur['General']['moneyName'];?> donnés</label>
                            <input type="number" name="jetons_donnes" class="form-control" placeholder="ex: 1500" required>
                        </div>
                        <hr>

                    </div>
            </div>
             <script>initPost('newpaypal', 'admin.php?&action=creerOffrePaypal', function(data) { if(data) {paypalUpdate() ;}});</script>
            <div class="card-footer">
                <div class="row">
                    <input type="submit" onclick="sendPost('newpaypal');" class="btn btn-success w-100" value="Créer l'offre !" />
                </div>
            </div>
        </div>
    </div>
    <?php }
    if($_Permission_->verifPerm('PermsPanel', 'payment', 'actions', 'editOffrePaypal') AND $affichage == "paypal") { ?>
    <div class="col-md-12 col-xl-6 col-12 text-center">
        <div class="card  " >
            <div class="card-header ">
                <h3 class="card-title">Mes offres PayPal</h3>
            </div>
        <div class="card-body" id="offrePaypal">
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
                        <li class="nav-item" id="tab-payementPaypal<?php echo $i; ?>"><a href="#payementPaypal<?php echo $i; ?>" data-toggle="tab" style="color: #000 !important" class="nav-link <?php if($i == 0) echo 'active'; ?>">Offre #<?php echo $i+1; ?></a></li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content">
                        <?php for($i = 0; $i < count($paypalOffres) ; $i++)   { ?>
                        <div class="tab-pane well <?php if($i == 0) echo 'active'; ?>" id="payementPaypal<?php echo $i; ?>">
                                <div class="row">
                                    <label class="control-label">Titre de l'offre</label>
                                    <input type="text" name="nom" value="<?php echo $paypalOffres[$i]['nom']; ?>" class="form-control" placeholder="ex: 5€ - 1500<?=$_Serveur['General']['moneyName'];?>" required/>
                                </div>
                                <div class="row">
                                    <label class="control-label">Message de l'offre</label>
                                    <input type="text" name="description" value="<?php echo htmlspecialchars($paypalOffres[$i]['description']); ?>" class="form-control" placeholder="ex: < img src=... / >" required/>
                                </div>
                                <div class="row">
                                    <label class="control-label">Prix de l'offre</label>
                                    <input type="number" step="0.01" name="prix" value="<?php echo $paypalOffres[$i]['prix']; ?>" class="form-control" placeholder="ex: 5" required/>
                                </div>
                                <div class="row">
                                    <label class="control-label"><?=$_Serveur['General']['moneyName'];?> donnés</label>
                                    <input type="number" name="jetons_donnes" value="<?php echo $paypalOffres[$i]['jetons_donnes']; ?>" class="form-control" placeholder="ex: 1500" required/>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button onclick="sendDirectPost('?&action=supprimerPaypalOffre&id=<?php echo $paypalOffres[$i]['id']; ?>',function(data) { if(data) { hide('payementPaypal<?php echo $i; ?>'); hide('tab-payementPaypal<?php echo $i; ?>');}});" class="btn btn-danger w-100">Supprimer</button>                                        
                                            </div>
                                            <div class="col-md-6">
                                                <input type="submit"  onclick="sendPost('payementPaypal<?php echo $i; ?>');" class="btn btn-success w-100" value="Modifier Les changements !"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>initPost('payementPaypal<?php echo $i; ?>', 'admin.php?&action=modifierOffrePaypal&id=<?php echo $paypalOffres[$i]['id']; ?>',null);</script>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
    <?php } 
    if($_Permission_->verifPerm('PermsPanel', 'payment', 'actions', 'editOffrePaysafeCard') AND $affichage != "paypal" AND $affichage != "dedipass") { ?>
    <div class="col-md-12 col-xl-12 col-12 text-center">
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" onclick="sendPost('payementPaysafecard<?php echo $i; ?>');"class="custom-control-input" id="active<?=$i;?>" name="statut"
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
                                        <label class="control-label"><?=$_Serveur['General']['moneyName'];?> donnés</label>
                                        <input type="number" name="jetons" value="<?php echo $paysafecard[$i]['jetons']; ?>" class="form-control" placeholder="ex: 1500"/>
                                    </div>
                                </div><hr>
                                <div class="row">
                                    <div class="offset-md-4 col-md-4">
                                        <input type="submit" onclick="sendPost('payementPaysafecard<?php echo $i; ?>');" class="btn btn-success align-center w-75" value="Modifier Les changements !"/>
                                    </div>
                                </div>
                                 <script>initPost('payementPaysafecard<?php echo $i; ?>', 'admin.php?&action=modifierOffrePaysafecard&id=<?php echo $paysafecard[$i]['id']; ?>',null);</script>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } 
    if($_Permission_->verifPerm('PermsPanel', 'payment', 'actions', 'verifPaysafecard') && !empty($tabPaysafe) AND $affichage != "paypal" AND $affichage != "dedipass") { ?>
    <div class="col-md-12 col-xl-12 col-12 text-center">
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
                        <th><?=$_Serveur['General']['moneyName'];?></th>
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