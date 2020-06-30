<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['tickets']['actions']['editEtatTicket'] == true) {
	$req = $bddConnection->prepare('UPDATE cmw_support SET etat = :etat WHERE id = :id');
	$req->execute(array (
		'etat' => $_POST['etat'],
		'id' => $_GET['id'],
		));
}
?>