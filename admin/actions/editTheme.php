<?php
	$lecture = new Lire('modele/config/config.yml');
	$lecture = $lecture->GetTableau();


if(isset($_POST['theme']) AND isset($_POST['themeOption']))
{
	$lecture['General']['theme'] = $_POST['theme'];
	$lecture['General']['themeOption'] = $_POST['themeOption'];

	$ecriture = new Ecrire('modele/config/config.yml', $lecture);
}
elseif(isset($_POST['theme']))
{
	$lecture['General']['theme'] = $_POST['theme'];

	$ecriture = new Ecrire('modele/config/config.yml', $lecture);
}
?>