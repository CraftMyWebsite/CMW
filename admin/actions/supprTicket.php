<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['tickets']['actions']['deleteTicket'] == true) {
	$req1 = $bddConnection->prepare('DELETE FROM cmw_support WHERE id = :id');
	$req1->execute(array(':id' => $_GET['id']));

	$req2 = $bddConnection->prepare('DELETE FROM cmw_support_commentaires WHERE id_ticket = :id_ticket');
	$req2->execute(array(':id_ticket' => $_GET['id']));
}
?>