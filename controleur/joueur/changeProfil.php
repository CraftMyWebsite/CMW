<?php
$email = VerifieDonnee($_POST['email']);
$mdpAncien = VerifieDonnee($_POST['mdpAncien']);
$mdpNouveau = VerifieDonnee($_POST['mdpNouveau']);
$mdpConfirme = VerifieDonnee($_POST['mdpConfirme']);

if($email == 1)
	header('Location: ?&page=profil&profil=' .$_Joueur_['pseudo']. '&erreur=1');
if($email == 2 OR $mdpNouveau == 2 OR $mdpAncien == 2 OR $mdpConfirme == 2)
	header('Location: ?&page=profil&profil=' .$_Joueur_['pseudo']. '&erreur=2');
	
if(VerifieMdp($mdpAncien, $mdpNouveau, $mdpConfirme, $_Joueur_['pseudo'], $bddConnection))
	ChangeMdp($mdpNouveau, $_Joueur_['pseudo'], $bddConnection);
else
	header('Location: ?&page=profil&profil=' .$_Joueur_['pseudo']. '&erreur=3');
	
	
if($mdpNouveau == 1 OR $mdpAncien == 1 OR $mdpConfirme == 1)
	ValideChangement($email, $_Joueur_['pseudo'], $bddConnection);
	
$_SESSION['Player']['email'] = $email;
$_Joueur_['pseudo'] = $email;	
	
function VerifieMdp($mdp, $mdpNew, $mdpConfirm, $pseudo, $bddConnection)
{
	require_once('modele/joueur/maj.class.php');
	$maj = new Maj($pseudo, $bddConnection);
	$maj = $maj->getReponseConnection();
	$maj = $maj->fetch();
	if($maj['mdp'] == $mdp)
		return true;
	else
		return false;
}
	
function VerifieDonnee($donnee)
{	
	if(!isset($donnee) OR empty($donnee))
		return 1;
	if(strlen($donnee) < 6)
		return 2;
	$donnee = str_replace(' ', '_', $donnee);
	$donnee = htmlspecialchars($donnee);
	return $donnee;
}	

function ValideChangement($email, $pseudo, $bddConnection)
{	
	require_once('modele/joueur/maj.class.php');
	$maj = new Maj($pseudo, $bddConnection);
	$maj->setNouvellesDonneesEmail($email);
}
function ChangeMdp($mdp, $pseudo, $bddConnection)
{	
	require_once('modele/joueur/maj.class.php');
	$maj = new Maj($pseudo, $bddConnection);
	$maj->setNouvellesDonneesMdp($mdp);
}
?>