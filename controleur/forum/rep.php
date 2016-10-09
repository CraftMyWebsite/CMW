<?php 
if(isset($_Joueur_))
{
	$id = htmlspecialchars($_GET['id']);
	$pages = htmlspecialchars($_GET['page_post']);
	$answer = htmlspecialchars($_GET['answer']);
	$insert = $bddConnection->prepare('UPDATE cmw_forum_topic_followed SET vu = 1 WHERE id_topic = :id AND pseudo = :pseudo');
	$insert->execute(array(
		'id' => $id,
		'pseudo' => $_Joueur_['pseudo']
	));
	header('Location: index.php?page=post&id=' .$id. '&page_post=' .$pages. '#' .$answer. '');
}