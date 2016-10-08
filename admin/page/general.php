<center><h1><center> Réglages & Informations générales de votre site </center></h1>
<?php 
include "./include/version.php";
include "./include/version_distant.php";
if($versioncms == $versioncmsrelease) {
?>
<div style="width: 50%" class="alert alert-success"><center>Votre CMS CraftMyWebsite est bien a jours en version <?php echo $versioncms; ?> !</center></div>
<?php } else { ?>
<div style="width: 50%" class="alert alert-danger"><center><strong>ATTENTION: Votre CMS CraftMyWebsite n'est PAS a jours !! Vous étes en <?php echo $versioncms; ?> et la dérniere version est la <?php echo $versioncmsrelease; ?> ! Rdv sur <a style="color: blue;" href="http://craftmywebsite.fr/telechargement.php">CraftMyWebsite Release</a></strong></center></div>
<?php } ?>

<?php if(isset($_SESSION['Player']['pseudo']) AND $_SESSION['Player']['rang'] == 1)
{

 ?>
<div style="width: 75%" class="alert alert-dismissable alert-success"><center>Modifiez ici les informations principales de votre serveur. La plupart des autres données du site dépendent de la base de données, qui est donc essentielle, changez les identifiants de la base seulement si vous savez ce que vous faites ! </center></a></div>
<form style="width: 50%" class="form-horizontal default-form" method="post" action="?&action=general">
	<h4 style="text-decoration:underline;"><center><strong>Description</strong></center></h4>
	</br>
	<div class="form-group">
		<label class="col-sm-4 control-label">Adresse du site</label>
		<div class="col-sm-8">
			<input type="url" name="adresseWeb" class="form-control" placeholder="http://monsiteminecraft.fr/" value="<?php echo $lecture['General']['url']; ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Nom du serveur</label>
		<div class="col-sm-8">
			<input type="text" name="nom" class="form-control" placeholder="MineServeur" value="<?php echo $lecture['General']['name']; ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Description</label>
		<div class="col-sm-8">
			<input type="text" name="description" class="form-control" placeholder="Mon super serveur minecraft !" value="<?php echo $lecture['General']['description']; ?>">
		</div>
	</div>
	</br>
	<h4 style="text-decoration:underline;"><center><strong>Base de données MySQL</center></strong></h4>
	</br>
	<div class="form-group">
		<label class="col-sm-4 control-label">Adresse</label>
		<div class="col-sm-8">
			<input type="text" name="adresse" class="form-control" placeholder="localhost" value="<?php echo $lecture['DataBase']['dbAdress']; ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Nom de la base</label>
		<div class="col-sm-8">
			<input type="text" name="dbNom" class="form-control" placeholder="BaseSite" value="<?php echo $lecture['DataBase']['dbName']; ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Nom d'utilisateur</label>
		<div class="col-sm-8">
			<input type="text" name="dbUtilisateur" class="form-control" placeholder="root" value="<?php echo $lecture['DataBase']['dbUser']; ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Mot de passe</label>
		<div class="col-sm-8">
			<input type="password" name="dbMdp" class="form-control" placeholder="Balançoire" value="<?php echo $lecture['DataBase']['dbPassword']; ?>">
		</div>
	</div>
	<div class="form-group">
		<center><div class="">
			<input type="submit" class="btn btn-danger" value="Valider les changements" />
		</div></center>
	</div>
<?php } else { ?>

<div class="alert alert-danger"><center><strong><center>INFORMATION</center></stronge><br/>En étant modérateur du serveur vous n'avez actuellement accès aux options de base du site.</center></div>

<?php } ?>
</form>
</center>