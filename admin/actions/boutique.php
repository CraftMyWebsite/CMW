<?php

$lecture = new Lire('modele/config/config.yml');
$configLecture = new Lire('modele/config/config.yml');
$_Serveur_ = $configLecture->GetTableau();

require_once('modele/base.php');
$base = new base($_Serveur_['DataBase']);
$bddConnection = $base->getConnection();

$req = $bddConnection->prepare('UPDATE cmw_boutique_categories SET titre = :titre, message = :message WHERE id = :id');
$req->execute(Array (
	'titre' => $_POST['categorieNom'],
	'message' => $_POST['categorieInfo'],
	'id' => $_POST['categorie'] ));
	
$boutiqueData = GetTableau($_POST);
UpdatePourTableau($bddConnection, $boutiqueData);

GetOffresASuppr($_POST, $bddConnection);

function GetOffresASuppr($post, $bddConnection)
{
	foreach($post as $cle => $element)
	{
		if($element == 'on' AND preg_match("#suppr#", $cle))
		{
			preg_match_all('#[0-9]+#', $cle, $resultat);
			$resultat = $resultat[0][0];
			SupprOffre($resultat, $bddConnection);
		}
	}
}



function GetTableau($post)
{
	$i = 0;
	foreach($post as $cle => $element)
	{
		if (preg_match("#offresNom#", $cle))
		{
			$boutiqueData['nom'][$i] = $element;
			$i++;
		}
	}
	$i = 0;
	foreach($post as $cle => $element)
	{
		if (preg_match("#offresDescription#", $cle))
		{
			$boutiqueData['description'][$i] = $element;
			$i++;
		}
	}
	$i = 0;
	foreach($post as $cle => $element)
	{
		if (preg_match("#offresCategorie#", $cle))
		{
			$boutiqueData['categorie'][$i] = $element;
			$i++;
		}
	}
	$i = 0;
	foreach($post as $cle => $element)
	{
		if(preg_match("#offresId#", $cle))
		{
			$boutiqueData['id'][$i] = $element;
			$i++;
		}
	}
	$i = 0;
	foreach($post as $cle => $element)
	{
		if(preg_match("#offresOrdre#", $cle))
		{
			$boutiqueData['ordre'][$i] = $element;
			$i++;
		}
	}
	$i = 0;
	foreach($post as $cle => $element)
	{
		if(preg_match("#offresPrix#", $cle))
		{
			$boutiqueData['prix'][$i] = $element;
			$i++;
		}
	}
	return $boutiqueData;
}


function UpdatePourTableau($bdd, $tableau)
{
	for($i = 0;$i < count($tableau['id']);$i++)
		SetInBdd($bdd, $tableau['nom'][$i], $tableau['description'][$i], $tableau['categorie'][$i], $tableau['prix'][$i], $tableau['id'][$i], $tableau['ordre'][$i]);
}

function SetInBdd($bdd, $nom, $description, $categorie, $prix, $id, $ordre)
{
	$req = $bdd->prepare('UPDATE cmw_boutique_offres SET ordre = :ordre, nom = :nom, description = :description, prix = :prix, categorie_id = :categorie WHERE id = :id');
	$req->execute(Array (
		'id' => $id,
		'nom' => $nom,
		'description' => $description,
		'categorie' => $categorie,
		'prix' => $prix,
		'ordre' => $ordre,
		'id' => $id ));
}
function SupprOffre($id, $bdd)
{
	$req = $bdd->prepare('DELETE FROM cmw_boutique_offres WHERE id = :id');
	$req->execute(array(	'id' => $id 	));
}

?>
