<?php 

if(Permission::getInstance()->verifPerm('PermsForum', 'general', 'addSousForum') AND isset($_POST['nom']) AND strlen($_POST['nom']) <= 40 AND isset($_POST['id_categorie']))
{
	$nom = htmlspecialchars($_POST['nom']);
	$id = htmlspecialchars($_POST['id_categorie']);
	$img = NULL;
		if(!empty($_POST['img']) AND strlen($_POST['img']) <= 300)
		{
			if(startsWith($_POST['img'], '<i class="') && endsWith($_POST['img'], '"></i>')) {
				$img = htmlspecialchars(str_replace('<i class="', '', str_replace('"></i>', '', $_POST['img'])));
			} 
		}


	$recup = $bddConnection->prepare('SELECT * FROM cmw_forum_categorie WHERE id = :id');
	$recup->execute(array(
		'id' => $id
	));


	$data = $recup->fetch(PDO::FETCH_ASSOC);

	$sf = $data['sousforum'] + 1;

	$update = $bddConnection->prepare('UPDATE cmw_forum_categorie SET `sous-forum` = :sousforum WHERE `id` = :id');
	

	$update->execute(array(
		'sousforum' => $sf,
		'id' => $id
	));



	$insert = $bddConnection->prepare('INSERT INTO cmw_forum_sous_forum (id_categorie, nom, img) VALUES (:id, :nom, :img) ');
	$insert->execute(array(
		'id' => $id,
		'nom' => $nom,
		'img' => $img
	));
	header('Location: index.php?page=forum_categorie&id=' .$id. '');

}
else {
	header('Location: index.php?page=erreur&erreur=0');
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