<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'news', 'actions', 'editNews')) {
	if(isset($_POST["pinned"])) {
		$req = $bddConnection->prepare('UPDATE cmw_news SET titre = :titre, message = :contenu, pinned = 1 WHERE id = :id');
		$bddConnection->query("UPDATE cmw_news SET pinned = 0");
	} else {
		$req = $bddConnection->prepare('UPDATE cmw_news SET titre = :titre, message = :contenu WHERE id = :id');
	}
	$req->execute(array(
		'titre' => $_POST['titre'],
		'contenu' => $_POST['message'],
		'id' => $_GET['id']        ));
}
?>