<?php 
if(isset($_Joueur_))
{
	if(!empty($_POST['nom']) AND !empty($_POST['description']) AND !empty($_POST['contenue']))
	{
		$nom = htmlspecialchars($_POST['nom']);
		$description = htmlspecialchars($_POST['description']);
		$contenue = htmlspecialchars($_POST['contenue']);
		$id_categorie = htmlspecialchars($_POST['id_categorie']);
		$sous_forum = htmlspecialchars($_POST['sous-forum']);
		$pseudo = $_Joueur_['pseudo'];
		if($sous_forum == 'NULL')
		{
		$createtopic = $bddConnection->prepare('INSERT INTO cmw_forum_post (id_categorie, nom, pseudo, description, contenue, date_creation, sous_forum, last_answer, etat) VALUES (:id_categorie, :nom, :pseudo, :description, :contenue, NOW(), NULL, :last_answer, 0)');
		$createtopic->execute(array(
		'id_categorie' => $id_categorie,
		'nom' => $nom,
		'pseudo' => $pseudo,
		'description' => $description,
		'contenue' => $contenue,
		'last_answer' => $pseudo
		));
		}
		else
		{
		$createtopic = $bddConnection->prepare('INSERT INTO cmw_forum_post (id_categorie, nom, pseudo, description, contenue, date_creation, sous_forum, last_answer, etat) VALUES (:id_categorie, :nom, :pseudo, :description, :contenue, NOW(), :sous_forum, :last_answer, 0)');
		$createtopic->execute(array(
		'id_categorie' => $id_categorie,
		'nom' => $nom,
		'pseudo' => $pseudo,
		'description' => $description,
		'contenue' => $contenue,
		'sous_forum' => $sous_forum,
		'last_answer' => $pseudo
		));
		}
		$return = $bddConnection->query('SELECT MAX(id) AS id FROM cmw_forum_post');
		$return = $return->fetch();
		$follow = $bddConnection->prepare('INSERT INTO cmw_forum_topic_followed (pseudo, id_topic, last_answer) VALUES (:pseudo, :id_topic, 0) ');
		$follow->execute(array(
			'pseudo' => $_Joueur_['pseudo'],
			'id_topic' => $return['id']
		));
		header('Location: ' . $_Serveur_['General']['url'] . '?&page=post&id=' . $return['id'] . '');
	}
	else
	{
	?><div class="alert alert-info" role="alert">Il manque des infos </div><?php
	}
}
else 
{
	?><div class="alert alert-danger" role="alert">Non connecté ! </div><?php
}
?>