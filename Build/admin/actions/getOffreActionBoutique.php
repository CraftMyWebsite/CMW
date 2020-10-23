<?php echo '[DIV]'; if($_Permission_->verifPerm('PermsPanel', 'shop', 'actions', 'editCategorieOffre')) { 
	require_once('./admin/donnees/boutique.php'); ?> 

    <?php if(!empty($actions)) { for($k = 0;$k < count($actions);$k++) {
        if($actions[$k]['id_offre'] == $_GET['id']) {?>
            <div data-callback="allaction-<?php echo $_GET['id']; ?>" data-url="admin.php?action=editerAction"></div>
                <div class="col-md-12 col-lg-5" style="margin-top:10px;">
                    <?php if($actions[$k]['methode'] == 6){?>
                        <select class="form-control" name="commandeValeur-<?php echo $actions[$k]['id']; ?>">
                            <option value="0" <?php if($actions[$k]['grade'] == 0) echo 'selected'; ?>> Joueur </option>
                            <?php  for($i = 0; $i < count($idGrade); $i++) {  ?>
                                <option value="<?php echo $idGrade[$i]['id']; ?>" <?php if($actions[$k]['grade'] == $idGrade[$i]['id']) echo 'selected';?>><?= $idGrade[$i]['nom']?></option>
                            <?php }?>
                                <option value="1" <?php if($actions[$k]['grade'] == 1) echo 'selected'; ?>>Créateur</option>
                        </select>
                    <?php } else {?>
                        <input name="commandeValeur-<?php echo $actions[$k]['id']; ?>" class="form-control" value="<?php echo $actions[$k]['commande_valeur']; ?>"/>
                    <?php }?>
                </div>
                <div class="col-md-12 col-lg-5" style="margin-top:10px;">
                    <select class="form-control" name="methode-<?php echo $actions[$k]['id']; ?>">
                        <option value="<?php echo $actions[$k]['methode']; ?>"><?php echo $actions[$k]['methodeTxt']; ?></option><?php
                        if($actions[$k]['methode'] != 0) echo '<option value="0">Commande(sans /)</option>';
                        if($actions[$k]['methode'] != 1) echo '<option value="1">Message Serveur</option>';
                        if($actions[$k]['methode'] != 2) echo '<option value="2">Changer de grade</option>';
                        if($actions[$k]['methode'] != 3) echo '<option value="3">Give un item</option>';
                        if($actions[$k]['methode'] != 4) echo '<option value="4">Envoyer de l\'argent iConomy</option>';
                        if($actions[$k]['methode'] != 5) echo '<option value="5">Give d\'xp</option>'; 
                        if($actions[$k]['methode'] != 6) echo '<option value="6">Grade site</option>'; ?>
                    </select>
                </div>                                         
                <div class="col-md-12 col-lg-2" style="margin-top:10px;">
                    <button type="button" style="width:100%"onclick="sendDirectPost('admin.php?action=supprAction&id=<?php echo $actions[$k]['id']; ?>', function() {
                                                                            hide('allaction-<?php echo $_GET['id']; ?>');
                                                                     });" class="btn btn-danger"><i class="fas fa-times"></i></button>
                </div>
            <?php } } } ?>
<?php } ?>