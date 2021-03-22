<?php 
if(isset($_Joueur_) && Permission::getInstance()->verifPerm('PermsForum', 'general', 'deleteCategorie') && isset($_GET['id']) && isset($_GET['lock']))
{
	$id = htmlspecialchars($_GET['id']);
	$close = htmlspecialchars($_GET['lock']);
	if(is_numeric($close))
	{
		$update = $bddConnection->prepare('UPDATE cmw_forum_categorie SET close = :close WHERE id = :id');
		$update->execute(array(
			'close' => $close,
			'id' => $id
		));
		header('Location: forum');
	}
	else
		header('Location: erreur/17');
}
else
	header('Location: erreur/0');
?>