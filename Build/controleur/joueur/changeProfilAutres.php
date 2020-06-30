<?php
$joueurDonnees = new JoueurDonnees($bddConnection, $_Joueur_['pseudo']);
$joueurDonnees = $joueurDonnees->getTableauDonnees($listeReseaux);

$changementsReseaux = array();
foreach($listeReseaux as $value)
{
	if(!empty($_POST[$value['nom']]))
	{
		$temp = htmlspecialchars($_POST[$value['nom']]);
		$changementsReseaux += [ $value['nom'] => $temp ];
	}
}

$signature = htmlspecialchars($_POST['signature']);

$age = VerifieDonnee($_POST['age']);

$age = intval($age);

ValideChangement($changementsReseaux, $age, $_Joueur_['pseudo'], $signature, $bddConnection, $_Joueur_['id']);
header('Location: ?page=profil&profil='.$_Joueur_['pseudo'].'&success=true');

function VerifieDonnee($donnee)
{	
	if(!isset($donnee) OR empty($donnee))
		return 1;
		
	$donnee = str_replace(' ', '_', $donnee);
	$donnee = htmlspecialchars($donnee);
	return $donnee;
}	

function ValideChangement($reseaux, $age, $pseudo, $signature, $bddConnection, $id)
{	
	require_once('modele/joueur/maj.class.php');
	$maj = new Maj($pseudo, $bddConnection);
	if(!empty($reseaux))
		$maj->setNouvellesDonneesReseaux($reseaux, $id);
	if($age != 1)
		$maj->setNouvellesDonneesAge($age);
	else
		$maj->setNouvellesDonneesAge(0);
	$maj->setNouvellesDonneesSignature($signature);
}
?>