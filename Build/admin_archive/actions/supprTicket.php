<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'support', 'tickets', 'actions', 'deleteTicket')) {
	$req1 = $bddConnection->prepare('DELETE FROM cmw_support WHERE id = :id');
	$req1->execute(array(':id' => $_GET['id']));

	$req2 = $bddConnection->prepare('DELETE FROM cmw_support_commentaires WHERE id_ticket = :id_ticket');
	$req2->execute(array(':id_ticket' => $_GET['id']));
}
?>