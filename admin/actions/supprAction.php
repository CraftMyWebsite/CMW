<?php
if($_Permission_->verifPerm('PermsPanel', 'shop', 'actions', 'editCategorieOffre')) { 
	$req = $bddConnection->prepare('DELETE FROM cmw_boutique_action WHERE id = :id');
	$req->execute(array( 'id' => $_GET['id']));
}
?>