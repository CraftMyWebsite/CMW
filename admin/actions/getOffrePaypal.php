<?php echo '[DIV]'; if($_Permission_->verifPerm('PermsPanel', 'payment', 'actions', 'editOffrePaypal')) {
	require_once('./admin/donnees/payement.php'); ?>
	<?php if(!isset($paypalOffres) OR empty($paypalOffres)) { ?>
            <div class="alert alert-warning">
                <strong>Vous devez créer une offre PayPal !</strong>
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
                                    <input type="text" name="nom" value="<?php echo $paypalOffres[$i]['nom']; ?>" class="form-control" placeholder="ex: 5€ - 1500 <?=$_Serveur_['General']['moneyName'];?>"/>
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
                                    <label class="control-label"><?=$_Serveur_['General']['moneyName'];?> donnés</label>
                                    <input type="number" name="jetons_donnes" value="<?php echo $paypalOffres[$i]['jetons_donnes']; ?>" class="form-control" placeholder="ex: 1500"/>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button onclick="sendDirectPost('?&action=supprimerPaypalOffre&id=<?php echo $paypalOffres[$i]['id']; ?>',function(data) { if(data) { hide('payementPaypal<?php echo $i; ?>'); hide('tab-payementPaypal<?php echo $i; ?>');}});" class="btn btn-danger w-100">Supprimer</button>                                        
                                            </div>
                                            <div class="col-md-6">
                                                <input type="submit"  onclick="sendPost('payementPaypal<?php echo $i; ?>');" class="btn btn-success w-100" value="Valider les changements !"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div data-callback="payementPaypal<?php echo $i; ?>" data-url="admin.php?&action=modifierOffrePaypal&id=<?php echo $paypalOffres[$i]['id']; ?>"></div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } 
 } ?>
