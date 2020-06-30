<?php 


if(isset($_Joueur_) AND ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['addSousForum'] == true) AND isset($_POST['nom']) AND strlen($_POST['nom']) <= 40 AND isset($_POST['id_categorie']))
{
	$nom = htmlspecialchars($_POST['nom']);
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
	$data = $recup->fetch(PDO::FETCH_ASSOC);
	$sf = $data['sous-forum'] + 1;
	$update = $bddConnection->prepare('UPDATE cmw_forum_categorie SET sous-forum = :sous-forum WHERE id = :id');
	$update->execute(array(
		'sous-forum' => $sf,
		'id' => $id
	));
	$insert = $bddConnection->prepare('INSERT INTO cmw_forum_sous_forum (id_categorie, nom, img) VALUES (:id, :nom, :img) ');
	$insert->execute(array(
		'id' => $id,
		'nom' => $nom,
		'img' => $img
	));
	header('Location: index.php?page=forum_categorie&id=' .$id. '');
}
else
	header('Location: ?page=erreur&erreur=0');