<?php
require('modele/forum/adminForum.class.php');
if(isset($_POST['id'], $_POST['objet'], $_Joueur_))
{
	$AdminForum = new AdminForum($bddConnection);
	if(isset($_POST['contenue']))
		$objet = htmlspecialchars($_POST['objet']);
	else
		$objet = ($_POST['objet'] == "topic") ? 1 : 2;
	$id = htmlentities($_POST['id']);
	if($AdminForum->verifEdit($objet, $id, $_Joueur_) && !isset($_POST['contenue']))
	{
		header('Location: ?page=editForum&objet='.$objet.'&id='.$id);
	}
	elseif($AdminForum->verifEdit($objet, $id, $_Joueur_) && isset($_POST['contenue']))
	{
		$contenue = htmlspecialchars($_POST['contenue']);
		if(isset($_POST['titre']))
			$titre = htmlspecialchars($_POST['titre']);
		$AdminForum->editObjet($objet, $id, $_Joueur_['pseudo'], $contenue, $id_topic, $titre);
		if($AdminForum->getErreurs($e) == 0)
		{
			header('Location: ?page='.$AdminForum->getPage(4, $id_topic));
		}
		else
		{
			header('Location: ?page=erreur&erreur=19&type='.$e['type'].'&titre='.$e['titre'].'&contenue='.$e['contenue']);
		}
	}
}
?>