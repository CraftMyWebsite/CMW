<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2 gray">
        Réglages de la boutique
    </h2>
</div>


<?php if(!Permission::getInstance()->verifPerm('PermsPanel', 'shop', 'showPage', 'addCategorie') AND !Permission::getInstance()->verifPerm('PermsPanel', 'shop', 'actions', 'addOffre') AND !Permission::getInstance()->verifPerm('PermsPanel', 'shop', 'actions', 'editCategorieOffre')) { ?>

	<div class="alert alert-danger">
        <strong>Vous avez aucune permission pour accéder aux réglages du slider et des miniatures.</strong>
    </div>
<?php } ?>
<div class="row">
<?php if(Permission::getInstance()->verifPerm('PermsPanel', 'shop', 'actions', 'addCategorie')) {?>
    <div class="col-xs-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Créer une catégorie
                </h4>
            </div>
            <div class="card-body" id="createCate">
            		<div class="alert alert-success">
						<strong>Avant de créez une catégorie sachez d'abord à quoi servent ces catégories, en effet en plus de permettre de ne pas tout mettre en vrac et d'avoir un minimum d'organisation, les catégories vous permettent de gérer le multiserveur! Vous avez trois choix pour le serveur d'action d'une catégorie: tous les serveurs(la commande est envoyée sur tous les serveurs), le serveur où le joueur est en ligne(par exemple pour un give d'item) ou un serveur spécifique que vous choisissez à l'avance. L'ordre de la catégorie est l'ordre d'affichage, il ne sert qu'à titre d'organisation.</strong>
					</div>

						<label class="control-label">Titre de la catégorie</label>
						<input type="text" class="form-control" name="titre" placeholder="ex: Grades pas chers !" required>

						<label class="control-label">Ordre d'affichage</label>
						<input type="number" class="form-control" name="ordre" value="<?php echo $categorieNum; ?>" placeholder="L'ordre dans lequel va s'afficher la catégorie !" required> 
					
						<label class="control-label">Connexion In-Game</label>
						<select name="connection"class="form-control" required>
							<option value="0">Désactivé</option>
							<option value="1">Activé</option>
						</select>
				
						<label class="control-label">Serveurs d'action</label>
						<select name="serveur" class="form-control" required>
							<option value="-1">Tous</option>
							<option value="-2">Au choix (Le joueur se connecte sur le serveur voulu)</option>
							<?php foreach($lectureJSON as $serveur) { ?>
							<option value="<?php echo $serveur['id']; ?>"><?php echo $serveur['nom']; ?></option>
							<?php } ?>
						</select>
					
						<label class="control-label">Description de la catégorie</label>
						<textarea class="form-control" name="message"></textarea>
            </div>
             <script>initPost("createCate", "admin.php?action=creerCategorie",function (data) { if(data) { show('card-minia'); boutiqueUpdate();}});</script>
            <div class="card-footer">
                <button type="submit" class="btn btn-success w-100" onClick="sendPost('createCate');">Envoyer!</button>
            </div>
        </div>
    </div>
    <?php } if(Permission::getInstance()->verifPerm('PermsPanel', 'shop', 'actions', 'addOffre')) {  ?>
    <div class="col-xs-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Créer une offre
                </h4>
            </div>
            <div class="card-body" id="createOffre">

				<div class="alert alert-success">
					<strong>Après avoir créé une catégorie, vous pouvez y insérer une offre. L'offre est dans un premier temps composée d'un titre, d'un message(ou image) et appartient à une catégorie, vous pourrez par la suite attribuer à une offre une "action"(=commande). Pour mettre une image rien de plus simple, vous pouvez le faire via le code suivant: </strong><br><strong><?php echo htmlspecialchars('<img src="http://lien_vers_mon_image.fr/" alt="Image Boutique" />'); ?></strong>
				</div>

						<label class="control-label">Titre de l'offre</label>
						<input type="text" class="form-control" name="nom" placeholder="ex: 64 x Diamants" required> 
				
						<label class="control-label">Description</label>
						<input type="text" class="form-control" name="description" placeholder="ex: <img src=... />"> 
				
						<label class="control-label">Prix</label>
						<input type="number" class="form-control" name="prix" required>
					
						<label class="control-label">Catégorie</label>
						<select name="categorie" class="form-control" required>
							<?php $k = 0;
							while($k < count($categories)) { ?>
							<option value="<?php echo $categories[$k]['id']; ?>"><?php echo $categories[$k]['titre']; ?></option>
							<?php $k++; } ?>
						</select>
				
						<label class="control-label">Nombre de ventes possibles <small>(-1 si aucune limite, max 9999)</small></label><br>
						<input class="form-control" type="number" name="nbre_vente" value="-1" min="-1" max="9999" required />
					
            </div>
             <script>initPost("createOffre", "admin.php?action=creerOffre",function (data) { if(data) { boutiqueUpdate();}});</script>
            <div class="card-footer">
                <button type="submit" class="btn btn-success w-100" onClick="sendPost('createOffre');">Envoyer!</button>
            </div>
        </div>
    </div>
<?php } if(Permission::getInstance()->verifPerm('PermsPanel', 'shop', 'actions', 'createCoupon')) { ?>
	<div class="col-xs-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Création de coupon de réduction
                </h4>
            </div>
            <div class="card-body" id="createCoupon">

				<div class="alert alert-success">
					<strong>Ici vous pouvez créer des coupons de réduction pour votre boutique. La valeur des coupons est en %age. Il ne peut y avoir qu'un seul coupon utilisé par paiement, les coupons sont valables jusqu'à ce que vous les supprimiez et ils sont réutilisables. Il vous suffit simplement de rentrer un code de maximum 8 lettres, un pourcentage ainsi qu'un titre pour décrire votre remise, il apparaîtra dans la description du produit dans le panier.</strong>
				</div>
					<label class="control-label">Titre de la remise (description)</label>
					<input type="text" class="form-control" name="titre" placeholder="Remise spécial CMW V1.8" required maxlength="60">

					<label class="control-label"> Pourcentage de remise </label>
					<input type="number" name="pourcent" class="form-control" max="100" min="1" required >

					<label class="control-label"> Code de remise </label>
					<input type="text" name="code" class="form-control" maxlength="8" placeholder="CMWV1.8">

					<div class="text-center"><button class="btn btn-info w-100" onclick="SwitchDisplay(get('advancedoption'))" >Options Avancées</button></div>
					<div class="row" id="advancedoption" style="display:none;margin-top:15px;padding:15px;">
						<div class="col-xs-12"> 
							<label class="control-label" for="OuiCat">Activer l'option : "Code utilisable sur une seule catégorie" &nbsp;</label>
                            <div class="custom-control custom-switch" style="padding-top: 20px">
                                <input type="checkbox" class="custom-control-input" onclick="SwitchDisplay(get('OuiCatTab'))" id="OuiCat" name="OuiCat" >
                                <label class="custom-control-label" for="OuiCat">Oui</label>
                            </div>
                            <div style="margin:10px;display:none;" id="OuiCatTab">
                            	<label class="control-label" > Quelle catégorie ?</label>
    								<select name="cat" class="form-control">
												<?php 
												$a = 0;
												while($a < count($categories))
												{
													?><option id="cate-list-<?=$categories[$a]['id'];?>" value="<?=$categories[$a]['id'];?>"><?=$categories[$a]['titre'];?></option><?php
													$a++;
												}
												$a = 0;
												?> 
									</select>

                            </div>
						</div>
						<hr></hr>
						<div class="col-xs-12"> 
							<label class="control-label" for="OuiTemps">Activer l'option : "Code utilisable sur une période de temps (début/fin)" &nbsp;</label>
                            <div class="custom-control custom-switch" style="padding-top: 20px">
                                <input type="checkbox" class="custom-control-input" onclick="SwitchDisplay(get('OuiTempsTab'))" id="OuiTemps" name="OuiTemps" >
                                <label class="custom-control-label" for="OuiTemps">Oui</label>
                            </div>
                            <div style="margin:10px;display:none;" id="OuiTempsTab">
                            	<label class="control-label" > Date de début (mm/jj/aaaa HH:MM) </label>
    							<input type="text" class="form-control" name="dDebut" placeholder="mm/jj/aaaa HH:MM">
    							<label class="control-label" > Date de fin (mm/jj/aaaa HH:MM) (le coupon sera automatiquement supprimé après)</label>
    							<input type="text" class="form-control" name="dFin" placeholder="mm/jj/aaaa HH:MM">

                            </div>
						</div>
						<hr></hr>
						<div class="col-xs-12"> 
							<label class="control-label" for="OuiFois">Activer l'option : "Code utilisable un certain nombre de fois" &nbsp;</label>
                            <div class="custom-control custom-switch" style="padding-top: 20px">
                                <input type="checkbox" class="custom-control-input" onclick="SwitchDisplay(get('OuiFoisTab'))" id="OuiFois" name="OuiFois" >
                                <label class="custom-control-label" for="OuiFois">Oui</label>
                            </div>
                            <div style=" margin:10px;display:none;" id="OuiFoisTab">
                            	<label class="control-label"> Nombre de fois maximum d'utilisation (le coupon sera automatiquement supprimé après)</label>
    							<input type="number" class="form-control" name="expire">

                            </div>
						</div>
					</div>

					
            </div>
             <script>initPost("createCoupon", "admin.php?action=creerCoupon",function (data) { if(data) {
             	let str = "";
             	str+="<tr>";
             	str+= "<td>"+getValueByName("createCoupon", "titre")+"</td>";
             	str+= "<td>"+getValueByName("createCoupon", "code")+"</td>";
             	str+= "<td>"+getValueByName("createCoupon", "pourcent")+"</td>";
             	str+= "<td>";
             	if(get("OuiCat").checked | get("OuiFois").checked |  get("OuiTemps").checked) {
             		str += "Utilisable ";
             		if(get("OuiCat").checked) {
             			str +="uniquement sur "+get("cate-list-"+getValueByName("createCoupon", "cat")).innerText+ " ";
             		}
             		if(get("OuiTemps").checked) {
             			str +="du "+getValueByName("createCoupon", "dDebut")+" au "+getValueByName("createCoupon", "dFin")+" ";
             		}
             		if(get("OuiFois").checked) {
             			str +="maximum "+getValueByName("createCoupon", "expire")+" fois";
             		}
             	}
             	str+= "<td></td>";
             	str+="</tr>";
             	get("allCoupon").innerHTML += str;
             }});</script>
            <div class="card-footer">
                <button type="submit" class="btn btn-success w-100" onClick="sendPost('createCoupon');">Envoyer!</button>
            </div>
        </div>
    </div>
<?php }if(Permission::getInstance()->verifPerm('PermsPanel', 'shop', 'actions', 'modifCoupon')) { ?> 
	<div class="col-xs-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Les coupons de réduction actuellement disponibles
                </h4>
            </div>
            <div class="card-body" >
            	<table class="table table-striped table-hover table-responsive">
                        <thead>
                            <tr>
							<th>Titre / Description</th>
							<th >Code de réduction</th>
							<th>Pourcentage de réduction</th>
							<th>Options avancées</th>
							<th>Actions ...</th>
                            </tr>
                        </thead>
                        <tbody id="allCoupon">
                        	<?php $coupons = getCouponsReduc($bddConnection);
						for($i = 0; $i < count($coupons); $i++)
						{
							?><tr id="coupon-<?php echo $coupons[$i]['id']; ?>">
								<td><?php echo $coupons[$i]['titre']; ?></td>
								<td><?php echo $coupons[$i]['code_promo']; ?></td>
								<td><?php echo $coupons[$i]['pourcent']; ?>%</td>
								<td><?php 
								if(isset($coupons[$i]['categorie']) || isset($coupons[$i]['debut']) || isset($coupons[$i]['expire']))
								{
									echo 'Utilisable ';
									if(isset($coupons[$i]['categorie']))
										echo 'uniquement sur '.$categories[array_search($coupons[$i]['categorie'], array_column($categories, 'id'))]['titre'].' ';
									if(isset($coupons[$i]['debut']))
										echo 'du '.date('d/m/Y H:i', $coupons[$i]['debut']).' au '.date('d/m/Y H:i', $coupons[$i]['fin']).' ';
									if(isset($coupons[$i]['expire']))
										echo 'maximum '.$coupons[$i]['expire'].' fois';
								}
								?></td>
								<td><button type="button" class="btn btn-danger" onclick="sendDirectPost('admin.php?action=supprCoupon&id=<?php echo $coupons[$i]['id']; ?>', function(data) { if(data) { hide('coupon-<?php echo $coupons[$i]['id']; ?>'); }});" >Supprimer le coupon</button></td>
							</tr><?php
						}
					?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
<?php } if(Permission::getInstance()->verifPerm('PermsPanel', 'shop', 'actions', 'editCategorieOffre')) { ?>

	<div class="col-xs-12 col-md-12" id="card-minia" <?php if(empty($categories)) { echo 'style="display:none;"'; } ?>>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                   Edition des offres/catégories
                </h4>
            </div>
            <div class="card-body" id="editRapNav">
                <div class="col-md-12" id="allcategorie">
                	<ul class="nav nav-tabs" id="list-minia">
                        <?php for($i = 0;$i < count($categories);$i++) {?>
                        <li class="nav-item" id="tabnavRap<?=$i?>"><a
                            class="<?php if($i == 0) echo 'active'; ?> nav-link"
                            href="#navRap<?=$i?>" data-toggle="tab"
                            style="color: black !important"><?php echo $categories[$i]['titre']; ?></a></li>
                        <?php }?>
                    </ul>
                        
                    <div class="tab-content" id="speccategorie">
                     
                        <?php for($i = 0;$i < count($categories);$i++) {?>
                          
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
									<script>initPost("navRap<?=$i?>", "admin.php?action=boutique",function (data) { if(data) {
						             }});</script>
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
                                                    <script>initPost("new-action-<?php echo $offres[$j]['id']; ?>", "admin.php?action=creerAction",function (data) { if(data) { boutiqueUpdate(); }});</script>
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
                                                
                                                <script>initPost("allaction-<?php echo $offres[$j]['id']; ?>", "admin.php?action=editerAction",function (data) { if(data) { boutiqueUpdate(); }});</script>
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
                </div>
            </div>
        </div>
    </div>
<?php } ?>
</div>