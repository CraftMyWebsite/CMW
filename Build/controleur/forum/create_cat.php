<?php 

if(isset($_Joueur_) AND isset($_POST['nom']) AND isset($_POST['forum']) AND strlen($_POST['nom']) <= 40 )
{
	if(Permission::getInstance()->verifPerm('PermsForum', 'general', 'addCategorie'))
	{
		$nom = htmlspecialchars($_POST['nom']);
		$forum = htmlspecialchars($_POST['forum']);
		if(!empty($_POST['img']) AND strlen($_POST['img']) <= 300)
		{
			$img = htmlspecialchars($_POST['img']);
		}
		else
		{
			$img = NULL;
		}
		$insert = $bddConnection->prepare('INSERT INTO cmw_forum_categorie (nom, img, forum)
		VALUES (:nom, :img, :forum) ');
		$insert->execute(array(	
			'nom' => $nom,
			'img' => $img,
			'forum' => $forum
		));
		header('Location: index.php?page=forum');
	}
	else
		header('Location: ?page=erreur&erreur=7');
}
else
	header('Location: ?page=erreur&erreur=0');
?>