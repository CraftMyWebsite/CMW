<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['members']['actions']['editMember'] == true) {
	$req = $bddConnection->prepare('DELETE FROM cmw_users WHERE id = :id');
	$req->execute(array(':id' => $_GET['id']));
}
?>