<?php 

if($_Joueur_['rang'] == 1 AND isset($_GET['id']))
{
	$id = htmlspecialchars($_GET['id']);
	$select = $bddConnection->prepare('SELECT * FROM cmw_forum_post WHERE id_categorie = :id');
	$select->execute(array(
		'id' => $id
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
	$d = $bddConnection->prepare('DELETE FROM cmw_forum_post WHERE id_categorie = :id');
	$d->execute(array(
		'id' => $id
	));
	$remove = $bddConnection->prepare('DELETE FROM cmw_forum_categorie WHERE id = :id');
	$remove->execute(array(
		'id' => $id
	));
	$removesf = $bddConnection->prepare('DELETE FROM cmw_forum_sous_forum WHERE id_categorie = :id');
	$removesf->execute(array(
		'id' => $id
	));
	header('Location: index.php?page=forum');
}