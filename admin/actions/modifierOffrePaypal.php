<?php
$req = $bddConnection->prepare('UPDATE cmw_jetons_paypal_offres SET nom = :nom, description =:description, prix = :prix, jetons_donnes = :jetons_donnes WHERE id = :id');
$req->execute(array (
	'nom' => $_POST['nom'],
	'description' => $_POST['description'],
	'prix' => $_POST['prix'],
	'jetons_donnes' => $_POST['jetons_donnes'],
	'id' => $_GET['id'],
	))
?>