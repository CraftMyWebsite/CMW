<header class="heading-pagination">
	<div class="container-fluid">
		<h1 class="text-uppercase wow fadeInRight" style="color:white;">Boutique</h1>
	</div>
</header>
<section class="layout" id="page">
<div class="container">
	<div class="text-center">
		<h4 class="text-primary"><i class="fa fa-shopping-cart"></i> Boutique</h4>
		<h5 class="text-center">Comment ça marche?</h5>
		<p class="text-center"><strong>
			La boutique permet d'acheter du contenu In-Game depuis le site grâce à de l'argent réel, cela sert à payer l'hébergement du serveur.
			La monnaie virtuelle utilisée sur la boutique est le "Jeton", vous pouvez obtenir des jetons en échange de dons <a href="?&page=token" style="color: blue;">sur cette page</a>
		</strong></p>
		<br>
		<hr>
		<center>
		<?php if(Permission::getInstance()->verifPerm("connect")) { ?>
			<font style="font-family: minecraftia;font-size: 20px;">Bonjour <?php echo $_Joueur_['pseudo']; ?></font>
				<h4>Vous avez <strong><?php if(isset($_Joueur_['tokens'])) echo $_Joueur_['tokens'] . ' <i class="fas fa-gem"></i>'; ?></strong></h4>
				<a href="?page=panier" class="btn btn-primary btn-block">Votre panier contient <?php echo $_Panier_->compterArticle().($_Panier_->compterArticle()>1 ? ' articles' : ' article') ?> </a>
		<?php } else { ?>
		<h4>Veuillez vous connecter pour accéder à la boutique:</h4>
		<a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning btn-lg" ><span class="glyphicon glyphicon-user"></span> Connexion</a>
		<?php } ?>
		</center>
	</div>
	<br>
	<br>
	
	
	<h3 class="text-center">Choisissez votre catégorie :</h3>
		<div class="tabbable">
			<?php if(isset($categories)) { ?>
		
			<ul class="nav nav-tabs" style="margin-bottom:5vh;">
			<?php for($j = 0; $j < count($categories); $j++){ ?>
				<li class="nav-item">
					<a href="#categorie-<?=$j?>" data-toggle="tab" class="nav-link <?php if($j == 0) { echo 'active'; }?>"><?=$categories[$j]['titre']; ?></a>
				</li>
			 <?php } ?>
			</ul>
			<div class="tab-content">
			<?php for($j = 0; $j < count($categories); $j++){?>
				<div id="categorie-<?=$j?>" class="tab-pane fade <?php if($j==0) echo 'in active show';?>" <?= ($j == 0) ? 'aria-expanded="true"' :'aria-expanded="false"'?>>
					<div class="panel-body">
					<?php if(!empty($categories[$j]['message'])){ ?>
						<div class="alert alert-dismissable alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<center><?php echo espacement($categories[$j]['message']); ?></center>
						</div>
					<?php } ?>
					
						<div class="row">
								<?php
									foreach($categories as $key => $value)
									{
										$categories[$key]['offres'] = 0;
									}
									for($i = 1; $i <= count($offresTableau); $i++)
									{
										if($offresTableau[$i]['categorie'] == $categories[$j]['id'])
										{
											echo '
											<div class="col-md-4 panel panel-default">
												<div class="panel-body">
													<h3 class="titre-offre"><center>'. (($offresTableau[$i]['nbre_vente'] == 0) ? "<s>".$offresTableau[$i]['nom']."</s>" : $offresTableau[$i]['nom']);
													if($offresTableau[$i]['nbre_vente'] > -1) {
														echo "<br><span style='font-size: 9pt;'>";
														if($offresTableau[$i]['nbre_vente'] == 0) {
															echo "vide";
														} else {
															echo 'Reste: '. $offresTableau[$i]['nbre_vente'];
														}
														echo "</span>";
													}
													echo'</center></h3>
														<div class="offre-description">' .espacement($offresTableau[$i]['description']). '</div>
													</div>
													';
														if(Permission::getInstance()->verifPerm("connect")) {
															echo '<a href="?page=boutique&offre=' .$offresTableau[$i]['id']. '" class="btn btn-primary btn-block" title="Voir la fiche produit"><i class="fa fa-eye"></i></a>';
															if($offresTableau[$i]['nbre_vente'] == 0){
																echo '<a href="#" class="btn btn-info btn-block">Rupture de stock</a>';
															} else {
																echo '<a href="?action=addOffrePanier&offre='. $offresTableau[$i]['id']. '&quantite=1" class="btn btn-info btn-block" title="Ajouter directement au panier une unité"><i class="fa fa-cart-arrow-down"></i></a>';
															}
														} else { 
															echo'<a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning btn-block" ><span class="fas fa-user"></span> Se connecter</a>';
														}
														echo '<button class="btn btn-success btn-block">Prix : ' . ($offresTableau[$i]['prix'] == '0' ? 'gratuit' : $offresTableau[$i]['prix'].'<i class="fas fa-gem"></i>') . ' </button>
													
											</div>		';
											$categories[$j]['offres']++;
										}
									}
								?>
						</div>
					
					<?php if($categories[$j]['offres'] == 0) {?>
						<div class="alert alert-dismissible alert-danger">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<center><strong>Oh zut !</strong> <?=$categories[$j]['titre']?> est encore vide, ré-essayez plus tard !.</center>
						</div>
					<?php }?>
					</div>
				</div>
			<?php }?>	
				
			</div>
			<?php } else {?>
				<div class="alert alert-dismissible alert-danger">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<center><strong>Oh zut !</strong> il n'y a pas de catégorie, ré-essayez plus tard !.</center>
				</div>
			<?php }?>	
		</div>	
		
	<?php
	if(isset($_GET['offre']))
	{
	?>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header"  style="background-color: #0c84e4;">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel" style="color: white;">Achat de: <?php echo $infosOffre['offre']['nom']; ?></h4>
		  </div>
		  <div class="modal-body">
					<br />
					Vous obtiendrez ce grade sur <?php echo $infosCategories['serveur']; ?>.<br />
					<?php
					$enLigne = false;
					if($infosCategories['serveurId'] == -2 OR $infosCategories['serveurId'] == -1)
						foreach($lectureJSON as $serveur)
						{
							if($enligne[$i])
							{
								echo 'Vous êtes connecté sur le serveur:<br /> "'. $serveur['nom'] .'"';
								$enLigne = true;
							}
							
						}
					else
						if($enligne[$infosCategories['serveurId']])
						{
							$cle = array_search($infosCategories['serveurId'], array_column($lectureJSON, 'id'));
							echo 'Vous êtes connecté sur le serveur:<br /> "'. $lectureJSON[$cle]['nom'] .'"';
							$enLigne = true;
						}
						
					if(!$enLigne AND $infosCategories['connection'])
						echo 'Vous n\'êtes pas connecté sur le serveur !';
					?>
					<br />
					<br />
					Cette offre contiens: <br />
					<blockquote>
					<?php
					if(isset($infosOffre['offre']['description']))
						echo espacement($infosOffre['offre']['description']);
					else
						echo 'Cette offre est un don sans contrepartie...';
					?>
					</blockquote>
		  </div>
		  <div class="modal-footer">
			<?php 	if((($enLigne AND $infosCategories['connection']) OR !$infosCategories['connection']) AND $infosOffre['offre']['nbre_vente'] > 0)  { ?>
							<form action="index.php" method="GET" class="form-inline">
								<input type="hidden" name="action" value="addOffrePanier"/>
								<input type="hidden" name="offre" value="<?php echo $_GET['offre']; ?>"/>
								<label for="quantite" class="form-control mb-1 mr-sm-1">Quantité: </label>
								<input type="number" class="form-control mb-1 mr-sm-1" id="quantite" name="quantite" min="0" value="1" />
								<button type="submit" class="btn btn-success mb-2">Ajouter au panier</button>
							</form><?php }
							elseif($infosOffre['offre']['nbre_vente'] == 0)
								echo '<div class="row" style="width: 100%;"><div class="col-md-12" style="text-align: center;"><a class="btn btn-info" href="#">Rupture de stock !</a></div></div>';
							 else{ ?>
							Connectez vous sur le serveur voulu... <?php } 
					?>
		  </div><button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
		</div>
	  </div>
	</div>
	<?php

	$modal = true;
	$idModal = 'myModal';

	}
	?>
</div>
</section>
