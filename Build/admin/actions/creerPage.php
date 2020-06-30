<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['pages']['actions']['addPage'] == true) {
	$req = $bddConnection->prepare('INSERT INTO cmw_pages(titre, contenu) VALUES(:titre, :contenu)');
	$req->execute(Array (
		'titre' => $_POST['titre'],
		'contenu' => $_POST['sousTitre'] .'|;|'. $_POST['message']		));
}
?>