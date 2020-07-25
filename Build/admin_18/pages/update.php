<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h2 class="h2 gray">
        Mise à jour CraftMyWebSiye
	</h2>
</div>
<div class="row">

    <div class="col-md-12">
    	<?php include("./include/version.php");
	include("./include/version_distant.php");
	if($versioncms == $versioncmsrelease) { ?>
    	<div class="alert alert-success">
			<strong>Votre CMS CraftMyWebsite est bien a jours en version <?php echo $versioncms; ?> !</strong>
		</div>
	<?php } else { ?>
    	<div class="alert alert-danger">
				<strong>Votre CMS CraftMyWebsite n'est PAS à jour ! Vous êtes en <?php echo $versioncms; ?> et la dernière version est la <?php echo $versioncmsrelease; ?>! Attention, les mises à jour ne se font pas automatiquement !</strong><strong>Cliquez ici pour télécharger la mise à jour de la dernière version : <a href="http://craftmywebsite.fr/release/CraftMyWebsite-<?php echo $versioncmsrelease; ?>MAJ.php" class="btn btn-warning">CraftMyWebsite V<?php echo $versioncmsrelease; ?> </a></strong>
			
		</div>
	<?php } ?>
    </div>

</div>