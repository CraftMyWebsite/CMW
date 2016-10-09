<?php 

if(isset($_Joueur_) AND isset($_POST['id_answer']))
{
	$id = htmlspecialchars($_POST['id_answer']);
	$contenue = htmlspecialchars($_POST['contenue']);
	$req = $bddConnection->prepare('SELECT * FROM cmw_forum_answer WHERE id = :id');
	$req->execute(array(
		'id' => $id
	));
	$data = $req->fetch();
	if($data['contenue'] !== $contenue)
	{
		$update = $bddConnection->prepare('UPDATE cmw_forum_answer SET contenue = :contenue, d_edition = NOW() WHERE id = :id ');
		$update->execute(array(
			'contenue' => $contenue,
			'id' => $id
		));
	}
	header('Location: index.php?page=post&id=' .$data['id_topic']. '');
}