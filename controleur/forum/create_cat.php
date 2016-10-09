<?php 

if(isset($_Joueur_) AND isset($_POST['nom']) AND isset($_POST['forum']) AND isset($_POST['desc']) AND strlen($_POST['nom']) <= 40 AND strlen($_POST['desc']) <= 300)
{
	if($_Joueur_['rang'] == 1)
	{
		$nom = htmlspecialchars($_POST['nom']);
		$desc = htmlspecialchars($_POST['desc']);
		$forum = htmlspecialchars($_POST['forum']);
		if(!empty($_POST['img']) AND strlen($_POST['img']) <= 300)
		{
			$img = htmlspecialchars($_POST['img']);
		}
		else
		{
			$img = NULL;
		}
		$insert = $bddConnection->prepare('INSERT INTO cmw_forum_categorie (nom, img, description, forum)
		VALUES (:nom, :img, :desc, :forum) ');
		$insert->execute(array(	
			'nom' => $nom,
			'img' => $img,
			'desc' => $desc,
			'forum' => $forum
		));
		header('Location: index.php?page=forum');
	}
}
?>