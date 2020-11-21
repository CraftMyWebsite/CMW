<?php
$email = VerifieDonnee($_POST['email']);
$mdpAncien = VerifieDonnee($_POST['mdpAncien']);
$mdpNouveau = VerifieDonnee($_POST['mdpNouveau']);
$mdpConfirme = VerifieDonnee($_POST['mdpConfirme']);
$newsletter = VerifieDonnee($_POST['changeNewsletter']);
$mailVisibility = VerifieDonnee($_POST['changeVisibilityMail']);

if($email == 1)
	header('Location: ?&page=profil&profil=' .$_Joueur_['pseudo']. '&erreur=1');
if($email == 2 OR $mdpNouveau == 2 OR $mdpAncien == 2 OR $mdpConfirme == 2)
	header('Location: ?&page=profil&profil=' .$_Joueur_['pseudo']. '&erreur=2');
	
if(VerifieMdp($mdpAncien, $mdpNouveau, $mdpConfirme, $_Joueur_['pseudo'], $bddConnection))
	ChangeMdp(password_hash($mdpNouveau, PASSWORD_DEFAULT), $_Joueur_['pseudo'], $bddConnection);
else
	header('Location: ?&page=profil&profil=' .$_Joueur_['pseudo']. '&erreur=3');
	
	
if($mdpNouveau == 1 OR $mdpAncien == 1 OR $mdpConfirme == 1)
	ValideChangement($email, $_Joueur_['pseudo'], $bddConnection);


if ($newsletter != 1 or $newsletter != 2) {
	if ($newsletter == 'subscribeNewsletter') {
		$newsletter = 1;
		ChangeNewsletter($newsletter, $_Joueur_['pseudo'], $bddConnection);
	} elseif ($newsletter == 'unsubscribeNewsletter') {
		$newsletter = 0;
		ChangeNewsletter($newsletter, $_Joueur_['pseudo'], $bddConnection);
	} else {
		header('Location: ?&page=profil&profil=' . $_Joueur_['pseudo'] . '&erreur=9');
	}
} else {
	header('Location: ?&page=profil&profil=' . $_Joueur_['pseudo'] . '&erreur=9');
}

if ($mailVisibility != 1 or $mailVisibility != 2) {
	if ($mailVisibility == 'showMail') {
		$mailVisibility = 1;
		ChangeMailVisibility($mailVisibility, $_Joueur_['pseudo'], $bddConnection);
	} elseif ($mailVisibility == 'hideMail') {
		$mailVisibility = 0;
		ChangeMailVisibility($mailVisibility, $_Joueur_['pseudo'], $bddConnection);
	} else {
		header('Location: ?&page=profil&profil=' . $_Joueur_['pseudo'] . '&erreur=10');
	}
} else {
	header('Location: ?&page=profil&profil=' . $_Joueur_['pseudo'] . '&erreur=10');
}

$_SESSION['Player']['email'] = $email;
$_Joueur_['email'] = $email;	
header('Location: ?page=profil&profil='.$_Joueur_['pseudo'].'&success=true');
function VerifieMdp($mdp, $mdpNew, $mdpConfirm, $pseudo, $bddConnection)
{
	require_once('modele/joueur/maj.class.php');
	$maj = new Maj($pseudo, $bddConnection);
	$maj = $maj->getReponseConnection();
	$maj = $maj->fetch(PDO::FETCH_ASSOC);
	if(password_verify($mdp, $maj['mdp']))
		return true;
	else
		return false;
}
	
function VerifieDonnee($donnee)
{	
	if(!isset($donnee) OR empty($donnee))
		return 1;
	if(strlen($donnee) < 4)
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
function ChangeNewsletter($newsletter, $pseudo, $bddConnection)
{
	require_once('modele/joueur/maj.class.php');
	$maj = new Maj($pseudo, $bddConnection);
	$maj->setNewsletter($newsletter);
}
function ChangeMailVisibility($mailVisibility, $pseudo, $bddConnection)
{
	require_once('modele/joueur/maj.class.php');
	$maj = new Maj($pseudo, $bddConnection);
	$maj->setMailVisibility($mailVisibility);
}
?>
