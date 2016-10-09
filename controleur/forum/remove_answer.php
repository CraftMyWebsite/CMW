<?php 

if(isset($_POST['id_answer']) AND isset($_Joueur_) AND isset($_POST['page']))
{
	$id = htmlspecialchars($_POST['id_answer']);
	$pseudo = htmlspecialchars($_Joueur_['pseudo']);
	$page = htmlspecialchars($_POST['page']);
	if(isset($_POST['reason']))
	{
		$reason = htmlspecialchars($_POST['reason']);
	}
	else 
	{
		$reason = "Aucune/Non renseigné";
	}
	$select = $bddConnection->prepare('SELECT * FROM cmw_forum_answer WHERE id = :id');
	$select->execute(array(
		'id' => $id
	));
	$data = $select->fetch();
	$insert = $bddConnection->prepare('INSERT INTO cmw_forum_answer_removed (id_answer, id_topic, 
	auteur_answer, date_creation, Raison, date_suppression, auteur_suppression) VALUES (:id_answer, :id_topic, :auteur_answer, 
	:date_creation, :raison, NOW(), :auteur_suppression) ');
	$insert->execute(array(
		'id_answer' => $id,
		'id_topic' => $data['id_topic'],
		'auteur_answer' => $data['pseudo'],
		'date_creation' => $data['date_post'],
		'raison' => $reason,
		'auteur_suppression' => $pseudo
	));
	$remove = $bddConnection->prepare('DELETE FROM cmw_forum_answer WHERE id = :id');
	$remove->execute(array(
		'id' => $id,
	));
	header('Location: ?page=post&id=' .$data['id_topic']. '&page_post=' .$page. '');
}
else 
{
	header('Location: ?erreur=1');
}