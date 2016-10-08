<?php

require_once('controleur/joueur/joueur.class.php');
$globalJoueur = new Joueur();
$_Joueur_ = $globalJoueur->getArrayDonneesUtilisateur();

if($_Joueur_['rang'] == 1){
	$id = htmlspecialchars($_GET['id']);
	$etat = htmlspecialchars($_POST['etat']);

	require_once('modele/support/etat.class.php');

	$ChEtat = new etatTicket($bddConnection);
	$ChEtat->ChangeEtat($id, $etat);
}
?>