<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'forum', 'actions', 'addSmiley'))
{
	if(isset($_FILES['image']) && $_FILES['image']['error'] == 0 && isset($_POST['symbole']))
	{
		if($_FILES['image']['size'] <= 20000)
		{
			 $infosfichier = pathinfo($_FILES['image']['name']);
			 $extensions_fichier = $infosfichier['extension'];
			 $extension_autorisees = array('jpg', 'jpeg', 'ico', 'png', 'gif', 'bmp');
			 if(in_array($extensions_fichier, $extension_autorisees))
			 {
			 	$nom = htmlspecialchars($_POST['symbole']);
			 	move_uploaded_file($_FILES['image']['tmp_name'], 'theme/smileys/'.$nom.'.gif');
			 	$addSmileyReq = $bddConnection->prepare('INSERT INTO cmw_forum_smileys (symbole, image) VALUES (:symbole, :image)');
			 	$addSmileyReq->execute(array('symbole' => $nom,
			 								'image' => 'theme/smileys/'.$nom.'.gif'
			 	));
			 }
			 else
			 	 header('Location: ?erreur=3');
		}
		else
			header('Location: ?erreur=2');
	}
	else
		header('Location: ?erreur=1');
}