<?php 
if(isset($_Joueur_))
{
	$id_answer = htmlspecialchars($_GET['id_answer']);
	$likeur = htmlspecialchars($_GET['likeur']);
	$id = htmlspecialchars($_GET['id']);
	$pages = htmlspecialchars($_GET['page_post']);
	$insert = $bddConnection->prepare('UPDATE cmw_forum_like SET vu = 1 WHERE id_answer = :id AND pseudo = :pseudo');
	$insert->execute(array(
		'id' => $id_answer,
		'pseudo' => $likeur
	));
	header('Location: index.php?page=post&id=' .$id. '&page_post=' .$pages. '#' .$id_answer. '');
}

?>