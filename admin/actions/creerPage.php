<?php
if($_Permission_->verifPerm('PermsPanel', 'pages', 'actions', 'addPage')) {
	$req = $bddConnection->prepare('INSERT INTO cmw_pages(titre, contenu) VALUES(:titre, :contenu)');
	$req->execute(Array (
		'titre' => $_POST['titre'],
		'contenu' => $_POST['sousTitre'] .'|;|'. $_POST['message']		));
}
?>