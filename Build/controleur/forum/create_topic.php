<?php
if(Permission::getInstance()->verifPerm("connect"))
{
	if(!empty($_POST['nom']) AND !empty($_POST['contenue'] AND strlen($_POST['contenue']) <= 15000))
	{
		$nom = htmlspecialchars($_POST['nom']);
		$contenue = htmlspecialchars($_POST['contenue']);
		$id_categorie = htmlspecialchars($_POST['id_categorie']);
		$sous_forum = htmlspecialchars($_POST['sous-forum']);
		$pseudo = $_Joueur_['pseudo'];
		if($sous_forum == 'NULL')
		{
			$createtopic = $bddConnection->prepare('INSERT INTO cmw_forum_post (id_categorie, nom, pseudo, contenue, date_creation, sous_forum, last_answer, etat, last_answer_temps) VALUES (:id_categorie, :nom, :pseudo, :contenue, NOW(), NULL, :last_answer, 0, :last_answer_temps)');
			$createtopic->execute(array(
			'id_categorie' => $id_categorie,
			'nom' => $nom,
			'pseudo' => $pseudo,
			'contenue' => $contenue,
			'last_answer' => $pseudo,
			'last_answer_temps' => time()
			));
		}
		elseif(strlen($_POST['contenue']) > 15000){
			header('Location: ?page=erreur&erreur=20');				
		}
		else
		{
			$createtopic = $bddConnection->prepare('INSERT INTO cmw_forum_post (id_categorie, nom, pseudo, contenue, date_creation, sous_forum, last_answer, etat, last_answer_temps) VALUES (:id_categorie, :nom, :pseudo, :contenue, NOW(), :sous_forum, :last_answer, 0, :last_answer_temps)');
			$createtopic->execute(array(
			'id_categorie' => $id_categorie,
			'nom' => $nom,
			'pseudo' => $pseudo,
			'contenue' => $contenue,
			'sous_forum' => $sous_forum,
			'last_answer' => $pseudo,
			'last_answer_temps' => time()
		));
		}
		$return = $bddConnection->query('SELECT MAX(id) AS id FROM cmw_forum_post');
		$return = $return->fetch(PDO::FETCH_ASSOC);
		$follow = $bddConnection->prepare('INSERT INTO cmw_forum_topic_followed (pseudo, id_topic, last_answer) VALUES (:pseudo, :id_topic, 0) ');
		$follow->execute(array(
			'pseudo' => $_Joueur_['pseudo'],
			'id_topic' => $return['id']
		));
		header('Location: ?&page=post&id=' . $return['id'] . '');
	}
	else
		header('Location: ?page=erreur&erreur=0');
}
else
	header('Location: ?page=erreur&erreur=7');
?>
