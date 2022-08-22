<?php 
function createtopic($nom, $description, $contenue, $id_categorie, $sous_forum, $pseudo)
{
	if($sous_forum == 'NULL')
	{
		$createtopic = $bddConnection->prepare('INSERT INTO cmw_forum_post (id_categorie, nom, pseudo, description, contenue, date_creation, sous_forum, last_answer, etat) VALUES (:id_categorie, :nom, :pseudo, :description, :contenue, NOW(), NULL, :last_answer, 1)');
		$createtopic->execute(array(
		'id_categorie' => $id_categorie,
		'nom' => $nom,
		'pseudo' => $pseudo,
		'description' => $description,
		'contenue' => $contenue,
		'last_answer' => $pseudo
		));
	}
	else
	{
		$createtopic = $bddConnection->prepare('INSERT INTO cmw_forum_post (id_categorie, nom, pseudo, description, contenue, date_creation, sous_forum, last_answer, etat) VALUES (:id_categorie, :nom, :pseudo, :description, :contenue, NOW(), :sous_forum, :last_answer, 1)');
		$createtopic->execute(array(
		'id_categorie' => $id_categorie,
		'nom' => $nom,
		'pseudo' => $pseudo,
		'description' => $description,
		'contenue' => $contenue,
		'sous_forum' => $sous_forum,
		'last_answer' => $pseudo
		));
	}
}
function change_etat($id, $etat)
{
	$change_etat = $bddConnection->prepare('UPDATE cmw_forum_post SET etat = :etat WHERE id = :id');
	$change_etat->execute(array(
		'etat' => $etat,
		'id' => $id
	));
}

?>