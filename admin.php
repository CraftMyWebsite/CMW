<?php
session_start();
error_reporting(E_ALL);
date_default_timezone_set('Europe/Paris');
ini_set('display_errors', 1);

	// On appelle les classes du controleur qui instancies les objets principaux (BDD, config, JSONAPI...).
	require_once('controleur/config.php');
	require_once('controleur/connection_base.php');	

	
	require('modele/joueur/imgProfil.class.php');
	$_ImgProfil_ = new ImgProfil($bddConnection);
	/* Si l'utilisateur est connecté, on met ses informations dans un tableau global, qui sera utilisable que 
	   le laps de temps du chargement de la page contrairement aux sessions. */
  /* On instancie un joueur, et on récupère le tableau de données. $_Joueur_ sera donc utilisable 
	   sur toutes les pages grâce au système de GET sur l'index.*/
	
	require('controleur/joueur/joueur.class.php');
	$globalJoueur = new Joueur($bddConnection);
	$_Joueur_ = $globalJoueur->getUser();

	if(Permission::getInstance()->verifPerm("PermsPanel","access"))
	{
		require_once('modele/json/json.php');
		$_Permission_ = Permission::getInstance();
		
		$admin = true;

		if(isset($_GET['action'])){
			include('admin/action.php');
		}else {
			include('admin/index.php');
		}
	}
	else
	{
		header('Location: nope.php');
	}
	
?>
