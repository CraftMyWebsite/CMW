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
		$joueurDonnees['age'] = 'inconnu';
	}
	
	if(empty($joueurDonnees['skype']))
		$joueurDonnees['skype'] = 'inconnu';
	if(empty($joueurDonnees['age']))
		$joueurDonnees['age'] = 'inconnu';

	
		
	if($joueurDonnees['rang'] == 1)
		$gradeSite = 'Créateur';
	elseif($joueurDonnees['rang'] == 2) 
		$gradeSite = 'Administrateur';
	elseif($joueurDonnees['rang'] == 3)
		$gradeSite = 'Modérateur';
	elseif($joueurDonnees['rang'] == 4)
		$gradeSite = 'Développeur';
	elseif($joueurDonnees['rang'] == 5)
		$gradeSite = 'Buildeur';
	else
		$gradeSite = 'Joueur';
	
	include('theme/' .$_Serveur_['General']['theme']. '/pages/profil.php');
?>