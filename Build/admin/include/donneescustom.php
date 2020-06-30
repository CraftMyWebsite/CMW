<?php
// Données custom pour l'affichage sur le panel
$lecture = new Lire('./modele/config/config.yml');
$lecture = $lecture->GetTableau();

include "./include/version.php";
include "./include/version_distant.php";

$req_nbrNews2 = $bddConnection->query('SELECT * FROM cmw_news'); 
$Newstotal = $req_nbrNews2->rowCount(); 

include('./controleur/json/json.php');
?>