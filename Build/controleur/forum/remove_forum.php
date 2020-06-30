<?php 
if(Permission::getInstance()->verifPerm('PermsForum', 'general', 'deleteForum') AND isset($_GET['id']))
{
	$id = htmlspecialchars($_GET['id']);
	$remove = $bddConnection->prepare('DELETE FROM cmw_forum WHERE id = :id');
	$remove->execute(array(
		'id' => $id
	));
	header('Location: ?page=forum');
}
elseif(!isset($_Joueur_))
{
	header('Location: ?page=erreur&erreur=16');
}
elseif($_Joueur_ != 1)
{
	header('Location: ?page=erreur&erreur=7');
}
else
{
	header('Location: ?page=erreur&erreur=0'); 
}