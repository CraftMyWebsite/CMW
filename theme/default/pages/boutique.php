<div class="container" style="background-color: white;margin-top: -20px;margin-bottom: -20px;border-left: 4px solid #e74c3c;border-right: 4px solid #e74c3c;">
<h1 class="titre"><center>Boutique</center></h1>	
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><h4 style="color: white;"><center>Comment ça marche?</center></h4></h3>
  </div>
  <div class="panel-body">
    <p><center><strong>
		La boutique permet d'acheter du contenu In-Game depuis le site grâce à de l'argent réel, cela sert à payer l'hébergement du serveur.
		La monnaie virtuelle utilisée sur la boutique est le "Jeton", vous pouvez obtenir des jetons en échange de dons <a href="?&page=token" style="color: blue;">sur cette page</a>
	</strong></center></p>
	</br>
	<?php if(isset($_Joueur_)) { ?>
	<center>
	<hr>
		<font style="font-family: minecraftia;font-size: 20px;">Bonjour <?php echo $_Joueur_['pseudo']; ?></font>
			<h4>Vous avez <strong><?php if(isset($_Joueur_['tokens'])) echo $_Joueur_['tokens'] . ' <img style="width: 25px;" src="./theme/default/img/jeton.png" />'; ?></h4></strong>
	</center>
	<?php } else { ?>
	<hr>
	<center>
	<h4>Veuillez vous connecter pour accéder à la boutique:</h4>
	<a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning btn-lg" ><span class="glyphicon glyphicon-user"></span> Connexion</a>
	</center>
	<?php } ?>
  </div>
</div>
</br>
	</br>
	<h3><center>Choisissez votre catégorie :</center></h3>
			<div class="tabbable">
						<ul class="nav nav-tabs">
						<?php
						$j = 0;
						while($j < count($categories))
						{
						$categories[$j]['titre'] = str_replace(' ', '_', $categories[$j]['titre']);
						?>
							  
								<li><a href="#categorie-<?php echo $categories[$j]['titre']; ?>" data-toggle="tab"><h4 style="color: black;"><center><strong><?php $categories[$j]['titre'] = str_replace('_', ' ', $categories[$j]['titre']); ?><?php echo $categories[$j]['titre']; ?></strong></center></h4></a></li>
							  
								
						<?php $j++; } ?>
						</ul>
						<div class="tab-content">
						<?php
						$j = 0;
						while($j < count($categories))
						{
						$categories[$j]['titre'] = str_replace(' ', '_', $categories[$j]['titre']);
						?>
						
						<div id="categorie-<?php echo $categories[$j]['titre']; ?>" class="tab-pane">
						<?php $categories[$j]['titre'] = str_replace('_', ' ', $categories[$j]['titre']); ?>
								<div class="panel-body">
									<?php if($categories[$j]['message'] == ""){ ?>
									<?php } else { ?>
									<p>
									<div class="alert alert-dismissable alert-success">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<center><?php echo $categories[$j]['message']; ?></center>
									</div>
									</p>
									<?php } ?>
									<div class="row">
									<?php
										for($i = 1; $i <= count($offresTableau); $i++)
										{
											if($offresTableau[$i]['categorie'] == $categories[$j]['id'])
											{
												echo '
												<div class="col-md-4 panel panel-default" style="margin-left: 10px;width: 30%;">
													<div class="panel-body">
															<h3 class="titre-offre"><center>'. $offresTableau[$i]['nom'] .'</center></h3>
															<div class="offre-description">' .$offresTableau[$i]['description']. '</div>
														</div>
														';
															if(isset($_Joueur_)) {echo '<a href="?&page=boutique&offre=' .$offresTableau[$i]['id']. '" class="btn btn-primary btn-block">Acheter !</a>';}
															else { echo'<a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning btn-block" ><span class="glyphicon glyphicon-user"></span> Se connecter</a>'; }
												echo '
															<button class="btn btn-success btn-block">Prix : ' .$offresTableau[$i]['prix']. ' <img style="width: 25 px;" src="./theme/default/img/jeton.png" /></button>
															</br>
														
												</div>		';
											}
										}
									?>
									</div>
								</div>
							</div>
						<?php $j++; } ?>	
						</div>
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
			<p>
				<em>"<?php echo $infosOffre['offre']['description']; ?>"</em><br />
				Vous obtiendrez ce grade sur <?php echo $infosCategories['serveur']; ?>.<br />
				<?php
				$enLigne = false;
				if($infosCategories['serveurId'] == -2 OR $infosCategories['serveurId'] == -1)
					for($i = 0; $i < count($lecture['Json']); $i++)
					{
						if($enligne[$i])
						{
							echo 'Vous êtes connecté sur le serveur:<br /> "'. $lecture['Json'][$i]['nom'] .'"';
							$enLigne = true;
						}
						
					}
				else
					if($enligne[$infosCategories['serveurId']])
					{
						echo 'Vous êtes connecté sur le serveur:<br /> "'. $lecture['Json'][$infosCategories['serveurId']]['nom'] .'"';
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
				if(isset($infosOffre['action']))
					for($i = 0; $i < count($infosOffre['action']); $i++)
					{
						?>
						<strong><?php echo $infosOffre['action'][$i]['methode'] . $infosOffre['action'][$i]['commande_valeur']; ?></strong><br />
						<?php
					}
				else
					echo 'Cette offre est un don sans contrepartie...';
				?>
				</blockquote>
			</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
		<?php 	if($_Joueur_['tokens'] >= $infosOffre['offre']['prix'])
					if(($enLigne AND $infosCategories['connection']) OR !$infosCategories['connection']) { ?>
				        <a href="?&action=achat&offre=<?php echo $_GET['offre']; ?>" class="btn btn-success">Acheter</a><?php } else{ ?>
						Connectez vous sur le serveur voulu... <?php } 
				else
					echo '<button class="btn btn-primary">Il vous manque '. ($infosOffre['offre']['prix'] - $_Joueur_['tokens']) .' jetons...</button>';
				?>
      </div>
    </div>
  </div>
</div>
<?php

$modal = true;
$idModal = 'myModal';

}
?>
</div>