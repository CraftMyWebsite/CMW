<?php 

if(isset($_POST['id_topic']) AND Permission::getInstance()->verifPerm("connect"))
{
	$id = htmlspecialchars($_POST['id_topic']);
	$pseudo = htmlspecialchars($_Joueur_['pseudo']);
	if(isset($_POST['reason']))
	{
		$reason = htmlspecialchars($_POST['reason']);
	}
	else
	{
		$reason = "Aucune / Non Renseigné";
	}
	$select = $bddConnection->prepare('SELECT * FROM cmw_forum_post WHERE id = :id');
	$select->execute(array(
		'id' => $id
	));
	$data = $select->fetch(PDO::FETCH_ASSOC);
	
	if($data['pseudo'] == $pseudo or Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'deleteTopic'))
	{
		$rcount = $bddConnection->prepare('SELECT * FROM cmw_forum_answer WHERE id_topic = :id');
		$rcount->execute(array(
			'id' => $id
		));
		$count = $rcount->rowCount();
		$insert = $bddConnection->prepare('INSERT INTO cmw_forum_topic_removed (nom, nb_reponse, 
		auteur_topic, date_creation, raison, date_suppression, auteur_suppression) VALUES (:nom,
		:nb_reponse, :auteur_topic, :date_creation, :raison, NOW(), :auteur_suppression) ');
		$insert->execute(array(
			'nom' => $data['nom'],
			'nb_reponse' => $count,
			'auteur_topic' => $data['pseudo'],
			'date_creation' => $data['date_creation'],
			'raison' => $reason,
			'auteur_suppression' => $pseudo
		));
		$remove = $bddConnection->prepare('DELETE FROM cmw_forum_post WHERE id = :id');
		$remove->execute(array(
			'id' => $id 
		));
		$delete = $bddConnection->prepare('DELETE FROM cmw_forum_answer WHERE id_topic = :id');
		$delete->execute(array(
			'id' => $id
		));
		if(isset($data['sous_forum']))
			header('Location: ?page=forum_categorie&id='.$data['id_categorie'].'&id_sous_forum='.$data['sous_forum']);
		else
			header('Location: ?page=forum_categorie&id='.$data['id_categorie']);
	} else {
		header('Location: ?page=erreur&erreur=7');
	}
}
else
	header('Location: ?page=erreur&erreur=16');
