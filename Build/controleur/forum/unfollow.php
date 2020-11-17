<?php 
if(Permission::getInstance()->verifPerm("connect") AND isset($_GET['id_topic']))
{
	$id = htmlspecialchars($_GET['id_topic']);
	$unfollow = $bddConnection->prepare('DELETE FROM cmw_forum_topic_followed WHERE id_topic = :id_topic AND pseudo = :pseudo');
	$unfollow->execute(array(
		'id_topic' => $id,
		'pseudo' => $_Joueur_['pseudo']
	));
	header('Location: ?&page=forum');
}
else
	header('Location: ?page=erreur&erreur=0');

?>