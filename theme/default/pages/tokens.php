<div class="container" style="background-color: white;margin-top: -20px;margin-bottom: -20px;border-left: 4px solid #e74c3c;border-right: 4px solid #e74c3c;">
	<h1 class="titre"><center>Achat de Jetons</center></h1>

	<?php if(isset($_GET['success']) AND $_GET['success'] == 'true'){ ?>
	<div class="alert alert-success">Votre code a bien été validé, vous avez été crédité de <?php echo $_GET['tokens']; ?>  Jetons ! </div>
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
				<h3 class="panel-title text-center"><h3 style="color: white;">Paiement par AlloConv</br>
				1 Code = <?php echo $microTokens['tokens']; ?> Jetons ! </h3></h3>
			</div>
			<div class="panel-body">
				<div class="alert alert-success">Vous pouvez payer par AlloConv, vous paierez ainsi avec votre forfait téléphonique, c'est donc un avantage important. D'un autre côté, vous serez déversé de moins de tokens qu'avec un payement paypal (qui sont beaucoup moins taxés).</div>
				<?php 
				if($microTokens['enabled'] == true) {
					if($alloconv['statut'] == 'true') {
						echo 
						'
						<form id="checkCode" action="?&action=alloconv" method="POST">
						    <div class="row">
						        <div class="panel-body">
						            <ul>
						                <li style="text-align: center;">
						                    <div class="text-center"><h3>Paiement par '.$type[$alloconv['type_solution']].'</h3></div>';
						                    if(urldecode($_GET['transactionStatus']) == 'false')
						                    	echo '<div class="alert alert-error">Le/Les code(s) est invalide(s).</div>';
						                    elseif(urldecode($_GET['transactionStatus']) == 'true')
						                    	echo '<div class="alert alert-success">Vous avez acheté '.$microTokens['tokens'].' Jetons avec succès !</div>';
						                    echo '
						                    <strong>Appeler le numéro : </strong><B>'.$alloconv['numero_surtaxe'].'</B></br><small><strong>('.$alloconv['prix'].')</strong></small>
						                    </li>
						                    <li style="text-align: center;"><B>CODE :</B> <input class="form-control text-center" type="text" name="code" placeholder="XXXXXXXX" required maxlength="8" />
						                    </li>
						                    <li style="text-align: center;"><center><button id="validateCode" type="submit" class="btn btn-success">Valider le code !</button></center>
						                    </li>
						            </ul>
						        </div>
						    </div>
						</form>
						';
					} else {
					    	echo '<p><center><strong>Un problème est survenu, veuillez contacter un membre de l\'équipe.</br>Erreur: '.$alloconv['description_error'].'</strong></center></p>';
					}
				} else { 
						echo '<p><center><strong>Le paiement par AlloConv est désactivé.</strong></center></p>';
				} ?>
			</div>
		</div>
	</div>