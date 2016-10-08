<?php
$req = $bddConnection->prepare('INSERT INTO cmw_boutique_categories(titre, message, ordre, serveur, connection) VALUES(:titre, :message, :ordre, :serveur, :connection)');
$req->execute(Array(
	'titre' => $_POST['titre'],
	'message' => $_POST['message'],
	'ordre' => $_POST['ordre'],
	'serveur' => $_POST['serveur'],
	'connection' => $_POST['connection'] ));
?>