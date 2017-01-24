<?php
// On inclut le fichier de contrôle de la maintenance
include('controleur/maintenance.php');
// Si la maintenance est activé
if($maintenance[$i]['maintenanceEtat'] == 1){
	// On vérifie si le joueur est connecté
	if(!(isset($_Joueur_))){
		header('Location: index.php?&redirection=maintenance');
	} elseif($_Joueur_['rang'] == 1) { // On vérifie si il est admin
		if( $maintenance[$i]['maintenancePref'] == 0 ){ // Si la pref vaut 0 les admins ont accès au site avec l'entête en plus
		include('theme/' .$_Serveur_['General']['theme']. '/maintenance/entete.php');
		} elseif ( $maintenance[$i]['maintenancePref'] == 1 ) { // Si la maintenance vaut 1 les admins n'ont pas accès au site mais ils sont redirigés vers le panel admin
		header('Location: admin.php');
	}
		else { // Si le joueur n'est pas admin il est redirigé vers la page de maintenance
		header('Location: index.php?&redirection=maintenance');
	}
	} else { // Si le joueur n'est pas connecté il est redirigé vers la page de maintenance
	header('Location: index.php?&redirection=maintenance');
}
}
if(isset($_Joueur_))
{
	require('modele/forum/joueurforum.class.php');
	$_JoueurForum_ = new JoueurForum($_Joueur_['pseudo'], $_Joueur_['id'], $bddConnection);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="autor" content="CraftMyWebsite , TheTueurCiTy, <?php echo $_Serveur_['General']['name']; ?>" />
	<link href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
	<link href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/<?php echo $_Serveur_['General']['themeOption']; ?>.css" rel="stylesheet" type="text/css">
	<link href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/style.css" rel="stylesheet" type="text/css">
	<link href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/main.css" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/toastr.css">
	<link rel="stylesheet" href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/snarl.css">
	<link rel="stylesheet" href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/snarl.min.css">
	<script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
	<link href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/style-<?php echo $_Serveur_['General']['themeOption']; ?>.css" rel="stylesheet" type="text/css">
	<script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/snarl.js"></script>
	<script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/snarl.min.js"></script>
	<script src="//api.dedipass.com/v1/pay.js"></script>
	<?php
	if(isset($_GET['page'])) {
		if($_GET['page'] == 'banlist') {
			$namePage = '&page=banlist';
		} elseif($_GET['page'] == 'boutique') {
			$namePage = '&page=boutique';
		} elseif($_GET['page'] == 'support') {
			$namePage = '&page=support';
		} elseif($_GET['page'] == 'voter') {
			$namePage = '&page=voter';
		} elseif($_GET['page'] == 'profil') {
			$namePage = '&page=profil&profil=';
		} else {
			$namePage = '';
		}
	} else {
		$namePage = '';
	}

	include('controleur/notifications.php');
	
	?>
	<title><?php echo $_Serveur_['General']['description'] ?></title>
</head>

<body>
	<?php if(isset($_Joueur_)) { ?>
		<?php setcookie('pseudo', $_Joueur_['pseudo'], time() + 86400, null, null, false, true); ?>	
		<?php } else { ?>
			<?php } ?>
			<?php 
			include('theme/' .$_Serveur_['General']['theme']. '/entete.php');
			?>
			<?php tempMess(); ?>
		</br>
		<?php
		$check_installation_dossier = "installation";
		if (is_dir($check_installation_dossier)) { ?>
			<div class="container" style="background-color: white;margin-top: -20px;margin-bottom: -20px;border-left: 4px solid #e74c3c;border-right: 4px solid #e74c3c;">
			</br>
			<div class="alert alert-danger">
				<center><strong>Erreur :</strong> Vous devez absolument effacer le dossier "installation" à la racine de votre site pour commencer à utiliser votre site.</br>
					Rafraichissez la page ou appuyez sur le bouton si dessous pour vérifier.
				</center>
			</div>
			<center><a href="index.php" class="btn btn-warning btn-lg btn-block">Refaire une vérification</a></center>
		</br>
	</br>
</div>
<?php } else { include('controleur/page.php'); } ?>	
<?php include('theme/' .$_Serveur_['General']['theme']. '/pied.php'); ?>
<script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/jquery.js"></script>
<script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/bootstrap.min.js"></script>

<!-- Les formulaires pop-up -->
<?php include('theme/' .$_Serveur_['General']['theme']. '/formulaires.php'); ?>

<?php
if(isset($modal))
{
	?>
	<script>  	$('#myModal').modal('toggle') 	</script>	
	<?php
}
?>
<script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/gotop.js"></script>
<script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/toastr.min.js"></script>
</div>
</body>
