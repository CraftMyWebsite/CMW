<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['news']['actions']['editNews'] == true) { 
	$req = $bddConnection->prepare('UPDATE cmw_news SET titre = :titre, message = :contenu WHERE id = :id');
	$req->execute(array(
		'titre' => $_POST['titre'],
		'contenu' => $_POST['message'],
		'id' => $_GET['id']        ));
}
?>