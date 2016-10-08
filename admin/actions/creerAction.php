<?php
$req = $bddConnection->prepare('INSERT INTO cmw_boutique_action(methode, commande_valeur, duree, id_offre) VALUES(:methode, :commande_valeur, :duree, :id_offre)');
$req->execute(Array (
	'methode' => $_POST['methode'],
	'commande_valeur' => $_POST['valeur'],
	'duree' => $_POST['duree'],
	'id_offre' => $_POST['id_offre'], ));
?>