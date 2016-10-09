<h1><center>Informations sur le forum ! </center></h1>
<?php 
include('modele/forum/version.php');
?>
<br/>
<?php 
include('include/version_forum.php');
?>
<div class="alert alert-<?php if($ajour == 1) { echo 'success'; } else { echo 'danger'; } ?>">
	Votre Version du forum est <?php if($ajour == 1)
	{
		echo 'à jours !!!';
	}
	else
	{
		echo 'obsolète !!! rendez vous sur <a href="http://craftmywebsite.fr/forum">CraftMyWebsite</a> pour la mettre à jours !';
	}
	?>
	<br/>La dernière version disponible est la <?php echo $l_version1; ?></div>
	