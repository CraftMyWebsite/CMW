<?php
if($_Permission_->verifPerm('PermsPanel', 'news', 'actions', 'addNews')) { 
	if(isset($_POST["pinned"])) {
		$req = $bddConnection->prepare('INSERT INTO cmw_news(titre, message, auteur, date, pinned) VALUES(:titre, :message, :auteur, UNIX_TIMESTAMP(), 1)');
		$bddConnection->query("UPDATE cmw_news SET pinned = 0");
	} else {
		$req = $bddConnection->prepare('INSERT INTO cmw_news(titre, message, auteur, date) VALUES(:titre, :message, :auteur, UNIX_TIMESTAMP())');
	}
		require('modele/app/ckeditor.class.php');
		$_POST['message'] = ckeditor::verif($_POST['message']);
		$req->execute(Array (
			'titre' => $_POST['titre'],
			'message' => $_POST['message'],
			'auteur' => $_Joueur_['pseudo'] ));
}
?>