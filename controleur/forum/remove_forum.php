<?php 
if(isset($_Joueur_) AND ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['deleteForum'] == true) AND isset($_GET['id']))
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