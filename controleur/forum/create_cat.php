<?php 

if(isset($_Joueur_) AND isset($_POST['nom']) AND isset($_POST['forum']) AND strlen($_POST['nom']) <= 40 )
{
	if(Permission::getInstance()->verifPerm('PermsForum', 'general', 'addCategorie'))
	{
		$nom = htmlspecialchars($_POST['nom']);
		$forum = htmlspecialchars($_POST['forum']);
		$img = NULL;
		if(!empty($_POST['img']) AND strlen($_POST['img']) <= 300)
		{
			if(startsWith($_POST['img'], '<i class="') && endsWith($_POST['img'], '"></i>')) {
				$img = htmlspecialchars(str_replace('<i class="', '', str_replace('"></i>', "", $_POST['img'])));
			} 
		}
		$insert = $bddConnection->prepare('INSERT INTO cmw_forum_categorie (nom, img, forum)
		VALUES (:nom, :img, :forum) ');
		$insert->execute(array(	
			'nom' => $nom,
			'img' => $img,
			'forum' => $forum
		));
		header('Location: forum');
	}
	else
		header('Location: erreur/7');
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
?>