<div class="cmw-page-content-header"><strong>Gestion</strong> - Gérer les mises à jour</div>
<?php include("./include/version.php");
include("./include/version_distant.php");
if($versioncms == $versioncmsrelease) { ?>
<div class="row">
	<div class="col-md-12 text-center">
		<div class="alert alert-success">
			<strong>Votre CMS CraftMyWebsite est bien a jours en version <?php echo $versioncms; ?> !</strong>
		</div>
	</div>
</div>
<?php } else { ?>
<div class="row">
	<div class="col-md-12 text-center">
		<div class="row">
			<div class="alert alert-danger">
				<strong>Votre CMS CraftMyWebsite n'est PAS à jour ! Vous êtes en <?php echo $versioncms; ?> et la dernière version est la <?php echo $versioncmsrelease; ?>! Attention, les mises à jour ne se font pas automatiquement !</strong>
			</div>
		</div>
		<div class="row">
			<div class="alert alert-warning">
				<strong>Cliquez ici pour télécharger la mise à jour de la dernière version : <a href="http://craftmywebsite.fr/release/CraftMyWebsite-<?php echo $versioncmsrelease; ?>MAJ.php" class="btn btn-warning">CraftMyWebsite V<?php echo $versioncmsrelease; ?> </a></strong>
			</div>
		</div>
	</div>
</div>
<?php } ?>