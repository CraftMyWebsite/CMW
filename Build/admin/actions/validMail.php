<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['members']['actions']['editMember']) {
	$req = $bddConnection->prepare('UPDATE cmw_users SET ValidationMail = 1 WHERE id like :id');
    $req->execute(array(':id' => $_GET['id']));
}
?>
