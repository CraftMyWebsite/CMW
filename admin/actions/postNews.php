<?php
$req = $bddConnection->prepare('INSERT INTO cmw_news(titre, message, auteur, date) VALUES(:titre, :message, :auteur, UNIX_TIMESTAMP())');
$req->execute(Array (
	'titre' => $_POST['titre'],
	'message' => $_POST['message'],
	'auteur' => $_Joueur_['pseudo'] ));

?>