<h1><center> Maintenez votre CMS à jour ! </center></h1>
<?php 
include "./include/version.php";
include "./include/version_distant.php";
if($versioncms == $versioncmsrelease) {
?>
<center><div style="width: 75%" class="alert alert-success"><center>Votre CMS CraftMyWebsite est bien a jours en version <?php echo $versioncms; ?> !</br>
										Il n'y a rien a télécharger ^.^</center></div></center>
<center><div style="width: 75%" class="alert alert-info"><center>Merci d'avoir pris le thème créer par Sprik07 ! ^.^ ( et le forum de Florentlife :P )</center></div></center>

<?php } else { ?>

<div style="width: 75%" class="alert alert-danger"><center><strong>Votre CMS CraftMyWebsite n'est PAS à jour ! Vous êtes en <?php echo $versioncms; ?> et la dernière version est la <?php echo $versioncmsrelease; ?> !</br></strong></center></div>
</br>
<center><strong>Cliquez ici pour télécharger l'update de la dernière version : <a href="http://craftmywebsite.fr/release/CraftMyWebsite-<?php echo $versioncmsrelease; ?>MAJ.php" class="btn btn-warning">CraftMyWebsite V<?php echo $versioncmsrelease; ?> </a></strong></center>
<?php } ?>