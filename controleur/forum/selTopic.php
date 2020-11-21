<?php 
if(Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'selTopic'))
{
	foreach($_POST['id'] as $value)
	{
		$id = htmlspecialchars($value);
		$idCat = htmlspecialchars($_POST['idCat']);
		if(isset($_POST['prefix']) && Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'addPrefix') && $_POST['prefix'] != 'NULL')
		{
			$prefix = htmlspecialchars($_POST['prefix']);
			$req = $bddConnection->prepare('UPDATE cmw_forum_post SET prefix = :prefix WHERE id = :id');
			$req->execute(array(
				'prefix' => $prefix,
				'id' => $id
				));
			
		}
		if(isset($_POST['epingle']) && Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'epingle'))
		{
			$epingle = htmlspecialchars($_POST['epingle']);
			$req = $bddConnection->prepare('UPDATE cmw_forum_post SET epingle = :epingle WHERE id = :id');
			$req->execute(array(
				'epingle' => $epingle,
				'id' => $id
			));
		}
		if(isset($_POST['close']) && Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'closeTopic'))
		{
			$close = htmlspecialchars($_POST['close']);
			$req = $bddConnection->prepare('UPDATE cmw_forum_post SET etat = :etat WHERE id = :id');
			$req->execute(array(
				'etat' => $close,
				'id' => $id
				));
		}
		if(isset($_POST['remove']) && $_POST['remove'] == 1 && Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'deleteTopic'))
		{
			$req = $bddConnection->prepare('DELETE FROM cmw_forum_post WHERE id = :id');
			$req->execute(array(
				'id' => $id
			));
		}
	}
	if(isset($_POST['idSF']))
	{
		$sf = htmlspecialchars($_POST['idSF']);
		header('Location: ?page=forum_categorie&id='.$idCat.'&id_sous_forum='.$sf);
	}
	else
		header('Location: ?page=forum_categorie&id='.$idCat);
}