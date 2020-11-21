<?php
if($_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'addVote')) {
	$action = $_POST['action'];
	$serveur = htmlspecialchars($_POST['serveur']);
	$lien = htmlspecialchars($_POST['lien']);
	$titre = htmlspecialchars($_POST['titre']);
	$temps = htmlspecialchars($_POST['temps']);
	$idCustom =$_POST['idCustom'];
	$enligne = isset($_POST['enligne']) && !empty($_POST['enligne']) ? 1 : 0;
	if(!isset($idCustom) || empty($idCustom)) {
		$req = $bddConnection->prepare('INSERT INTO cmw_votes_config(action, serveur, lien, temps, titre, enligne) VALUES (:action, :serveur, :lien, :temps, :titre, :enligne) ');
		$req->execute(array(
			'action' => $action,
			'serveur' => $serveur,
			'lien' => $lien,
			'temps' => $temps,
			'titre' => $titre,
			'enligne' => $enligne
		));

	} else {


		$req = $bddConnection->prepare('INSERT INTO cmw_votes_config(action, serveur, lien, temps, titre, idCustom, enligne) VALUES (:action, :serveur, :lien, :temps, :titre, :idCustom, :enligne) ');
		$req->execute(array(
			'action' => $action,
			'serveur' => $serveur,
			'lien' => $lien,
			'temps' => $temps,
			'titre' => $titre,
			'idCustom' => $idCustom,
			'enligne' => $enligne
		));

	}

}
?>