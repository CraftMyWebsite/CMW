<?php
if(Permission::getInstance()->verifPerm('PermsForum', 'general', 'deleteCategorie'))
{
	$AdminForum = new AdminForum($bddConnection);
	$nom = htmlspecialchars($_POST['nom']);
	$icone = htmlspecialchars($_POST['icone']);
	$id = htmlentities($_POST['id']);
	$entite = htmlentities($_POST['entite']);
	$AdminForum->setNewNomForum($nom, $id, $entite, $icone);
	if($AdminForum->getErreurs($e) == 0)
	{
		$page = $AdminForum->getPage($entite+1, $id);
		header('Location: ?page='.$page);
	}
	else
	{
		header('Location: ?page=erreur&erreur=19&type='.$e['type'].'&titre='.$e['titre'].'&contenue='.$e['contenue']);
	}
}