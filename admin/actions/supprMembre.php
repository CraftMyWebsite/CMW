<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['members']['actions']['editMember'] == true) { 
	$reqSuppr = $bddConnection->prepare('DELETE from cmw_users WHERE id = :id');
	$reqSuppr->execute(Array ( 'id' => $_GET['id'] ));
}
?>