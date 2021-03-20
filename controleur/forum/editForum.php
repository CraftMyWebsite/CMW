<?php if (Permission::getInstance()->verifPerm('PermsForum', 'general', 'deleteCategorie') and !$_SESSION['mode']) { 

		$nom = htmlspecialchars($_POST['nom']);
		$forum = htmlspecialchars($_POST['forum']);
		$img = NULL;
		if(!empty($_POST['img']) AND strlen($_POST['img']) <= 300)
		{
			if(startsWith($_POST['img'], '<i class="') && endsWith($_POST['img'], '"></i>')) {
				$img = htmlspecialchars(str_replace('<i class="', '', str_replace('"></i>', "", $_POST['img'])));
			} 
		}
		$insert = $bddConnection->prepare('UPDATE cmw_forum_categorie SET nom=:nom, img=:img, forum=:forum WHERE id=:id');
		$insert->execute(array(	
			'nom' => $nom,
			'img' => $img,
			'forum' => $forum,
			'id' => $_POST['id']
		));

	header('Location: forum');
}
else
{
	header('Location: erreur/0');
}
function startsWith ($string, $startString) 
{ 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
} 
  
function endsWith($string, $endString) 
{ 
    $len = strlen($endString); 
    if ($len == 0) { 
        return true; 
    } 
    return (substr($string, -$len) === $endString); 
} 