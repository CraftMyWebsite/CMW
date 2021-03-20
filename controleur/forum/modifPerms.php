<?php 
if(Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'setPerms'))
{
	if(isset($_POST['perms'], $_POST['id']))
	{
		$AdminForum = new AdminForum($bddConnection);
		$perms = htmlentities($_POST['perms']);
		$id = htmlentities($_POST['id']);
		if($entite == 1 )
		{
			$AdminForum->setNewsPermsForum($id, $perms);
		}
		elseif($entite == 2)
		{
			$AdminForum->setNewsPermsCategorie($id, $perms);

		}
		elseif($entite == 3)
		{
			$AdminForum->setNewsPermsSousForum($id, $perms);
		}
		elseif($entite == 4)
		{
			$AdminForum->setNewsPermsTopic($id, $perms);
		}
		else
		{
			header('Location: erreur/17');
		}
		if($AdminForum->getErreurs($e) == 0)
		{
			$page = $AdminForum->getPage($entite, $id);
			header('Location: '.$page);
		}
		else
		{
			header('Location: erreur/19/'.$e['type'].'/'.$e['titre'].'/'.$e['contenue']);
		}
	}
	else
		header('Location: erreur/0');
}
else
	header('Location: erreur/7');

/*
		DOC :

	-Entités : 
		- 1 -> Forum
		- 2 -> Categorie
		- 3 -> sous-forum (sous-categorie si on suit la logique)
		- 4 -> topics
		- Autre -> ERREURS
*/
?>