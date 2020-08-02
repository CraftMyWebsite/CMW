<?php
$getprofil = $_GET['profil'];
$profileImage = new ImgProfil($joueurDonnees['id']);
$isMyAccount = false;

// GESTION D'ERREURS
if (isset($_GET['erreur'])) {
	$errorContent;
	switch ($_GET['erreur']) {
		case 1:
			$errorContent = 'Erreur, l\'email entré est vide...';
			break;

		case 2:
			$errorContent = 'Erreur, un des champs est trop court (minimum 4 caractères)';
			break;

		case 3:
			$errorContent = 'Erreur, le mot de passe entré ne correspond pas à celui associé à votre compte';
			break;

		case 4:
			$errorContent = 'Erreur, Vous n\'avez pas assez de tokens.';
			break;

		case 5:
			$errorContent = 'Erreur, Pseudonyme inconnu...';
			break;

		case 6:
			$errorContent = 'Erreur, Extension non autorisée !';
			break;

		case 7:
			$errorContent = 'Erreur, Fichier trop volumineux ! <small>Maximum 2Mo</small>';
			break;

		case 8:
			$errorContent = 'Erreur, Des champs sont manquants !';
			break;

		case 9:
			$errorContent = 'Erreur, Impossible de vous abonner / désabonner à votre Newsletter...';

		case 10:
			$errorContent = 'Erreur, Impossible d\'afficher / cacher votre email...';

		default:
			$errorContent = 'Une erreur est survenue lors de l\'enregistrement de vos informations !';
			break;
	}
	//GESTION DE SUCCÈS
} elseif (isset($_GET['success'])) {
	$successContent;
	switch ($_GET['success']) {
		case 'true':
			$successContent = 'Vos informations ont bien été changé !';
			break;

		case 'jetons':
			if (!isset($_GET['montant']) || !is_numeric($_GET['montant'])) {
				$_GET['montant'] = 'NaN';
			}
			if (!isset($_GET['pseudo'])) {
				$_GET['pseudo'] = 'NOT_FOUND';
			}
			$successContent = 'Vous venez d\'envoyer ' . htmlspecialchars($_GET['montant']) . ' jetons à ' . htmlspecialchars($_GET['pseudo']) . ' !';
			break;

		case 'image':
			$successContent = 'Votre photo de profil a été modifiée !';
			break;

		case 'imageRemoved':
			$successContent = 'Votre photo de profil a bien été supprimée de nos serveurs !';
			break;

		default:
			$successContent = '<div class="text-danger">Message de succès introuvable...</div>';
	}
}
?>
<header class="heading-pagination">
	<div class="container-fluid">
		<h1 class="text-uppercase wow fadeInRight" style="color:white;">
			Profil de <?= htmlspecialchars($getprofil); ?>
		</h1>
	</div>
</header>

