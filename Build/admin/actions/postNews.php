<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['news']['actions']['addNews'] == true) { 
	if(isset($_POST["pinned"])) {
		$req = $bddConnection->prepare('INSERT INTO cmw_news(titre, message, auteur, date, pinned) VALUES(:titre, :message, :auteur, UNIX_TIMESTAMP(), 1)');
		$bddConnection->query("UPDATE cmw_news SET pinned = 0");
	} else {
		$req = $bddConnection->prepare('INSERT INTO cmw_news(titre, message, auteur, date) VALUES(:titre, :message, :auteur, UNIX_TIMESTAMP())');
	}
		$req->execute(Array (
			'titre' => $_POST['titre'],
			'message' => $_POST['message'],
			'auteur' => $_Joueur_['pseudo'] ));
}
?>