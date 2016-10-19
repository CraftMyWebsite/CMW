<?php
include('controleur/maintenance.php');

if($maintenance[$i]['maintenanceEtat'] == 0){
setTempMess("<script> $( document ).ready(function() { Snarl.addNotification({ title: '', text: 'La maintenance n\'est pas activée !', icon: '<span class=\'glyphicon glyphicon-cog\'></span>'});});</script>");
header('Location: index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Maintenance <?php echo $_Serveur_['General']['name']; ?></title>
	<script src="/theme/<?php echo $_Serveur_['General']['theme']; ?>/js/bootstrap.min.js"></script>
	<script src="/theme/<?php echo $_Serveur_['General']['theme']; ?>/js/jquery-1.10.2.min.js"></script>
	<script src="/theme/<?php echo $_Serveur_['General']['theme']; ?>/js/transition.js"></script>
	<script src="/theme/<?php echo $_Serveur_['General']['theme']; ?>/js/modal.js"></script>
	<link href="/theme/<?php echo $_Serveur_['General']['theme']; ?>/css/<?php echo $_Serveur_['General']['themeOption']; ?>.css" rel="stylesheet" type="text/css">
	<link href="/theme/<?php echo $_Serveur_['General']['theme']; ?>/css/style.css" rel="stylesheet" type="text/css">
	<link href="/theme/<?php echo $_Serveur_['General']['theme']; ?>/css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
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
</head>
<body style="<?php echo $bgType; ?>background-size: cover;">
	<center style="margin-top: -40px;margin-bottom: -40px;">
		<img class="spin-maintenance" src="/theme/<?php echo $_Serveur_['General']['theme']; ?>/img/engrenage.png">
		<img class="spin-maintenance-inverted" src="/theme/<?php echo $_Serveur_['General']['theme']; ?>/img/engrenage.png" style="margin-top: 142px;margin-left: -45px;">
	</center>
	<div class="panel panel-primary" style="margin: 0 auto;max-width: 700px;margin-top: 80px;border-radius: 0px;">
		<div class="panel-heading" style="border-radius: 0px;">
			<h2 class="panel-title" style="font-family: Minecraftia;text-align: center;font-size: 23px;"></span> <?php echo $_Serveur_['General']['name']; ?> est en maintenance</span></h2>
		</div>
		<div class="panel-body" style="text-align: center;font-family: Minecraftia;">
			<?php echo $maintenance[$i]['maintenanceMsg']; ?>
		</div>
		<div class="panel-footer" style="font-family: Minecraftia;"><?php echo $donnees['maintenanceMsgAdmin']; ?> <a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-primary btn-block" style="margin-top: 10px;border-radius: 0px;"><span class="glyphicon glyphicon-user"></span> Connexion administrateur</a></div>
	</div>
	<div class="modal fade" id="ConnectionSlide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div class="row">
						<h4 style="text-align: center;font-family: Minecraftia;font-weight: bold;">Seul les administrateurs peuvent se connecter pour administrer le site !</h4>
						<form class="form-signin" role="form" method="post" action="?&action=connection">
							<input type="text" name="pseudo" class="form-control" id="PseudoConectionForm" placeholder="Pseudo" required autofocus>
							<input type="password" name="mdp" class="form-control" id="MdpConnectionForm" placeholder="Votre mot de passe" required>
							<button class="btn btn-lg btn-primary btn-block" type="submit"> Connexion</button>
						</form>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Je ne suis pas administrateur</button>	
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-primary" style="margin: 0 auto;max-width: 700px;margin-top: 80px;border-radius: 0px;">
		<div class="panel-body">
		<div class="footer-copyright" style="font-family: Minecraftia;font-weight: 200;text-align: center;font-size: 12px;">
				<?php include "include/version.php"; ?>
				Tous droits réservés, site créé pour le serveur <?php echo $_Serveur_['General']['name']; ?> avec <a href="http://craftmywebsite.fr">CraftMyWebsite.fr</a><br/>
			</div>
		</div>
	</div>
</body>
</html>