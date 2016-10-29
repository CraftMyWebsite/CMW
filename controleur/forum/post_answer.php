<?php
if(isset($_Joueur_))
{
	if(isset($_POST['id_topic']) AND isset($_POST['contenue']) AND strlen($_POST['contenue']) <= 10000)
	{
		$id = htmlspecialchars($_POST['id_topic']);
		$contenue = htmlspecialchars($_POST['contenue']);
		$post_answer = $bddConnection->prepare('INSERT INTO cmw_forum_answer (id_topic, pseudo, contenue, date_post) VALUES (:id_topic, :pseudo, :contenue, NOW())');
		$post_answer->execute(array(
			'id_topic' => $id,
			'pseudo' => $_Joueur_['pseudo'],
			'contenue' => $contenue
		));
		$id_answer = $bddConnection->prepare('SELECT MAX(id) AS id FROM cmw_forum_answer WHERE id_topic = :id');
		$id_answer->execute(array(
			'id' => $id
		));
		$id_answerd = $id_answer->fetch();
		if(empty($id_answerd['id']))
		{
			$id_answerd['id'] = 0;
		}
		$followadd = $bddConnection->prepare('INSERT INTO cmw_forum_topic_followed (pseudo, id_topic, last_answer) VALUES (:pseudo, :id_topic, :last_answer)');
		$followadd->execute(array(
			'pseudo' => $_Joueur_['pseudo'],
			'id_topic' => $id,
			'last_answer' => $id_answerd['id']
		));
		$modif = $bddConnection->prepare('UPDATE cmw_forum_topic_followed SET vu = 0, new = 0 WHERE id_topic = :id AND pseudo != :pseudo');
		$modif->execute(array(
			'id' => $id,
			'pseudo' => $_Joueur_['pseudo']
		));
		$add_answer = $bddConnection->prepare('UPDATE cmw_forum_post SET last_answer = :last_answer WHERE id = :id');
		$add_answer->execute(array( 
			'last_answer' => $_Joueur_['pseudo'],
			'id' => $id
		));
		$topic_lu = $bddConnection->prepare('UPDATE cmw_forum_lu SET vu = 0 WHERE id_topic = :id AND pseudo != :pseudo');
		$topic_lu->execute(array(
			'id' => $id,
			'pseudo' => $_Joueur_['pseudo']
		));
		header('Location: ' . $_Serveur_['General']['url'] . '?&page=post&id=' . $id . '');
	}
}
?>