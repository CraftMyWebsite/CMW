<?php
if(isset($_POST['choix']) AND isset($_Joueur_) AND isset($_POST['id_answer']))
{
	$like = htmlspecialchars($_POST['choix']);
	$id = htmlspecialchars($_POST['id_answer']);
	if(isset($_POST['type']))
		$type = intval($_POST['type']);
	else
		$type = 2;
	$likeadd = $bddConnection->prepare('INSERT INTO cmw_forum_like (pseudo, type, id_answer, Appreciation) VALUES (:pseudo, :type, :id_answer, :like)');
	$likeadd->execute(array(
		'pseudo' => $_Joueur_['pseudo'],
		'type' => $type,
		'id_answer' => $id,
		'like' => $like
	));
	$post = $bddConnection->prepare('SELECT id_topic FROM cmw_forum_answer WHERE id = :id');
	$post->execute(array(
		'id' => $id
	));
	$postd = $post->fetch(PDO::FETCH_ASSOC);
	if($type == 2)
		header('Location: ?&page=post&id=' . $postd['id_topic'] . '');
	else
		header('Location: ?page=post&id='.$id);
}
else
	header('Location: ?page=erreur&erreur=0');
?>