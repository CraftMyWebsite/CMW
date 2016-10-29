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
	<script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/snarl.min.js"></script>	<script src="//api.dedipass.com/v1/pay.js"></script>
	<?php
	if(isset($_GET['page']))
	{
		if($_GET['page'] == 'boutique')
			echo '<link href="theme/' .$_Serveur_['General']['theme']. '/css/boutique.css" rel="stylesheet" type="text/css">';
		if($_GET['page'] == 'token')
			echo '<link href="theme/' .$_Serveur_['General']['theme']. '/css/tokens.css" rel="stylesheet" type="text/css">';
		if($_GET['page'] == 'admin')
			echo '<link href="theme/' .$_Serveur_['General']['theme']. '/css/admin.css" rel="stylesheet" type="text/css">';
		if($_GET['page'] == 'voter')
			echo '<link href="theme/' .$_Serveur_['General']['theme']. '/css/voter.css" rel="stylesheet" type="text/css">';
		if($_GET['page'] == 'profil')
			echo '<link href="theme/' .$_Serveur_['General']['theme']. '/css/profil.css" rel="stylesheet" type="text/css">';
		if($_GET['page'] == 'support')
			echo '<link href="theme/' .$_Serveur_['General']['theme']. '/css/support.css" rel="stylesheet" type="text/css">';
	}
	?>
	<title><?php echo $_Serveur_['General']['description'] ?></title>

	<?php if(urldecode($_GET['ActivateSuccess'])){ ?>
		<script>
			function ActivateSuccess() {
				Snarl.addNotification({
					title: 'Succès',
					text: 'Votre compte vient d\'être activé avec succès.',
					icon: '<i class="fa fa-check-circle" aria-hidden="true"></i>'
				});
			}
			window.onload=ActivateSuccess;
			window.setTimeout("location=('index.php');",8000);
		</script>
		<?php } elseif(urldecode($_GET['WaitActivate'])) { ?>
			<script>
				function WaitActivate() {
					Snarl.addNotification({
						title: 'Info',
						text: 'Un mail vient de vous être envoyé pour l\'activation de votre compte. Vérifiez dans les Courriers indésirables.',
						icon: '<i class="fa fa-info-circle" aria-hidden="true"></i>'
					});
				}
				window.onload=WaitActivate;
				window.setTimeout("location=('index.php');",8000);
			</script>
			<?php } elseif(urldecode($_GET['ActivateImpossible'])) { ?>
				<script>
					function ActivateImpossible() {
						Snarl.addNotification({
							title: 'Erreur',
							text: 'Votre compte ne peut être activé.',
							icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
						});
					}
					window.onload=ActivateImpossible;
					window.setTimeout("location=('index.php');",8000);
				</script>
				<?php } elseif(urldecode($_GET['MessageEnvoyer'])) { ?>
					<script>
						function MessageEnvoyer() {
							Snarl.addNotification({
								title: 'Succès',
								text: 'Votre commentaire vient d\'être envoyé.',
								icon: '<i class="fa fa-comment" aria-hidden="true"></i>'
							});
						}
						window.onload=MessageEnvoyer;
					</script>
					<?php } elseif(urldecode($_GET['MessageTropLong'])) { ?>
						<script>
							function MessageTropLong() {
								Snarl.addNotification({
									title: 'Erreur',
									text: 'Votre commentaire est trop long.',
									icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
								});
							}
							window.onload=MessageTropLong;
						</script>
						<?php } elseif(urldecode($_GET['MessageTropCourt'])) { ?>
							<script>
								function MessageTropCourt() {
									Snarl.addNotification({
										title: 'Erreur',
										text: 'Votre commentaire est trop court.',
										icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
									});
								}
								window.onload=MessageTropCourt;
							</script>
							<?php } elseif(urldecode($_GET['NotOnline'])) { ?>
								<script>
									function NotOnline() {
										Snarl.addNotification({
											title: 'Erreur',
											text: 'Vous n\'êtes pas connecté.',
											icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
										});
									}
									window.onload=NotOnline;
								</script> 
								<?php } elseif(urldecode($_GET['NewsNotExist'])) { ?>
									<script>
										function NewsNotExist() {
											Snarl.addNotification({
												title: 'Erreur',
												text: 'Cette nouveauté n\'existe pas.',
												icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
											});
										}
										window.onload=NewsNotExist;
									</script> 
									<?php } elseif(urldecode($_GET['LikeExist'])) { ?>
										<script>
											function LikeExist() {
												Snarl.addNotification({
													title: 'Erreur',
													text: 'Votre mention j\'aime est déjà existante.',
													icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
												});
											}
											window.onload=LikeExist;
										</script> 
										<?php } elseif(urldecode($_GET['LikeAdd'])) { ?>
											<script>
												function LikeAdd() {
													Snarl.addNotification({
														title: 'Succès',
														text: 'Votre mention j\'aime vient d\'être envoyée.',
														icon: '<i class="fa fa-check-circle" aria-hidden="true"></i>'
													});
												}
												window.onload=LikeAdd;
											</script>
											<?php } elseif(urldecode($_GET['SuppressionCommentaire'])) { ?>
												<script>
													function SuppressionCommentaire() {
														Snarl.addNotification({
															title: 'Succès',
															text: 'Votre commentaire vient d\'être supprimé.',
															icon: '<i class="fa fa-check-circle" aria-hidden="true"></i>'
														});
													}
													window.onload=SuppressionCommentaire;
												</script>
												<?php } elseif(urldecode($_GET['SuppressionImpossible'])) { ?>
													<script>
														function SuppressionImpossible() {
															Snarl.addNotification({
																title: 'Erreur',
																text: 'Le commentaire ne peut être supprimé.',
																icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
															});
														}
													</script>
													<?php } ?>
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