<section class="layout" id="page">
	<div class="container">
		<?php if (isset($_Joueur_["pseudo"]) && $_Joueur_['pseudo'] != $_GET['profil']) :
			$isMyAccount = false; ?>
			<!-- Envoie d'un message à l'utilisateur -->
			<button type="button" data-toggle="modal" data-target="#modalRep" data-to="<?= htmlspecialchars($getprofil); ?>" class="btn btn-primary float-right ">Envoyer un message à <?= htmlspecialchars($getprofil); ?></button>
			<div class="clearfix"></div>
		<?php
		endif; ?>

		<?php if (isset($_Joueur_) and $_GET['profil'] == $_Joueur_['pseudo']) : ?>
			<!-- Edition du profil -->

			<?php
			$isMyAccount = true;
			//Gestion des erreurs
			if (isset($_GET['erreur'])) {
				echo '<div class="alert alert-danger text-center mx-auto">' . $errorContent . '</div>';
			} elseif (isset($_GET['success'])) {
				echo '<div class="alert alert-success text-center mx-auto">' . $successContent . '</div>';
			}
			?>

			<!-- Gestion du compte -->

			<div class="d-flex flex-row-reverse">
				<a href="#" class="btn btn-info p-2 mx-1 mb-3" onclick="showFunction('giveSomesCoins')"><i class="fas fa-gift mr-1"></i> Offrir des jetons</a>
				<a href="#" class="btn btn-info p-2 mb-3" onclick="showFunction('showMePlease')"><i class="fas fa-pencil-alt mr-1"></i> Modifier mon compte </a>
			</div>

			<!-- Offrir des jetons -->

			<div class="giveCoins mb-3" id="giveSomesCoins" style="transition: opacity .7s ease-out; opacity: 0; height: 0; overflow: hidden;">

				<form class="form-horizontal" method="post" action="?&action=give_jetons" role="form">

					<div class="alert alert-info">

						<h4 class="mb-3">Envoyer des jetons à un joueur : </h4>
						<hr />
						<div class="row">
							<div class="form-group col-md-9">
								<label for="pseudo">Pseudo du receveur</label>
								<input type="text" required class="form-control" name="pseudo" placeholder="Le nom de la personne a qui vous souhaitez donner des jetons" id="pseudo">
							</div>
							<div class="form-group col-md-3">
								<label for="inputPassword4">Montant</label>
								<input type="number" required name="montant" class="form-control" placeholder="0" />
							</div>
						</div>


						<div class="form-group">
							<div class="col-sm-offset-5 col-sm-5">
								<button type="submit" class="btn btn-primary validerChange">Envoyer</button>
							</div>
						</div>
					</div>

				</form>
			</div>



			<!-- Modification du compte -->

			<div class="settingOption mb-3 alert alert-info" id="showMePlease" style="transition: opacity .7s ease-out; opacity: 0; height: 0; overflow: hidden;">
				<h4 class="mb-3 ml-2">Modifier les informations de mon compte : </h4>
				<hr />
				<div class="row">

					<!-- Navigation  -->
					<div class="col-3">
						<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

							<a class="nav-link active" id="v-pills-personnalInfo-tab" data-toggle="pill" href="#v-pills-personnalInfo" role="tab" aria-controls="v-pills-personnalInfo" aria-selected="true">Informations personnelles</a>

							<a class="nav-link" id="v-pills-otherInfo-tab" data-toggle="pill" href="#v-pills-otherInfo" role="tab" aria-controls="v-pills-otherInfo" aria-selected="false">Informations optionelles</a>

						</div>
					</div>

					<div class="col-9 pl-5">
						<div class="tab-content" id="v-pills-tabContent">
							<div class="tab-pane fade show active" id="v-pills-personnalInfo" role="tabpanel" aria-labelledby="v-pills-personnalInfo-tab">

								<form class="form-horizontal" method="post" action="?&action=changeProfil" role="form">

									<div class="form-group">
										<div class="row">
											<label for="pseudo" class="col-md-4 control-label">Pseudo</label>
											<div class="col-md-6">
												<input class="form-control" style="cursor: not-allowed" id="namePseudo" type="text" value="<?= $_Joueur_['pseudo']; ?>" disabled="" readonly="">
											</div>
										</div>
									</div>
									<h5 class="mt-2">Modifier son mot de passe : <small>(Laissez vide sinon)</small></h5>
									<hr />
									<div class="form-group">
										<div class="row">
											<label class="col-md-4 control-label">Mot de passe actuel :</label>
											<div class="col-md-6 changer-mdp-champ">
												<input type="password" class="form-control" name="mdpAncien" placeholder="Ancien Mot de Passe">
											</div>
										</div>
										<div class="row">
											<label class="col-md-4 control-label">Nouveau mot de passe :</label>
											<div class="col-md-6 changer-mdp-champ">
												<input type="password" class="form-control" name="mdpNouveau" placeholder="Nouveau Mot de Passe">
											</div>
										</div>
										<div class="row">
											<label class="col-md-4 control-label">Confirmez nouveau mot de passe :</label>
											<div class="col-md-6 changer-mdp-champ">
												<input type="password" class="form-control" name="mdpConfirme" placeholder="Confirmez-le">
											</div>
										</div>
									</div>
									<h5 class="mt-2">Votre adresse email : </h5>
									<hr />
									<div class="form-group">
										<div class="row">
											<label for="inputMail" class="col-md-4 control-label">Adresse email</label>
											<div class="col-md-6 d-inline">
												<input type="email" class="form-control col-md-6 d-inline-block" id="inputMail" name="email" value="<?= $joueurDonnees['email']; ?>">
												<?php if ($joueurDonnees['show_email']) : ?>
													<button type="submit" class="col-md-5 d-inline-block btn btn-danger" name="changeVisibilityMail" value="hideMail">Cacher son email !</button>
												<?php else : ?>
													<button type="submit" class="col-md-5 d-inline-block btn btn-success" name="changeVisibilityMail" value="showMail">Afficher son email !</button>
												<?php endif; ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="col-md-4 control-label mt-3">Abonnement à la Newsletter : </label>
											<div class="col-md-6">
												<div class="d-inline">
													<?php
													if ($joueurDonnees['newsletter']) : ?>
														<input type="text" class="form-control mt-2 text-success col-md-4 d-inline-block" id="inputNewsletter" name="inputNewsletter" value="Déjà abonné !" disabled />
														<button type='submit' class="btn btn-danger ml-1 col-md-7 d-inline-block" name="changeNewsletter" value="unsubscribeNewsletter">Se désinscrire !</button>
													<?php else : ?>
														<input type="text" class="form-control mt-2 text-danger col-md-4 d-inline-block" id="inputNewsletter" name="inputNewsletter" value="Non abonné !" disabled />
														<button type='submit' class="btn btn-success ml-1 col-md-7 d-inline-block" name="changeNewsletter" value="subscribeNewsletter">S'inscrire !</button>
													<?php endif; ?>
												</div>
											</div>

										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-offset-5 col-md-5">
												<button type="submit" class="btn btn-primary validerChange">Valider mes
													changements</button>
											</div>
										</div>
								</form>

							</div>
						</div>


						<div class="tab-pane fade" id="v-pills-otherInfo" role="tabpanel" aria-labelledby="v-pills-otherInfo-tab">

							<form class="form-horizontal" method="post" action="?&action=changeProfilAutres" role="form">
								<?php
								foreach ($listeReseaux as $value) {
								?>
									<div class="form-group">
										<label for="pseudo" class="col-sm-2 control-label"><?= ucfirst($value['nom']); ?></label>
										<div class="col-sm-8" style="display: inline-block;">
											<input type="text" class="form-control" name="<?= $value['nom']; ?>" placeholder="Votre nom d'utilisateur <?= $value['nom']; ?>" value="<?php if ($joueurDonnees[$value['nom']] != 'inconnu') echo $joueurDonnees[$value['nom']]; ?>">
										</div>
									</div>
								<?php
								}
								?>
								<div class="form-group">
									<label for="age" class="col-sm-2 control-label">Âge <small>(0 = caché)</small></label>
									<div class="col-sm-8" style="display: inline-block;">
										<input type="number" name="age" class="form-control" min="0" max="99" placeholder="17" value="<?php if ($joueurDonnees['age'] != 'inconnu') echo $joueurDonnees['age']; ?>">
									</div>
								</div>
								<div class="form-group wys-content">
									<h5 class="control-label">Signature Forum</h5>
									<hr />
									<div class="col-md-12 text-center d-inline-block wys-options">
										<?php
										$smileys = getDonnees($bddConnection);
										for ($i = 0; $i < count($smileys['symbole']); $i++) {
											echo '<a href="javascript:insertAtCaret(\'signature\',\' ' . $smileys['symbole'][$i] . ' \')"><img src="' . $smileys['image'][$i] . '" alt="' . $smileys['symbole'][$i] . '" title="' . $smileys['symbole'][$i] . '" /></a>';
										}
										?>
										<a class="wys-button" href="javascript:ajout_text('signature', 'Ecrivez ici ce que vous voulez mettre en gras', 'ce texte sera en gras', 'b')" style="text-decoration: none;" title="gras"><i class="fas fa-bold" aria-hidden="true"></i></a>
										<a class="wys-button" href="javascript:ajout_text('signature', 'Ecrivez ici ce que vous voulez mettre en italique', 'ce texte sera en italique', 'i')" style="text-decoration: none;" title="italique"><i class="fas fa-italic"></i></a>
										<a class="wys-button" href="javascript:ajout_text('signature', 'Ecrivez ici ce que vous voulez mettre en souligné', 'ce texte sera en souligné', 'u')" style="text-decoration: none;" title="souligné"><i class="fas fa-underline"></i></a>
										<a class="wys-button" href="javascript:ajout_text('signature', 'Ecrivez ici ce que vous voulez mettre en barré', 'ce texte sera barré', 's')" style="text-decoration: none;" title="barré"><i class="fas fa-strikethrough"></i></a>
										<a class="wys-button" href="javascript:ajout_text('signature', 'Ecrivez ici ce que vous voulez mettre en aligné à gauche', 'ce texte sera aligné à gauche', 'left')" style="text-decoration: none" title="aligné à gauche"><i class="fas fa-align-left"></i></a>
										<a class="wys-button" href="javascript:ajout_text('signature', 'Ecrivez ici ce que vous voulez mettre en centré', 'ce texte sera centré', 'center')" style="text-decoration: none" title="centré"><i class="fas fa-align-center"></i></a>
										<a class="wys-button" href="javascript:ajout_text('signature', 'Ecrivez ici ce que vous voulez mettre en aligné à droite', 'ce texte sera aligné à droite', 'right')" style="text-decoration: none" title="aligné à droite"><i class="fas fa-align-right"></i></a>
										<a class="wys-button" href="javascript:ajout_text('signature', 'Ecrivez ici ce que vous voulez mettre en justifié', 'ce texte sera justifié', 'justify')" style="text-decoration: none" title="justifié"><i class="fas fa-align-justify"></i></a>
										<a class="wys-button" href="javascript:ajout_text_complement('signature', 'Ecrivez ici l\'adresse de votre lien', 'https://craftmywebsite.fr/forum', 'url', 'Entrez le titre de votre lien', 'CraftMyWebsite')" style="text-decoration: none" title="lien"><i class="fas fa-link"></i></a>
										<a class="wys-button" href="javascript:ajout_text_complement('signature', 'Ecrivez ici l\'adresse de votre image', 'https://craftmywebsite.fr/img/cat6.png', 'img', 'Entrez ici le titre de votre image (laisser vide si vous ne voulez pas compléter', 'Titre')" style="text-decoration: none" title="image"><i class="fas fa-image"></i></a>
										<a class="wys-button" href="javascript:ajout_text_complement('signature', 'Ecrivez ici votre texte en couleur', 'Ce texte sera coloré', 'color', 'Entrer le nom de la couleur en anglais ou en hexaécimal avec le  # : http://www.code-couleur.com/', 'red ou #40A497')" style="text-decoration: none" title="couleur"><i class="fas fa-font"></i></a>
										<a class="wys-button" href="javascript:ajout_text_complement('signature', 'Ecrivez ici votre message caché', 'contenue du spoiler', 'spoiler', 'Entrer le titre du message caché (si la case est vide le titre sera \'Spoiler\'', 'Spoiler')" style="text-decoration: none" title="spoiler"><i class="fas fa-flag"></i></a>
										<div class="dropdown d-inline class=" wys-button">
											<a href="#" role="button" id="font" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fas fa-text-height"></i>
											</a>
											<div class="dropdown-menu" aria-labelledby="font">
												<a class="dropdown-item" href="javascript:ajout_text('signature', 'Ecrivez ici ce que vous voulez mettre en taille 2', 'ce texte sera en taille 2', 'font=2')"><span style="font-size: 2em;">2</span></a>
												<a class="dropdown-item" href="javascript:ajout_text('signature', 'Ecrivez ici ce que vous voulez mettre en taille 5', 'ce texte sera en taille 5', 'font=5')"><span style="font-size: 5em;">5</span></a>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6 d-inline-block">
											<textarea name="signature" class="form-control wys-textarea" placeholder="Votre signature" oninput="previewTopic(this);" id="signature"><?php if (isset($joueurDonnees['signature'])) echo $joueurDonnees['signature']; ?></textarea>
										</div>
										<div class="col-sm-6 d-inline">
											<p class="form-control-static" style="background-color: white;" id="previewTopic"></p>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="text-center">
										<button type="submit" class="btn btn-primary validerChange">Valider champs facultatifs</button>
									</div>
								</div>
							</form>

						</div>

					</div>
				</div>

			</div>

	</div>
	<!-- Fin Gestion du compte -->
