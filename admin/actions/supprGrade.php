<?php
if($_Permission_->verifPerm('createur')) {

	$id = intval($_GET['id']);

	$req_derank = $bddConnection->prepare('UPDATE cmw_users SET rang = 0 WHERE rang = :id');
	$req_derank->execute(array( ':id' => $id));

	$req_derank = $bddConnection->prepare('DELETE FROM cmw_grades WHERE id = :id');
	$req_derank->execute(array( ':id' => $id));
}	
?>