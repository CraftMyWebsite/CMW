<?php if(Permission::getInstance()->verifPerm('PermsPanel', 'shop', 'actions', 'editCategorieOffre')) { 
	require_once('./admin/donnees/boutique.php'); ?> 
					<ul class="nav nav-tabs" id="list-minia">
                        <?php for($i = 0;$i < count($categories);$i++) {?>
                        <li class="nav-item" id="tabnavRap<?=$i?>"><a
                            class="<?php if($i == 0) echo 'active'; ?> nav-link"
                            href="#navRap<?=$i?>" data-toggle="tab"
                            style="color: black !important"><?php echo $categories[$i]['titre']; ?></a></li>
                        <?php }?>
                    </ul>
                        
                    <div class="tab-content" id="speccategorie">
                     
                        <?php for($j = 0;$j < count($offres);$j++) { ?>
                            <div data-callback="allaction-<?php echo $offres[$j]['id']; ?>" data-url="admin.php?action=editerAction"></div>
                            <div data-callback="new-action-<?php echo $offres[$j]['id']; ?>" data-url="admin.php?action=creerAction"></div>
                    	<?php } for($i = 0;$i < count($categories);$i++) {?>
                            <div data-callback="navRap<?=$i?>" data-url="admin.php?action=boutique"></div>
                            <div class="tab-pane <?php if($i == 0) echo 'active'; ?>" id="navRap<?=$i?>" >
                                <div style="width: 100%;display: inline-block">
                                	<input type="hidden" name="categorie" class="form-control" value="<?php echo $categories[$i]['id']; ?>" />
                                    <div class="float-left">
                                        <label class="control-label">Titre de la catégorie</label>
										<input type="text" class="form-control" name="categorieNom" value="<?php echo $categories[$i]['titre']; ?>" placeholder="Remise spécial CMW V1.8" required maxlength="60">
                                    </div>
                                    <div class="float-right" style="margin-top:15px;">
                                        <button  onclick="sendDirectPost('admin.php?action=supprCategorie&id=<?php echo $categories[$i]['id']; ?>', function(data) { if(data) { hide('navRap<?=$i?>');hide('tabnavRap<?=$i?>');}});" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                	<label class="control-label">Description de la catégorie</label>
                                	<textarea class="form-control" name="categorieInfo" class="col-sm-12"><?php echo $categories[$i]['message']; ?></textarea>

                                	<table class="table">
                                		<thead>
											<tr>
												<th>Nom</th>
												<th>Description</th>
												<th>Prix</th>
												<th>catégorie</th>
												<th>Nombre de ventes restantes</th>
												<th>Ordre</th>
												<th>Supprimer</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php for($j = 0;$j < count($offres);$j++) {
												if($offres[$j]['categorie'] == $categories[$i]['id']) {?>
													<tr id="ligneoffre-<?php echo $offres[$j]['id']; ?>">
												<td><input type="text" name="offresNom<?php echo $offres[$j]['id']; ?>" class="form-control" value="<?php echo $offres[$j]['nom']; ?>" /></td>
												<td><input type="text" name="offresDescription<?php echo $offres[$j]['id']; ?>" class="form-control" value="<?php echo htmlspecialchars($offres[$j]['description']); ?>" /></td>
												<td><input type="text" name="offresPrix<?php echo $offres[$j]['id']; ?>" class="form-control" value="<?php echo $offres[$j]['prix']; ?>" /></td>
												<td>
													<select class="form-control" name="offresCategorie<?php echo $offres[$j]['id']; ?>">
														<option value="<?php echo $offres[$j]['categorie']; ?>"><?php echo $offres[$j]['categorie']; ?></option>
														<?php $k = 0; while($k < count($categories)) { 
															if($categories[$k]['titre'] != $offres[$j]['categorie']) echo '<option value="' .$categories[$k]['id']. '">' .$categories[$k]['titre']. '</option>'; $k++; } ?>
														</select>
												</td>
												<td><input type="number" name="nbre_vente_<?php echo $offres[$j]['id']; ?>" class="form-control" value="<?php echo $offres[$j]['nbre_vente']; ?>" /></td>
												<td><input type="number" name="offresOrdre<?php echo $offres[$j]['id']; ?>" class="form-control" value="<?php echo $offres[$j]['ordre']; ?>" /></td>
												<td>
													 <label class="switch">
                                                        <input type="checkbox" value="true" id="suppr<?php echo $offres[$j]['id']; ?>" name="suppr<?php echo $offres[$j]['id']; ?>">
                                                        <span class="slider round"></span>
                                                    </label>
												</td>
												<td><a class="btn btn-success" data-toggle="modal" data-target="#OffreAction<?php echo $offres[$j]['id']; ?>">Modifier</a></td>
												<input type="hidden" name="offresId<?php echo $offres[$j]['id']; ?>" value="<?php echo $offres[$j]['id']; ?>" />
											</tr>
											<?php } }?>
										</tbody>
									</table>
								
									<button type="submit" class="btn btn-success w-100" style="margin-top:10px;" onClick="sendPost('navRap<?=$i?>');">Envoyer!</button>
                                    <?php for($j = 0;$j < count($offres);$j++) { ?>
                                    <div class="modal fade" id="OffreAction<?php echo $offres[$j]['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="Modal-<?php echo $offres[$j]['id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content" style="padding:15px;">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="Modal-<?php echo $offres[$j]['id']; ?>"><?php echo $offres[$j]['nom']; ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" style="border-bottom: solid 1px rgba(0,0,0,0.25);">
                                                    <div id="new-action-<?php echo $offres[$j]['id']; ?>">

                                                        <label class="control-label">Type d'action <small>Utilisez {PLAYER} pour la variable joueur</small></select>
                                                        <select class="form-control" name="methode" onchange="
                                                            console.log('yes'+this.value);
                                                            switch(parseInt(this.value)) {
                                                                case 0:
                                                                    hide('grade-<?php echo $offres[$j]['id']; ?>');
                                                                    hide('gradesite-<?php echo $offres[$j]['id']; ?>');
                                                                    show('valeur-<?php echo $offres[$j]['id']; ?>');
                                                                    break;
                                                                case 1:
                                                                    hide('grade-<?php echo $offres[$j]['id']; ?>');
                                                                    hide('gradesite-<?php echo $offres[$j]['id']; ?>');
                                                                    show('valeur-<?php echo $offres[$j]['id']; ?>');
                                                                    break;
                                                                case 2:
                                                                    show('grade-<?php echo $offres[$j]['id']; ?>');
                                                                    hide('gradesite-<?php echo $offres[$j]['id']; ?>');
                                                                    show('valeur-<?php echo $offres[$j]['id']; ?>');
                                                                    break;
                                                                case 3:
                                                                    hide('grade-<?php echo $offres[$j]['id']; ?>');
                                                                    hide('gradesite-<?php echo $offres[$j]['id']; ?>');
                                                                    show('valeur-<?php echo $offres[$j]['id']; ?>');
                                                                    break;
                                                                case 4:
                                                                    hide('grade-<?php echo $offres[$j]['id']; ?>');
                                                                    hide('gradesite-<?php echo $offres[$j]['id']; ?>');
                                                                    show('valeur-<?php echo $offres[$j]['id']; ?>');
                                                                    break;
                                                                case 5:
                                                                    hide('grade-<?php echo $offres[$j]['id']; ?>');
                                                                    hide('gradesite-<?php echo $offres[$j]['id']; ?>');
                                                                    show('valeur-<?php echo $offres[$j]['id']; ?>');
                                                                    break;
                                                                case 6:
                                                                    hide('grade-<?php echo $offres[$j]['id']; ?>');
                                                                    show('gradesite-<?php echo $offres[$j]['id']; ?>');
                                                                    show('valeur-<?php echo $offres[$j]['id']; ?>');
                                                                    break;
                                                                default:
                                                                    console.log('nany');

                                                            }


                                                        ">
                                                            <option value="0" >Commande(sans /)</option>
                                                            <option value="1">Message Serveur</option>
                                                            <option value="2" >Changer de grade (serveur)</option>
                                                            <option value="3">Give un item</option>
                                                            <option value="4" >Envoyer de l'argent iConomy</option>
                                                            <option value="5">Give d'xp</option>
                                                            <option value="6" >Changer de grade (site)</option>
                                                        </select>

                                                        <div id="grade-<?php echo $offres[$j]['id']; ?>" style="display:none;">
                                                            <label class="control-label">Durée du grade</label>
                                                            <select class="form-control" name="duree">
                                                                <option value="1">1 mois</option>
                                                                <option value="2">2 mois</option>
                                                                <option value="3">3 mois</option>
                                                                <option value="6">6 mois</option>
                                                                <option value="12">1 an</option>
                                                                <option value="18">1 an et demi</option>
                                                                <option value="24">2 ans</option>
                                                                <option value="0">A vie</option>
                                                            </select>
                                                        </div>
                                                        <div id="gradesite-<?php echo $offres[$j]['id']; ?>" style="display:none;">
                                                            <label class="control-label">Grade Site</label>
                                                              <?php $itemps = $i;?>
                                                            <select class="form-control" name="grade_site">
                                                                    <option value="0">Joueur</option>
                                                                    <?php require('./admin/donnees/grades.php'); 
                                                                    for($z = 2; $z <= end($lastGrade); $z++) {
                                                                        if(file_exists($dirGrades.$z.'.yml') && $idGrade[$z]['Grade']) { ?>
                                                                                <option value="<?php echo $z; ?>"><?= $idGrade[$z]['Grade']?></option>
                                                                        <?php }?>
                                                                    <?php }?>
                                                                    <option value="1">Créateur</option>
                                                            </select>
                                                            <?php $i = $itemps;?>
                                                        </div>
                                                        <div id="valeur-<?php echo $offres[$j]['id']; ?>">
                                                            <label class="control-label">Valeur de l'action (nom du grade, montant, message ...) / commande</label>
                                                            <input type="text" class="form-control" name="valeur" placeholder="Exemple: pex user {PLAYER} group set chevalier" />
                                                        </div>
                                                        <input type="hidden" name="id_offre" value="<?php echo $offres[$j]['id']; ?>" />
                                                    </div>
                                             
                                                    <button type="button" onclick="sendPost('new-action-<?php echo $offres[$j]['id']; ?>', function(data) {if(data) { boutiqueUpdate();}});"class="btn btn-secondary w-100">Envoyer!</button>
                                                </div>

                                                
                                                <div class="row"  id="allaction-<?php echo $offres[$j]['id']; ?>">
                                                    <?php for($k = 0;$k < count($actions);$k++) {
                                                        if($actions[$k]['id_offre'] == $offres[$j]['id']) {?>
              
                                                            <div class="col-md-12 col-lg-5" style="margin-top:10px;">
                                                                <?php if($actions[$k]['methode'] == 6){?>
                                                                <select class="form-control" name="commandeValeur-<?php echo $actions[$k]['id']; ?>">
                                                                    <option value="0" <?php if($actions[$k]['grade'] == 0) echo 'selected'; ?>> Joueur </option>
                                                                    <?php for($z = 2; $z <= end($lastGrade); $z++) {
                                                                        if(file_exists($dirGrades.$z.'.yml') && $idGrade[$z]['Grade']) { ?>
                                                                            <option value="<?php echo $z; ?>" <?php if($actions[$k]['grade'] == $z) echo 'selected';?>><?php echo $idGrade[$z]['Grade'];?></option>
                                                                        <?php }
                                                                    }?>
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
                                                                 <button type="button" data-dismiss="modal" aria-label="Close" style="width:100%"onclick="sendDirectPost('admin.php?action=supprAction&id=<?php echo $actions[$k]['id']; ?>', function(data) {
                                                                    if(data) {
                                                                        hide('allaction-<?php echo $offres[$j]['id']; ?>');
                                                                    }
                                                                 });" class="btn btn-danger"><i class="fas fa-times"></i></button>
                                                            </div>
                                                    <?php } } ?>
                                                </div>
                                                
                                              
                                                <button type="button" style="margin-top:15px;" onclick="sendPost('allaction-<?php echo $offres[$j]['id']; ?>');" data-dismiss="modal" aria-label="Close" class="btn btn-primary w-100">Valider les changements</button>
                                                <div class="modal-footer">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php } ?>

                                </div>
                            </div>
                        <?php }?>
                    </div>
<?php } ?>