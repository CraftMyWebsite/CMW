<?php
if(isset($_Joueur_))
{
	if(isset($_POST['id_topic']) AND isset($_POST['contenue']) AND strlen($_POST['contenue']) <= 10000)
	{
		$id = (int)htmlspecialchars($_POST['id_topic']);
		$contenue = htmlspecialchars($_POST['contenue']);
		$req = $bddConnection->prepare("SELECT id, pseudo, contenue, date_post FROM cmw_forum_answer WHERE id_topic = :id_topic ORDER BY ID DESC LIMIT 1");
		$req->execute(array("id_topic" => $id));
		$d = $req->fetch(PDO::FETCH_ASSOC);
		if($d["pseudo"] == $_Joueur_["pseudo"] AND !(strtotime($d['date_post'])+24*3600 <= time()))
		{
			$contenu = $d["contenue"] ."[hr]Contenu fusionné[hr]". $contenue;
			$req = $bddConnection->prepare("UPDATE cmw_forum_answer SET contenue = :contenu, date_post = NOW() WHERE id = :id");
			$req->execute(array("contenu" => $contenu, "id" => $d["id"]));
		} else {
			$post_answer = $bddConnection->prepare('INSERT INTO cmw_forum_answer (id_topic, pseudo, contenue, date_post) VALUES (:id_topic, :pseudo, :contenue, NOW())');
			$post_answer->execute(array(
				'id_topic' => $id,
				'pseudo' => $_Joueur_['pseudo'],
				'contenue' => $contenue
			));
		}
		
		$id_answer = $bddConnection->prepare('SELECT MAX(id) AS id FROM cmw_forum_answer WHERE id_topic = :id');
		$id_answer->execute(array(
			'id' => $id
		));
		$id_answerd = $id_answer->fetch(PDO::FETCH_ASSOC);
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
		$add_answer = $bddConnection->prepare('UPDATE cmw_forum_post SET last_answer = :last_answer, last_answer_temps = :temps WHERE id = :id');
		$add_answer->execute(array( 
			'last_answer' => $_Joueur_['pseudo'],
			'temps' => time(),
			'id' => $id
		));
		$topic_lu = $bddConnection->prepare('UPDATE cmw_forum_lu SET vu = 0 WHERE id_topic = :id AND pseudo != :pseudo');
		$topic_lu->execute(array(
			'id' => $id,
			'pseudo' => $_Joueur_['pseudo']
		));
		header('Location: ' . $_Serveur_['General']['url'] . '?&page=post&id=' . $id . '');
	}
	else
		header('Location: ?page=erreur&erreur=0');
}
else
	header('Location: ?page=erreur&erreur=16');
?>