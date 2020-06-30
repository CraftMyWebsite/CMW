<div class="cmw-page-content-header"><strong>Réglages boutique</strong> - Paramétrez votre boutique</div>

<div class="row">
	<?php if($_Joueur_['rang'] != 1 AND ($_PGrades_['PermsPanel']['shop']['actions']['addCategorie'] == false AND $_PGrades_['PermsPanel']['shop']['actions']['addOffre'] == false AND $_PGrades_['PermsPanel']['shop']['actions']['editCategorieOffre'] == false)) { ?>

	<div class="col-lg-6 col-lg-offset-3 text-center">
		<div class="alert alert-danger">
			<strong>Vous avez aucune permission pour accéder aux réglages de la boutique.</strong>
		</div>
	</div>

	<?php } else { ?>

	<div class="alert alert-success">
		<strong>Dans cette section, créez des catégories d'achat boutique, choisissez le/les serveur(s) d'action, créez vos offres et attribuez des actions(commandes) à vos offres. Réglez toute la partie "Boutique In-Game", pour ce qui est de l'achat de jetons(monnaie de la boutique), veuillez vous reporter à la section "paiement"</strong>
	</div>

	<?php } if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['shop']['actions']['addCategorie'] == true) { ?>

	<div class="col-xs-12 col-md-6 text-center">
		<div class="panel panel-default cmw-panel">
			<div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Créer une catégorie</strong></h3>
            </div>
            <div class="panel-body">
				<div class="alert alert-success">
					<strong>Avant de créez une catégorie sachez d'abord à quoi servent ces catégories, en effet en plus de permettre de ne pas tout mettre en vrac et d'avoir un minimum d'organisation, les catégories vous permettent de gérer le multiserveur! Vous avez trois choix pour le serveur d'action d'une catégorie: tous les serveurs(la commande est envoyée sur tous les serveurs), le serveur où le joueur est en ligne(par exemple pour un give d'item) ou un serveur spécifique que vous choisissez à l'avance. L'ordre de la catégorie est l'ordre d'affichage, il ne sert qu'à titre d'organisation.</strong>
				</div>

				<form action="?&action=creerCategorie" method="POST">
					<div class="form-group col-lg-6">
						<label>Titre de la catégorie</label>
						<input type="text" class="form-control" name="titre" placeholder="ex: Grades pas chers !">
					</div>
					<div class="form-group col-lg-6">
						<label>Ordre d'affichage</label>
						<input type="number" class="form-control" name="ordre" value="<?php echo $categorieNum; ?>" placeholder="L'ordre dans lequel va s'afficher la catégorie !"> 
					</div>
					<div class="form-group col-lg-6">
						<label>Connexion In-Game</label>
						<select name="connection"class="form-control">
							<option value="0">Désactivé</option>
							<option value="1">Activé</option>
						</select>
					</div>
					<div class="form-group col-lg-6">
						<label>Serveurs d'action</label>
						<select name="serveur" class="form-control">
							<option value="-1">Tous</option>
							<option value="-2">Au choix (Le joueur se connecte sur le serveur voulu)</option>
							<?php for($i = 0; $i < count($lecture['Json']); $i++) { ?>
							<option value="<?php echo $i; ?>"><?php echo $lecture['Json'][$i]['nom']; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group col-lg-12">
						<label>Description de la catégorie</label>
						<textarea class="form-control" name="message"></textarea>
					</div>
					<hr>
					<div class="form-group col-lg-12">
						<button class="btn btn-success" type="submit">Créer la catégorie !</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php } if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['shop']['actions']['addOffre'] == true) { ?>

	<div class="col-xs-12 col-md-6 text-center">
	  	<div class="panel panel-default cmw-panel">
	  		<div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Créer une offre</strong></h3>
            </div>
            <div class="panel-body">
				<div class="alert alert-success">
					<strong>Après avoir créé une catégorie, vous pouvez y insérer une offre. L'offre est dans un premier temps composée d'un titre, d'un message(ou image) et appartient à une catégorie, vous pourrez par la suite attribuer à une offre une "action"(=commande). Pour mettre une image rien de plus simple, vous pouvez le faire via le code suivant: </strong><br><strong><?php echo htmlspecialchars('<img src="http://lien_vers_mon_image.fr/" alt="Image Boutique" />'); ?></strong>
				</div>
				<form action="?&action=creerOffre" method="POST">
					<div class="form-group col-lg-6">
						<label>Titre de l'offre</label>
						<input type="text" class="form-control" name="nom" placeholder="ex: 64 x Diamants">
					</div>
					<div class="form-group col-lg-6">
						<label>Description</label>
						<input type="text" class="form-control" name="description" placeholder="ex: <img src=... />"> 
					</div>
					<div class="form-group col-lg-6">
						<label>Prix</label>
						<input type="number" class="form-control" name="prix">
					</div>
					<div class="form-group col-lg-6">
						<label>Catégorie</label>
						<select name="categorie" class="form-control">
							<?php $k = 0;
							while($k < count($categories)) { ?>
							<option value="<?php echo $categories[$k]['id']; ?>"><?php echo $categories[$k]['titre']; ?></option>
							<?php $k++; } ?>
						</select>
					</div>
					<div class="form-group col-lg-12">
						<label>Nombre de ventes possibles <small>(-1 si aucune limite, max 9999)</small></label><br>
						<input class="form-control" type="number" name="nbre_vente" min="-1" max="9999" required />
					</div>
					<hr>
					<div class="form-group col-lg-12">
						<input class="btn btn-success" type="submit" value="Créer l'offre !"/>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php } if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['shop']['actions']['createCoupon'] == true ) { ?>

	<div class="col-xs-12 text-center">
		<div class="panel panel-default cmw-panel">
			<div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Création de coupon de réduction</strong></h3>
            </div>
            <div class="panel-body">
				<div class="alert alert-success">
					<strong>Ici vous pouvez créer des coupons de réduction pour votre boutique. La valeur des coupons est en %age. Il ne peut y avoir qu'un seul coupon utilisé par paiement, les coupons sont valables jusqu'à ce que vous les supprimiez et ils sont réutilisables. Il vous suffit simplement de rentrer un code de maximum 8 lettres, un pourcentage ainsi qu'un titre pour décrire votre remise, il apparaîtra dans la description du produit dans le panier.</strong>
				</div>
				<form action="?action=creerCoupon" method="POST">
					<div class="row">
						<div class="form-group col-lg-6">
							<label>Titre de la remise (description)</label>
							<input type="text" class="form-control" name="titre" placeholder="Remise spécial CMW V1.7" required maxlength="60">
						</div>
						<div class="form-group col-lg-6">
							<label> Pourcentage de remise </label>
							<input type="number" name="pourcent" class="form-control" max="100" min="1" required >
						</div>
						<div class="form-group col-lg-6">
							<label> Code de remise </label>
							<input type="text" name="code" class="form-control" maxlength="8" placeholder="CMWV1.7">
						</div>
					</div>
					<div class="row" style="padding-right: 10px; padding-left: 10px;">
						<button class="btn btn-info btn-block" data-toggle="collapse" type="button" data-target="#optionsAvancees" aria-expanded="false" aria-controls="optionsAvancees">Options Avancées</button>
						<div class="collapse" id="optionsAvancees"><br/>
							<div class="row">
								<div class="form-group col-md-4">
									<label>Activer l'option : "Code utilisable sur une seule catégorie"</label>
									<div class="form-check">
										<input type="checkbox" class="form-check-input" name="OuiCat" onChange="showOptions('Cat');" id="OuiCat">
    									<label class="form-check-label" for="OuiCat">Oui</label>
    								</div>
    								<div id="optionsCat" class="d-none">
    									<div class="form-group">
    										<label> Quelle catégorie ?</label>
    										<select name="cat" class="form-control">
												<?php 
												$i = 0;
												while($i < count($categories))
												{
													?><option value="<?=$categories[$i]['id'];?>"><?=$categories[$i]['titre'];?></option><?php
													$i++;
												}
												$i = 0;
												?> 
											</select>
										</div>
    								</div>
    							</div>
    							<div class="form-group col-md-4">
									<label>Activer l'option : "Code utilisable sur une période de temps (début/fin)"</label>
									<div class="form-check">
										<input type="checkbox" class="form-check-input" name="OuiTemps" onChange="showOptions('Temps');" id="OuiTemps">
    									<label class="form-check-label" for="OuiTemps">Oui</label>
    								</div>
    								<div id="optionsTemps" class="d-none">
    									<div class="form-group">
    										<label> Date de début (mm/jj/aaaa HH:MM) </label>
    										<input type="text" class="form-control" name="dDebut" placeholder="mm/jj/aaaa HH:MM">
    										<br/>
    										<label> Date de fin (mm/jj/aaaa HH:MM) (le coupon sera automatiquement supprimé après)</label>
    										<input type="text" class="form-control" name="dFin" placeholder="mm/jj/aaaa HH:MM">
    									</div> 
    								</div>
    							</div>
    							<div class="form-group col-md-4">
									<label>Activer l'option : "Code utilisable un certain nombre de fois"</label>
									<div class="form-check">
										<input type="checkbox" class="form-check-input" name="OuiFois" onChange="showOptions('Fois');" id="OuiFois">
    									<label class="form-check-label" for="OuiFois">Oui</label>
    								</div>
    								<div id="optionsFois" class="d-none">
    									<div class="form-group">
    										<label> Nombre de fois maximum d'utilisation (le coupon sera automatiquement supprimé après)</label>
    										<input type="number" class="form-control" name="expire">
    									</div>
    								</div>
    							</div>
    						</div>
    					</div>
    				</div>
					<hr>
					<div class="form-group col-lg-12">
						<input type="submit" class="btn btn-success" value="Créer le code de remise">
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php } if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['shop']['actions']['modifCoupon'] == true) { ?>

	<div class="col-xs-12 text-center">
		<div class="panel panel-default cmw-panel">
			<div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Les coupons de réduction actuellement disponibles</strong></h3>
            </div>
            <div class="panel-body">
				<div class="alert alert-success">
					<strong>Voici le tableau contenant tous les coupons de réduction qui sont disponibles. Vous pouvez les supprimer ici.</strong>
				</div>
				<table class="table table-striped table-hover table-dark">
					<tr>
						<th style="text-align: center;">Titre / Description</th>
						<th style="text-align: center;">Code de réduction</th>
						<th style="text-align: center;">Pourcentage de réduction</th>
						<th style="text-align: center;">Options avancées</th>
						<th style="text-align: center;">Actions ...</th>
					</tr>
					<?php $coupons = getCouponsReduc($bddConnection);
						for($i = 0; $i < count($coupons); $i++)
						{
							?><tr>
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
								<td><a href="?action=supprCoupon&id=<?php echo $coupons[$i]['id']; ?>" class="btn btn-danger" title="Supprimer le coupon">Supprimer le coupon</a></td>
							</tr><?php
						}
					?>
				</table>
			</div>
		</div>
	</div>

	<?php } if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['shop']['actions']['editCategorieOffre'] == true) { ?>

	<div class="col-xs-12 text-center">
	  	<div class="panel panel-default cmw-panel">
	  		<div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Edition des offres/catégories</strong></h3>
            </div>
            <div class="panel-body">
				<div class="alert alert-success">
					<strong>Une fois votre offre créée, vous pouvez la modifier mais avant tout lui ajouter une action, pour cela cliquez sur le bouton "action" de l'offre à modifier, la fenêtre qui s'ouvre vous propose différents types d'actions, ainsi que la "Valeur de l'action / Commande" qu'il faut y attribuer. Vous pouvez ajouter plusieurs actions à votre offre, par exemple faire une offre qui ajoute le joueur à un grade puis envoie un message public et lui donne 15 diamants est tout à fait possible.</strong>
				</div>
				<ul class="nav nav-tabs">
					<?php $i = 0;
					while($i < count($categories)) { ?>
					<li <?php if($i == 0) echo 'class="active"'; ?>><a href="#categoriesSwitch<?php echo $categories[$i]['id']; ?>" data-toggle="tab"><?php echo $categories[$i]['titre']; ?></a></li>
					<?php $i++; } ?>
					<div class="text-center">
						<div class="tab-content well">
							<?php $i = 0;
							while($i < count($categories)) { ?>
							<div class="tab-pane<?php if($i == 0) echo ' active'; ?>" id="categoriesSwitch<?php echo $categories[$i]['id']; ?>">
								<form method="POST" action="?&action=boutique">
									<input type="hidden" name="categorie" class="form-control" value="<?php echo $categories[$i]['id']; ?>" />
									<h3>Categories <a href="?action=supprCategorie&id=<?php echo $categories[$i]['id']; ?>" class="btn btn-danger">supprimer la catégorie</a></h3>
									<div class="row">
										<div class="form-group col-lg-6">
											<label>Nom de la catégorie</label>
											<input name="categorieNom" class="form-control" value="<?php echo $categories[$i]['titre']; ?>" />
										</div>
									</div>
									<div class="form-group">
										<label>Informations</label>
										<textarea class="form-control" name="categorieInfo" class="col-sm-12"><?php echo $categories[$i]['message']; ?></textarea>
									</div>
									<h3>Offres</h3>
									<table class="table">
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
										<?php $j = 0;
										while($j < count($offres)) {
											if($offres[$j]['categorie'] == $categories[$i]['id']) {?>
											<tr>
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
												<td><input type="checkbox" name="suppr<?php echo $offres[$j]['id']; ?>" /></td>
												<td><a class="btn btn-success" data-toggle="modal" data-target="#OffreAction<?php echo $offres[$j]['id']; ?>">Modifier</a></td>
												<input type="hidden" name="offresId<?php echo $offres[$j]['id']; ?>" value="<?php echo $offres[$j]['id']; ?>" />
											</tr>
												<?php }
												$j++;
											} ?>
									</table>
									<hr>
									<button class="btn btn-success" type="submit">Valider mes changements</button>
								</form>
							</div>
							<?php $i++; } ?>    
						</div>

						<?php
						$j = 0;
						while($j < count($offres)) {?>

						<div class="modal fade" id="OffreAction<?php echo $offres[$j]['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="gridSystemModalLabel">Commandes <?php echo $offres[$j]['nom']; ?></h4>
									</div>
									<div class="modal-body">
										<center>Utilisez {PLAYER} pour la variable joueur</center>
										<form method="POST" action="?&action=creerAction">
											<div class="col-lg-offset-3 text-center">
												<div class="row">
													<div class="col-lg-8">
														<div class="form-group">
															<label>Methode</label>
															<select class="form-control" name="methode">
																<option value="0">Commande(sans /)</option>
																<option value="1">Message Serveur</option>
																<option value="2">Changer de grade</option>
																<option value="3">Give un item</option>
																<option value="4">Envoyer de l'argent iConomy</option>
																<option value="5">Give d'xp</option>
																<option value="6">Grade Site</option>
															</select>
														</div>
														<div class="form-group">
															<label>Durée <small>Pour les grades uniquement !</small></label>
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
														<div class="form-group">
															<label>Grade Site <small>Pour les grades site uniquement !</small></label>
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
														</div>
														<div class="form-group col-md-12">
															<label>Valeur de l'action / commande</label>
															<input type="text" class="form-control" name="valeur" placeholder="Exemple: pex user {PLAYER} group set chevalier" />
														</div>
														<input type="hidden" name="id_offre" value="<?php echo $offres[$j]['id']; ?>" />
														<hr>
														<div class="form-group col-md-12">
															<input type="submit" class="btn btn-primary" value="Ajouter la commande"/>
														</div>
													</div>
												</div>
											</div>
										</form>

										<?php $k = 0; ?>
										<form class="form-inline" role="form" method="post" action="?&action=editerAction">
											<div class="row">
												<?php while($k < count($actions)) {
													if($actions[$k]['id_offre'] == $offres[$j]['id']) {?>
														<div class="col-md-12">
															<div class="form-group">
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
															<div class="form-group">
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
															<div class="form-group">
																<a href="?action=supprAction&id=<?php echo $actions[$k]['id']; ?>" class="btn btn-danger">Supprimer</a>
															</div>
														</div>
													<?php }
													$k++;
												} ?>
											</div>
											<hr>
											<div class="row">
												<div class="form-group col-md-12">
													<input type="submit" value="Valider les changements" class="btn btn-warning form-control"/>
												</div>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<div class="col-lg-offset-3 text-center">
											<div class="row">
												<div class="col-lg-8">
													<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php $j++;
						} ?>
					</div>
				</ul>
			</div>
		</div>
	</div>
	<?php } ?>
</div>