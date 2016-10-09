<?php 

if(isset($_GET['id_a']) AND $_Joueur_['rang'] == 1)
{
	$id = htmlspecialchars($_GET['id_a']);
	$id_t = htmlspecialchars($_GET['id']);
	$page = htmlspecialchars($_GET['page_post']);
	$req = $bddConnection->prepare('UPDATE cmw_forum_report SET vu = 1 WHERE type = 1 AND id_topic_answer = :id');
	$req->execute(array(
		'id' => $id
	));
	header('Location: index.php?page=post&id=' .$id_t. '&page_post=' .$page. '#' .$id. '');
	
}