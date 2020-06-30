<?php
require_once('controleur/connection_base.php'); 
require_once('modele/boutique/offres.class.php'); 
$offres = new OffresList($bddConnection, $jsonCon);
$offresTableau = $offres->GetTableauOffres();
$offresByGet = $offres->GetOffresGet();

require_once('modele/boutique/categories.class.php');
$categoriesObj = new CategoriesList($bddConnection);
$categories = $categoriesObj->GetTableauCategories();

foreach($jsonCon as $key => $serveur)
{
	$enligne[$key] = false;
	$serveurStats[$key] = $serveur->GetServeurInfos();
	if(isset($_Joueur_['pseudo']) AND isset($serveurStats[$key]['joueurs']) AND $serveurStats[$key]['joueurs'] AND in_array($_Joueur_['pseudo'], $serveurStats[$key]['joueurs']))
		$enligne[$key] = true;
}

if(isset($_GET['offre']))
{
	$infosOffre = $offres->GetInfosOffre($_GET['offre']);
	$infosCategories = $categoriesObj->GetInfosCategorie($infosOffre['offre']['categorie'], $lecture['Json']);
}
?>
