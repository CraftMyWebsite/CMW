<?php 
if(isset($_Joueur_) AND $_Joueur_['rang'] == 1 AND !empty($_POST['nom']))
{
	//Creation forum 
	$nom = htmlspecialchars($_POST['nom']);
	$create = $bddConnection->prepare('INSERT INTO cmw_forum (nom) VALUES (:nom)');
	$create->execute(array(
		'nom' => $nom
	));
	header('Location: ?page=forum');
}