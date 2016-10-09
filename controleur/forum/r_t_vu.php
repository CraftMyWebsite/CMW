<?php 

if(isset($_GET['id']) AND $_Joueur_['rang'] == 1)
{
	$id = htmlspecialchars($_GET['id']);
	$update = $bddConnection->prepare('UPDATE cmw_forum_report SET vu = 1 WHERE id_topic_answer = :id AND type = 0');
	$update->execute(array(
		'id' => $id,
	));
	header('Location: index.php?page=post&id=' .$id. '');
}
?>