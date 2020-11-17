<?php
if($_Permission_->verifPerm('PermsPanel', 'shop', 'actions', 'addCategorie')) {
	$_POST['number'] = intval($_POST['number']);
	$req = $bddConnection->prepare('INSERT INTO cmw_boutique_categories(titre, message, ordre, serveur, connection, showNumber) VALUES(:titre, :message, :ordre, :serveur, :connection, :show)');
	require('modele/app/ckeditor.class.php');
	$_POST['message'] = ckeditor::verif($_POST['message']);
	$req->execute(Array(
		'titre' => $_POST['titre'],
		'message' => $_POST['message'],
		'ordre' => $_POST['ordre'],
		'serveur' => $_POST['serveur'],
		'connection' => $_POST['connection'],
		'show' => $_POST['number'] ));
}
?>