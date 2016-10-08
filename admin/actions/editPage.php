<?php


	$i = 0;
	foreach($_POST as $cle => $element)
	{
		if (preg_match("#sousTitre#", $cle))
		{
			$contenuPost['sousTitre'][$i] = $element;
			$i++;
		}
	}
	$i = 0;
	foreach($_POST as $cle => $element)
	{
		if (preg_match("#message#", $cle))
		{
			$contenuPost['message'][$i] = $element;
			$i++;
		}
	}


	for($i = 0; $i < count($contenuPost['sousTitre']); $i++)
	{
		if(!isset($construction))
			$construction = $contenuPost['sousTitre'][$i] .'|;|'. $contenuPost['message'][$i];
		else
			$construction = $construction .'#µ¤#'. $contenuPost['sousTitre'][$i] .'|;|'. $contenuPost['message'][$i];
	}

	$req = $bddConnection->prepare('UPDATE cmw_pages SET titre = :titre, contenu = :contenu WHERE id = :id');
	$req->execute(array(
		'titre' => $_POST['titre'], 
		'contenu' => $construction, 
		'id' => $_GET['id']		));

?>