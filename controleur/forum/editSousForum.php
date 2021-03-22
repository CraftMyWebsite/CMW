<?php 
require('modele/forum/forum.class.php');
$_Forum_ = new Forum($bddConnection);
$sousforumd = $_Forum_->infosSousForum($_POST['id'], 1); 
if (((Permission::getInstance()->verifPerm("createur") or Permission::getInstance()->verifPerm('PermsDefault', 'forum', 'perms') >= $sousforumd[$_POST['index']]['perms']) and !$_SESSION['mode']) or $sousforumd[$_POST['index']]['perms'] == 0) { 


		$nom = htmlspecialchars($_POST['nom']);
		$img = NULL;
		if(!empty($_POST['img']) AND strlen($_POST['img']) <= 300)
		{
			if(startsWith($_POST['img'], '<i class="') && endsWith($_POST['img'], '"></i>')) {
				$img = htmlspecialchars(str_replace('<i class="', '', str_replace('"></i>', "", $_POST['img'])));
			} 
		}
		$insert = $bddConnection->prepare('UPDATE cmw_forum_sous_forum SET nom=:nom, img=:img WHERE id=:id');
		$insert->execute(array(	
			'nom' => $nom,
			'img' => $img,
			'id' => $_POST['idSF']
		));

	header('Location: sous_forum_categorie/'.$_POST['id']);
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