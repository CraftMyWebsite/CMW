<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['shop']['actions']['editCategorieOffre'] == true) { 
	$req = $bddConnection->prepare('DELETE FROM cmw_boutique_action WHERE id = :id');
	$req->execute(array( 'id' => $_GET['id']));
}
?>