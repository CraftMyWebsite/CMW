<div class="container" style="background-color: white;margin-top: -20px;margin-bottom: -20px;border-left: 4px solid #e74c3c;border-right: 4px solid #e74c3c;">
<h1 class="titre"><center>Achat de Jetons</center></h1>

<?php if(isset($_GET['success']) AND $_GET['success'] == 'true'){ ?>
	<div class="alert alert-success">Votre code a bien été validé, vous avez été crédité de <?php echo $_Serveur_['Payement']['starpassJetons']; ?> Jetons ! </div>
<?php } elseif(isset($_GET['success']) AND $_GET['success'] == 'false'){ ?>
	<div class="alert alert-danger">Le code entré est incorrect, vous n'avez pas été crédité...</div>
<?php } ?>
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><h3 style="color: white;">Payement par PayPal</h3></h3>
  </div>
  <div class="panel-body">
    <div class="alert alert-success">Deux possibilités s'offrent à vous pour les dons, vous pouvez payer par PayPal, soit avec votre compte PayPal soit avec votre Carte Bleu de manière sécurisée depuis le site PayPal (le payement ne s'effectue donc pas sur notre serveur/site). L'avantage de PayPal est que le joueur reçoit plus de Jetons qu'avec un payement téléphonique (qui sont surtaxés).</div>
							<?php 
							require_once('controleur/tokens/paypal.php'); 
							?>
							<div class="row">
							<?php
							if(isset($offresTableau))
								for($i = 0; $i < count($offresTableau); $i++)
								{
									echo '
									<div class="col-md-4 offre-boutique">
										<div class="well offre-contenu">
											<div class="contenuBoutique">
												<h3 class="titre-offre">'. $offresTableau[$i]['nom'] .'</h3>
												' .$offresTableau[$i]['description']. '
											</div>
											<div class="footer-offre"> ';
												if(isset($_Joueur_)) {
													if($lienPaypal[$i] == 'viaMail')
														require('controleur/paypal/paypalMail.php');
													else
														echo '<a href="'. $lienPaypal[$i] .'" class="btn btn-primary">Acheter !</a>';
												}
												else { echo'<a href="?&page=connection" class="btn btn-danger">Connexion..</a>'; }
									echo '
												<button class="btn btn-info pull-right">' .$offresTableau[$i]['prix']. ' euro</button>
											</div>
										</div>
									</div>		';
								}
							else
								echo '<div style="margin-left: 15px;margin-right: 15px;" class="alert alert-danger"><strong>Aucune offre de payement par paypal n\'est disponible pour le moment...</strong></div>';
							?>
							</div>
  </div>
</div>
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><h3 style="color: white;">Payement par Starpass</h3></h3>
  </div>
  <div class="panel-body">
					<div class="alert alert-success">Vous pouvez payer par Starpass, vous paierez ainsi avec votre forfait téléphonique, c'est donc un avantage important. D'un autre côté, vous serez déversé de moins de tokens qu'avec un payement paypal (qui sont beaucoup moins taxés).</div>
							<h4>1 Code = <?php echo $_Serveur_['Payement']['starpassJetons']; ?> Jetons ! </h4>
					   <div id="starpass_<?php echo $_Serveur_['Payement']['starpassIDD']; ?>"></div><script type="text/javascript" src="http://script.starpass.fr/script.php?idd=<?php echo $_Serveur_['Payement']['starpassIDD']; ?>&amp;verif_en_php=1&amp;datas="></script><noscript>Veuillez activer le Javascript de votre navigateur s'il vous pla&icirc;t.<br /><a href="http://www.starpass.fr/">Micro Paiement StarPass</a></noscript>				   
</div>
</div>
</div>