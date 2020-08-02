<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'members', 'actions', 'editMember')) {
	$req = $bddConnection->prepare('UPDATE cmw_users SET ValidationMail = 1 WHERE id like :id');
    $req->execute(array(':id' => $_GET['id']));
}
?>
