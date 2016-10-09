<?php
if(isset($_GET['id_topic']))
{
	$id = htmlspecialchars($_GET['id_topic']);
	$req = $bddConnection->prepare('SELECT MAX(id) AS id FROM cmw_forum_answer WHERE id_topic = :id_topic');
	$req->execute(array(
		'id_topic' => $id
	));
	$reqd = $req->fetch();
	if(empty($reqd['id']))
	{
		$reqd['id'] = 0;
	}
	$follow = $bddConnection->prepare('INSERT INTO cmw_forum_topic_followed (pseudo, id_topic, last_answer) VALUES (:pseudo, :id_topic, :last_answer) ');
	$follow->execute(array(
		'pseudo' => $_Joueur_['pseudo'],
		'id_topic' => $id,
		'last_answer' => $reqd['id']
	));
	header('Location: ' . $_Serveur_['General']['url'] . '?&page=post&id=' . $id . '');
}
?>