<?php 
if(Permission::getInstance()->verifPerm("connect"))
{
	$id = htmlspecialchars($_GET['id']);
	$pages = htmlspecialchars($_GET['page_post']);
	$answer = htmlspecialchars($_GET['answer']);
	$insert = $bddConnection->prepare('UPDATE cmw_forum_topic_followed SET vu = 1 WHERE id_topic = :id AND pseudo = :pseudo');
	$insert->execute(array(
		'id' => $id,
		'pseudo' => $_Joueur_['pseudo']
	));
	header('Location: post/' .$id. '/' .$pages. '#' .$answer. '');
}
else
	header('Location: erreur/0');