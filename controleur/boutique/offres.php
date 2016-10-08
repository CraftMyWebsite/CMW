<?php
require_once('controleur/connection_base.php'); 
require_once('modele/boutique/offres.class.php'); 
$offres = new OffresList($bddConnection, $jsonCon);
$offresTableau = $offres->GetTableauOffres();
$offresByGet = $offres->GetOffresGet();

require_once('modele/boutique/categories.class.php');
$categoriesObj = new CategoriesList($bddConnection);
$categories = $categoriesObj->GetTableauCategories();

for($i = 0; $i < count($lecture['Json']); $i++)
{
	$enligne[$i] = false;
	if(isset($_Joueur_['pseudo']) AND isset($serveurStats[$i]['joueurs']) AND in_array($_Joueur_['pseudo'], $serveurStats[$i]['joueurs']))
		$enligne[$i] = true;
}

if(isset($_GET['offre']))
{
	$infosOffre = $offres->GetInfosOffre($_GET['offre']);
	$infosCategories = $categoriesObj->GetInfosCategorie($infosOffre['offre']['categorie'], $lecture['Json']);
}
?>
