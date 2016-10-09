<?php 


if(isset($_Joueur_) AND $_Joueur_['rang'] == 1 AND isset($_POST['nom']) AND strlen($_POST['nom']) <= 40 AND isset($_POST['desc']) AND strlen($_POST['desc']) <= 300 AND isset($_POST['id_categorie']))
{
	$nom = htmlspecialchars($_POST['nom']);
	$desc = htmlspecialchars($_POST['desc']);
	$id = htmlspecialchars($_POST['id_categorie']);
	if(!empty($_POST['img']) AND strlen($_POST['img']) <= 300 )
	{
		$img = htmlspecialchars($_POST['img']);
	}
	else
	{
		$img = NULL;
	}
	$recup = $bddConnection->prepare('SELECT * FROM cmw_forum_categorie WHERE id = :id');
	$recup->execute(array(
		'id' => $id
	));
	$data = $recup->fetch();
	$sf = $data['sous-forum'] + 1;
	$update = $bddConnection->prepare('UPDATE cmw_forum_categorie SET sous-forum = :sous-forum WHERE id = :id');
	$update->execute(array(
		'sous-forum' => $sf,
		'id' => $id
	));
	$insert = $bddConnection->prepare('INSERT INTO cmw_forum_sous_forum (id_categorie, nom, description, img) VALUES (:id, :nom, :desc, :img) ');
	$insert->execute(array(
		'id' => $id,
		'nom' => $nom,
		'desc' => $desc,
		'img' => $img
	));
	header('Location: index.php?page=forum_categorie&id=' .$id. '');
}