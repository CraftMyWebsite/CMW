<?php 
if(Permission::getInstance()->verifPerm('PermsForum', 'general', 'deleteForum') AND isset($_GET['id']))
{
	$id = htmlspecialchars($_GET['id']);
	$remove = $bddConnection->prepare('DELETE FROM cmw_forum WHERE id = :id');
	$remove->execute(array(
		'id' => $id
	));
	header('Location: forum');
}
elseif(!isset($_Joueur_))
{
	header('Location: erreur/16');
}
elseif($_Joueur_ != 1)
{
	header('Location: erreur/7');
}
else
{
	header('Location: erreur/0'); 
}