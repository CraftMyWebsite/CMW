<?php
if(isset($_POST['choix']) AND isset($_Joueur_) AND isset($_POST['id_answer']))
{
	$like = htmlspecialchars($_POST['choix']);
	$id = htmlspecialchars($_POST['id_answer']);
	$likeadd = $bddConnection->prepare('INSERT INTO cmw_forum_like (pseudo, id_answer, Appreciation) VALUES (:pseudo, :id_answer, :like)');
	$likeadd->execute(array(
		'pseudo' => $_Joueur_['pseudo'],
		'id_answer' => $id,
		'like' => $like
	));
	$post = $bddConnection->prepare('SELECT id_topic FROM cmw_forum_answer WHERE id = :id');
	$post->execute(array(
		'id' => $id
	));
	$postd = $post->fetch();
	header('Location: ' . $_Serveur_['General']['url'] . '?&page=post&id=' . $postd['id_topic'] . '');
}