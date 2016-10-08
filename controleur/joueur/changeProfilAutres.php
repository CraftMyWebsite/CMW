<?php

$skype = VerifieDonnee($_POST['skype']);
$age = VerifieDonnee($_POST['age']);

$age = (int) $age;

if($skype == 1 OR $age == 1)
	header('Location: ?&page=profil&profil=' .$_Joueur_['pseudo']. '&erreur=1');
if($age == 2 OR $skype == 2)
	header('Location: ?&page=profil&profil=' .$_Joueur_['pseudo']. '&erreur=2');
	

	
ValideChangement($skype, $age, $_Joueur_['pseudo'], $bddConnection);
		
header('Location: ?&page=profil&profil=' .$_Joueur_['pseudo']);
		
function VerifieDonnee($donnee)
{	
	if(!isset($donnee) OR empty($donnee))
		return 1;
		
	$donnee = str_replace(' ', '_', $donnee);
	$donnee = htmlspecialchars($donnee);
	return $donnee;
}	

function ValideChangement($skype, $age, $pseudo, $bddConnection)
{	
	require_once('modele/joueur/maj.class.php');
	$maj = new Maj($pseudo, $bddConnection);
	$maj->setNouvellesDonneesSkype($skype);
	$maj->setNouvellesDonneesAge($age);
}
?>