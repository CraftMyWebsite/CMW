<style>
	.form-signin
	{
		max-width: 330px;
		padding: 15px;
		margin: 0 auto;
	}
	.form-signin .form-signin-heading, .form-signin .checkbox
	{
		margin-bottom: 10px;
	}
	.form-signin .checkbox
	{
		font-weight: normal;
	}
	.form-signin .form-control
	{
		position: relative;
		font-size: 16px;
		height: auto;
		padding: 10px;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
	}
	.form-signin .form-control:focus
	{
		z-index: 2;
	}
	.form-signin input[type="text"]
	{
		margin-bottom: -1px;
		border-bottom-left-radius: 0;
		border-bottom-right-radius: 0;
	}
	.form-signin input[type="password"]
	{
		margin-bottom: 10px;
		border-top-left-radius: 0;
		border-top-right-radius: 0;
	}
	.account-wall
	{
		margin-top: 20px;
		padding: 40px 0px 20px 0px;
		background-color: #f7f7f7;
		-moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		-webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	}
	.login-title
	{
		color: #555;
		font-size: 18px;
		font-weight: 400;
		display: block;
	}
	.profile-img
	{
		width: 128px;
		height: 128px;
		margin: 0 auto 10px;
		display: block;
		-moz-border-radius: 50%;
		-webkit-border-radius: 50%;
		border-radius: 20%;
	}
	.need-help
	{
		margin-top: 10px;
	}
	.new-account
	{
		display: block;
		margin-top: 10px;
	}
</style>
<div class="modal fade" id="ConnectionSlide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #0c84e4;">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel" style="color: white;"><center>Connexion</center></h4>
			</div>
			<div class="modal-body">
				<?php $req_apiMail = $bddConnection->prepare('SELECT * FROM cmw_sysmail WHERE id = 1');
				$req_apiMail->execute();
				$apiMail = $req_apiMail->rowCount();
				if($apiMail == 1) { ?>
					<p><div class="alert alert-warning" style="text-align: center;">Un problème de connexion/inscription ? Mail d'inscription pas reçu ? Envoyer à cette adresse email votre problème :<B><center>Indisponible</center></B></div></p>
					<?php } ?>
					<div class="row">
						<img class="profile-img" src="http://api.craftmywebsite.fr/skin/face.php?u=<?php echo $_COOKIE['pseudo']; ?>&s=128&v=front" alt="">
						<form class="form-signin" role="form" method="post" action="?&action=connection">
							<input type="text" name="pseudo" class="form-control" id="PseudoConectionForm" placeholder="Pseudo" required autofocus>
							<input type="password" name="mdp" class="form-control" id="MdpConnectionForm" placeholder="Votre mot de passe" required>
							<button class="btn btn-lg btn-primary btn-block" type="submit"> Connexion</button>
						</form>
						<center><a data-target="#passRecover" data-toggle="modal">Mot de passe oublié ?</a></center>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>	
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade" id="passRecover" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div class="row">
						<p style="text-align: center;font-weight: bold;">Merci d'indiquer votre email utilisé à l'inscription , vous recevrez un lien pour réinitialiser votre mot de passe.</p>
						<form class="form-signin" role="form" method="post" action="?&action=passRecover" style="max-width: none;">
							<div class="col-md-8"><input type="email" name="email" class="form-control" id="EmailRecoverForm" placeholder="Email" required autofocus></div>
							<div class="col-md-4"><button class="btn btn-lg btn-primary btn-block" type="submit"> Envoyer</button></div>
						</form>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>	
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>

	<section class="inscription-pop">
		<div class="modal fade" id="InscriptionSlide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="background-color: #0c84e4;">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel" style="color: white;" ><center>Inscription</center></h4>
					</div>
					<div class="modal-body">
						<form role="form" method="post" action="?&action=inscription">
							<?php if($apiMail == 1) { ?>
								<center><p><div class="alert alert-warning" style="text-align: center;">Veuillez mettre une adresse email correct, car une demande de confirmation du compte sera demandé ! Vérifier dans les spams/courriers indésirables.</div></p></center>
								<?php } ?>
								<div class="form-group">
									<label for="PseudoInscriptionForm">Pseudo</label>
									<input type="text" name="pseudo" class="form-control" id="PseudoInscriptionForm" placeholder="Votre pseudo exact In-Game">
								</div>
								<div class="form-group">
									<label for="EmailInscriptionForm">Email</label>
									<input type="email" name="email" class="form-control" id="EmailInscriptionForm" placeholder="Merci d'entrer une adresse email valide">
								</div>
								<div class="form-group">
									<label for="MdpInscriptionForm">Mot de passe</label>
									<input type="password" name="mdp" class="form-control" id="MdpInscriptionForm" placeholder="Votre mot de passe">
								</div>
								<div class="form-group">
									<label for="MdpConfirmInscriptionForm">Mot de passe</label>
									<input type="password" name="mdpConfirm" class="form-control" id="MdpConfirmInscriptionForm" placeholder="Confirmez-le">
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="souvenir" checked> S'inscrire à la newsletter.
									</label>
								</div>
								<div class="row" style="margin-left: -10px;">
									<div class="col-md-6">
										<label>Captcha:</label>
										<input type='text' name='CAPTCHA' placeholder='captcha' class="form-control"/>
									</div>
									<div class="col-md-6">
										<img id='captcha' src='include/purecaptcha/purecaptcha_img.php?t=login_form' style="width: 100%;height: 100px;"/>
										<br/>
									</br>
									<button type='button' onclick='var t=document.getElementById("captcha"); t.src=t.src+"&amp;"+Math.random();' class="btn btn-success btn-block"><span class="glyphicon glyphicon-refresh spin"></span> Recharger le captcha</button>
									<br/>
								</div>
							</div>
						</br>
						<button type="submit" class="btn btn-success btn-block"><strong>S'inscrire !</strong></button>
					</form>	
				</div>
				<div class="modal-footer">

					<button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>

				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</section>
