<?php
if($_Permission_->verifPerm('PermsPanel', 'news', 'actions', 'editNews')) {
	if(isset($_POST['pinned'])) {
		$req = $bddConnection->prepare('UPDATE cmw_news SET titre = :titre, message = :contenu, pinned = 1 WHERE id = :id');
		$bddConnection->query('UPDATE cmw_news SET pinned = 0');
	} else {
		$req = $bddConnection->prepare('UPDATE cmw_news SET titre = :titre, message = :contenu WHERE id = :id');
	}
	require('modele/app/ckeditor.class.php');
	$_POST['message'] = ckeditor::verif($_POST['message'],true);
	$req->execute(array(
		'titre' => $_POST['titre'],
		'contenu' => $_POST['message'],
		'id' => $_GET['id']));
}
?>