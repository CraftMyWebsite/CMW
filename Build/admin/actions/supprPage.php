<?php
if($_Permission_->verifPerm('PermsPanel', 'pages', 'actions', 'editPage')) {
	$req = $bddConnection->prepare('DELETE FROM cmw_pages WHERE id = :id');
	$req->execute(array('id' => $_GET['id']));
}
?>