<?php endif; ?>
</div>
<!-- Affichage de profil -->
<div class="panel panel-default container">
	<div class="panel-body">
		<h3>Présentation du profil :</h3>
		<div class="row">
			<div class="col-md-4">
				<div class="corp-bloc profil-bloc">

					<div class="presentation-profile">
						<!-- Image et edition de la photo de profil -->
						<?php if ($isMyAccount) : ?>
							<form class="form-horizontal d-inline-block" method="post" action="?action=modifImgProfil" role="form" enctype="multipart/form-data">

								<label for="img_profil">

									<div class="card-container">
										<input type="file" class="form-control-file" name="img_profil" id="img_profil" style="display:none;" onchange='getUploadFileName(this)' required />
										<img class="profile-image" src="<?= $profileImage->getImgToSize(128, $width, $height); ?>" alt="Image de profil de <?= htmlspecialchars($joueurDonnees['pseudo']) ?>" />
										<div class="hoverText">
											<div class="caption">
												<i class="fas fa-edit"></i>
											</div>
										</div>
									</div>
								</label>
							<?php else : ?>
								<img class="profile-image" src="<?= $profileImage->getImgToSize(128, $width, $height); ?>" alt="Image de profil de <?= htmlspecialchars($joueurDonnees['pseudo']) ?>" />
							<?php endif; ?>


							<!-- Information du compte -->
							<div class="text-presentation-profile " style="display:inline-block">
								<div class="d-flex flex-column">
									<div class="p-2"><span class="font-weight-bolder"><?= $gradeSite ?> </span><?= htmlspecialchars($joueurDonnees['pseudo']); ?></div>
									<div class="p-2">Inscrit le <?= date('d/m/Y', $joueurDonnees['anciennete']); ?></div>
									<?php if ($joueurDonnees['age'] > 5 && $joueurDonnees['age'] != "??") : ?>
										<div class="p-2"><?= $joueurDonnees['age'] ?> ans</div>
									<?php endif; ?>
									<div class="p-2">
										<?php require_once("modele/topVotes.class.php");
										$topVotes = new TopVotes($bddConnection);
										$nbreVotes = $topVotes->getNbreVotes($getprofil); ?>
										<?= $nbreVotes . ' ' . ($nbreVotes > 1 ? "votes" : "vote"); ?>
									</div>
								</div>
							</div>

							<?php if ($isMyAccount) : ?>
								<!-- Gestion de la photo de profile -->
								<div class="alert alert-info p-1"><span class=> Image Choisie : </span><span id="file-name">Aucune image sélectionné !</span></div>
								<div class="form-group">
									<button type="submit" class="btn btn-success">Modifier</button>
									<?php if ($profileImage->modif) : ?>
										<a class="btn btn-danger" href="?action=removeImgProfil">Supprimer</a>
									<?php endif; ?>
								</div>
							</form>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-6">
				<div class="container">
					<table class="table table-hover table-sm table-properties">
						<?php if ($joueurDonnees['show_email']) : ?>
							<tr class="tr-profile">
								<th class="th-profile">&rarr; Email</th>
								<td><?= $joueurDonnees['email'] ?></td>
							</tr>
						<?php endif; ?>

						<?php foreach ($listeReseaux as $reseauSocial) :
							if ($joueurDonnees[$reseauSocial['nom']] != "inconnu") : ?>
								<tr class="tr-profile">
									<th class="th-profile">&rarr; <?= ucfirst($reseauSocial['nom']); ?></th>
									<td><?= $joueurDonnees[$reseauSocial['nom']]; ?></td>
								</tr>
						<?php
							endif;
						endforeach;
						?>

					</table>
				</div>

			</div>
		</div>

		<div class="container text-center mx-auto">
			<h4 class="my-5 text-left">Signature : </h4>
			<?php if (!empty($joueurDonnees['signature'])) : ?>

				<blockquote class="blockquote bq-profile text-center">
					<p class="mb-0 h4"> <?= BBCode($joueurDonnees['signature'], $bddConnection); ?> </p>
				</blockquote>

			<?php else : ?>
				<div class="alert alert-warning b-3">
					<p class="text-warning mb-0 h6"> Ce joueur n'a aucune signature... </p>
				</div>
			<?php endif; ?>
		</div>

	</div>
</div>
</div>
</section>
