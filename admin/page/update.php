<h1><center> Maintenez votre CMS a jours ! </center></h1>
<?php 
include "./include/version.php";
include "./include/version_distant.php";
if($versioncms == $versioncmsrelease) {
?>
<center><div style="width: 75%" class="alert alert-success"><center>Votre CMS CraftMyWebsite est bien a jours en version <?php echo $versioncms; ?> !</br>
										Il n'y a rien a télécharger ^.^</center></div></center>
<center><div style="width: 75%" class="alert alert-info"><center>Merci d'avoir pris le thème créer par Sprik07 ! ^.^</center></div></center>

<?php } else { ?>

<div style="width: 75%" class="alert alert-danger"><center><strong>Votre CMS CraftMyWebsite n'est PAS a jours ! Vous étes en <?php echo $versioncms; ?> et la dérniere version est la <?php echo $versioncmsrelease; ?> !</br></strong></center></div>
</br>
<center><strong>Cliquez ici pour télécharger l'update de la dérniere version : <a href="http://craftmywebsite.fr/release/CraftMyWebsite-<?php echo $versioncmsrelease; ?>MAJ.php" class="btn btn-warning">CraftMyWebsite V<?php echo $versioncmsrelease; ?> </a></strong></center>
<?php } ?>