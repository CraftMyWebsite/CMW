<?php 

if($_Joueur_['rang'] == 1 AND isset($_GET['id_cat'], $_GET['id_sf']))
{
	$id_cat = htmlspecialchars($_GET['id_cat']);
	$id_sf = htmlspecialchars($_GET['id_sf']);
	$select = $bddConnection->prepare('SELECT * FROM cmw_forum_post 
	WHERE id_categorie = :id_cat AND sous_forum = :id_sf ');
	$select->execute(array(
		'id_cat' => $id_cat,
		'id_sf' => $id_sf
	));
	$data = $select->fetchAll();
	foreach($data as $key => $value)
	{
		unset($delete);
		$delete = $bddConnection->prepare('DELETE FROM cmw_forum_answer WHERE id_topic = :id');
		$delete->execute(array(
			'id' => $data[$key]['id']
		));
	}
	$d = $bddConnection->prepare('DELETE FROM cmw_forum_post WHERE id_categorie = :id_cat AND sous_forum = :id_sf ');
	$d->execute(array(
		'id_cat' => $id_cat,
		'id_sf' => $id_sf
	));
	$remove = $bddConnection->prepare('DELETE FROM cmw_forum_sous_forum WHERE id = :id');
	$remove->execute(array(
		'id' => $id_sf
	));
	header('Location: index.php?page=forum_categorie&id=' .$id_cat. '');
}