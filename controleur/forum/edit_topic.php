<?php 

if(isset($_POST['id_topic']) && isset($_Joueur_))
{
	$id = htmlspecialchars($_POST['id_topic']);
	$contenue = htmlspecialchars($_POST['contenue']);
	$req = $bddConnection->prepare('SELECT * FROM cmw_forum_post WHERE id = :id');
	$req->execute(array(
		'id' => $id
	));
	$data = $req->fetch();
	if($data['contenue'] !== $contenue)
	{
		$update = $bddConnection->prepare('UPDATE cmw_forum_post SET contenue = :contenue, d_edition = NOW() WHERE id = :id');
		$update->execute(array(
			'contenue' => $contenue,
			'id' => $id
		));
	}
	header('Location: index.php?page=post&id=' .$id. '');
}