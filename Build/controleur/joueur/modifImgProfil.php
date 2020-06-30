<?php

if(isset($_FILES['img_profil']) AND $_FILES['img_profil']['error'] == 0)
{
	if($_FILES['img_profil']['size'] <= 1000000)
	{
		$chemin = pathinfo($_FILES['img_profil']['name']);
		$extensionFichier = $chemin['extension'];
		$extension_autorisees = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'ico');
		if(in_array($extensionFichier, $extension_autorisees))
		{
			$Img = new ImgProfil($_Joueur_['id']);
			if(file_exists('utilisateurs/'.$_Joueur_['id']))
			{
				$extension = $Img->getExtension();
				unlink('utilisateurs/'.$_Joueur_['id'].'/profil.'.$extension);
				move_uploaded_file($_FILES['img_profil']['tmp_name'], 'utilisateurs/'.$_Joueur_['id'].'/profil.'.$extensionFichier);
				$Img->redefineExt($extensionFichier);
			}
			else
			{
				mkdir('utilisateurs/'.$_Joueur_['id']);
				move_uploaded_file($_FILES['img_profil']['tmp_name'], 'utilisateurs/'.$_Joueur_['id'].'/profil.'.$extensionFichier);
				$Img->redefineExt($extensionFichier);
			}
			header('Location: ?page=profil&profil='.$_Joueur_['pseudo'].'&success=image');
		}
		else
			header('Location: ?page=profil&profil='.$_Joueur_['pseudo'].'&erreur=6');
	}
	else
		header('Location: ?page=profil&profil='.$_Joueur_['pseudo'].'&erreur=7');
}
else
	header('Location: ?page=profil&profil='.$_Joueur_['pseudo'].'&erreur=8');

?>