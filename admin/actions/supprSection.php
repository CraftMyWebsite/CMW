
<?php
$req = $bddConnection->prepare('SELECT * FROM cmw_pages WHERE id = :id');
$req->execute(array('id' => $_GET['page'] ));
$donnees = $req->fetch();

$construction = $donnees['contenu'];
$construction = explode('#µ¤#', $construction);

unset($construction[$_GET['id']]);

for($i = 0; $i < count($construction); $i++)
{
	if(!isset($contenu))
		$contenu = $construction[0];
	else 
		$contenu = $contenu .'#µ¤#'. $construction[$i];
}

if(empty($contenu) OR $contenu == null)
{
    $req = $bddConnection->prepare('DELETE FROM cmw_pages WHERE id = :id');
    $req->execute(array('id' => $_GET['page']));
}
else
{
    $req = $bddConnection->prepare('UPDATE cmw_pages SET contenu = :contenu WHERE id = :id');
    $req->execute(array('contenu' => $contenu, 'id' => $_GET['page']));
}
?>
