<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['tickets']['actions']['deleteTicket'] == true) {
	$req = $bddConnection->prepare('DELETE FROM cmw_support WHERE id = :id');
	$req->execute(array( 'id' => $_GET['id'] ));
}
?>