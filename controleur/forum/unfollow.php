<?php 
if(isset($_Joueur_) AND isset($_GET['id_topic']))
{
	$id = htmlspecialchars($_GET['id_topic']);
	$unfollow = $bddConnection->prepare('DELETE FROM cmw_forum_topic_followed WHERE id_topic = :id_topic AND pseudo = :pseudo');
	$unfollow->execute(array(
		'id_topic' => $id,
		'pseudo' => $_Joueur_['pseudo']
	));
	header('Location: ' . $_Serveur_['General']['url'] . '?&page=forum');
}


?>