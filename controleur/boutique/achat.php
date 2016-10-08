<?php
$recupActions = $bddConnection->prepare('SELECT * FROM cmw_boutique_action WHERE id_offre = :id_offre');
$recupActions->execute(array('id_offre' => $_GET['offre']));
	

for($i = 0; $i < count($lecture['Json']); $i++)
{
	$jsonCon[$i]->SetConnectionBase($bddConnection);
}
require_once('controleur/boutique/offres.php'); 
if($_Joueur_['tokens'] >= $offresByGet[$_GET['offre']]['prix'])
{

	for($i = 0; $i < count($lecture['Json']); $i++)
	{
		$jsonCon[$i]->SetPlayerName($_Joueur_['pseudo']);
	}
while($donneesActions = $recupActions->fetch())
{

if($infosCategories['serveurId'] == -1) 
	for($i = 0; $i < count($lecture['Json']); $i++)
	{
		SendCommand($jsonCon[$i], $donneesActions['methode'], $donneesActions['commande_valeur'], $donneesActions['duree']);
	}
elseif($infosCategories['serveurId'] == -2)
	for($i = 0; $i < count($lecture['Json']); $i++)
	{
		if($enligne[$i])
			SendCommand($jsonCon[$i], $donneesActions['methode'], $donneesActions['commande_valeur'], $donneesActions['duree']);
	}
else
	SendCommand($jsonCon[$infosCategories['serveurId']], $donneesActions['methode'], $donneesActions['commande_valeur'], $donneesActions['duree']);
	
    require_once('modele/app/statistiques.class.php');
    $stats = new StatsUpdate($bddConnection);
    $stats->AddSell($offresByGet[$_GET['offre']]['id'], $offresByGet[$_GET['offre']]['prix'], $_Joueur_['pseudo']);
	require_once('modele/boutique/changeTokens.php');
}

}

function SendCommand($jsonCon, $methode, $valeur, $duree)
{
	if($methode == 0)
		$jsonCon->runConsoleCommand($valeur);
	
	if($methode == 1)
		$jsonCon->SendBroadcast($valeur);
		
	if($methode == 2)
		$jsonCon->AddPlayerToGroup($valeur, $duree);
	
	if($methode == 3)
		$jsonCon->GivePlayerItem($valeur);
		
	if($methode == 4)
		$jsonCon->GivePlayerMoney($valeur);
		
	if($methode == 5)
		$jsonCon->GivePlayerXp($valeur);
}
?>
