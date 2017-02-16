<?php

include('controleur/profil/serveur.php');

include('modele/joueur/donneesJoueur.class.php');

$joueurDonnees = new JoueurDonnees($bddConnection, $_GET['profil']);
$joueurDonnees = $joueurDonnees->getTableauDonnees();

if(empty($joueurDonnees))
{
	$joueurDonnees['rang'] = 0;
	$joueurDonnees['email'] = 'inconnu';
	$joueurDonnees['skype'] = 'inconnu';
	$joueurDonnees['age'] = '??';
}

if(empty($joueurDonnees['skype']))
	$joueurDonnees['skype'] = 'inconnu';
if(empty($joueurDonnees['age']))
	$joueurDonnees['age'] = '??';
if(empty($joueurDonnees['tokens']))
	$joueurDonnees['tokens'] = '0';



if($joueurDonnees['rang'] == 0) {
	$gradeSite = 'Joueur';
} elseif($joueurDonnees['rang'] == 1) {
	$gradeSite = "<font color='red'>Créateur";
} elseif(fopen('./modele/grades/'.$joueurDonnees['rang'].'.yml', 'r')) {
	$openGradeSite = new Lire('./modele/grades/'.$joueurDonnees['rang'].'.yml');
	$readGradeSite = $openGradeSite->GetTableau();
	$gradeSite = $readGradeSite['Grade'];
	if(empty($readGradeSite['Grade']))
		$gradeSite = 'Joueur';
} else {
	$gradeSite = 'Joueur';
}

include('theme/' .$_Serveur_['General']['theme']. '/pages/profil.php');
?>