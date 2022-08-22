<?php echo '[DIV]'; if($_Permission_->verifPerm('PermsPanel', 'shop', 'actions', 'editCategorieOffre')) { 
	require_once('./admin/donnees/boutique.php'); ?> 
                    <ul class="nav nav-tabs" id="list-minia">
                        <?php for($i = 0;$i < count($categories);$i++) {?>
                        <li class="nav-item" id="tabnavRap<?=$i?>"><a class="<?php if($i == 0) echo 'active'; ?> nav-link" href="#navRap<?=$i?>" data-toggle="tab" style="color: black !important" id="titlecat<?=$i?>"><?php echo $categories[$i]['titre']; ?></a></li>
                        <?php }?>
                    </ul>
                    <div class="tab-content" id="speccategorie">
                     
                       <?php if(isset($offres) && !empty($offres)) { for($j = 1;$j <= count($offres);$j++) { ?>
                            <div data-callback="allaction-<?php echo $offres[$j]['id']; ?>" data-url="admin.php?action=editerAction"></div>
                            <div data-callback="new-action-<?php echo $offres[$j]['id']; ?>" data-url="admin.php?action=creerAction"></div>
                        <?php } } for($i = 0;$i < count($categories);$i++) {?>

                            <div data-boutique-callback="<?php echo $categories[$i]['id']; ?>" data-boutique-callback-name="<?php echo $categories[$i]['titre']; ?>"></div>
                            <div data-callback="navRap<?=$i?>" data-url="admin.php?action=editBoutique" data-js="boutiqueCheck"></div>
                          
                            <div class="tab-pane <?php if($i == 0) echo 'active'; ?>" id="navRap<?=$i?>" >
                                <div style="width: 100%;display: inline-block">
                                    <input type="hidden" name="categorie" class="form-control" value="<?php echo $categories[$i]['id']; ?>" />
                                    <div class="float-left col-md-8" >
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <label class="control-label">Titre de la catégorie</label>
                                                <input type="text" class="form-control" onkeyup="get('titlecat<?=$i?>').innerText = this.value" name="categorieNom" value="<?php echo $categories[$i]['titre']; ?>" placeholder="Remise spécial CMW V1.8" required maxlength="60">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="control-label">Nombre d'offre par ligne dans la catégorie (min: 1, max: 4)</label>
                                                 <input class="form-control" required type="number" name="number"  min ="1" max="4" value="<?php echo $categories[$i]['showNumber']; ?>" />
                                             </div>
                                        </div>
                                    </div>
                                    <div class="float-right" style="margin-top:15px;">
                                        <button  onclick="sendDirectPost('admin.php?action=supprCategorie&id=<?php echo $categories[$i]['id']; ?>', function(data) { if(data) { hide('navRap<?=$i?>');hide('tabnavRap<?=$i?>');}});" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                                    </div>
                                </div>
                                <div class="col-md-12">


                                    <label class="control-label">Description de la catégorie</label>
                                    <textarea class="form-control" id="ckeditor" data-UUID="CATBOUTIQUENEW0" name="categorieInfo" class="col-sm-12"><?php echo $categories[$i]['message']; ?></textarea>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Description</th>
                                                <th>Prix</th>
                                                <th>Catégorie</th>
                                                <th>Nombre de ventes restantes</th>
                                                <th>Ordre</th>
                                                <th>Supprimer</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($offres) && !empty($offres)) { for($j = 1;$j <= count($offres);$j++) {
                                                if($offres[$j]['categorie'] == $categories[$i]['id']) {?>
                                                    <tr id="ligneoffre-<?php echo $offres[$j]['id']; ?>">
                                                <td><input type="text" name="offresNom<?php echo $offres[$j]['id']; ?>" class="form-control" value="<?php echo $offres[$j]['nom']; ?>" /></td>
                                                <td>
                                                    <button class="btn btn-primary" data-toggle="modal" type="button" data-target="#description_offre<?php echo $offres[$j]['id']; ?>">
                                                    <i class="fas fa-pen"></i> / <i class="far fa-eye"></i>
                                                    </button>
                                                    <div class="modal fade" id="description_offre<?=$offres[$j]['id'];?>" tabindex="-1"
                                                        role="dialog" aria-labelledby="description_offre<?=$offres[$j]['id'];?>Label"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-light">
                                                                    <h5 class="modal-title" id="description_offre<?=$offres[$j]['id'];?>Label">Description de l'offre - <?php echo $offres[$j]['nom']; ?></h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body bg-light">
                                                                    <textarea name="offresDescription<?php echo $offres[$j]['id']; ?>" data-UUID="descoffre<?php echo $offres[$j]['id']; ?>" id="ckeditor"><?php echo $offres[$j]['description']; ?></textarea>
                                                                </div>
                                                                <div class="modal-footer bg-light">
                                                                    <button type="button" class="btn btn-success btn-block"
                                                                        data-dismiss="modal"><strong>Fermer</strong> (sauvegarde les modifications)</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><input type="text" name="offresPrix<?php echo $offres[$j]['id']; ?>" class="form-control" value="<?php echo $offres[$j]['prix']; ?>" /></td>
                                                <td>
                                                <select class="form-control" name="offresCategorie<?php echo $offres[$j]['id']; ?>">
                                                        <?php $k = 0; while($k < count($categories)) { 

                                                             echo '<option value="' .$categories[$k]['id']. '" '.($categories[$k]['id'] == $offres[$j]['categorie'] ? 'selected' : '').'>' .$categories[$k]['titre']. '</option>'; $k++;
                                                        } ?>
                                                        </select>
                                                </td>
                                                <td><input type="number" name="nbre_vente<?php echo $offres[$j]['id']; ?>" class="form-control" value="<?php echo $offres[$j]['nbre_vente']; ?>" /></td>
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
                                            <?php } } }?>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-success w-100" style="margin-top:10px;" onClick="sendPost('navRap<?=$i?>');">Envoyer!</button>
                                    <?php for($j = 1;$j <= count($offres);$j++) { if($offres[$j]['categorie'] == $categories[$i]['id']) {?>
                                    <div class="modal fade" id="OffreAction<?php echo $offres[$j]['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="Modal-<?php echo $offres[$j]['id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content" >
                                                <div class="modal-header bg-light">
                                                    <h5 class="modal-title" id="Modal-<?php echo $offres[$j]['id']; ?>"><?php echo $offres[$j]['nom']; ?></h5>
                                                    <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body bg-light" >

                                                    <div id="new-edit-<?php echo $offres[$j]['id']; ?>">

                                                            <label class="control-label">Nombre de ventes possibles par joueur <small>(-1 si aucune limite, max 9999)</small></label><br>
                                                            <input class="form-control" type="number" name="max_vente<?php echo $offres[$j]['id']; ?>" value="<?php echo $offres[$j]['max_vente']; ?>" min="-1" max="9999" required />

                                                            <label class="control-label">Dépendance de l'offre (devra avoir acheter les offres suivante avant celle-ci)</label>
                                                            <input type="text"  value="<?php echo isset($offres[$j]['evo']) ? $offres[$j]['evo'] : ''; ?>" id="dep-tag<?=$j.$offres[$j]['id']?>" name="dep<?php echo $offres[$j]['id']; ?>"  data-callback-tagsinput data-role="tagsinput">
                                                            <select style="margin-top:10px;" onfocus="this.selectedIndex = -1;" class="form-control" onchange="$('#dep-tag<?=$j.$offres[$j]['id']?>').tagsinput('add', { 'value': parseInt(this.value.split('|')[0]) , 'text': this.value.split('|')[1]});">
                                                                <?php for($z = 1;$z <= count($offres);$z++) { if($offres[$z]['id'] != $offres[$j]['id']) { ?>
                                                                    <option value="<?php echo $offres[$z]['id']; ?>|<?php echo $offres[$z]['nom']; ?>"><?php echo $offres[$z]['nom']; ?></option>
                                                                <?php } }?> 
                                                            </select>
                                                            <?php if(isset($offres[$j]['evo'])) {  
                                                                $tp = explode(",",$offres[$j]['evo']);
                                                                foreach($tp as $value)
                                                                {
                                                                    echo '<div  data-boutique-tagsinput="dep-tag'.$j.$offres[$j]['id'].'"  data-boutique-tagsinput-value="'.$value.'"  data-boutique-tagsinput-text="'.$offresByGet[$value].'"></div>';
                                                                } ?> 
                                                            <?php } ?> 
                                                            <div data-callback-loop="new-edit-<?php echo $offres[$j]['id']; ?>" data-idform="navRap<?=$i?>"></div>
                                                    </div>
                                                    <hr/>
                                                    <div id="new-action-<?php echo $offres[$j]['id']; ?>">
                                                        <h5 style="margin-top:10px;">Configurer les actions:</h4>
                                                        <label class="control-label">Type d'action <small>Utilisez {PLAYER} pour la variable joueur</small></select>
                                                        <select class="form-control" name="methode" onchange="
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
                                                                    <?php  for($i2 = 0; $i2 < count($idGrade); $i2++) {  ?>
                                                                            <option value="<?php echo $idGrade[$i2]['id']; ?>"><?= $idGrade[$i2]['nom']?></option>
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

                                                    <button type="button" onclick="sendPost('new-action-<?php echo $offres[$j]['id']; ?>', function() { boutiqueActionUpdate('<?php echo $offres[$j]['id']; ?>'); });" class="btn btn-secondary w-100">Envoyer!</button>

                                                     <button type="button" style="margin-top:15px;" onclick="SwitchDisplay(get('allaction-<?php echo $offres[$j]['id']; ?>'))" class="btn btn-danger w-100">Editer actions</button>

                                                
                                                    <div class="row" style="display:none;"  id="allaction-<?php echo $offres[$j]['id']; ?>">
                                                        <?php if(!empty($actions)) { for($k = 0;$k < count($actions);$k++) {
                                                            if($actions[$k]['id_offre'] == $offres[$j]['id']) {?>
                                                                <div class="col-md-12 col-lg-5" style="margin-top:10px;">
                                                                    <?php if($actions[$k]['methode'] == 6){?>
                                                                    <select class="form-control" name="commandeValeur-<?php echo $actions[$k]['id']; ?>">
                                                                        <option value="0" <?php if($actions[$k]['grade'] == 0) echo 'selected'; ?>> Joueur </option>
                                                                        <?php  for($i2 = 0; $i2 < count($idGrade); $i2++) {  ?>
                                                                                <option value="<?php echo $idGrade[$i2]['id']; ?>" <?php if($actions[$k]['grade'] == $idGrade[$i2]['id']) echo 'selected';?>><?= $idGrade[$i2]['nom']?></option>
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
                                                                            hide('allaction-<?php echo $offres[$j]['id']; ?>');
                                                                     });" class="btn btn-danger"><i class="fas fa-times"></i></button>
                                                                </div>
                                                        <?php } } } ?>
                                                    </div>
                                            
                                                    <div class="modal-footer bg-light">
                                                            <button type="button" style="margin-top:15px;" onclick="sendPost('navRap<?=$i?>');sendPost('allaction-<?php echo $offres[$j]['id']; ?>');" data-dismiss="modal" aria-label="Close" class="btn btn-primary w-100">Valider les changements</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php } } ?>

                                </div>
                            </div>
                        <?php } ?>
                    </div>
<?php } ?>