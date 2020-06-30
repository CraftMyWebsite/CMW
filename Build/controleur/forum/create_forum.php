<?php 
if(isset($_Joueur_) AND ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['addForum'] == true) AND !empty($_POST['nom']))
{
	//Creation forum 
	$nom = htmlspecialchars($_POST['nom']);
	$ordreReq = $bddConnection->query('SELECT MAX(ordre) AS ordre FROM cmw_forum');
	$ordreData = $ordreReq->fetch(PDO::FETCH_ASSOC);
	$ordre = $ordreData['ordre'];
	$create = $bddConnection->prepare('INSERT INTO cmw_forum (nom, ordre) VALUES (:nom, :ordre)');
	$create->execute(array(
		'nom' => $nom,
		'ordre' => $ordre+1
	));
	header('Location: ?page=forum');
}
else
	header('Location: ?page=erreur&erreur=0');