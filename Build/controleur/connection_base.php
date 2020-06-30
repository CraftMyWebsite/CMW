<?php
	/*
	Cette classe permet d'instancier automatiquement un objet PDO(qui gère la connection à la BDD).
	On utilise pour cela une classe intermédiaire "base" qui récupère / écrit / update les données sans 
	aucun traitement.
	*/
	require_once('modele/base.php');
	$base = new base($_Serveur_['DataBase']);
    $bddConnection = $base->getConnection();

?>