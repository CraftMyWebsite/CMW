<?php

include('controleur/profil/serveur.php');

include('modele/joueur/donneesJoueur.class.php');

$joueurDonnees = new JoueurDonnees($bddConnection, $_GET['profil']);
$joueurDonnees = $joueurDonnees->getTableauDonnees($listeReseaux);

if(empty($joueurDonnees['email']))
{
	header('Location: ?page=erreur&erreur=19&type=Profil&titre='.htmlspecialchars("Utilisateur inexistant !").'&contenue='.htmlspecialchars("L'utilisateur recherché est inexistant ou n'est pas connue de nos bases de données ! :("));
}
if(empty($joueurDonnees['age']))
	$joueurDonnees['age'] = '??';
if(empty($joueurDonnees['tokens']))
	$joueurDonnees['tokens'] = '0';




$gradeSite = Permission::getInstance()->gradeJoueur($joueurDonnees['pseudo']);

include('theme/' .$_Serveur_['General']['theme']. '/pages/profil.php');
?>