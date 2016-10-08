<?php
error_reporting(0);
	// On appelle les classes du controleur qui instancies les objets principaux (BDD, config, JSONAPI...).
	require_once('controleur/config.php');
	require_once('controleur/connection_base.php');	

	// On démarre les sessions sur la page pour récupérer les variables globales(les données du joueur...).
	session_start();
	
	/* Si l'utilisateur est connecté, on met ses informations dans un tableau global, qui sera utilisable que 
	   le laps de temps du chargement de la page contrairement aux sessions. */
	if(isset($_SESSION['Player']['pseudo']) AND $_SESSION['Player']['rang'] == 1)
	{
		/* On instancie un joueur, et on récupère le tableau de données. $_Joueur_ sera donc utilisable 
		   sur toutes les pages grâce au système de GET sur l'index.*/
		require_once('controleur/joueur/joueur.class.php');
		
		$globalJoueur = new Joueur();
		
		// Cette variable contiens toutes les informations du joueur.
		$_Joueur_ = $globalJoueur->getArrayDonneesUtilisateur();
		$connection = true;
		
		
		require_once('controleur/json/json.php');
		
		$admin = true;

		if(isset($_GET['action'])){
			include('admin/donnees.php');
			include('admin/action.php');
		}
		
  		include('admin/panel.php');
		
	}
	else
	{
		header('Location: index.php');
	}
	
?>
