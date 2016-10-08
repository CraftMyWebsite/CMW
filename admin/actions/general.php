<?php
if(isset($_POST['adresseWeb']) AND isset($_POST['nom']) AND isset($_POST['description']) AND isset($_POST['adresse']) AND isset($_POST['dbNom']) AND isset($_POST['dbUtilisateur']) AND isset($_POST['dbMdp']))
{
$lecture = new Lire('modele/config/config.yml');
$lecture = $lecture->GetTableau();

$lecture['General']['url'] = $_POST['adresseWeb'];
$lecture['General']['name'] = $_POST['nom'];
$lecture['General']['description'] = $_POST['description'];

$lecture['DataBase']['dbAdress'] = $_POST['adresse'];
$lecture['DataBase']['dbName'] = $_POST['dbNom'];
$lecture['DataBase']['dbUser'] = $_POST['dbUtilisateur'];
$lecture['DataBase']['dbPassword'] = $_POST['dbMdp'];

$ecriture = new Ecrire('modele/config/config.yml', $lecture);
}

?>