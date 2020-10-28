<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'general', 'actions', 'editFavicon'))
{
	if(isset($_FILES['favicon']) && $_FILES['favicon']['error'] == 0)
	{
		if($_FILES['favicon']['size'] <= 500000000)
		{
			 $infosfichier = pathinfo($_FILES['favicon']['name']);
			 $extensions_fichier = $infosfichier['extension'];
			 $extension_autorisees = array('jpg', 'jpeg', 'ico', 'png', 'gif', 'bmp');
			 if(in_array($extensions_fichier, $extension_autorisees))
			 {
			 	 move_uploaded_file($_FILES['favicon']['tmp_name'], './favicon.ico');
			 	 header('Location: ?page=configsite');
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