<?php 
if(isset($_Joueur_) AND ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['addForum'] == true) AND !empty($_POST['nom']))
{
	//Creation forum 
	$nom = htmlspecialchars($_POST['nom']);
	$create = $bddConnection->prepare('INSERT INTO cmw_forum (nom) VALUES (:nom)');
	$create->execute(array(
		'nom' => $nom
	));
	header('Location: ?page=forum');
}
else
	header('Location: ?page=erreur&erreur=0');