<?php 

if(isset($_GET['id']) AND Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'seeSignalement'))
{
	$id = htmlspecialchars($_GET['id']);
	$update = $bddConnection->prepare('UPDATE cmw_forum_report SET vu = 1 WHERE id_topic_answer = :id AND type = 0');
	$update->execute(array(
		'id' => $id,
	));
	header('Location: index.php?page=post&id=' .$id. '');
}
else
	header('Location: ?page=erreur&erreur=0');

?>